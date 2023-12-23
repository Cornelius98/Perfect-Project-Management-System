<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$adrSeck = null;
$params = null;
$o = null;
$offset = null;
$num_pages = null;
$projectContainer = null;
$products_per_page = 6;
$current_page = $UserActivity->script_name();
$totalProducts = 0;
$page = 0;
$gallery_type = null;
$pj_id = null;

if(isset($_GET["pipe"]) && !empty($_GET["pipe"])){
    if($int = $NameSanitizer->is_whole_int($_GET["pipe"])){
        if($UserAccountPull->advertiser_exist($_GET["pipe"])){
            $adrSeck = $int;
            $o = $AdminiAccountPull->get_mirror_account_route_o($adrSeck);
            if(!is_array($o) || empty($o) || empty($o["adr_id"]))
                header("location:err_mirror_credentials");
            else {
                $params = 'pipe='.$_GET["pipe"].'&&pjr='.$_GET["pjr"].'&&gallery='.$_GET["gallery"];
                $pj_id = $_GET["pjr"];
                
                if($gallery_type = $NameSanitizer->is_whole_int($_GET["gallery"])){
                    $totalProducts = $ProductPull->get_gallery_total($pj_id);
                    if(is_array($totalProducts[0]) && ($totalProducts[0]["total_gallery"]>=1)){
                        $total_products = $totalProducts[0]["total_gallery"];
                        $num_pages = ceil(($total_products/$products_per_page));
                        isset($_GET['page']) ? $page=$_GET['page']:$page=1;
                        $offset = ($page-1)*$products_per_page;
                        if($offset <1) $offset = 0;
                        if($page <1) $page = 1;
                            $projectContainer = $ProductPull->get_gallery_files($gallery_type,$pj_id,$offset,$products_per_page);
                        
                    }
                }else header("location:home?err_gallery_key");
            }
        }else header("location:home?err_uthread_unexist");
    }else header("location:home?err_uthread_nn");
}else header("location:home?err_uthread_unset");
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Project Gallery');?>
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
                            <h5>Project <?php echo $Utility->gallery_name($gallery_type); ?> Gallery (<?php echo is_array($projectContainer)?sizeof($projectContainer):0;?>)</h5>
                            <hr>
                            <div class="advertised-wrap">
                                <div class="col-12">
                                    <div class="row advertised-row">
                                        <?php $AdminiUXTemplate->vw_project_gallery($gallery_type,$projectContainer,$Utility,$params);?>
                                    </div>
                                </div>
                            </div>
                            <?php $AdminiUXTemplate->pagination_params_II($num_pages,$page,$current_page,$params);?>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        function deleteProjectFile(pj_id,f_name,galllery){
            alert();
        }
    </script>
</body>
</html>

 

