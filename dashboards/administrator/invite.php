<?php
/**************************************
 * 
 * USAGE: This file is used to send 
 *        invitations, invite other
 *        team members on the project.
 *       
 * DATE: Tuesday July 18,2023
 *       Wednesday July 19, 2023
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
                    $o_advertisers = $AdminiAccountPull->get_advertisers_o();
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
    <?php $AdminiUXTemplate->headers('Invite Team');?>
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
                                <h5>Choose Who To Invite</h5><hr>
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
                                                <span>Name</span>
                                                <span>Select</span>
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
                                                    <?php $AdminiUXTemplate->vw_invitees($o_advertisers);?>
                                                </tbody>
                                            </table>
                                            <br>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary btn-block invite-btn" id="migrateAdd">INVITE</button>
                                            </div>
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
            $("#migrateAdd").click(function(evt){
            evt.preventDefault();
            var checkboxes = document.getElementsByName('invitee[]');
            var invitees = [];
            var checkedCount = 0;
            for (var i=0,n=checkboxes.length;i<n;i++) {
                if (checkboxes[i].checked) {
                    invitees[i] = checkboxes[i].value;
                    checkedCount+=1;
                }else {
                    invitees[i] = 0;
                }
            }
            var inviteesCount = invitees.length;
            if(checkedCount>=1){
                let formData = new FormData(),
                    hashPjr = ($("#pjr").val()!="")?$("#pjr").val():0;
                    formData.append("checkedCount",checkedCount);
                    formData.append("hashPjr",hashPjr);
                    formData.append("invitee[]",invitees);
            
                    $.ajax({
                        type: 'POST',
                        url: '../../middleware/admini/handleAdvert/mw_project_push_invite',
                        processData: false,
                        contentType: false,
                        async: true,
                        data:formData,
                        beforeSend:function(){
                            $(".spin-wrap").css("display","flex");
                            $(".dash-full-wrapper").css("animation","waterWaveFade 2s infinite");
                        },
                        success:function(s,status,settings){
                            let q = JSON.parse(s);
                            scrollTo(0,0);
                            $(".invitation_form").hide(3000);
                            $(".spin-wrap").css("display","none");
                            $(".dash-full-wrapper").css("animation","none");
                            if(q["status"]==200){
                                $(".error-display").html('<div class="e-success">Invitations Successfully Sent</div>');
                            }else $(".error-display").html('<div class="e-notice">Operation Failed, Try Again</div>');
                        }
                    });
            }else $(".error-display").html('<div class="e-notice">Select Atleast One Invitee</div>');
        });
    </script>
</body>
</html>

 

