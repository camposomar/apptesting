<div style="margin:0 auto 0 auto;width:950px;overflow:hidden;">
	<? include("site_submenu_2sub.php");?> 
    <div style="font-family:Verdana, Geneva, sans-serif;color:#787878; padding-left:2px; padding-top:18px; float:left; width:750px; line-height:20px;">
    <div style="background-color:#FCFCFC;border:solid 1px #F2F2F2; overflow:hidden; padding-left:15px; margin-bottom:15px; margin-left:10px;">  
              <div style="width:50px; float:left; padding-top:3px;">
                <img src="images/icon_information.png" width="39" height="39" alt="" />
              </div>
              <div style="float:left; width:670px;padding-top:5px;">
                <div style="font-size:22px; color:#F60;text-shadow: 0 1px 0 #EAEAEA;">Videotutoriales</div>
                <div style="padding-bottom:7px; font-size:12px; color:#333;">Aprenda las funcionalidades del servicio contratado...</div>
             </div>
       	</div>
        <div style="margin-left:20px; overflow:hidden; margin-bottom:35px;">
        		<? 
				if(isset($_GET['article_id'])){
					if($tb_page_knowledgebase_articles->math("COUNT","article_id=$_GET[article_id]")){
						switch(utf8_encode($tb_page_knowledgebase_articles->obtenerDato("type","article_id=$_GET[article_id]"))){
							case "html-video":{
								?>
								<div style="font-size:16px; color:#000;"><?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("title","article_id=$_GET[article_id]"));?></div>
								<div style="font-size:12px; margin:10px; color:#333; text-align:justify;"><?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("preview","article_id=$_GET[article_id]"));?></div>
								<div style="margin-top:30px; overflow:hidden; padding:3px; border:solid 1px #CCC;">
									<?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("post","article_id=$_GET[article_id]"));?>
								</div>
								<?
								break;
								}
							
							}
					}
				}else {
					echo "No se pueden mostrar artículos...";
					}
				
				?>
                
                
        </div>
    </div>
</div>