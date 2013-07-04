<?
session_start();
include("controller/class.page_client.php");
$tb_page_client=new tb_page_client();
$cadena = base64_encode("<br />Visit key: ".$_SESSION['visit_key'].
 "<br />Client_id: ".$_SESSION['client_id'].
 "<br />Country: ".$_SESSION['country'].
 "<br />Page_seccion: ".$_SESSION['page_seccion'].
 "<br />Domain_id: ".$_SESSION['domain_id'].
 "<br />Division_id: ".$_SESSION['division_id'].
 "<br />Core_company_id:".$_SESSION['core_company_id'].
 "<br />Link id".$_SESSION['link_id'].
 "<br />Count: ".$tb_page_client->math("COUNT","visit_key='".$_SESSION['visit_key']."'").
 "<br />Visit from db:".$tb_page_client->obtenerDato("client_id","visit_key='".$_SESSION['visit_key']."'").
 "<br />REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'].
 "<br />User agent: ".$_SERVER['HTTP_USER_AGENT']);
echo "Envía la siguiente información para que podamos diagnosticar el problema:<br />";
?><br />
<div style="width:400px; word-wrap: break-word;"><?=$cadena;?></div>