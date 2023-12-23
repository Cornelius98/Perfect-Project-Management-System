<?php 
namespace AdminiSessionManager;
use AccountsManager\UserAccountPush;
class AdminiSessionPush extends UserAccountPush{
    public function start_sessn($o){
        session_start();
        if($this->_bind_u2sessn($o)){
            $logg_id = SELF::loggins_unicast(1,$_SESSION["aSessn"]["aSeck"],session_id());
            $_SESSION["aSessn"]["aSessnLoggsSeck"] = $logg_id;
            return true;
        }else 
            return false;
    }
    private function _bind_u2sessn($o){
        $userSessnDetails = null;
        if(!empty($o["fname"]) && !empty($o["sname"])){
            $userSessnDetails = [
                "aSeck" => $o['adr_id'],
                "aCode" => $o['adr_code'],
                "aAvtr" => $o['adr_icon_url'].$o['adr_icon_name'],
                "aDst" => $o['dst_id'],
                "aStt" => $o['stt_id'],
                "aCtr" => $o['ctr_id'],
                "aName" => $o['fname']." ".$o['sname'],
                "aEmail" => $o['email'],
                "aMobile" => $o['adr_mobile'],
                "aBlln" => $o['blln_vf'],
                "aEvf" => $o['email_vf'],
                "aAds" => $o['ads_id']
            ];
        }
        $_SESSION["aSessn"] =  $userSessnDetails;
        if(!empty($_SESSION["aSessn"]["aSeck"]) && !empty($_SESSION["aSessn"]["aEmail"]))
            return true;
        else  
            return false;
    }
    public function new_sessnid(){
        session_regenerate_id(true);
    }
    private function _validate_active_sessn(){ 
        if(isset($_SESSION["aSessn"]["aCode"]) && !empty($_SESSION["aSessn"]["aCode"]) &&
            isset($_SESSION["aSessn"]["aAvtr"]) && !empty($_SESSION["aSessn"]["aAvtr"]))
            return true;
        else 
            return false;
    }
    public function active_sessn_permission(){   
        if(session_status()===PHP_SESSION_ACTIVE && $this->_validate_active_sessn())
            $this->new_sessnid();
        else{header("Location:".$_SERVER['SERVER_NAME']."/bimble?error=suspicious");}    
    }
    public function access_permission(){   
        if(session_status()===PHP_SESSION_ACTIVE && $this->_validate_active_sessn()){
            $prev_sessn = session_id();
            $this->new_sessnid();
            SELF::loggedin_regsessn_unicast($_SESSION["aSessn"]["aSessnLoggsSeck"],$prev_sessn,session_id());
            return true;
        }else header("Location:".$_SERVER['SERVER_NAME']."/index?error=suspicious");    
    }
    public function end_session()
    {   if(session_unset() && session_destroy())
            return true;
        else 
            return false;
    }
    public function end_targetted_session(){ 
        if(isset($_SESSION["aSessn"]) || 
            !empty($_SESSION["aSessn"]["aSeck"]) || 
            !empty($_SESSION["aSessn"]["aAds"])){
                unset($_SESSION["aSessn"]);
                if(!isset($_SESSION["aSessn"]) && 
                    empty($_SESSION["aSessn"]["aSeck"]))
                    return true;
                else return false;
        }
    }
}
?>