<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$userContainer = $AdminiAccountPull->get_advertiser($_SESSION["aSessn"]["aSeck"]);
$userContainer = $userContainer[0];
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Timeline');?>
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
                            <h4>Timeline</h4>
                            <hr>
                            <div class="error-display">
                                <?php $UserErrorsPool->error_s("sub_updated","Billing Details Update Successful")?>
                            </div>
                            <?php 
                                if(is_array($userContainer) && !empty($userContainer)){
                                    echo '<div class="ads-section">
                                                <div class="ads-desc" id="personal">
                                                    <h5>Personal Information</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Customer ID:</td>
                                                                <td  class="ads-prop-value">'
                                                                    .$userContainer["adr_code"].
                                                                '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Private Key:</td>
                                                                <td  class="ads-prop-value">'
                                                                    .$userContainer["rand_id"].
                                                                '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Name:</td>
                                                                <td  class="ads-prop-value">'
                                                                    .$userContainer["fname"]." ".$userContainer["sname"].
                                                                '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Other Name:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($userContainer["aka"]!=0)
                                                                        echo $userContainer["aka"];
                                                                    else 
                                                                        echo "<a href='name_change'>Add Alias Name</a>";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="contact">
                                                    <h5>Contact Information</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Mobile:</td>
                                                                <td  class="ads-prop-value">'.$userContainer["adr_mobile"].'</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Email:</td>
                                                                <td  class="ads-prop-value" style="text-transform:lowercase;">';
                                                                    if($userContainer["email"]!=0)
                                                                        echo $userContainer["email"];
                                                                    else 
                                                                        echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc">
                                                    <h5>Security Information</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Mobile Verification:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($userContainer["phone_vf"]!=0)
                                                                        echo "Verified";
                                                                    else 
                                                                        echo "<a href='phone_verify'>Verify</a>";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Email Verification:</td>
                                                                <td  class="ads-prop-value">'; 
                                                                    if($userContainer["email_vf"]!=0)
                                                                        echo "Verified";
                                                                    else 
                                                                        echo "<a href='email_verify'>Verify</a>";
                                                                echo '</td>
                                                            </tr>
                                                          
                                                            <tr>
                                                                <td  class="ads-prop-key">Password:</td>
                                                                <td  class="ads-prop-value">
                                                                    <a href="settings_password">Change</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="account">
                                                    <h5>Account Information</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Account Status:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($userContainer["adr_block"]!=1)
                                                                        echo "<span class='active'>Active</span>";
                                                                    else 
                                                                        echo "<span class='inactive'>Blocked</span>";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Date Of Creation:</td>
                                                                <td  class="ads-prop-value">'.date("F,D Y",strtotime($userContainer['time_joined'])).'</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Time Of Creation:</td>
                                                                <td  class="ads-prop-value">'.date("H:m A",strtotime($userContainer['time_joined'])).'</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <br>';
                                }else{
                                    echo '<h5 class="err_products">
                                                <i class="fa fa-robot"></i>
                                                <br>
                                                Sorry, Timeline Information Not Found
                                            </h5>';
                                }
                            ?>
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

 

