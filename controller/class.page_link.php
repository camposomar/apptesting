<? 
class tb_page_link {
	function select($parametro="*",$condicion=NULL){
		include("Connections/db_connection_page.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_link` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		return $result;
	}	
	function obtenerFila($parametro,$condicion=NULL){
		include("Connections/db_connection_page.php");
			if($condicion==NULL)
				$condicion="";
			else 
				$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_link` $condicion Limit 1";
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
		$selectSQL="SELECT $parametro AS Dato FROM `tb_page_link` $condicion  Limit 1";
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
		$selectSQL="SELECT $operador(*) AS Result FROM `tb_page_link` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Result'];
		}
	function insert($url="",$label="",$file=""){
		include("Connections/db_connection_page.php");
		$insertSQL="INSERT INTO `tb_page_link` (url,label,file) VALUES ('$url',  '$label',  '$file');";
		if(mysql_query($insertSQL,$db_connection)) return "Éxito al Guardar..."; else return "Error al Guardar";
		}
	function delete($condition){
		include("Connections/db_connection_page.php");
		$deletetSQL="DELETE FROM `tb_page_link` WHERE $condition";
		if(mysql_query($deletetSQL,$db_connection)) return true; else return false;
		}
}
?>