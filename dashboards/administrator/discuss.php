<?php
/**************************************
 * 
 * USAGE: This file is used to simulate 
 *        discussion room for project.
 *       
 * DATE: Wednesday July 19,2023
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
                    $o = $ProductPull->get_project($pjr_id);
                    $projectContainer = $ProductPull->discussion($pjr_id);
                    if(is_array($o) && !empty($o)){
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
    <?php $AdminiUXTemplate->headers('Discussion Room');?>
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
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section discussion-section">
                            <!-- <div class="discussion-header">
                                <h5>Discussion Room</h5>
                                <div class="type-alert" id="type-alert"></div>
                                <hr>
                            </div> -->
                            <div class="form-wrap">
                                <br>
                                <div class="error-display"></div>
                                <br>
                                <div class="discussion-room">
                                    <?php $AdminiUXTemplate->vw_discussion($projectContainer);?>
                                </div>
                            </div>
                            <div class="send-message-wrap shadow">
                                <form class="send-message-form">
                                    <div class="wrap-input-btn">
                                        <input type="hidden" id="pjr" name="pjr" value="<?php echo $o["pj_id"];?>">
                                        <input type="text" name="write-discuss" id="write-discuss" placeholder="Start typing ...." />
                                        <button type="button" id="send-discuss"><i class="fa fa-paper-plane"></i></button>
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
        let writeBox = document.getElementById('write-discuss');
        writeBox.onkeydown = function(e){
            $("#type-alert").text("Someone is typing .....");
        }
        writeBox.onkeyup = function(e){
            $("#type-alert").text("");
        }
        let vw = "";
        $("#send-discuss").click(function(evt){
            evt.preventDefault();
            let writeDiscuss = ($("#write-discuss").val()!="")?$("#write-discuss").val():"";
            let formData = new FormData(),
                hashPjr = ($("#pjr").val()!="")?$("#pjr").val():0;
                formData.append("discussion",writeDiscuss);
                formData.append("hashPjr",hashPjr);
                $.ajax({
                    type: 'POST',
                    url: '../../middleware/admini/handleAdvert/mw_project_push_discuss',
                    processData: false,
                    contentType: false,
                    async: true,
                    data:formData,
                    success:function(s,status,settings){
                        let q = JSON.parse(s);
                        scrollTo(0,0);
                        if(q["status"]==200){
                            window.location.reload();
                        }else $("#type-alert").html('<div class="e-notice">Operation Failed, Try Again</div>');
                    }
                });
        });
    </script>
</body>
</html>

 

