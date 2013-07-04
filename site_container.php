<!-- Inicia: id="container" es un gran contenedor central del sitio, su tamaño en lo ancho es tan grande como sea la pantalla de visitante-->
<div id="container" style="overflow:hidden;margin:0 auto 0 auto;width:960px;">
<? if($page_seccion!="/") { ?>
<div style="position:fixed; top:290px; width:65px;height:200px; margin-left:990px;cursor:pointer; background-image:url(images/background_social.png); background-repeat:no-repeat; padding-left:8px; z-index:2">
	<div style="margin-top:20px;"><a target="_blank" href="http://www.facebook.com/sharer.php?u=http://<?=$page_domain.$page_seccion;?>"><img src="images/icon_facebok_blue.png" width="32" height="32" style="border:none" alt=""/></a></div>
    <div style="margin-top:20px;"><a href="http://twitter.com/home?status=http://<?=$page_domain.$page_seccion;?>"><img src="images/icon_twitter_blue.png" alt="" width="32" height="32" style="border:none"/></a></div>
    <div style="margin-top:20px;"><img src="images/icon_email_blue.png" width="32" height="32" style="border:none" onclick="javascript:show_hide_opacity('show');form_share_page('show');" alt=""/></div>
    
	
        <script type="text/javascript">
		function form_share_page(action){
                if(action=="show"){
                    document.getElementById('form_share_page').style.display="block";
                    }
                if(action=="hide"){     
                    document.getElementById('form_share_page').style.display="none";
                    }
        }
		</script>
</div>
<div id="form_share_page" style="position:fixed; display:none;  width:633px;height:329px; padding-top:10px; padding-left:10px; margin-left:340px;  top:205px; cursor:pointer; z-index:8; background-image:url(images/bg_form_share_page.png);">
	<div style="font-size:16px; color:#000; border-bottom:solid 1px #F5F5F5; padding-bottom:7px; width:580px; float:left;"> &#187; Compartir con un amigo </div><div><img src="images/btn_close_orange.png" width="21" height="19" alt="" onclick="javascript:form_share_page('hide');show_hide_opacity('hide');" style="border:none; cursor:pointer;" /></div>
    <div style="padding-top:20px; color:#666;">
    <form action="http://<?=$page_domain.$country."/ayuda-contacto/compartirpagina/"; ?>" method="post" id="share_with_friend" name="share_with_friend">
        <div style="width:250px; float:left;overflow:hidden;">
            <label style="font-size:12px;"><strong style="color:#F90;">Tu nombre </strong> </label> <br />
      		<input name="your_name" id="your_name" type="text" size="30" /><br />
            <label style="font-size:12px;"><strong style="color:#F90;">Tu email</strong></label><br /> 
            <input name="your_email" id="your_email" type="text" size="35" /><br />
        </div>
        <div style="width:300px; float:left;overflow:hidden;">
            <label style="font-size:12px;">Nombre de <strong style="color:#F90;">tu amigo</strong></label> <br />
          	<input name="other_name" id="other_name" type="text" size="30" /><br />
            <label style="font-size:12px;">Email de <strong style="color:#F90;">tu amigo</strong></label><br/>
            <input name="other_email" id="other_email" type="text" size="35" /><br />
        </div>
        <div style="overflow:hidden; width:590px;">
        	<label style="font-size:12px;">Mensaje</label><br />
        	<textarea cols="80" rows="8" id="msg" name="msg"></textarea>
        </div>
        <div style="text-align:right; padding-right:45px; padding-top:10px;"><img src="images/btn_share_green.png" width="152" height="32" alt="" onclick="document.share_with_friend.submit();"/></div>
     </form> 
    </div>
</div>
<? } ?>


<? 
	if($tb_page_link->obtenerDato("file","url='$page_seccion'"))
	include($tb_page_link->obtenerDato("file","url='$page_seccion'"));
	else echo "Oops ésta sección no existe... site_map.php";
?>

</div>
<!-- Finaliza:  id="container" -->