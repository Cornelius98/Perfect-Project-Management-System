<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = [
    "set" =>[ 
        "isNameSet" =>0,
        "isTnameSet" =>0,
        "isDescSet" =>0,
        "isSummarySet" =>0,
        "isPicturesSet"=>0,
        "isDocumentsSet"=>0,
        "isFilesaSet"=>0
    ],
    "void" =>[ 
        "isNameEmpty" =>0,
        "isTnameEmpty" =>0,
        "isDescEmpty" =>0,
        "isSummaryEmpty" =>0,
        "isPicturesEmpty"=>0,
        "isDocumentsEmpty"=>0,
        "isFilesaEmpty"=>0 
    ],
    "sanitized" =>[
        "isNameSanitized" =>0,
        "isTnameSanitized" =>0,
        "isDescSanitized" =>0,
        "isSummarySanitized" =>0
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

isset($_POST["name"])?$response["set"]["isNameSet"]=200:$response["set"]["isNameSet"]=404;
isset($_POST["tname"])?$response["set"]["isTnameSet"]=200:$response["set"]["isTnameSet"]=404;
isset($_POST["desc"])?$response["set"]["isDescSet"]=200:$response["set"]["isDescSet"]=404;
isset($_POST["summary"])?$response["set"]["isSummarySet"]=200:$response["set"]["isSummarySet"]=404;
isset($_FILES["pictures"])?$response["set"]["isPicturesSet"]=200:$response["set"]["isPicturesSet"]=404;
isset($_FILES["documents"])?$response["set"]["isDocumentsSet"]=200:$response["set"]["isDocumentsSet"]=404;
isset($_FILES["filesa"])?$response["set"]["isFilesaSet"]=200:$response["set"]["isFilesaSet"]=404;

!empty($_POST["name"])?$response["void"]["isNameEmpty"]=200:$response["void"]["isNameEmpty"]=404;
!empty($_POST["tname"])?$response["void"]["isTnameEmpty"]=200:$response["void"]["isTnameEmpty"]=404;
!empty($_POST["desc"])?$response["void"]["isDescEmpty"]=200:$response["void"]["isDescEmpty"]=404;
!empty($_POST["summary"])?$response["void"]["isSummaryEmpty"]=200:$response["void"]["isSummaryEmpty"]=404;
!empty($_FILES["pictures"])?$response["void"]["isPicturesEmpty"]=200:$response["void"]["isPicturesEmpty"]=404;
!empty($_FILES["documents"])?$response["void"]["isDocumentsEmpty"]=200:$response["void"]["isDocumentsEmpty"]=404;
!empty($_FILES["filesa"])?$response["void"]["isFilesaEmpty"]=200:$response["void"]["isFilesaEmpty"]=404;

$o = [];
$o["rand_id"] = uniqid().substr(random_int(1,PHP_INT_MAX),0,3);
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
* Validation And
* Sanitization
*   
*********************************/
$o["name"] = null;
if($NameSanitizer->artist_name($_POST["name"])){
    $o["name"] = $NameSanitizer->artist_name($_POST["name"]);
    $response["sanitized"]["isNameSanitized"]=200;
}else {
    $response["sanitized"]["isNameSanitized"]=404;
    $o["name"] = "Unamed";
}

$o["tname"] = null;
if($NameSanitizer->artist_name($_POST["tname"])){
    $o["tname"] = $NameSanitizer->artist_name($_POST["tname"]);
    $response["sanitized"]["isTnameSanitized"]=200;
}else {
    $response["sanitized"]["isTnameSanitized"]=404;
    $o["tname"] = "Unamed";
}

$o["desc"] = null;
if($DescriptionSanitize->description($_POST["desc"])){
    $o["desc"] = $DescriptionSanitize->description($_POST["desc"]);
    $response["sanitized"]["isDescSanitized"]=200;
}else {
    $response["sanitized"]["isDescSanitized"]=404;
    $o["desc"] = "Unamed";
}

$o["summary"] = null;
if($DescriptionSanitize->description($_POST["summary"])){
    $o["summary"] = $DescriptionSanitize->description($_POST["summary"]);
    $response["sanitized"]["isSummarySanitized"]=200;
}else {
    $response["sanitized"]["isSummarySanitized"]=404;
    $o["summary"] = "Unamed";
}


/********************************
*
* Project Details Update And 
* File Upload Handling
*   
*********************************/
if($ProductPush->progress($o))
    $response["pushedToServer"]["isDetailsPushed"] = 200;
else $response["pushedToServer"]["isDetailsPushed"] = 404;

if(is_array($_FILES) && count($_FILES)>0 && is_array($_FILES["pictures"]) && is_array($_FILES["pictures"]["type"]) && count($_FILES["pictures"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"pictures","PICTURES",1,$o,$ProductPush))
        $response["pushedToServer"]["isPicturesPushed"] = 200;
    else $response["pushedToServer"]["isPicturesPushed"] = 404;
}else $response["pushedToServer"]["isPicturesPushed"] = 202;

if(is_array($_FILES) && count($_FILES)>0 && is_array($_FILES["documents"]) && count($_FILES)>0 && is_array($_FILES["documents"]["type"]) && count($_FILES["documents"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"documents","DOCUMENTS",2,$o,$ProductPush))
        $response["pushedToServer"]["isDocumentsPushed"] = 200;
    else $response["pushedToServer"]["isDocumentsPushed"] = 404;
}else $response["pushedToServer"]["isDocumentsPushed"] = 202;

if(is_array($_FILES) && count($_FILES)>0 && is_array($_FILES["filesa"]) && count($_FILES)>0 &&  is_array($_FILES["filesa"]["type"]) && count($_FILES["filesa"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"filesa","PMFILE",3,$o,$ProductPush))
        $response["pushedToServer"]["isFilesPushed"] = 200;
    else $response["pushedToServer"]["isFilesPushed"] = 404;
}else $response["pushedToServer"]["isFilesPushed"] = 202;


if($response["pushedToServer"]["isDetailsPushed"] == 200 &&
    ($response["pushedToServer"]["isPicturesPushed"] ==200 || $response["pushedToServer"]["isPicturesPushed"] == 202)&&
    ($response["pushedToServer"]["isDocumentsPushed"] ==200 || $response["pushedToServer"]["isDocumentsPushed"] == 202)
)$response["success"]["status"] = 200;
else $response["success"]["status"] = 404;
echo json_encode($response["success"]);
?>