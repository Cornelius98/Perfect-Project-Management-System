<?php
/**************************************
 * 
 * USAGE: This file is used to share
 *        project, with others.
 *       
 * DATE: Friday July 21,2023
 *       
 *************************************/
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
$pjr_id = null;
$projectContainer = null;
if(isset($_GET["pipe"]) && !empty($_GET["pipe"])){
    if($int = $NameSanitizer->is_whole_int($_GET["pipe"])){
        if($UserAccountPull->advertiser_exist($_GET["pipe"])){
            $adrSeck = $int;
            $o = $AdminiAccountPull->get_mirror_account_route_o($adrSeck);
            if(!is_array($o) || empty($o) || empty($o["adr_id"]))
                header("location:err_mirror_credentials");
            else {
                $params = 'pipe='.$_GET["pipe"].'&&pjr='.$_GET["pjr"];
            }

            if(isset($_GET["pjr"]) && !empty($_GET["pjr"])){
                if($pjr = $NameSanitizer->is_whole_int($_GET["pjr"])){
                    $pjr_id = $pjr;
                    $projectContainer = $ProductPull->get_project($pjr_id);
                    $o_advertisers = $ProductPull->get_share_categories($pjr_id);
                    if(is_array($projectContainer) && !empty($projectContainer)){
                        $pjr_id = $pjr;
                    }else header("location:home?err_pjr_empty");
                }else  header("location:home?err_pjr_int");
            }else header("location:home?err_pjr");
        }else header("location:home?err_uthread_unexist");
    }else header("location:home?err_uthread_nn");
}else header("location:home?err_pipe");
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Share Project');?>
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
                            <div>
                                <h5>Share Project</h5><hr>
                            </div>
                            <div class="form-wrap">
                                <br>
                                <div class="error-display"></div>
                                <br>
                                <form class="invitation_form">
                                    <input type="hidden" id="pjr" name="pjr" value="<?php echo $projectContainer["pj_id"];?>">
                                    <div class="ads-section">
                                        <div class="ads-desc" id="personal">
                                            <div class="select-split">
                                                <span>Platform</span>
                                                <span></span>
                                            </div>
                                            <br>
                                            <table>
                                                <thead>
                                                    <th>
                                                        <tr></tr>
                                                        <tr></tr>
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <?php $AdminiUXTemplate->vw_sharing_platforms($o_advertisers,$pjr_id);?>
                                                </tbody>
                                            </table>
                                            <br>
                                           
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        function unicastPlatformShare(adr_key,sh_key,pick_key){
            let formData = new FormData(),
                    hashPjr = ($("#pjr").val()!="")?$("#pjr").val():0;
                    formData.append("adr_key",adr_key);
                    formData.append("sh_key",sh_key);
                    formData.append("pick_key",pick_key);
            $.ajax({
                type: 'POST',
                url: '../../middleware/admini/handleAdvert/mw_project_share',
                processData: false,
                contentType: false,
                async: true,
                data:formData
            });
        }
    </script>
</body>
</html>

 

