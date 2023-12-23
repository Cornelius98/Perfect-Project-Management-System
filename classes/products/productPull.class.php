<?php 
namespace ProductManager;
use DBTemplates\DBConnectionTemplate;
class ProductPull extends DBConnectionTemplate{
  
    public function percent($numarator,$denominator){
        $adjust = ($numarator/$denominator)*100;
        return floor($adjust);
    }
    public function show_set($input){
        if(isset($input) && !empty($input))
            echo $input;
        else 
            echo 0;
    }
    public function get_projects($offset,$products_per_page){
        $sql ="SELECT * FROM `project`
                GROUP BY `project`.`pj_id` 
                ORDER BY `project`.`pj_id` DESC
                LIMIT $offset,$products_per_page;";
                return $this->fetch_records($sql);
    }
    public function get_projects_o($offset,$products_per_page,$adr_key){
        $sql ="SELECT *, COUNT(`pictures`.`pj_id`) AS `pictures_count`,
                COUNT(`documents`.`pj_id`) AS `documents_count`,
                COUNT(`files`.`pj_id`) AS `files_count`
                FROM `project`
                INNER JOIN `pictures`
                    ON `project`.`pj_id` = `pictures`.`pj_id`
                INNER JOIN `documents`
                    ON `project`.`pj_id` = `documents`.`pj_id`
                INNER JOIN `files`
                    ON `project`.`pj_id` = `files`.`pj_id`
                WHERE `project`.`adr_id` = ?
                ORDER BY `project`.`pj_id` DESC
                LIMIT $offset,$products_per_page;";
                $param_type = "i";
                $param_list = [
                   $adr_key
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);;
    }
    public function get_projects_oo($offset,$products_per_page,$adr_key){
        $sql ="SELECT * FROM `project`
                WHERE `project`.`adr_id` = ?
                ORDER BY `project`.`pj_id` DESC
                LIMIT $offset,$products_per_page;";
                $param_type = "i";
                $param_list = [
                   $adr_key
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);;
    }
    public function get_projects_discussed($offset,$products_per_page,$adr_id){
        $sql ="SELECT *, COUNT(`pictures`.`pj_id`) AS `pictures_count`,
                COUNT(`documents`.`pj_id`) AS `documents_count`,
                COUNT(`files`.`pj_id`) AS `files_count`
                FROM `project`
                INNER JOIN `pictures`
                        ON `project`.`pj_id` = `pictures`.`pj_id`
                INNER JOIN `documents`
                        ON `project`.`pj_id` = `documents`.`pj_id`
                INNER JOIN `files`
                        ON `project`.`pj_id` = `files`.`pj_id`
                INNER JOIN `discussion`
                        ON `project`.`pj_id` = `discussion`.`pj_id`
                WHERE `discussion`.`adr_id` = ?
                GROUP BY `project`.`pj_id` 
                ORDER BY `project`.`pj_id` DESC
                LIMIT $offset,$products_per_page;";
                $param_type = "i";
                $param_list = [
                  $adr_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_total_projects(){
        $sql ="SELECT COUNT(*) AS `total_projects` 
                FROM `project`
                ORDER BY `project`.`pj_id` DESC;";
                return $this->fetch_records($sql);
    }
    public function get_total_projects_o($adr_key){
        $sql ="SELECT COUNT(`project`.`pj_id`) AS `total_projects` 
                FROM `project`
                WHERE `project`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                   $adr_key
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_project($pj_id){
        $sql ="SELECT * FROM `project`
                WHERE `project`.`pj_id` = ?;";
                 $param_type = "i";
                 $param_list = [
                     $pj_id
                 ];
                 return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_pictures($pj_id,$offset,$products_per_page){
        $sql ="SELECT * FROM `project`
                INNER JOIN `pictures`
                        ON `project`.`pj_id` = `pictures`.`pj_id`
                WHERE `pictures`.`pj_id` = ?
                ORDER BY `pictures`.`pj_id` DESC
                LIMIT $offset,$products_per_page;";
                $param_type = "i";
                $param_list = [
                  $pj_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_documents($pj_id,$offset,$products_per_page){
        $sql ="SELECT * FROM `project`
                INNER JOIN `documents`
                        ON `project`.`pj_id` = `documents`.`pj_id`
                WHERE `documents`.`pj_id` = ?
                ORDER BY `documents`.`pj_id` DESC
                LIMIT $offset,$products_per_page;";
                 $param_type = "i";
                 $param_list = [
                     $pj_id
                 ];
                 return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_files($pj_id,$offset,$products_per_page){
        $sql ="SELECT * FROM `project`
                INNER JOIN `files`
                        ON `project`.`pj_id` = `files`.`pj_id`
                WHERE `files`.`pj_id` = ?
                ORDER BY `files`.`pj_id`
                LIMIT $offset,$products_per_page;";
                 $param_type = "i";
                 $param_list = [
                     $pj_id
                 ];
                 return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_pictures_o($pj_id){
        $sql ="SELECT * FROM `project`
                INNER JOIN `pictures`
                        ON `project`.`pj_id` = `pictures`.`pj_id`
                WHERE `pictures`.`pj_id` = ?
                ORDER BY `pictures`.`pj_id` DESC;";
                $param_type = "i";
                $param_list = [
                  $pj_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_documents_o($pj_id){
        $sql ="SELECT * FROM `project`
                INNER JOIN `documents`
                        ON `project`.`pj_id` = `documents`.`pj_id`
                WHERE `documents`.`pj_id` = ?
                ORDER BY `documents`.`pj_id` DESC;";
                 $param_type = "i";
                 $param_list = [
                     $pj_id
                 ];
                 return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_files_o($pj_id){
        $sql ="SELECT * FROM `project`
                INNER JOIN `files`
                        ON `project`.`pj_id` = `files`.`pj_id`
                WHERE `files`.`pj_id` = ?
                ORDER BY `files`.`pj_id`;";
                 $param_type = "i";
                 $param_list = [
                     $pj_id
                 ];
                 return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_total_pictures($gallery_type){
        $sql ="SELECT COUNT(*) AS `total_gallery` 
                FROM `pictures`
                WHERE `pictures`.`pj_id` =?;";
                $param_type = "i";
                $param_list = [
                    $gallery_type
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_total_documents($gallery_type){
        $sql ="SELECT COUNT(*) AS `total_gallery` 
                FROM `documents`
                WHERE `documents`.`pj_id` =?;";
                $param_type = "i";
                $param_list = [
                    $gallery_type
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_total_files($gallery_type){
        $sql ="SELECT COUNT(*) AS `total_gallery` 
                FROM `files`
                WHERE `files`.`pj_id` =?;";
                $param_type = "i";
                $param_list = [
                    $gallery_type
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_gallery_total($gallery_type){
        $gt = null;
        switch($gallery_type){
                case 1:
                   $gt = $this->get_total_pictures($gallery_type);
                   break;
                        
                case 2:
                   $gt = $this->get_total_documents($gallery_type);
                   break;

                case 3:
                   $gt = $this->get_total_files($gallery_type);
                   break;

                default:
                   $gt = $this->get_total_pictures($gallery_type);
                   break;
        }
        if(is_array($gt) && !empty($gt))
           return $gt;
        else return false;
    }
    public function get_gallery_files($gallery_type,$pj_id,$offset,$products_per_page){
        $o = null;
        switch($gallery_type){
                case 1:
                   $o = $this->get_pictures($pj_id,$offset,$products_per_page);
                   break;
                        
                case 2:
                   $o = $this->get_documents($pj_id,$offset,$products_per_page);
                   break;

                case 3:
                   $o = $this->get_files($pj_id,$offset,$products_per_page);
                   break;

                default:
                   $o = $this->get_pictures($pj_id,$offset,$products_per_page);
                   break;
        }
        if(is_array($o) && !empty($o))
           return $o;
        else return false;
    }
    public function get_invites_by_project($pj_id){
        $sql ="SELECT * FROM `invitations`
                WHERE `invitations`.`pj_id` = ?
                ORDER BY `invitations`.`pj_id` DESC;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function discussion($pj_id){
        $sql = "SELECT `advertiser`.`fname`,
                        `advertiser`.`sname`,
                        `discussion`.`dsc_id`,
                        `discussion`.`suggestion`,
                        `discussion`.`dsc_date`,
                        `discussion`.`dsc_time`
                FROM `advertiser`
                INNER JOIN `discussion`
                        ON `advertiser`.`adr_id` = `discussion`.`adr_id`
                WHERE `discussion`.`pj_id` = ?
                ORDER BY `discussion`.`dsc_id` ASC;";
                $param_type = "i";
                $param_list = [
                    $pj_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_share_categories(){
        $sql = "SELECT * FROM `share_category`
                ORDER BY `share_category`.`shc_id` ASC;";
                return $this->fetch_records($sql);
    }
    public function get_share_categories_o($pj_id){
        $sql = "SELECT *, COUNT(`shares`.`shc_id`) AS `total_shares` 
                FROM `share_category`
                INNER JOIN `shares`
                        ON `share_category`.`shc_id` = `shares`.`shc_id`
                WHERE `shares`.`pj_id` = ?
                GROUP BY `share_category`.`shc_id`
                ORDER BY `share_category`.`shc_id` ASC;";
                $param_type = "i";
                $param_list = [
                        $pj_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    private function __setBarCount($o){
        $num = 0;
        foreach ($o AS $z){
            if(is_array($z) && !empty($z)){
                if(array_key_exists("count",$z))
                    $num = $z["count"];
            }
        }
        return $num;
    }
    private function __setPieChartProjectsPjct($adr_key){
        $sql ="SELECT COUNT(`project`.`adr_id`)  AS `count`  
                FROM `project`
                WHERE `project`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_key
                ];
                $o = $this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    public function discussion_notlyfy($adr_id){
        $sql = "SELECT DISTINCT COUNT(`discussion`.`pj_id`) AS `count`
                FROM `discussion`
                WHERE `discussion`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                   $adr_id
                ];
                $o = $this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o);
    }
    public function invitation_received_notlyfy($adr_id){
        $sql = "SELECT DISTINCT COUNT(`invitations`.`recipient_id`) AS `count`
                FROM `invitations`
                WHERE `invitations`.`recipient_id` = ?;";
                $param_type = "i";
                $param_list = [
                   $adr_id
                ];
                $o = $this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o);
    }
    public function invitation_received_notlyfy_II($adr_id,$status){
        $sql = "SELECT DISTINCT COUNT(`invitations`.`recipient_id`) AS `count`
                FROM `invitations`
                WHERE `invitations`.`recipient_id` = ?
                    AND `invitations`.`status` = ?;";
                $param_type = "ii";
                $param_list = [
                   $adr_id,
                   $status
                ];
                $o = $this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o);
    }
    public function invitation_sent_notlyfy($adr_id){
        $sql = "SELECT DISTINCT COUNT(`invitations`.`sender_id`) AS `count`
                FROM `invitations`
                WHERE `invitations`.`sender_id` = ?;";
                $param_type = "i";
                $param_list = [
                   $adr_id
                ];
                $o = $this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o);
    }
    public function notifications($adr_id){
        $notify = [];
        $notify["discussions"] = $this->discussion_notlyfy($adr_id);
        $notify["invitationSent"] = $this->invitation_sent_notlyfy($adr_id);
        $notify["invitationReceived"] = $this->invitation_received_notlyfy_II($adr_id,1);
        $notify["projects"] = $this->__setPieChartProjectsPjct($adr_id);
        $notify["notifications"] = $this->discussion_notlyfy($adr_id) + $this->invitation_sent_notlyfy($adr_id) +$this->invitation_received_notlyfy_II($adr_id,1);
        return $notify;
    }
    public function invitation_received($adr_id,$status){
        $sql = "SELECT DISTINCT `project`.`name`,`invitations`.`inv_id`,
                        `invitations`.`sender_id`,`invitations`.`recipient_id`,
                        `invitations`.`status`
                FROM `invitations`
                INNER JOIN `project`
                   ON `invitations`.`recipient_id` = `project`.`adr_id`
                WHERE `invitations`.`recipient_id` = ? 
                        AND `invitations`.`status` = ?;";
                $param_type = "ii";
                $param_list = [
                   $adr_id,
                   $status
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function invitation_sent($adr_id){
        $sql = "SELECT DISTINCT `project`.`name`,`invitations`.`inv_id`,
                        `invitations`.`sender_id`,`invitations`.`recipient_id`,
                        `invitations`.`status`
                FROM `invitations`
                INNER JOIN `project`
                   ON `invitations`.`sender_id` = `project`.`adr_id`
                WHERE `invitations`.`sender_id` = ?;";
                $param_type = "i";
                $param_list = [
                   $adr_id
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_network($adr_id,$status){
        $sql ="SELECT DISTINCT `project`.`name`,`invitations`.`inv_id`,
                        `invitations`.`sender_id`,`invitations`.`recipient_id`,
                        `invitations`.`status`,`advertiser`.`fname`,`advertiser`.`sname`,
                        `invitations`.`inv_date`,`invitations`.`inv_time`
                FROM `invitations`
                INNER JOIN `project`
                        ON `invitations`.`sender_id` = `project`.`adr_id`
                INNER JOIN `advertiser`
                        ON `project`.`adr_id` = `advertiser`.`adr_id`
                WHERE (`invitations`.`sender_id` = ? OR `invitations`.`recipient_id` = ?)
                    AND `invitations`.`status` = ?;";
                $param_type = "iii";
                $param_list = [
                   $adr_id,
                   $adr_id,
                   $status
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);                     
    }
}
?>