<?php
require_once('functions.php');
session_start();
connect_db();

$page="pealeht";
if (isset($_GET['page']) && $_GET['page']!=""){
	$page=htmlspecialchars($_GET['page']);
}

include_once('views/head.html');
include_once('views/selgitus.html');

switch($page){
	case "login":
		logi();
	break;
	case "kuluread":
		kuva_kuluread();
	break;
	case "logout":
		logout();
	break;
	case "lisakulu":
		lisa_kulurida();
	break;
	case "lisaliike":
		lisa_kululiike();
	break;
	default:
		include_once('views/pealeht.html');
	break;
}

include_once('views/foot.html');

?>
