<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');
$response = [
    "set" =>[ 
        "isNameSet" =>0,
        "isTnameSet" =>0,
        "isDescSet" =>0,
        "isSummarySet" =>0,
        "isAimsSet" =>0,
        "isObjectivesSet" =>0,
        "isHypothesisSet" =>0,
        "isConclusionSet" =>0,
        "isSdateSet" =>0,
        "isMdateSet" =>0,
        "isCdateSet" =>0,
        "isDurationSet" =>0,
        "isDirectorSet" =>0,
        "isManagerSet" =>0,
        "isSupervisorSet" =>0,
        "isWforceSet" =>0,
        "isInputSet" =>0,
        "isYieldSet" =>0,
        "isLossSet" =>0,
        "isProfitSet" =>0,
        "isSprocedureSet" =>0,
        "isMprocedureSet" =>0,
        "isYprocedureSet" =>0,
        "isRprocedureSet"=>0,
        "isPicturesSet"=>0,
        "isDocumentsSet"=>0,
        "isFilesaSet"=>0
    ],
    "void" =>[ 
        "isNameEmpty" =>0,
        "isTnameEmpty" =>0,
        "isDescEmpty" =>0,
        "isSummaryEmpty" =>0,
        "isAimsEmpty" =>0,
        "isObjectivesEmpty" =>0,
        "isHypothesisEmpty" =>0,
        "isConclusionEmpty" =>0,
        "isSdateEmpty" =>0,
        "isMdateEmpty" =>0,
        "isCdateEmpty" =>0,
        "isDurationEmpty" =>0,
        "isDirectorEmpty" =>0,
        "isManagerEmpty" =>0,
        "isSupervisorEmpty" =>0,
        "isWforceEmpty" =>0,
        "isInputEmpty" =>0,
        "isYieldEmpty" =>0,
        "isLossEmpty" =>0,
        "isProfitEmpty" =>0,
        "isSprocedureEmpty" =>0,
        "isMprocedureEmpty" =>0,
        "isYprocedureEmpty" =>0,
        "isRprocedureEmpty"=>0,
        "isPicturesEmpty"=>0,
        "isDocumentsEmpty"=>0,
        "isFilesaEmpty"=>0 
    ],
    "sanitized" =>[
        "isNameSanitized" =>0,
        "isTnameSanitized" =>0,
        "isDescSanitized" =>0,
        "isSummarySanitized" =>0,
        "isAimsSanitized" =>0,
        "isObjectivesSanitized" =>0,
        "isHypothesisSanitized" =>0,
        "isConclusionSanitized" =>0,
        "isSdateSanitized" =>0,
        "isMdateSanitized" =>0,
        "isCdateSanitized" =>0,
        "isDurationSanitized" =>0,
        "isDirectorSanitized" =>0,
        "isManagerSanitized" =>0,
        "isSupervisorSanitized" =>0,
        "isWforceSanitized" =>0,
        "isInputSanitized" =>0,
        "isYieldSanitized" =>0,
        "isLossSanitized" =>0,
        "isProfitSanitized" =>0,
        "isSprocedureSanitized" =>0,
        "isMprocedureSanitized" =>0,
        "isYprocedureSanitized" =>0,
        "isRprocedureSanitized"=>0,
        "isCreatorSanitized"=>0,
        "isCreatorLoggedIn"=>0,
        "isUserSanitized"=>0
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
isset($_POST["aims"])?$response["set"]["isAimsSet"]=200:$response["set"]["isAimsSet"]=404;
isset($_POST["objectives"])?$response["set"]["isObjectivesSet"]=200:$response["set"]["isObjectivesSet"]=404;
isset($_POST["hypothesis"])?$response["set"]["isHypothesisSet"]=200:$response["set"]["isHypothesisSet"]=404;
isset($_POST["conclusion"])?$response["set"]["isConclusionSet"]=200:$response["set"]["isConclusionSet"]=404;
isset($_POST["sdate"])?$response["set"]["isSdateSet"]=200:$response["set"]["isSdateSet"]=404;
isset($_POST["mdate"])?$response["set"]["isMdateSet"]=200:$response["set"]["isMdateSet"]=404;
isset($_POST["cdate"])?$response["set"]["isCdateSet"]=200:$response["set"]["isCdateSet"]=404;
isset($_POST["duration"])?$response["set"]["isDurationSet"]=200:$response["set"]["isDurationSet"]=404;
isset($_POST["director"])?$response["set"]["isDirectorSet"]=200:$response["set"]["isDirectorSet"]=404;
isset($_POST["manager"])?$response["set"]["isManagerSet"]=200:$response["set"]["isManagerSet"]=404;
isset($_POST["supervisor"])?$response["set"]["isSupervisorSet"]=200:$response["set"]["isSupervisorSet"]=404;
isset($_POST["wforce"])?$response["set"]["isWforceSet"]=200:$response["set"]["isWforceSet"]=404;
isset($_POST["input"])?$response["set"]["isInputSet"]=200:$response["set"]["isInputSet"]=404;
isset($_POST["pyield"])?$response["set"]["isYieldSet"]=200:$response["set"]["isYieldSet"]=404;
isset($_POST["loss"])?$response["set"]["isLossSet"]=200:$response["set"]["isLossSet"]=404;
isset($_POST["profit"])?$response["set"]["isProfitSet"]=200:$response["set"]["isProfitSet"]=404;
isset($_POST["sprocedure"])?$response["set"]["isSprocedureSet"]=200:$response["set"]["isSprocedureSet"]=404;
isset($_POST["mprocedure"])?$response["set"]["isMprocedureSet"]=200:$response["set"]["isMprocedureSet"]=404;
isset($_POST["yprocedure"])?$response["set"]["isYprocedureSet"]=200:$response["set"]["isYprocedureSet"]=404;
isset($_POST["rprocedure"])?$response["set"]["isRprocedureSet"]=200:$response["set"]["isRprocedureSet"]=404;
isset($_FILES["pictures"])?$response["set"]["isPicturesSet"]=200:$response["set"]["isPicturesSet"]=404;
isset($_FILES["documents"])?$response["set"]["isDocumentsSet"]=200:$response["set"]["isDocumentsSet"]=404;
isset($_FILES["filesa"])?$response["set"]["isFilesaSet"]=200:$response["set"]["isFilesaSet"]=404;

!empty($_POST["name"])?$response["void"]["isNameEmpty"]=200:$response["void"]["isNameEmpty"]=404;
!empty($_POST["tname"])?$response["void"]["isTnameEmpty"]=200:$response["void"]["isTnameEmpty"]=404;
!empty($_POST["desc"])?$response["void"]["isDescEmpty"]=200:$response["void"]["isDescEmpty"]=404;
!empty($_POST["summary"])?$response["void"]["isSummaryEmpty"]=200:$response["void"]["isSummaryEmpty"]=404;
!empty($_POST["aims"])?$response["void"]["isAimsEmpty"]=200:$response["void"]["isAimsEmpty"]=404;
!empty($_POST["objectives"])?$response["void"]["isObjectivesEmpty"]=200:$response["void"]["isObjectivesEmpty"]=404;
!empty($_POST["hypothesis"])?$response["void"]["isHypothesisEmpty"]=200:$response["void"]["isHypothesisEmpty"]=404;
!empty($_POST["conclusion"])?$response["void"]["isConclusionEmpty"]=200:$response["void"]["isConclusionEmpty"]=404;
!empty($_POST["sdate"])?$response["void"]["isSdateEmpty"]=200:$response["void"]["isSdateEmpty"]=404;
!empty($_POST["mdate"])?$response["void"]["isMdateEmpty"]=200:$response["void"]["isMdateEmpty"]=404;
!empty($_POST["cdate"])?$response["void"]["isCdateEmpty"]=200:$response["void"]["isCdateEmpty"]=404;
!empty($_POST["duration"])?$response["void"]["isDurationEmpty"]=200:$response["void"]["isDurationEmpty"]=404;
!empty($_POST["director"])?$response["void"]["isDirectorEmpty"]=200:$response["void"]["isDirectorEmpty"]=404;
!empty($_POST["manager"])?$response["void"]["isManagerEmpty"]=200:$response["void"]["isManagerEmpty"]=404;
!empty($_POST["supervisor"])?$response["void"]["isSupervisorEmpty"]=200:$response["void"]["isSupervisorEmpty"]=404;
!empty($_POST["wforce"])?$response["void"]["isWforceEmpty"]=200:$response["void"]["isWforceEmpty"]=404;
!empty($_POST["input"])?$response["void"]["isInputEmpty"]=200:$response["void"]["isInputEmpty"]=404;
!empty($_POST["pyield"])?$response["void"]["isYieldEmpty"]=200:$response["void"]["isYieldEmpty"]=404;
!empty($_POST["loss"])?$response["void"]["isLossEmpty"]=200:$response["void"]["isLossEmpty"]=404;
!empty($_POST["profit"])?$response["void"]["isProfitEmpty"]=200:$response["void"]["isProfitEmpty"]=404;
!empty($_POST["sprocedure"])?$response["void"]["isSprocedureEmpty"]=200:$response["void"]["isSprocedureEmpty"]=404;
!empty($_POST["mprocedure"])?$response["void"]["isMprocedureEmpty"]=200:$response["void"]["isMprocedureEmpty"]=404;
!empty($_POST["yprocedure"])?$response["void"]["isYprocedureEmpty"]=200:$response["void"]["isYprocedureEmpty"]=404;
!empty($_POST["rprocedure"])?$response["void"]["isRprocedureEmpty"]=200:$response["void"]["isRprocedureEmpty"]=404;
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
    $o["name"] = "Unamed";
}

$o["desc"] = null;
if($DescriptionSanitize->description($_POST["desc"])){
    $o["desc"] = $DescriptionSanitize->description($_POST["desc"]);
    $response["sanitized"]["isDescSanitized"]=200;
}else $response["sanitized"]["isDescSanitized"]=404;

$o["summary"] = null;
if($DescriptionSanitize->description($_POST["summary"])){
    $o["summary"] = $DescriptionSanitize->description($_POST["summary"]);
    $response["sanitized"]["isSummarySanitized"]=200;
}else {
    $response["sanitized"]["isSummarySanitized"]=404;
    $o["desc"] = 0;
}

$o["aims"] = null;
if($DescriptionSanitize->description($_POST["aims"])){
    $o["aims"] = $DescriptionSanitize->description($_POST["aims"]);
    $response["sanitized"]["isAimsSanitized"]=200;
}else {
    $response["sanitized"]["isAimsSanitized"]=404;
    $o["aims"] = 0;
}

$o["objectives"] = null;
if($DescriptionSanitize->description($_POST["objectives"])){
    $o["objectives"] = $DescriptionSanitize->description($_POST["objectives"]);
    $response["sanitized"]["isObjectivesSanitized"]=200;
}else {
    $response["sanitized"]["isObjectivesSanitized"]=404;
    $o["objectives"] = 0;
}

$o["hypothesis"] = null;
if($DescriptionSanitize->description($_POST["hypothesis"])){
    $o["hypothesis"] = $DescriptionSanitize->description($_POST["hypothesis"]);
    $response["sanitized"]["isHypothesisSanitized"]=200;
}else {
    $response["sanitized"]["isHypothesisSanitized"]=404;
    $o["hypothesis"] = 0;
}

$o["conclusion"] = null;
if($DescriptionSanitize->description($_POST["conclusion"])){
    $o["conclusion"] = $DescriptionSanitize->description($_POST["conclusion"]);
    $response["sanitized"]["isConclusionSanitized"]=200;
}else {
    $response["sanitized"]["isConclusionSanitized"]=404;
    $o["conclusion"] = 0;
}

if(!empty($o["sdate"]))
    $o["sdate"] = $_POST["sdate"];
else $o["sdate"] = 0;

if(!empty($o["mdate"]))
    $o["mdate"] = $_POST["mdate"];
else $o["mdate"] = 0;

if(!empty($o["cdate"]))
    $o["cdate"] = $_POST["cdate"];
else $o["cdate"] = 0;

if(!empty($o["duration"]))
    $o["duration"] = $o["duration"];
else $o["duration"] = 0;

$o["director"] = null;
if($NameSanitizer->artist_name($_POST["director"])){
    $o["director"] = $NameSanitizer->artist_name($_POST["director"]);
    $response["sanitized"]["isDirectorSanitized"]=200;
}else {
    $response["sanitized"]["isDirectorSanitized"]=404;
    $o["director"] = 0;
}

$o["manager"] = null;
if($NameSanitizer->artist_name($_POST["manager"])){
    $o["manager"] = $NameSanitizer->artist_name($_POST["manager"]);
    $response["sanitized"]["isManagerSanitized"]=200;
}else {
    $response["sanitized"]["isManagerSanitized"]=404;
    $o["manager"] = 0;
}

$o["supervisor"] = null;
if($NameSanitizer->artist_name($_POST["supervisor"])){
    $o["supervisor"] = $NameSanitizer->artist_name($_POST["supervisor"]);
    $response["sanitized"]["isSupervisorSanitized"]=200;
}else {
    $response["sanitized"]["isSupervisorSanitized"]=404;
    $o["supervisor"] = 0;
}

$o["wforce"] = null;
if($NameSanitizer->artist_name($_POST["wforce"])){
    $o["wforce"] = $NameSanitizer->artist_name($_POST["wforce"]);
    $response["sanitized"]["isWforceSanitized"]=200;
}else {
    $response["sanitized"]["isWforceSanitized"]=404;
    $o["wforce"] = 0;
}

$o["input"] = null;
if($NameSanitizer->artist_name($_POST["input"])){
    $o["input"] = $NameSanitizer->artist_name($_POST["input"]);
    $response["sanitized"]["isInputSanitized"]=200;
}else {
    $response["sanitized"]["isInputSanitized"]=404;
    $o["input"] = 0;
}

$o["pyield"] = null;
if($NameSanitizer->artist_name($_POST["pyield"])){
    $o["pyield"] = $NameSanitizer->artist_name($_POST["pyield"]);
    $response["sanitized"]["isYieldSanitized"]=200;
}else {
    $response["sanitized"]["isYieldSanitized"]=404;
    $o["pyield"] = 0;
}

$o["loss"] = null;
if($NameSanitizer->artist_name($_POST["loss"])){
    $o["loss"] = $NameSanitizer->artist_name($_POST["loss"]);
    $response["sanitized"]["isLossSanitized"]=200;
}else {
    $response["sanitized"]["isLossSanitized"]=404;
    $o["loss"] = 0;
}

$o["profit"] = null;
if($NameSanitizer->artist_name($_POST["profit"])){
    $o["profit"] = $NameSanitizer->artist_name($_POST["profit"]);
    $response["sanitized"]["isProfitSanitized"]=200;
}else {
    $response["sanitized"]["isProfitSanitized"]=404;
    $o["profit"] = 0;
}

$o["sprocedure"] = null;
if($NameSanitizer->artist_name($_POST["sprocedure"])){
    $o["sprocedure"] = $NameSanitizer->artist_name($_POST["sprocedure"]);
    $response["sanitized"]["isSprocedureSanitized"]=200;
}else {
    $response["sanitized"]["isSprocedureSanitized"]=404;
    $o["sprocedure"] = 0;
}

$o["mprocedure"] = null;
if($NameSanitizer->artist_name($_POST["mprocedure"])){
    $o["mprocedure"] = $NameSanitizer->artist_name($_POST["mprocedure"]);
    $response["sanitized"]["isMprocedureSanitized"]=200;
}else {
    $response["sanitized"]["isMprocedureSanitized"]=404;
    $o["mprocedure"] = 0;
}

$o["yprocedure"] = null;
if($NameSanitizer->artist_name($_POST["yprocedure"])){
    $o["yprocedure"] = $NameSanitizer->artist_name($_POST["yprocedure"]);
    $response["sanitized"]["isYprocedureSanitized"]=200;
}else {
    $response["sanitized"]["isYprocedureSanitized"]=404;
    $o["yprocedure"] = 0;
}

$o["rprocedure"] = null;
if($NameSanitizer->artist_name($_POST["rprocedure"])){
    $o["rprocedure"] = $NameSanitizer->artist_name($_POST["rprocedure"]);
    $response["sanitized"]["isRprocedureSanitized"]=200;
}else {
    $response["sanitized"]["isRprocedureSanitized"]=404;
    $o["rprocedure"] = 0;
}

/********************************
*
* Project Details Update And 
* File Upload Handling
*   
*********************************/
if($ProductUpdate->project($o))
    $response["pushedToServer"]["isDetailsPushed"] = 200;
else $response["pushedToServer"]["isDetailsPushed"] = 404;

if(is_array($_FILES) && count($_FILES)>0 && is_array($_FILES["pictures"]["type"]) && count($_FILES["pictures"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"pictures","PICTURES",1,$o,$ProductPush))
        $response["pushedToServer"]["isPicturesPushed"] = 200;
    else $response["pushedToServer"]["isPicturesPushed"] = 404;
}else $response["pushedToServer"]["isPicturesPushed"] = 202;

if(is_array($_FILES) && count($_FILES)>0 && is_array($_FILES["documents"]["type"]) && count($_FILES["documents"]["type"])>0){
    $FileUploadHandler->updateUploadLocation("../../../store/");
    if($FileUploadHandler->filesPushRemote($_FILES,"documents","DOCUMENTS",2,$o,$ProductPush))
        $response["pushedToServer"]["isDocumentsPushed"] = 200;
    else $response["pushedToServer"]["isDocumentsPushed"] = 404;
}else $response["pushedToServer"]["isDocumentsPushed"] = 202;

if(is_array($_FILES) && count($_FILES)>0 && is_array($_FILES["filesa"]["type"]) && count($_FILES["filesa"]["type"])>0){
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