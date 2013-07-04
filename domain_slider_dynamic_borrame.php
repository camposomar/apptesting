<div style="height:450px;  background-image:url(images/background_domains.png); background-repeat:no-repeat;border:solid 1px #FFF; margin-bottom:25px;">
        <div style="font-size:22px;  margin-left:70px; margin-top:15px; margin-bottom:20px; text-align:left; font-weight:500; color:#FFF">Registra todos tus dominios aquí</div>
        <div style="border-bottom:solid 1px #E8E8E8; margin-left:30px; margin-right:50px; overflow:hidden; margin-top:40px; padding-bottom:10px;">
        	<div style="float:left;width:240px;">
            	<div style="font-size:22px; color:#069;">Paso 1</div>
                <div style="color:#666;">escribe hasta 15 dominios en lista </div>
           	</div>
            <div style="float:left;width:400px;">
            	<div style="font-size:22px; color:#069;">Paso 2</div>
                <div style="color:#666;">selecciona las extensiones que deseas</div>
           	</div>
            <div style="float:left;">
            	<div style="font-size:22px; color:#069;">Paso 3</div>
                <div style="color:#666;">click para verificar la disponibilidad</div>
           	</div>
       	</div>
        <div style="margin-left:30px; margin-right:50px; overflow:hidden; margin-top:15px;">
            <form method="post" action="<?=$_SESSION['country'] ?>/web-hosting/individual-linux-cpanel-temp/#list_domains" id="form_slider_domain" name="form_slider_domain">
            <div style="width:240px; float:left; border-right:solid 1px #F0F0F0; overflow:hidden;border-left:solid 1px #F0F0F0;">
                <textarea name="domains_names" id="domains_names" style="width:225px;" rows="5"></textarea></div>
            <div style="width:400px;float:left; padding-left:10px; overflow:hidden;height:120px;">
            <? 
            $list_tld_domain=$tb_core_tld->select("tld","company_id='$_SESSION[core_company_id]'");
                                        $row_tld_domain=mysql_fetch_assoc($list_tld_domain);		
                                        $x=0;
										do{  
                                        echo "
                                        <div style=\"width:100px; float:left; margin-top:5px;\">
                                        <input type=\"checkbox\" value=\"$row_tld_domain[tld]\" id=\"".str_replace(".","",$row_tld_domain['tld'])."\" name=\"".str_replace(".","",$row_tld_domain['tld'])."\""; if($x<4){ echo "checked";} echo "/>$row_tld_domain[tld]</div>";
                                        $x++;
										}while($row_tld_domain=mysql_fetch_assoc($list_tld_domain));
            ?>
            </div>	
            <div style="float:left; margin-left:10px; overflow:hidden; margin-top:15px;">
            <img src="images/btn_checkis_avaliable.png" alt="" onclick="document.form_slider_domain.submit();" style="border:none; cursor:pointer;" />
            </div>
            </form>	
       </div>    
       
       <div style="margin-top:60px; margin-right:20px; margin-left:20px; overflow:hidden;">
       		<div style="float:left; width:570px; margin-top:15px; margin-left:15px;">
            	<div style="float:left; width:260px; overflow:hidden;border-bottom:solid 1px #F5F5F5;">
                	<div style="float:left; height:25px;width:15px;"><img src="images/icon_vinieta_blue.png" alt="" style="border:none;"/></div>
                    <div style="float:left; height:20px;width:230px;padding-top:5px;">
                    <a href="<?=$_SESSION['country'];?>/web-hosting/individual-windows-pesk/" style="text-shadow: 0 1px 0 #EEE;color:#42A1B7; font-size:12px;">Ver planes de Hosting con Plesk</a></div>
                </div>
                <div style="float:left; width:260px; overflow:hidden; border-bottom:solid 1px #F5F5F5; margin-left:15px;">
                	<div style="float:left; height:25px;width:15px;"><img src="images/icon_vinieta_blue.png" alt="" style="border:none;"/></div>
                    <div style="float:left; height:20px;width:230px;padding-top:5px;">
                    <a href="<?=$_SESSION['country'];?>/web-hosting/individual-linux-cpanel/" style="text-shadow: 0 1px 0 #EEE;color:#42A1B7; font-size:12px;">Ver planes de Hosting con cPanel</a></div>
                </div>
                <div style="float:left; width:260px; overflow:hidden;border-bottom:solid 1px #F5F5F5;">
                	<div style="float:left; height:25px;width:15px;"><img src="images/icon_vinieta_blue.png" alt="" style="border:none;"/></div>
                    <div style="float:left; height:20px;width:230px;padding-top:5px;">
                    <a href="<?=$_SESSION['country'];?>/web-hosting/reseller-windows-plesk/" style="text-shadow: 0 1px 0 #EEE;color:#42A1B7; font-size:12px;">Ver planes Reseller con Plesk</a></div>
                </div>
                <div style="float:left; width:260px; overflow:hidden; border-bottom:solid 1px #F5F5F5; margin-left:15px;">
                	<div style="float:left; height:25px;width:15px;"><img src="images/icon_vinieta_blue.png" alt="" style="border:none;"/></div>
                    <div style="float:left; height:20px;width:230px; padding-top:5px;">
                    <a href="<?=$_SESSION['country'];?>/web-hosting/reseller-linux-whm-cpanel/" style="text-shadow: 0 1px 0 #EEE;color:#42A1B7; font-size:12px;">Ver planes Reseller con WHM</a></div>
                </div>    
           </div>
           <div style="float:right; width:200px; text-align:right;"><img src="images/btn_iniciar_chat.png" alt="" style="border:none; cursor:pointer;" onclick="window.open('<?=$tb_page_domain->obtenerDato("link_livechat","domain_id=".$_SESSION['domain_id']);?>','chat','width=545,height=597,scrollbars=no,menubar=no,resizable=no,toolbar=no,titlebar=no,location=no,status=no');return false;" /></div>
       	
       </div>					
</div>