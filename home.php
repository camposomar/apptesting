<div style="margin:0 auto 0 auto;width:950px;overflow:hidden;">
		
        <!--
        <div style="padding:5px; margin-bottom:3px; margin-top:3px; background-color:#F00; color:#FFF;" class="redondeo5px">Aviso: Actualmente estamos haciendo ajustes en nuestra red interna, es probable las líneas telefónicas tengan intermitencia, le recomendamos usar nuestro servicio de Chat y Ticket para contactarnos. Gracias por su comprensión. </div> 
        -->
        <div style="height:450px;width:950px;position:relative; margin-top:4px; margin-top:5px; margin-bottom:5px;">
     
        	 
			<? /*
			
			    			<div id="temporalmente" align="center" style="padding:5px; background-color:#FFC6C7; color:black; font-weight:bold; font-size:12px;">
            Debido a un simulacro de evacuación en nuestras instalaciones, el servicio de soporte técnico vía chat y telefónico no estará disponible de 10:00 AM a 11:00 AM (GMT-5)
            </div><br />

			<div id="temporalmente" align="center" style="padding:5px; background-color:#FFC6C7; color:black; font-weight:bold; font-size:12px;">
            El servicio de soporte técnico telefónico y vía chat se encuentra en mantenimiento correctivo y será reanudado a las 3:00 PM (GMT-6)
            </div><br />
			<div id="temporalmente" align="center" style="padding:5px; background-color:#FFC6C7; color:black; font-weight:bold; font-size:12px;">
            Nuestro sistema telefónico se encuentra en mantenimiento correctivo, solicitamos contactarnos por medio de ticket o via chat.
            </div><br />
			
			*/ 
			
			?>
			
        	<div style="position:relative; left:0px; width:<?php  echo "4750px"; ?>" id="HomeSlider1">
            	<? /* <div style="float:left; width:950px;"><img src="/images/slider_julio.png" align="Promociones Julio" /></div> */ ?>
                
               
                <div style="float:left; width:950px;"><a href="#" onclick="window.open('<?=$tb_page_domain->obtenerDato("link_livechat","domain_id='".$_SESSION['domain_id']."'");?>','chat','width=545,height=597,scrollbars=no,menubar=no,resizable=no,toolbar=no,titlebar=no,location=no,status=no');return false;" style="color:#000; cursor:pointer;"><img src="/images/slider_50.png" alt="50% de descuento" /></a></div>
                
                <div style="float:left; width:950px;"><? include("domain_slider_dynamic.php"); ?></div>
                <div style="float:left; width:950px;"><? include("hosting_linux_cpanel_slider.php")?></div> 
                
                <div style="float:left; width:950px;"><? include("hosting_linux_cpanel_reseller_slider.php");?></div>
                <div style="float:left; width:950px;"><? include("hosting_windows_plesk_slider.php");?></div>
                
            </div>
            <div style="position:absolute; top:200px; width:22px;height:47px;"><img src="images/home_slider_btn_leftToright.png" width="22" height="47" alt="" id="home_slider_btn_leftToright" onmouseover="javascript:SliderChangeBgBtn('home_slider_btn_leftToright','home_slider_btn_leftTorightBg.png');" onmouseout="javascript:SliderChangeBgBtn('home_slider_btn_leftToright','home_slider_btn_leftToright.png');" style="cursor:pointer;" onclick="javascript:HomeSlideWithTime('leftToright');" /></div>
            <div style="position:absolute; top:200px; width:22px;height:47px; left:928px;"><img src="images/home_slider_btn_rightToleft.png" width="22" height="47" alt="" id="home_slider_btn_rightToleft" onmouseover="javascript:SliderChangeBgBtn('home_slider_btn_rightToleft','home_slider_btn_rightToleftBg.png');" onmouseout="javascript:SliderChangeBgBtn('home_slider_btn_rightToleft','home_slider_btn_rightToleft.png');" style="cursor:pointer;" onclick="javascript:HomeSlideWithTime('rightToleft');"/></div>
    </div>
    <div style="margin:0 auto 0 auto;width:950px; height:29px; background-image:url(images/home_slider_shadow.png);"></div>
    <div  style="margin:0 auto 0 auto;width:945px;">
        <div style="height:25px; border-bottom:solid 1px #FAFAFA;font-size:14px; color:#F90; padding-left:10px;">&#187; Síguenos </div>  
  		<div style="padding-left:100px; padding-top:5px;">
            <div style="height:40px; width:40px; float:left;">
            	<a href="http://facebook.com/hdcastellano" target="_blank"><img src="images/icon_facebook.png" width="40" height="40" style="border:none;" alt="" /></a>
            </div>
            <div style="width:200px; height:40px; float:left;padding-top:5px; padding-left:3px;">
            	<div style="font-weight:bold;font-size:17px; padding-top:3px;"><a href="http://facebook.com/hdcastellano" target="_blank" style="color:#333;">Facebook</a></div>
            </div>
            <div style="height:40px; width:40px; float:left;margin-left:40px;">
            	<a href="http://twitter.com/hdcastellano" target="_blank"><img src="images/icon_twitter.png" width="40" height="40" style="border:none;" alt="" /></a>
            </div>
            <div style="width:200px; height:40px; float:left; padding-top:5px;padding-left:3px;">
            	<div style="font-weight:bold;font-size:17px; padding-top:3px;"><a href="http://twitter.com/hdcastellano" target="_blank"  style="color:#333;">Twitter</a></div>
            </div>
           <!-- 
           <div style="height:40px; width:40px; float:left;margin-left:40px;">
            	<a href="http://<?=$page_domain;?>/rss" target="_blank" style="color:#333;"><img src="images/icon_rss.png" width="40" height="40" style="border:none;" alt=""/></a>
            </div>
             <div style="width:200px; height:40px; float:left;padding-top:5px;padding-left:3px;">
            	<div style="font-weight:bold;font-size:17px; padding-top:3px;"><a href="http://<?=$page_domain;?>/rss" style="color:#333;">RSS</a></div>     
            </div>
            -->            
        </div>
  </div>  
</div>
<script type="text/javascript">
	 function SliderChangeBgBtn(objet,url){
		 	document.images[objet].src ="images/"+url;
		 }
</script>
<script type="text/javascript">
	var sliderOnebyOne=0;
	var sliderOnebyOneLeft=0;
	var sumSliders=document.getElementById("HomeSlider1").style.width;
	sumSliders=parseInt(sumSliders.replace("px",""));
	sumSliders=950-sumSliders;
	
	function HomeSlideWithTime(action){
				var HomeSlidermarginLeft=document.getElementById("HomeSlider1").style.left;
				HomeSlidermarginLeft=parseInt(HomeSlidermarginLeft.replace("px",""));
		if(action=="rightToleft" && sumSliders<HomeSlidermarginLeft){		
				if(sliderOnebyOne<=900){
					sliderOnebyOne=sliderOnebyOne+50;
					HomeSlidermarginLeft=HomeSlidermarginLeft-50;
					document.getElementById("HomeSlider1").style.left=HomeSlidermarginLeft+"px";
					setTimeout("HomeSlideWithTime('rightToleft')",1);		
				}else{ sliderOnebyOne=0;}	
			}
		if(action=="leftToright"  && HomeSlidermarginLeft<0){		
				if(sliderOnebyOneLeft<=900){
					sliderOnebyOneLeft=sliderOnebyOneLeft+50;
					HomeSlidermarginLeft=HomeSlidermarginLeft+50;
					document.getElementById("HomeSlider1").style.left=HomeSlidermarginLeft+"px";
					setTimeout("HomeSlideWithTime('leftToright')",1);		
				}else{ sliderOnebyOneLeft=0;}	
			}
		}
</script>