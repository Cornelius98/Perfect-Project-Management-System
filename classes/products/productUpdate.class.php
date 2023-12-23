<?php 
namespace ProductManager;
use DBTemplates\DBConnectionTemplate;
class ProductUpdate extends DBConnectionTemplate{
    public function project($o){
        $sql = "UPDATE `project`
                SET `name` = ?, 
                    `tname` = ?, 
                    `desc` = ?, 
                    `summary` = ?, 
                    `aims` = ?, 
                    `objectives` = ?, 
                    `hypothesis` = ?, 
                    `conclusion` = ?, 
                    `sdate` = ?, 
                    `mdate` = ?, 
                    `cdate` = ?, 
                    `duration` = ?, 
                    `director` = ?, 
                    `manager` = ?, 
                    `supervisor` = ?, 
                    `wforce` = ?, 
                    `input` = ?, 
                    `yield` = ?, 
                    `proceeds` = ?, 
                    `losses` = ?, 
                    `sprocedures` = ?, 
                    `mprocedures` = ?, 
                    `yprocedures` = ?, 
                    `riskm` = ?, 
                    `d` = ?, 
                    `m` = ?,
                    `y` = ?
                WHERE `project`.`pj_id` = ?;";
                 $param_type = "ssssssssssssssssssssssssssss";               
                 $param_list = [
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
                     $o["y"],
                     $o["pj_id"]
                 ];      
                 return $this->push_record($sql,$param_type,$param_list);
    }
    public function close($o){
        $sql = "UPDATE `project`
                SET `mute` = ?
                WHERE `project`.`pj_id` = ?;";
                 $param_type = "ii";               
                 $param_list = [
                    $o["mute"],
                    $o["pj_id"]
                 ];      
                 return $this->push_record($sql,$param_type,$param_list);
    }
    public function accept_invite($o){
        $sql = "UPDATE `invitations`
                SET `status` = ?
                WHERE `invitations`.`inv_id` = ?;";
                 $param_type = "ii";               
                 $param_list = [
                    $o["status"],
                    $o["inv_id"]
                 ];      
                 return $this->push_record($sql,$param_type,$param_list);
    }
}
?>