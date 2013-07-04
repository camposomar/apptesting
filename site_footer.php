<!-- Inicia: id="footer" es div que muestra el menú inferior del sitio, éste es un objeto global que está estático en todo el sitio-->
<div id="footer" style="background-image:url(images/background_footer.png); height:275px;">
  <div style="margin:0 auto 0 auto; width:980px;">
        <div class="footer_section" style="margin-left:40px;">
              <span class="footer_title"><a href="<?="$country/hostdime/";?>">HostDime </a></span>
              <br/>
              <a href="<?="$country/hostdime/personal";?>" class="footer_link">Nuestro personal</a><br/>
              <a href="<?="$country/hostdime/instalaciones";?>" class="footer_link">Nuestras instalaciones</a><br/>
              <a href="<?="$country/hostdime/marcas/";?>" class="footer_link">Nuestras marcas</a><br/>
              <a href="<?="$country/hostdime/socios/";?>" class="footer_link">Nuestros socios</a><br/>
           
              <a href="<?="$country/hostdime/comunicados/";?>" class="footer_link">Comunicados</a><br/>
              
              <a href="<?="$country/hostdime/programascomunitarios/";?>" class="footer_link">Programas comunitarios</a><br/>
              <a href="<?="$country/hostdime/logos-identidades/";?>" class="footer_link">Logos e identidades</a><br/>
              <a href="<?="$country/hostdime/legal/";?>" class="footer_link">Legal</a><br />
              <a href="<?="$country/privacidad/";?>" class="footer_link">Política de privacidad</a>
        </div>
       <div class="footer_section">
           <span class="footer_title"><a href="<?=$country.$page_seccion."#";?>">Web Hosting</a></span><br/>
                  <a href="<?="$country/web-hosting/individual-linux-cpanel/";?>" class="footer_link">Hosting Linux cPanel</a><br/>
                  <a href="<?="$country/web-hosting/individual-windows-pesk/";?>" class="footer_link">Hosting Windows Plesk</a><br/>
                  <a href="<?="$country/web-hosting/reseller-linux-whm-cpanel/";?>" class="footer_link">Reseller Linux WHM cPanel</a><br/>
                  <a href="<?="$country/web-hosting/reseller-windows-plesk/";?>" class="footer_link">Reseller Windows Plesk</a><br/>
            <span class="footer_title"><a href="<?=$country.$page_seccion."#";?>">VPS</a></span><br/>
                  <a href="<?="$country/vps/linux/";?>" class="footer_link">VPS Linux</a><br/>
                  <a href="<?="$country/vps/windows/";?>" class="footer_link">VPS Windows</a><br/>
            
              
        </div>
        <div class="footer_section"> 
        	<span class="footer_title"><a href="<?=$country.$page_seccion."#";?>">Servidores</a></span>
              <br/>
              <a href="<?="$country/servidores-dedicados/rentarpersonalizados/";?>" class="footer_link">Para rentar personalizados</a><br/>
             
              
        	 <span class="footer_title"><a href="<?=$country.$page_seccion."#";?>">Colocación</a></span>
              <br/>
              <a href="<?="$country/colocacion/servidorindividual/gdl/";?>" class="footer_link">Guadalajara, JAL</a><br/>
              <a href="<?="$country/colocacion/servidorindividual/";?>" class="footer_link">Orlando, FL</a><br/>
              <span class="footer_title"><a href="<?=$country.$page_seccion."#";?>">Streaming</a></span><br/>
             <span class="footer_link">Audio individual</span><br/>
             <a href="<?="$country/streaming/individual/";?>" class="footer_link">-> Streaming en MP3</a><br/>
             <a href="<?="$country/streaming/aac/";?>" class="footer_link">-> Streaming AAC+ Plus V2</a><br/>
             <a href="<?="$country/streaming/reseller/";?>" class="footer_link">Audio reseller</a><br/>
        </div>
        <div class="footer_section">
        
        	 <span class="footer_title"><a href="<?=$country.$page_seccion."#";?>">Dominios</a></span><br />
              <a href="<?="$country/dominios/registrar/";?>" class="footer_link">Registrar</a><br/>
              <a href="<?="$country/dominios/precios/";?>" class="footer_link">Lista de precios</a><br/>
              <a href="<?="$country/dominios/revendedor/";?>" class="footer_link">Revendedor de dominios</a><br/>
         </div>
        
    <div class="footer_section">
        	 <span class="footer_title"><a href="<?="$country/ayuda-contacto/";?>">Ayuda</a></span>
             
            
      </div>
  </div>
</div>
<!-- Finaliza: id="footer" -->
<div style="background-color:#FBFBFB; border:solid 1px; border-color:#F8F8F8;">
<div style="margin:0 auto 0 auto; width:980px;">
	<div style="margin-left:40px; margin-right:40px; line-height:18px; font-size:11px; color:#333333; padding-bottom:20px;">
	<p style="text-align:justify;">
		<strong style="color:#FF6600; font-size:12px;">HostDime</strong>
	<br/>Es una compañía líder en infraestructura de servidores para web hosting. Proveemos servidores dedicados, hospedaje web compartido y recientemente Streaming para radios online todo puede ser adaptado a sus necesidades. Si usted necesita un paquete de hosting básico o su pequeña empresa necesita una solución de servidor dedicado escalable, estamos dispuestos y somos capaces de satisfacer sus necesidades de alojamiento web.
	</p>
	</div>
</div>
</div>

<!-- Inicia y Finaliza id="orange-line" muestra una linea color naranja en la parte inferior del sitio, éste es un objeto global que está estático en todo el sitio -->
<div id="orange-line" style="height:2px; background-color:#EE7E15;"></div>
<!-- Inicia: id="copyright" muestra la leyenda Copyright, éste es un objeto global que está estático en todo el sitio  -->
<div id="copyright" style="height:35px; background-color:#272529;">
	<div style="margin:0 auto 0 auto; width:960px; padding:3px; color:#FFF;">
    	© Copyright 2001 - <?=date("Y"); ?> HostDime. Todos los derechos reservados.<a href="http://validator.w3.org/check?uri=http%3A%2F%2F<?=str_replace("www.","",$_SERVER['HTTP_HOST']).$_SERVER['REQUEST_URI'];?>" target="_blank" style="text-shadow:none;"> Validado HTML 5 </a>
     </div>
</div>
<!-- Finaliza:  id="copyright"-->