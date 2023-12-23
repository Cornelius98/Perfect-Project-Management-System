<?php 
namespace UserSessionManager;
use AccountsManager\UserAccountPush;
class UserSessionPush extends UserAccountPush{
    public function start_sessn($o){
        session_start();
        if($this->_bind_u2sessn($o)){
            $loggs_id = SELF::loggins_unicast(2,$_SESSION["uSessn"]["uSeck"],session_id());
            $_SESSION["uSessn"]["uSessnLoggsSeck"] = $loggs_id;
            return true;
        }else 
            return false;
    }
    private function _bind_u2sessn($o){
        $userSessnDetails = null;
        if(!empty($o["fname"]) && !empty($o["sname"])){
            $userSessnDetails = [
                "uSeck" => $o['adr_id'],
                "uCode" => $o['adr_code'],
                "uAvtr" => $o['adr_icon_url'].$o['adr_icon_name'],
                "uDst" => $o['dst_id'],
                "uStt" => $o['stt_id'],
                "uCtr" => $o['ctr_id'],
                "uName" => $o['fname']." ".$o['sname'],
                "uEmail" => $o['email'],
                "uMobile" => $o['adr_mobile'],
                "uBlln" => $o['blln_vf'],
                "uEvf" => $o['email_vf'],
                "uAds" => $o['ads_id']
            ];
        }
        $_SESSION["uSessn"] =  $userSessnDetails;
        if(!empty($_SESSION["uSessn"]["uSeck"]) && !empty($_SESSION["uSessn"]["uEmail"]))
            return true;
        else  
            return false;
    }
    public function new_sessnid(){
        session_regenerate_id(true);
    }
    private function _validate_active_sessn(){ 
        if(isset($_SESSION["uSessn"]["uCode"]) && !empty($_SESSION["uSessn"]["uCode"]) &&
            isset($_SESSION["uSessn"]["uAvtr"]) && !empty($_SESSION["uSessn"]["uAvtr"]))
            return true;
        else 
            return false;
    }
    private function _validate_active_sessn_payee(){ 
        if((isset($_SESSION["uSessn"]["uCode"]) || isset($_SESSION["aSessn"]["aCode"])) && 
           (!empty($_SESSION["uSessn"]["uCode"]) || !empty($_SESSION["aSessn"]["aCode"])))
            return true;
        else 
            return false;
    }
    public function active_sessn_permission(){   
        if(session_status()===PHP_SESSION_ACTIVE && $this->_validate_active_sessn())
            $this->new_sessnid();
        else{header("Location:".$_SERVER['SERVER_NAME']."/signup?error=suspicious");}    
    }
    public function access_permission(){   
        if(session_status()===PHP_SESSION_ACTIVE && $this->_validate_active_sessn()){
            $prev_sessn = session_id();
            $this->new_sessnid();
            SELF::loggedin_regsessn_unicast($_SESSION["uSessn"]["uSessnLoggsSeck"],$prev_sessn,session_id());
            return true;
        }else header("Location:".$_SERVER['SERVER_NAME']."/signup?error=suspicious");   
    }
    public function access_permission_payee(){   
        if(session_status()===PHP_SESSION_ACTIVE && $this->_validate_active_sessn_payee()){
            $prev_sessn = session_id();
            $this->new_sessnid();
            SELF::loggedin_regsessn_unicast(isset($_SESSION["uSessn"]["uSessnLoggsSeck"])?$_SESSION["uSessn"]["uSessnLoggsSeck"]:$_SESSION["aSessn"]["aSessnLoggsSeck"],$prev_sessn,session_id());
            return true;
        }else header("Location:".$_SERVER['SERVER_NAME']."/signup?error=suspicious");   
    }
    public function end_session()
    {   if(session_unset() && session_destroy())
            return true;
        else 
            return false;
    }
    public function end_targetted_session(){ 
        if(isset($_SESSION["uSessn"]) || 
            !empty($_SESSION["uSessn"]["uSeck"]) || 
            !empty($_SESSION["uSessn"]["aAds"])){
                unset($_SESSION["uSessn"]);
                if(!isset($_SESSION["uSessn"]) && 
                    empty($_SESSION["uSessn"]["uSeck"]))
                    return true;
                else return false;
        }
    }
}
?>