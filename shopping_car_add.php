<? 
// Inicia : { Si las variables GET están puestas}
if(isset($_GET['token_key']) && isset($_GET['car_action']) && isset($_GET['package_id']) && isset($_GET['cycle_type']) && isset($_GET['service_type'])){
	//Se elimina HTML-Code	
		$token_key=strip_tags($_GET['token_key']);
		$car_action=strip_tags($_GET['car_action']);
		$package_id=strip_tags($_GET['package_id']);
		$cicle_type=strip_tags($_GET['cycle_type']);
		$service_type=strip_tags($_GET['service_type']);
		$note_1=trim(strip_tags($_GET['note_1']));
		$note_2=trim(strip_tags($_GET['note_2']));
	// Inicia: Si { el token_key se encuentra en nuestra base de datos }	
	if($tb_page_token->math("COUNT","token_key='$token_key' AND status='available'")>0){
		// Inicia: Si { el tipo de servicio es categoría HOSTING, es decir, que no son DOMINIOS. }
		// Inician Cálculos dependiendo el Ciclo que el cliente eligió.
			switch($cicle_type){
					case "monthly":{
						$cycle_monthly=build_cycle_monthly($tb_core_packages->obtenerDato("price_monthly","package_id=".$package_id)*
									   $tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']));
						$price_renew=$tb_core_packages->obtenerDato("price_monthly","package_id=".$package_id)*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
						$datenext_renew=$cycle_monthly['datenext_renew'];
						$first_date_prorate_of=$cycle_monthly['first_date_prorate_of'];
						$first_date_prorate_to=$cycle_monthly['first_date_prorate_to'];
						$first_prorate_quantity=$cycle_monthly['first_prorate_quantity'];
						$price_prorate=$cycle_monthly['price_prorate'];
						$signupdate_less26=$cycle_monthly['signupdate_less26'];
						$second_date_prorate_of=$cycle_monthly['second_date_prorate_of'];
						$second_date_prorate_to=$cycle_monthly['second_date_prorate_to'];
						$second_prorate_quantity=$cycle_monthly['second_prorate_quantity'];
						
					break;
					}
				case "yearly":{
						$cycle_yearly=build_cycle_yearly($tb_core_packages->obtenerDato("price_yearly","package_id=".$package_id)*
									   $tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']));
						$price_renew=$tb_core_packages->obtenerDato("price_yearly","package_id=".$package_id)*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
						$datenext_renew=$cycle_yearly['datenext_renew'];
						$first_date_prorate_of=$cycle_yearly['first_date_prorate_of'];
						$first_date_prorate_to=$cycle_yearly['first_date_prorate_to'];
						$first_prorate_quantity=$cycle_yearly['first_prorate_quantity'];
						$price_prorate=$cycle_yearly['price_prorate'];
						$signupdate_less26=$cycle_yearly['signupdate_less26'];
						$second_date_prorate_of=$cycle_yearly['second_date_prorate_of'];
						$second_date_prorate_to=$cycle_yearly['second_date_prorate_to'];
						$second_prorate_quantity=$cycle_yearly['second_prorate_quantity'];
					break;
					}	
				}
				
				
			if($service_type=="windows_shared" || $service_type=="linux_shared" || $service_type=="linux_reseller" || $service_type=="windows_reseller"){
				$note_1 = str_replace(' ','',trim($note_1));
				$campo_extra = '';	
				// Inserta el Pedido, en la tabla de Ordenes de HOSTING ya sea Reseller o Shared, Windows o Linux
				//PROMOCION
				/*
				if($service_type=="windows_shared" || $service_type=="linux_shared"){
					$first_prorate_quantity = $first_prorate_quantity * 0.80;
					$second_prorate_quantity = $second_prorate_quantity * 0.80;
					$price_renew = $price_renew;
					$campo_extra = '<span style="color:red;">20% de descuento</span>';
				}
				if($service_type=="linux_reseller" || $service_type=="windows_reseller"){
					$first_prorate_quantity = $first_prorate_quantity * 0.80;
					$second_prorate_quantity = $second_prorate_quantity * 0.80;
					$price_renew = $price_renew;
					$campo_extra = '<span style="color:red;">20% de descuento</span>';
				}*/
				
				$tb_page_orders->insert($_SESSION['client_id'],$package_id,"in_car",$service_type,$tb_core_packages->obtenerDato("name","package_id=".$package_id),$cicle_type,date("Y-m-d"),
										date("H:i:s"),$price_renew,$datenext_renew,$first_date_prorate_of,$first_date_prorate_to,$first_prorate_quantity,$signupdate_less26,$second_date_prorate_of,
										$second_date_prorate_to,$second_prorate_quantity,($note_1.".".$note_2),$campo_extra);
										
				
				// Verificamos si la TLD que puso el usuario la Ofrecemos
				if($tb_core_tld->math("COUNT","tld='$note_2' AND company_id='$_SESSION[core_company_id]'")>0)	{
					// Verificamos si el dominio está disponible
						if(check_domain($note_1,$note_2)){
							// Usamos la function:build_cycle_domain para calcular fechas de renovaciones y precios
							$cycle_domain=build_cycle_domain(1,$tb_core_tld->obtenerDato("tld_price_new","tld='$note_2' AND company_id='$_SESSION[core_company_id]'")*
										$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']));
							$first_prorate_quantity=$cycle_domain['first_prorate_quantity'];
							$datenext_renew=$cycle_domain['datenext_renew'];
							// Insertamos en la tabla la orden de dominio
							$tb_page_orders->insert($_SESSION['client_id'],$tb_core_tld->obtenerDato("tld_id","tld='$note_2' AND company_id='$_SESSION[core_company_id]'"),"in_car","domain-registry","Registro","yearly",date("Y-m-d"),date("H:i:s"),$tb_core_tld->obtenerDato("tld_price_renew","tld='$note_2' AND company_id='$_SESSION[core_company_id]'")*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),$datenext_renew,date("Y-m-d"),$datenext_renew,$first_prorate_quantity,"NO","","","",($note_1.".".$note_2),"auto-agregado");
							}
					}				
				// Destruye y Construye un Nuevo token_key
				$tb_page_token->delete("token_key='".$_GET['token_key']."'");
				$tb_page_token->insert(md5(date("Y.m.d.H.i.s.")).rand(1,10000),"available");						
			}// Finaliza: Si { el tipo de servicio es categoría HOSTING, es decir, que no son DOMINIOS. }
		
		
		// Inicia: Si { el tipo de servicio es categoría Streaming }
		if($service_type=="streaming_shared" || $service_type=="streaming_reseller"){
			//PROMOCION
			$campo_extra = '';
			/*
			if($service_type=="streaming_shared"){
					$first_prorate_quantity = $first_prorate_quantity * 0.80;
					$second_prorate_quantity = $second_prorate_quantity * 0.80;
					$price_renew = $price_renew*0.80;
					$campo_extra = '<span style="color:red;">20% de descuento</span>';
				}
				if($service_type=="streaming_reseller"){
					$first_prorate_quantity = $first_prorate_quantity * 0.85;
					$second_prorate_quantity = $second_prorate_quantity * 0.85;
					$price_renew = $price_renew*0.85;
					$campo_extra = '<span style="color:red;">15% de descuento</span>';
				}
				*/
			// Inserta el Pedido, en la tabla de Ordenes de HOSTING ya sea Reseller o Shared, Windows o Linux
				$tb_page_orders->insert($_SESSION['client_id'],$package_id,"in_car",$service_type,$tb_core_packages->obtenerDato("name","package_id=".$package_id),$cicle_type,date("Y-m-d"),
										date("H:i:s"),$price_renew,$datenext_renew,$first_date_prorate_of,$first_date_prorate_to,$first_prorate_quantity,$signupdate_less26,$second_date_prorate_of,
										$second_date_prorate_to,$second_prorate_quantity,$note_1,$campo_extra);	
			}
		// Finaliza: Si { el tipo de servicio es categoría Streaming }
		
		// Inicia: Si { el tipo de servicio es categoría Dominio }
		if($service_type=="domain-registry"){
			$price_cicle = $tb_core_tld->obtenerDato("tld_price_new","tld='$note_2' AND company_id='$_SESSION[core_company_id]'")*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			if($cicle_type != 1){
				$periodo = $cicle_type.'yearly';
				$price_cicle = $price_cicle*$cicle_type;
				$datenext_renew = date("Y-m-d",strtotime(date("Y-m-d", strtotime( date("Y-m-d"))) . " +".$cicle_type." year"));
			}else{
				$periodo = 'yearly';
				$datenext_renew = date("Y-m-d",strtotime(date("Y-m-d", strtotime( date("Y-m-d"))) . " +1 year"));
			}
			
			$tb_page_orders->insert($_SESSION['client_id'],$tb_core_tld->obtenerDato("tld_id","tld='$note_2' AND company_id='$_SESSION[core_company_id]'"),"in_car","domain-registry","Registro",$periodo,date("Y-m-d"),date("H:i:s"),$price_cicle,$datenext_renew,date("Y-m-d"),$datenext_renew,$price_cicle,"NO","","","",($note_1.".".$note_2),"");
			// DESTRUIMOS Y GENERAMOS NUEVO TOKEN
			$tb_page_token->delete("token_key='".$_GET['token_key']."'");
			$tb_page_token->insert(md5(date("Y.m.d.H.i.s.")).rand(1,10000),"available");	
		}
		// Finaliza: Si { el tipo de servicio es categoría Dominio }
		
		
	}// Finaliza: Si { el token_key se encuentra en nuestra base de datos }	
}// Finaliza : { Si las variables GET están puestas}
?>