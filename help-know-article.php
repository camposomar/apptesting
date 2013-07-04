<div style="overflow:hidden; padding-bottom:45px;">
    <div style="margin:0 auto 0 auto;border:none;width:950px;margin-top:10px;">        
        <div style="background-color:#FCFCFC;border:solid 1px #F2F2F2; overflow:hidden; padding-left:15px; margin-bottom:15px;">  
              <div style="width:50px; float:left; padding-top:3px;">
                <img src="images/icon_information.png" width="39" height="39" alt="" />
              </div>
              <div style="float:left; width:870px;">
                <div style="font-size:22px; color:#F60;text-shadow: 0 1px 0 #EAEAEA;">Conociendo mi servicio</div>
                <div style="padding-bottom:7px; font-size:12px; color:#333;">Aprenda las funcionalidades del servicio contratado...</div>
             </div>
       	</div>
        <div>
        	<div style="text-align:right; font-size:11px;"> <a href="javascript:history.back();" style="color:#06C;">&#171; Volver a temario</a></div>
        	<div style="font-size:14px; font-weight:700; margin-top:15px; border-bottom:solid 1px #F2F2F2; padding-bottom:3px; overflow:hidden;"> &#187; <?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("title","article_id=$_GET[article_id]")); ?></div>
            <div style="overflow:hidden; margin-top:15px; font-size:11px; line-height:17px;"><?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("preview","article_id=$_GET[article_id]"));?></div>
            <? if($tb_page_knowledgebase_articles->obtenerDato("type","article_id=$_GET[article_id]")=="html-video"){ ?>
            		<div style="text-align:center; overflow:hidden; border:solid 1px #F2F2F2; margin-top:30px; padding-top:10px; padding-bottom:10px;">
                    	<?=$tb_page_knowledgebase_articles->obtenerDato("post","article_id=$_GET[article_id]"); ?>
                    </div>
           	<? } ?>
        </div>
	</div>
</div>
	   
	  