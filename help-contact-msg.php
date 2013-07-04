<? 

if($tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'") == 1){
	//HDMX
	$correo_atencion = "core.desk@hostdime.com.mx";
}else if($tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'") == 3){
	//HDES
	$correo_atencion = "core.desk@hostdime.com.es";
}else{
	//HDLA
	$correo_atencion = "core.desk@hostdime.la";
}

if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['msg'])){
	
		$nombre=trim($_POST['nombre']);
		$email=trim($_POST['email']);
		$msg=trim($_POST['msg']);
		
		
		if($nombre!="" && $email!="" && $msg!=""){
			$nombre=utf8_encode(strip_tags($_POST['nombre']));
			$email=utf8_encode(strip_tags($_POST['email']));
			$msg=utf8_encode(strip_tags($_POST['msg']));
			$cabeceras = "From: $nombre <$email>\r\n";
			$cabeceras.= "Reply-To: $nombre <$email>\r\n";
							
				if(mail($correo_atencion,"Contacto Desde Formulario de Sitio",$msg,$cabeceras)){
					$msgResult="Correo electrónico enviado correctamente... Muchas gracias por contactarnos...";
				}else {
					$msgResult="Hay un error en el envio...";
				}
			}else {
				
				$msgResult="Algunos de los datos están vacios";
				}
	
	}else {
		$msgResult="No ha llenado el formulario con los datos completos";
		}


?>

<div style="margin:0 auto 0 auto; width:800px; border:solid 1px #CCC; background-color:#F7F7F7; padding:15px; font-size:12px; margin-top:30px; margin-bottom:30px;">
	<?=$msgResult; ?>
</div>