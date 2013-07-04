<style type="text/css">
.security{
	color:#E0630E;
}
</style>
<? include("site_submenu_2sub.php");?> <br />

<div style="width:750px; margin:auto; float:right">
							
				<!--Start content-->
				<div class="content">
					<!-- Start Right Column -->
					<div id="subtext" class="subtitleb">
                    <div style="float:right"><img src="/images/server_security.png" alt="Servidores dedicados"></div>
                        <span style="font-size:22px; color:#F60; text-shadow: 0 1px 0 #eaeaea; padding-bottom:10px; border-bottom: solid 1px #f8f8f8; margin-bottom:25px;">Seguridad en Servidores dedicados</span>
                        <p>La seguridad es uno de los puntos más importantes en Internet. Prestamos especial atención en la seguridad de cada servidor para proporcionar tranquilidad a nuestros clientes. Todos lo servidores de HostDime son sometidos a una inspección de seguridad de cinco puntos cuando son desplegados.<br>
                        </p>
                        <p><strong>Punto 1:</strong> <span class="security"><strong>Verificar versión del kernel.</strong></span> El kernel de Linux es el sistema central de todo sistema Linux. Siempre verificamos la versión del el kernel para estar seguros que no hay vulnerabilidades explotables. Si alguna vulnerabilidad es descubierta, actualizamos inmediatamente el kernel y nos pondremos en contacto contigo para programar un reinicio.</p>
                        <p><strong>Punto 2:</strong> <span class="security"><strong>Comprobar la configuración de PHP.</strong></span> Existen varias configuraciones de PHP que se recomiendan deshabilitar en servidores que no las requieren.</p>
                        <ul>
                          <li>
                            <p><strong>“allow_url_fopen”</strong>. Esta configuración permite a PHP tratar a cualquier URL como si fuera un archivo. Esto representa un riesgo de seguridad para ciertas aplicaciones PHP que no sanitizan las declaraciones de include y fopen. La mayoría de las aplicaciones no requieren &quot;allow_url_fopen&quot; y recomendamos mantenerla deshabilitada (especialmente en servidores con PHP4).</p>
                          </li>
                          <li>
                            <p><strong>“allow_url_include”</strong>. Esta configuración fué introducida en PHP5.2, permite a los usuarios habilitar de forma segura &quot;allow_url_fopen&quot; cuando se requiere en una aplicación. Casi ninguna aplicación requiere allow_url_include habilidad, por esta razón, recomendamos mantener deshabilitado &quot;allow_url_include&quot;. </p>
                          </li>
                          <li>
                            <p><strong>“register_globals”</strong>. Esta configuración permite que variables globales sean definidas en tiempo de ejecucción por medio de la URL, tenerla activada permite a los atacantes a modificar arbitrariamente las variables de PHP. Esto puede llevar a inyecciones SQL, ejecución de código arbitrario y otras vulnerabilidades en aplicaciones PHP. Por lo general recomendamos tener desactivada &quot;register_globals&quot;.</p>
                          </li>
                          <li>Además de esas tres configuraciones, recomendamos deshabilitar ciertas funciones vulnerables, de este modo, se reduce la eficacia de consolas PHP y otro software malintencionado basado en PHP, la lista de funciones que recomendamos deshabilitar es la siguiente:<br>
                          <em>dl, exec, shell_exec, system, passthru, popen, pclose, proc_open, proc_nice, proc_terminate, proc_get_status, proc_close, pfsockopen, leak, apache_child_terminate, posix_kill, posix_mkfifo, posix_setpgid, posix_setsid, posix_setuid</em> </li>
                        </ul>
                        <p><strong>Punto 3:</strong> <span class="security"><strong>Verificar el conjunto de reglas en mod_security de Apache.</strong></span>  mod_security de Apache es un firewall de software que analiza las peticiones HTTP entrantes en busca de vulnerabilidades conocidas, nosotros mantenemos un conjunto de reglas internas para muchos exploits conocidos. Siempre revisamos para asegurarnos que el conjunto de reglas instalado es el más reciente antes de desplegar el servidor. Opcionalmente podemos configurar el servidor para que se actualice diariamente y siempre esté con el conjunto de reglas más actual.</p>
                        <p><strong>Punto 4:</strong> <span class="security"><strong>Comprobar configuración de CSF/LFD.</strong></span> CSF/LFD es un paquete de firewall por software que soporta la detección y prevención automática de ataques por fuerza bruta, rastreo de procesos y un amplio rango de otras amenazas. Instalamos y configuramos CSF/LDF en todos nuestros sistema linux por defecto.</p>
                        <p><strong>Punto 5:</strong> <span class="security"><strong>Comprobar archivos binariosdel sistema.</strong></span> Comprobamos los archivos binarios del sistema (como BIND, apache, udev, etc.) para asegurarnos que se encuentren actualizados y no sean vulnerables a ataques conocidos.</p>
<p class="upgrades">&nbsp;</p></div>             
				 <!--End content-->
				</div> 
			<!--End Rightpart-->
			</div>