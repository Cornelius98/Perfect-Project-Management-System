<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$errURL = "location:../../../dashboards/administrator/settings_password?";
if(isset($_POST['password']) &&isset($_POST['password_2'])){   
    if(!empty($_POST['password'])&&!empty($_POST['password_2'])){ 
        $o = [];     
        $password = $PasswordSanitize->password($_POST['password'])?$_POST['password']:header($errURL."error_password_format");
        $second_password = $PasswordSanitize->password($_POST['password_2'])?$_POST['password_2']:header($errURL."error_password_format");
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $o["password"] = $hashed_password;
        $o["cli_id"] = 2;
        $o["uni_id"] = $NameSanitizer->code($_SESSION["aSessn"]["aSeck"])?$_SESSION["aSessn"]["aSeck"]:header($errURL."error_adr");

        if(password_verify($second_password,$hashed_password)){  
            if($AdminiAccountPush->update_password($o))
                header($errURL.'success');
            else
                header($errURL.'failed');
        }else {header($errURL.'passwords_unmatched');};
    }else {header($errURL."empty_error");}
}else {header($errURL."isset_error");}
?>