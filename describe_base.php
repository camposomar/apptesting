<? 
/*
include("controller/Connections/db_connection_core.php");
	$selectSQL="SHOW TABLES";
		$result=mysql_query($selectSQL,$db_connection);
		echo mysql_error();
		while($row = mysql_fetch_array($result)){
			print_r($row);
		}
?>
<h1>dna_domains_tld</h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>

<?
		$selectSQL="DESCRIBE `dna_domains` ";
		$result=mysql_query($selectSQL,$db_connection);
		while($descripcion = mysql_fetch_array($result)){
			//print_r($descripcion);
			echo "<td align='center'><b>$descripcion[0]</b><br /><small>$descripcion[1]</small</td>";
		}
?>
  </tr>
<h1>Datos de tabla</h1>
<?
		$selectSQL="Select * from `dna_domains`";
		$result=mysql_query($selectSQL,$db_connection);
		echo mysql_error();
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
			echo"<td>$row[tld_id]</td>";
			echo"<td>$row[tld]</td>";
			echo"<td>$row[company_id]</td>";
			echo"<td>$row[tld_price_new]</td>";
			echo"<td>$row[tld_price_renew]</td>";
			echo"<td>$row[tld_price_transfer]</td>";
			echo"<td>$row[minyears]</td>";
			echo"<td>$row[maxyears]</td>";
			echo"<td>$row[transferin]</td>";
			echo"<td>$row[preconfigure]</td>";
			echo"<td>$row[registrar]</td>";
			echo"<td>$row[tld_transfer_key]</td>";
			echo"</tr>";
		}
*/		
?>
</table>
<? /*
		
		// AGREGADO POR ARTURO LEON 14/02/2012
			// Código para conectar con autobahn
			include('controller/Connections/db_connection_page.php');
		// FIN AGREGADO POR ARTURO LEON
				session_start();
		
		$db_connection = mysql_pconnect($hostname_db_connection, $username_db_connection, $password_db_connection) or trigger_error(mysql_error(),E_USER_ERROR);
		mysql_select_db($database_db_connection, $db_connection);
		
		if($_GET['division'] && $_GET['campaign']){
			require('lib/autobahn.php');
			$query = Autobahn::getConnection('default');
			$client = $query->findTbPageClientByVisitKey($_SESSION['visit_key']);
			$client_id = $client['0']['tb_page_client']['client_id'];
			
			$query->insertTbPageSem(array('id' => null,'division' => $_GET['division'],'campaign' => $_GET['campaign'], 'campaigntype' => $_GET['campaigntype'], 'channel' => $_GET['channel'],'service' => $_GET['service'], 'client_id' => $client['0']['tb_page_client']['client_id']));
			
			echo $query->showLogs();
		}
		*/
?>
<?
/*
include("controller/Connections/db_connection_page.php");
include("controller/Connections/db_connection_core.php");
require('lib/autobahn.php');
$query = Autobahn::getConnection('core');
$client = $query->findAllDnaDomainsTld();
$selectivo = $query->findAllDnaDomainsTldByCompanyId('hostdime');
$salida = $query->findDnaDomainsTldByTld('com');
echo "<pre>";
echo print_r($selectivo);
echo "</pre>";
echo $query->showLogs();
*/
?>