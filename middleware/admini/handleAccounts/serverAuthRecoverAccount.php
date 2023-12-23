<?php 
header("Content-Type: application/json");
require_once ('../../../EXTERNAL_HEADER_FILES.php');
/****
 * 
 * 
 * USAGE: To login registered user into their account
 *         (1) Collect phone number and password
 *          (2) isset and non-empty checks,
 *              if not return to register && flagg missing value error
 *          (3) Validate and sanitize
 *          (5) Check if number has been registered
 *          (5) Check if password is correct
 *          (6) start login(usage) session
 *          (7) Register session in db
 *          (8) Save session variables
 *          (8) Redirect user to feed
 *          (8) Check uncompleted profile infor and aggressive reinforce completion
 *              
 ***/
$Response =[
    "unsetEmailAdress"=>1,
    "unsetPassword"=>1,
    "emptyPhoneNumber"=>1,
    "emptyPassword"=>1,
    "uunvalidEmail"=>1,
    "unexistEmail"=>1,
    "undispatchedEmail"=>1
];
!isset($_POST['data']['email'])? $Response['email'] =2:$Response['unsetEmailAddress'] =0;
empty($_POST['data']['email'])? $Response['emptyEmailAddress'] =2:$Response['emptyEmailAddress'] =0;

    $email = $_POST['data']['email'];
    $password = $_POST['data']['secretCode'];
    ($RecognizeNumberEmailSanitize->email_address($email))?$Response['unvalidEmail'] =0:$Response['unvalidEmail']=2;
    ($UserAccountPull->does_email_exist($email))?$Response['unexistEmail']=0:$Response['unexistEmail']=2;
    
    //dispatch recovery email
    if(sendAdministratorForgotEmail($email,$name)){
        $Response['undispatchedEmail']=2;
    }else{ $Response['undispatchedEmail']=2;}
    echo json_encode($Response);
  ?>