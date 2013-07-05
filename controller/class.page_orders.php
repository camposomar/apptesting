<? 
class tb_page_orders {
	function select($parametro="*",$condicion=NULL){
		include("Connections/db_connection_page.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_orders` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		return $result;
	}
	function obtenerFila($parametro,$condicion=NULL){
		include("Connections/db_connection_page.php");
			if($condicion==NULL)
				$condicion="";
			else 
				$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_orders` $condicion Limit 1";
		$result=mysql_query($selectSQL,$db_connection);
		$row = mysql_fetch_assoc($result);
		return $row; 	
	}
	function obtenerDato($parametro,$condicion=NULL){
		include("Connections/db_connection_page.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro AS Dato FROM `tb_page_orders` $condicion  Limit 1";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Dato'];
	}
	function math($operador,$condicion=NULL){
		include("Connections/db_connection_page.php");
		// SUM, COUNT, AVG, etc
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $operador(*) AS Result FROM `tb_page_orders` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Result'];
		}
	function insert($client_id="",$package_id_core="",$order_status="",$service_type="",$service_name="",$cicle_type="",$signupdate="",$signuptime="",$price_cicle="",$datenext_renew="",$first_date_prorate_of="",$first_date_prorate_to="",$first_prorate_quantity="",$signupdate_less26="",$second_date_prorate_of="",$second_date_prorate_to="",$second_prorate_quantity="",$note_1="",$note_2=""){
		include("Connections/db_connection_page.php");
		$insertSQL="INSERT INTO `tb_page_orders` (client_id,package_id_core,order_status,service_type,service_name,cicle_type,signupdate,signuptime,price_cicle,datenext_renew,first_date_prorate_of,first_date_prorate_to,first_prorate_quantity,signupdate_less26,second_date_prorate_of,second_date_prorate_to,second_prorate_quantity,note_1,note_2) VALUES ('$client_id','$package_id_core','$order_status','$service_type','$service_name','$cicle_type','$signupdate','$signuptime','$price_cicle','$datenext_renew','$first_date_prorate_of','$first_date_prorate_to','$first_prorate_quantity','$signupdate_less26','$second_date_prorate_of','$second_date_prorate_to','$second_prorate_quantity','$note_1','$note_2');";
		if(mysql_query($insertSQL,$db_connection)) return true; else return false;
		}
	function delete($condition){
		include("Connections/db_connection_page.php");
		$deletetSQL="DELETE FROM `tb_page_orders` WHERE $condition";
		if(mysql_query($deletetSQL,$db_connection)) return true; else return false;
		}
	function update($parametro,$condition){
		include("Connections/db_connection_page.php");
		if($condition==NULL)
			$condition="";
		else 
		$condition=" WHERE ".$condition;
		$updateSQL="UPDATE `tb_page_orders` SET $parametro $condition";
		if(mysql_query($updateSQL,$db_connection)) return true; else return false;
		}			
}
?>