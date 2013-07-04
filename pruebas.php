<pre><?
/*
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once("controller/Connections/db_connection_page.php");
include_once("controller/Connections/db_connection_core.php");
require_once('lib/autobahn.php');

$queryCore = Autobahn::getConnection('coretest');
$queryCore->updateDnaClients(array('client_nonce' => 'OK =)'),array('client_id' => '58'));
print_r($queryCore->findAll('dna_clients',array('conditions' => array('client_id' => '58'))));
echo print_r($queryCore->showLogs());
*/
?></pre>