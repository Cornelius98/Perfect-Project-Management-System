<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Security');?>
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
                        <section class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <h4>Enter New Password</h4>
                            <hr>
                            <div class="form-wrap">
                                <div class="error-notice">
                                    <?php   $UserErrorsPool->error("error_adr","Suspicious Activity, User Session Unrecognized"); ?>
                                    <?php   $UserErrorsPool->error("error_password_format","Password format Denied"); ?>
                                    <?php   $UserErrorsPool->error("passwords_unmatched","Check, Ensure Your Passwords Match"); ?>
                                    <?php   $UserErrorsPool->error("empty_error","Fill All Inputs"); ?>
                                    <?php   $UserErrorsPool->error("isset_error","Fill All Inputs"); ?>
                                    <?php   $UserErrorsPool->error("failed","Password Change Failed"); ?>
                                    <?php   $UserErrorsPool->error_s("success","Password Change Successful"); ?>
                                    <span class="errs"></span>
                                </div>
                                <form action="../../middleware/admini/handleAccounts/mw_password_change?orient=form_request" 
                                        method="POST" 
                                            enctype="multipart/form-data">
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">
                                            New Password
                                            <br>
                                            <small>
                                                Use your new password on your next login
                                            </small>
                                        </label>
                                        <div class="form-group">
                                            <div class="wrap-input">
                                                <i class="fa fa-eye" id="password-eye"></i>
                                                <input type="password" 
                                                    placeholder="New Password" 
                                                    class="form-control" 
                                                    name="password"
                                                    id="password" 
                                                    required>
                                            </div>
                                            <div class="wrap-input">
                                                <i class="fa fa-eye" id="password-2-eye"></i>
                                                <input type="password" 
                                                    placeholder="Retype New Password" 
                                                    class="form-control" 
                                                    name="password_2"
                                                    id="password_2" 
                                                    required>
                                            </div>
                                        </div>
                                    
                                            <div>
                                                <button type="submit" 
                                                        class="btn btn-primary 
                                                                btn-sm btn-block
                                                                form-control">
                                                                Change Password
                                                </button>
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
         $(function(){
            var erse;
            $("#password-eye").click(function(){
                if(!$("#password").val()==''){
                    var input = document.getElementById('password');
                    if(input.type==="password"){
                        input.type = "text";
                        if($("#password-eye").parent().children('.fa').hasClass("fa-eye")){
                            $("#password-eye").parent().children('.fa').removeClass("fa-eye");
                            $("#password-eye").parent().children('.fa').addClass("fa-eye-slash");
                        }else{ $("#password-eye").parent().children('.fa').addClass("fa-eye");}
                    }
                    else 
                    {
                        if($("#password-eye").parent().children('.fa').hasClass("fa-eye-slash")){
                            $("#password-eye").parent().children('.fa').removeClass("fa-eye-slash");
                            $("#password-eye").parent().children('.fa').addClass("fa-eye");
                            input.type = "password";
                        }else {$("#password-eye").parent().children('.fa').addClass("fa-eye");}
                    }
                }else{
                    $(".errs").text('The Password Field is Empty');
                    erse = setTimeout(() => {$(".errs").hide();},3000);
                    clearInterval(erse);
                }
            });
            $("#password-2-eye").click(function(){
                if(!$("#password_2").val()==''){
                    var input = document.getElementById('password_2');
                    if(input.type==="password"){
                        input.type = "text";
                        if($("#password-2-eye").parent().children('.fa').hasClass("fa-eye")){
                            $("#password-2-eye").parent().children('.fa').removeClass("fa-eye");
                            $("#password-2-eye").parent().children('.fa').addClass("fa-eye-slash");
                        }else{ $("#password-2-eye").parent().children('.fa').addClass("fa-eye");}
                    }
                    else 
                    {
                        if($("#password-2-eye").parent().children('.fa').hasClass("fa-eye-slash")){
                            $("#password-2-eye").parent().children('.fa').removeClass("fa-eye-slash");
                            $("#password-2-eye").parent().children('.fa').addClass("fa-eye");
                            input.type = "password";
                        }else {$("#password-2-eye").parent().children('.fa').addClass("fa-eye");}
                    }
                }else{
                    $(".errs").text('The Password Field is Empty');
                    erse = setTimeout(() => {$(".errs").hide();},3000);
                    clearInterval(erse);
                }
            });
        });
    </script>
</body>
</html>

 

