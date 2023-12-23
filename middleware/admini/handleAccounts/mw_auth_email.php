<?php
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$UserSessionPush->access_permission();
$UserActivity->register_users_activity();
header('Content-Type:application/json');
$response = [
    "isset"=>0,
    "empty"=>0,
    "exist"=>0,
    "updated"=>0,
    "sent"=>0,
    "success" => [
        "status"=>0,
        "message"=>0
    ]
];

if(isset($_POST["email"]) && isset($_SESSION["uSessn"]["uEmail"])){
    $response["isset"] = 200;
    if(!empty($_POST["email"]) && !empty($_SESSION["uSessn"]["uEmail"])){
        $response["empty"] = 200;
        if($UserAccountPush->email_exist($_SESSION["uSessn"]["uEmail"])){
            $response["exist"] = 200;
            $code = $NameSanitizer->uniq_code();
            if($UserAccountPush->add_email_verify_code($_SESSION["uSessn"]["uEmail"],$code)){
                $response["updated"] = 200; 
                if(sendUserEmailVerifyMail($_SESSION["uSessn"]["uEmail"],$code)){
                    $response["sent"] = 200; 
                }else {
                    $response["sent"] = 200; 
                }
            }else{
                $response["updated"] = 404; 
            }
        }else 
            $response["exist"] = 404;
    }else
        $response["empty"] = 404;
}else 
    $response["isset"] = 404;

if(($response["isset"]==200) && ($response["empty"]==200) && ($response["exist"]==200) && ($response["updated"]==200) && ($response["sent"]==200)){
    $response["success"]["status"] = 200;
    $response["success"]["message"] = "success";
}else{
    $response["success"]["status"] = 404;
    $response["success"]["message"] = "failed";
}
echo json_encode($response);
?>