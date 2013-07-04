<? 

?>
<div style="height:450px; background-image:url(images/hosting_windows_plesk_slider.png); background-repeat:no-repeat; border:solid 1px #FFF; margin-top:4px;">
  <? if($page_seccion=="/") {?>
  <div style="overflow:hidden; margin-top:200px; padding-right:35px; text-align:right;">
    	<a href="<?=$country;?>/web-hosting/individual-windows-pesk/#windows_shared_packs" onmouseover="javascript:change_btn(2);" onmouseout="javascript:change_btn(1);"><img src="images/btn_green_1.png" alt="" style="border:none;" id="btn_windows_shared"/></a>
        <script type="text/javascript">
			function change_btn(op){
				if(op=="1"){
					document.getElementById('btn_windows_shared').src="images/btn_green_1.png";
				}
				if(op=="2"){
					document.getElementById('btn_windows_shared').src="images/btn_green_2.png";
				}
			}
		</script>
        </div>	
    <? } ?>                
</div>