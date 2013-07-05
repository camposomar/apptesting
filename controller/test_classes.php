<?
include("class.page_database.php");
$tb_page_domain= new tb_page_database('tb_page_domain');
print_r($tb_page_domain->math("COUNT","domain='hostdime.com.mx'"));
?>