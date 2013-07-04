<? 
session_start();
date_default_timezone_set("America/Mexico_City");
include("includes.php");
if(isset($_GET['addhostdomain'])){
	$tb_page_order_domain->insert($_COOKIE['visit_key'],"","",$_GET['domain'],$_GET['tld'],"1","230");
	switch($_GET['period']){
			case "monthly":{
					$price_cicle=$tb_page_hosting_package->obtenerDato("monthly_price","package_id=".$_GET['package_id'])*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_GET['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_GET['domain_id']);
				
				
				$price_per_day=$price_cicle/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
				$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
				
				if(date("d")<26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],'in_car',$_GET['domain_id'],$_GET['type'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"NO",$price_prorate,$price_cicle,"monthly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
				}
				if(date("d")>=26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],'in_car',$_GET['domain_id'],$_GET['type'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"YES",$price_prorate,$price_cicle,"monthly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
					}
				
				break;
				}
			case "yearly":{
				$price_cicle=$tb_page_hosting_package->obtenerDato("yearly_price","package_id=".$_GET['package_id'])*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_GET['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_GET['domain_id']);
				
				
				$price_per_day=$price_cicle/12/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
				$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
				
				$price_cicle=$tb_page_hosting_package->obtenerDato("yearly_price","package_id=".$_GET['package_id'])*$tb_page_domain->obtenerDato("baseprice","domain_id=".$_GET['domain_id'])*$tb_page_domain->obtenerDato("taxes","domain_id=".$_GET['domain_id']);
				if(date("d")<26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],'in_car',$_GET['domain_id'],$_GET['type'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"NO",$price_prorate,$price_cicle,"yearly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
				}
				if(date("d")>=26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],'in_car',$_GET['domain_id'],$_GET['type'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"YES",$price_prorate,$price_cicle,"yearly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
					}
				
				break;
				}	
		}
}
if($tb_page_order_hosting->math("COUNT","visit_key='".$_COOKIE['visit_key']."' AND status='in_car'")>0){
?>

<div style="text-align:right; padding-right:180px;border:none;"><img src="images/arrow_up.png" alt="" style="border:none;" /></div>
<div style="overflow:hidden;border:solid 1px #999;margin-top:-3px;width:900px; background-color:#FFF;z-index:7;alpha(opacity=97);-moz-opacity:.97;opacity:.97;text-shadow:none;" class="redondeo10px"> 
		<div style="height:30px; background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px; margin:7px; margin-top:3px;" class="redondeo5px"> 
    	Resumen de tu órden <?=$_SESSION['country'];?></div>
       <div style="overflow:hidden; margin-left:10px; margin-right:10px;"> 
       		<div style="border-bottom:solid 1px #CCC; overflow:hidden; background-color:#F6F6F6; padding-top:5px; padding-bottom:5px; margin-bottom:10px;">
            	<div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:120px;margin-left:15px;"> Servicio</div>
                <div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:170px;margin-left:15px;"> Dominio a usar</div>
                <div style="border-right:solid 1px #CCC;float:left;width:70px;margin-left:15px;"> Ciclo </div>
                <div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:210px;margin-left:15px;"> ¿Tiempo que pagaré?</div>
                <div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:120px;margin-left:15px;"> Mi siguiente pago</div>
                <div style="float:left;width:90px;margin-left:15px;"> Eliminar </div>
            </div>
        	<? 
			$list_order_hosting=$tb_page_order_hosting->select('type,pack,domain_id,signupdate,proratedate,prorate,price_prorate,price_cicle,cicle_type,order_domain_id',"visit_key='".$_COOKIE['visit_key']."' AND status='in_car'");
			$row_order_hosting=mysql_fetch_assoc($list_order_hosting);
			do{ ?>
			<div onmouseover="style.backgroundColor='#E8E8E8';" onmouseout="style.backgroundColor='#FFF';" style="border-bottom:solid 1px #EEE; overflow:hidden;margin-bottom:10px; padding-top:5px;">
            	<div style="border-right:solid 1px #CCC;float:left;width:120px;margin-left:15px; font-size:16px; color:#069; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">
						<div style="float:left; width:32px;"><? 
						switch($row_order_hosting['type']){
							case "windows-shared":{ ?>
								<img src="images/icon_windows.png" alt=""  />
								<? 
								break;
								}
							case "windows-reseller":{ ?>
								<img src="images/icon_windows.png" alt=""  />
								<? 
								break;
								}	
							case "linux-shared":{ ?>
								<img src="images/icon_linux.png" alt=""  />
								<? 
								break;
								}
							case "linux-reseller":{ ?>
								<img src="images/icon_linux.png" alt=""  />
								<? 
								break;
								}	
							}
						?></div>
						<div style="float:left; color:#000; font-size:13px; font-weight:800;"><?=$row_order_hosting['pack']; ?></div>
                </div>
                <div style="border-right:solid 1px #CCC;float:left;width:170px;margin-left:15px; font-size:14px;">
					<?=$tb_page_order_domain->obtenerDato("name","order_domain_id=".$row_order_hosting['order_domain_id']) ?><?=$tb_page_order_domain->obtenerDato("tld","order_domain_id=".$row_order_hosting['order_domain_id']) ?>
                </div>
                <div style="float:left;width:70px;margin-left:15px; font-weight:700; color:#000;"> <? switch($row_order_hosting['cicle_type']){
						case "monthly":{
							echo "Mensual";
							break;
							}
						case "yearly":{
							echo "Anual";
							}
					}  ?> </div>
            <? 
			switch($row_order_hosting['cicle_type']){
				case "monthly":{ ?>
				<!-- Inicia ¿Cuando Pagaré en caso que sea ciclo mensual -->
                <div style="border-right:solid 1px #CCC;float:left;width:210px;margin-left:15px;">
                	<!-- Inicia div en caso que prorate==NO, es decir que el dia de la orden sea menor a 26 -->
                   	<? if($row_order_hosting['prorate']=="NO"){ ?>
                        <div style="font-size:10px; margin-right:5px; float:left; line-height:15px;">
                                <strong style="color:#06C">del <?=converdate($row_order_hosting['signupdate']);?></strong> <br />
                                al <?=converdate($row_order_hosting['proratedate']);?>
                        </div>
                        <div style="float:right; font-size:12px; text-align:right; color:#F00; font-weight:800; padding-right:3px;">
                                    $<?=number_format($row_order_hosting['price_prorate'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");?>
                        </div>
                    <? } ?>
                    <!-- Finziza divs en caso que prorate==NO -->
                    
                    <!-- Inicia div en caso que prorate==YES, es decir que el dia de la orden sea Mayor a 26 -->
                    <? if($row_order_hosting['prorate']=="YES"){ ?>
                    	<!-- inicia Muestra prorate -->
                        <div style="overflow:hidden;">	
                         	<div style="font-size:10px; margin-right:5px; float:left;line-height:15px;">
                                <strong style="color:#06C">del <?=converdate($row_order_hosting['signupdate']);?></strong> <br />
                                al <?=converdate($row_order_hosting['proratedate']);?>
                        	</div>
                        	<div style="float:right; font-size:12px; text-align:right; color:#F00; font-weight:800; padding-right:3px;">
                                    $<?=number_format($row_order_hosting['price_prorate'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");?>
                        	</div>
                       	</div>
                        <!-- Finaliza Muestra prorate -->
                        
                        <!-- Inicia Muestra mes adicional -->
                        <div style="overflow:hidden; margin-top:5px;">	
                        	<div style="font-size:10px; margin-right:5px; float:left;line-height:15px;">
                            <?
								$explode_date=explode("-",$row_order_hosting['proratedate']);
									if($explode_date[1]==12){
										
										echo "del ".converdate(($explode_date[0]+1)."-01"."-01")."<br/>";
										echo "<strong style=\"color:#06C\"> al ".converdate(($explode_date[0]+1)."-01"."-".cal_days_in_month(CAL_GREGORIAN,01,($explode_date[0])))."</strong>";
											}else{
										echo "del ".converdate(1+$explode_date[0]."-".($explode_date[1]+1)."-"."01")."<br/>";
										echo "<strong style=\"color:#06C\">al ".converdate($explode_date[0]."-".($explode_date[1]+1)."-".cal_days_in_month(CAL_GREGORIAN,($explode_date[1]+1),($explode_date[0])))." </strong>";
										
											
								}
							?>
                        	</div>
                        	<div style="float:right; font-size:12px; text-align:right; color:#F00; font-weight:800; padding-right:3px;">
                                $<?=number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");?>
                        	</div>
                     	</div>
                      <!-- Finaliza Muestra mes adicional -->				
					<? }?>
                    <!-- Finziza divs en caso que prorate==NO -->
                    
                </div>
				<!-- Finaliza ¿Cuando Pagaré en caso que sea ciclo mensual -->
                
                <!-- Inicia Costo del Ciclo y Fecha del siguiente pago -->
                 <div style="border-right:solid 1px #CCC;float:left;width:120px;margin-left:15px;  padding-right:5px; color:#666; font-size:10px; text-align:right; line-height:15px;">
                  <? 
				  						$explode_date=explode("-",$row_order_hosting['proratedate']);
										if($row_order_hosting['prorate']=="YES"){
												
												if($explode_date[1]<11){
													echo "<strong style=\"color:#06C\"> ".converdate(($explode_date[0])."-".($explode_date[1]+2)."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");
													}
													
												if($explode_date[1]==11){
													echo "<strong style=\"color:#06C\"> ".converdate(($explode_date[0]+1)."-01"."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");
													}
													
												if($explode_date[1]==12){
													echo "<strong style=\"color:#06C\"> ".converdate(($explode_date[0]+1)."-02"."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");
													}
															
											}
										if($row_order_hosting['prorate']=="NO"){
												if($explode_date[1]==12){
													 echo "<strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-01"."-01")."</strong><br/>";
													 echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");	
													}else{
														echo "<strong style=\"color:#06C\"> ".converdate($explode_date[0]."-".($explode_date[1]+1)."-01")."</strong><br/>";
														echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");
														}
											}
				  ?>
                 </div>		
                 <!-- Finaliza 	Costo del Ciclo y Fecha del siguiente pago -->	 
				<? break; }
				
				case "yearly":{ ?>
				<!-- Inicia ¿Cuando Pagaré en caso que sea ciclo Anual -->
                <div style="border-right:solid 1px #CCC;float:left;width:210px;margin-left:15px;">
                	<!-- Inicia div en caso que prorate==NO, es decir que el dia de la orden sea menor a 26 -->
                   	<? if($row_order_hosting['prorate']=="NO"){ ?>
                        <!-- inicia Muestra prorate de los dias del mes en Curso-->
                        <div style="overflow:hidden;">
                            <div style="font-size:10px; margin-right:5px; float:left; line-height:15px;">
                                    <strong style="color:#06C">del <?=converdate($row_order_hosting['signupdate']);?></strong> <br />
                                    al <?=converdate($row_order_hosting['proratedate']);?>
                            </div>
                            <div style="float:right; font-size:12px; text-align:right; color:#F00; font-weight:800; padding-right:3px;">
                                        $<?=number_format($row_order_hosting['price_prorate'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");?>
                            </div>
                         </div>
                         <div style="overflow:hidden;">
                            <div style="font-size:10px; margin-right:5px; float:left; line-height:15px;">
                                    del 
										<?
                                    	$explode_date=explode("-",$row_order_hosting['proratedate']); 
											if($explode_date[1]==12){
												echo converdate(1+$explode_date[0]."-01"."-01");
												}else {
												echo converdate($explode_date[0]."-".(1+$explode_date[1])."-01");
												}
										?> <br />
                                    <strong style="color:#06C">al <?
										$explode_date=explode("-",$row_order_hosting['proratedate']); 
											if($explode_date[1]==01){
												 echo converdate($explode_date[0]."-12-".cal_days_in_month(CAL_GREGORIAN,"12",$explode_date[0]));
												}else{
												echo converdate(1+$explode_date[0]."-".($explode_date[1]-1)."-".cal_days_in_month(CAL_GREGORIAN,($explode_date[1]-1),(1+$explode_date[0])));
												}
									?></strong>
                            </div>
                            <div style="float:right; font-size:12px; text-align:right; color:#F00; font-weight:800; padding-right:3px;">
                                        $<?=number_format(($row_order_hosting['price_cicle']/12*11),2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");?>
                            </div>
                         </div>
                         <!-- Finaliza Muestra prorate de los dias del mes en Curso-->
                            
                    <? } ?>
                    <!-- Finziza divs en caso que prorate==NO -->
                    
                    <!-- Inicia div en caso que prorate==YES, es decir que el dia de la orden sea Mayor a 26 -->
                    <? if($row_order_hosting['prorate']=="YES"){ ?>
                    	<!-- inicia Muestra prorate -->
                        <div style="overflow:hidden;">	
                         	<div style="font-size:10px; margin-right:5px; float:left;line-height:15px;">
                                <strong style="color:#06C">del <?=converdate($row_order_hosting['signupdate']);?></strong> <br />
                                al <?=converdate($row_order_hosting['proratedate']);?>
                        	</div>
                        	<div style="float:right; font-size:12px; text-align:right; color:#F00; font-weight:800; padding-right:3px;">
                                    $<?=number_format($row_order_hosting['price_prorate'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");?>
                        	</div>
                       	</div>
                        <!-- Finaliza Muestra prorate -->
                        
                        <!-- Inicia Muestra mes adicional -->
                        <div style="overflow:hidden; margin-top:5px;">	
                        	<div style="font-size:10px; margin-right:5px; float:left;line-height:15px;">
                            <?
								$explode_date=explode("-",$row_order_hosting['proratedate']);
									if($explode_date[1]==12){
										echo "del ".converdate(1+$explode_date[0]."-01-01")."<br/>";
										echo "<strong style=\"color:#06C\">al ".converdate(1+$explode_date[0]."-".($explode_date[1])."-".cal_days_in_month(CAL_GREGORIAN,($explode_date[1]),($explode_date[0])))." </strong>";
									}
									
									if($explode_date[1]<=11){		
										echo "del ".converdate($explode_date[0]."-".($explode_date[1]+1)."-"."01")."<br/>";
										echo "<strong style=\"color:#06C\">al ".converdate(1+$explode_date[0]."-".($explode_date[1])."-".cal_days_in_month(CAL_GREGORIAN,($explode_date[1]),($explode_date[0])))." </strong>";
									}
							?>
                        	</div>
                        	<div style="float:right; font-size:12px; text-align:right; color:#F00;  font-weight:800; padding-right:3px;">
                                $<?=number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");?>
                        	</div>
                     	</div>
                      <!-- Finaliza Muestra mes adicional -->				
					<? }?>
                    <!-- Finziza divs en caso que prorate==NO -->
                    
                </div>
				<!-- Finaliza ¿Cuando Pagaré en caso que sea ciclo Anual -->
                
                <!-- Inicia Costo del Ciclo y Fecha del siguiente pago -->
                 <div style="border-right:solid 1px #CCC;float:left;width:120px;margin-left:15px;  padding-right:5px; color:#666; font-size:10px; text-align:right; line-height:15px;">
                  <? 
				  						$explode_date=explode("-",$row_order_hosting['proratedate']);
										if($row_order_hosting['prorate']=="YES"){
												
												if($explode_date[1]==12){
													 echo "<strong style=\"color:#06C\"> ".converdate(2+$explode_date[0]."-01"."-01")."</strong><br/>";
													 echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");
													 
													
												}
												
												if($explode_date[1]<=11){		
													echo "<strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-".(1+$explode_date[1])."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");
												}
											}
										if($row_order_hosting['prorate']=="NO"){
												if($explode_date[1]==1){
													 echo "<strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-01"."-01")."</strong><br/>";
													 echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");	
													}
												if($explode_date[1]<=12  && $explode_date[1]>1){
														echo "<strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-".($explode_date[1])."-01")."</strong><br/>";
														echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$row_order_hosting['domain_id']."'");
														}
												if($explode_date[1]==1){
														
													}		
											}
				  ?>
                 </div>		
                 <!-- Finaliza 	Costo del Ciclo y Fecha del siguiente pago -->	 
				<? break; }
				}
			?>
                <div style="float:left;width:90px;margin-left:5px;"> <img src="images/btn_deliminar.png" alt="" style="border:none; cursor:pointer;" /> </div>		
            </div>	
				<? }while($row_order_hosting=mysql_fetch_assoc($list_order_hosting));
			?>
            <!-- Inicia lista de dominios -->
            	
            <!-- Finaliza Lista de Dominios --> 
            
              
            <div style="overflow:hidden; border-top:solid 1px #F0F0F0;border-bottom:solid 1px #F0F0F0;">
           		 <div style="width:630px; font-size:16px; text-align:right; margin-top:10px; float:left; color:#000;">Total: <strong style="color:#06C;">
            	<? 
					$list_order_hosting=$tb_page_order_hosting->select('price_prorate,price_cicle,prorate,cicle_type',"visit_key='".$_COOKIE['visit_key']."'");
					$row_order_hosting=mysql_fetch_assoc($list_order_hosting);
					$total=0;
					do{
						if($row_order_hosting['cicle_type']=="monthly"){
							switch($row_order_hosting['prorate']){
									case "NO":{
										$total=$total+($row_order_hosting['price_prorate']);
										break;
										}
									case "YES":{
										$total=$total+($row_order_hosting['price_prorate']+$row_order_hosting['price_cicle']);
										break;
										}	
								}
						}
						if($row_order_hosting['cicle_type']=="yearly"){
								switch($row_order_hosting['prorate']){
									case "NO":{
										
										$total=$total+$row_order_hosting['price_prorate']+($row_order_hosting['price_cicle']/12*11);
										break;
										}
									case "YES":{
										$total=$total+$row_order_hosting['price_prorate']+$row_order_hosting['price_cicle'];
										break;
										}	
								}	
									
										
							}
						
					}while($row_order_hosting=mysql_fetch_assoc($list_order_hosting));
					echo "$".number_format($total,2)." ".$tb_page_domain->obtenerDato("currency","domain_id='".$tb_page_order_hosting->obtenerDato("domain_id","visit_key='".$_COOKIE['visit_key']."'")."'");
					
				?>
            </strong></div>
            <div style="width:200px; float:right; color:#090; margin-left:20px; margin-top:5px;"><img src="images/shopping_continue.png" alt="" style="border:none; cursor:pointer;" onclick="javascript:shoppingcar_visibility('hide');show_hide_opacity('hide');" /></div>
            </div>
            <form action="<?= $tb_page_division->obtenerDato("country","division_id=".$_SESSION['division_id']);?>/ayuda-contacto/pedido-completo/" method="post" id="client_details" name="client_details">
            <div style="height:30px; background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px;margin-top:15px; margin-bottom:5px;" class="redondeo5px">Llena el siguiente formulario</div>
         	<div style="overflow:hidden; border:solid 1px #EFEFEF;  margin-bottom:15px;" class="redondeo10px">
            	
                 <div style="padding-left:20px; padding-top:15px; padding-bottom:15px;  width:290px; float:left;">
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Nombre Completo:</div>
                        <div><input type="text" name="client_full_name" id="client_full_name" style="font-size:14px; width:230px; margin-top:3px; color:#633;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Dirección de Correo:</div>
                        <div><input type="text" name="client_email" id="client_email" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Teléfono:</div>
                        <div><input type="text" name="client_phone" id="client_phone" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                    </div>
                    <div style="padding-left:10px; padding-top:15px; padding-bottom:15px;idth:320px; float:left;">
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Calle y Número:</div>
                        <div><input type="text" name="client_address" id="client_address" style="font-size:14px; width:230px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Ciudad:</div>
                        <div><input type="text" name="client_city" id="client_city"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Estado:</div>
                        <div><input type="text" name="client_state" id="client_state"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">País:</div>
                        <div><input type="text" name="client_country" id="client_country" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                    </div> 
                <div style="float:right; margin-left:15px; margin-top:10px;"><img src="images/livechat_resume_order.png" alt="" style="border:none; cursor:pointer;" onclick="window.open('<?=$tb_page_domain->obtenerDato("link_livechat","domain_id=".$tb_page_order_hosting->obtenerDato("domain_id","visit_key='".$_COOKIE['visit_key']."'"));?>','chat','width=545,height=597,scrollbars=no,menubar=no,resizable=no,toolbar=no,titlebar=no,location=no,status=no');return false;" /></div>
            </div>
            <div><? 
			if($tb_page_domain->obtenerDato("taxes","domain_id=".$tb_page_order_hosting->obtenerDato("domain_id","visit_key='".$_COOKIE['visit_key']."'"))>1){
					?>
            <div style="overflow:hidden;">
            	<div style="font-size:14px; font-weight:900;height:40px; float:left; padding-top:10px;"><input type="checkbox" id="fiscal_ivoice" name="fiscal_ivoice"  onclick="javascript:manage_datos_facturacion();"/> Requiero Factura Fiscal</div>
            	
                <div style="height:40px; float:left; margin-left:20px;"><img src="images/icon_sat.png" alt="" style="border:none" /></div>
				
            </div>
            
            <div style="overflow:hidden; display:none;" id="datos_facturacion"> 
            	<div style="height:30px;background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px; margin-bottom:5px;" class="redondeo5px">
                	Edita tus datos de Facturación</div> 
                <div style="overflow:hidden; border:solid 1px #EFEFEF;  margin-bottom:15px;" class="redondeo10px">
                    <div style="padding-left:20px; padding-top:15px; padding-bottom:15px;  width:290px; float:left;">
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Razón Social:</div>
                        <div><input type="text" name="sat_name" id="sat_name" style="font-size:14px; width:230px; margin-top:3px; color:#633;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">RFC:</div>
                        <div><input type="text" name="sat_rfc" id="sat_rfc" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Calle y Número:</div>
                        <div><input type="text" name="sat_address" id="sat_address" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                    </div>
                    <div style="padding-left:10px; padding-top:15px; padding-bottom:15px;idth:320px; float:left;">
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Colonia:</div>
                        <div><input type="text" name="sat_colonia" id="sat_colonia" style="font-size:14px; width:230px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Código Postal:</div>
                        <div><input type="text" name="sat_cp" id="sat_cp" style="font-size:14px; width:230px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Ciudad:</div>
                        <div><input type="text" name="sat_city" id="sat_city"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Estado:</div>
                        <div><input type="text" name="sat_state" id="sat_state"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">País:</div>
                        <div><input type="text" name="sat_country" id="sat_country" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;"></div>
                        
                    </div> 
                </div>        
           	</div>
					<?
				}?>
             <div style="overflow:hidden; margin-bottom:25px; text-align:center; margin-top:25px;"><img src="images/btn_get_services.png" alt="" style="border:none; cursor:pointer;"  onclick="document.client_details.submit();"/></div>   
            
             </div> </form>
        </div>
</div>
<? } ?>
