<? 
//FINALIZA COPY2CORE
include_once("controller/Connections/db_connection_page.php");
include_once("controller/Connections/db_connection_core.php");
require_once('lib/autobahn.php');

function getEmailDomain($email){
       $email = explode('@', $email);
       if (is_array($email))
           return $email[1];
       else
           return $email;
}
class Dna_PasswordHash
{
protected $itoa64;
protected $iteration_count_log2;
protected $portable_hashes;
protected $random_state;

public function __construct($iteration_count_log2 = 8, $portable_hashes = false)
{
$this->itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31)
$iteration_count_log2 = 8;
$this->iteration_count_log2 = $iteration_count_log2;

$this->portable_hashes = $portable_hashes;

$this->random_state = microtime();
if (function_exists('getmypid'))
$this->random_state .= getmypid();
}

protected function get_random_bytes($count)
{
$output = '';
if (is_readable('/dev/urandom') &&
   ($fh = @fopen('/dev/urandom', 'rb'))) {
$output = fread($fh, $count);
fclose($fh);
}

if (strlen($output) < $count) {
$output = '';
for ($i = 0; $i < $count; $i += 16) {
$this->random_state =
   md5(microtime() . $this->random_state);
$output .=
   pack('H*', md5($this->random_state));
}
$output = substr($output, 0, $count);
}

return $output;
}

protected function encode64($input, $count)
{
$output = '';
$i = 0;
do {
$value = ord($input[$i++]);
$output .= $this->itoa64[$value & 0x3f];
if ($i < $count)
$value |= ord($input[$i]) << 8;
$output .= $this->itoa64[($value >> 6) & 0x3f];
if ($i++ >= $count)
break;
if ($i < $count)
$value |= ord($input[$i]) << 16;
$output .= $this->itoa64[($value >> 12) & 0x3f];
if ($i++ >= $count)
break;
$output .= $this->itoa64[($value >> 18) & 0x3f];
} while ($i < $count);

return $output;
}

protected function gensalt_private($input)
{
$output = '$P$';
$output .= $this->itoa64[min($this->iteration_count_log2 +
((PHP_VERSION >= '5') ? 5 : 3), 30)];
$output .= $this->encode64($input, 6);

return $output;
}

protected function crypt_private($password, $setting)
{
$output = '*0';
if (substr($setting, 0, 2) == $output)
$output = '*1';

$id = substr($setting, 0, 3);
# We use "$P$", phpBB3 uses "$H$" for the same thing
if ($id != '$P$' && $id != '$H$')
return $output;

$count_log2 = strpos($this->itoa64, $setting[3]);
if ($count_log2 < 7 || $count_log2 > 30)
return $output;

$count = 1 << $count_log2;

$salt = substr($setting, 4, 8);
if (strlen($salt) != 8)
return $output;

# We're kind of forced to use MD5 here since it's the only
# cryptographic primitive available in all versions of PHP
# currently in use.  To implement our own low-level crypto
# in PHP would result in much worse performance and
# consequently in lower iteration counts and hashes that are
# quicker to crack (by non-PHP code).
if (PHP_VERSION >= '5') {
$hash = md5($salt . $password, TRUE);
do {
$hash = md5($hash . $password, TRUE);
} while (--$count);
} else {
$hash = pack('H*', md5($salt . $password));
do {
$hash = pack('H*', md5($hash . $password));
} while (--$count);
}

$output = substr($setting, 0, 12);
$output .= $this->encode64($hash, 16);

return $output;
}

protected function gensalt_extended($input)
{
$count_log2 = min($this->iteration_count_log2 + 8, 24);
# This should be odd to not reveal weak DES keys, and the
# maximum valid value is (2**24 - 1) which is odd anyway.
$count = (1 << $count_log2) - 1;

$output = '_';
$output .= $this->itoa64[$count & 0x3f];
$output .= $this->itoa64[($count >> 6) & 0x3f];
$output .= $this->itoa64[($count >> 12) & 0x3f];
$output .= $this->itoa64[($count >> 18) & 0x3f];

$output .= $this->encode64($input, 3);

return $output;
}

protected function gensalt_blowfish($input)
{
# This one needs to use a different order of characters and a
# different encoding scheme from the one in encode64() above.
# We care because the last character in our encoded string will
# only represent 2 bits.  While two known implementations of
# bcrypt will happily accept and correct a salt string which
# has the 4 unused bits set to non-zero, we do not want to take
# chances and we also do not want to waste an additional byte
# of entropy.
$itoa64 = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

$output = '$2a$';
$output .= chr(ord('0') + $this->iteration_count_log2 / 10);
$output .= chr(ord('0') + $this->iteration_count_log2 % 10);
$output .= '$';

$i = 0;
do {
$c1 = ord($input[$i++]);
$output .= $itoa64[$c1 >> 2];
$c1 = ($c1 & 0x03) << 4;
if ($i >= 16) {
$output .= $itoa64[$c1];
break;
}

$c2 = ord($input[$i++]);
$c1 |= $c2 >> 4;
$output .= $itoa64[$c1];
$c1 = ($c2 & 0x0f) << 2;

$c2 = ord($input[$i++]);
$c1 |= $c2 >> 6;
$output .= $itoa64[$c1];
$output .= $itoa64[$c2 & 0x3f];
} while (1);

return $output;
}

public function HashPassword($password)
{
$random = '';

if (CRYPT_BLOWFISH == 1 && !$this->portable_hashes) {
$random = $this->get_random_bytes(16);
$hash =
   crypt($password, $this->gensalt_blowfish($random));
if (strlen($hash) == 60)
return $hash;
}

if (CRYPT_EXT_DES == 1 && !$this->portable_hashes) {
if (strlen($random) < 3)
$random = $this->get_random_bytes(3);
$hash =
   crypt($password, $this->gensalt_extended($random));
if (strlen($hash) == 20)
return $hash;
}

if (strlen($random) < 6)
$random = $this->get_random_bytes(6);
$hash =
   $this->crypt_private($password,
   $this->gensalt_private($random));
if (strlen($hash) == 34)
return $hash;

# Returning '*' on error is safe here, but would _not_ be safe
# in a crypt(3)-like function used _both_ for generating new
# hashes and for validating passwords against existing hashes.
return '*';
}

public function CheckPassword($password, $stored_hash)
{
$hash = $this->crypt_private($password, $stored_hash);
if ($hash[0] == '*')
$hash = crypt($password, $stored_hash);

return $hash == $stored_hash;
}
}
///END CLASS
function replace_accents($string) 
{ 
  return str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'), $string); 
}
function clearUTF($chaine){
	return iconv('UTF-8', 'ASCII//TRANSLIT', $chaine);
}

function fraudCheck($datos){
	/*
	$datos['city'] //CIUDAD
	$datos['region'] //ESTADO
	$datos['postal'] //CÓDIGO POSTAL
	$datos['country']//PAÍS
	$datos['email']//EMAIL
	$datos['phone']//TELEFONO
	$datos['sessionID']//ID DE SESIÓN / ID DE USUARIO EN WEB
	*/
	require("lib/CreditCardFraudDetection.php");
	$ccfs = new CreditCardFraudDetection;
	// See http://www.maxmind.com/app/ccv for more details on the input fields
	$h["license_key"] = "K7349jwmYaeV";
	$h["i"] = $_SERVER['REMOTE_ADDR'];
	$h["city"] = $datos['city'];
	$h["region"] = $datos['region'];
	$h["postal"] = $datos['postal'];
	$h["country"] = $datos['country'];
	$h["domain"] = getEmailDomain($datos['email']);
	$h["emailMD5"] = md5(strtolower($datos['email']));
	$h["custPhone"] = $datos['phone'];
	$h["sessionID"] = $datos['sessionID'];
	$h["accept_language"] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$h["user_agent"] =  $_SERVER['HTTP_USER_AGENT'];
	$ccfs->timeout = 10;
	$ccfs->useDNS = 0;
	$ccfs->isSecure = 0;
	$ccfs->input($h);
	$ccfs->query();
	$h = $ccfs->output();
	$outputkeys = array_keys($h);
	$export = array();
	foreach($h as $key=>$dato):
		$export[$key] = clearUTF(replace_accents(utf8_encode($dato)));
	endforeach;
	return serialize($export);
}

function makeHash($password, $saltlength = 8) 
	{
		$salt = substr(md5(uniqid(rand(), true)), 0, $saltlength); 
		return $salt . '$' . sha1($salt . $password);
	}

class Security
{
    private $pubkey = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqFzPGdtZc8jhz5uVoyUE
v4CRRwktL6Ys2fUKNFNQjmLVIuk1nFRCHHZEsZf8jEIH7XlYY1LLdjeXPlfFrupf
/YFsajF0M2poGlgF2clIqK9frQoFmeKmeQuBH+ONUbrcg5TAxf25ts8y8J6pZVxE
SsKtAewRqBR/qubFJYFMXF0TlBDxLAoWPGkZ4VH7ly4pPccYZ2Rwt/xOq4JR9t3u
Lk4XQyh6CkLgRs2YvHUaHXGYnM8vhYQ2+r5DqTlns1wlwfRzfa9Yi76rfa3SFLKy
FHo69vqbgJ7NuIU3I1X7GTvxj1oJqASGyQlg5nCAl4KwWmlgOxVJLyTAhq80v7ri
/wIDAQAB
-----END PUBLIC KEY-----';

 public function encrypt($data = '')
 {
 if (openssl_public_encrypt($data, $encrypted, $this->pubkey))
 $data = base64_encode($encrypted);
 else
 throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');
 
 return $data;
 }
 
 public static function randomPassword($len = 10)
 {
        $spassword = "";
        $charSet = '.@$_,abcdefghijklmnopqrstuvwxyz.@$_,0123456789ABCDEFGHIJKLMNOPQRSTUVW.@$_,';
        while(strlen($spassword) < $len) {
                $rnd = rand(0, strlen($charSet)-1);
                $spassword .= substr($charSet, $rnd, 1);
        }

        return $spassword;
    }
}

function CoreInsertProduct($client_id,$invoice_id,$dato){
	global $queryCore,$Security,$tb_page_domain,$tb_core_tld;
	$datoInvoice = array();
	$datoApi = null;
	$tipo = null;
	$Security = new Security();
	
	//INFO DE DOMINIO
	
	
	if(($dato['service_type'] == 'streaming_shared') OR ($dato['service_type'] == 'streaming_reseller')){
		$infoDominio = explode('.',ponerDominio(str_replace(' ','',str_replace('www.','',$dato['note_1']))));
		$dominioSLD = $infoDominio[0];
		if(count($infoDominio) > 1){
			$dominioTLD = (count($infoDominio) > 2) ? $infoDominio[1].'.'.$infoDominio[2] : $infoDominio[1];
		}
	}else{
		$infoDominio = explode('.',str_replace('www.','',$dato['note_1']));
		$dominioSLD = $infoDominio[0];
		if(count($infoDominio) > 1){
			$dominioTLD = (count($infoDominio) > 2) ? $infoDominio[1].'.'.$infoDominio[2] : $infoDominio[1];
		}
	}
	switch($dato['service_type']){
		case 'domain-registry':
			$tiempo_regitro = ($dato['cicle_type'] == 'yearly') ? 1 : str_replace('yearly','',$dato['cicle_type']);
			
			//PARA DNA_DOMAINS
			$datoDominio['client_id'] = $client_id;
			$datoDominio['domain_tld'] = $dominioTLD;
			$datoDominio['domain_sld'] = $dominioSLD;
			$datoDominio['domain_date_order'] = date('Y-m-d');
			$datoDominio['domain_dns1'] = '';
			$datoDominio['domain_dns2'] = '';
			$datoDominio['domain_status'] = 'pendingregistration';
			$datoDominio['domain_username'] = substr(str_replace('.','',$dato['note_1']),0,20);
			$datoDominio['domain_password'] = $Security->encrypt($Security->randomPassword());
			$datoDominio['domain_bill_amount'] = $tb_core_tld->obtenerDato("tld_price_renew","tld='$dominioTLD' AND company_id='$_SESSION[core_company_id]'");
			//RECORREMOS EL INSERT DE DOMINIOS POR MAL APPROACH DE ABAJO
			
			//MAL APPROACH, SOLUCIÓN TEMPORAL PARA PRECIOS ESPECIALES
			if(($datoDominio['client_id'] == 55643) || ($datoDominio['client_id'] == 8388)){
				//definimos arreglo de precios
				switch($dominioTLD){
					case 'mx':
						$dato['price_cicle'] = 510;
						$datoDominio['domain_bill_amount'] = 510;
						break;
						
					case 'com.mx':
						$dato['price_cicle'] = 140;
						$datoDominio['domain_bill_amount'] =240;
						break;
						
					case 'com':
						$dato['price_cicle'] = 220;
						$datoDominio['domain_bill_amount'] = 220;
						break;
						
					case 'net':
						$dato['price_cicle'] = 220;
						$datoDominio['domain_bill_amount'] =220;
						break;
					
					case 'org':
						$dato['price_cicle'] = 220;
						$datoDominio['domain_bill_amount'] =220;
						break;
					
					case 'biz':
						$dato['price_cicle'] = 220;
						$datoDominio['domain_bill_amount'] =220;
						break;
						
					case 'info':
						$dato['price_cicle'] = 220;
						$datoDominio['domain_bill_amount'] =220;
						break;
						
					case 'tv':
						$dato['price_cicle'] = 550;
						$datoDominio['domain_bill_amount'] =550;
						break;
						
					case 'us':
						$dato['price_cicle'] = 220;
						$datoDominio['domain_bill_amount'] =220;
						break;
						
					case 'co':
						$dato['price_cicle'] = 500;
						$datoDominio['domain_bill_amount'] =500;
						break;
						
					case 'com.co':
						$dato['price_cicle'] = 220;
						$datoDominio['domain_bill_amount'] =220;
						break;
				}
					$datoDominio['domain_bill_amount'] = $datoDominio['domain_bill_amount']/1.16;
					$datoInvoice['cost'] = ($dato['price_cicle']*$tiempo_regitro)/1.16;
					$datoInvoice['subtotal'] = ($dato['price_cicle']*$tiempo_regitro)/1.16;
			}
			
			$queryCore->insertDnaDomains($datoDominio);
			$idDnaDomains = $queryCore->lastInsertId();
			
			// PARA INVOICE
			$datoInvoice['description'] = 'Registro de dominio '.$dato['note_1'].' por '.$tiempo_regitro.' año(s)';
			// PARA API
			$datoApi['api_module'] = 'Domain';
			$datoApi['api_data'] = serialize(array('client_id' => $client_id,'domain_id' => $idDnaDomains, 'years' => $tiempo_regitro));
			$datoApi['api_product'] = 'domain|'.$idDnaDomains;
	
			//PARA WHOIS
			$consultaDatosUsuario = $queryCore->findAll('dna_clients',array('conditions' => array('client_id' => $client_id)));
			$datoWhois = array(
				'OrganizationName'	=>	$consultaDatosUsuario[0]['dna_clients']['client_company'],
				'JobTitle'			=>	'',
				'FirstName'			=>	$consultaDatosUsuario[0]['dna_clients']['client_fname'],
				'LastName'			=>	$consultaDatosUsuario[0]['dna_clients']['client_lname'],
				'EmailAddress'		=>	$consultaDatosUsuario[0]['dna_clients']['client_email'],
				'Address1'			=>	$consultaDatosUsuario[0]['dna_clients']['client_address'],
				'Address2'			=>	'',
				'City'				=>	$consultaDatosUsuario[0]['dna_clients']['client_city'],
				'StateProvince'		=>	$consultaDatosUsuario[0]['dna_clients']['client_state'],
				'Country'			=>	$consultaDatosUsuario[0]['dna_clients']['client_country'],
				'PostalCode'		=>	$consultaDatosUsuario[0]['dna_clients']['client_zipcode'],
				'Phone'				=>	$consultaDatosUsuario[0]['dna_clients']['client_phone_home'],
				'Fax'				=>	'',
				'numyears'			=>	$tiempo_regitro,
			);
			
			foreach($datoWhois as $llave=>$contenidollave){
				if($contenidollave == ''){ $contenidollave = ' '; }
				$valores = array(
					'domain_config_id' 		=> null,
					'domain_id' 			=> $idDnaDomains,
					'domain_config_key'	 	=> $llave,
					'domain_config_value'	=> $contenidollave
				);
				$queryCore->insertDnaDomainsConfig($valores);
			}
			
			//foreach para cada uno los topics
			
		break;
		
		case 'linux_shared':
			$tipo = 'hosting';
			$datoInvoice['description'] = 'Hospedaje linux compartido, paquete '.$dato['service_name'].' - '.$dato['note_1'];
		break;
		
		case 'linux_reseller':
			$tipo = 'hosting';
			$datoInvoice['description'] = 'Hospedaje linux reseller, paquete '.$dato['service_name'].' - '.$dato['note_1'];
		break;
		
		case 'streaming_shared':
			$tipo = 'hosting';
			$datoInvoice['description'] = 'Radio individual '.$dato['service_name'].' / '.$dato['note_1'];
		break;
		
		case 'streaming_reseller':
			$tipo = 'hosting';
			$datoInvoice['description'] = 'Radio reseller '.$dato['service_name'].' / '.$dato['note_1'];
		break;
		
		case 'windows_shared':
			$tipo = 'hosting';
			$datoInvoice['description'] = 'Hospedaje windows compartido, paquete '.$dato['service_name'].' - '.$dato['note_1'];
		break;
		
		case 'windows_reseller':
			$tipo = 'hosting';
			$datoInvoice['description'] = 'Hospedaje linux reseller, paquete '.$dato['service_name'].' - '.$dato['note_1'];
		break;
	}
		if($tipo == 'hosting'){
			$username = $dominioSLD . $dominioTLD;
      		if (preg_match_all('/([A-Z]|[a-z])/', $username, $matches) > 0) {
    		     $username = strtolower(substr(implode($matches[0]), 0, 8));
     		} else {
      			 $username = substr(base64_encode($hosting_sld), 0, 8);
    		}
			$datoHosting['client_id'] = $client_id;
			$datoHosting['hosting_sld'] = $dominioSLD;
			$datoHosting['hosting_tld'] = $dominioTLD;
			$datoHosting['package_id'] = $dato['package_id_core'];
			$datoHosting['hosting_username'] = $username ;
			$datoHosting['hosting_password'] = $Security->encrypt($Security->randomPassword());
			$datoHosting['hosting_bill_amount'] = $dato['price_cicle']/$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			$datoHosting['hosting_bill_cycle'] = $dato['cicle_type'];
			$datoHosting['hosting_date_order'] = date('Y-m-d');
			$datoHosting['hosting_date_renew'] = $dato['datenext_renew'];
			$datoHosting['hosting_status'] = 'pending';
			$queryCore->insertDnaHosting($datoHosting);
			$idDnaHosting = $queryCore->lastInsertId();
			
			// PARA API
			$datoApi['api_module'] = 'Hosting';
			$datoApi['api_data'] = serialize(array('client_id' => $client_id,'hosting_id' => $idDnaHosting));
			$datoApi['api_product'] = 'hosting|'.$idDnaHosting;	
		}
		
		//INSERTAR EN API
		$datoApi['invoice_id'] = $invoice_id;
		$datoApi['client_id'] = $client_id;
		$datoApi['api_timestamp'] = time();
		$datoApi['api_command'] = 'create';
		//INSERTAR EN INVOICE
			$datoInvoice['invoice_id'] = $invoice_id;
			$datoInvoice['item_product'] = $datoApi['api_product'];
		if($dato['first_prorate_quantity']>0){
			if(!isset($datoInvoice['cost'])){
				$datoInvoice['cost'] = $dato['first_prorate_quantity']/$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
				$datoInvoice['subtotal'] = $dato['first_prorate_quantity']/$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			}
			$queryCore->insertDnaInvoiceItems($datoInvoice);
			if($dato['second_prorate_quantity']>0){
				$datoInvoice['description'] = 'Prorrateo ('.$dato['second_date_prorate_of'].' a '.$dato['second_date_prorate_to'].'): '.$datoInvoice['description'];
				$datoInvoice['cost'] = $dato['second_prorate_quantity']/$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
				$datoInvoice['subtotal'] = $dato['second_prorate_quantity']/$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
				$queryCore->insertDnaInvoiceItems($datoInvoice);
			}
		}else{
			if(!isset($datoInvoice['cost'])){
				$datoInvoice['cost'] = $dato['price_cicle']/$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
				$datoInvoice['subtotal'] = $dato['price_cicle']/$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			}
			$queryCore->insertDnaInvoiceItems($datoInvoice);	
		}
		$queryCore->insertDnaApiQueue($datoApi);
}

function CoreInsertUser($dato){
		global $queryCore,$core_company_id,$Security;
		$Security = new Security();
		$dato['client_pin'] = str_pad(rand(1000, 99999), 5, '0', STR_PAD_LEFT);
		$dato['client_password'] = makeHash($dato['client_password']);
		$dato['client_password_lastupdate'] = time();
		$dato['client_orderip'] = $_SERVER['REMOTE_ADDR'];
		$dato['company_id'] = $core_company_id;
		$dato['client_nonce'] = substr(sha1($Security->randomPassword(32)),0,49);
		$dato['client_lang'] = 'es_MX';
		$dato['client_date_signup'] = date('Y-m-d');
		$dataCheck = array('city' => $dato['client_city'],'region' => $dato['client_state'],'postal' => $dato['client_zipcode'],
						   'country'=>$dato['client_country'],'email' => $dato['client_email'],'phone'=>$dato['client_phone'],
						   'sessionID' => $_SESSION['visit_key']);
		$dato['client_fraudcheck'] = fraudCheck($dataCheck);
		$queryCore->insertDnaClients($dato);
		return $queryCore->lastInsertId();
}
	
function CoreCreateInvoice($client_id){
		global $queryCore,$tb_page_domain;
		$dato['client_id'] = $client_id;
		$dato['invoice_date_created'] = date('Y-m-d');
		$dato['invoice_date_due'] = date('Y-m-d', strtotime('+ 7 days'));
		$dato['invoice_applied_latefee'] = 1;
		$dato['invoice_neworder'] = 1;
		$dato['invoice_taxrate'] = ($tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])-1)*100;
		$queryCore->insertDnaInvoices($dato);
		return $queryCore->lastInsertId();
}

function ponerDominio($nombre){
	$salida = explode('.',$nombre);
	if(count($salida)>1){
		return $nombre;
	}else{
		return $nombre.'.com';	
	}
}

$query = Autobahn::getConnection('default');
$client = $query->findTbPageClientByVisitKey($_SESSION['visit_key']);
$client_id = $client['0']['tb_page_client']['client_id'];
$productos = $query->findAll('tb_page_orders',array('conditions' => array('order_status' => 'in_car','client_id' => $client['0']['tb_page_client']['client_id'])));
$queryCore = Autobahn::getConnection('core');

//FINALIZA COPY2CORE
function verifyHash($password, $hash)
						{
							if ($hash == '')
								return false;
					
							if (substr_count($hash, ':') > 0) {
								// WHMCS Salted
								$parts = explode(':', $hash);
								$salt = $parts[1];
								$hash = $parts[0];
					
								if (md5($salt . html_entity_decode($password)) == $hash) 
									return true;
							} elseif (substr_count($hash, '$') > 0) {
								// DNA Salted
								$parts = explode('$',$hash);
								if (strcmp(sha1($parts[0] . $password),$parts[1]) == 0)
									return true;
							}
							
	
							return false;
}
if($tb_page_orders->math("COUNT","order_status='in_car' AND client_id=".$_SESSION['client_id'])>0){
$correct_update=false;
if(isset($_POST['form_id'])){
	if($_POST['form_id']=="is_new_client"){
			if(isset($_POST['client_full_name']) &&
				isset($_POST['client_last_name']) &&
				isset($_POST['client_email']) &&
				isset($_POST['client_phone']) &&
				isset($_POST['client_address']) &&
				isset($_POST['client_city']) &&
				isset($_POST['client_state']) &&
				isset($_POST['password']) &&
				isset($_POST['password2']) &&
				isset($_POST['client_country'])
				){
					//borra html-code
				$client_full_name=strip_tags($_POST['client_full_name']);
				$client_last_name=strip_tags($_POST['client_last_name']);
				$client_email=strip_tags($_POST['client_email']);
				$client_phone=strip_tags($_POST['client_phone']); 
				$client_address=strip_tags($_POST['client_address']); 
				$client_city=strip_tags($_POST['client_city']);
				$client_state=strip_tags($_POST['client_state']);
				$client_country=strip_tags($_POST['client_country']);
				$client_zipcode=strip_tags($_POST['client_zipcode']);
				$client_password=$_POST['password'];
				if(($tb_dna_clients->math("COUNT","client_email='$client_email' AND company_id='$core_company_id'")<1) && ($tb_dna_clients->math("COUNT","client_email_alt='$client_email' AND company_id='$core_company_id'")<1)){	
				
				$Security = new Security();
				$datos_usuario_nuevo = array(
						'client_fname' => $client_full_name,
						'client_lname' => $client_last_name,
						'client_address' => $client_address,
						'client_city' => $client_city,
						'client_state' => $client_state,
						'client_country' => $client_country,
						'client_phone_home' => $client_phone,
						'client_password' => $client_password,
						'client_email' => $client_email,
						'client_zipcode' => $client_zipcode,
				);
				if( (isset($_POST['fiscal_ivoice'])) && ($_POST['fiscal_ivoice'] == true) ){
					//si el usuario pidió factura, sobreescribimos los datos
					$datos_usuario_nuevo['client_company'] = strip_tags($_POST['sat_name']);
					$datos_usuario_nuevo['client_address'] = strip_tags($_POST['sat_address'])."\nCol.".strip_tags($_POST['sat_colonia']);
					$datos_usuario_nuevo['client_city'] = strip_tags($_POST['sat_city']);
					$datos_usuario_nuevo['client_state'] = strip_tags($_POST['sat_state']);
					$datos_usuario_nuevo['client_country'] = strip_tags($_POST['sat_country']);
					$datos_usuario_nuevo['client_zipcode'] = strip_tags($_POST['sat_cp']);
					$datos_usuario_nuevo['client_rg'] = strip_tags($_POST['sat_rfc']);
				}
				$id_usuario_nuevo = CoreInsertUser($datos_usuario_nuevo);
				$id_recibo = CoreCreateInvoice($id_usuario_nuevo);
				foreach($productos as $dato):
					$dato = $dato['tb_page_orders'];
					CoreInsertProduct($id_usuario_nuevo,$id_recibo,$dato);
				endforeach;
				
					if(isset($_POST['fiscal_ivoice'])){
							if($_POST['fiscal_ivoice']==true){
								// borra html-codes
								$sat_name=strip_tags(utf8_decode($_POST['sat_name']));
								$sat_rfc=strip_tags(utf8_decode($_POST['sat_rfc']));
								$sat_address=strip_tags(utf8_decode($_POST['sat_address']));
								$sat_colonia=strip_tags(utf8_decode($_POST['sat_colonia']));
								$sat_cp=strip_tags(utf8_decode($_POST['sat_cp']));
								$sat_city=strip_tags(utf8_decode($_POST['sat_city']));
								$sat_state=strip_tags(utf8_decode($_POST['sat_state']));
								$sat_country=strip_tags(utf8_decode($_POST['sat_country']));
								
								
								$tb_page_client->update("is_incore='NO',client_full_name='$client_full_name',client_email='$client_email',client_phone='$client_phone',client_address='$client_address',client_city='$client_city',client_state='$client_state',client_country='$client_country',fiscal='No',fiscal_name='$sat_name',fiscal_rfc='$sat_rfc',fiscal_address='$sat_address',fiscal_colonia='$sat_colonia',fiscal_cp='$sat_cp',fiscal_city='$sat_city',fiscal_state='$sat_state',fiscal_country='$sat_country'","client_id=".$_SESSION['client_id']);
								
									include("shopping_car_resumeHtml.php");
									$msg=($msg_resumeOrder);
									$header_details="
									<div style=\"padding-bottom:15px; border-bottom:solid 1px #F5F5F5;\">
										<img src=\"http://hostdime.com.mx/images/identity/HostDime_Logo_390_80.png\" style=\"border:none;\" />
									</div>
									<div style=\"padding-bottom:10px; padding-top:10px;border-bottom:solid 1px #F5F5F5;\">".$client_full_name.", agradecemos tu preferencia y nos complace informarte que tu pedido ha sido registrado correctamente en nuestro sistema, no dudes en contactarnos para cualquier duda o aclaración.</div>
									<div style=\"padding-bottom:10px; padding-top:10px;border-bottom:solid 1px #F5F5F5;\">Verificaremos tus siguientes datos de cliente:</div>
									<div style=\"padding-bottom:15px; border-bottom:solid 1px #F5F5F5;\">
									Nombre:	$client_full_name <br />
									Apellidos:	$client_last_name <br />
									Email:	$client_email<br />
									Teléfono:	$client_phone<br />
									Dirección:	$client_address<br />
									Ciudad:	$client_city<br />
									Estado:	$client_state<br />
									País:	$client_country<br />
									</div>
									<div style=\"padding-bottom:10px; padding-top:10px;border-bottom:solid 1px #F5F5F5;\">Para generar tu factura usaremos los siguientes datos:</div>
									<div>
									Razón Social:	$sat_name <br />
									RFC:	$sat_rfc<br />
									Calle y No.:	$sat_address<br />
									Colonia:	$sat_colonia<br />
									Código Postal:	$sat_cp<br />
									Ciudad: $sat_city<br/>
									Estado:	$sat_state<br />
									País:	$sat_country<br />
									</div>";
									
									$cabeceras = "From: HostDime <core.desk@hostdime.com.mx>\r\n";
									$cabeceras.= "Reply-To: HostDime <core.desk@hostdime.com.mx>\r\n";
									$cabeceras.= 'MIME-Version: 1.0' . "\r\n";
									$cabeceras.= "Content-type: text/html\r\n";				
									mail($client_email,"Resumen de tu Órden",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
								//	mail("g.s@hostdime.com","Nueva orden de cliente (copia) ",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
									mail("oficina@hostdime.com.mx","Nueva orden de cliente (copia) ",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
									$correct_update=true;
$datosUsuarioQuery = $queryCore->findAll('dna_clients',array('conditions' => array('client_id' => $id_usuario_nuevo)));
echo '<script>location.href=\''.$tb_page_domain->obtenerDato("link_core","domain_id=".$_SESSION['domain_id']).'auth/sudo/id/'.$datosUsuarioQuery[0]['dna_clients']['client_nonce'].'/billing/invoice/id/'.$id_recibo.'\'</script>';
								}
						}else {
							
							$tb_page_client->update("is_incore='NO',client_full_name='$client_full_name',client_last_name='$client_last_name',client_email='$client_email',client_phone='$client_phone',client_address='$client_address',client_city='$client_city',client_state='$client_state',client_country='$client_country',fiscal='No'","client_id=".$_SESSION['client_id']);
								include("shopping_car_resumeHtml.php");
								$msg=($msg_resumeOrder);
								$header_details="
									<div style=\"padding-bottom:15px; border-bottom:solid 1px #F5F5F5;\">
										<img src=\"http://hostdime.com.mx/images/identity/HostDime_Logo_390_80.png\" style=\"border:none;\" />
									</div>
									<div style=\"padding-bottom:10px; padding-top:10px; border-bottom:solid 1px #F5F5F5;\">".$client_full_name.", agradecemos tu preferencia y nos complace informarte que tu pedido ha sido registrado correctamente en nuestro sistema, no dudes en contactarnos para cualquier duda o aclaración.</div>
									<div style=\"padding-bottom:10px; padding-top:10px;border-bottom:solid 1px #F5F5F5;\">Verificaremos tus siguientes datos de cliente:</div>
									<div style=\"padding-bottom:15px; border-bottom:solid 1px #F5F5F5;\">
									Nombre:	$client_full_name <br />
									Apellidos: $client_last_name<br />
									Email:	$client_email<br />
									Teléfono:	$client_phone<br />
									Dirección:	$client_address<br />
									Ciudad:	$client_city<br />
									Estado:	$client_state<br />
									País:	$client_country<br />
									</div>";
								$cabeceras = "From: HostDime <core.desk@hostdime.com.mx>\r\n";
								$cabeceras.= "Reply-To: HostDime <core.desk@hostdime.com.mx>\r\n";
								$cabeceras.= 'MIME-Version: 1.0' . "\r\n";
								$cabeceras.= "Content-type: text/html\r\n";				
								mail($client_email,"Resumen de tu orden",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
							//	mail("g.s@hostdime.com","Nueva orden de cliente (copia) ",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
								mail("oficina@hostdime.com.mx","Nueva orden de cliente (copia) ",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
								$correct_update=true;
								// TODO: REDIRECCIONAR A INVOICE
$datosUsuarioQuery = $queryCore->findAll('dna_clients',array('conditions' => array('client_id' => $id_usuario_nuevo)));
$redirecciona = '<script>location.href=\''.$tb_page_domain->obtenerDato("link_core","domain_id=".$_SESSION['domain_id']).'auth/sudo/id/'.$datosUsuarioQuery[0]['dna_clients']['client_nonce'].'/billing/invoice/id/'.$id_recibo.'\'</script>';
$enlace_click_aqui = $tb_page_domain->obtenerDato("link_core","domain_id=".$_SESSION['domain_id']).'auth/sudo/id/'.$datosUsuarioQuery[0]['dna_clients']['client_nonce'].'/billing/invoice/id/'.$id_recibo;
						}
				}// Cierra if, que comprueba si el email que está dando el cliente no está en uso en Core.
		} // Cierra los isset's
	} // Cierra si es nuevo cliente
	
		
	
	// inicia if Cliente es existente
	if($_POST['form_id']=="existent_client"){
			if(isset($_POST['client_emailcore']) && isset($_POST['client_passwordcore'])){
				$client_emailcore=strip_tags(utf8_decode($_POST['client_emailcore']));
				$client_passwordcore=strip_tags(utf8_decode($_POST['client_passwordcore']));
				
					$core_hostname_db_connection = "72.29.91.3";
					$core_database_db_connection = "dna_test";
					$core_username_db_connection = "corpvps_hdmx";
					$core_password_db_connection = "C4Zp2tnFEfzW77xe";
					
					$core_db_connection = mysql_pconnect($core_hostname_db_connection, $core_username_db_connection, $core_password_db_connection) or trigger_error(mysql_error(),E_USER_ERROR);
					mysql_select_db($core_database_db_connection, $core_db_connection);
						
					$core_selectSQL="SELECT *  FROM `dna_clients` WHERE client_email = '$client_emailcore' AND company_id = '$core_company_id'";
					$core_result=mysql_query($core_selectSQL,$core_db_connection);	
					$core_row_orders=mysql_fetch_assoc($core_result);
					$Hash = new Dna_PasswordHash();
					do{
						if(verifyHash($client_passwordcore,$core_row_orders['client_password']) || $Hash->CheckPassword($client_passwordcore, $core_row_orders['client_password'])){
								$client_full_name = $core_row_orders['client_fname'];
								$id_usuario_nuevo = $core_row_orders['client_id'];
								$id_recibo = CoreCreateInvoice($id_usuario_nuevo);
								foreach($productos as $dato):
									$dato = $dato['tb_page_orders'];
									CoreInsertProduct($id_usuario_nuevo,$id_recibo,$dato);
								endforeach;
								
								
								$tb_page_client->update("is_incore='YES',client_email='$client_emailcore'","client_id=".$_SESSION['client_id']);
								include("shopping_car_resumeHtml.php");
								$msg=($msg_resumeOrder);
								$header_details="
									<div style=\"padding-bottom:15px; border-bottom:solid 1px #F5F5F5;\">
										<img src=\"http://hostdime.com.mx/images/identity/HostDime_Logo_390_80.png\" />
									</div>
									<div style=\"padding-bottom:10px; padding-top:10px; border-bottom:solid 1px #F5F5F5;\">".$client_full_name.", agradecemos tu preferencia y nos complace informarte que tu pedido ha sido registrado correctamente en nuestro sistema, no dudes en contactarnos para cualquier duda o aclaración.</div>
									<div style=\"padding-bottom:10px; border-bottom:solid 1px #F5F5F5;\">Hemos detectado que ya eres cliente de HostDime, con el email: $client_emailcore</div>";
								$cabeceras = "From: HostDime <core.desk@hostdime.com.mx>\r\n";
								$cabeceras.= "Reply-To: HostDime <core.desk@hostdime.com.mx>\r\n";
								$cabeceras.= 'MIME-Version: 1.0' . "\r\n";
								$cabeceras.= "Content-type: text/html\r\n";				
								mail($client_emailcore,"Resumen de tu Pedido",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
								//mail("g.s@hostdime.com","Nueva orden de cliente (copia) ",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
								mail("oficina@hostdime.com.mx","Nueva orden de cliente (copia) ",utf8_decode($header_details).utf8_decode($msg),$cabeceras);
								$correct_update=true;
$nonce_nuevo = substr(sha1($Security->randomPassword(32)),0,49);
$queryCore->updateDnaClients(array('client_nonce' => $nonce_nuevo),array('client_id' => $id_usuario_nuevo));		
$redirecciona = '<script>location.href=\''.$tb_page_domain->obtenerDato("link_core","domain_id=".$_SESSION['domain_id']).'auth/sudo/id/'.$nonce_nuevo.'/billing/invoice/id/'.$id_recibo.'\'</script>';
$enlace_click_aqui = $tb_page_domain->obtenerDato("link_core","domain_id=".$_SESSION['domain_id']).'auth/sudo/id/'.$nonce_nuevo.'/billing/invoice/id/'.$id_recibo;
							}
						
					}while($core_row_orders=mysql_fetch_assoc($core_result));
						
								
								
					
			}
	}
	// finaliza if Cliente es existenet
}
	
?>


<?php 
// CÓDIGO PARA CONVERSIONES
$dominio_id =  $tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'");
if($dominio_id == 1 && isset($total_a_pagar)){
$conversion = '<!-- Google Code for Compra HDMX Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 955174123;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "ahs8CLXY5QMQ65m7xwM";
var google_conversion_value = '.$total_a_pagar.';
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/955174123/?value='.$total_a_pagar.'&amp;label=ahs8CLXY5QMQ65m7xwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>';
}
if($dominio_id == 3 && isset($total_a_pagar)){
$conversion='<!-- Google Code for Compra HDES Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 955174123;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "0iWOCKXa5QMQ65m7xwM";
var google_conversion_value = '.$total_a_pagar.';
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/955174123/?value='.$total_a_pagar.'&amp;label=0iWOCKXa5QMQ65m7xwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
';
}
if(($dominio_id > 2) && ($dominio_id != 3) && isset($total_a_pagar)){
$conversion ='<!-- Google Code for Compra HDLA Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 955174123;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "q6B5CK3Z5QMQ65m7xwM";
var google_conversion_value = '.$total_a_pagar.';
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/955174123/?value='.$total_a_pagar.'&amp;label=q6B5CK3Z5QMQ65m7xwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
';
}

//CONVERSION
if(isset($conversion)){
	echo $conversion;
}
?>


<? if($correct_update==true) {?>
<div style="margin:0 auto 0 auto;width:950px;overflow:hidden;border-bottom:solid 1px #ECECEC;">
	 <div style="float:left; width:450px; margin-top:25px;">
     	<div style="font-size:22px; color:#000; margin-bottom:5px;">Muchas Gracias por tu orden,</div>
         <div style="margin:2px; font-size:13px; line-height:20px;float:left;">
    		Por favor espera mientras eres direccionado a nuestro sistema CORE donde podrás realizar tu pago. Si no eres redireccionado en 5 segundos <a href="<?=$enlace_click_aqui;?>">haz click aquí</a>.
         </div>
     </div>
     <div style="float:left; width:450px; margin-top:25px; border-left:solid 1px #E9E9E9; padding-left:10px; margin-bottom:20px;">
     	<div style="font-size:22px; color:#000; margin-bottom:5px;">Si tienes dudas adicionales,</div>
        <div style="margin:2px; font-size:13px; line-height:20px; padding-bottom:5px; float:left;margin-bottom:5px;">
    	Nuestro personal está disponible las 24 horas del día, de lunes a domingo, todo el año para poderte ayudar en todo lo que necesites.
        </div>
        <div style="margin-top:10px;">
        	<div style="float:left;"><img src="images/livechat_icon.png" alt="" /></div>
            <div style="float:left;"><a href="#" onclick="window.open('<?=$tb_page_domain->obtenerDato("link_livechat","domain_id=".$_SESSION['domain_id']);?>','chat','width=545,height=597,scrollbars=no,menubar=no,resizable=no,toolbar=no,titlebar=no,location=no,status=no');return false;" style="color:#F63; font-size:18px; font-style:italic;">
            clic aqui para iniciar chat</a></div>
        </div>
     </div>
     
</div>
<div style="margin-top:15px;">
<? 
			echo $msg;
			$tb_page_orders->update("order_status='processing'","client_id=".$_SESSION['client_id']." AND order_status='in_car'");		
	?>
</div>
<? 
//REDIRECCIONAMOS
if(isset($redirecciona)){
	echo $redirecciona;
}
} ?>
<? 
	if($correct_update==false){
			if(isset($_POST['form_id'])){ 
				if($_POST['form_id']=="is_new_client"){ ?>
					<div style="padding:10px; font-size:13px; font-weight:bold;"> 
                    	Estás diciendo que eres un nuevo cliente, pero al parecer al momento de meter tus datos, algo estás haciendo mal, por favor verifica nuevamente. Un error puede ser que, el correo electrónico que estás usando, ya está registrado en nuestro sistema.
                    </div>
					<? }
				if($_POST['form_id']=="existent_client"){ ?>
					<div style="padding:10px; font-size:13px; font-weight:bold;">  
                    	Estás diciendo que eres un cliente existente, pero los datos que estás usando para autentificarte están incorrectos. 
                        Por favor intente una vez más, sino funciona, contáctanos inmediatamente por chat.
                    </div>
					<? }	
			}
		}
}else { echo "No hay nada que hacer en esta sección..."; }
?>