<div style="margin:0 auto 0 auto;width:950px;overflow:hidden;">
	<? include("site_submenu_2sub.php");?> 
    <div style="font-family:Verdana, Geneva, sans-serif;color:#787878; padding-left:2px; padding-top:18px; float:left; width:750px; line-height:20px;">
   		<div style="font-size:16px; color:#000; overflow:hidden; margin-left:15px; font-weight:700; padding-bottom:5px;">Complementos</div>
            <div style="padding-bottom:5px; margin-left:15px; border-bottom:dashed 1px #999;overflow:hidden; color:#000;">Hemos puesto una serie de servicios y productos que pueden contribuir a que usted obtenga mejor beneficio de su servicio. <strong style="color:#F90; font-size:13px;">Los complementos para este servicio son los siguientes:</strong> </div>
        <div style="overflow:hidden; margin-left:15px; margin-top:25px;">
		<? 	include("controller/class.page_supplements_details.php");
			$tb_page_supplements_details= new tb_page_supplements_details();
			
			include("controller/class.page_supplements.php");
			$tb_page_supplements= new tb_page_supplements();
			
			$link_id=$tb_page_link->obtenerDato("link_id","url='$page_seccion'"); 
			//TOMAMOS TODOS LOS DEL id 2 porque están en dólares
			$list_page_supplements_details=$tb_page_supplements_details->select("supplements_id,price_monthly,price_yearly,price_setup,type","link_id=$link_id AND domain_id=2");
			$row_page_supplements_details=mysql_fetch_assoc($list_page_supplements_details);
			
			if($tb_page_supplements_details->math("COUNT","link_id=$link_id AND domain_id=2")>0){
					do{ ?>
					
                    <div style="overflow:hidden; border:solid 1px #F5F5F5; margin-bottom:20px;">
                    	<div style="overflow:hidden; padding-left:7px; background-color:#F7F7F7; border-bottom:solid 1px #F5F5F5; font-size:17px; color:#369; padding-top:3px; padding-bottom:3px; font-weight:800;"><?=utf8_encode($tb_page_supplements->obtenerDato("name","supplements_id=$row_page_supplements_details[supplements_id]")) ?></div>
                        <div style="overflow:hidden; margin-left:10px;">
                        	<div style="float:left; width:500px;overflow:hidden; padding-bottom:5px; border-right:solid 1px #CCC;"><?=utf8_encode($tb_page_supplements->obtenerDato("description","supplements_id=$row_page_supplements_details[supplements_id]")) ?></div>
                           
                            <div style="float:left; overflow:hidden;  margin-left:15px; ">
                            	 <? if($row_page_supplements_details['price_monthly']>0) { ?>
                                 <div style="color:#000;">Costo mensual</div>
                                 <div style="font-size:18px;font-weight:550; color:#900;"><?=$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'");?><?=number_format(($row_page_supplements_details['price_monthly']*$tb_page_domain->obtenerDato("baseprice","domain='".$page_domain."'"))*$tb_page_domain->obtenerDato("taxes","domain='".$page_domain."'"),2)."".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?></div>
                                 <? } ?>
                                 <? if(($row_page_supplements_details['price_yearly']>0) OR ($row_page_supplements_details['type'] == 1)) { ?>
                                 <div style="color:#000;">Costo anual</div>
                                 <div style="font-size:18px;font-weight:550; color:#900;">
<?php if($row_page_supplements_details['type'] == 1){ ?>
<?=$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'");?>
<?=number_format((($row_page_supplements_details['price_monthly']*11)*$tb_page_domain->obtenerDato("baseprice","domain='".$page_domain."'"))*$tb_page_domain->obtenerDato("taxes","domain='".$page_domain."'"),2)."".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?>
<?php }else{ ?>
<?=$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'");?><?=number_format(($row_page_supplements_details['price_yearly']*$tb_page_domain->obtenerDato("baseprice","domain='".$page_domain."'"))*$tb_page_domain->obtenerDato("taxes","domain='".$page_domain."'"),2)."".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'");?>
<?php } ?>
</div>
                                 <? } ?>
                                 <? if(($row_page_supplements_details['price_setup']>0) && ($row_page_supplements_details['type'] != 1)) { ?>
                                 <div style="color:#000;">Instalación (pago único)</div>
                                 <div style="font-size:18px;font-weight:550; color:#900;"><?=$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'");?><?=number_format(($row_page_supplements_details['price_setup']*$tb_page_domain->obtenerDato("baseprice","domain='".$page_domain."'"))*$tb_page_domain->obtenerDato("taxes","domain='".$page_domain."'"),2)."".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?></div>
                                 <? } ?>
                            </div>
                        </div>
                    </div>
					<?
						
						}while($row_page_supplements_details=mysql_fetch_assoc($list_page_supplements_details));
				}
		?>
        </div>
    </div>
</div>