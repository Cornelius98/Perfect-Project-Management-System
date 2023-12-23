<?php 
session_start();
require_once ('../../../EXTERNAL_HEADER_FILES.php');

$o = [];
$o['pj_id'] = $_GET["pjr"];
$o["fs_name"] = $_GET["fs_name"];
$o["fs_id"] = $_GET["fs_id"];
$o["fs_url"] = "../../../store/";
$gallery_key= $_GET["gallery"];
$params = "../../../dashboards/administrator/gallery?pipe=".$_SESSION["aSessn"]["aSeck"]."&&pjr=".$o['pj_id']."&&gallery=".$gallery_key;
switch($gallery_key){
    case 1:
        if($ProductDelete->picture($o["fs_id"])){
            if($ProductDelete->fs_unlink($o["fs_url"],$o["fs_name"]))
                header("location:".$params."&&success");
            else 
                header("location:".$params."&&fs_failed"); 
        }else header("location:".$params."&&pj_failed"); 
        break;
    case 2: 
        if($ProductDelete->document($o["fs_id"])){
            if($ProductDelete->fs_unlink($o["fs_url"],$o["fs_name"]))
                header("location:".$params."&&success");
            else 
                header("location:".$params."&&fs_failed"); 
        }else header("location:".$params."&&pj_failed"); 
        break;
    case 3:
        if($ProductDelete->file($o["fs_id"])){
            if($ProductDelete->fs_unlink($o["fs_url"],$o["fs_name"]))
                header("location:".$params."&&success");
            else header("location:".$params."&&fs_failed"); 
        }else header("location:".$params."&&pj_failed");
        break;
    default:
        header("location:".$params."&&pj_failed");
}
?>