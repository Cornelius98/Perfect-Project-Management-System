<?php 
namespace AccountsManager;
use DBTemplates\DBConnectionTemplate;
class AdminiAccountPush extends DBConnectionTemplate{
    public function update_password($o){
        $sql = "UPDATE `advertiser` 
                SET `adr_password` = ?
                WHERE `advertiser`.`adr_id` = ?;";
                 $param_type = "si";
                 $param_arr = [
                    $o["password"],
                    $o["uni_id"]
                ];
                return $this->push_record($sql,$param_type,$param_arr);          
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
    private function phone_exist(string $phone){
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`adr_mobile` = ?;";
                $param_type = "s";
                $param_list = [   
                    $phone
                ];
                return $this->fetch_bool_II($sql,$param_type,$param_list);
    }
    public function code_exist(int $code){
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`adr_code` = ?;";
                $param_type = "i";
                $param_list = [   
                    $code
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
    public function register($o){
        $sql = "INSERT INTO `advertiser`(`adr_code`,`rand_id`,`app_id`,`cli_id`,`fname`,`sname`,`aka`,
                `adr_mobile`,`email`,`adr_password`,`stt_id`,`dst_id`,`ctr_id`,
                `adr_day`,`adr_month`,`adr_year`)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $param_type = "isiissssssiiiiii";
        $param_list = [   
            $o["code"],
            $o["rand"],
            $o["source_app"],
            $o["client_category"],
            $o["fname"],
            $o["sname"],
            $o["aka"],
            $o["phone"],
            $o["email"],
            $o["path"],
            $o["state"],
            $o["district"],
            $o["country"],
            $o["d"],
            $o["m"],
            $o["y"]
        ];
        return $this->push_record($sql,$param_type,$param_list);        
    } 
    public function add_advertiser($o){
        if(!$this->email_exist($o["email"])){
            if(!$this->phone_exist($o["phone"])){
                if(!$this->code_exist($o["code"])){
                    if(!$this->rand_exist($o["rand"])){
                        if($this->register($o))
                            return true;
                        else 
                            return false;
                    }else return false;
                }else return false;
            }else return false;
        }else return false;
    }
    public function add_email_verify_code($vf_email,$code,$email){
        $sql ="UPDATE `advertiser`
                SET `advertiser`.`email_vf` = ?,
                    `advertiser`.`adr_code` = ?
                WHERE `advertiser`.`email` = ?;";
                $param_type = "iis";
                $param_list = [   
                    $vf_email,
                    $code,
                    $email
                ];
                return $this->push_record($sql,$param_type,$param_list);
    }
}

?>