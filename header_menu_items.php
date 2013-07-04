<script type="text/javascript">
				<? 
				$hdlatam="hostdime.la";
				$hdcolombia="hostdime.com.co";
				$hdmexico="hostdime.com.mx";
				// Definimos los menús superiores.
				$menu[1]["item"]="Inicio"; // item: es el texto visible al usuario
				$menu[1]["width"]="35"; // width: es el ancho del item cada item es diferente para mejorar el diseño.
				$menu[1]["link"]="/"; // link: es la URL a la que mandará el item
				$menu[1]["options"]=""; // Si el menú tiene submenus estos serán puestos en codigo html usando vieñetas y usando las  clase en CSS:header_menu (para <ul>), submenu_background_top (para el primer <li> el cual no llevará texto),submenu_background_medium(el cual dibujará el item) y submenu_background_bottom (para el ultimo <li> el cual no llevará texto).
				
				$menu[2]["item"]="HostDime";
				$menu[2]["width"]="60";
				$menu[2]["link"]="/hostdime/";
				$menu[2]["options"]="
							<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/personal/\">Nuestro personal</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/instalaciones/\">Nuestras instalaciones</a>
									<ul style=\"z-index:1;\">
										<li class=\"submenu_background_top\"></li>
										<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/instalaciones/centrodedatos\">Centro de datos</a></li>
										<li class=\"submenu_background_medium\"><a href=\"$country/global/\">Oficinas en el mundo</a></li>                      
										<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/instalaciones/monitoreodered/\">Monitoreo de red</a></li>
										<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/instalaciones/infraestructuradered/\">Infraestructura de red</a></li>
										<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/instalaciones/velocidaddedescarga/\">Velocidad de descarga</a></li>
										<li class=\"submenu_background_bottom\"></li>
									</ul>
									</li>
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/marcas/\">Nuestras marcas</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/socios/\">Nuestros socios</a></li>
							
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/comunicados/\">Comunicados</a></li>
							
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/programascomunitarios/\">Programas comunitarios</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/logos-identidades/\">Logos e identidades</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/legal/\">Legal</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";
						/* Este link ponerlo abajo de <li class=\"submenu_background_medium\"><a href=\"$country/hostdime/comunicados/\">Comunicados</a></li>
						<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/carrera/\">Carrera en HostDime</a></li>  en la tabla_link meter hostdime_careers.php */
						/*
						Este link ponerlo abajo de <li class=\"submenu_background_medium\"><a href=\"$country/hostdime/socios/\">Nuestros socios</a></li>
						<li class=\"submenu_background_medium\"><a href=\"$country/hostdime/blog/\">Nuestro blog</a></li> en la tabla_link meter hostdime_blog.php*/
				
				$menu[3]["item"]="Web Hosting";
				$menu[3]["width"]="80";
				$menu[3]["link"]="/web-hosting/";
				$menu[3]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\"><a href=\"$country/web-hosting/individual-linux-cpanel/\">Individual Linux con cPanel</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/web-hosting/individual-windows-pesk/\">Individual Windows con Plesk</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/web-hosting/reseller-linux-whm-cpanel/\">Reseller Linux con WHM cPanel</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/web-hosting/reseller-windows-plesk/\">Reseller Windows con Plesk</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";
				
				$menu[4]["item"]="VPS";
				$menu[4]["width"]="35";
				$menu[4]["link"]="/vps/";
				$menu[4]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\"><a href=\"$country/vps/linux/\">VPS Linux</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/vps/windows/\">VPS Windows</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";
						
				$menu[5]["item"]="Servidores";
				$menu[5]["width"]="70";
				$menu[5]["link"]="/servidores-dedicados/";
				$menu[5]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
								<li class=\"submenu_background_medium\"><a href=\"$country/servidores-dedicados/rentarpersonalizados/\">Para rentar personalizados</a></li>
								
								
							<li class=\"submenu_background_bottom\"></li>
						</ul>";	
						/*
						Este código se debe poner abajo de <li class=\"submenu_background_medium\"><a href=\"$country/servidores-dedicados/rentarinstataneos/\">Para rentar instantáneos  </a></li>
						<li class=\"submenu_background_medium\"><a href=\"$country/servidores-dedicados/comprar-colocar/\">Para comprar y colocar </a></li>
						*/

						
				$menu[6]["item"]="Colocación";
				$menu[6]["width"]="65";
				$menu[6]["link"]="/colocacion/";
				$menu[6]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\"><a href=\"$country/colocacion/servidorindividual/gdl/\">Guadalajara, Jal</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/colocacion/servidorindividual/\">Orlando, FL</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";	
						/*
						Este código se debe poner abajo de <li class=\"submenu_background_medium\"><a href=\"$country/colocacion/servidorindividual/\">Servidor individual</a></li>
						<li class=\"submenu_background_medium\"><a href=\"$country/colocacion/rackprivado/\">Racks privados</a></li>
						*/
				$menu[7]["item"]="Streaming";
				$menu[7]["width"]="65";
				$menu[7]["link"]="/streaming/";
				$menu[7]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\">Audio individual</li>
							<li class=\"submenu_background_medium\"><a href=\"$country/streaming/individual/\">-> Streaming en MP3</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/streaming/aac/\">-> Streaming AAC+ Plus V2</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/streaming/reseller/\">Audio reseller</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";
						
				/* $menu[8]["item"]="Soluciones";
				$menu[8]["width"]="80";
				$menu[8]["link"]="/soluciones/";
				$menu[8]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\"><a href=\"$country/soluciones/webhosting/\">Para negocio de web hosting</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";	
						este codigo moverlo en la linea en blanco debe ir <li class=\"submenu_background_medium\"><a href=\"$country/soluciones/webhosting/\">Para negocio de web hosting</a></li>
							
							<li class=\"submenu_background_medium\"><a href=\"$country/soluciones/audio/\">Para audio</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/soluciones/emailmarketing/\">Para email marketing</a></li>
							
							<li class=\"submenu_background_medium\"><a href=\"$country/soluciones/sitio-wordpress/\">Sitio web con Wordpress</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/soluciones/tiendavirtual-magento/\">Tienda virtual con Magento</a></li>	
							<li class=\"submenu_background_medium\"><a href=\"$country/soluciones/alta-disponibilidad/\">Para alta disponibilidad</a></li>
							<li class=\"submenu_background_medium\"><a href=\"#\">Comunicaciones Unificadas</a></li>	
							<li class=\"submenu_background_medium\"><a href=\"#\">Consultoría</a></li>
						*/
				$menu[8]["item"]="Dominios";
				$menu[8]["width"]="90";
				$menu[8]["link"]="/dominios/registrar/";
				$menu[8]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\"><a href=\"$country/dominios/precios/\">Lista de precios</a></li>
							<li class=\"submenu_background_medium\"><a href=\"$country/dominios/revendedor/\">Revendedor de dominios</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";
				$menu[9]["item"]="Ayuda";
				$menu[9]["width"]="50";
				$menu[9]["link"]="/ayuda-contacto/";
				$menu[9]["options"]="";	
				$menu[10]["item"]="Global";
				$menu[10]["width"]="50";
				$menu[10]["link"]="/global/";
				$menu[10]["options"]="
						<ul class=\"header_menu\">
							<li class=\"submenu_background_top\"> </li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-ar' alt='Argentina' />&nbsp;&nbsp;<a href=\"http://$hdlatam/argentina\">HostDime Argentina</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-br' alt='Brasil' />&nbsp;&nbsp;<a href=\"http://www.hostdime.com.br/\" target=\"_blank\">HostDime Brasil</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-bo' alt='Bolivia' />&nbsp;&nbsp;<a href=\"http://hostdime.bo\">HostDime Bolivia</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-cl' alt='Chile' />&nbsp;&nbsp;<a href=\"http://hostdime.cl\">HostDime Chile</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-co' alt='Colombia' />&nbsp;&nbsp;<a href=\"http://$hdcolombia/\">HostDime Colombia</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-cr' alt='Costa Rica' />&nbsp;&nbsp;<a href=\"http://hostdime.cr\">HostDime Costa Rica</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-ec' alt='Ecuador' />&nbsp;&nbsp;<a href=\"http://hostdime.ec\">HostDime Ecuador</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-sv' alt='Salvador' />&nbsp;&nbsp;<a href=\"http://hostdime.com.sv\">HostDime El Salvador</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-es' alt='España' />&nbsp;&nbsp;<a href=\"http://hostdime.es\">HostDime España</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-gt' alt='Guatemala' />&nbsp;&nbsp;<a href=\"http://hostdime.com.gt\">HostDime Guatemala</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-hn' alt='Honduras' />&nbsp;&nbsp;<a href=\"http://hostdime.hn\">HostDime Honduras</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-in' alt='India' />&nbsp;&nbsp;<a href=\"http://www.hostdime.in\" target=\"_blank\">HostDime India</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-mx' alt='México' />&nbsp;&nbsp;<a href=\"http://$hdmexico\">HostDime México</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-ni' alt='Nicaragua' />&nbsp;&nbsp;<a href=\"http://hostdime.com.ni\">HostDime Nicaragua</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-pa' alt='Panamá' />&nbsp;&nbsp;<a href=\"http://hostdime.com.pa\">HostDime Panamá</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-py' alt='Paraguay' />&nbsp;&nbsp;<a href=\"http://hostdime.com.py\">HostDime Paraguay</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-pe' alt='Perú' />&nbsp;&nbsp;<a href=\"http://hostdime.pe\">HostDime Perú</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-pr' alt='Puerto Rico' />&nbsp;&nbsp;<a href=\"http://$hdlatam/puertorico\">HostDime Puerto Rico</a></li>
							
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-gb' alt='Reino Unido' />&nbsp;&nbsp;<a href=\"http://www.hostdime.co.uk\" target=\"_blank\">HostDime Reino Unido</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-do' alt='R. Dominicana' />&nbsp;&nbsp;<a href=\"http://hostdime.do\">HostDime R. Dominicana</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-us' alt='USA' />&nbsp;&nbsp;<a href=\"http://www.hostdime.com\" target=\"_blank\">HostDime USA</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-uy' alt='Uruguay' />&nbsp;&nbsp;<a href=\"http://hostdime.com.uy\">HostDime Uruguay</a></li>
							<li class=\"submenu_background_medium\"><img src='images/blank.gif' class='flag flag-ve' alt='Venezuela' />&nbsp;&nbsp;<a href=\"http://$hdlatam/venezuela\">HostDime Venezuela</a></li>
							<li class=\"submenu_background_bottom\"></li>
						</ul>";	

				// Según sean la cantidad de menús en forma manual se define la variable $totalitems			
				$totalitems=10;
				?>
				
				/*
				Inicia: function hide_submenu: oculta o muestra los submenus
				*/ 
				function hide_submenu(exceptsubmenu,exceptleft,exceptcenter,exceptright){
					// Oculta todos los submenus.
					<? for($x=1;$x<=$totalitems;$x++) { ?>
					document.getElementById('submenu_header<?=$x;?>').style.display='none';
					document.getElementById('header_menu_buton_left<?=$x;?>').style.background='none';
					document.getElementById('header_menu_buton_center<?=$x;?>').style.background='none';
					document.getElementById('header_menu_buton_right<?=$x;?>').style.background='none';
					<? } ?>
					// Una vez que están ocultos puede hacer excepción con algún submenu.
					if(exceptsubmenu!=""){
					document.getElementById(exceptsubmenu).style.display='block';
					document.getElementById(exceptleft).style.background='url(images/header_menu_buton_left.png)';
					document.getElementById(exceptcenter).style.background='url(images/header_menu_buton_center.png)';
					document.getElementById(exceptright).style.background='url(images/header_menu_buton_right.png)';
					}
					
				}
				/*Finaliza: function hide_submenu */
				</script>
                <!-- Inicia  id="header_menus_container_btns" lugar donde estarán dibujados los botones de menús -->
<div id="header_menus_container_btns" style="height:31px;">
<? 
// El sig. for construirá los menus. 
for($x=1;$x<=$totalitems;$x++){ ?>
	<!-- Los menús están formados en 3 partes  (sombras) vease CSS: header_btn_left,header_btn_center,header_btn_right  -->
    <!-- 1. Parte izquierda  -->
	<div id="header_menu_buton_left<?=$x;?>" class="header_btn_left"></div>
    <!-- 2. Parte central-->
    <div id="header_menu_buton_center<?=$x;?>" class="header_btn_center" style="width:<?=$menu[$x]["width"]."px"; ?>;">
        <div style="padding-top:8px; text-align:center;">
        	<!-- en onmouseover oculta todas las sobmras del los menus excepto la "actual" -->
            <a href="<?
            if( $menu[$x]["link"]=="/" ||
				$menu[$x]["link"]=="/hostdime/" || 
				$menu[$x]["link"]=="/ayuda-contacto/" ||
				$menu[$x]["link"]=="/dominios/registrar/" ||
				$menu[$x]["link"]=="/global/"
				){
				echo $country.$menu[$x]["link"];
				}else{
					echo $country.$page_seccion."#";
					}
			?>" onmouseover="hide_submenu('submenu_header<?=$x; ?>','header_menu_buton_left<?=$x; ?>','header_menu_buton_center<?=$x; ?>','header_menu_buton_right<?=$x; ?>');"><?=$menu[$x]["item"];?></a>   
        </div>
    </div>
    <!-- 3. Parte derecha-->
    <div id="header_menu_buton_right<?=$x;?>" class="header_btn_right"></div>
    <? 
	$page_seccion_bg=explode("/",$page_seccion);
	if($page_seccion_bg[1]!=""){
	$page_seccion_bg="/".$page_seccion_bg[1]."/";
	}else $page_seccion_bg="/";
	
	if($page_seccion_bg==$menu[$x]["link"]){ 
		
	?>
        <script type="text/javascript">
		header_menu_item_selected('header_menu_buton_left<?=$x?>','header_menu_buton_center<?=$x?>','header_menu_buton_right<?=$x?>');
		function current_header_menu_selected(){
			header_menu_item_selected('header_menu_buton_left<?=$x?>','header_menu_buton_center<?=$x?>','header_menu_buton_right<?=$x?>');
			}
        </script>
        <? }?>
	<? }
?>
</div>
<!-- Finaliza  id="header_menus_container_btns" -->
<? for($x=1;$x<=$totalitems;$x++){ ?>
<!-- Inicia  id="submenu<?=$x; ?>" es un div que tiene  width:<?=$menu[$x]["width"];?> que es decir el mismo que "el centro del menú principal" (recordemos que los menus principales se componen de 3 partes y la central es la parte #2. Y como deseamos que el submenu<?=$x; ?>  tenga la misma anchura sumamos 20px para recompensar la Parte#1 y Parte#3 -->
<div id="submenu<?=$x;?>" style="border:solid 1px #F2F2F2; float:left;width:<?=$menu[$x]["width"]+20; ?>px; ">
	<div id="submenu_header<?=$x;?>" style="display:none;position:absolute;z-index:6" >
    <?=$menu[$x]["options"];?>
    </div>
</div>
<!-- Finaliza  id="submenu<?=$x; ?>" -->
<? } ?>
