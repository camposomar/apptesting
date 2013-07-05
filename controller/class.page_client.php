<? 
class tb_page_client {
	function select($parametro="*",$condicion=NULL){
		include("Connections/db_connection_page.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_client` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		return $result;
	}
	function obtenerFila($parametro,$condicion=NULL){
		include("Connections/db_connection_page.php");
			if($condicion==NULL)
				$condicion="";
			else 
				$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_client` $condicion Limit 1";
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
		$selectSQL="SELECT $parametro AS Dato FROM `tb_page_client` $condicion  Limit 1";
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
		$selectSQL="SELECT $operador(*) AS Result FROM `tb_page_client` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Result'];
		}
	function insert($previous_page="",$visit_key="",$domain_id="",$division_id=""){
		include("Connections/db_connection_page.php");
		$insertSQL="INSERT DELAYED INTO `tb_page_client` (previous_page,visit_key,domain_id,division_id) VALUES ('$previous_page','$visit_key','$domain_id','$division_id');";
		if(mysql_query($insertSQL,$db_connection)) return true; else return false;
		}
	function delete($condition){
		include("Connections/db_connection_page.php");
		$deletetSQL="DELETE FROM `tb_page_client` WHERE $condition";
		if(mysql_query($deletetSQL,$db_connection)) return true; else return false;
		}
	function update($parametro,$condition){
		include("Connections/db_connection_page.php");
		if($condition==NULL)
			$condition="";
		else 
		$condition=" WHERE ".$condition;
		$updateSQL="UPDATE `tb_page_client` SET $parametro $condition";
		if(mysql_query($updateSQL,$db_connection)) return true; else return false;
		}		
}
?>