<?php 
namespace AccountsManager;
use DBTemplates\DBConnectionTemplate;
class UserAccountPush extends DBConnectionTemplate{
    public function code_exist(int $code){
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`adr_code` = ?;";
                $param_type = "i";
                $param_list = [   
                    $code
                ];
                return $this->fetch_bool_II($sql,$param_type,$param_list);
    }
    public function email_code_exist(int $code){
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`email_vf` = ?;";
                $param_type = "i";
                $param_list = [   
                    $code
                ];
                return $this->fetch_bool_II($sql,$param_type,$param_list);
    }
    public function email_exist(string $email){
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`email` = ?;";
                $param_type = "s";
                $param_list = [   
                    $email
                ];
                return $this->fetch_bool_II($sql,$param_type,$param_list);
    }
    public function add_email_verify_code(string $email,int $vf_code){
        $sql ="UPDATE `advertiser`
                SET `advertiser`.`email_vf` = ?
                WHERE `advertiser`.`email` = ?;";
                $param_type = "is";
                $param_list = [   
                    $vf_code,
                    $email
                ];
                return $this->push_record($sql,$param_type,$param_list);
    }
    private function phone_exist(string $phone){
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`adr_mobile` = ?;";
                $param_type = "s";
                $param_list = [   
                    $phone
                ];
                return $this->fetch_bool_II($sql,$param_type,$param_list);
    }
    private function rand_exist(string $rand){  
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`adr_mobile` = ?;";
                $param_type = "s";
                $param_list = [   
                    $rand
                ];
                return $this->fetch_bool_II($sql,$param_type,$param_list);
    }
    public function add_advertiser($o){
        if(!$this->email_exist($o["email"])){
            if(!$this->phone_exist($o["phone"])){
                if(!$this->code_exist($o["code"])){
                    if(!$this->rand_exist($o["rand"])){
                        if($this->registerBeliever($o))
                            return true;
                        else 
                            return false;
                    }else {header("location:../../../signup?err_rand_exist");}
                }else {header("location:../../../signup?err_code_exist");}
            }else {header("location:../../../signup?err_phone_exist");}
        }else {header("location:../../../signup?err_email_exist");}
    }
    public function update_email_verified($key){
        $sql = "UPDATE `partner` SET `email_vf` = ?;";
        $stmt = $GLOBALS['connecKnockDb']->prepare($sql);
        $stmt->bind_param("i",$key);
        if($stmt->execute())
            return true;
        else
            return false;                 
    }   
    public function update_password_by_email($password,$email){
        $sql = "UPDATE `advertiser` 
                SET `adr_password` = ?
                WHERE `advertiser`.`email` = ?;";
                 $param_type = "ss";
                 $param_arr = [
                    $password,
                    $email
                ];
                return $this->push_record($sql,$param_type,$param_arr);     
    } 
    public function loggins_unicast($cli_id,$uni_id,$sesn_hash){
        $sql = "INSERT INTO `logins`(`cli_id`,`uni_id`,`sessn_hash`)VALUES(?,?,?);";
                            $param_type = "iis";               
                            $param_list = [
                                $cli_id,
                                $uni_id,
                                $sesn_hash
                            ];     
                            return $this->push_record_get_id($sql,$param_type,$param_list);
    }
    public function loggouts_unicast($lg_id,$cli_id,$uni_id,$sesn_hash){
        $sql = "INSERT INTO `logouts`(`lgi_id`,`cli_id`,`uni_id`,`sessn_hash`)VALUES(?,?,?,?);";
                            $param_type = "iiis";               
                            $param_list = [
                                $lg_id,
                                $cli_id,
                                $uni_id,
                                $sesn_hash
                            ];      
                            return $this->push_record($sql,$param_type,$param_list);
    }
    public function loggedin_regsessn_unicast($curr_sessnloggs_id,$prev_hash,$next_hash){
        $sql = "INSERT INTO `loggedin_sessn`(`lgi_id`,`prev_sessnhash`,`next_sessnhash`,`source`)VALUES(?,?,?,?);";
                            $param_type = "isss";               
                            $param_list = [
                                $curr_sessnloggs_id,
                                $prev_hash,
                                $next_hash,
                                'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']
                            ];      
                            return $this->push_record($sql,$param_type,$param_list);
    }
}
?>