<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = [
    "set" =>[ 
        "isPicturesSet"=>0,
        "isDocumentsSet"=>0,
        "isFilesaSet"=>0
    ],
    "void" =>[ 
        "isPicturesEmpty"=>0,
        "isDocumentsEmpty"=>0,
        "isFilesaEmpty"=>0 
    ],
    "pushedToServer" =>[
        "isDetailsPushed"=>0,
        "isPicturesPushed"=>0,
        "isDocumentsPushed"=>0,
        "isFilesPushed"=>0,
    ],
    "success" =>[
        "status" =>0
    ]
];

$o = [];
$o["store_url"] = "./store/";
$o['d'] = date("d");
$o['m'] = date("m");
$o['y'] = date("Y");
$o['pj_id'] = $_POST["hashPjr"];

/********************************
*
* Verify the administrator Uploading
* Verify loggedIn
*   
*********************************/
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



/********************************
*
* Project Details Update And 
* File Upload Handling
*   
*********************************/

if(is_array($_FILES["pictures"]["type"]) && count($_FILES["pictures"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"pictures","PICTURES",1,$o,$ProductPush))
        $response["pushedToServer"]["isPicturesPushed"] = 200;
    else $response["pushedToServer"]["isPicturesPushed"] = 404;
}else $response["pushedToServer"]["isPicturesPushed"] = 202;

if(is_array($_FILES["documents"]["type"]) && count($_FILES["documents"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"documents","DOCUMENTS",2,$o,$ProductPush))
        $response["pushedToServer"]["isDocumentsPushed"] = 200;
    else $response["pushedToServer"]["isDocumentsPushed"] = 404;
}else $response["pushedToServer"]["isDocumentsPushed"] = 202;

if(is_array($_FILES["filesa"]["type"]) && count($_FILES["filesa"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"filesa","PMFILE",3,$o,$ProductPush))
        $response["pushedToServer"]["isFilesPushed"] = 200;
    else $response["pushedToServer"]["isFilesPushed"] = 404;
}else $response["pushedToServer"]["isFilesPushed"] = 202;


if(($response["pushedToServer"]["isPicturesPushed"] ==200 || $response["pushedToServer"]["isPicturesPushed"] == 202)&&
    ($response["pushedToServer"]["isDocumentsPushed"] ==200 || $response["pushedToServer"]["isDocumentsPushed"] == 202)&&
    ($response["pushedToServer"]["isFilesPushed"] ==200 || $response["pushedToServer"]["isFilesPushed"] == 202)
)$response["success"]["status"] = 200;
else $response["success"]["status"] = 404;
echo json_encode($response["success"]);
?>