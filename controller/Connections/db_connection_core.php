<? 
			$hostname_db_connection = "72.29.91.3";
			$database_db_connection = "dna_test";
			$username_db_connection = "corpvps_hdmx";
			$password_db_connection = "C4Zp2tnFEfzW77xe";	
			
			if (!defined('MYSQL_HOST_CORE')) {
				define(MYSQL_HOST_CORE,$hostname_db_connection);
				define(MYSQL_USER_CORE,$username_db_connection);
				define(MYSQL_PASSWORD_CORE,$password_db_connection);
				define(MYSQL_DATABASE_CORE,$database_db_connection);
			}	
		
		$db_connection = mysql_pconnect($hostname_db_connection, $username_db_connection, $password_db_connection) or trigger_error(mysql_error(),E_USER_ERROR);
		mysql_select_db($database_db_connection, $db_connection);
	
?>