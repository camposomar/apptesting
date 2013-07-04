<? 
function check_domain($name,$tld){
		$name = str_replace('www.','',$name);
		$ch = curl_init("https://core.hostdime.com.mx/purchasedomain/check/?sld=$name&tld=$tld");
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
		curl_setopt($ch, CURLOPT_TIMEOUT,20);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data=curl_exec($ch);
		//curl_close($ch); // AÑADIDO POR ARTUROLEON 17/02/2012 PARA LIBERAR RECURSOS
		if($data==='1'){
			return true;
		}else{
			return false;	
		}
	}

?>
