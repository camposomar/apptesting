<?
//SI NO TENEMOS CREADA LA SESIÓN DONDE GUARDAREMOS LOS DOMINIOS LA CREAMOS
		if(!isset($_SESSION['array_domains_names'])){
			$_SESSION['array_domains_names'] = array();
		}
?>
<div style="overflow:hidden; padding-bottom:45px;">
	<div style="margin:0 auto 0 auto;border:none;width:950px;margin-top:3px; overflow:hidden; padding-bottom:40px;">
    	<? include("domain_slider_dynamic_borrame.php");?>
    	<!-- Inicia listado de dominios buscados pr el cliente -->
    </div>
    <div style="font-size:20px; color:#069;margin-left:10px; margin-bottom:20px;">&#187; tus búsquedas</div>
	<div style="border-bottom:solid 1px #F4F4F4;margin:5px; overflow:hidden; background-color:#F6F6F6; padding-top:5px; padding-bottom:5px; padding-left:10px;" class="redondeo5px">
        <div style="float:left;font-weight:500;width:250px; font-size:13px;"> &#164; Dominio</div>
        <div style="float:left;font-weight:500;width:200px; font-size:13px;"> &#164; Disponiblidad </div>
        <div style="float:left;font-weight:500;width:200px; font-size:13px;"> &#164; Años de registro </div>
       
	</div>
<?
//SOLUCIÓN DE BAJA TECNOLOGÍA PARA BUSCAR LO DE LA SESIÓN
//$_SESSION['array_domains_names'][] = array('domain' => $list_domains_names[$x], 'tld' => $row_tld_domain['tld']);
if(count($_SESSION['array_domains_names']) >=1){
foreach($_SESSION['array_domains_names'] as $dato):
$x++;
$list_domains_names[$x] = $dato['domain'];
$row_tld_domain['tld'] = $dato['tld'];
$row_tld_domain_sinpunto=str_replace(".","",$row_tld_domain['tld']);
												if(check_domain(trim($list_domains_names[$x]),$row_tld_domain['tld'])){
													?>
                                                    
                                                    <form method="get" action="<?=$_SESSION['country'].$_SESSION['page_seccion']; ?>" id="form_tld<?=$row_tld_domain_sinpunto.$x;?>" name="form_tld<?=$row_tld_domain_sinpunto.$x;?>">	 
                                                    <div><input type="hidden" name="opacity" value="true" /></div>
                                                    <div><input type="hidden" name="car_action" value="add_service" /></div>
                                                    <div><input type="hidden" name="service_type" value="domain-registry" /></div>
                                                    <div><input type="hidden" name="package_id" value="<?=$row_tld_domain['tld_id']; ?>" /></div>
                                                    <div><input type="hidden" name="token_key" value="<?=$tb_page_token->obtenerDato("token_key","status='available' order by rand()"); ?>" /></div>
                                                    <div><input type="hidden" name="note_1" value="<?=trim($list_domains_names[$x]);?>" /></div>
                                                    <div><input type="hidden" name="note_2" value="<?=$row_tld_domain['tld']; ?>" /></div>
													<div style="border-bottom:solid 1px #CCC; overflow:hidden;">
                                                        <div style="width:250px; float:left; color:#000; font-weight:900; font-size:13px;"><?=trim($list_domains_names[$x]).".".$row_tld_domain['tld']; ?></div>
                                                        <div style="width:200px; float:left; color:#090; font-weight:800; font-size:14px;">¡ disponible !</div>
                                                        <div style="width:200px; float:left;">
                                                        	<select name="cicle_type">
                                                            	<option value="1">1 año por $<?=number_format($row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="2" selected="selected">2 años por $<?=number_format(2*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="3">3 años por $<?=number_format(3*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="4">4 años por $<?=number_format(4*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="5">5 años por $<?=number_format(5*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                        	</select>
                                                        </div>
                                                        <div style="float:left;width:150px;">
                                                    		<img src="images/btn_order_lila.png" alt="" style="cursor:pointer; border:none;"  onclick="document.form_tld<?=$row_tld_domain_sinpunto.$x;?>.submit();"/>
                                                   		</div>
                                                    </div>
                                                    
                                                    </form>    
													<? }else { ?>
														<div style="border-bottom:solid 1px #CCC;width:99%; overflow:hidden;"> 
                                                        	<div style="width:250px; float:left; color:#000; font-weight:900; font-size:13px;">
																<?=trim($list_domains_names[$x]).".".$row_tld_domain['tld']; ?>
                                                            </div>
                                                            <div style="float:left;color:#F00; width:200px;font-weight:800; font-size:14px;">No disponible</div>
                                                        </div>
														<? } ?>
</div>
<? endforeach; }
//TERMINA SOLUCION PARCHE
 ?>

	<? 
	if( (isset($_POST['domains_names']) && ($_POST['domains_names']!="")) ){
		$domains_names=strip_tags(trim($_POST['domains_names']));
		$list_domains_names=explode("\n",$domains_names);
		
		/*
			// REVISAMOS SI EXISTE LA SESIÓN DE UNA BÚSQUEDA ANTERIOR
			if(isset($_SESSION['array_domains_names'])){
				//Mezclamos dos arreglos para desplegar dominios de la sesión y los de la búsqueda nueva
				$list_domains_names = array_merge($list_domains_names,$_SESSION['array_domains_names']);
				$_SESSION['array_domains_names'] = $list_domains_names;
			}else{
				// SI NO EXISTE CREAMOS LA SESIÓN Y LE AGREGAMOS LOS DATOS DE LA BÚSQUEDA ACTUAL
				$_SESSION['array_domains_names'] = array();
				$_SESSION['array_domains_names'] = $list_domains_names;
			}*/
		if(count($list_domains_names)<=15){
							for($x=0;$x<count($list_domains_names);$x++){ 
									$list_tld_domain=$tb_core_tld->select("tld_id,tld,tld_price_new","company_id='$_SESSION[core_company_id]'");
									$row_tld_domain=mysql_fetch_assoc($list_tld_domain);		
										do{  
											$row_tld_domain_sinpunto=str_replace(".","",$row_tld_domain['tld']);
											if(isset($_POST[$row_tld_domain_sinpunto])){
												//guardamos el dominio buscado en nuestro arreglo
													$_SESSION['array_domains_names'][] = array('domain' => $list_domains_names[$x], 'tld' => $row_tld_domain['tld']);
												if(check_domain(trim($list_domains_names[$x]),$row_tld_domain['tld'])){
													?>
                                                    
                                                    <form method="get" action="<?=$_SESSION['country'].$_SESSION['page_seccion']; ?>" id="form_tld<?=$row_tld_domain_sinpunto.$x;?>" name="form_tld<?=$row_tld_domain_sinpunto.$x;?>">	 
                                                    <div><input type="hidden" name="opacity" value="true" /></div>
                                                    <div><input type="hidden" name="car_action" value="add_service" /></div>
                                                    <div><input type="hidden" name="service_type" value="domain-registry" /></div>
                                                    <div><input type="hidden" name="package_id" value="<?=$row_tld_domain['tld_id']; ?>" /></div>
                                                    <div><input type="hidden" name="token_key" value="<?=$tb_page_token->obtenerDato("token_key","status='available' order by rand()"); ?>" /></div>
                                                    <div><input type="hidden" name="note_1" value="<?=trim($list_domains_names[$x]);?>" /></div>
                                                    <div><input type="hidden" name="note_2" value="<?=$row_tld_domain['tld']; ?>" /></div>
													<div style="border-bottom:solid 1px #CCC; overflow:hidden;">
                                                        <div style="width:250px; float:left; color:#000; font-weight:900; font-size:13px;"><?=trim($list_domains_names[$x]).".".$row_tld_domain['tld']; ?></div>
                                                        <div style="width:200px; float:left; color:#090; font-weight:800; font-size:14px;">¡ disponible !</div>
                                                        <div style="width:200px; float:left;">
                                                        	<select name="cicle_type">
                                                            	<option value="1">1 año por $<?=number_format($row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="2" selected="selected">2 años por $<?=number_format(2*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="3">3 años por $<?=number_format(3*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="4">4 años por $<?=number_format(4*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                                <option value="5">5 años por $<?=number_format(5*$row_tld_domain['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2);?></option>
                                                        	</select>
                                                        </div>
                                                        <div style="float:left;width:150px;">
                                                    		<img src="images/btn_order_lila.png" alt="" style="cursor:pointer; border:none;"  onclick="document.form_tld<?=$row_tld_domain_sinpunto.$x;?>.submit();"/>
                                                   		</div>
                                                    </div>
                                                    
                                                    </form>    
													<?
													}else { ?>
														<div style="border-bottom:solid 1px #CCC;width:99%; overflow:hidden;"> 
                                                        	<div style="width:250px; float:left; color:#000; font-weight:900; font-size:13px;">
																<?=trim($list_domains_names[$x]).".".$row_tld_domain['tld']; ?>
                                                            </div>
                                                            <div style="float:left;color:#F00; width:200px;font-weight:800; font-size:14px;">No disponible</div>
                                                        </div>
														<? }
													
												}
										}while($row_tld_domain=mysql_fetch_assoc($list_tld_domain));	
							}
						}
	}
	?>