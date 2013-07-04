<!-- 
Inicia: id="page" es el gran-contenedor se usa para 
1. javascript:hide_submenu('','','',''); lo que hace es ocultar cualquier submenu al hacer clic en alguna parte del site. 
2. estar llamando la función current_header_menu_selected() siempre (onMouseMove) lo que indica que siempre abrá un foco en el "actual menu de la sección visitada."
3. id="page" está con display:none; quiere decir que el gran contenedor estará oculto vease <script type="text/javascript"> document.getElementById('page').style.display='block';
</script> antes de </body> cuando TODA la página se ha cargado el gran contenedor se pone visible.
-->

<div id="page" onClick="javascript:hide_submenu('','','','');" onMouseMove="current_header_menu_selected();" style="display:none; overflow:hidden; width:100%">
<? include("site_header.php");?>
<? include("site_container.php");?>
<? include("site_footer.php"); ?>
</div>
<!-- Finaliza id="page" -->

<!-- Una vez que TODO el HTML está cargado se pone como visible id="page" -->
<script type="text/javascript">
document.getElementById('page').style.display='block';
</script>