<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$UserActivity->register_users_activity();
header('Content-Type:application/json');
$response = [
    "isset"=>0,
    "empty"=>0,
    "sanitized"=>0,
    "exist"=>0,
    "updated"=>0,
    "sent"=>0,
    "newCodeUnreplicated" =>0,
    "success" => [
        "status"=>0 
    ]
];

if(isset($_POST['data']['email'])){
    $response['isset'] = 200;
    if(!empty($_POST['data']['email'])){
        $response['empty'] = 404;
        if($email = $RecognizeNumberEmailSanitize->solid_email_address($_POST['data']['email'])){
            $response["sanitized"] = 200;
            if($UserAccountPush->email_exist($email)){
                $response["exist"] = 200;
                $code = $NameSanitizer->uniq_code();
                if(sendUserForgotEmailSecond($email,$code))
                    $response["success"]["status"] = 200;
                else $response["success"]["status"] = 404;
            } else {$response["exist"] = 404;}
        }else {$response["sanitized"] = 404;}
    }else{$response['empty'] = 200;}
}else {$response['isset'] = 404;}  

echo json_encode($response["success"]);  
?>