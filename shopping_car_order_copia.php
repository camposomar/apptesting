<? 
date_default_timezone_set("America/Mexico_City");
include("includes.php");
if(isset($_GET['addhostdomain'])){
	$tb_page_order_domain->insert($_COOKIE['visit_key'],"","",$_GET['domain'],$_GET['tld'],"1","230");
	switch($_GET['period']){
			case "monthly":{
					$price_cicle=$tb_page_hosting_package->obtenerDato("monthly_price","package_id=".$_GET['package_id'])*$tb_page_domain->obtenerDato("baseprice","domain_id=$domain_id")*$tb_page_domain->obtenerDato("taxes","domain_id=$domain_id");
				
				
				$price_per_day=$price_cicle/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
				$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
				
				if(date("d")<26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"NO",$price_prorate,$price_cicle,"monthly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
				}
				if(date("d")>=26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"YES",$price_prorate,$price_cicle,"monthly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
					}
				
				break;
				}
			case "yearly":{
				$price_cicle=$tb_page_hosting_package->obtenerDato("monthly_price","package_id=".$_GET['package_id'])*$tb_page_domain->obtenerDato("baseprice","domain_id=$domain_id")*$tb_page_domain->obtenerDato("taxes","domain_id=$domain_id");
				
				
				$price_per_day=$price_cicle/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
				$price_prorate=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
				
				$price_cicle=$tb_page_hosting_package->obtenerDato("yearly_price","package_id=".$_GET['package_id'])*$tb_page_domain->obtenerDato("baseprice","domain_id=$domain_id")*$tb_page_domain->obtenerDato("taxes","domain_id=$domain_id");
				if(date("d")<26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"NO",$price_prorate,$price_cicle,"yearly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
				}
				/*if(date("d")>=26){
					$packname=$tb_page_hosting_package->obtenerDato("name","package_id=".$_GET['package_id']);
					$tb_page_order_hosting->insert($_COOKIE['visit_key'],$packname,date("Y-m-d"),date("Y")."-".date("m")."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")),"YES",$price_prorate,$price_cicle,"yearly",$tb_page_order_domain->obtenerDato("order_domain_id","order_domain_id>0 order by order_domain_id DESC"));
					}
				*/
				break;
				}	
		}
}
if($tb_page_order_hosting->math("COUNT","visit_key='".$_COOKIE['visit_key']."'")>0){
?>

<div style="text-align:right; padding-right:180px;border:none;"><img src="images/arrow_up.png" alt="" style="border:none;" /></div>
<div style="overflow:hidden;border:solid 1px #999;margin-top:-3px;width:900px; background-color:#FFF;z-index:7;alpha(opacity=97);-moz-opacity:.97;opacity:.97;text-shadow:none;" class="redondeo10px"> 
		<div style="height:30px; background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px; margin:7px; margin-top:3px;" class="redondeo5px"> 
    	Tu órden de compra está en proceso</div>
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
			$list_order_hosting=$tb_page_order_hosting->select('pack,signupdate,proratedate,prorate,price_prorate,price_cicle,cicle_type,order_domain_id','');
			$row_order_hosting=mysql_fetch_assoc($list_order_hosting);
			do{ ?>
			<div onmouseover="style.backgroundColor='#E8E8E8';" onmouseout="style.backgroundColor='#FFF';" style="border-bottom:dotted 1px #EDEDED; overflow:hidden;margin-bottom:10px; padding-top:5px;">
            	<div style="border-right:solid 1px #CCC;float:left;width:120px;margin-left:15px; font-size:16px; color:#069; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">
						<div style="float:left; width:32px;"><img src="images/icon_windows.png" alt=""  /></div>
						<div style="float:left;"><?=$row_order_hosting['pack']; ?></div>
                    </div>
                <div style="border-right:solid 1px #CCC;float:left;width:170px;margin-left:15px;"><?=$tb_page_order_domain->obtenerDato("name","order_domain_id=".$row_order_hosting['order_domain_id']) ?><?=$tb_page_order_domain->obtenerDato("tld","order_domain_id=".$row_order_hosting['order_domain_id']) ?></div>
                <div style="border-right:solid 1px #CCC;float:left;width:70px;margin-left:15px;"> <?=$row_order_hosting['cicle_type'];  ?> </div>
                <div style="border-right:solid 1px #CCC;float:left;width:210px;margin-left:15px;">
                	<div style="overflow:hidden; margin-bottom:5px;">	
                        <div style="font-size:10px; margin-right:5px; float:left;">
                            <strong style="color:#06C">del <?=converdate($row_order_hosting['signupdate']);?></strong> <br />
                            al <?=converdate($row_order_hosting['proratedate']);?>
                        </div>
                        <div style="float:right; font-size:12px; text-align:right; color:#F00; font-weight:800; padding-right:3px;">
                                $<?=number_format($row_order_hosting['price_prorate'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");?>
                        </div>
                     </div>   
                   	<? if($row_order_hosting['prorate']=="YES") {?>
                    <div style="overflow:hidden;">	
                        <div style="font-size:10px; margin-right:5px; float:left;">
                            <? 
							switch($row_order_hosting['cicle_type']){
									case "monthly":{
										$explode_date=explode("-",$row_order_hosting['proratedate']);
										
										if($explode_date[1]==12){
										
										echo "del ".converdate(($explode_date[0]+1)."-01"."-01")."<br/>";
										echo "<strong style=\"color:#06C\"> al ".converdate(($explode_date[0]+1)."-01"."-".cal_days_in_month(CAL_GREGORIAN,01,($explode_date[0])))."</strong>";
											}else{
										echo "del ".converdate($explode_date[0]."-".($explode_date[1]+1)."-"."01")."<br/>";
										echo "<strong style=\"color:#06C\">al ".converdate($explode_date[0]."-".($explode_date[1]+1)."-".cal_days_in_month(CAL_GREGORIAN,($explode_date[1]+1),($explode_date[0])))." </strong>";
											}
										break;
										}
											
								}
							?>
                        </div>
                        <div style="float:right; font-size:12px; text-align:right; color:#F00;  font-weight:800; padding-right:3px;">
                                $<?=number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");?>
                        </div>
                     </div>   
                    <? } ?> 
                    
                </div>
                <div style="border-right:solid 1px #CCC;float:left;width:120px;margin-left:15px;  padding-right:5px; color:#666; font-size:10px; text-align:right; line-height:15px;">
               . <? switch($row_order_hosting['cicle_type']){
									case "monthly":{
										$explode_date=explode("-",$row_order_hosting['proratedate']);
										if($row_order_hosting['prorate']=="YES"){
												if($explode_date[1]+2==13){
													echo " <strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-01"."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
													}
												if($explode_date[1]+2==12){
													echo "<strong style=\"color:#06C\"> ".converdate($explode_date[0]."-".($explode_date[1]+2)."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
														}
												if($explode_date[1]==12){
													echo "<strong style=\"color:#06C\"> ".converdate(($explode_date[0]+1)."-02"."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
													}		
											}
										if($row_order_hosting['prorate']=="NO"){
												if($explode_date[1]==12){
													 echo "<strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-01"."-01")."</strong><br/>";
													 echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");	
													}else{
														echo "<strong style=\"color:#06C\"> ".converdate($explode_date[0]."-".($explode_date[1]+1)."-01")."</strong><br/>";
														echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
														}
											}
										
										break;
										}
									case "yearly":{
										$explode_date=explode("-",$row_order_hosting['proratedate']);
										if($row_order_hosting['prorate']=="YES"){
												if($explode_date[1]+2==13){
													echo " <strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-01"."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
													}
												if($explode_date[1]+2==12){
													echo "<strong style=\"color:#06C\"> ".converdate($explode_date[0]."-".($explode_date[1]+2)."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
														}
												if($explode_date[1]==12){
													echo "<strong style=\"color:#06C\"> ".converdate(($explode_date[0]+1)."-02"."-01")."</strong><br/>";
													echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
													}		
											}
										if($row_order_hosting['prorate']=="NO"){
												if($explode_date[1]==12){
													 echo "<strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-01"."-01")."</strong><br/>";
													 echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");	
													}else{
														echo "<strong style=\"color:#06C\"> ".converdate(1+$explode_date[0]."-".($explode_date[1])."-01")."</strong><br/>";
														echo "por $".number_format($row_order_hosting['price_cicle'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");
														}
											}
										
										break;
										}
					}
				?>	
                			
                </div>
                <div style="float:left;width:90px;margin-left:5px;"> <img src="images/btn_deliminar.png" alt="" style="border:none" /> </div>		
            </div>	
				<? }while($row_order_hosting=mysql_fetch_assoc($list_order_hosting));
			?>
             
        </div>
</div>
<? } ?>
