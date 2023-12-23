<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$offset = null;
$num_pages = null;
$page = null;
$productsContainer = null;
$products_per_page = 6;
$current_page = $UserActivity->script_name();
$collection_cat = 2;
$adr_key = $_SESSION["aSessn"]["aSeck"];
$Utility->int_get_param("page",$NameSanitizer,"home");
$totalProducts = $ProductPull->get_total_projects_o($adr_key);;
$total_products = 0;
if(is_array($totalProducts[0]) && ($totalProducts[0]["total_projects"]>=1)){
    $total_products = $totalProducts[0]["total_projects"];
    $num_pages = ceil(($total_products/$products_per_page));
    isset($_GET['page']) ? $page=$_GET['page']:$page=1;
    $offset = ($page-1)*$products_per_page;
    if($offset <1) $offset = 0;
    if($page <1) $page = 1;
    $productsContainer = $ProductPull->get_projects_discussed($offset,$products_per_page,$_SESSION["aSessn"]["aSeck"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Projects Created');?>
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
                            <h5>Projects To Discuss(<?php echo $total_products;?>)</h5>
                            <hr>
                            <br>
                                <?php $UserErrorsPool->error("fs_del_failed","Project Files Delete Failed");?>
                                <?php $UserErrorsPool->error("docs_del_failed","Project Documents Delete Failed");?>
                                <?php $UserErrorsPool->error("pcs_del_failed","Project Pictures Delete Failed");?>
                                <?php $UserErrorsPool->error("pgrss_del_failed","Project Progress Records Delete Failed");?>
                                <?php $UserErrorsPool->error("dscss_del_failed","Project Discussions Delete Failed");?>
                                <?php $UserErrorsPool->error("invite_del_failed","Project Invitations Delete Failed");?>
                                <?php $UserErrorsPool->error("share_del_failed","Project Sharing Delete Failed");?>
                                <?php $UserErrorsPool->error("pj_del_failed","Project Data Delete Failed");?>
                                <?php $UserErrorsPool->error_s("success","Project Delete Successful");?>
                            <br>
                            <div class="advertised-wrap">
                                <div class="col-12">
                                    <div class="row advertised-row">
                                        <?php $AdminiUXTemplate->vw_project_card($productsContainer);?>
                                    </div>
                                </div>
                            </div>
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

