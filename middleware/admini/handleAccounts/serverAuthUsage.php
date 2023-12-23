<?php 
header("Content-Type: application/json");
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$Response =[
    "unsetPhoneNumber"=>1,
    "unsetPassword"=>1,
    "emptyPhoneNumber"=>1,
    "emptyPassword"=>1,
    "unvalidPhoneNumber"=>1,
    "unexistPhoneNumber"=>1,
    "unpassedPasswordCheck"=>1,
    "unfoundUser"=>1,
    "unsuccess"=>1
];
!isset($_POST['data']['phoneNumber'])? $Response['unsetPhoneNumber'] =2:$Response['unsetPhoneNumber'] =0;
!isset($_POST['data']['secretCode'])? $Response['unsetPassword'] =2:$Response['unsetPassword'] =0;
empty($_POST['data']['phoneNumber'])? $Response['emptyPhoneNumber'] =2:$Response['emptyPhoneNumber'] =0;
empty($_POST['data']['secretCode'])? $Response['emptyPassword'] =2:$Response['emptyPassword'] =0;

    $phoneNumber = $_POST['data']['phoneNumber'];
    $password = $_POST['data']['secretCode'];
    ($RecognizeNumberEmailSanitize->mobile_number($phoneNumber))?$Response['unvalidPhoneNumber'] =0:$Response['unvalidPhoneNumber']=2;
    ($UserAccountPull->does_phone_exist($phoneNumber))?$Response['unexistPhoneNumber']=0:$Response['unexistPhoneNumber']=2;
    
    if($o = $UserAccountPull->get_with_mobile($phoneNumber)){
        if(($o["cli_id"]==2)||($o["cli_id"]==1)){
            $Response['unfoundUser']=0;
            if(password_verify($password,$o['adr_password'])){
                $Response['unpassedPasswordCheck']=0;
                if($AdminiSessionPush->start_sessn($o))
                    $Response['unsuccess']=0;
                else $Response['unsuccess']=2;
            }else $Response['unpassedPasswordCheck']=2;
        }else{
            $Response['unfoundUser']=2;
            $Response['unpassedPasswordCheck']=2;
            $Response['unsuccess']=2;
        }
    }else $Response['unfoundUser']=2;
    echo json_encode($Response);
  ?>