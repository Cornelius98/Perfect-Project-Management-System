<?php 
session_start();
header('Content-Type:application/json');
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response =[
    "data"=>[
        "fname"=>0,
        "sname"=>0,
        "aka"=>0,
        "phone"=>0,
        "email"=>0,
        "path"=>0,
        "district"=>0,
        "state"=>0,
        "country"=>0
    ],
    "errors"=>[
        "validFname"=>0,
        "validSname"=>0,
        "validAka"=>0,
        "validAka"=> 0,
        "validPhone"=> 0,
        "validEmail"=> 0,
        "validSecretCode"=> 0,
        "validArea"=> 0,
        "sentEmail"=> 0
    ],
    "success"=>[
        "status"=>0
    ]
];

$response["data"]["rand"] = uniqid();
$response["data"]["code"] = $NameSanitizer->uniq_code();
$response["data"]["source_app"] = 1;
$response["data"]["client_category"] = 1;
$response["data"]["d"] = date("d");
$response["data"]["m"] = date("m");
$response["data"]["y"] = date("Y");
if(!empty($_POST['data']['fname'])){
    if($response["data"]["fname"]=$NameSanitizer->name($_POST['data']['fname'])){
        $response["errors"]["validFname"] = 200;
    }else 
        $response["errors"]["validFname"] = 404;
}else 
    $response["errors"]["validFname"] = 503;

if(!empty($_POST['data']['sname'])){
    if($response["data"]["sname"]=$NameSanitizer->name($_POST['data']['sname'])){
        $response["errors"]["validSname"] = 200;
    }else 
        $response["errors"]["validSname"] = 404;
}else 
    $response["errors"]["validSname"] = 503;


if(!empty($_POST['data']['aka'])){
    if($response["data"]["aka"]=$NameSanitizer->name($_POST['data']['aka'])){
        $response["errors"]["validAka"] = 200;
    }else $response["errors"]["validAka"] = 404;
}else {
    $response["data"]["aka"] = 0;
    $response["errors"]["validAka"] = 200;
}

if(!empty($_POST['data']['phone'])){
    if($response["data"]["phone"]=$RecognizeNumberEmailSanitize->solid_mobile_number($_POST['data']['phone'])){
        $response["errors"]["validPhone"] = 200;
    }else 
        $response["errors"]["validPhone"] = 404;
}else 
    $response["errors"]["validPhone"] = 503;


if(!empty($_POST['data']['email'])){
    if($response["data"]["email"]=$RecognizeNumberEmailSanitize->solid_email_address($_POST['data']['email'])){
        $response["errors"]["validEmail"] = 200;
    }else 
        $response["errors"]["validEmail"] = 404;
}else 
    $response["errors"]["validEmail"] = 503;


if(!empty($_POST['data']['secretCode'])){
    $response["data"]["path"] = password_hash($_POST['data']['secretCode'],PASSWORD_DEFAULT);
    if(!empty($response["data"]["path"]))
        $response["errors"]["validSecretCode"] = 200;
    else 
        $response["errors"]["validSecretCode"] = 404;
}else {
    $response["errors"]["validSecretCode"] = 503;
}

if(!empty($_POST['data']['area'])){
    $arr = explode(",",$_POST['data']['area']);
    $response["data"]["district"] = $arr[0];
    $response["data"]["state"] = $arr[1];
    $response["data"]["country"] = $arr[2];
    if(!empty($response["data"]["district"]) && 
        !empty($response["data"]["state"]) &&
        !empty($response["data"]["country"])){
        $response["errors"]["validArea"] = 200;
    }else 
        $response["errors"]["validArea"] = 404;
}else $response["errors"]["valiArea"] = 503;

if(sendUserEmailVerifyMailSecond($response["data"]["email"],$response["data"]["code"]))
    $response["errors"]["sentEmail"] = 200; 
else 
    $response["errors"]["sentEmail"] = 404; 

if(($response["errors"]["validFname"]==200) && ($response["errors"]["validSname"]==200) &&
   ($response["errors"]["validAka"]==200) && ($response["errors"]["validPhone"]==200) &&
   ($response["errors"]["validEmail"]==200) && ($response["errors"]["validSecretCode"]==200) &&
   ($response["errors"]["sentEmail"]==200))
{
    if($AdminiAccountPush->add_advertiser($response["data"]))
        $response["success"]["status"] = 200;
    else 
        $response["success"]["status"] = 500;
}else $response["status"] = 404;
echo json_encode($response["success"]);
?>