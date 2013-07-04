<?
// AGREGADO POR ARTURO LEON 14/02/2012
	// cambie variable $domain_id por $domain_id_instant
$domain_id_instant = ($domain_id >= 4) ? 2 : $domain_id;
//todos los dominios = o mayores a 4 son en dlls y usarán los mismos paquetes
//FIN AGREGADO POR ARTURO LEON
?>
<div style="overflow:hidden;">
	 <div style="margin:0 auto 0 auto;border:none;width:950px;margin-top:3px;">
     <? include("colocation_single_slider.php");?>
    <div style="margin:0 auto 0 auto;width:950px; height:29px; background-image:url(images/home_slider_shadow.png);"></div>
    <div><br />Selecciona un centro de datos: <a href="<?php if($_SESSION['country']=='venezuela' || $_SESSION['country']=='argentina'){echo $_SESSION['country']; } ?>/colocacion/servidorindividual/" style="padding:10px; height:15px;  background-color:#666; color:white;">Orlando, FL, USA</a> <a href="<?php if($_SESSION['country']=='venezuela' || $_SESSION['country']=='argentina'){echo $_SESSION['country']; } ?>/colocacion/servidorindividual/gdl/" style="padding:10px; height:15px;">Guadalajara, Jal, MX</a></div>
    <div style="padding-top:25px; overflow:hidden;">
                    <div style="width:230px;float:left; overflow:hidden; margin-left:10px; background-image:url(images/title_colocation_server.png); background-repeat:no-repeat;">
                        <div style="margin-top:76px; height:30px; font-size:16px; border-bottom:dashed 1px #E9E9E9; padding-top:17px; background-image:url(images/icon_vinieta.png); background-repeat:no-repeat; padding-left:30px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">Conexión a Internet</div>
                        <div style="height:29px;font-size:16px;border-bottom:dashed 1px #E9E9E9;padding-top:17px;background-image:url(images/icon_vinieta.png); background-repeat:no-repeat; padding-left:30px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">Ancho de banda incluído</div>
                        <div style="height:29px;font-size:16px;border-bottom:dashed 1px #E9E9E9;padding-top:17px;background-image:url(images/icon_vinieta.png); background-repeat:no-repeat; padding-left:30px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">IPs Incluidas</div>
                        <div style="height:30px;font-size:16px;border-bottom:dashed 1px #E9E9E9;padding-top:17px;background-image:url(images/icon_vinieta.png); background-repeat:no-repeat; padding-left:30px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">Reinicios Incluidos</div>
                       
                    </div>
      		<div id="slider_contenedor_fijo" style="width:690px; height:470px; float:left; overflow:hidden; margin-left:5px;">
                <div style="height:470px; position:relative; width:<?=230*$tb_page_colocation->math("COUNT","domain_id=$domain_id_instant AND type='Colocation-Single' AND dc=0"); ?>px; left:0px;" id="home_slide_pack">
                 
                 <? 
				 
				  	$list_page_colocation=$tb_page_colocation->select("name,type,mbps,volts,ips,price_monthly,setup_local,local","domain_id=$domain_id_instant AND type='Colocation-Single' AND dc=0 ORDER by price_monthly ASC");
	 				$row_page_colocation=mysql_fetch_assoc($list_page_colocation);		
					do{  ?>
					 <div style="width:230px;float:left;background-image:url(images/dedicated_background_package.png);height:470px;">
                    	<div style="height:50px; background-color:#666; margin-right:11px; margin-left:3px; margin-top:5px;">
                        	<div style="float:left; padding-left:5px; padding-top:9px; overflow:hidden; width:160px;">
                            	
                                <div style="font-weight:bold; font-size:16px; color:#FAFAFA"><?=$row_page_colocation['name']; ?></div>
                            </div>
                          
                      </div>
                        <div style="height:4px; background-color:#CCCCCC;margin-right:11px; margin-left:3px;"></div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #F5F5F5;margin-top:13px; padding-left:4px; padding-top:16px; font-size:13px; font-weight:800;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">100mbps puerto a la red</div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #F5F5F5;background-color:#FAFAFA;padding-left:4px; padding-top:16px; font-size:14px;font-weight:800;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FAFAFA';"><?php echo $row_page_colocation['mbps'];?> Mbps simétricos</div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #F5F5F5;padding-left:4px; padding-top:16px; font-size:14px;font-weight:800;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">/29 Vlan 5 direcciones IPs</div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #CCC; margin-bottom:4px;background-color:#FAFAFA;padding-left:4px; padding-top:16px; font-size:14px;font-weight:800;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FAFAFA';"> Ilimitados</div>
                        
                        <div style="height:4px; margin-left:3px; height:33px;margin-right:11px;border-bottom:solid 1px #F5F5F5; text-align:right;padding-top:3px; padding-right:3px;"  onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
                         	<div style="font-size:14px;font-weight:bold; color:#06C;">$<?=number_format($row_page_colocation['price_monthly']*$tb_page_division->obtenerDato("taxes","division_id=$division_id"),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?>/mes</div>
                       	 	<div style="font-size:11px; color:#666;">Sin contrato obligatorio</div>
                        </div>
                        
                        <div style="height:4px; margin-left:3px; height:60px;margin-right:11px;border-bottom:solid 1px #F5F5F5; text-align:right;padding-top:3px; padding-right:3px;"  onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
                         	<div style="font-size:14px;font-weight:bold; color:#06C;">Costo Instalación</div>
                            <div style="font-size:14px;font-weight:bold; color:#F00;">GRATIS</div>
                            <div style="font-size:10px; color:#666;"> Si usted manda su servidor hasta nuestro Centro de Datos en Orlando Fl, USA</div>
                       	</div>
                        
                        
                        <div style="height:4px; margin-left:3px; height:70px;margin-right:11px; text-align:right;padding-top:3px; padding-right:3px;"  onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
                         	<div style="font-size:14px;font-weight:bold; color:#06C;">Costo Instalación</div>
                            <div style="font-size:10px; color:#666;"> Pago único </div>
                            <div style="font-size:14px;font-weight:bold; color:#C30;">$<?=number_format($row_page_colocation['setup_local']*$tb_page_division->obtenerDato("taxes","division_id=$division_id"),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?></div>
                            <div style="font-size:10px; color:#666;"> Si usted manda su servidor a nuestra oficina en <?=utf8_encode($row_page_colocation['local']); ?></div>
                       	</div>
                        
                        
                        
                        
                    </div>
                    
                   <? }while($row_page_colocation=mysql_fetch_assoc($list_page_colocation)); ?>
                </div>
            </div>
       	</div>
     
     	<script type="text/javascript">
				var contador=0;
	var Reserva=0;
	//document.getElementById("buttonMovePageLeft").style.display="none";	
	function movepack(action,Reserva){
		// Reserva es la resta del ancho total de id="home_slide_pack" menos el ancho de id="slider_contenedor_fijo" 
		Reserva=Reserva-690;
		
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
			if(contador<230){
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
					if(contador<230){
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
					if(contador<230){
					document.getElementById("buttonMovePageLeft").disabled=true;
					}
					else{
					document.getElementById("buttonMovePageLeft").disabled=false;
					}	
				}
			}		
		}	
		</script>
    <div style="margin:0 auto 0 auto;width:920px; height:45px;margin-top:10px;"> 
    		<div style="float:right; padding-right:10px;">
                <div style="height:36px; width:100px;float:left; font-size:24px;padding-top:4px;">Ver más</div>
                <div style="height:36px; width:40px;float:left;padding-top:5px;"><input id="buttonMovePageLeft" type="button" value=" " style="background-image:url(images/icore_next_btn_orange_left.png);background-color:#FFF; height:32px; width:39px; cursor:pointer; border:none;"  onclick="javascript:movepack('leftToright','<?=230*$tb_page_colocation->math("COUNT","domain_id=$domain_id_instant AND type='Colocation-Single' AND dc=0"); ?>');"/></div>
                <div style="height:36px; width:40px;float:left;padding-top:5px;"><input id="buttonMovePageRight" type="button" value=" " style="background-image:url(images/icore_next_btn_orange_right.png); background-color:#FFF;height:32px; width:39px;cursor:pointer; border:none;" onclick="javascript:movepack('rightToleft','<?=230*$tb_page_colocation->math("COUNT","domain_id=$domain_id_instant AND type='Colocation-Single' AND dc=0"); ?>');"/></div>
            </div>
    </div>
    <div style="margin:0 auto 0 auto;width:950px; height:29px; background-image:url(images/home_slider_shadow.png);"></div>
  	<!-- Inicia DIV -->
         <? 
            
            
			include("modules_service/module_dedicated_synapse.php");
            include("modules_service/module_support24-7.php");
            include("modules_service/module_core.php");
            include("modules_service/module_supplements.php");
            include("modules_service/module_user_manual.php");
            include("modules_service/module_otherinformation.php");
        ?>
        <!-- Finaliza DIV -->
    
  </div>
</div>