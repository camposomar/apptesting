<?php
include_once("controller/Connections/db_connection_page.php");
include_once("controller/Connections/db_connection_core.php");
require_once('lib/autobahn.php');
$query = Autobahn::getConnection('core');
$todas_tlds = $query->findAllDnaDomainsTldByCompanyId($core_company_id);
?>
<link type="text/css" href="/css/table.css" rel="stylesheet" />
<div style="color:#333; font-size:26px; font-weight:900px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;text-shadow: 0 1px 0 #EAEAEA; margin-top:10px;">Precios de dominios</div>
<div style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px; color:#333;text-shadow: 0 1px 0 #F9F9F9; margin-top:15px; margin-bottom:25px; line-height:20px;"> Los dominios registrados en HostDime son de tu propiedad y registrados a tu nombre, en HostDime creemos en precios justos y transparentes, no hay comisiones ocultas.
<?php if($_SESSION['domain_id'] == 1) echo " Precios con IVA incluído.";  ?>
</div>
<table width="80%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-hover" style="font-size:12px;">
  <thead>
  <tr>
    <th>Extensión</th>
    <th>Precio registro (por año)</th>
    <th>Precio transferencia</th>
    <th>Precio renovación (por año)</th>
    <th>Años de registro (min/max)</th>
  </tr>
  </thead>
  <?
  	foreach($todas_tlds as $dato):
		echo "<tr>
				<td><strong>".$dato['dna_domains_tld']['tld']."</strong></td>
				<td>".$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'").number_format($dato['dna_domains_tld']['tld_price_new']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'")."</td>
				<td>".$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'").number_format($dato['dna_domains_tld']['tld_price_transfer']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'")."</td>
				<td>".$tb_page_domain->obtenerDato("symbol_currency","domain='".$page_domain."'").number_format($dato['dna_domains_tld']['tld_price_renew']*$tb_page_domain->obtenerDato("taxes","domain_id=".$_SESSION['domain_id']),2)." ".$tb_page_domain->obtenerDato("currency","domain='".$page_domain."'")."</td>
			  	<td>".$dato['dna_domains_tld']['minyears']." / ".$dato['dna_domains_tld']['maxyears']."</td>
			  </tr>";
	endforeach;
  ?>
</table>