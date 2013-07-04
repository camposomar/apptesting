<? session_start();
include("includes.php");
echo $tb_page_order_hosting->math("COUNT","visit_key='".$_COOKIE['visit_key']."' AND status='in_car'");
?>