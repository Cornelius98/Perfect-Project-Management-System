<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = [
    "sanitized" =>[
        "isDiscussionSanitized" =>0
    ],
    "success" =>[
        "status" =>0,
        "discussions"=>0
    ]
];

$o = [];
$o['pj_id'] = $_POST["hashPjr"];
$o["uni_id"] = null;
if(isset($_SESSION["aSessn"]["aSeck"]) && !empty($_SESSION["aSessn"]["aSeck"]) && $NameSanitizer->code($_SESSION["aSessn"]["aSeck"])){
    $response["sanitized"]["isCreatorSanitized"]=200;
    $response["sanitized"]["isCreatorLoggedIn"]=200;
    $o["uni_id"] = $_SESSION["aSessn"]["aSeck"];
    $k = $AdminiAccountPull->get_mirror_account_route_o($o["uni_id"]);
    if(is_array($k)&&!empty($k)){
        $response["sanitized"]["isUserSanitized"]=200;
        $o["s_name"] = $k["fname"]." ".$k["sname"];
        $o["s_seck"] = $k["adr_id"];
        $o["s_code"] = $k["adr_code"];
        $o["s_mobile"] = $k["adr_mobile"];
        $o["s_email"] = $k["email"];
    }else $response["sanitized"]["isUserSanitized"]=404;

}else {
    $response["sanitized"]["isAdvertiserSanitized"]=404;
    $response["sanitized"]["isAdvertiserLoggedIn"]=404;
}

$o["discussion"] = null;
if($DescriptionSanitize->description($_POST["discussion"])){
    $o["discussion"] = $DescriptionSanitize->description($_POST["discussion"]);
    $response["sanitized"]["isDiscussionSanitized"]=200;
}else {
    $response["sanitized"]["isDiscussionSanitized"]=200;
    $o["discussion"] = "";
}

if($ProductPush->discussion($o['pj_id'],$o['uni_id'],$o['discussion'])){
    $response["success"]["status"] = 200;
    $discussions = $projectContainer = $ProductPull->discussion($o['pj_id']);
    if(is_array($discussions) && !empty($discussions))
        $response["success"]["discussions"] = $discussions;
    else
        $response["success"]["discussions"] = 0;
}else  $response["success"]["status"] = 404;
echo json_encode($response["success"]);
?>