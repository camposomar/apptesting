<? 
class tb_dna_clients {
	function select($parametro="*",$condicion=NULL){
		include("Connections/db_connection_core.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `dna_clients` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		return $result;
	}
	function obtenerFila($parametro,$condicion=NULL){
		include("Connections/db_connection_core.php");
			if($condicion==NULL)
				$condicion="";
			else 
				$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `dna_clients` $condicion Limit 1";
		$result=mysql_query($selectSQL,$db_connection);
		$row = mysql_fetch_assoc($result);
		return $row; 	
	}
	function obtenerDato($parametro,$condicion=NULL){
		include("Connections/db_connection_core.php");
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro AS Dato FROM `dna_clients` $condicion  Limit 1";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Dato'];
	}
	function math($operador,$condicion=NULL){
		include("Connections/db_connection_core.php");
		// SUM, COUNT, AVG, etc
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $operador(*) AS Result FROM `dna_clients` $condicion";
		$result=mysql_query($selectSQL,$db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Result'];
		}
			
}
?>