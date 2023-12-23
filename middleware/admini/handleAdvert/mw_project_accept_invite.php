<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$o = [];
$o['inv_id'] = $_GET["inv"];
$params = "../../../dashboards/administrator/invited?sync";

if($_GET["status"]==1){
    $o["status"] = 1;
    if($ProductUpdate->accept_invite($o))
        header("location:".$params."&&invite_accepted");
    else header("location:".$params."&&invite_accept_failed");
}else {
    if($ProductDelete->invite($o))
        header("location:".$params."&&denied");
    else header("location:".$params."&&deny_failed");
}
?>