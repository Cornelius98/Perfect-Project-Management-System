<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
if(empty($_SESSION["ACCOUNTS"]["create"]["fname"]) || 
    empty($_SESSION["ACCOUNTS"]["create"]["sname"]) ||
    empty($_SESSION["ACCOUNTS"]["create"]["phone"]) || 
    empty($_SESSION["ACCOUNTS"]["create"]["email"]) || 
    empty($_SESSION["ACCOUNTS"]["create"]["path"]))
{
    header("Location:../../../bimble?corrupServerAuth");
}else{
    $_SESSION["ACCOUNTS"]["create"]["rand"] = 'gw'.uniqid();
    $_SESSION["ACCOUNTS"]["create"]["code"] = $NameSanitizer->uniq_code();
    $_SESSION["ACCOUNTS"]["create"]["source_app"] = 1;
    $_SESSION["ACCOUNTS"]["create"]["client_category"] = 2;
    $_SESSION["ACCOUNTS"]["create"]["d"] = date('d'); 
    $_SESSION["ACCOUNTS"]["create"]["m"] = date('m'); 
    $_SESSION["ACCOUNTS"]["create"]["y"] = date('Y'); 
    if($UserAccountPush->add_advertiser($_SESSION["ACCOUNTS"]["create"]))
        echo ("Location:../../../bimble?success");
    else 
        echo ("Location:../../../bimble?failed"); 
}
?>