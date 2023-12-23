<?php 
namespace AccountsManager;
use DBTemplates\DBConnectionTemplate;
class AdminiAccountPull extends DBConnectionTemplate{
    public function get_total_advertisers(){
        $sql ="SELECT COUNT(*) AS `total_advertisers` 
                FROM `advertiser`;";
                return $this->fetch_records($sql);
    }
    public function get_total_active_advertisers(){
        $sql ="SELECT COUNT(*) AS `total_advertisers` 
                FROM `advertiser`
                WHERE `advertiser`.`blln_vf` >0
                    AND `advertiser`.`email_vf` >0
                    AND `advertiser`.`phone_vf` >0;";
                return $this->fetch_records($sql);
    }
    public function get_inactive_advertising_advertisers(){
        $sql ="SELECT COUNT(*) AS `total_advertisers` 
                FROM `advertiser`
                WHERE `advertiser`.`adv_block`=0;";
                return $this->fetch_records($sql);
    }
    public function get_blocked_advertisers(){
        $sql ="SELECT COUNT(*) AS `total_advertisers` 
                FROM `advertiser`
                WHERE `advertiser`.`adr_block`=1;";
                return $this->fetch_records($sql);
    }
    public function get_advertisers($offset,$limit){
        $sql ="SELECT * FROM `advertiser`
                ORDER BY `advertiser`.`adr_id` DESC
                LIMIT $offset,$limit;";
                return $this->fetch_records($sql);
    }
    public function get_advertisers_o(){
        $sql ="SELECT * FROM `advertiser`
                ORDER BY `advertiser`.`adr_id` DESC;";
                return $this->fetch_records($sql);
    }
    public function get_total_loggins($cli_cat,$adr_seck){
        $sql = "SELECT COUNT(*) AS `total`
                FROM `logins` 
                WHERE `logins`.`cli_id` = ? 
                    AND `logins`.`uni_id` = ?;";
                $param_type = "ii";
                $param_list= [
                    $cli_cat,
                    $adr_seck
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_total_loggouts($cli_cat,$adr_seck){
        $sql = "SELECT COUNT(*) AS `total` 
                FROM `logouts` 
                WHERE `logouts`.`cli_id` = ? 
                    AND `logouts`.`uni_id` = ?;";
                $param_type = "ii";
                $param_list= [
                    $cli_cat,
                    $adr_seck
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_total_sessn_regns($lgi_id){
        $sql = "SELECT COUNT(*) AS `total` 
                FROM `loggedin_sessn` 
                WHERE `loggedin_sessn`.`lgi_id` = ?;";
                $param_type = "i";
                $param_list= [
                   $lgi_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_total_activities($adr_seck){
        $sql = "SELECT COUNT(*) AS `total`
                FROM `activity` 
                WHERE `activity`.`uni_id` = ?;";
                $param_type = "i";
                $param_list= [
                    $adr_seck
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_activities($adr_seck,$offset,$limit){
        $sql = "SELECT * FROM `activity` 
                LEFT JOIN `advertiser`
                    ON `advertiser`.`adr_id` = `activity`.`uni_id`
                WHERE `activity`.`uni_id` = ?
                ORDER BY `activity`.`actvt_id` DESC
                LIMIT $offset,$limit;";
                $param_type = "i";
                $param_list= [
                    $adr_seck
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_advertiser($adr_id){
        $sql ="SELECT * FROM `advertiser`
                WHERE `advertiser`.`adr_id` = ?;";
                $param_type = "i";
                $param_list= [
                    $adr_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function does_email_exist($email_address){
        $unique_email_check = "SELECT * FROM `advertiser` WHERE `email` = ? ;";
        if($stmt = $GLOBALS['zumDatabaseConnection']->prepare($unique_email_check))
        {  $stmt->bind_param("s",$email_address);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
                return true;
            else 
                return false;
            $stmt->close();
        }
    }
    public function get_with_code($code){
        $sql = "SELECT * FROM `advertiser` 
                WHERE `advertiser`.`adr_code` = ?;";
                $param_type = "s";
                $param_arr = [$code];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_with_code_II($code){
        $sql = "SELECT * FROM `advertiser` 
                WHERE `advertiser`.`adr_code` = ?;";
                $param_type = "i";
                $param_arr = [
                    $code
                ];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_mirror_account_route_o($adr_seck){
        $sql = "SELECT `advertiser`.`fname`,`advertiser`.`sname`,
                    `advertiser`.`adr_id`,`advertiser`.`rand_id`,
                    `advertiser`.`adr_code`,`advertiser`.`email`,
                    `advertiser`.`adr_mobile`,
                    `advertiser`.`phone_vf`,
                    `advertiser`.`email_vf`,
                    `advertiser`.`adv_block`,
                    `advertiser`.`adr_block`,
                    `advertiser`.`masterblock`
                FROM `advertiser` 
                WHERE `adr_id` = ?;";
                $param_type = "i";
                $param_list= [
                    $adr_seck
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
}
?>