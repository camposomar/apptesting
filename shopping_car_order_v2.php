<? if($tb_page_orders->math("COUNT","order_status='in_car' AND client_id=".$_SESSION['client_id'])>0){ ?>
<div style="text-align:right; padding-right:180px;border:none;"><img src="images/arrow_up.png" alt="" style="border:none;" /></div>

<div style="overflow:hidden;border:solid 1px #999;margin-top:-3px;width:900px; background-color:#FFF;z-index:7;alpha(opacity=97);-moz-opacity:.97;opacity:.97;text-shadow:none;" class="redondeo10px"> 
		<div style="height:30px; background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px; margin:7px; margin-top:3px;" class="redondeo5px"> 
    	Resumen de tu órden</div>
      	<div style="border-bottom:solid 1px #CCC; overflow:hidden; background-color:#F6F6F6; padding-top:5px; padding-bottom:5px; margin-bottom:10px; margin-left:10px; margin-right:10px;">
            	<div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:180px;margin-left:15px;"> Servicio</div>
               	<div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:70px;margin-left:15px;"> Ciclo </div>
                <div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:230px;margin-left:15px;"> ¿Tiempo que pagaré?</div>
                <div style="border-right:solid 1px #CCC;float:left;font-weight:800;width:120px;margin-left:15px;"> Mi siguiente pago</div>
                <div style="float:left;width:90px;margin-left:15px;"> Eliminar </div>
        </div>
		<?
		$list_orders=$tb_page_orders->select("order_id,order_status,service_type,price_cicle,service_name,cicle_type,first_date_prorate_of,first_date_prorate_to,first_prorate_quantity,signupdate_less26,second_date_prorate_of,second_date_prorate_to,second_prorate_quantity,datenext_renew,note_1,note_2","order_status='in_car' AND client_id=".$_SESSION['client_id']);
		$row_orders=mysql_fetch_assoc($list_orders);
		$amounttopay=0;
		do {
		 ?>
        <div onmouseover="style.backgroundColor='#E8E8E8';" onmouseout="style.backgroundColor='#FFF';" style="border-bottom:solid 1px #EEE; overflow:hidden;margin-bottom:10px; padding-top:5px;margin-left:10px; margin-right:10px;">
            	<div style="border-right:solid 1px #CCC;float:left;width:180px;margin-left:15px; font-size:11px;">
					<div style="float:left; margin-right:2px;"><? 
						if($row_orders['service_type']=="windows_shared" || $row_orders['service_type']=="windows_reseller"){ ?>
                        <img src="images/icon_windows.png" alt="" />
						<? }
						if($row_orders['service_type']=="linux_shared" || $row_orders['service_type']=="linux_reseller"){ ?>
						<img src="images/icon_linux.png" alt=""  />	
						<? }
						if($row_orders['service_type']=="streaming_shared" || $row_orders['service_type']=="streaming_reseller"){ ?>
                        <img src="images/icon_streaming_shared.png" alt=""  />	
						<? }?>
                        <?
                        if($row_orders['service_type']=="domain-registry"){ ?>
                        <img src="images/icon_settings.png" alt=""  />	
						<? }?>
                        
                    </div>
                    <div style="float:left;">	
						<strong style="font-size:14px; color:#F60;">
						<?=$row_orders['service_name']; ?></strong>
                        <br />
                        <?=$row_orders['note_1']; ?>
                        <br />
                        <strong><?=$row_orders['note_2']?></strong>
                        <br />
                        <? if($row_orders['service_type']!="domain-registry"){ ?>
                        <strong style="color:#F00;">Precio con Promoción</strong>
                        <? } ?>
                    </div>
                </div>
             	<div style="border-right:solid 1px #CCC;float:left;width:70px;margin-left:15px; color:#000; font-weight:700;">
				<? 
				if($row_orders['cicle_type']=="yearly") echo "Anual"; 
				if($row_orders['cicle_type']=="2yearly") echo "2 Años"; 
				if($row_orders['cicle_type']=="3yearly") echo "3 Años"; 
				if($row_orders['cicle_type']=="4yearly") echo "4 Años"; 
				if($row_orders['cicle_type']=="5yearly") echo "5 Años"; 
				if($row_orders['cicle_type']=="6yearly") echo "6 Años"; 
				if($row_orders['cicle_type']=="7yearly") echo "7 Años"; 
				if($row_orders['cicle_type']=="8yearly") echo "8 Años"; 
				if($row_orders['cicle_type']=="9yearly") echo "9 Años"; 
				if($row_orders['cicle_type']=="monthly") echo "Mensual"; ?>
                </div>
                <div style="border-right:solid 1px #CCC;float:left;width:220px;margin-left:15px; font-size:11px; padding-right:10px;">
                	<div style="overflow:hidden; border-bottom:solid 1px #F0F0F0;margin-bottom:5px; padding-bottom:3px;">
                        <div style="overflow:hidden; float:left;">
                            <div style="color:#06C; font-weight:700;">del <?=converdate($row_orders['first_date_prorate_of']); ?></div>
                            <div>al <?=converdate($row_orders['first_date_prorate_to']); ?></div>
                        </div>
                        <div style="overflow:hidden; float:right; font-size:12px; color:#F00;">
                             $<?=number_format($row_orders['first_prorate_quantity'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'");?>
                        </div>
                   </div>
                   <? if($row_orders['signupdate_less26']=="YES" && $row_orders['cicle_type']=="monthly") {?><div style="overflow:hidden;margin-bottom:5px;">
                    	<div style="overflow:hidden; float:left;">
                        	<div style="color:#06C; font-weight:700;">del <?=converdate($row_orders['second_date_prorate_of']); ?></div>
                    		<div>al <?=converdate($row_orders['second_date_prorate_to']); ?></div> 
                        </div>
                        <div style="overflow:hidden; float:right; font-size:12px; color:#F00;">
                             $<?=number_format($row_orders['second_prorate_quantity'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'");?>
                        </div>       
                    </div>    
                  <? } ?>  
                  <? if($row_orders['cicle_type']=="yearly" && $row_orders['service_type']!="domain-registry") {?><div style="overflow:hidden;margin-bottom:5px;">
                    	<div style="overflow:hidden; float:left;">
                        	<div style="color:#06C; font-weight:700;">del <?=converdate($row_orders['second_date_prorate_of']); ?></div>
                    		<div>al <?=converdate($row_orders['second_date_prorate_to']); ?></div> 
                        </div>
                        <div style="overflow:hidden; float:right; font-size:12px; color:#F00;">
                             $<?=number_format($row_orders['second_prorate_quantity'],2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'");?>
                        </div>       
                    </div>    
                  <? } ?>
                  
                  <? 
				  	if($row_orders['cicle_type']=="monthly" && $row_orders['signupdate_less26']=="NO"){
							$amounttopay=$amounttopay+$row_orders['first_prorate_quantity'];
						}
					if(($row_orders['cicle_type']=="yearly" || $row_orders['cicle_type']=="2yearly" || $row_orders['cicle_type']=="3yearly" || $row_orders['cicle_type']=="4yearly" || $row_orders['cicle_type']=="5yearly" || $row_orders['cicle_type']=="6yearly" || $row_orders['cicle_type']=="7yearly" || $row_orders['cicle_type']=="8yearly" || $row_orders['cicle_type']=="9yearly") && ($row_orders['service_type']=="domain-registry")){
							$amounttopay=$amounttopay+($row_orders['first_prorate_quantity']);
						}	
					if($row_orders['cicle_type']=="monthly" && $row_orders['signupdate_less26']=="YES"){
							$amounttopay=$amounttopay+($row_orders['first_prorate_quantity']+$row_orders['second_prorate_quantity']);
						}
					if($row_orders['cicle_type']=="yearly" && $row_orders['service_type']!="domain-registry"){
							$amounttopay=$amounttopay+($row_orders['first_prorate_quantity']+$row_orders['second_prorate_quantity']);
						}		
				  ?>
                   
                </div>
                <div style="border-right:solid 1px #CCC;float:left;width:110px;margin-left:15px; text-align:right; padding-right:10px;">
					<div style="color:#06C; font-size:11px;font-weight:700;"><?=converdate($row_orders['datenext_renew']); ?> </div>
                    <div style="color:#666; font-size:10px;">por $<?=number_format($row_orders['price_cicle'],2);?> 
						<?=$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'");?></div>
                </div>
                <div style="float:left;width:90px;margin-left:5px;"> <a href="<?=$country.$_SESSION['page_seccion'];?>?opacity=true&car_action=delete&order_id=<?=$row_orders['order_id']; ?>&token=<?=$tb_page_token->obtenerDato("token_key","status='available' order by rand()"); ?>"><img src="images/btn_deliminar.png" alt="" style="border:none; cursor:pointer;" /> </a></div>	
        </div>
<? }while($row_orders=mysql_fetch_assoc($list_orders)); ?>
      
<div style="overflow:hidden; border-top:solid 1px #F0F0F0;border-bottom:solid 1px #F0F0F0; margin-left:7px; margin-right:7px; padding-top:3px;">
	<div style="float:left;width:475px; font-size:18px; text-align:right; padding-top:5px;">
	total: $<?=number_format($amounttopay,2); ?> <?=$tb_page_domain->obtenerDato("currency","domain_id='".$_SESSION['domain_id']."'");?>
   	</div>
    <div style="float:right; margin-right:7px;">
    <img src="images/shopping_continue.png" alt="" style="border:none; cursor:pointer;" onclick="javascript:shoppingcar_visibility('hide');show_hide_opacity('hide');" />
    </div>
</div>

<div style="height:30px; background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px;margin-top:15px; margin-bottom:5px; margin-left:7px; margin-right:7px;" class="redondeo5px">Datos de Cliente</div>

<div style="margin:7px; padding-top:5px; padding-bottom:5px; padding-left:10px; border:solid 1px #F7F7F7; overflow:hidden;">
	<div style="font-weight:800; font-size:15px; padding-bottom:10px;">
	<input type="radio" name="client_type" id="client_type_existent" value="existent" checked="checked" onclick="document.getElementById('client_details').style.display='none';document.getElementById('client_login').style.display='block';"/> 
	Soy cliente de HostDime</div>
	<div style="font-weight:800; font-size:15px;">
	<input type="radio" name="client_type" id="client_type_new_client" value="new_client" onclick="document.getElementById('client_details').style.display='block';document.getElementById('client_login').style.display='none';" /> 
	Soy nuevo en HostDime</div>
</div>
  
<form action="<?=$_SESSION['country']; ?>/ayuda-contacto/pedido-completo/" method="post" name="client_login" id="client_login" style="display:block;">
<div style="overflow:hidden; border:solid 1px #EFEFEF;  margin-bottom:15px;margin-left:7px; margin-right:7px; overflow:hidden;" class="redondeo10px">

	<div style="padding-left:20px; padding-right:20px; padding-top:15px; padding-bottom:15px;  width:390px; float:left; border:solid 1px #CCC; margin:10px;" class="redondeo10px">
    		<div><input type="hidden" name="form_id" value="existent_client" /></div>
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Email/Core:</div>
            <div><input type="text" name="client_emailcore" id="client_emailcore" style="font-size:14px; width:230px; margin-top:3px; color:#633;"/></div>
            <div style="font-size:10px; color:#F00;"></div>
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Contraseña:</div>
            <div><input type="password" name="client_passwordcore" id="client_passwordcore" style="font-size:14px; width:230px; margin-top:3px; color:#633;"/></div>
            <div style="font-size:10px; color:#F00;"></div>
            <div style="margin-top:20px; text-align:right;"><input type="submit" style="background-image:url(images/login_portal_core_button.png); width:97px; height:29px; border:none; cursor:pointer;" value=""></div>
            <div style="margin-top:10px;">
            	<a href="<?=$tb_page_domain->obtenerDato("link_forgot_password","domain_id=".$_SESSION['domain_id']);?>" target="_blank" style="color:#06C; font-size:13px;">¿Ha olvidado su contraseña?</a>
            </div>
    </div>
    <div style="float:right; width:400px;">
    	<div style="font-size:20px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; margin-top:5px; color:#000;text-shadow: 0 1px 0 #EFEFEF; margin-top:60px; margin-bottom:3px;">¿Tienes dudas para terminar tu órden?</div>
    	<div>
        <div style="overflow:hidden;">
        	<div style="float:left;">
            	<img src="images/livechat_icon.png" alt="" />
            </div>
        	<div style="float:left;"><a href="#" onclick="window.open('<?=$tb_page_domain->obtenerDato("link_livechat","domain_id=".$_SESSION['domain_id']);?>','chat','width=545,height=597,scrollbars=no,menubar=no,resizable=no,toolbar=no,titlebar=no,location=no,status=no');return false;" style="color:#F63; font-size:18px; font-style:italic;">
        clic aqui para iniciar chat</a></div>
        </div>
        </div>
    </div>
      
</div>    
</form>       
<form action="<?=$_SESSION['country']; ?>/ayuda-contacto/pedido-completo/" method="post" id="client_details" name="client_details" style="display:none;">	
<div style="overflow:hidden; border:solid 1px #EFEFEF;  margin-bottom:15px;margin-left:7px; margin-right:7px; overflow:hidden;" class="redondeo10px">
     <div style="overflow:hidden;">   
        <div style="padding-left:20px; padding-top:15px; padding-bottom:15px;  width:290px; float:left; border-right:solid 1px #ECECEC;">
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Nombre:</div>
            <div><input type="hidden" name="form_id" value="is_new_client" /></div>
            <div><input type="text" name="client_full_name" id="client_full_name" style="font-size:14px; width:230px; margin-top:3px; color:#633;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_full_name"></div>
            
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Apellidos:</div>
            <div><input type="text" name="client_last_name" id="client_last_name" style="font-size:14px; width:230px; margin-top:3px; color:#633;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_last_name"></div>
            
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Dirección de Correo:</div>
            <div><input type="text" name="client_email" id="client_email" style="font-size:14px; width:200px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_email"></div>
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Teléfono:</div>
            <div><input type="text" name="client_phone" id="client_phone" style="font-size:14px; width:200px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_phone"></div>
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Contraseña: </div>
            <div><input type="password" name="password" id="password" style="font-size:14px; width:200px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_password"></div>
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Repite contraseña:</div>
            <div><input type="password" name="password2" id="password2" style="font-size:14px; width:200px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_password2"></div>
                    </div>
        <div style="padding-left:10px; padding-top:15px; padding-bottom:15px;idth:320px; float:left;">
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Calle y Número:</div>
            <div><input type="text" name="client_address" id="client_address" style="font-size:14px; width:230px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_address"></div>
            
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Código postal:</div>
            <div><input type="text" name="client_zipcode" id="client_zipcode" style="font-size:14px; width:160px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_zipcode"></div>
            
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Ciudad:</div>
            <div><input type="text" name="client_city" id="client_city"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_city"></div>
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Estado:</div>
            <div><input type="text" name="client_state" id="client_state"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
            <div style="font-size:10px; color:#F00;" id="div_client_state"></div>
            <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">País:</div>
            <div>
            	<?  
				echo "<select name=\"client_country\" id=\"client_country\">";
				foreach($arrCountries as $code => $name) {
					 echo sprintf('<option value="%s">%s</option>', $code, $name);
					}
				echo "</select>";
				?>
            </div>
            <div style="font-size:10px; color:#F00;" id="div_client_country"></div>
        </div> 
        <div style="float:right; margin-left:15px; margin-top:10px;">
            <img src="images/livechat_resume_order.png" alt="" style="border:none; cursor:pointer;" onclick="window.open('<?=$tb_page_domain->obtenerDato("link_livechat","domain_id='".$_SESSION['domain_id']."'");?>','chat','width=545,height=597,scrollbars=no,menubar=no,resizable=no,toolbar=no,titlebar=no,location=no,status=no');return false;" />
        </div>
     </div>
     <div style="overflow:hidden; padding-left:20px;">
     	 	<div style="text-align:left;"><input type="checkbox" name="iagree_terms" id="iagree_terms"/> 
            	<a href="<?=$_SESSION['country']?>/hostdime/legal/" target="_blank" style="font-weight:900; color:#069;">He leído y Acepto las condiciones de servicio.</a></div>
            <div style="font-size:10px; color:#F00;" id="div_iagree_terms"></div>
      </div>  
     <? if($tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])!=1) { ?>
     <div style="overflow:hidden;">
     	<div style="overflow:hidden;">
            <div style="font-size:14px; font-weight:900;height:40px; float:left; padding-top:10px;padding-left:20px;"><input type="checkbox" id="fiscal_ivoice" name="fiscal_ivoice"  onclick="javascript:manage_datos_facturacion();"/> Requiero Factura Fiscal</div>
            <div style="height:40px; float:left; margin-left:20px;"><img src="images/icon_sat.png" alt="" style="border:none" /></div>
            <script type="text/javascript">
            function manage_datos_facturacion(){
                    if(document.getElementById('fiscal_ivoice').checked==true){
                        document.getElementById('datos_facturacion').style.display="block";
                        
                        document.getElementById('sat_name').value=document.getElementById('client_full_name').value+" "+document.getElementById('client_last_name').value;
                        document.getElementById('sat_address').value=document.getElementById('client_address').value;
                        document.getElementById('sat_city').value=document.getElementById('client_city').value;
                        document.getElementById('sat_state').value=document.getElementById('client_state').value;
                        document.getElementById('sat_country').value=document.getElementById('client_country').value;
                        }
                    if(document.getElementById('fiscal_ivoice').checked==false){
                        document.getElementById('datos_facturacion').style.display="none";
                        }	
                }
            </script>
        </div>   
		<div style="overflow:hidden; display:none; margin:7px;" id="datos_facturacion"> 
            	<div style="height:30px;background-color:#669; font-size:18px; color:#FFF; padding-top:5px; padding-left:15px; margin-bottom:5px;" class="redondeo5px">
                	Edita tus datos de Facturación</div> 
                <div style="overflow:hidden; border:solid 1px #EFEFEF;  margin-bottom:15px;" class="redondeo10px">
                    <div style="padding-left:20px; padding-top:15px; padding-bottom:15px;  width:290px; float:left;">
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Razón Social:</div>
                        <div><input type="text" name="sat_name" id="sat_name" style="font-size:14px; width:230px; margin-top:3px; color:#633;"/></div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_name"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">RFC:</div>
                        <div><input type="text" name="sat_rfc" id="sat_rfc" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_rfc"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Calle y Número:</div>
                        <div><input type="text" name="sat_address" id="sat_address" style="font-size:14px; width:200px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_address"></div>
                    </div>
                    <div style="padding-left:10px; padding-top:15px; padding-bottom:15px;idth:320px; float:left;">
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Colonia:</div>
                        <div><input type="text" name="sat_colonia" id="sat_colonia" style="font-size:14px; width:230px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_colonia"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF;">Código Postal:</div>
                        <div><input type="text" name="sat_cp" id="sat_cp" style="font-size:14px; width:230px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_cp"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Ciudad:</div>
                        <div><input type="text" name="sat_city" id="sat_city"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_city"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">Estado:</div>
                        <div><input type="text" name="sat_state" id="sat_state"  style="font-size:14px; width:160px; margin-top:3px;"/></div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_state"></div>
                        
                        <div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;font-weight:700;text-shadow: 0 1px 0 #EFEFEF; margin-top:5px;">País:</div>
                        <div><?  
						echo "<select name=\"sat_country\" id=\"sat_country\">";
						foreach($arrCountries as $code => $name) {
							 echo sprintf('<option value="%s">%s</option>', $code, $name);
							}
						echo "</select>";
						?>
                        </div>
                        <div style="font-size:10px; color:#F00;" id="div_sat_country"></div>
                        
                    </div> 
                </div>        
           	</div>
            <!-- Finaliza form de facturación -->
     </div>
     <? } ?>
     
     <div style="overflow:hidden;"> 
      	<div style="overflow:hidden; margin-bottom:25px; background-color:#F6F6F6; padding-top:7px;text-align:right; margin-top:25px; border-bottom:solid 1px #F2F2F2; border-top:solid 1px #E7E7E7;"><img src="images/btn_get_services.png" alt="" style="border:none; cursor:pointer;"  onclick="javascript:verify_form_new_client();"/></div> 
      </div>  
</div>
</form> 

</div>  <!-- Div que finaliza la pantalla de orden --> 
 <? } ?> 
 
 <script type="text/javascript">
 if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  }
}
 	function verify_form_new_client(){
			var complete_form=true;
			
			if(document.getElementById('client_type_new_client').checked==true){
				
					
					if((document.getElementById('client_full_name').value.trim())!=""){
							document.getElementById('div_client_full_name').innerHTML="";
						}else{
							document.getElementById('div_client_full_name').innerHTML="Escribe tu Nombre";
							complete_form=false;
							}
					if((document.getElementById('client_last_name').value.trim())!=""){
							document.getElementById('div_client_last_name').innerHTML="";
						}else{
							document.getElementById('div_client_last_name').innerHTML="Escribe tus Apellidos";
							complete_form=false;
							}		
					if((document.getElementById('client_email').value.trim())!=""){
							document.getElementById('div_client_email').innerHTML="";
						}else{
							document.getElementById('div_client_email').innerHTML="Escribe tu Dirección de Email";
							complete_form=false;
							}
					if((document.getElementById('client_phone').value.trim())!=""){
							document.getElementById('div_client_phone').innerHTML="";
						}else{
							document.getElementById('div_client_phone').innerHTML="Escribe tu Número Telefónico";
							complete_form=false;
							}
					if((document.getElementById('client_address').value.trim())!=""){
							document.getElementById('div_client_address').innerHTML="";
						}else{
							document.getElementById('div_client_address').innerHTML="Escribe la Calle y Número de donde vives";
							complete_form=false;
							}
					if((document.getElementById('client_city').value.trim())!=""){
							document.getElementById('div_client_city').innerHTML="";
						}else{
							document.getElementById('div_client_city').innerHTML="Escribe la Ciudad donde vives";
							complete_form=false;
							}
					if((document.getElementById('client_state').value.trim())!=""){
							document.getElementById('div_client_state').innerHTML="";
						}else{
							document.getElementById('div_client_state').innerHTML="Escribe el Estado donde vives";
							complete_form=false;
							}				
					if((document.getElementById('client_country').value.trim())!=""){
							document.getElementById('div_client_country').innerHTML="";
						}else{
							document.getElementById('div_client_country').innerHTML="Escribe el País donde vives";
							complete_form=false;
							}
					if((document.getElementById('client_zipcode').value.trim())!=""){
							document.getElementById('div_client_zipcode').innerHTML="";
						}else{
							document.getElementById('div_client_zipcode').innerHTML="Introduce tu código postal";
							complete_form=false;
							}
					var x=document.getElementById('client_email').value;						
					var atpos=x.indexOf("@");
					var dotpos=x.lastIndexOf(".");
					if(atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length){
							document.getElementById('div_client_email').innerHTML="Introduce un email válido";
							complete_form=false;
						}else{
							document.getElementById('div_client_email').innerHTML="";
					}

					if(document.getElementById('password').value==document.getElementById('password2').value){
							document.getElementById('div_client_password2').innerHTML="";
						}else{
							document.getElementById('div_client_password2').innerHTML="La contraseña debe coincidir";
							complete_form=false;
					}
					if(((document.getElementById('password').value.trim())!="") && ((document.getElementById('password').value.trim().length) >= 8) ){
							document.getElementById('div_client_password').innerHTML="";
						}else{
							document.getElementById('div_client_password').innerHTML="Debes introducir una contraseña de más de 8 caracteres";
							complete_form=false;
					}
					if(document.getElementById('iagree_terms').checked==true){
							document.getElementById('div_iagree_terms').innerHTML="";
						}else{
							document.getElementById('div_iagree_terms').innerHTML="Debes leer y Aceptar las condiciones de servicio.";
							complete_form=false;
							}				
					
					
					<? if($tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id'])!=1) { ?>
					if(document.getElementById('fiscal_ivoice').checked==true){
							
							if((document.getElementById('sat_name').value.trim())!=""){
							
							document.getElementById('div_sat_name').innerHTML="";
								}else{
								document.getElementById('div_sat_name').innerHTML="Necesitamos el Nombre de tu Razón Social";
								complete_form=false;
							}
							if((document.getElementById('sat_rfc').value.trim())!=""){
							
							document.getElementById('div_sat_rfc').innerHTML="";
								}else{
								document.getElementById('div_sat_rfc').innerHTML="Necesitamos tu RFC (Registro Federal de Contribuyente)";
								complete_form=false;
							}
							if((document.getElementById('sat_address').value.trim())!=""){
							
							document.getElementById('div_sat_address').innerHTML="";
								}else{
								document.getElementById('div_sat_address').innerHTML="Necesitamos Nombre y Número Fiscal de la Calle";
								complete_form=false;
							}
							if((document.getElementById('sat_colonia').value.trim())!=""){
							
							document.getElementById('div_sat_colonia').innerHTML="";
								}else{
								document.getElementById('div_sat_colonia').innerHTML="Necesitamos el nombre Fiscal de la colonia o barrio";
								complete_form=false;
							}
							if((document.getElementById('sat_cp').value.trim())!=""){
							
							document.getElementById('div_sat_cp').innerHTML="";
								}else{
								document.getElementById('div_sat_cp').innerHTML="Escribe ¿Cuál es el Código Postal para efectos Fiscales?";
								complete_form=false;
							}
							if((document.getElementById('sat_city').value.trim())!=""){
							
							document.getElementById('div_sat_city').innerHTML="";
								}else{
								document.getElementById('div_sat_city').innerHTML="Escribe la Ciudad, para Efectos Fiscales.";
								complete_form=false;
							}
							if((document.getElementById('sat_state').value.trim())!=""){
							
							document.getElementById('div_sat_state').innerHTML="";
								}else{
								document.getElementById('div_sat_state').innerHTML="Escribe el Estado, para Efectos Fiscales.";
								complete_form=false;
							}
							if((document.getElementById('sat_country').value.trim())!=""){
							
							document.getElementById('div_sat_country').innerHTML="";
								}else{
								document.getElementById('div_sat_country').innerHTML="Escribe el País, para Efectos Fiscales.";
								complete_form=false;
							}
						}else{
							document.getElementById('div_sat_name').innerHTML="";
							document.getElementById('div_sat_rfc').innerHTML="";
							document.getElementById('div_sat_address').innerHTML="";
							document.getElementById('div_sat_colonia').innerHTML="";
							document.getElementById('div_sat_cp').innerHTML="";
							document.getElementById('div_sat_city').innerHTML="";
							document.getElementById('div_sat_state').innerHTML="";
							document.getElementById('div_sat_country').innerHTML="";
							
							}
				 	<? } ?>
			}
			if(complete_form==true){
				document.client_details.submit();
				}
		
		}
 </script>