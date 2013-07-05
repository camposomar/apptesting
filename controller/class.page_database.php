<? 
include("Connections/db_connection_page.php");
class tb_page_database {
	
	private $table;
	private $db_connection;
	
	public function __construct($table) {
        $this->table = $table;
		$this->db_connection = mysql_pconnect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or trigger_error(mysql_error(),E_USER_ERROR);
		mysql_select_db(MYSQL_DATABASE, $this->db_connection);
    }
	
	function select($parametro="*",$condicion=NULL){
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `".$this->table."` $condicion";
		$result=mysql_query($selectSQL,$this->db_connection);
		return $result;
	}	
	function obtenerFila($parametro,$condicion=NULL){
			if($condicion==NULL)
				$condicion="";
			else 
				$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro FROM `".$this->table."` $condicion Limit 1";
		$result=mysql_query($selectSQL,$this->db_connection);
		$row = mysql_fetch_assoc($result);
		return $row; 	
	}
	function obtenerDato($parametro,$condicion=NULL){
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $parametro AS Dato FROM `".$this->table."` $condicion  Limit 1";
		$result=mysql_query($selectSQL,$this->db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Dato'];
	}
	function math($operador,$condicion=NULL){
		// SUM, COUNT, AVG, etc
		if($condicion==NULL)
			$condicion="";
		else 
		$condicion=" WHERE ".$condicion;
		$selectSQL="SELECT $operador(*) AS Result FROM `".$this->table."` $condicion";
		$result=mysql_query($selectSQL,$this->db_connection);
		$row= mysql_fetch_assoc($result);
		return $row['Result'];
	}
}

?>