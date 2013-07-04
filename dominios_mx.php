<?
include_once("controller/Connections/db_connection_page.php");
include_once("controller/Connections/db_connection_core.php");
require_once('lib/autobahn.php');
$query = Autobahn::getConnection('core');



$consulta_dominios = array();
$tlds = array();
$todas_tlds = $query->findAllDnaDomainsTldByCompanyId($core_company_id);
foreach($todas_tlds as $dato):
	$tld_sinpunto = str_replace('.','',$dato['dna_domains_tld']['tld']);
	$consulta_dominios[$tld_sinpunto] = $dato['dna_domains_tld'];
	if(isset($_POST[$tld_sinpunto])) $tlds[] = $tld_sinpunto;
endforeach;

//unset($_SESSION['array_domains_names']);

//creamos el array, si hay dominios a buscar los parseamos y agregamos
$_SESSION['array_domains_names'] = (isset($_SESSION['array_domains_names'])) ? $_SESSION['array_domains_names'] : array();
$posted_domains = (isset($_POST['domains_names'])) ? explode("\n",$_POST['domains_names']) : array();

//checamos el cache de dominios en la sesión
foreach($_SESSION['array_domains_names'] as $k=>$tld):
	foreach($todas_tlds as $tldsforeach){
		$tld_dominio = $tldsforeach['dna_domains_tld']['tld'];
		if(isset($_SESSION['array_domains_names'][$k][$tld_dominio]['last_check']) && ($_SESSION['array_domains_names'][$k][$tld_dominio]['last_check'] < time()-300)){
			$_SESSION['array_domains_names'][$k][$tld_dominio]['status'] = (check_domain($k,$tld_dominio)) ? 1 : 0;
			$_SESSION['array_domains_names'][$k][$tld_dominio]['last_check'] = time();
		}	
	}
endforeach;

if(count($posted_domains) < 16){
	foreach($posted_domains as $dato):
		$dato = str_replace('www.','',$dato);
		foreach($tlds as $tldsforeach){
			if(trim($dato) != ''){
				$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['tld'] = $consulta_dominios[$tldsforeach]['tld'];
				$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['tld_id'] = $consulta_dominios[$tldsforeach]['tld_id'];
				$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['minyears'] = $consulta_dominios[$tldsforeach]['minyears'];
				$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['maxyears'] = $consulta_dominios[$tldsforeach]['maxyears'];
				$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['tld_price_new'] = $consulta_dominios[$tldsforeach]['tld_price_new'];
				if(!isset($_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['last_check'])){
					$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['status'] = (check_domain($dato,$consulta_dominios[$tldsforeach]['tld'])) ? 1 : 0;
					$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['last_check'] = time();
				}else if($_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['last_check'] < time()-300){
					$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['status'] = (check_domain($dato,$consulta_dominios[$tldsforeach]['tld'])) ? 1 : 0;
					$_SESSION['array_domains_names'][trim($dato)][$tldsforeach]['last_check'] = time();
				}
			}
		}
	endforeach;
}
?>
<div style="overflow:hidden; padding-bottom:45px;">
	<div style="margin:0 auto 0 auto;border:none;width:950px;margin-top:3px; overflow:hidden; padding-bottom:40px;">
    	<? include("domain_slider_dynamic_mx.php");?>
    	<!-- Inicia listado de dominios buscados pr el cliente -->
    </div>
    <div style="font-size:20px; color:#069;margin-left:10px; margin-bottom:20px;">&#187; tus búsquedas</div>
	<div style="border-bottom:solid 1px #F4F4F4;margin:5px; overflow:hidden; background-color:#F6F6F6; padding-top:5px; padding-bottom:5px; padding-left:10px;" class="redondeo5px">
        <div style="float:left;font-weight:500;width:250px; font-size:13px;"> &#164; Dominio</div>
        <div style="float:left;font-weight:500;width:200px; font-size:13px;"> &#164; Disponiblidad </div>
        <div style="float:left;font-weight:500;width:200px; font-size:13px;"> &#164; Años de registro </div>
       
	</div>
</div>
<div id="list_domains">
<?
foreach($_SESSION['array_domains_names'] as $k => $dato):
// $k = sld / $fe_dominio tiene tld,tld_id,token_key,minyears,maxteras,tld_price_new,status y last_check
foreach($dato as $fe_dominio){
	$nombre_dominio = $k.'.'.$fe_dominio['tld'];
	//checamos si esta disponible
	if($fe_dominio['status'] == 1){
?>
	<form method="get" action="<?=$_SESSION['country'].$_SESSION['page_seccion']; ?>" id="form_tld<?=$k;?>_<?=str_replace(".",'_',$fe_dominio['tld']);?>" name="form_tld_<?=$k;?>_<?=str_replace(".",'_',$fe_dominio['tld']);?>">	 
	<div><input type="hidden" name="opacity" value="true" /></div>
	<div><input type="hidden" name="car_action" value="add" /></div>
	<div><input type="hidden" name="service_type" value="domain-registry" /></div>
	<div><input type="hidden" name="package_id" value="<?=$fe_dominio['tld_id']; ?>" /></div>
	<div><input type="hidden" name="token_key" value="<?=$tb_page_token->obtenerDato("token_key","status='available' order by rand()"); ?>" /></div>
	<div><input type="hidden" name="note_1" value="<?=$k;?>" /></div>
	<div><input type="hidden" name="note_2" value="<?=$fe_dominio['tld'];?>" /></div>
	<div style="border-bottom:solid 1px #CCC; overflow:hidden;">
	<div style="width:250px; float:left; color:#000; font-weight:900; font-size:13px;"><?=$nombre_dominio; ?></div>
	<div style="width:200px; float:left; color:#090; font-weight:800; font-size:14px;">¡ disponible !</div>
	<div style="width:200px; float:left;">
		<select name="cycle_type">
        	<?php
            for($i = $fe_dominio['minyears']; $i <= $fe_dominio['maxyears']; $i++){
			?>
			<option value="<?=$i;?>" <?=($i == 2) ? 'selected="selected"' : '';?>><?=$i;?> año<? echo ($i > 1) ? 's' : ''; ?> por <?=$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'");?><?=number_format(($tb_core_tld->obtenerDato("tld_price_new","tld='$fe_dominio[tld]' AND company_id='$_SESSION[core_company_id]'")*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']))*$i,2);?> <?=$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'"); ?></option>
			<?php
			}
			?>
		</select>
	</div>
	<div style="float:left;width:150px;">
		<img src="images/btn_order_lila.png" alt="" style="cursor:pointer; border:none;"  onclick="document.form_tld_<?=$k;?>_<?=str_replace(".",'_',$fe_dominio['tld']);?>.submit();"/>
	</div>
	</div>
 </form>    
<?
	}else{
?>
	<div style="border-bottom:solid 1px #CCC;width:99%; overflow:hidden;"> 
	<div style="width:250px; float:left; color:#000; font-weight:900; font-size:13px;">
		<?=$nombre_dominio; ?>
	</div>
	<div style="float:left;color:#F00; width:200px;font-weight:800; font-size:14px;">No disponible</div>
	</div>
<?
	}
}
endforeach;
?>
</div>
