<?
$nombre_division = "HostDime Latinoamérica";
if($domain_id == 1) $nombre_division = "HostDime México";
if($domain_id == 3) $nombre_division = "HostDime España";

?>
<div style="overflow:hidden; margin-bottom:40px;">
	 <div style="margin:0 auto 0 auto;border:none;width:950px;margin-top:5px;">
    	<div style="overflow:hidden; border-bottom:solid 1px #CCC; margin-bottom:15px;">
        	<div style="width:425px; float:left; overflow:hidden; border-right:solid 1px #E7E7E7; margin-bottom:5px; margin-top:20px;">
            	<div style="font-size:22px;">¿Cuentas con datos de acceso a Core?</div>
                <div style="margin:10px; font-size:12px; line-height:20px;">Sientase libre de generar un ticket para el seguimiento de su problema, nuestros equipo de ingenieros están disponibles para ayudarle.</div>
                <div style="margin-top:15px;">
                	<form method="post" action="<?=$link_core; ?>" style="padding-left:10px;">
                    <div style="overflow:hidden;">
                        <div style="font-size:13px; line-height:20px; float:left;padding-top:5px; font-weight:900;">Email: </div>
                        <div style="float:left; padding-left:50px; width:250px;"><input type="text" name="email" style="font-size:18px; padding-left:7px; color:#666;"/></div>
                    </div>
                    <div style="overflow:hidden; margin-top:5px;">    
                        <div style="font-size:13px; line-height:20px; float:left; padding-top:5px;font-weight:900;">Constraseña:</div>
                        <div style="float:left; margin-left:5px;"><input type="password" name="password" style="font-size:18px;padding-left:7px; color:#666;"/></div>
                    </div>
                    <div style="text-align:right; margin-top:30px; padding-right:75px;"> <input type="submit" style="background-image:url(images/login_portal_core_button.png); width:97px; height:29px; border:none; cursor:pointer;" value=""/></div>
                    <div style="margin:20px;"><a href="<?=$tb_page_domain->obtenerDato("link_forgot_password","domain='".$page_domain."'");?>" style="color:#06C; font-size:13px;">¿Ha olvidado su contraseña?</a></div>
                    </form>
                </div>
            </div>
            <div style="width:455px; float:left; overflow:hidden; margin-left:20px;margin-bottom:5px; margin-top:20px;">
            	<div style="font-size:22px;">¿Eres nuevo? haz una cuenta en Core...</div>
                <div style="margin:10px; font-size:12px; line-height:20px;">Al tener una cuenta en Core, puedes dar seguimiento detallado a todos los casos técnicos, puedes visualizar tus servicios contratados y obtener detalles de todo lo relacionado con tus finanzas.</div>
                <div style="text-align:center; margin-top:45px;"><a href="<?=$tb_page_domain->obtenerDato("link_if_new","domain='".$page_domain."'");?>" ><img src="images/signup_core.png" width="249" height="60" alt="" style="border:none; cursor:pointer;" /></a></div>
            </div>
        </div>
        <div style="width:400px; float:left;">
        	<div style="font-size:20px; overflow:hidden; border:solid #EFEFEF 1px;  padding:10px;color:#333;  background-color:#F6F6F6;">Oficinas
			<?=$nombre_division;?></div>
             <div style="margin:10px; font-size:13px; line-height:21px; font-weight:800;"><?=utf8_encode($tb_page_division->obtenerDato("physical_address","division_id='$division_id'")); ?> <br />
             <span style="color:#09F;">Escríbenos:</span> <a href="mailto:core.desk@hostdime.com.mx" style="color:#F90;">core.desk@hostdime.com.mx</a></div>
            <div style="overflow:hidden; border:solid 1px #CCC; padding:5px; margin-top:25px; margin-bottom:25px; width:380px;">
            <iframe width="380" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q=Av.+L%C3%B3pez+Mateos+Sur+2077+guadalajara&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=40.001301,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=L%C3%B3pez+Mateos+Sur+2077,+Zapopan,+Jalisco,+M%C3%A9xico&amp;t=m&amp;ll=20.664028,-103.398085&amp;spn=0.02088,0.025663&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Av.+L%C3%B3pez+Mateos+Sur+2077+guadalajara&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=40.001301,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=L%C3%B3pez+Mateos+Sur+2077,+Zapopan,+Jalisco,+M%C3%A9xico&amp;t=m&amp;ll=20.664028,-103.398085&amp;spn=0.02088,0.025663&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Ver mapa más grande</a></small>
            <? /*
            		<iframe width="380" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?msa=0&amp;msid=212519895541066674697.0004ab1e49c3cc51d29f3&amp;ie=UTF8&amp;vpsrc=6&amp;ll=20.670613,-103.382292&amp;spn=0.01044,0.016265&amp;z=15&amp;output=embed"></iframe><br /><small>Ver <a href="http://maps.google.com/maps/ms?msa=0&amp;msid=212519895541066674697.0004ab1e49c3cc51d29f3&amp;ie=UTF8&amp;vpsrc=6&amp;ll=20.670613,-103.382292&amp;spn=0.01044,0.016265&amp;z=15&amp;source=embed" style="color:#0000FF;text-align:left">HostDime Localizations</a> en un mapa más grande</small>
                  */ ?>
            </div>
           
            
            <div style="background-image:url(images/phone-icon.jpg); background-repeat:no-repeat; height:35px; padding-left:45px; font-size:18px;  border-bottom:solid 1px #F7F7F7;border-top:solid 1px #F7F7F7; margin-bottom:5px; padding-top:4px;">Teléfonos <?=$nombre_division;?></div>
            <div style="font-size:12px; margin-left:15px; line-height:20px; margin-bottom:15px;">
            	
            <? if($tb_page_division_phones->math("COUNT","division_id=$division_id")>0){ ?>
            	<? 
					$list_page_division_phones=$tb_page_division_phones->select("phone,city","division_id=$division_id");
					$row_page_division_phones=mysql_fetch_assoc($list_page_division_phones);
					do{
						echo utf8_encode("<strong style=\"color:#000\">".$row_page_division_phones['phone']." | </strong><strong style=\"color:#DF5B02;\">".$row_page_division_phones['city']."</strong><br/>");
						}while($row_page_division_phones=mysql_fetch_assoc($list_page_division_phones));
				?>
            <? } ?>
            </div>
            <div style="font-size:20px; overflow:hidden; border:solid #EFEFEF 1px; padding:10px;color:#333; background-color:#F6F6F6;">Oficina USA</div>
            <div style="margin:10px; font-size:12px; line-height:21px;font-weight:800;">
            	189 S. Orange Avenue<br />
				Suite 1500S<br />
				Orlando, Florida 32801 US<br />
                Tel. (888) 402-3463
            </div>
            <div style="overflow:hidden; border:solid 1px #CCC; padding:5px; margin-top:25px; margin-bottom:25px; width:380px;">
            	<iframe width="380" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?msa=0&amp;msid=212519895541066674697.0004ab1e49c3cc51d29f3&amp;ie=UTF8&amp;vpsrc=6&amp;ll=28.541326,-81.376934&amp;spn=0.009802,0.016265&amp;z=15&amp;output=embed"></iframe><br /><small>Ver <a href="http://maps.google.com/maps/ms?msa=0&amp;msid=212519895541066674697.0004ab1e49c3cc51d29f3&amp;ie=UTF8&amp;vpsrc=6&amp;ll=28.541326,-81.376934&amp;spn=0.009802,0.016265&amp;z=15&amp;source=embed" style="color:#0000FF;text-align:left">HostDime Localizations</a> en un mapa más grande</small>
            </div>
            
        </div>
    	<div style="width:520px; float:left; padding-left:15px;">
        	<div style="font-size:20px; overflow:hidden; border:solid #EFEFEF 1px;padding:10px; padding-left:45px;color:#333; background-color:#F6F6F6; background-image:url(images/help-contact-icon-email.png); background-repeat:no-repeat;">Comentarios y sugerencias </div>
            <form action="<?=$page_seccion;?>msg/" method="post" id="enviaremail" name="enviaremail">
            <div style="font-size:16px; margin-top:25px;">¿Cuál es su Nombre?</div>
            <div style="margin-top:10px;"><input type="text" name="nombre" id="nombre" style="font-size:16px; width:250px;"  /></div>
            
            <div style="font-size:16px; margin-top:15px;">¿Cuál es su Email?</div>
            <div style="margin-top:10px;"><input type="text" name="email" id="email" style="font-size:16px; width:250px;"  /></div>
            
            
            <div style="font-size:16px; margin-top:15px;">Mensaje</div>
            <div style="margin-top:10px;"><textarea rows="15" cols="65" name="msg" id="msg"></textarea></div>
            
            <div style="margin-top:15px; height:48px; text-align:right; padding-right:30px;"><img src="images/help-contact-btn-sendemail.png" width="125" height="48" alt="" onclick="document.enviaremail.submit();" style="cursor:pointer;"/></div>
          	</form>
            <div style="margin-left:5px; margin-top:15px;">
                <div style="font-size:20px; overflow:hidden;border:solid #EFEFEF 1px; padding:10px;color:#333; background-color:#F6F6F6; ">Centro de Datos</div>
                    <div style="margin:10px; font-size:12px; line-height:21px;font-weight:800;">
                        440 west kennedy blvd<br />
                        Suite 1 <br />
                        Orlando,FL 32810 US
                    </div>
                    <div style="overflow:hidden; border:solid 1px #CCC; padding:5px; margin-top:25px; margin-bottom:25px;width:380px;">
                        <iframe width="380" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?msa=0&amp;msid=212519895541066674697.0004ab1e49c3cc51d29f3&amp;hl=es&amp;ie=UTF8&amp;vpsrc=6&amp;ll=28.618432,-81.393285&amp;spn=0.009795,0.016265&amp;z=15&amp;output=embed"></iframe><br /><small>Ver <a href="http://maps.google.com/maps/ms?msa=0&amp;msid=212519895541066674697.0004ab1e49c3cc51d29f3&amp;hl=es&amp;ie=UTF8&amp;vpsrc=6&amp;ll=28.618432,-81.393285&amp;spn=0.009795,0.016265&amp;z=15&amp;source=embed" style="color:#0000FF;text-align:left">HostDime Localizations</a> en un mapa más grande</small>
                    </div>
        		</div>
            
        </div>
        
  
      </div>
</div>