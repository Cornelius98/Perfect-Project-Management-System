<?php 
namespace ProductManager;
use DBTemplates\DBConnectionTemplate;
class ProductPush extends DBConnectionTemplate{
    public function view($pj_id,$adr_id){
        $sql = "INSERT INTO `views`(`pj_id`,`adr_id`)VALUES(?,?);";
                $param_type = "ii";               
                $param_list = [
                    $pj_id,
                    $adr_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function share($pj_id,$adr_id,$shc_id){
        $sql = "INSERT INTO `shares`(`pj_id`,`adr_id`,`shc_id`)VALUES(?,?,?);";
                $param_type = "iii";               
                $param_list = [
                    $pj_id,
                    $adr_id,
                    $shc_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function project($o){
        $sql = "INSERT INTO `project`(`p_rand`, `adr_id`, `name`, `tname`, `desc`, `summary`, `aims`, 
                `objectives`, `hypothesis`, `conclusion`, `sdate`, `mdate`, `cdate`, `duration`, `director`, 
                `manager`, `supervisor`, `wforce`, `input`, `yield`, `proceeds`, `losses`, `sprocedures`, 
                `mprocedures`, `yprocedures`, `riskm`, `d`, `m`, `y`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
                 $param_type = "sssssssssssssssssssssssssssss";               
                 $param_list = [
                     $o["rand_id"],
                     $o["uni_id"],
                     $o["name"],
                     $o["tname"],
                     $o["desc"],
                     $o["summary"],
                     $o["aims"],
                     $o["objectives"],
                     $o["hypothesis"],
                     $o["conclusion"],
                     $o["sdate"],
                     $o["mdate"],
                     $o["cdate"],
                     $o["duration"],
                     $o["director"],
                     $o["manager"],
                     $o["supervisor"],
                     $o["wforce"],
                     $o["input"],
                     $o["pyield"],
                     $o["profit"],
                     $o["loss"],
                     $o["sprocedure"],
                     $o["mprocedure"],
                     $o["yprocedure"],
                     $o["rprocedure"],
                     $o["d"],
                     $o["m"],
                     $o["y"]
                 ];      
                 return $this->push_record_get_id($sql,$param_type,$param_list);
    }
    public function picture($pj_id,$adr_id,$pic_name,$pic_size){
        $sql = "INSERT INTO `pictures`(`pj_id`, `adr_id`, `pc_name`, `pc_size`) VALUES (?,?,?,?);";
                $param_type = "iisi";               
                $param_list = [
                    $pj_id,
                    $adr_id,
                    $pic_name,
                    $pic_size
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function picture_edit_add($pic_id,$pj_id,$adr_id,){
        $sql = "INSERT INTO `picture_edit_add`(`pc_id`, `pj_id`, `adr_id`) VALUES (?,?,?);";
                $param_type = "iii";               
                $param_list = [
                    $pic_id,
                    $pj_id,
                    $adr_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function picture_edit_delete($pic_id,$pj_id,$adr_id,){
        $sql = "INSERT INTO `picture_edit_delete`(`pc_id`, `pj_id`, `adr_id`) VALUES (?,?,?);";
                $param_type = "iii";               
                $param_list = [
                    $pic_id,
                    $pj_id,
                    $adr_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function document($pj_id,$adr_id,$dc_name,$dc_size){
        $sql = "INSERT INTO `documents`(`pj_id`, `adr_id`, `dc_name`, `dc_size`) VALUES (?,?,?,?);";
                $param_type = "iisi";               
                $param_list = [
                    $pj_id,
                    $adr_id,
                    $dc_name,
                    $dc_size
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function document_edit_add($dc_id,$pj_id,$adr_id,){
        $sql = "INSERT INTO `docs_edit_add`(`dc_id`, `pj_id`, `adr_id`) VALUES (?,?,?);";
                $param_type = "iii";               
                $param_list = [
                    $dc_id,
                    $pj_id,
                    $adr_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function document_edit_delete($dc_id,$pj_id,$adr_id,){
        $sql = "INSERT INTO `docs_edit_delete`(`dc_id`, `pj_id`, `adr_id`) VALUES (?,?,?);";
                $param_type = "iii";               
                $param_list = [
                    $dc_id,
                    $pj_id,
                    $adr_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function file($pj_id,$adr_id,$fs_name,$fs_size){
        $sql = "INSERT INTO `files`(`pj_id`, `adr_id`, `fs_name`, `fs_size`) VALUES (?,?,?,?);";
                $param_type = "iisi";               
                $param_list = [
                    $pj_id,
                    $adr_id,
                    $fs_name,
                    $fs_size
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function file_edit_add($fs_id,$pj_id,$adr_id,){
        $sql = "INSERT INTO `files_edit_add`(`fs_id`, `pj_id`, `adr_id`) VALUES (?,?,?);";
                $param_type = "iii";               
                $param_list = [
                    $fs_id,
                    $pj_id,
                    $adr_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function file_edit_delete($fs_id,$pj_id,$adr_id,){
        $sql = "INSERT INTO `files_edit_delete`(`fs_id`, `pj_id`, `adr_id`) VALUES (?,?,?);";
                $param_type = "iii";               
                $param_list = [
                    $fs_id,
                    $pj_id,
                    $adr_id
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function invite($pj_id,$sender_id,$recipient_id,$status_key){
        $sql = "INSERT INTO `invitations`(`pj_id`, `sender_id`, `recipient_id`, `status`) VALUES (?,?,?,?);";
                $param_type = "iiii";               
                $param_list = [
                    $pj_id,
                    $sender_id,
                    $recipient_id,
                    $status_key
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function discussion($pj_id,$adr_id,$suggestion){
        $sql = "INSERT INTO `discussion`(`pj_id`, `adr_id`, `suggestion`) VALUES (?,?,?);";
                $param_type = "iis";               
                $param_list = [
                    $pj_id,
                    $adr_id,
                    $suggestion
                ];      
                return $this->push_record($sql,$param_type,$param_list);
    }
    public function progress($o){
        $sql = "INSERT INTO `progress`(`pj_id`,`tsk_name`,`tsk_tname`,`tsk_desc`,`tsk_result`) VALUES (?,?,?,?,?);";
                 $param_type = "issss";               
                 $param_list = [
                     $o["pj_id"],
                     $o["name"],
                     $o["tname"],
                     $o["desc"],
                     $o["summary"]
                 ];      
                 return $this->push_record($sql,$param_type,$param_list);
    }
}
?>