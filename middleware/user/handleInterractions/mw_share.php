<?php
session_start();
header('Content-Type:application/json');
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = array(
    'isset'=>0,
    'empty'=>0,
    'success'=>0,
);
if(!isset($_POST['seck'])){
    $response['isset']= 404;
    if(!empty($_POST['seck'])){
        $response['empty'] = 404;
    }else 
        $response['empty'] = 1;

}else {
    $response['isset']= 1;
}
if($ProductPush->share($_POST['seck'],$_POST['platform'],2,(isset($_SESSION["uSessn"]["uSeck"])?$_SESSION["uSessn"]["uSeck"]:0)))
    $response["success"] = 200;
else 
    $response["success"] = 404; 
echo json_encode($response);
?>