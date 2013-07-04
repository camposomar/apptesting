<? 
function check_domain($name,$tld){
		$name = str_replace('www.','',$name);
		$ch = curl_init("https://core.hostdime.com.mx/purchasedomain/check/?sld=$name&tld=$tld");
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
		curl_setopt($ch, CURLOPT_TIMEOUT,20);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data=curl_exec($ch);
		curl_close($ch);
		if($data==='1'){
			return true;
		}else{
			return false;	
		}
}

function converdate($date){
	$date=explode("-",$date);
	switch($date[1]){
			case "01":{
				$date[1]="Ene";
				break;
				}
			case "02":{
				$date[1]="Feb";
				break;
				}
			case "03":{
				$date[1]="Mar";
				break;
				}
			case "04":{
				$date[1]="Abr";
				break;
				}
			case "05":{
				$date[1]="May";
				break;
				}
			case "06":{
				$date[1]="Jun";
				break;
				}
			case "07":{
				$date[1]="Jul";
				break;
				}
			case "08":{
				$date[1]="Ago";
				break;
				}
			case "09":{
				$date[1]="Sep";
				break;
				}	
			case "10":{
				$date[1]="Oct";
				break;
				}	
			case "11":{
				$date[1]="Nov";
				break;
				}
			case "12":{
				$date[1]="Dic";
				break;
				}												
		}
	return $date[2]." de ".$date[1]." del ".$date[0];	
}
function build_cycle_monthly($price_cycle){
	$price_per_day=$price_cycle/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
	
	if(date("d")<25){
					
					
					$first_date_prorate_of=date("Y-m-d");
					$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
					$first_prorate_quantity=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-date("d"))*$price_per_day;
					$signupdate_less26="NO";
					$datenext_renew=date("Y-m-d");
					if(date("m")<=11){
						$datenext_renew=date("Y")."-".(1+date("m"))."-01";
					}
					else{
						$datenext_renew=1+date("Y")."-01-01";
					}
					$second_date_prorate_of="0000-00-00";
					$second_date_prorate_to="0000-00-00";
					$second_prorate_quantity="0.00";
	}
	
	if(date("d")>=25){
					$second_prorate_quantity=$price_cicle;
					$first_date_prorate_of=date("Y-m-d");
					$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
					$signupdate_less26="YES";
					$first_prorate_quantity=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-date("d"))*$price_per_day;
					
					if(date("m")<=11){
						$datenext_renew=date("Y")."-".(1+date("m"))."-01";
						if(date("m")==11){
							$second_date_prorate_of=date("Y")."-".(1+date("m"))."-01";
							$second_date_prorate_to=date("Y")."-".(1+date("m"))."-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
							$second_prorate_quantity=(cal_days_in_month(CAL_GREGORIAN,"12",date("Y")))*$price_per_day;
							$datenext_renew=1+date("Y")."-01-01";
							
						}else {
							$second_date_prorate_of=date("Y")."-".(1+date("m"))."-01";
							$second_date_prorate_to=date("Y")."-".(1+date("m"))."-".cal_days_in_month(CAL_GREGORIAN,(1+date("m")),date("Y"));
							$datenext_renew=date("Y")."-".(date("m")+2)."-01";
							$second_prorate_quantity=(cal_days_in_month(CAL_GREGORIAN,(date("m")+1),date("Y")))*$price_per_day;
							}
					}
					else{
						$second_date_prorate_of=1+date("Y")."-01"."-01";
						$second_date_prorate_to=1+date("Y")."-01-".cal_days_in_month(CAL_GREGORIAN,("01"),1+date("Y"));
						$second_prorate_quantity=(cal_days_in_month(CAL_GREGORIAN,"01",1+date("Y")))*$price_per_day;
						$datenext_renew=1+date("Y")."-02-01";
					}
	}
					
return array("first_date_prorate_of" => $first_date_prorate_of, "first_date_prorate_to"=> $first_date_prorate_to,"first_prorate_quantity" => $first_prorate_quantity,"second_date_prorate_of" => $second_date_prorate_of,"second_date_prorate_to"=> $second_date_prorate_to,"second_prorate_quantity"=>$second_prorate_quantity ,"datenext_renew"=> $datenext_renew,'signupdate_less26' => $signupdate_less26);
}

function build_cycle_yearly($price_cycle){
	
		$price_per_day=$price_cycle/12/cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
		
		if(date("d")<25){
					$first_date_prorate_of=date("Y-m-d");
					$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
					$first_prorate_quantity=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
					$signupdate_less26="NO";
					$datenext_renew=date("Y-m-d");
					if(date("m")<=11){
						$second_date_prorate_of=(date("Y")."-".(1+date("m"))."-01");
						if(date("m")==01){
							$second_date_prorate_to=date("Y")."-12-".(cal_days_in_month(CAL_GREGORIAN,"12",date("Y")));
						}else {
							//LE RESTO UN MES para que encaje en el día de pago
							$second_date_prorate_to=1+date("Y").'-'.(1-date("m")).'-'.(cal_days_in_month(CAL_GREGORIAN,(date("m")-1),1+date("Y")));	
						}
						$second_prorate_quantity=$price_cycle/12*11;
						$datenext_renew=(1+date("Y"))."-".(date("m"))."-01";
					}
					else{
						$second_prorate_quantity=$price_cycle/12*11;
						$second_date_prorate_of=date('Y-m-',strtotime('+1 month')).'01';
						$second_date_prorate_to=date('Y-m-',strtotime('+11 months')).(cal_days_in_month(CAL_GREGORIAN,(date("m",strtotime('-1 month'))),1+date("Y")));
						$datenext_renew=(1+date("Y"))."-".(date("m"))."-01";
					}
		}
		// Aqui va cuando es despues del 25
		if(date("d")>=25){
					$first_date_prorate_of=date("Y-m-d");
					$first_date_prorate_to=date("Y-m-".cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")));
					$first_prorate_quantity=(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-(date("d"))+1)*$price_per_day;
					$signupdate_less26="YES";
					$datenext_renew=date("Y-m-d");
					if(date("m")<=11){
						$second_date_prorate_of=(date("Y")."-".(1+date("m"))."-01");
						$second_date_prorate_to=1+date("Y").date("-m-").(cal_days_in_month(CAL_GREGORIAN,date("m"),1+date("Y")));	
						$second_prorate_quantity=$price_cycle;
						$datenext_renew=(1+date("Y"))."-".(date("m")+1)."-01";
					}
					else{
						$second_prorate_quantity=$price_cycle/12*11;
						$second_date_prorate_of=date('Y-m-',strtotime('+1 month')).'01';
						$second_date_prorate_to=date('Y-m-',strtotime('+11 months')).(cal_days_in_month(CAL_GREGORIAN,(date("m",strtotime('-1 month'))),1+date("Y")));
						$datenext_renew=(1+date("Y"))."-".(date("m"))."-01";
					}
			}
		
		
return array("first_date_prorate_of" => $first_date_prorate_of, "first_date_prorate_to"=> $first_date_prorate_to,"first_prorate_quantity" => $first_prorate_quantity,"second_date_prorate_of" => $second_date_prorate_of,"second_date_prorate_to"=> $second_date_prorate_to,"second_prorate_quantity"=>$second_prorate_quantity ,"datenext_renew"=> $datenext_renew,'signupdate_less26' => $signupdate_less26);	
}

function build_cycle_domain($total_years,$price){
	
	switch($total_years){
			case "1":{
				// Revisamos que no sea HOY 29 de Feb en un año bisiesto
				if(checkdate(date("m"),date("d"),(1+date("Y")))){
					$datenext_renew=(1+date("Y")).date("-m").date("-d");
					$first_prorate_quantity=$price*$total_years;
				}else{
					$datenext_renew=(1+date("Y")).date("-m").(date("-d")-1);
					$first_prorate_quantity=$price*$total_years;
					}
				break;
				}
			case "2":{
				// Revisamos que no sea HOY 29 de Feb en un año bisiesto
				if(checkdate(date("m"),date("d"),(2+date("Y")))){
					$datenext_renew=(2+date("Y")).date("-m").date("-d");
					$first_prorate_quantity=$price*$total_years;
				}else{
					$datenext_renew=(2+date("Y")).date("-m").(date("-d")-1);
					$first_prorate_quantity=$price*$total_years;
					}
				break;
				}
			case "3":{
				// Revisamos que no sea HOY 29 de Feb en un año bisiesto
				if(checkdate(date("m"),date("d"),(3+date("Y")))){
					$datenext_renew=(3+date("Y")).date("-m").date("-d");
					$first_prorate_quantity=$price*$total_years;
				}else{
					$datenext_renew=(3+date("Y")).date("-m").(date("-d")-1);
					$first_prorate_quantity=$price*$total_years;
					}
				break;
				}
			case "4":{
				// Revisamos que no sea HOY 29 de Feb en un año bisiesto
				if(checkdate(date("m"),date("d"),(4+date("Y")))){
					$datenext_renew=(4+date("Y")).date("-m").date("-d");
					$first_prorate_quantity=$price*$total_years;
				}else{
					$datenext_renew=(4+date("Y")).date("-m").(date("-d")-1);
					$first_prorate_quantity=$price*$total_years;
					}
				break;
				}	
			case "5":{
				// Revisamos que no sea HOY 29 de Feb en un año bisiesto
				if(checkdate(date("m"),date("d"),(5+date("Y")))){
					$datenext_renew=(5+date("Y")).date("-m").date("-d");
					$first_prorate_quantity=$price*$total_years;
				}else{
					$datenext_renew=(5+date("Y")).date("-m").(date("-d")-1);
					$first_prorate_quantity=$price*$total_years;
					}
				break;
				}				
		}
	
	return array("datenext_renew"=> $datenext_renew,"first_prorate_quantity"=> $first_prorate_quantity);
}
?>