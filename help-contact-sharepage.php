<? 
if(isset($_POST['your_name']) && isset($_POST['your_email']) && isset($_POST['other_name']) && isset($_POST['other_email']) && isset($_POST['msg'])){
	
		$your_name=trim($_POST['your_name']);
		$your_email=trim($_POST['your_email']);
		
		$other_name=trim($_POST['other_name']);
		$other_email=trim($_POST['other_email']);
		
		$msg=trim($_POST['msg']);
		
		
		if($your_name!="" && $your_email!="" && $other_name!="" && $other_email!="" && $msg!=""){
			$your_name=utf8_encode(strip_tags($_POST['your_name']));
			$your_email=utf8_encode(strip_tags($_POST['your_email']));
			
			$other_name=utf8_encode(strip_tags($_POST['other_name']));
			$other_email=utf8_encode(strip_tags($_POST['other_email']));
			
			$msg=utf8_encode(strip_tags($_POST['msg']));
			
		$msg="
			<div style=\"margin:0 auto 0 auto;width:660px; overflow:hidden; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;\">
				<div style=\"border-bottom:solid 1px #CCC; overflow:hidden; padding:7px;\"><img src=\"http://hostdime.com.mx/images/logo_mx.png\" align=\"\" /></div>
				<div style=\"margin-top:25px;\">Hola $other_name</div>
				<div>Tu amigo $your_name</div>
				<div style=\"margin-bottom:20px; font-size:14px;\"> Te ha recomendado visitar <a href=\"http://$page_domain\"> www.$page_domain</a>, HostDime es una compa&ntilde;ia l&iacute;der mundial como provedor de web hosting y dominios, adem&aacute;s de otras soluciones en Internet.</div>
				  <div style=\"margin-left:50px; color:#666;  line-height:24px; font-size:12px;\">  
					<div> &#8226; Registro de dominios </div>
					<div> &#8226; Web hosting compartido Linux </div>
					<div> &#8226; Web hosting compartido Windows </div>
					<div> &#8226; Web hosting Revendedor Linux </div>
					<div> &#8226; Web hosting Revendedor Windows </div>
					<div> &#8226; Web hosting VPS Linux </div>
					<div> &#8226; Web hosting VPS Windows </div>
					<div> &#8226; Servidores Dedicados </div>
					<div> &#8226; Streaming audio Personal</div>
					<div> &#8226; Streaming audio Revendedor</div>
					<div> &#8226; y mucho más...</div>
				  </div>
				  <div style=\"border:solid 1px #CCC; margin:10px; background-color:#FBFBFB; padding-left:10px; font-size:12px;\">Tu amigo escribi&oacute;: $msg</div>
				  <div style=\"text-align:center;\"><a href=\"http://$page_domain\"><img src=\"http://$page_domain/images/btn_visit_site.png\" alt=\"\" style=\"borde:none;\" /></a></div>
				  <div style=\"margin-top:30px; font-size:12px; border-top:solid 1px #F93;\">Sinceramente</div>
				  <div style=\"font-size:12px; color:#F60;\">HostDime Inc.</div>
				 
				
			</div>";

			
			$cabeceras = "From: $your_name <$your_email>\r\n";
			$cabeceras.= "Reply-To: $your_name <$your_email>\r\nContent-type: text/html\r\n";
							
				if(mail($other_email,"$other_name, $your_name te recomendó visitar HostDime",$msg,$cabeceras)){
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