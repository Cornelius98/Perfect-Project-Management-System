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
    "updatedCode"=>0,
    "updatedPassword"=>0,
    "hashed"=>0,
    "code"=>0,
    "newCodeUnreplicated" =>0,
    "success" => [
        "status"=>0    
    ]
];
if(isset($_POST['data']['password']) && isset($_POST['data']['s_code']) && isset($_POST['data']['email'])){
    $response["isset"] = 200;
    if(!empty($_POST['data']['password']) && !empty($_POST['data']['s_code']) && !empty($_POST['data']['email'])) {
        $response["empty"] = 404;

        $email = $_POST['data']['email'];
        $psswrd = $_POST['data']['password'];
        $s_code =  $_POST['data']['s_code'];
        $hash_psswrd = password_hash($psswrd,PASSWORD_DEFAULT);
        if(is_string($hash_psswrd))
            $response["hashed"] = 200;
        else $response["hashed"] = 404;

        if($email = $RecognizeNumberEmailSanitize->solid_email_address($email)){
            $response["sanitized"] = 200;
            if($UserAccountPush->email_exist($email)){
                $response["exist"] = 404;
                if($UserAccountPush->update_password_by_email($hash_psswrd,$email)){
                    $response["updatedPassword"] = 200; 
                    $response["success"]["status"] = 200;
                }else {
                    $response["updatedPassword"] = 404; 
                    $response["success"]["status"] = 404;
                }
            } else $response["exist"] = 404;
        } else $response["sanitized"] = 404;

    }else $response["empty"] = 200;
}else $response["isset"] = 404;
   
echo json_encode($response["success"]);  
?>