<div style="margin:0 auto 0 auto;width:950px;overflow:hidden;">
	<? include("site_submenu.php");?> 
   <div style="font-family:Verdana, Geneva, sans-serif;color:#787878; padding-left:7px; padding-top:18px; float:left; width:750px; line-height:20px;">
         <span style="font-size:22px; color:#F60;text-shadow: 0 1px 0 #EAEAEA;">Nuestro Personal</span><br/>
         <p style="border-bottom:solid 1px #F8F8F8;">Redefinimos los procesos ordinarios de trabajo en equipo. En HostDime creamos un ambiente divertido y amigable para trabajar. Tener la mejor tecnolog&iacute;a para nosotros es importante, pero es nuestro equipo profesional el que da respalado con su &eacute;tica a toda nuestra empresa
         </p>
          <div style="margin-top:20px; padding-bottom:30px; overflow:hidden;">
		 <? 
		// $list_division_employee=$tb_page_division_employee->select("staffid,position","domain_id=$domain_id Order by division_employee_id ASC");
		$list_division_employee=$tb_page_division_employee->select("staffid,position","domain_id=1 Order by division_employee_id ASC");
		 if($row_division_employee=mysql_fetch_assoc($list_division_employee)){		
				do{ ?>
        
         	<div style="float:left; color:#000;">
         		<div style="width:182;margin-left:5px;">
         			<img src="<?=$tb_page_hr_employees_photos->obtenerDato("url","staffid=".$row_division_employee["staffid"]); ?>" width="178" height="200" style="border:solid 1px #EEE;" alt="" />
                </div>
                <div style="width:182;text-align:center; font-size:11px;"><?=utf8_encode($tb_hr_employees->obtenerDato("name","staffid=".$row_division_employee["staffid"])); ?><br /> <span style="color:#F60;text-shadow: 0 1px 0 #EAEAEA;"><?=utf8_encode($row_division_employee["position"]); ?></span></div>
            </div>
           <? }while($row_division_employee=mysql_fetch_assoc($list_division_employee)); 
		 }
		   ?>
         </div> 
         
  </div>
      
</div>