<? 
class tb_page_token {
	function select($parametro="*",$condicion=NULL){
		include("Connections/db_connection_page.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_token` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		return $result;
	}	
	function obtenerFila($parametro,$condicion=NULL){
		include("Connections/db_connection_page.php");
			if($condicion==NULL)
				$condicion="";
			else 
				$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_token` $condicion Limit 1";
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
		$selectSQL="SELECT $parametro AS Dato FROM `tb_page_token` $condicion  Limit 1";
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
		$selectSQL="SELECT $operador(*) AS Result FROM `tb_page_token` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Result'];
		}
	function insert($token_key="",$status=""){
		include("Connections/db_connection_page.php");
		$insertSQL="INSERT INTO `tb_page_token` (token_key,status) VALUES ('$token_key',  '$status');";
		if(mysql_query($insertSQL,$db_connection)) return "Éxito al Guardar..."; else return "Error al Guardar";
		}
			
	function delete($condition){
		include("Connections/db_connection_page.php");
		$deletetSQL="DELETE FROM `tb_page_token` WHERE $condition";
		if(mysql_query($deletetSQL,$db_connection)) return true; else return false;
		}
}

?>