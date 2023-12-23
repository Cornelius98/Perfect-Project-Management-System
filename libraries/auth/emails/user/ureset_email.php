<?php
require_once(dirname(__DIR__).'../PHPMailer/Exception.php');
require_once(dirname(__DIR__).'../PHPMailer/OAuth.php');
require_once(dirname(__DIR__).'../PHPMailer/PHPMailer.php');
require_once(dirname(__DIR__).'../PHPMailer/POP3.php');
require_once(dirname(__DIR__).'../PHPMailer/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendUserForgotEmailSecond($email,$code){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'theecornelius@gmail.com';                     
    $mail->Password   = 'jjfpixorfctnsneo';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
    $mail->Port       = 587;    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );                                
    $mail->setFrom('theecornelius@gmail.com','Pro Services');
    $mail->addAddress("$email");
    $mail->addReplyTo("corneliuskasokola101@gmail.com", "Pro Services");

    $mail->isHTML(true);
    $mail->Subject = "Pro Services";
    $mail->Body    ='
    <body class="s-chaff">
        <div class="content-wrapper" style="position:absolute; 
                                            top:90%;
                                            left:50%;
                                            transform:translate(-50%,-50%);
                                            width:90%;
                                            font-family:Times New Roman">                          
            <p>
                <h4 style="text-transform:Capitalize;">Hellow</h4>
                <span>
                    You have attempted to reset your Pro Services account password.<br>
                    We will help you gain access to your account in a few simple steps!
                </span>
                <br><br><br><br><br>
                <p style="text-align:center;">
                        <strong>
                            <span style="background-color: antiquewhite;
                                        padding:2%;">'.$code.'</span>
                        </strong>
                </p>
                <br><br><br><br><br>
                <ol>
                    <li>You will need the secret code above to reset your password;</li>
                    <li>Click on the reset button below to proceed.</li>
                </ol>
                <br><br><br><br><br>
                <p style="text-align: center;">
                <a href="http://'.$_SERVER["SERVER_NAME"].'/forgot?s_code='.$code.'&&s_email='.$email.'" 
                    style="background-color: green;
                        color:white;
                        text-align:center;
                        width:100%;
                        padding:1%;
                        border-radius:25px;
                        font-size: smaller;
                        text-decoration: none;">Change Password</a>
                </p>
                <br><br><br><br><br>
                <blockquote style="text-align:left;padding-bottom:30%;">
                    Kind Regards,<br>
                    Pro Services,<br>
                    Zambia.
                </blockquote>
            </p>
        
        </div>
    </body>';  
    if($mail->send()) 
        return true;
    else 
        return true;
}
?>