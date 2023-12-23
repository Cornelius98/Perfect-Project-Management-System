<?php 
/**********************************************
 * 
 * USAGE: This file completely deletes a project.     
 * DATE: Friday July 21,2023     
 * 
 *********************************************/
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');

$o = [];
$o['pj_id'] = $_GET["pjr"];
$o["fs_url"] = "../../../store/";
$gallery_key= $_GET["gallery"];
$params = "../../../dashboards/administrator/projects?pipe=".$_SESSION["aSessn"]["aSeck"]."&&pjr=".$o['pj_id'];

if($ProductDelete->files_o($o["pj_id"])){
    $files = $ProductPull->get_files_o($o["pj_id"]);
    if(is_array($files) && !empty($files)){
        foreach($files As $file){
            unlink($o["fs_url"].$file["fs_name"]);
        }
    }
}else header("location:".$params."&&fs_del_failed");


if($ProductDelete->documents_o($o["pj_id"])){
    $docs = $ProductPull->get_documents_o($o["pj_id"]);
    if(is_array($docs) && !empty($docs)){
        foreach($docs As $doc){
            unlink($o["fs_url"].$doc["dc_name"]);
        }
    }
}else header("location:".$params."&&docs_del_failed");

if($ProductDelete->pictures_o($o["pj_id"])){
    $docs = $ProductPull->get_pictures_o($o["pj_id"]);
    if(is_array($docs) && !empty($docs)){
        foreach($docs As $doc){
            unlink($o["fs_url"].$doc["pc_name"]);
        }
    }
}else header("location:".$params."&&pcs_del_failed");

if(!$ProductDelete->progress_o($o["pj_id"])){
    header("location:".$params."&&pgrss_del_failed");
}

if(!$ProductDelete->discussion_o($o["pj_id"])){
    header("location:".$params."&&dscss_del_failed");
}

if(!$ProductDelete->invitation_o($o["pj_id"])){
    header("location:".$params."&&invite_del_failed");
}

if(!$ProductDelete->share_o($o["pj_id"])){
    header("location:".$params."&&share_del_failed");
}

if(!$ProductDelete->view_o($o["pj_id"])){
    header("location:".$params."&&view_del_failed");
}

if($ProductDelete->project($o["pj_id"]))
    header("location:".$params."&&success");
else 
    header("location:".$params."&&pj_del_failed"); 

?>