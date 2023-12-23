<?php 
namespace ProductManager;
use DBTemplates\DBConnectionTemplate;
class ProductDelete extends DBConnectionTemplate{
    public function views($p_seck){
        $sql = "DELETE FROM `views`
                WHERE `views`.`p_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $p_seck
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function shares($p_seck){
        $sql = "DELETE FROM `shares` 
                WHERE `shares`.`p_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $p_seck
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function project($pj_id){
        $sql = "DELETE FROM `project` 
                WHERE `project`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function picture($pj_id){
        $sql = "DELETE FROM `pictures` 
                WHERE `pictures`.`pc_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function document($pj_id){
        $sql = "DELETE FROM `documents` 
                WHERE `documents`.`dc_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function file($pj_id){
        $sql = "DELETE FROM `files` 
                WHERE `files`.`fs_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function fs_unlink($fs_url,$f_name){
        $unlink_url = $fs_url.$f_name;
        if(unlink( $unlink_url))
            return true;
        else return false;
    }
    public function pictures_o($pj_id){
        $sql = "DELETE FROM `pictures` 
                WHERE `pictures`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function documents_o($pj_id){
        $sql = "DELETE FROM `documents` 
                WHERE `documents`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function files_o($pj_id){
        $sql = "DELETE FROM `files` 
                WHERE `files`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function progress_o($pj_id){
        $sql = "DELETE FROM `progress` 
                WHERE `progress`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function discussion_o($pj_id){
        $sql = "DELETE FROM `discussion` 
                WHERE `discussion`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function invitation_o($pj_id){
        $sql = "DELETE FROM `invitations` 
                WHERE `invitations`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function share_o($pj_id){
        $sql = "DELETE FROM `shares` 
                WHERE `shares`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function view_o($pj_id){
        $sql = "DELETE FROM `views` 
                WHERE `views`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function invite($o){
        $sql = "DELETE FROM `invitations` 
                WHERE `invitations`.`inv_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $o["inv_id"]
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
}

?>