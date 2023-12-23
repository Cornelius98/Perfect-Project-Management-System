<?php
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = [
    "isset"=>0,
    "empty"=>0,
    "exist"=>0,
    "updated"=>0,
    "otp"=>0,
    "success" => [
        "status"=>0,
        "message"=>0
    ]
];
$params = "location:../../../auth_email?s_email=".$_GET["s_email"]."&&s_code=".$_GET["s_code"];
if(isset($_POST["password"]) && isset($_POST["email"])){
    if(!empty($_POST["password"]) && !empty($_POST["email"])){
        if($AdminiAccountPull->does_email_exist($_POST["email"])){
            if($AdminiAccountPull->get_with_code_II($_POST["password"])){
                $code = $NameSanitizer->uniq_code();
                if($AdminiAccountPush->add_email_verify_code(1,$code,$_POST["email"])){
                    header($params."&&success");
                }else header($params."&&failed");
            }else header($params."&&otp_fetch_fail");
        }else  header($params."&&email_unexist");
    }else header($params."&&empty");
}else header($params."&&unset");
?>