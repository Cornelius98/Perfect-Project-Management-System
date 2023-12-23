<?php
/**************************************
 * 
 * USAGE: This file is used to show
 *        invitations received.
 *       
 * DATE: Sunday July 23, 2023.
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
$projectContainer = $ProductPull->invitation_received($_SESSION["aSessn"]["aSeck"],0);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Invitations');?>
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
                                <h5>You're Invited On These Projects</h5><hr>
                            </div>
                            <div>
                                <?php $UserErrorsPool->error_s("invite_accepted","Invitation Accepted");?>
                                <?php $UserErrorsPool->error("invite_accept_failed","Invitation Accept Operation Failed");?>
                                <?php $UserErrorsPool->error("denied","Invitation Denied");?>
                                <?php $UserErrorsPool->error("deny_failed","Invitation Deny Operation Failed");?>
                            </div>
                            <div class="form-wrap">
                                <br>
                                <div class="error-display"></div>
                                <br>
                                <form class="invitation_form">
                                    <div class="ads-section">
                                        <div class="ads-desc" id="personal">
                                            <div class="select-split">
                                                <span>Project Name</span>
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
                                                    <?php $AdminiUXTemplate->vw_invited($projectContainer);?>
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
</body>
</html>

 

