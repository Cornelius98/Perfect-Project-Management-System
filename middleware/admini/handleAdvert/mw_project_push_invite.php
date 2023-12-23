<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = [
    "success" =>[
        "status" =>0
    ]
];

$o = [];
$o["rand_id"] = uniqid().substr(random_int(1,PHP_INT_MAX),0,3);
$o["store_url"] = "./store/";
$o['d'] = date("d");
$o['m'] = date("m");
$o['y'] = date("Y");
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

$inviteesStr = $_POST["invitee"][0];
$inviteesArr = explode(",",$inviteesStr);
$inviteesArrSize = sizeof($inviteesArr);
$o['checkedCount'] = $_POST["checkedCount"];
$status_key = 0;
$i = 1;
$counter = 0;
$valid_invitees = 0;
$invitations = $ProductPull->get_invites_by_project($o['pj_id']);
for($i;$i<=$o['checkedCount'];$i++){
    if($inviteesArr[$i]!=0){
        if(is_array($invitations) && sizeof($invitations)>0){
            $o_invited = array_column($invitations,"recipient_id");
            foreach($invitations As $invite){ //skip invite, if same invite was made before
                if($invite["pj_id"]==$o['pj_id'] &&      
                    $invite["sender_id"]==$o["s_seck"] && 
                    in_array($inviteesArr[$i],$o_invited) 
                    && ($invite["status"]==1 || $invite["status"]==0))
                    continue;
                else {
                    $ProductPush->invite($o['pj_id'],$o["s_seck"],$inviteesArr[$i],$status_key);
                    $counter+=1;
                    $valid_invitees+=1;
                }
            }
        }else {
            $ProductPush->invite($o['pj_id'],$o["s_seck"],$inviteesArr[$i],$status_key);
            $counter+=1;
            $valid_invitees+=1;
            $invitations = $ProductPull->get_invites_by_project($o['pj_id']);
            if(is_array($invitations) && sizeof($invitations)>0){
                $o_invited = array_column($invitations,"recipient_id");
                foreach($invitations As $invite){ //skip invite, if same invite was made before
                    if($invite["pj_id"]==$o['pj_id'] &&      
                        $invite["sender_id"]==$o["s_seck"] && 
                        in_array($inviteesArr[$i],$o_invited) 
                        && ($invite["status"]==1 || $invite["status"]==0))
                        continue;
                    else {
                        $ProductPush->invite($o['pj_id'],$o["s_seck"],$inviteesArr[$i],$status_key);
                        $counter+=1;
                        $valid_invitees+=1;
                    }
                }
            }else{
                $ProductPush->invite($o['pj_id'],$o["s_seck"],$inviteesArr[$i],$status_key);
                $counter+=1;
                $valid_invitees+=1;
            }
        }
    }else continue;
}
if($counter == ($valid_invitees)){
    $response["success"]["status"] = 200;
}else  $response["success"]["status"] = 404;
echo json_encode($response["success"]);
?>