<?php 
header("Content-Type: application/json");
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$Response =[
    "threadSeck"=>0,
    "threadSecn"=>0,
    "isset"=>0,
    "empty"=>0,
    "mode"=>0
];


!isset($_POST['isset'])? $Response['isset'] =1:$Response['isset'] =404;
!isset($_POST['empty'])? $Response['empty'] =1:$Response['empty'] =404;
empty($_POST['data']['phoneNumber'])? $Response['emptyPhoneNumber'] =2:$Response['emptyPhoneNumber'] =0;
empty($_POST['data']['secretCode'])? $Response['emptyPassword'] =2:$Response['emptyPassword'] =0;
!isset($_POST['threadSeck'])? $Response['threadSeck'] =1:$Response['threadSeck'] =404;

$Response["mode"] = 200;
echo json_encode($Response["mode"]);
?>