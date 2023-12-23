<?php 
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();

if(isset($_SESSION['aSessn']['aSeck']) && !empty($_SESSION['aSessn']['aSeck'])){
    $UserAccountPush->loggouts_unicast($_SESSION['aSessn']['aSessnLoggsSeck'],1,$_SESSION['aSessn']['aSeck'],session_id());
    if($AdminiSessionPush->end_targetted_session())
        header('Location:../../index');
    else 
        header('Location:../../index');
}else header('Location:../../index');
?>