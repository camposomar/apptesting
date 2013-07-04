<? 
$localseccion="vpslinux";
// AGREGADO POR ARTURO LEON 14/02/2012
$domain_id = $tb_page_domain->obtenerDato("domain_id","domain='".$page_domain."'");
	// cambie variable $domain_id por $domain_id_instant
$domain_id_instant = ($domain_id >= 4) ? 2 : $domain_id;
//todos los dominios = o mayores a 4 son en dlls y usarán los mismos paquetes
//FIN AGREGADO POR ARTURO LEON
?>
<div style="height:450px; background-image:url(images/vps_linux_slider.png); background-repeat:no-repeat;">
			<div style="width:410px; height:180px; padding-top:150px; text-align:right;">
            	<span style="font-size:14px;">desde </span>
                <span style="font-size:16px;">$</span><span style="font-size:40px; color:;">
					<?=number_format(($tb_page_division->obtenerDato("taxes","division_id=$division_id")*($tb_page_dedicated_package->obtenerDato("monthly_price","domain_id='".$domain_id_instant."'AND type='VPS' Order by monthly_price ASC"))),2);?>
                </span>
                <span style="font-size:11px;"> 
					<?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?>
               	</span>
            </div>
          
     		<div style="height:35px; width:800px; margin-left:25px;">  
            	<form name="hostanddomain_<?=$localseccion;?>" id="hostanddomain_<?=$localseccion;?>"  method="get">
                <div style="float:left; overflow:hidden; font-size:18px; padding-top:7px;">Elija un Plan VPS</div>
                <div style="width:205px; margin-left:15px; height:35px;float:left;margin-top:3px;">
                  	<input name="packnametxt" id="packnametxt" type="text" disabled="disabled" style="width:195px; padding-top:2px;height:27px; border:none; background-color:#FFF; font-size:16px; padding-left:5px;" />
              			<div id="showpacks" style="width:202px; overflow:hidden; margin-left:2px; margin-top:4px;border:solid 1px #E7E7E7; border-top:none; border-bottom:solid 1px #F3F3F3;z-index:6; background-color:#FFF; position:relative; display:none;" >
              
                            <? 
                                    $checked=true;
                                    $list_dedicated_package=$tb_page_dedicated_package->select("serie,processor,dedicated_ip,control_panel,memory,memory_max,disk_space,bandwidth,monthly_price,link_tobuy","type='VPS' AND domain_id='".$domain_id_instant."'");
                                            $row_dedicated_package=mysql_fetch_assoc($list_dedicated_package);		
                                    do{
                                        echo "
                                        <div style=\"margin-top:5px;font-size:12px;font-weight:700;padding-left:5px;\">
                                            <input type=\"radio\" name=\"pack\" onclick=\"javascript:managepacks('novisible','listpack');movevaluepack('VPS $row_dedicated_package[serie]','pack');whatpack_".$localseccion."('".$row_dedicated_package["link_tobuy"]."');\" value=\"\" "?><? if($checked) echo "checked=\"checked\"";?><?="/>VPS <span style=\"color:#F90\">$row_dedicated_package[serie] </span><br /><div style=\"padding-right:15px;text-align:right;color:#439F14;\"><strong>$".number_format($row_dedicated_package[monthly_price]*($tb_page_division->obtenerDato("taxes","division_id=$division_id")),2)."</strong>";?><?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'")."</div>"; ?>
                                        <? echo "</div>
                                        <div style=\"padding-left:30px;padding-bottom:4px;font-size:10px;\">&#8226; $row_dedicated_package[disk_space] GB disco duro</div>
                                        <div style=\"padding-left:30px;padding-bottom:4px;font-size:10px;\">&#8226; $row_dedicated_package[memory] MB RAM</div>
                                        <div style=\"padding-left:30px;padding-bottom:4px;font-size:10px;\">&#8226; $row_dedicated_package[bandwidth] GB Transferencia</div>
										 <div style=\"padding-left:30px;padding-bottom:4px;font-size:10px;\">&#8226; Permite $row_dedicated_package[memory_max] </div>
                                        <div style=\"padding-left:30px;padding-bottom:4px;font-size:10px;\">&#8226; Panel de Control $row_dedicated_package[control_panel]</div>
                                        <div style=\"padding-left:30px;padding-bottom:4px;font-size:10px;\">&#8226; $row_dedicated_package[dedicated_ip] IPs Incluidas</div>
                                        <div style=\"padding-left:30px;font-size:10px;border-bottom:solid 1px #F3F3F3;padding-bottom:5px;text-align:right;\">"; 
										if($page_seccion=="/"){
										?>
											<a href="<?=$country;?>/vps/linux/#details" style="color:#06C;padding-right:10px;">&#187; detalles</a>
										<? 
										}
                                        echo "</div>";
                                        if($checked){ ?>
                                            <script type="text/javascript">
                                                document.getElementById('packnametxt').value="VPS "+"<?=$row_dedicated_package["serie"];?>";
												document.getElementById('hostanddomain_<?=$localseccion;?>').action="<?=$row_dedicated_package["link_tobuy"];?>";
                                            </script>
                                            <? }
                                        $checked=false;
                                    }while($row_dedicated_package=mysql_fetch_assoc($list_dedicated_package));
                                            
                            ?>
                            
                  </div>
           		</div>
                <div style="height:30px; width:23px;float:left;padding-top:3px;"><img src="images/black_arrow.png" alt="" width="20" height="31" id="showbtndown" style="border:none; cursor:pointer;"  onclick="javascript:managepacks('visible','listpack');"/><img src="images/black_arrow_up.png" width="20" height="31" style="border:none; display:none;cursor:pointer;" id="showbtnup"  onclick="javascript:managepacks('novisible','listpack');" alt=""/>
                </div>
                <div style="float:left; margin-left:30px;"><img src="images/btn_ordernow_green.png" alt="" width="152" height="32" style="cursor:pointer;" onclick="document.hostanddomain_<?=$localseccion;?>.submit();" /></div>
                </form>
           </div>
	  <script type="text/javascript">
	  function whatpack_<?=$localseccion;?>(linkpack){
					document.getElementById('hostanddomain_<?=$localseccion;?>').action=linkpack;
					}
					
		 	function movevaluepack(value,objet){
				if(objet=='pack')
					document.getElementById('packnametxt').value=value;
				
				
				}
		 	function managepacks(action,objet){
				if(objet=='listpack'){
						if(action=='visible'){				
							document.getElementById('showpacks').style.display="block";
							document.getElementById('showbtndown').style.display="none";
							document.getElementById('showbtnup').style.display="block";	
						}
						if(action=='novisible') {
							document.getElementById('showpacks').style.display="none";
							document.getElementById('showbtndown').style.display="block";
							document.getElementById('showbtnup').style.display="none";
							}
				}
				
			}
		 </script>
     </div>