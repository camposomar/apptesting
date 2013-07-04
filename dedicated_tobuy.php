<div style="overflow:hidden;">
	 <div style="margin:0 auto 0 auto;border:none;width:950px;margin-top:3px;">
     <? include("dedicated_personalized_slider.php");?>
    <div style="margin:0 auto 0 auto;width:950px; height:29px; background-image:url(images/home_slider_shadow.png);"></div>
    <div style="padding-top:25px; overflow:hidden;">
    	<div style="width:230px;float:left;background-image:url(images/dedicated_features.png); height:282px; margin-left:10px;"></div>
      		<div id="slider_contenedor_fijo" style="width:690px; height:470px; float:left; overflow:hidden; margin-left:5px;">
                <div style="height:470px; position:relative; width:<?=230*$tb_page_dedicated_package->math("COUNT","domain_id=$domain_id AND type='Server-toBuy'"); ?>px; left:0px;" id="home_slide_pack">
                 
                 <? 
				 
				  	$list_page_dedicated_package=$tb_page_dedicated_package->select("processor,processor_icon,bandwidth,bandwidth_max,disk_space,disk_space_max,memory,memory_max,ethernetport,ethernetport_max,monthly_price,price_centos_cpanel,link_tobuy,price_windows,price_windows_plesk","domain_id=$domain_id AND type='Server-toBuy'");
	 				$row_page_dedicated_package=mysql_fetch_assoc($list_page_dedicated_package);		
					do{  ?>
					 <div style="width:230px;float:left;background-image:url(images/dedicated_background_package.png);height:470px;">
                    	<div style="height:50px; background-color:#666; margin-right:11px; margin-left:3px; margin-top:5px;">
                        	<div style="float:left; padding-left:5px; padding-top:2px; overflow:hidden; width:160px;">
                            	<div style="font-weight:bold; font-size:16px; color:#FFF">Procesador</div>
                                <div style="color:#FAFAFA"><?=$row_page_dedicated_package['processor']; ?></div>
                            </div>
                            <div style="float:right; padding-top:7px; padding-right:8px;"><img src="images/<?=$row_page_dedicated_package['processor_icon'];?>" width="42" height="32"  alt=""/></div>
                      </div>
                        <div style="height:4px; background-color:#CCCCCC;margin-right:11px; margin-left:3px;"></div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #F5F5F5;margin-top:13px; padding-left:4px; padding-top:16px; font-size:12px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';"><strong style="color:#06C;">mín.</strong> <?=$row_page_dedicated_package['bandwidth'] ?>GB <strong  style="color:#06C;">máx. </strong> <?=$row_page_dedicated_package['bandwidth_max'] ?></div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #F5F5F5;background-color:#FAFAFA;padding-left:4px; padding-top:16px; font-size:12px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FAFAFA';"><strong style="color:#F60;">mín.</strong> <?=$row_page_dedicated_package['disk_space'] ?>GB <strong style="color:#F60;">máx.</strong> <?=$row_page_dedicated_package['disk_space_max'] ?></div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #F5F5F5;padding-left:4px; padding-top:16px; font-size:12px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';"><strong  style="color:#06C;">mín.</strong> <?=$row_page_dedicated_package['memory'] ?>MB  <strong  style="color:#06C;">máx.</strong> <?=$row_page_dedicated_package['memory_max'] ?>MB </div>
                        <div style="height:4px; margin-left:3px; height:32px;margin-right:11px;border-bottom:solid 1px #CCC; margin-bottom:4px;background-color:#FAFAFA;padding-left:4px; padding-top:16px; font-size:12px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FAFAFA';"><strong style="color:#F60;">mín.</strong> <?=$row_page_dedicated_package['ethernetport'] ?>Mbps. <strong style="color:#F60;">máx.</strong> <?=$row_page_dedicated_package['ethernetport_max'] ?>Mbps.</div>
                        <div style="height:4px; margin-left:3px; height:33px;margin-right:11px;border-bottom:solid 1px #F5F5F5; text-align:right;padding-top:3px; padding-right:3px;"  onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
                         	<div style="font-size:14px;font-weight:bold;">$<?=number_format($row_page_dedicated_package['monthly_price']*$tb_page_division->obtenerDato("taxes","division_id=$division_id"),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'")?>/mes</div>
                       	 	<div style="font-size:10px; color:#F60; padding-left:7px;color:#999;">Sistema Operativo Linux </div>
                        </div>
                        <div style="height:4px; margin-left:3px; height:33px;margin-right:11px;border-bottom:solid 1px #F5F5F5; text-align:right;padding-top:3px; padding-right:3px;"  onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
                         	<div style="font-size:14px;font-weight:bold; color:#06C;">$<?=number_format($row_page_dedicated_package['price_centos_cpanel']*$tb_page_division->obtenerDato("taxes","division_id=$division_id"),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?>/mes</div>
                       	 	<div style="font-size:10px; color:#F60; padding-left:7px;color:#999;">CentOS + cPanel / WHM </div>
                        </div>
                        <div style="height:4px; margin-left:3px; height:33px;margin-right:11px;border-bottom:solid 1px #F5F5F5; text-align:right;padding-top:3px; padding-right:3px;"  onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
                         	<div style="font-size:14px;font-weight:bold;">$<?=number_format($row_page_dedicated_package['price_windows']*$tb_page_division->obtenerDato("taxes","division_id=$division_id"),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?>/mes</div>
                       	 	<div style="font-size:10px; color:#F60; padding-left:7px;color:#999;">Windows 2008 Server Standard R2</div>
                        </div>
                        <div style="height:4px; margin-left:3px; height:33px;margin-right:11px;border-bottom:solid 1px #F5F5F5; text-align:right;padding-top:3px; padding-right:3px;"  onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
                         	<div style="font-size:14px;font-weight:bold;">$<?=number_format($row_page_dedicated_package['price_windows_plesk']*$tb_page_division->obtenerDato("taxes","division_id=$division_id"),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?>/mes</div>
                       	 	<div style="font-size:10px; color:#F60; padding-left:7px;color:#999;">Windows 2008 Server Standard R2 + Plesk </div>
                        </div>
                        <div style="text-align:center; overflow:hidden; padding-top:2px;">
                        	<a href="<?=$row_page_dedicated_package['link_tobuy']; ?>"><img src="images/icon_order_btn_orange.png" alt="" style="cursor:pointer; border:none;"/></a>
                        </div>
                    </div>
                    
                   <? }while($row_page_dedicated_package=mysql_fetch_assoc($list_page_dedicated_package)); ?>
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
                <div style="height:36px; width:40px;float:left;padding-top:5px;"><input id="buttonMovePageLeft" type="button" value=" " style="background-image:url(images/icore_next_btn_orange_left.png);background-color:#FFF; height:32px; width:39px; cursor:pointer; border:none;"  onclick="javascript:movepack('leftToright','<?=230*$tb_page_dedicated_package->math("COUNT","domain_id=$domain_id AND type='Server-toBuy'"); ?>');"/></div>
                <div style="height:36px; width:40px;float:left;padding-top:5px;"><input id="buttonMovePageRight" type="button" value=" " style="background-image:url(images/icore_next_btn_orange_right.png); background-color:#FFF;height:32px; width:39px;cursor:pointer; border:none;" onclick="javascript:movepack('rightToleft','<?=230*$tb_page_dedicated_package->math("COUNT","domain_id=$domain_id AND type='Server-toBuy'"); ?>');"/></div>
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