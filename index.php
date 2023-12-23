<?php 
   include_once "./EXTERNAL_HEADER_FILES.php";
   $oWorldLocations = $UserAccountPull->get_world_locations();
    if(!is_array($oWorldLocations) || empty($oWorldLocations['countries']) || empty($oWorldLocations['districts']) || empty($oWorldLocations['states'])){
        header("Location:index?worldlocations_pop_join");
    }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <?php $UXviewTemplate->headers();?>
    <link rel="stylesheet" href="./libraries/auth/intl-tel-input-master/build/css/intlTelInput.css">
    <link rel="stylesheet" href="./libraries/auth/intl-tel-input-master/build/css/demo.css">
    <style>
        .top-nav-2 .top-nav-split
        {
            background-color: white;
        }
        body,html 
        {
            padding: 0;
            margin:0;
            outline: 0;   
            background-color: rgb(1,25,73);
            background: url("./assets/12067358_4882066.jpg");
            background-position: center;
            background-repeat: no-repeat;
        }
        .signup-main 
        {
            height: 100vh;
            overflow-y: hidden;
        }
        @media screen and (max-width: 768px){ 
            .signup-main 
            {
                height: auto;
                overflow-y: scroll;
            }
        }
    </style>
</head>
    <body style="margin:0;padding:0;">
        <main class="signup-main">
            <section class="top-nav-3 short-navie shadow">
                <div class="top-nav-fader">
                    <?php $UXviewTemplate->nav();?>
                </div>
            </section>
            <div class="container" style="padding-bottom:20%;">
                <div class="row justify-content-space-between tabs">
                    <div class="GospelText col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-3 my-*-0">
                        <h4>Pro Services.</h4>
                        <p>
                           Welcome To Pro Project Manager Zambia.<br> 
                            Create, manage, and share projects.
                            <br>Network With Your Teamates 
                            And <br>Share With Your Associates.
                            <br>
                            <br>
                            Remember, Work Environments<br>Ought To 
                            Be Kept Private And Safe.
                        </p>
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 my-3 my-*-0">
                        <div class="form-wrap shadow">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-intro">
                                    <i class="fa fa-users"></i>
                                    <div class="error-display">
                                        <?php $UserErrorsPool->error("err_phone_exist","Phone Number Exist, Use New Phonenumber")?>
                                        <?php $UserErrorsPool->error("err_email_exist","Email Address Exist, Use New Email Address")?>
                                        <?php $UserErrorsPool->error("err_code_exist","Replicated Code, Try Again")?>
                                        <?php $UserErrorsPool->error("err_rand_exist","Replicated Hash Code, Try Again")?>
                                        <?php $UserErrorsPool->error("err_unexist","Account Does Not Exist")?>
                                        <?php $UserErrorsPool->error("err_login","Login Failed, Try Again")?>
                                        <?php $UserErrorsPool->error("failed","Failed To Create Account,Try Again")?>
                                        <?php $UserErrorsPool->error("suspicious","Unexpected Interruption, Sign In")?>
                                        <?php $UserErrorsPool->error("limitedRetries","Retry limit exceeded, Sign In To Continue")?>
                                        <?php $UserErrorsPool->error("err_reset","Reset Your Password From Link In Your Email")?>
                                        <?php $UserErrorsPool->error("closed","Account Officially Closed")?>
                                        <?php $UserErrorsPool->error("deleted","Account Officially Deleted")?>
                                        <?php $UserErrorsPool->error("unverified","Account Unverified.Verify Your Account By Clicking Forgot Password")?>
                                        <?php $UserErrorsPool->error_s("success","Signup Successful, you may login")?>
                                        <?php $UserErrorsPool->error_s("secure_order","Hi friend, you're about to buy music on Gospelworld.If you have an account login to proceed, if not,quickly signup in a few simple steps! and proceed to buy")?>
                                        <?php $UserErrorsPool->error("err_auth_email_unset","Email Confirm Failed, Email Or OTP Unset");?>
                                        <?php $UserErrorsPool->error("err_auth_email_empty","Email Confirm Failed, Email Or OTP Was Empty");?>
                                        <?php $UserErrorsPool->error("err_fgt_email_empty","Password Change Failed, Email Was Empty");?>
                                        <?php $UserErrorsPool->error("err_fgt_email_unset","Password Change Failed, Email Was Unset");?>
                                        <?php $UserErrorsPool->error("err_fgt_email_bad","Password Change Failed, Email Address Incorrectly Formatted");?>
                                        <?php $UserErrorsPool->error_s("password_changed","Password Change Successful, You May Login");?>
                                        <?php $UserErrorsPool->error_s("registered","Successful, Check Your Email To Complete Sign Up");?>
                                        <?php $UserErrorsPool->error("unregistered","Registration Failed, Try Again");?>
                                    </div>
                                </div>
                                <input type="tel" id="phonenumber" 
                                            name="phonenumber" 
                                            class="form-control" 
                                            pattern="[0-9]{10}"
                                            require>
                                <div class="password-wrap">
                                    <i class="fa fa-eye" id="p-eye"></i>
                                    <input type="password" id="password" placeholder="Password" 
                                        class="form-control" 
                                            name="password" 
                                                    required>
                                </div>
                                <div class="reset-menu">
                                    <span data-toggle="modal" data-target="#forgotPasswordModal">
                                        Forgot Password
                                    </span>
                                    <span data-toggle="modal" data-target="#quickSignupModal">
                                        Signup
                                    </span>
                                </div>

                                <button type="button" id="submit" 
                                    class="btn btn-sm form-control" 
                                        style="border:1px solid rgb(0,45,102);
                                                background-color: rgb(12, 75, 158);
                                                color:white;" onclick="serverAuthUsage();">
                                                <strong style="color:white;">
                                                    Sign In
                                                </strong>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModal">Reset Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                        <form id="quickForgotPasswordForm" class="quickForgotPasswordForm">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                    <div class="error-display"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <input type="text" id="forgot-email" 
                                                name="forgot-email" 
                                                class="form-control forgot-email" 
                                                placeholder="Enter Email Address"
                                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                require>
                                </div>
                            </div>
                            <button type="button" id="auth-btn" 
                                class="btn btn-sm form-control" 
                                    style="border:1px solid #33dfff;
                                            background-color: #33dfff;
                                            color:white;" onclick="serverAuthRecoverAccount();">
                                            <strong style="color:white;">Send Recovery Email</strong>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
         <div class="modal fade" id="quickSignupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-fader">
                        <div class="modal-header">
                            <h5 class="modal-title" id="signupModal">
                                Account
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="spin-anime-account" id="spin-anime-account">
                                    <div class="cred-loader"></div>
                                </div>
                                <div class="registration-result" id="registration-result">
                                    <div class="icon-notice" id="icon-notice"></div>
                                </div>
                                <form class="quickSignup" method="POST" action="./middleware/user/handleAccounts/serverAuthInit" enctype="multipart/form-data" >
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                            <span class="error-response"></span>
                                        </div>
                                    </div>
                                    <label for=""><strong>Personal Information</strong></label>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="border:px solid red;width:100%;">
                                            <input type="text" 
                                                    id="fname" 
                                                    name="fname" 
                                                    placeholder="First Name"
                                                    class="form-control" 
                                                    pattern="[a-zA-Z]{2,30}"
                                                    require>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <input type="text" 
                                                    id="sname" 
                                                    name="sname" 
                                                    placeholder="Second Name"
                                                    class="form-control" 
                                                    pattern="[a-zA-Z]{2,30}"
                                                    require>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <input type="text" 
                                                    id="aka" 
                                                    name="aka"
                                                    placeholder="Aka (optional)" 
                                                    class="form-control" 
                                                    pattern="[a-zA-Z0-9]{0,30}"
                                                    >
                                        </div>
                                    </div>
                                    <label for="" class="label-sect">
                                        <strong>Contact Information</strong>
                                    </label>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <input type="tel" 
                                                    id="phone" 
                                                    name="phone" 
                                                    class="form-control" 
                                                    pattern="[0-9]{9}"
                                                    require>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <input type="email" 
                                                    id="remail" 
                                                    name="remail" 
                                                    placeholder="Email Address"
                                                    class="form-control" 
                                                    pattern="[a-zA-Z@.-_]{2,30}"
                                                    require>
                                        </div>
                                    </div>
                                    <label for="" class="label-sect">
                                        <strong>Location Information</strong>
                                    </label>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <select name="area" id="area" class="form-control">
                                                <option value="">Choose Location ...</option>
                                                <?php 
                                                    foreach($oWorldLocations['districts'] AS $location){
                                                        $location_keys = $location['dst_id'].','.$location['stt_id'].','.$location['ctr_id'];
                                                        echo '<option value="'.$location_keys.'">'.$location['dst_name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="" class="label-sect">
                                        <strong>Security Information</strong>
                                    </label>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div id="pass-eye" class="pass-eye">
                                                <h6 class="inner-header">Must Contain Atleast Five(5) Characters</h6>
                                                <input type="password" 
                                                        id="secretCode"
                                                        placeholder="Password" 
                                                        class="form-control" 
                                                        name="password" required>
                                                        <i class="fa fa-eye" id="p-eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="rauth-btn" 
                                        class="btn btn-sm form-control"
                                            style="border:1px solid #33dfff;
                                                    background-color: #33dfff;
                                                    color:white;" onclick="serverAuthInit();">
                                                    <strong style="color:white;">Sign Up</strong>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $UXviewTemplate->headers_footer();?>
    <script src="./libraries/auth/intl-tel-input-master/build/js/intlTelInput.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var input1 = document.querySelector("#phone");
        var init = window.intlTelInput(input1, {
            allowDropdown: true,
            autoHideDialCode: true,
            nationalMode: true,
            preferredCountries: ['zm','ng','us'],
            separateDialCode: true,
            utilsScript: "./libraries/auth/intl-tel-input-master/build/js/utils.js",
        });
        var sinput = document.querySelector("#phonenumber");
        var sinit = window.intlTelInput(sinput, {
            allowDropdown: true,
            autoHideDialCode: true,
            preferredCountries: ['zm','ng','us'],
            separateDialCode: true,
            utilsScript: "./intl-tel-input-master/build/js/utils.js",
        });
        $(function(){
            $("#p-eye").click(function(){
                if(!$("#password").val()==''){
                    var input = document.getElementById('password');
                    if(input.type==="password"){
                        input.type = "text";
                        if($("#p-eye").hasClass("fa-eye")){
                            $("#p-eye").removeClass("fa-eye");
                            $("#p-eye").addClass("fa-eye-slash");
                        }
                        else{$("#p-eye").addClass("fa-eye");}
                    }
                    else 
                    {
                        if($("#p-eye").hasClass("fa-eye-slash")){
                                $("#p-eye").removeClass("fa-eye-slash");
                                $("#p-eye").addClass("fa-eye");
                                input.type = "password";
                        }else {$("#p-eye").addClass("fa-eye");}
                    }
                }else{
                    $(".error-display").show(200,function(){
                        $(".error-display").html("<h6 class='e-notice'>The Password Field is Empty</h6>");
                    });
                    passwordEmptyHide = setTimeout(() => {
                        $(".error-display").hide(200);
                        clearTimeout(passwordEmptyHide);
                    },3000);
                }
            });
        });
        function serverAuthInit(){
            $(function(){
                let phoneNumber = init.getNumber(intlTelInputUtils.numberFormat.E164),
                    secretCode = $("#secretCode").val();
                    fname = ($("#fname").val()!="")?$("#fname").val():$(".error-response").text("First Name Cannot Be Empty");
                    sname = ($("#sname").val()!="")?$("#sname").val():$(".error-response").text("Second Name Cannot Be Empty");
                    aka = ($("#aka").val()!="")?$("#aka").val():"0";
                    phone = (phoneNumber!="")?phoneNumber:$(".error-response").text("Phonenumber Cannot Be Empty");
                    email = ($("#remail").val()!="")?$("#remail").val():$(".error-response").text("Email Address Cannot Be Empty");
                    area = ($("#area").val()!="")?$("#area").val():$(".error-response").text("Location Cannot Be Empty");
                    if((phoneNumber!="") && (secretCode!="")){
                        const data  = {
                            "secretCode":secretCode,
                            "fname":fname,
                            "sname":sname,
                            "aka":aka,
                            "phone":phone,
                            "email":email,
                            "area":area
                        }
                        $.ajax({
                            type: "POST",
                            url: "./middleware/admini/handleAccounts/serverAuthInit",
                            async: true,
                            cache:false,
                            data:{'data':data},
                            beforeSend:function(){
                                $("#quickSignup").hide(function(){
                                    $("#spin-anime-account").show();
                                });
                            },
                            success: function(s){
                                if(s['status']==200)
                                    window.location.href="index?registered";
                                else window.location.href="index?unregistered";
                            }
                        });
                    }else{
                        $(".error-response").text("Fill In All Fields");
                    }
            });
        }
        function serverAuthUsage(){
            $(function(){
                let phoneNumberUsage = sinit.getNumber(intlTelInputUtils.numberFormat.E164),
                    secretCodeUsage = $("#password").val();
                    if((phoneNumberUsage!="") && (secretCodeUsage!="")){
                        $.ajax({
                            type: "POST",
                            url: "./middleware/admini/handleAccounts/serverAuthUsage",
                            async: true,
                            cache:false,
                            data:{'data':{
                                        "phoneNumber":phoneNumberUsage,
                                        "secretCode":secretCodeUsage
                                    }
                            },
                            success: function(s){
                                if((s['unsuccess']===0))
                                    window.location.href="./dashboards/administrator/home";
                                else {
                                    if(s["unfoundUser"]===2)
                                        window.location.href="./index?err_unexist";
                                    else window.location.href="./index?err_login";
                                }     
                            }
                        });
                    }else{
                        $(".error-response").text("Fill In All Fields");
                    }
            });
        }
        function serverAuthRecoverAccount(){
            $(function(){
                    let email = ($("#forgot-email").val()!="")?$("#forgot-email").val():$(".error-response").html("<div class='e-notice'>Email Address Cannot Be Empty</div>");
                    if((email!="")){
                        const data  = {
                            "email":email
                        }
                        $.ajax({
                            type: "POST",
                            url: "./middleware/admini/handleAccounts/mw_forgot_password",
                            async: true,
                            cache:false,
                            data:{'data':data},
                            beforeSend:function(){
                                $(".spin-wrap").css("display","flex");
                                $("#forgotPasswordModal").css("animation","waterWaveFade 2s infinite");
                            },
                            success: function(s){
                                if((s['status']==200)){
                                    $(".spin-wrap").css("display","none");
                                    $("#forgotPasswordModal").css("animation","none");
                                    $(".error-display").html("<div class='e-success'>Successful, Check Your Email</div>");
                                }else{
                                    $(".spin-wrap").css("display","none");
                                    $("#forgotPasswordModal").css("animation","none");
                                    $(".error-display").html("<div class='e-notice'>Reset Failed Tr Again</div>");
                                }
                            }
                        });
                    }else{
                        $(".spin-wrap").css("display","none");
                        $("#forgotPasswordModal").css("animation","none");
                        $(".error-display").html("<div class='e-notice'>Email Field Cannot Be Empty</div>");
                    }
            });
        }
    </script>
    </body>
</html>