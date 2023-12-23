<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');

$o = [];
$o['pj_id'] = $_GET["pjr"];
$o["mute"] = null;
$params = "../../../dashboards/administrator/projects?pipe=".$_SESSION["aSessn"]["aSeck"]."&&pjr=".$o['pj_id'];

if($_GET["mute"]==0){
    $o["mute"] = 0;
    if($ProductUpdate->close($o))
        header("location:".$params."&&unmute");
    else header("location:".$params."&&unmute_oops_fail");
}else {
    $o["mute"] = 1;
    if($ProductUpdate->close($o))
        header("location:".$params."&&mute");
    else header("location:".$params."&&mute_oops_fail");
}
?>