<div style="margin:0 auto 0 auto;width:950px;overflow:hidden;">
	<? include("site_submenu_2sub.php");?> 
    <div style="font-family:Verdana, Geneva, sans-serif;color:#787878; padding-left:2px; padding-top:18px; float:left; width:750px; line-height:20px;">
    		<div style="font-size:16px; color:#000; overflow:hidden; margin-left:15px; font-weight:700; padding-bottom:5px;">Soporte 24/7</div>
            <div style="padding-bottom:8px; margin-left:15px; border-bottom:dashed 1px #999;overflow:hidden; color:#000;">Ofrecemos un verdadero Soporte 24/7, nuestro gran equipo siempre esta disponible para ayudarle y garantizar respuestas que garanticen la obtención del mejor provecho en su servicio contratado. <strong style="color:#F90; font-size:13px;">El soporte técnico para éste servicio cubre lo siguiente:</strong> </div>
            <div style="margin-bottom:30px; overflow:hidden;">
				<? 
			 $link_id=$tb_page_link->obtenerDato("link_id","url='$page_seccion'");
include("controller/class.page_mode_support_service.php");
$tb_page_mode_support_service= new tb_page_mode_support_service();
			
include("controller/class.page_mode_support.php");
$tb_page_mode_support= new tb_page_mode_support();

			
			$list_page_mode_support_service=$tb_page_mode_support_service->select("support_id","link_id=$link_id");
			$row_page_mode_support_service=mysql_fetch_assoc($list_page_mode_support_service);
			if($tb_page_mode_support_service->math("COUNT","link_id=$link_id")>0){
					do{ ?> 
					<div style="width:360px; overflow:hidden; margin-left:7px; float:left; padding-top:3px; padding-left:5px;margin-top:25px;">
						<div style="overflow:hidden;">
							<div style="width:140px; overflow:hidden; float:left;">
                            	<img src="images/<?=$tb_page_mode_support->obtenerDato("url_icon","support_id=$row_page_mode_support_service[support_id]"); ?>"  alt="" /></div>
							<div style="font-size:16px; color:#000;overflow:hidden; padding-left:10px; padding-top:15px;"><?=utf8_encode($tb_page_mode_support->obtenerDato("name","support_id=$row_page_mode_support_service[support_id]")); ?></div>		
						</div>
						<div><?=utf8_encode($tb_page_mode_support->obtenerDato("description","support_id=$row_page_mode_support_service[support_id]")); ?></div>
			   </div>
					<?
					}while($row_page_mode_support_service=mysql_fetch_assoc($list_page_mode_support_service));
			}
			?>
            </div>
    </div>
</div>