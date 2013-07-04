<script type="text/javascript">
/* 
Inicia: function login_core_manage_height trabaja expandiendo o contrayendo  id="login-core" 
*/
function login_core_manage_height(action){	
		// Obtenemos la altura de  id="login-core" y la convertimso a dato:tipo:int
		var login_core=document.getElementById("login-core").style.height;
		login_core=parseInt(login_core.replace("px",""));
		
		// Si la acción correspnde a expander la sig. condición se ejecutará
		if(action=="expand"){
			//mientras la altura del objeto sea menor a 280px la función se llamará con Recursividad, aumentando su "nueva altura" de +5px en +5px
			if(login_core<280){
				login_core=login_core+5;
				document.getElementById('login-core').style.height=login_core+"px";
				//mandamos llamar la función con recursividad y con action=expand cada 0.0001 segundos.
				setTimeout("login_core_manage_height('expand')",1);
				// mientras se esté ejecuntando if(action=expand) el objeto id="login-core-link" permanecerá oculto y, id="login-core-link-hide" permanecerá visible.
				document.getElementById('login-core-link').style.display='none';
				document.getElementById('login-core-link-hide').style.display='block';
				
				
			}
		}
		// Si la acción correspnde a contraer la sig. condición se ejecutará
		if(action=="contract"){
			//mientras la altura del objeto sea mayor a 5px la función se llamará con Recursividad, reduciendo su "nueva altura" de -5px en -5px
			if(login_core>5){
				login_core=login_core-5;
				document.getElementById('login-core').style.height=login_core+"px";
				//mandamos llamar la función con recursividad y con action=expand cada 0.0001 segundos.
				setTimeout("login_core_manage_height('contract')",1);
				document.getElementById('login-core-link').style.display='block';
				// mientras se esté ejecuntando if(action=contract) el objeto id="login-core-link" permanecerá visible y, id="login-core-link-hide" permanecerá oculto.
				document.getElementById('login-core-link-hide').style.display='none';
				
			}
		}
	}
/* Finaliza: function login_core_manage_height */
</script>
<!--
Inicia id="login-core" por defecto tiene una altura de 5px pero éste es manupulado con javascript:login_core_manage_height(action)
-->
<div id="login-core" style="height:5px; background-repeat:no-repeat; background-color:#272727; overflow:hidden; width:100%">
<? /*
<div id="login-core" style="background-image:url(images/bg-login-core.png);height:5px; background-repeat:no-repeat; background-color:#272727; overflow:hidden; width:100%">
	<div style="padding-left:330px;">
    	<div id="login-core-colum1" style="float:left;width:390px;">
        	<div id="login-core-right-line1" style="height:70px;padding-top:30px;">
            	<span style="font-size:32px;font-weight:600;color:#FBFBFB;">Acceso a Core</span>
            </div>
            <div id="login-core-right-line2" style="height:140px;">
            	<form method="post" action="<?=$link_core; ?>" style="padding-left:10px;">
                	<span style="font-size:13px;color:#F9F9F9; line-height:20px;">Email </span><br/>
                    <input type="text" name="email" style="font-size:18px; padding-left:7px; color:#666;"/>  <br/>
                    <span style="font-size:13px;color:#F9F9F9;line-height:20px;">Contraseña </span> <br/>
                    <input type="password" name="password" style="font-size:18px;padding-left:7px; color:#666;"/> <br/>
                    <div>
                    	<div style="float:left; font-size:11px; line-height:20px; padding-top:8px;">
                         <a href="<?=$tb_page_domain->obtenerDato("link_forgot_password","domain='".$page_domain."'");?>" style="color:#F2F2F2; text-shadow:none;">¿Olvidó su contraseña? </a>   
                         <a href="<?=$tb_page_domain->obtenerDato("link_if_new","domain='".$page_domain."'");?>" style="color:#F2F2F2; text-shadow:none; padding-left:10px;">¿Aún no es cliente?</a>
                        </div>
                    	<div style="float:right; padding-right:20px;">
                    	<input type="submit" style="background-image:url(images/login_portal_core_button.png); width:97px; height:29px; border:none; cursor:pointer;" value=""/>
                        </div>
                    </div>
               </form>
            </div>
        </div>
        <div id="login-core-colum2" style="float:left; padding-left:30px;">
        	<div id="login-core-left-line1" style="height:70px; padding-top:30px;">
            	<span style="font-size:32px;font-weight:600;color:#FBFBFB;"></span>
            </div>  
            <div id="login-core-left-line2" style="height:140;">
            </div>         
        </div>

    </div>
	*/ ?>
</div>
<!-- Finaliza: id="login-core" -->

<!-- 
Inicia: id="header" contine dentro id="header_objets" 
-->
<div id="header">
	<!-- 
    Inicia: id="header-objets" son todos los objetos universales y estáticos del sitio.
    -->
	<div id="header-objets" style="margin:0 auto 0 auto; width:960px;">
	  <!-- 
        Inicia: id="login-core-buton" es un objeto dentro de "header-objets" contiene los link para mostrar y ocultar id="login-core" 
        -->
      <div id="login-core-buton" style="text-align:right;height:18px;">
       	<div style="background-image:url(images/login-core-buton.png);float:right;width:171px;text-align:center;height:18px;">
          <? /* <a id="login-core-link" href="javascript:login_core_manage_height('expand');" style="font-weight:700;color:#FFF;text-shadow:none;">Portal Core</a> */ ?>
          <a id="login-core-link" href="<?=$link_core; ?>" target="_blank" style="font-weight:700;color:#FFF;text-shadow:none;">Portal Core</a>
          <a id="login-core-link-hide" href="javascript:login_core_manage_height('contract');" style="font-weight:700;color:#FFF;text-shadow:none; display:none;">Ocultar Pestaña</a>
        </div>
      </div>
      <!-- Finaliza:  id="login-core-buton" -->
      <!-- 
      Inicia: id="logo-contactus"  contiene un div donde se muestra el logo y contiene otro div que muestra el icon/text livechat&telefono
      -->
   	  <div id="logo-contactus" style="height:85px;">
      	<div style="float:left;"><a href="http://<?=$tb_page_domain->obtenerDato("domain","domain='".$page_domain."'")."/".$country;?>"><img src="/images/<?=$logo; ?>" width="317" height="65" alt="" style="border:none;" /></a></div>
		   <script type="text/javascript">
            function list_menu_height_manage(action){
                    if(action=="hide"){
                    document.getElementById('phone_list').style.height='30px';
                    document.getElementById('phone_list_sub').style.display='none';
                    document.getElementById('phone_list_max').style.display="block";
                    document.getElementById('phone_list_min').style.display="none";
                    }
                    if(action=="show"){
                    document.getElementById('phone_list').style.height='auto';
                    document.getElementById('phone_list_sub').style.display='block';
                    document.getElementById('phone_list_min').style.display="block";
                    document.getElementById('phone_list_max').style.display="none";
                    }
                    
                }
          </script>
       <div style="float:right; margin-top:10px;">
      	<div style="overflow:hidden;">
			
          	<div style="float:left;height:28px; margin-left:10px;border-right:solid 1px #EEE; margin-top:13px; background-image:url(images/livechat_icon.png);background-repeat:no-repeat;font-size:14px;font-weight:300; padding-left:33px; padding-top:4px; margin-right:15px; padding-right:8px;"> 
            		<a href="#" onclick="window.open('<?=$tb_page_domain->obtenerDato("link_livechat","domain_id='".$_SESSION['domain_id']."'");?>','chat','width=545,height=597,scrollbars=no,menubar=no,resizable=no,toolbar=no,titlebar=no,location=no,status=no');return false;" style="color:#000; cursor:pointer;">
                    	Iniciar Chat</a>
       		</div>
            
      	 	<? if($tb_page_division_phones->math("COUNT","division_id=$division_id")>0){ ?>
            
            <div style="float:left;">
            	
                <div id="phone_list" style="border:solid #EFEFEF 1px;height:32px;margin-top:10px; background-color:#F9F9F9;background-image:url(images/phone_icon.png); background-repeat:no-repeat;width:200px;">
                <div id="phone_list_max" style="float:right; display:block;"><img src="images/phone_list.png" width="31" height="25" alt="" onClick="list_menu_height_manage('show')" style="cursor:pointer;" /></div>
                    <div id="phone_list_min" style="float:right;display:none;"><img src="images/phone_close.png" width="31" height="25" alt="" onClick="list_menu_height_manage('hide')" style="cursor:pointer;" /></div>
            <?
                $flag_page_division_phones=0;
                $list_page_division_phones=$tb_page_division_phones->select("phone,city","division_id=$division_id");
                $row_page_division_phones=mysql_fetch_assoc($list_page_division_phones);
                do{
                    	if($flag_page_division_phones==0){
							?>
							<div style="padding-left:35px;">
                                <span style="font-size:12px;"><?=utf8_encode($row_page_division_phones['phone']); ?></span> <br/>
                                <span style="font-size:9px; font-weight:bold; padding-left:8px;"><?=utf8_encode($row_page_division_phones['city']); ?></span> <br/>
                            </div>
                            <div id="phone_list_sub" style="display:none;border:solid #EFEFEF 1px; padding-left:35px; border-top:none; position:absolute;width:163px;background-color:#F9F9F9;z-index:5;">
                            <span style="font-size:12px; color:#CCC;">----------------------</span><br/>
							<?
							}else{
							?>
							<span style="font-size:12px;"><?=utf8_encode($row_page_division_phones['phone']); ?></span> <br/>
                        	<span style="font-size:9px; font-weight:bold; padding-left:8px;"><?=utf8_encode($row_page_division_phones['city']); ?></span><br/>
                        	<span style="font-size:12px; color:#CCC;">----------------------</span><br/>
							<?	
								}
								$flag_page_division_phones++;
                    }while($row_page_division_phones=mysql_fetch_assoc($list_page_division_phones));
            ?>
            			</div><!-- <-Este div cierra el listado que es muestra y se oculta -->
            </div>
            </div>
       	<? } ?>    
        	
           	<div style="float:left; width:190px; margin-bottom:5px; margin-top:7px; margin-left:10px; overflow:hidden;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px; color:#333;text-shadow: 0 1px 0 #F9F9F9;" id="back_car" class="redondeo5px">
        		<div style="width:35px; float:left; background-image:url(images/icon_car.png); background-repeat:no-repeat; height:32px;"></div>
            	<div style="float:left; height:32px; padding-top:7px; font-size:15px; font-weight:800; text-align:right; width:25px;" id="shopping_car_total_items">
				<? 
				echo $tb_page_orders->math("COUNT","order_status='in_car' AND client_id=".$_SESSION['client_id']);
				?></div>
           		<div style="float:left; height:32px; padding-top:8px;  margin-left:3px; font-size:14px; font-weight:400;"><a href="<?=$country.$_SESSION['page_seccion']; ?>?opacity=true&amp;car_action=show_car">items en tu órden</a></div>
            	    
				<div style="position:absolute; z-index:8; margin-left:-600px; margin-top:30px; overflow:hidden;" id="shopping_car">
					<? 
					if(isset($_GET['car_action'])){	
						switch($_GET['car_action']){
							case "add_service":{
								include("shopping_car_addservice.php");
								include("shopping_car_order_v2.php");
							break;
							}
							case "add":{
								include("shopping_car_add.php");
								include("shopping_car_order_v2.php");
							break;
							}
							case "show_car":{
								include("shopping_car_order_v2.php");
								break;
								}
							case "delete":{
								include("shopping_car_delete.php");
								include("shopping_car_order_v2.php");
								break;
							}
						}
					}
					 ?>
            	</div>
                <script type="text/javascript">
		   		function shoppingcar_visibility(action){
						if(action=="hide"){
								document.getElementById('shopping_car').style.display="none";
								location.href="<?=$country.$_SESSION['page_seccion']; ?>";
							}
						if(action=="show"){
								document.getElementById('shopping_car').style.display="block";
							}	
					}
					
		   </script> 
           
           </div>
      	</div>
       </div>
     </div>
      <!-- Finaliza: id="logo-contactus" -->
       <script type="text/javascript"> /*
                Inicia: funcion header_menu_item_selected su función es asignarle una imagen de fondo a:
                id="header_menu_buton_left"
                id="header_menu_buton_center"
                id="header_menu_buton_right"
                */
                function header_menu_item_selected(left,center,right){	
                    document.getElementById(left).style.background='url(images/header_menu_buton_left.png)';
                    document.getElementById(center).style.background='url(images/header_menu_buton_center.png)';
                    document.getElementById(right).style.background='url(images/header_menu_buton_right.png)';
                }
                /* 
                Finaliza: funcion header_menu_item_selected 
                */
        </script>
      <!-- 
      Inicia: id="menuitems"  es el contenedor del menú superior del sitio, el principal.
      -->
      <div id="menuitems" style="background-image:url(images/background_header_menu.png); background-repeat:no-repeat; height:45px; width:950px; padding-top:5px; padding-left:10px;">
      	<!-- Las opciones de éste menú están en archivo independiente. -->
		<? include("header_menu_items.php");?> 
      </div>
      <!-- Finaliza  id="menuitems" -->    
    </div>
  <!-- Finaliza id="header-objets" --> 
</div>
<!-- Finaliza  id="header" -->