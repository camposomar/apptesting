<div style="float:left;width:190px; border-right:#D6D6D6 solid 1px; margin-top:10px;">
<? 

	
	$title2menu=explode("/",$page_seccion);
	
	$title2menu="/$title2menu[1]/$title2menu[2]/";
	
	
	
	echo utf8_encode("<div style=\"overflow:hidden;border-bottom:#D6D6D6 solid 1px;\">
				 		<a href=\"$country$title2menu\" style=\"font-size:20px;color:#333;\">".$tb_page_link->obtenerDato("label","url='$title2menu'")."</a>
						</div>");

	$lista_tb_page_link=$tb_page_link->select("url,label","`url` LIKE  '%$title2menu%' Order by label ASC");
	$row_tb_page_link=mysql_fetch_assoc($lista_tb_page_link);		
	do{
		
			if(count(explode("/",$row_tb_page_link['url']))==5){
				echo utf8_encode("<div style=\"height:22px;border-bottom:#D6D6D6 dashed 1px;padding-top:5px;\">
								<a href=\"$country$row_tb_page_link[url]\"><strong style=\"font-size:15px;\">&#187;</strong> $row_tb_page_link[label]  </a>
								</div>");
			}
	}while($row_tb_page_link=mysql_fetch_assoc($lista_tb_page_link));
?>
</div>