<? 
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
?>