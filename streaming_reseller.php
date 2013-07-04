
<div style="overflow:hidden;">
<? 
$list_package=$tb_core_packages->select("package_id,name,price_monthly,price_quarterly,module,price_semiannual,price_yearly,price_2yearly,price_3yearly","company_id='$_SESSION[core_company_id]' AND type='reseller' AND module='centovacast' Order by price_monthly ASC");
$row_package=mysql_fetch_assoc($list_package);
?>
<div style="overflow:hidden; ">
    
        <div style="color:#333; font-size:26px; font-weight:900px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;text-shadow: 0 1px 0 #EAEAEA; margin-top:10px;">Planes Reseller - Streaming de audio</div>
        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px; color:#333;text-shadow: 0 1px 0 #F9F9F9; margin-top:15px; margin-bottom:25px; line-height:20px;"> Somos unos de los pocos provedores de Cuentas Reseller para Streaming radio. Ahora mismo, de un modo simple puedes iniciar a crear tus propios planes de streaming y venderlos al precio que tu creas más conveniente. </div>
    
    
	<div id="slider_contenedor_fijo" style="width:930px; height:470px; float:left; overflow:hidden; margin-left:5px;">
    	<div style="height:470px; position:relative; width:<?=310*$tb_page_packages->math("COUNT","core_company_id='$_SESSION[core_company_id]' AND link_id='$_SESSION[link_id]'");?>px; left:0px;" id="home_slide_pack">
	<?
    do{
        if($tb_page_packages->math("COUNT","package_id_core=".$row_package['package_id'])>0){
                ?>
                	<div style="width:310px;float:left;height:470px;">
                    	<div style="height:465px; margin-left:5px; margin-right:5px; border:solid 1px #ECECEC;" class="redondeo10px">
                            <div style="height:50px; background-color:#333; margin-bottom:15px;" class="redondeo5px">
                                <div style="float:left; padding-left:5px; padding-top:9px; overflow:hidden; width:185px;">
                                    <div style="float:left;"><img src="images/Drop-box-32.png" alt=""  /></div>
                                	<div style="float:left;font-weight:bold; font-size:15px; color:#FAFAFA; padding-left:10px; padding-top:5px;">Plan <?=$row_package['name']; ?></div>
                                </div>
                            </div>
                             <div style="border-bottom:solid 1px #F6F6F6; margin-left:5px; margin-right:5px;margin-bottom:7px;">
                            	<div style="color:#000; font-weight:700;">Oyentes Simultáneo:</div>
                               <div style="color:#06C; font-size:16px; font-weight:800;"> <?=$tb_page_packages->obtenerDato("domain_hosted","package_id_core=".$row_package['package_id']);?></div>
                            </div>
                            <div style="border-bottom:solid 1px #F6F6F6; margin-left:5px; margin-right:5px;margin-bottom:7px;">
                            	<div style="color:#000; font-weight:700;">Cuentas permitidas:</div>
                               <div style="color:#06C; font-size:16px; font-weight:800;"> <?=$tb_page_packages->obtenerDato("email_accounts_maxspace","package_id_core=".$row_package['package_id']);?> Radios</div>
                            </div>
                             <div style="border-bottom:solid 1px #F6F6F6; margin-left:5px; margin-right:5px;margin-bottom:7px;">
                            	<div style="color:#000; font-weight:700;">Ancho de Banda:</div>
                                <div style="color:#930; font-size:14px;"><?=$tb_page_packages->obtenerDato("bandwidth","package_id_core=".$row_package['package_id']);?> GB/mes</div>
                            </div>
                            <div style="border-bottom:solid 1px #F6F6F6; margin-left:5px; margin-right:5px;margin-bottom:7px;">
                            	<div style="color:#000; font-weight:700;">Máximo Bitrate:</div>
                                <div style="color:#930; font-size:14px;"><?=$tb_page_packages->obtenerDato("email_accounts","package_id_core=".$row_package['package_id']);?> kbps</div>
                            </div>
                            <div style="border-bottom:solid 1px #F6F6F6; margin-left:5px; margin-right:5px;margin-bottom:7px;">
                            	<div style="color:#000; font-weight:700;">Incluye Auto-Dj:</div>
                                <div style="text-align:left;color:#06C; font-size:14px;">
									<? if($tb_page_packages->obtenerDato("diskspace","package_id_core=".$row_package['package_id'])*1000==0) { ?>
                                    <img src="images/box_check_error.png" width="17" height="16" alt="" /> no
                                    <? } else { ?>
                                    <img src="images/box_check.png" width="17" height="16" alt="" /> Si <? } ?>
                                </div>    
                        	</div>
                        
                            <div style="border-bottom:solid 1px #F6F6F6; margin-left:5px; margin-right:5px; margin-bottom:7px; background-color:#FFF;">
                            	<div style="color:#000; font-weight:700;">Espacio para auto-Dj</div>
                                <div style="color:#06C; font-size:14px;">
								<? 
									if($tb_page_packages->obtenerDato("diskspace","package_id_core=".$row_package['package_id'])*1000==0) {
										echo "no aplica";
									}else {
										echo ($tb_page_packages->obtenerDato("diskspace","package_id_core=".$row_package['package_id'])*1000)."MB";
									}
								?></div>
                            </div>
                            
                            
                            <form action="<?=$country.$_SESSION['page_seccion']; ?>" method="get" id="form_<?=$row_package['package_id']; ?>" name="form_<?=$row_package['package_id']; ?>">
                            <div><input type="hidden" name="opacity" value="true" /></div>
                            <div><input type="hidden" name="car_action" value="add" /></div>
                            <div><input type="hidden" name="service_type" value="streaming_reseller" /></div>
                            <div><input type="hidden" name="package_id" value="<?=$row_package['package_id']; ?>" /></div>
                            <div style="background-color:#FFF; border:solid 1px #CCC; color:#06C; margin-left:10px; margin-right:10px; margin-top:20px; cursor:pointer;" onmouseover="style.backgroundColor='#E8E8E8';" onmouseout="style.backgroundColor='#FFF';" class="redondeo5px">
                        		<div style="margin:5px; padding-bottom:5px; border:solid 1px #F9F9F9; color:#000;font-size:18px;font-weight:600;">Nombre de tu Radio</div>
                                <div style="margin-left:15px; margin-right:15px; padding-bottom:5px;">
                                	<input type="text" name="note_1" style="width:165px; font-size:14px;" value=""/> 
                                	<input type="hidden" name="note_2" style="width:50px; margin-top:8px;font-size:14px;" value=""  />
                                </div>    
                              </div>
                            <div style="margin-left:5px;border-bottom:solid 1px #F3F3F3; font-size:13px; margin-top:10px;">
                        <input type="radio" name="cycle_type" value="monthly" /> <?=$tb_page_domain->obtenerDato("symbol_currency","domain_id=".$_SESSION['domain_id']); ?><?=number_format($row_package['price_monthly']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2)." ".$tb_page_domain->obtenerDato("currency","domain_id=".$_SESSION['domain_id']); ?>/mensuales</div>
                        <div style="margin-left:5px;border-bottom:solid 1px #F3F3F3;font-weight:600;font-size:13px; color:#F00; margin-top:2px;">
                        <input type="radio" name="cycle_type" value="yearly" checked="checked"/> <?=$tb_page_domain->obtenerDato("symbol_currency","domain_id=".$_SESSION['domain_id']); ?><?=number_format($row_package['price_yearly']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2)." ".$tb_page_domain->obtenerDato("currency","domain_id=".$_SESSION['domain_id']); ?>/anuales</div>
                            <div><input type="hidden" name="token_key" value="<?=$tb_page_token->obtenerDato("token_key","status='available' order by rand()"); ?>" /></div>   
                           	<div style="overflow:hidden; margin-top:7px; margin-right:13px; margin-left:3px; padding-left:5px; text-align:center;">
                        	<img src="images/icon_order_btn_orange.png" alt="" style="cursor:pointer; border:none;" onclick="send_form_pack<?=$row_package['package_id'];?>();"/>
                            <script type="text/javascript">
                        	function send_form_pack<?=$row_package['package_id'];?>(){
								if(document.form_<?=$row_package['package_id'];?>.note_1.value.trim()!=""){
									document.form_<?=$row_package['package_id'];?>.submit();	
								}else{
									alert('¡Error! debes llenar con el Nombre de tu Radio.');
									}
							}
                        </script>
                            </div>
                            </form>
                        </div>    
                    </div>
                <?
            }
     	}while($row_package=mysql_fetch_assoc($list_package));
    ?>
		</div>
	</div>
</div>
     
    <script type="text/javascript">
				var contador=0;
	var Reserva=0;
	//document.getElementById("buttonMovePageLeft").style.display="none";	
	function movepack(action,Reserva){
		// Reserva es la resta del ancho total de id="home_slide_pack" menos el ancho de id="slider_contenedor_fijo" 
		Reserva=Reserva-930;
		
		// Obtiene el Left de  id="home_slide_pack"
		var slideContenedorLeft=document.getElementById("home_slide_pack").style.left;
		slideContenedorLeft=parseInt(slideContenedorLeft.replace("px",""));
			
			// Si la acción es mover de Derecha a Izquierda ejecutar la siguiente acción.
		if(action=="rightToleft"){
			// Verifica que Left sea Mayor a 900 evitando dejar id="slider_contenedor_fijo" vacio. 	
			if(slideContenedorLeft>-Reserva){
				//Inicia el contador despues que un paquete se ha mostrado para preparse a desplegar el siguiente paquete.
				contador=0;
				setTimeout("removePack('rightToleft',"+Reserva+")",1);	
			}
		}
		if(action=="leftToright"){
			// Aseguramos que el LEFT nunca sea mayor a cero, volviendo a como estaba en el Load -Body
			if(slideContenedorLeft!=0){
				//Inicia el contador despues que un paquete se ha mostrado para preparse a desplegar el siguiente paquete.
				contador=0;
				setTimeout("removePack('leftToright',"+Reserva+")",1);	
			}
		}
		
	}
	function removePack(mode,Reserva){
		var slideContenedorLeft=document.getElementById("home_slide_pack").style.left;
		slideContenedorLeft=parseInt(slideContenedorLeft.replace("px",""));
	
		//Asegura que el NUEVO desplazamiento sea de 300px
			if(contador<310){
						// Si el NUEVO paquete a mostrar se encuentra a la derecha del último ejecutar la siguiente condicion.
				if(mode=="rightToleft"){
					//Mueve 5 pixeles de derecha a izquierda el LEFT de id="home_slide_pack"
					contador=contador+5;
					slideContenedorLeft=slideContenedorLeft-5;
					document.getElementById('home_slide_pack').style.left=slideContenedorLeft+"px";
					//Asegura que se muestre el ultimo paquete
					/*
					if(slideContenedorLeft<=-Reserva){
						document.getElementById("buttonMovePageRight").style.display="none";								
					}*/		
					document.getElementById("buttonMovePageLeft").style.display="block";
					setTimeout("removePack('rightToleft',"+Reserva+")",1);
					// deshabilita link
					if(contador<310){
					document.getElementById("buttonMovePageRight").disabled=true;			
					}
					else{
					document.getElementById("buttonMovePageRight").disabled=false;
					}
				}
				if(mode=="leftToright"){
					contador=contador+5; 
					//Mueve 5 pixeles de derecha a izquierda el LEFT de id="home_slide_pack"
					slideContenedorLeft=slideContenedorLeft+5;
					document.getElementById('home_slide_pack').style.left=slideContenedorLeft+"px";
					//Asegura que se muestre el ultimo paquete
					/*
					if(slideContenedorLeft>=0){
						document.getElementById("buttonMovePageLeft").style.display="none";		
					}
					*/
					document.getElementById("buttonMovePageRight").style.display="block";
					setTimeout("removePack('leftToright',"+Reserva+")",1);
					// deshabilita link
					if(contador<310){
					document.getElementById("buttonMovePageLeft").disabled=true;
					}
					else{
					document.getElementById("buttonMovePageLeft").disabled=false;
					}	
				}
			}		
		}	
		</script>
    <div style="margin:0 auto 0 auto;width:920px; height:45px;margin-top:10px; border-bottom:dotted 1px #CCC; padding-bottom:15px; margin-bottom:25px;"> 
    		<div style="float:right; padding-right:10px;">
                <div style="height:36px; width:100px;float:left; font-size:24px;padding-top:4px;">Ver más</div>
                <div style="height:36px; width:40px;float:left;padding-top:5px;"><input id="buttonMovePageLeft" type="button" value=" " style="background-image:url(images/icore_next_btn_orange_left.png);background-color:#FFF; height:32px; width:39px; cursor:pointer; border:none;"  onclick="javascript:movepack('leftToright','<?=310*$tb_page_packages->math("COUNT","core_company_id='$_SESSION[core_company_id]' AND link_id='$_SESSION[link_id]'");?>');"/></div>
                <div style="height:36px; width:40px;float:left;padding-top:5px;"><input id="buttonMovePageRight" type="button" value=" " style="background-image:url(images/icore_next_btn_orange_right.png); background-color:#FFF;height:32px; width:39px;cursor:pointer; border:none;" onclick="javascript:movepack('rightToleft','<?=310*$tb_page_packages->math("COUNT","core_company_id='$_SESSION[core_company_id]' AND link_id='$_SESSION[link_id]'");?>');"/></div>
            </div>
    </div>
    <div style="width:950px; height:29px; background-image:url(images/home_slider_shadow.png);"></div>
	<!-- Inicia DIV -->
     <? 
		
			include("modules_service/module_centovacast_radio.php");
            include("modules_service/module_support24-7.php");
            include("modules_service/module_core.php");
            include("modules_service/module_supplements.php");
            include("modules_service/module_user_manual.php");
            include("modules_service/module_otherinformation.php");
	?>
    <!-- Finaliza DIV -->
 	
</div>