<?
$insert_action=false; 
if(isset($_GET['token_key']) && 
	isset($_GET['car_action']) && 
	isset($_GET['service_type']) && 
	isset($_GET['service_id']) && 
	isset($_GET['cicle_type'])){
		
		$token_key=strip_tags($_GET['token_key']);
		$car_action=strip_tags($_GET['car_action']);
		$service_type=strip_tags($_GET['service_type']);
		$service_id=strip_tags($_GET['service_id']);
		$cicle_type=strip_tags($_GET['cicle_type']);
		
		if(isset($_GET['note_1'])){
			$note_1=trim(strip_tags($_GET['note_1']));
			}else{
				$note_1="";
				}
		if(isset($_GET['note_2'])){
			$note_2=trim(strip_tags($_GET['note_2']));
			}else{
				$note_2="";
				}
		
		
		
	if($tb_page_token->math("COUNT","token_key='$token_key' AND status='available'")>0){
		if($service_type=="windows_shared" || $service_type=="linux_shared" || $service_type=="linux_reseller" || $service_type=="windows_reseller" || $service_type=="streaming_shared" || $service_type=="streaming_reseller"){
			
			
			if($cicle_type=="monthly"){
					if($service_type=="windows_shared" || $service_type=="linux_shared" || $service_type=="linux_reseller" || $service_type=="windows_reseller"){
						$price_cicle=$tb_page_hosting_package->obtenerDato("monthly_price","package_id=$service_id")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
						$pack_name=$tb_page_hosting_package->obtenerDato("name","package_id=$service_id");
						//Si la tld esta en nuestra tabla, revisar el precio, de acuerdo a la división.
						if($tb_page_tdl_domain->math("COUNT","tld='$note_2'")>0){
										//Comprobar la disponiblidad del dominio. Si el dominio está disponible agregarlo, primero se debe limpiar espacios y codigo malicioso. 
										$ch = curl_init("https://core.hostdime.com.mx/purchasedomain/check/sld/$note_1/tld/$note_2");
										curl_setopt($ch, CURLOPT_HEADER,0);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
										curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
										curl_setopt($ch, CURLOPT_TIMEOUT,20);
										$data=curl_exec($ch);
										if($data==1){
											 $datenext_renew=(1+date("Y")).date("-m").date("-d");
											 $first_date_prorate_of=date("Y-m-d");
											 $first_date_prorate_to=(1+date("Y")).date("-m").date("-d");
											 $price_prorate=$tb_page_tdl_domain->obtenerDato("registry_1year","tld='$note_2'")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
											 $signupdate_less26="NO";
											$tb_page_orders->insert($_SESSION['client_id'],"","in_car","domain-registry","Registro","yearly",date("Y-m-d"),date("H:i:s"),$tb_page_tdl_domain->obtenerDato("registry_1year","tld='$note_2'")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),$datenext_renew,$first_date_prorate_of,$first_date_prorate_to,$price_prorate,$signupdate_less26,"","","",$note_1.".".$note_2,"auto-agregado");
											}
							}
						
						
						$note_1=$note_1.".".$note_2;
						$note_2="";
					}
					if($service_type=="streaming_shared" || $service_type=="streaming_reseller"){
						$price_cicle=$tb_page_streaming_package->obtenerDato("monthly_price","package_id=$service_id")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
						$pack_name=$tb_page_streaming_package->obtenerDato("name","package_id=$service_id");
						$note_1=$note_1;
						}
				
				$price_per_day=$price_cicle/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
				// inicia if fecha menos a dia 25 del mes
				if(date("d")<25){
					$second_prorate_quantity=0;
					$first_date_prorate_of=date("Y-m-d");
					$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
					$signupdate_less26="NO";
					$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d")))*$price_per_day;
					$datenext_renew=date("Y-m-d");
					if(date("m")<=11){
						$datenext_renew=date("Y")."-".(1+date("m"))."-01";
					}
					else{
						$datenext_renew=1+date("Y")."-01-01";
					}
				}
				// finaliza if fecha menos a dia 25 del mes
				
				// inicia if fecha Mayor o Igual a dia 26 del mes
				if(date("d")>=25){
					$second_prorate_quantity=$price_cicle;
					$first_date_prorate_of=date("Y-m-d");
					$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
					$signupdate_less26="YES";
					$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d")))*$price_per_day;
					
					if(date("m")<=11){
						$datenext_renew=date("Y")."-".(1+date("m"))."-01";
						// segundo rango de fechas prorate
						if(date("m")==11){
							$second_date_prorate_of=date("Y")."-".(1+date("m"))."-01";
							$second_date_prorate_to=date("Y")."-".(1+date("m"))."-".cal_days_in_month(CAL_GREGORIAN,(1+date("m")),date("Y"));
							$datenext_renew=1+date("Y")."-01-01";
							
						}else {
							$second_date_prorate_of=date("Y")."-".(1+date("m"))."-01";
							$second_date_prorate_to=date("Y")."-".(1+date("m"))."-".cal_days_in_month(CAL_GREGORIAN,(1+date("m")),date("Y"));
							$datenext_renew=date("Y")."-".(date("m")+2)."-01";
							}
					}
					else{
						$second_date_prorate_of=1+date("Y")."-01"."-01";
						$second_date_prorate_to=1+date("Y")."-01-".cal_days_in_month(CAL_GREGORIAN,("01"),1+date("Y"));
						$datenext_renew=1+date("Y")."-02-01";
					}
				}
				// finaliza if fecha Mayor o Igual a dia 26 del mes
				
			}
			if($cicle_type=="yearly"){
				if($service_type=="windows_shared" || $service_type=="linux_shared" || $service_type=="linux_reseller" || $service_type=="windows_reseller"){
					$price_cicle=$tb_page_hosting_package->obtenerDato("yearly_price","package_id=$service_id")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
					$pack_name=$tb_page_hosting_package->obtenerDato("name","package_id=$service_id");
					//Si la tld esta en nuestra tabla, revisar el precio, de acuerdo a la división.
						if($tb_page_tdl_domain->math("COUNT","tld='$note_2'")>0){
										//Comprobar la disponiblidad del dominio. Si el dominio está disponible agregarlo, primero se debe limpiar espacios y codigo malicioso. 
										$ch = curl_init("https://core.hostdime.com.mx/purchasedomain/check/sld/$note_1/tld/$note_2");
										curl_setopt($ch, CURLOPT_HEADER,0);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
										curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
										curl_setopt($ch, CURLOPT_TIMEOUT,20);
										$data=curl_exec($ch);
										if($data==1){
											 $datenext_renew=(1+date("Y")).date("-m").date("-d");
											 $first_date_prorate_of=date("Y-m-d");
											 $first_date_prorate_to=(1+date("Y")).date("-m").date("-d");
											 $price_prorate=$tb_page_tdl_domain->obtenerDato("registry_1year","tld='$note_2'")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
											 $signupdate_less26="NO";
											$tb_page_orders->insert($_SESSION['client_id'],"","in_car","domain-registry","Registro","yearly",date("Y-m-d"),date("H:i:s"),$tb_page_tdl_domain->obtenerDato("registry_1year","tld='$note_2'")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),$datenext_renew,$first_date_prorate_of,$first_date_prorate_to,$price_prorate,$signupdate_less26,"","","",$note_1.".".$note_2,"auto-agregado");
											}
							}
					$note_1=$note_1.".".$note_2;
					$note_2="";
				}
				if($service_type=="streaming_shared" || $service_type=="streaming_reseller"){
					$price_cicle=$tb_page_streaming_package->obtenerDato("yearly_price","package_id=$service_id")*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
					$pack_name=$tb_page_streaming_package->obtenerDato("name","package_id=$service_id");
					$note_1=$note_1;
					}
					$price_per_day=$price_cicle/12/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
					
				
					if(date("d")<26){
						$second_prorate_quantity=0;
						$first_date_prorate_of=date("Y-m-d");
						$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
						$signupdate_less26="NO";
						
						$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
						
						if(date("m")<=11){
							$datenext_renew=1+date("Y")."-".(date("m"))."-01";
							$second_date_prorate_of=date("Y")."-".(date("m")+1)."-01";
							$second_prorate_quantity=$price_cicle/12*11;
							if(date("m")==01){
								$second_date_prorate_to=date("Y")."-12-".cal_days_in_month(CAL_GREGORIAN,12,date("Y"));
								
							}else{
								$second_date_prorate_to=1+date("Y")."-".(date("m")-1)."-".cal_days_in_month(CAL_GREGORIAN,(date("m")-1),(1+date("Y")));
								}
						}
						else{
							
							$datenext_renew=1+date("Y").date("-m-")."01";
							$second_date_prorate_of=1+date("Y")."-01-01";
							$second_date_prorate_to=1+date("Y")."-".(date("m")-1)."-".cal_days_in_month(CAL_GREGORIAN,(date("m")-1),1+date("Y"));
							$second_prorate_quantity=$price_cicle/12*11;
						}
					}
					if(date("d")>=26){
						$second_prorate_quantity=0;
						$first_date_prorate_of=date("Y-m-d");
						$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
						$signupdate_less26="YES";
						
						$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
						
						if(date("m")<=11){
							$datenext_renew=1+date("Y")."-".(date("m")+1)."-01";
							$second_date_prorate_of=date("Y")."-".(date("m")+1)."-01";
							$second_prorate_quantity=$price_cicle/12*11;
							if(date("m")==01){
								$second_date_prorate_to=date("Y")."-12-".cal_days_in_month(CAL_GREGORIAN,12,date("Y"));
								
							}else{
								$second_date_prorate_to=1+date("Y")."-".(date("m"))."-".cal_days_in_month(CAL_GREGORIAN,(date("m")),(1+date("Y")));
								}
						}
						else{
							
							$datenext_renew=1+date("Y")."-01-01";
							$second_date_prorate_of=date("Y")."-01-01";
							$second_date_prorate_to=1+date("Y")."-".(date("m"))."-".cal_days_in_month(CAL_GREGORIAN,date("m"),1+date("Y"));
							$second_prorate_quantity=$price_cicle/12*11;
							
						}
					}	
				}
			
		$insert_action=true;		
		}
		if($service_type=="domain-registry"){
			  if($_GET['cicle_type']=="yearly"){
			  $price_cicle=$tb_page_tdl_domain->obtenerDato("registry_1year","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
				if(isset($_GET['whois_private'])){
						if($_GET['whois_private']=="YES"){
							 $price_cicle=($tb_page_tdl_domain->obtenerDato("registry_1year","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])) + (1*($tb_page_tdl_domain->obtenerDato("whois_private_year","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])));
							 $note_2="+ whois privado";
							}
					}
			  $datenext_renew=(1+date("Y")).date("-m").date("-d");
			  $first_date_prorate_of=date("Y-m-d");
			  $first_date_prorate_to=(1+date("Y")).date("-m").date("-d");
			  $price_prorate=$price_cicle;
			  $signupdate_less26="NO";
			  $pack_name="Registro";
			  $note_1=$note_1.".".$tb_page_tdl_domain->obtenerDato("tld","tld_id=".$service_id);
			  }
			  if($_GET['cicle_type']=="2yearly"){
			  $price_cicle=$tb_page_tdl_domain->obtenerDato("registry_2years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			  if(isset($_GET['whois_private'])){
						if($_GET['whois_private']=="YES"){
							 $price_cicle=($tb_page_tdl_domain->obtenerDato("registry_2years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])) + (2*($tb_page_tdl_domain->obtenerDato("whois_private_year","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])));
							 $note_2="+ whois privado";
							}
					}
			  $datenext_renew=(2+date("Y")).date("-m").date("-d");
			  $first_date_prorate_of=date("Y-m-d");
			  $first_date_prorate_to=(2+date("Y")).date("-m").date("-d");
			  $price_prorate=$price_cicle;
			  $signupdate_less26="NO";
			  $pack_name="Registro";
			  $note_1=$note_1.".".$tb_page_tdl_domain->obtenerDato("tld","tld_id=".$service_id);
			  
			  }
			  if($_GET['cicle_type']=="3yearly"){
			  $price_cicle=$tb_page_tdl_domain->obtenerDato("registry_3years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			  if(isset($_GET['whois_private'])){
						if($_GET['whois_private']=="YES"){
							 $price_cicle=($tb_page_tdl_domain->obtenerDato("registry_3years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])) + (3*($tb_page_tdl_domain->obtenerDato("whois_private_year","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])));
							 $note_2="+ whois privado";
							}
					}
			  $datenext_renew=(3+date("Y")).date("-m").date("-d");
			  $first_date_prorate_of=date("Y-m-d");
			  $first_date_prorate_to=(3+date("Y")).date("-m").date("-d");
			  $price_prorate=$price_cicle;
			  $signupdate_less26="NO";
			  $pack_name="Registro";
			  $note_1=$note_1.".".$tb_page_tdl_domain->obtenerDato("tld","tld_id=".$service_id);
			  }
			  if($_GET['cicle_type']=="4yearly"){
			  $price_cicle=$tb_page_tdl_domain->obtenerDato("registry_4years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			  if(isset($_GET['whois_private'])){
						if($_GET['whois_private']=="YES"){
							 $price_cicle=($tb_page_tdl_domain->obtenerDato("registry_4years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])) + (4*($tb_page_tdl_domain->obtenerDato("whois_private_year","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])));
							 $note_2="+ whois privado";
							}
					}
			  $datenext_renew=(4+date("Y")).date("-m").date("-d");
			  $first_date_prorate_of=date("Y-m-d");
			  $first_date_prorate_to=(4+date("Y")).date("-m").date("-d");
			  $price_prorate=$price_cicle;
			  $signupdate_less26="NO";
			  $pack_name="Registro";
			  $note_1=$note_1.".".$tb_page_tdl_domain->obtenerDato("tld","tld_id=".$service_id);
			  }
			  if($_GET['cicle_type']=="5yearly"){
			  $price_cicle=$tb_page_tdl_domain->obtenerDato("registry_5years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']);
			  if(isset($_GET['whois_private'])){
						if($_GET['whois_private']=="YES"){
							 $price_cicle=($tb_page_tdl_domain->obtenerDato("registry_5years","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])) + (5*($tb_page_tdl_domain->obtenerDato("whois_private_year","tld_id=".$service_id)*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_SESSION['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])));
							 $note_2="+ whois privado";
							 
							}
					}
			  $datenext_renew=(5+date("Y")).date("-m").date("-d");
			  $first_date_prorate_of=date("Y-m-d");
			  $first_date_prorate_to=(5+date("Y")).date("-m").date("-d");
			  $price_prorate=$price_cicle;
			  $pack_name="Registro";
			  $note_1=$note_1.".".$tb_page_tdl_domain->obtenerDato("tld","tld_id=".$service_id);
			  }
			  
			  $insert_action=true;
			  
			}
		
		if($insert_action==true){
		//============
		$tb_page_orders->insert($_SESSION['client_id'],"","in_car",$service_type,$pack_name,$cicle_type,date("Y-m-d"),date("H:i:s"),$price_cicle,$datenext_renew,$first_date_prorate_of,$first_date_prorate_to,$price_prorate,$signupdate_less26,$second_date_prorate_of,$second_date_prorate_to,$second_prorate_quantity,$note_1,$note_2);
		$tb_page_token->delete("token_key='".$_GET['token_key']."'");
		$tb_page_token->insert(md5(date("Y.m.d.H.i.s.")).rand(1,10000),"available");
		//=============		
		}
	}
}
		
?>
