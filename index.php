<? 
ini_set("session.cookie_lifetime","259200"); 
session_start();
date_default_timezone_set("America/Mexico_City");
if(!isset($_SESSION['visit_key'])){
	$_SESSION['visit_key']=$_SERVER['REMOTE_ADDR'].date(".Y.m.d.H.i.").rand(1,1000);
}
?><!DOCTYPE HTML> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- 
Todo el código y archivos en éste sitio son propiedad intelectual de HostDime Inc. cualquier reproducción parcial o total deberá ser con consentimiento escrito por parte de HostDime Inc. Desarrolló: Gustavo Salazar S.
 -->
<?

include("functions.php");

include("controller/class.page_database.php");

//include("controller/class.page_division.php");
//include("controller/class.page_domain.php");
//include("controller/class.page_division_phones.php");
//include("controller/class.page_division_link_seo.php");
//include("controller/class.page_hosting_package.php");
//include("controller/class.page_colocation.php");
//include("controller/class.page_dedicated_package.php");
//include("controller/class.page_tdl_domain.php");
//include("controller/class.page_knowledgebase_articles.php");
//include("controller/class.page_knowledgebase_category_articles.php");
//include("controller/class.page_hr_employees_photos.php");
//include("controller/class.hr_employees.php");


include("controller/class.page_division_employee.php");
include("controller/class.page_metadata.php");
include("controller/class.page_orders.php");
include("controller/class.page_client.php");
include("controller/class.page_token.php");
include("controller/class.page_navegation_log.php");
include("controller/class.page_client_core.php");
include("controller/class.page_link.php");

//include("controller/class.page_packages.php");
$tb_page_packages=new tb_page_database('tb_page_packages');


include("controller/class.core_packages.php");
$tb_core_packages= new tb_core_packages();

include("controller/class.core_tld.php");
$tb_core_tld= new tb_core_tld();

require_once('Zend/Locale.php');
$locale = new Zend_Locale('es_MX');
$arrCountries = $locale->getTranslationList('Territory', 'es_MX', 2);
asort($arrCountries, SORT_LOCALE_STRING);

asort($arrCountries, SORT_LOCALE_STRING);
$tb_page_domain= new tb_page_database('tb_page_domain');
$tb_page_division=new tb_page_database('tb_page_division');
$tb_page_division_phones=new tb_page_database('tb_page_division_phones');
$tb_page_division_link_seo=new tb_page_database('tb_page_division_link_seo');
$tb_page_hosting_package=new tb_page_database('tb_page_hosting_package');
$tb_page_dedicated_package=new tb_page_database('tb_page_dedicated_package');
$tb_page_colocation= new tb_page_database('tb_page_colocation');
$tb_page_tdl_domain=new tb_page_database('tb_page_tdl_domain');
$tb_page_knowledgebase_articles=new tb_page_database('tb_page_knowledgebase_articles');
$tb_page_knowledgebase_category_articles=new tb_page_database('tb_page_knowledgebase_category_articles');
$tb_page_metadata=new tb_page_database('tb_page_metadata');
$tb_page_division_employee=new tb_page_database('tb_page_division_employee');
$tb_page_hr_employees_photos=new tb_page_database('tb_page_hr_employees_photos');
$tb_hr_employees=new tb_page_database('hr_employees');
$tb_page_orders=new tb_page_orders();
$tb_page_client=new tb_page_client();
$tb_page_token=new tb_page_token();
$tb_page_navegation_log=new tb_page_navegation_log();
$tb_dna_clients=new tb_dna_clients();
$tb_page_link=new tb_page_link();


$page_domain=str_replace("www.","",$_SERVER['HTTP_HOST']);
	$page_seccion=$_SERVER['REQUEST_URI'];
	if($page_seccion[strlen($page_seccion)-1]!="/"){
	$page_seccion=$page_seccion."/";
	}
	if($tb_page_domain->math("COUNT","domain='".$page_domain."'")>=1){
		if($tb_page_division->math("COUNT","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'")==1){	
				$country="";
				
				$page_seccion=$page_seccion;
				
				if(explode("?",$page_seccion)){
				$page_seccion=explode("?",$page_seccion);
				$page_seccion=$page_seccion[0];
				}
				
				$logo=$tb_page_division->obtenerDato("logo","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'");
				$physical_address=$tb_page_division->obtenerDato("physical_address","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'");
				$google_analytics=$tb_page_division->obtenerDato("google_analytics","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'");
				
				$domain_id=$tb_page_domain->obtenerDato("domain_id","domain='$page_domain'");
				
				
				$link_core=$tb_page_domain->obtenerDato("link_core","domain='$page_domain'");
				$core_company_id=$tb_page_domain->obtenerDato("core_company_id","domain='$page_domain'");
				
				$division_id=$tb_page_division->obtenerDato("division_id","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'");
				$link_id=$tb_page_link->obtenerDato("link_id","url='$page_seccion'");
				
				
				$page_title= utf8_encode($tb_page_division_link_seo->obtenerDato("title","division_id='$division_id' AND link_id='".$tb_page_link->obtenerDato("link_id","url='$page_seccion'")."'"));
				$page_description=utf8_encode($tb_page_division_link_seo->obtenerDato("meta_description","division_id='$division_id' AND link_id='".$tb_page_link->obtenerDato("link_id","url='$page_seccion'")."'"));
				$page_keywords=utf8_encode($tb_page_division_link_seo->obtenerDato("meta_keywords","division_id='$division_id' AND link_id='".$tb_page_link->obtenerDato("link_id","url='$page_seccion'")."'"));
				$pageToShow="site.php";
			}
			 
		if($tb_page_division->math("COUNT","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'")>=2){
			
				$country=explode("/",$page_seccion);
				if($country[1]!=""){
					if($tb_page_division->math("COUNT","country='$country[1]'")>0){
						$country=$tb_page_division->obtenerDato("country","country='$country[1]'");
						
						
						$page_seccion=explode($country,$page_seccion);
						$page_seccion=$page_seccion[1];
						if(explode("?",$page_seccion)){
							$page_seccion=explode("?",$page_seccion);
							$page_seccion=$page_seccion[0];
						
						}
						
						
						$logo=$tb_page_division->obtenerDato("logo","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."' AND country='$country'");
						
						$physical_address=$tb_page_division->obtenerDato("physical_address","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'");
						$google_analytics=$tb_page_division->obtenerDato("google_analytics","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."'");
						$domain_id=$tb_page_domain->obtenerDato("domain_id","domain='$page_domain'");
						
						
						$link_core=$tb_page_domain->obtenerDato("link_core","domain='".$page_domain."'");
						$core_company_id=$tb_page_domain->obtenerDato("core_company_id","domain='$page_domain'");
						
						$division_id= $tb_page_division->obtenerDato("division_id","domain_id='".$tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'")."' AND country='$country'"); 	
						$link_id=$tb_page_link->obtenerDato("link_id","url='$page_seccion'");
						$google_analytics=$tb_page_division->obtenerDato("google_analytics","division_id=".$division_id);
					
						$page_title= utf8_encode($tb_page_division_link_seo->obtenerDato("title","division_id='$division_id' AND link_id='".$tb_page_link->obtenerDato("link_id","url='$page_seccion'")."'"));
						$page_description=utf8_encode($tb_page_division_link_seo->obtenerDato("meta_description","division_id='$division_id' AND link_id='".$tb_page_link->obtenerDato("link_id","url='$page_seccion'")."'"));
						$page_keywords=utf8_encode($tb_page_division_link_seo->obtenerDato("meta_keywords","division_id='$division_id' AND link_id='".$tb_page_link->obtenerDato("link_id","url='$page_seccion'")."'"));
						$pageToShow="site.php";
					} else { echo "seccion inaccesible include(map_site.php); "; }
				}else { $pageToShow= "latam_map.php"; }
				
				
			}
	} else {
		echo "El dominio <strong>$page_domain</strong> no está dado de alta en la tabla de la base de datos. Por favor agréguelo en la tabla: <strong>tb_page_domain</strong>";
}

$_SESSION['country']=$country;
$_SESSION['page_seccion']=$page_seccion;
$_SESSION['domain_id']=$domain_id;
$_SESSION['division_id']=$division_id;
$_SESSION['core_company_id']=$core_company_id;
$_SESSION['link_id']=$link_id;
if(isset($_SESSION['visit_key'])){
	if($tb_page_client->math("COUNT","visit_key='".$_SESSION['visit_key']."'")<=0){
		//if($_SESSION['domain_id']!=0 && $_SESSION['division_id']!=0){
			if($_SERVER['HTTP_REFERER']!=""){ $previous_page=$_SERVER['HTTP_REFERER']; }else { $previous_page="direct";}
			$tb_page_client->insert($previous_page,$_SESSION['visit_key'],$_SESSION['domain_id'],$_SESSION['division_id']);
			$_SESSION['client_id']=$tb_page_client->obtenerDato("client_id","visit_key='".$_SESSION['visit_key']."'");
		//}
	}else{
		$_SESSION['client_id']=$tb_page_client->obtenerDato("client_id","visit_key='".$_SESSION['visit_key']."'");
	}
}

// AGREGADO POR ARTURO LEON 14/02/2012
	//Verificamos que estemos recibiendo parametros get
	if($_GET['division'] && $_GET['campaign']){
		include_once("controller/Connections/db_connection_core.php");
			require('lib/autobahn.php');
			$query = Autobahn::getConnection('default');
			//Consultamos el ID de cliente
			$client = $query->findTbPageClientByVisitKey($_SESSION['visit_key']);
			$client_id = $client['0']['tb_page_client']['client_id'];
			//insertamos la info a la tabla tb_page_sem
			$query->insertTbPageSem(array('id' => null,'division' => $_GET['division'],'campaign' => $_GET['campaign'], 'campaigntype' => $_GET['campaigntype'], 'channel' => $_GET['channel'],'service' => $_GET['service'], 'client_id' => $client['0']['tb_page_client']['client_id']));
		}

// FIN AGREGADO POR ARTURO LEON
$page_title = (trim($page_title) == "" ? "HostDime" : $page_title);
?>
<title><?=$page_title; ?></title>
<link rel="shortcut icon" href="/favicon.ico" />
<meta name="description" content="<?=$page_description; ?>" />
<meta name="keywords" content="<?=$page_keywords; ?>" />
<base href="http://<?=$page_domain; ?>" /> 

<link rel="stylesheet" type="text/css" media="all" href="style.css" />
<?=$google_analytics;?>
<!-- Inicia Analitycs Account HDCastellano -->
<? /* CODIGO ANTERIOR
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26922527-18']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
*/
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29265437-1']);
  _gaq.push(['_setDomainName', 'hostdime.la']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Finaliza Analitycs Account HDCastellano -->
<script src="jquery-latest.js"></script>
<script src="ajax.js"></script>
</head>
<body>

<div style="height:100%; width:100%; background-color:#000; position:fixed; z-index:7;alpha(opacity=60);-moz-opacity:.60;opacity:.60; display:none;" id="bg_opacity_global" onclick="javascript:show_hide_opacity('hide');shoppingcar_visibility('hide');"></div>
<script type="text/javascript">
        function show_hide_opacity(action){
                if(action=="show"){
                    document.getElementById('bg_opacity_global').style.display="block";
					}
                if(action=="hide"){
                    document.getElementById('bg_opacity_global').style.display="none";
                    }
        }
		
</script>

<?
// Hace que se ponga obscuro el fondo de la pantalla.
if(isset($_GET['opacity'])){
	if($_GET['opacity']==true){
		?>
		<script type="text/javascript">
			show_hide_opacity('show');
		</script>
<? } 
} ?>
<? if(isset($pageToShow))
	include($pageToShow);

if($_SESSION['page_seccion']!="/favicon.ico/" && $_SESSION['client_id']!=0)
$tb_page_navegation_log->insert($_SESSION['client_id'],$_SESSION['page_seccion']);

?>
</body>
</html>