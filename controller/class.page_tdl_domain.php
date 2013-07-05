<? 
class tb_page_tdl_domain {
	function select($parametro="*",$condicion=NULL){
		include("Connections/db_connection_page.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_tdl_domain` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		return $result;
	}
	function obtenerFila($parametro,$condicion=NULL){
		include("Connections/db_connection_page.php");
			if($condicion==NULL)
				$condicion="";
			else 
				$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `tb_page_tdl_domain` $condicion Limit 1";
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
		$selectSQL="SELECT $parametro AS Dato FROM `tb_page_tdl_domain` $condicion  Limit 1";
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
		$selectSQL="SELECT $operador(*) AS Result FROM `tb_page_tdl_domain` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Result'];
		}
}
?>