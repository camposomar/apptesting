<? 
			$hostname_db_connection = "localhost";
			$database_db_connection = "sitepage";
			$username_db_connection = "root";
			$password_db_connection = "root";	
		/*		
		
				$hostname_db_connection = "66.7.210.122";
			$database_db_connection = "exveinet_sitepage";
			$username_db_connection = "exveinet_admin";
			$password_db_connection = "5oriachz";
						
			$hostname_db_connection = "localhost";
			$database_db_connection = "sitepage";
			$username_db_connection = "root";
			$password_db_connection = "";
	
		*/		
		
		
		// AGREGADO POR ARTURO LEON 14/02/2012
			// Necesitamos las constantes para conectar a autobahn
			if (!defined('MYSQL_HOST')) {
			define(MYSQL_HOST,$hostname_db_connection);
			define(MYSQL_USER,$username_db_connection);
			define(MYSQL_PASSWORD,$password_db_connection);
			define(MYSQL_DATABASE,$database_db_connection);
			}
		// FIN AGREGADO POR ARTURO LEON
		
		
		$db_connection = mysql_pconnect($hostname_db_connection, $username_db_connection, $password_db_connection) or trigger_error(mysql_error(),E_USER_ERROR);
		mysql_select_db($database_db_connection, $db_connection);
	
?>