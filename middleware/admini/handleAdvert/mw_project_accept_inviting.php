<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$o = [];
$o['inv_id'] = $_GET["inv"];
$params = "../../../dashboards/administrator/inviting?sync";

if($ProductDelete->invite($o))
    header("location:".$params."&&denied");
else 
    header("location:".$params."&&deny_failed");
?>