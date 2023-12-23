<?php
/**************************************
 * 
 * USAGE: This file is used to show 
 *        Activities Per User
 *       
 * DATE: Monday July 25, 2023.
 * 
 *************************************/
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$offset = null;
$num_pages = null;
$total_products = null;
$activities_per_page = 10;
$current_page = $UserActivity->script_name();
$activities = null;
$totalActivities = $AdminiAccountPull->get_total_activities($_SESSION["aSessn"]["aSeck"]);
$Utility->int_get_param("page",$NameSanitizer,"home");
if(is_array($totalActivities[0]) && ($totalActivities[0]["total"]>=1)){
    $total_products = $totalActivities[0]["total"];
    $num_pages = ceil(($total_products/$activities_per_page));
    isset($_GET['page']) ? $page=$_GET['page']:$page=1;
    $offset = ($page-1)*$activities_per_page;
    if($offset <1) $offset = 0;
    if($page <1) $page = 1;
    $activities = $AdminiAccountPull->get_activities($_SESSION["aSessn"]["aSeck"],$offset,$activities_per_page);
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Activities');?>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side();?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <h5>Your Activities</h5>
                            <hr>
                            <?php $AdminiUXTemplate->vw_activities($activities);?>
                            <?php $AdminiUXTemplate->pagination($num_pages,$page,$current_page);?>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
</body>
</html>

 

