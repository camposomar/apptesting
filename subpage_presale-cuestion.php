<div style="margin:0 auto 0 auto;width:950px;overflow:hidden;">
	<? include("site_submenu_2sub.php");?> 
    <div style="font-family:Verdana, Geneva, sans-serif;color:#787878; padding-left:2px; padding-top:18px; float:left; width:750px; line-height:20px; margin-bottom:40px;">
    		<div style="border-bottom:solid 1px #F63;margin:10px; margin-left:20px; margin-bottom:15px; padding-top:6px; padding-left:50px;height:35px; color:#000;background-image:url(images/icon_otherinformation.png);font-size:28px; color:#333; background-repeat:no-repeat;"> Preguntas antes de comprar </div>
            <? 
			if($lista_tb_page_knowledgebase_category_articles=$tb_page_knowledgebase_category_articles->math("COUNT","domain_id=0 AND link_id=0")>0){
				$lista_tb_page_knowledgebase_category_articles=$tb_page_knowledgebase_category_articles->select("article_id","domain_id=0 AND link_id=0");
				$row_tb_page_knowledgebase_category_articles=mysql_fetch_assoc($lista_tb_page_knowledgebase_category_articles);
				do{ ?>
					<div style="border-top:solid 1px #F7F7F7; font-weight:500; font-size:14px;color:#F60; margin-left:20px; margin-right:10px; padding-left:15px;">
						<?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("title","article_id=$row_tb_page_knowledgebase_category_articles[article_id]")); ?></div>
					<div style="border-bottom:solid 1px #999; font-size:11px;  color:#000; margin-left:30px; margin-right:10px; padding-left:15px; margin-bottom:10px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
						<?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("post","article_id=$row_tb_page_knowledgebase_category_articles[article_id]")); ?>
					</div>
				<? } while($row_tb_page_knowledgebase_category_articles=mysql_fetch_assoc($lista_tb_page_knowledgebase_category_articles));
			}
			?>
           
           
		   
		   <? 
		   
		   if($lista_tb_page_knowledgebase_category_articles=$tb_page_knowledgebase_category_articles->math("COUNT","domain_id=$domain_id AND link_id=0")>0){
				$lista_tb_page_knowledgebase_category_articles=$tb_page_knowledgebase_category_articles->select("article_id","domain_id=$domain_id AND link_id=0");
				$row_tb_page_knowledgebase_category_articles=mysql_fetch_assoc($lista_tb_page_knowledgebase_category_articles);
				do{ ?>
					<div style="border-top:solid 1px #F7F7F7; font-weight:500; font-size:14px;color:#F60; margin-left:20px; margin-right:10px; padding-left:15px;">
						<?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("title","article_id=$row_tb_page_knowledgebase_category_articles[article_id]")); ?></div>
					<div style="border-bottom:solid 1px #999; font-size:11px;  color:#000; margin-left:30px; margin-right:10px; padding-left:15px; margin-bottom:10px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
						<?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("post","article_id=$row_tb_page_knowledgebase_category_articles[article_id]")); ?>
					</div>
				<? } while($row_tb_page_knowledgebase_category_articles=mysql_fetch_assoc($lista_tb_page_knowledgebase_category_articles));
			}
		   ?>
           
           
           
		   
		   <? 
		   $link_id=$tb_page_link->obtenerDato("link_id","url='$page_seccion'"); 
		   if($lista_tb_page_knowledgebase_category_articles=$tb_page_knowledgebase_category_articles->math("COUNT","link_id=$link_id AND domain_id=$domain_id")>0){
			   ?>
			   <div style="border-bottom:solid 1px #F63;margin:10px; margin-left:20px; margin-bottom:15px; margin-top:25px; padding-top:6px; padding-left:50px;height:35px; color:#000;background-image:url(images/icon_otherinformation.png);font-size:28px; color:#333; background-repeat:no-repeat;"> Preguntas Relacionadas con este servicio </div>
			   <?
				$lista_tb_page_knowledgebase_category_articles=$tb_page_knowledgebase_category_articles->select("article_id","link_id=$link_id AND domain_id=$domain_id");
				$row_tb_page_knowledgebase_category_articles=mysql_fetch_assoc($lista_tb_page_knowledgebase_category_articles);
				do{ ?>
					<div style="border-top:solid 1px #F7F7F7; font-weight:500; font-size:14px;color:#F60; margin-left:20px; margin-right:10px; padding-left:15px;">
						<?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("title","article_id=$row_tb_page_knowledgebase_category_articles[article_id]")); ?></div>
					<div style="border-bottom:solid 1px #999; font-size:11px;  color:#000; margin-left:30px; margin-right:10px; padding-left:15px; margin-bottom:10px;" onmouseover="style.backgroundColor='#E8E8E8';style.cursor='pointer';" onmouseout="style.backgroundColor='#FFF';">
						<?=utf8_encode($tb_page_knowledgebase_articles->obtenerDato("post","article_id=$row_tb_page_knowledgebase_category_articles[article_id]")); ?>
					</div>
				<? } while($row_tb_page_knowledgebase_category_articles=mysql_fetch_assoc($lista_tb_page_knowledgebase_category_articles));
			}
		   ?>
           
           
    </div>
</div>