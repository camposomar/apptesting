<? 

$htmlCode_head="
<div style=\"height:30px; background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px; margin:7px; margin-top:3px;\" class=\"redondeo5px\"> 
    	Resumen de tu &oacute;rden</div>
      	<div style=\"border-bottom:solid 1px #CCC; overflow:hidden; background-color:#F6F6F6; padding-top:5px; padding-bottom:5px; margin-bottom:10px; margin-left:10px; margin-right:10px;\">
            	<div style=\"border-right:solid 1px #CCC;float:left;font-weight:800;width:180px;margin-left:15px;\"> Servicio</div>
               	<div style=\"border-right:solid 1px #CCC;float:left;font-weight:800;width:70px;margin-left:15px;\"> Ciclo </div>
                <div style=\"border-right:solid 1px #CCC;float:left;font-weight:800;width:230px;margin-left:15px;\"> ¿Tiempo que pagaré?</div>
                <div style=\"border-right:solid 1px #CCC;float:left;font-weight:800;width:180px;margin-left:15px;\"> Mi siguiente pago</div>
                
        </div>";
		
		$list_orders=$tb_page_orders->select("order_id,order_status,service_type,price_cicle,service_name,cicle_type,first_date_prorate_of,first_date_prorate_to,first_prorate_quantity,signupdate_less26,second_date_prorate_of,second_date_prorate_to,second_prorate_quantity,datenext_renew,note_1,note_2","order_status='in_car' AND client_id=".$_SESSION['client_id']);
		$row_orders=mysql_fetch_assoc($list_orders);
		$amounttopay=0;
		$htmlCode="";
		do {
		 $htmlCode=$htmlCode."
        <div style=\"border-bottom:solid 1px #EEE; overflow:hidden;margin-bottom:10px; padding-top:5px;margin-left:10px; margin-right:10px;\">
            	<div style=\"border-right:solid 1px #CCC;float:left;width:180px;margin-left:15px; font-size:11px;\">
					<div style=\"float:left; margin-right:2px;\">"; ?><? 
						if($row_orders['service_type']=="windows_shared" || $row_orders['service_type']=="windows_reseller"){ 
                       		 	$htmlCode=$htmlCode."<img src=\"http://hostdime.com.mx/images/icon_windows.png\" alt=\"\" />";
						 }
						if($row_orders['service_type']=="linux_shared" || $row_orders['service_type']=="linux_reseller"){ 
					 			$htmlCode=$htmlCode."<img src=\"http://hostdime.com.mx/images/icon_linux.png\" alt=\"\"  />";	
						}
						if($row_orders['service_type']=="streaming_shared" || $row_orders['service_type']=="streaming_reseller"){ 
                        		$htmlCode=$htmlCode."<img src=\"http://hostdime.com.mx/images/icon_streaming_shared.png\" alt=\"\"  />";	
						 }
						if($row_orders['service_type']=="domain-registry"){ 
                        		$htmlCode=$htmlCode."<img src=\"http://hostdime.com.mx/images/icon_settings.png\" alt=\"\"  />";	
						 }
                        
                    $htmlCode=$htmlCode."
					</div>
                    <div style=\"float:left;\">	
						<strong style=\"font-size:14px; color:#F60;\">
						$row_orders[service_name]</strong>
                        <br />
                        $row_orders[note_1]
						<br />
						<strong>$row_orders[note_2]</strong>
                    </div>
                </div>
             	<div style=\"border-right:solid 1px #CCC;float:left;width:70px;margin-left:15px; color:#000; font-weight:700;\">";
				if($row_orders['cicle_type']=="yearly") 
				$htmlCode=$htmlCode."Anual";
				if($row_orders['cicle_type']=="2yearly") 
				$htmlCode=$htmlCode."2 Años";
				if($row_orders['cicle_type']=="3yearly") 
				$htmlCode=$htmlCode."3 Años";
				if($row_orders['cicle_type']=="4yearly") 
				$htmlCode=$htmlCode."4 Años";
				if($row_orders['cicle_type']=="5yearly") 
				$htmlCode=$htmlCode."5 Años";
				if($row_orders['cicle_type']=="6yearly") 
				$htmlCode=$htmlCode."6 Años";
				if($row_orders['cicle_type']=="7yearly") 
				$htmlCode=$htmlCode."7 Años";
				if($row_orders['cicle_type']=="8yearly") 
				$htmlCode=$htmlCode."8 Años";
				if($row_orders['cicle_type']=="9yearly") 
				$htmlCode=$htmlCode."9 Años";
				if($row_orders['cicle_type']=="10yearly") 
				$htmlCode=$htmlCode."10 Años";
				if($row_orders['cicle_type']=="monthly") 
				$htmlCode=$htmlCode."Mensual";
                
				$htmlCode=$htmlCode."</div>
                <div style=\"border-right:solid 1px #CCC;float:left;width:220px;margin-left:15px; font-size:11px; padding-right:10px;\">
                	<div style=\"overflow:hidden; border-bottom:solid 1px #F0F0F0;margin-bottom:5px; padding-bottom:3px;\">
                        <div style=\"overflow:hidden; float:left;\">
                            <div style=\"color:#06C; font-weight:700;\">del ".converdate($row_orders['first_date_prorate_of'])."</div>
                            <div>al ".converdate($row_orders['first_date_prorate_to'])."</div>
                        </div>
                        <div style=\"overflow:hidden; float:right; font-size:12px; color:#F00;\">
                             $".number_format($row_orders['first_prorate_quantity'],2)." ".$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'")."
                        </div>
                   </div>";
                   if($row_orders['signupdate_less26']=="YES" && $row_orders['cicle_type']=="monthly") {
					   $htmlCode=$htmlCode."<div style=\"overflow:hidden;margin-bottom:5px;\">
                    	<div style=\"overflow:hidden; float:left;\">
                        	<div style=\"color:#06C; font-weight:700;\">del ".converdate($row_orders['second_date_prorate_of'])."</div>
                    		<div>al ".converdate($row_orders['second_date_prorate_to'])."</div> 
                        </div>
                        <div style=\"overflow:hidden; float:right; font-size:12px; color:#F00;\">
                             $".number_format($row_orders['second_prorate_quantity'],2)." ".$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'")."
                        </div>       
                    </div>";    
                   } ?>  
                  <? if($row_orders['cicle_type']=="yearly" && $row_orders['service_type']!="domain-registry") {$htmlCode=$htmlCode."<div style=\"overflow:hidden;margin-bottom:5px;\">
                    	<div style=\"overflow:hidden; float:left;\">
                        	<div style=\"color:#06C; font-weight:700;\">del ".converdate($row_orders['second_date_prorate_of'])."</div>
                    		<div>al ".converdate($row_orders['second_date_prorate_to'])."</div> 
                        </div>
                        <div style=\"overflow:hidden; float:right; font-size:12px; color:#F00;\">
                             $".number_format($row_orders['second_prorate_quantity'],2)." ".$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'")."
                        </div>       
                    </div>"; 
                  	} ?>
                  
                  <? 
				  	if($row_orders['cicle_type']=="monthly" && $row_orders['signupdate_less26']=="NO"){
							$amounttopay=$amounttopay+$row_orders['first_prorate_quantity'];
						}
					if(($row_orders['cicle_type']=="yearly" || $row_orders['cicle_type']=="2yearly" || $row_orders['cicle_type']=="3yearly" || $row_orders['cicle_type']=="4yearly" || $row_orders['cicle_type']=="5yearly" || $row_orders['cicle_type']=="6yearly" || $row_orders['cicle_type']=="7yearly" || $row_orders['cicle_type']=="8yearly" || $row_orders['cicle_type']=="9yearly" || $row_orders['cicle_type']=="10yearly") && $row_orders['service_type']=="domain-registry"){
							$amounttopay=$amounttopay+($row_orders['first_prorate_quantity']);
						}
					if($row_orders['cicle_type']=="monthly" && $row_orders['signupdate_less26']=="YES"){
							$amounttopay=$amounttopay+($row_orders['first_prorate_quantity']+$row_orders['second_prorate_quantity']);
						}
					if($row_orders['cicle_type']=="yearly" && $row_orders['service_type']!="domain-registry"){
							$amounttopay=$amounttopay+($row_orders['first_prorate_quantity']+$row_orders['second_prorate_quantity']);
						}		
				 $htmlCode=$htmlCode."
				 </div>
                <div style=\"border-right:solid 1px #CCC;float:left;width:170px;margin-left:15px; text-align:right; padding-right:10px;\">
					<div style=\"color:#06C; font-size:11px;font-weight:700;\">".converdate($row_orders['datenext_renew'])."</div>
                    <div style=\"color:#666; font-size:10px;\">por $".number_format($row_orders['price_cicle'],2)." ".
						$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'")."</div></div></div>";
 }while($row_orders=mysql_fetch_assoc($list_orders)); 
 
 $htmlCode_footer="
<div style=\"overflow:hidden; border-top:solid 1px #F0F0F0;border-bottom:solid 1px #F0F0F0; margin-left:7px; margin-right:7px; padding-top:3px;\">
	<div style=\"float:left;width:475px; font-size:18px; text-align:right; padding-top:5px; padding-bottom:5px;\">
	total: $".number_format($amounttopay,2)." ".$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'")."
   	</div>
</div>
<div style=\"font-weight:700px; margin-top:20px;border-top:solid 1px #F5F5F5;\"> Sinceramente,</div>
<div> HostDime Latinoamérica,</div>
<div> 
Av. López Mateos Sur 2077, Int. Z-­25<br/>
Col. Jardines de Plaza del Sol<br/>
Guadalajara, Jalisco. México, C.P. 44510</div>
";
$total_a_pagar = number_format($amounttopay,2);
$msg_resumeOrder= $htmlCode_head.$htmlCode.$htmlCode_footer;