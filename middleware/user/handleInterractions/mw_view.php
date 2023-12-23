<?php
session_start();
header('Content-Type:application/json');
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = [
    'isset'=>0,
    'empty'=>0,
    'success'=>[
        "status"=>0,
        "v_views"=>0
    ]
];
if(!isset($_POST['vview'])){
    $response['isset']= 404;
    if(!empty($_POST['vview'])){
        $response['empty'] = 404;
    }else 
        $response['empty'] = 1;

}else {
    $response['isset']= 1;
}
if($ProductPush->view($_POST['vview'])){
    $response["success"]["status"] = 200;
    $o = $ProductPull->get_vehicle_views($_POST['vview']);
    if(is_array($o) && !empty($o))
        $response["success"]["v_views"] = $Utility->flatten_number($o["v_views"]);
    else 
        $response["success"]["v_views"] = 0;

}else $response["success"]["status"] = 404; 
echo json_encode($response["success"]);
?>