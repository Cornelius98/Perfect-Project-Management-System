<?php 
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$current_user = $_SESSION["aSessn"]["aSeck"];
$notifications = $ProductPull->notifications($current_user);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Notifications');?>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side($notifications);?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-bell"></i>
                                            <span class="notice-slider">
                                                <?php echo $notifications["notifications"]; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Notifications</strong></h5>
                                        <p>Explore all project notifications.</p>
                                    </div>
                                    <footer class="tab-footer"></footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-bell"></i>
                                            <span class="notice-slider">
                                                <?php echo $notifications["invitationSent"]; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5>
                                            <strong>
                                                Sent <br>
                                                Invitations
                                            </strong>
                                        </h5>
                                        <p>Explore all your projects.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="inviting"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-bell"></i>
                                            <span class="notice-slider">
                                                <?php echo $notifications["invitationReceived"]; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Received <br>Invitations</strong></h5>
                                        <p>Explore all your projects.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="invited"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-bell"></i>
                                            <span class="notice-slider">
                                                <?php echo $notifications["discussions"]; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Discussions</strong></h5>
                                        <p>Look through your Discussions.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="discussed"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
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

