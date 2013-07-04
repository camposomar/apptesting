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
           
		    $link_id=$tb_page_link->obtenerDato("link_id","url='$page_seccion'");
			if($tb_page_knowledgebase_category_articles->math("COUNT","link_id=$link_id")>0){
            $list_page_knowledgebase_category_articles=$tb_page_knowledgebase_category_articles->select("article_id","link_id=$link_id");
            
                $row_page_knowledgebase_category_articles=mysql_fetch_assoc($list_page_knowledgebase_category_articles);
                 do{
                    
                     echo "<div style=\"padding-top:3px;padding-left:10px;border-bottom:solid 1px #F2F2F2;\">
					 	<a href=\"$country".$page_seccion."reproducir/?article_id=".utf8_encode($tb_page_knowledgebase_articles->obtenerDato("article_id","article_id=$row_page_knowledgebase_category_articles[article_id]"))."\" style=\"color:#09C;cursor:pointer;font-size:11px;\"> &#8226; ".utf8_encode($tb_page_knowledgebase_articles->obtenerDato("title","article_id=$row_page_knowledgebase_category_articles[article_id]"))."</a></div>";
                     }while($row_page_knowledgebase_category_articles=mysql_fetch_assoc($list_page_knowledgebase_category_articles));
		   }else {
			   
			   echo "No hay temas que mostrar.";
			   }
                
        ?>
        </div>
    </div>
</div>