<?php 
namespace GraphSimulationManager;
use DBTemplates\DBConnectionTemplate;
class GraphSimulator extends DBConnectionTemplate{
    private $_yPlaneCoords = 8000;
    private $_obtCoords = [];
    private $_projectCoords = [];
    private $_pieChart =[];
    private $_barFsResultsCount =0;
    private $_barGraphCoords = [];

    private function __obtCoords($o,$col_key){
        if(is_array($o) && !empty($o)){
            $this->_obtCoords = array_column($o,$col_key);
        }else $this->_obtCoords = 0;
        return $this->_obtCoords;
    }
    private function __obtCoords_high_scale($o,$col_key){
        if(is_array($o) && !empty($o)){
            $q = array_column($o,$col_key);
            foreach($q as $k) 
                array_push($this->_obtCoords,str_replace(":",".",$k));
        }else $this->_obtCoords = 0;
        return $this->_obtCoords;
    }
    private function __obtCoords_high($o,$col_key){
        $arr = [];
        if(is_array($o) && !empty($o)){
            $q = array_column($o,$col_key);
            foreach($q as $k){
                array_push( $arr,str_ireplace(":",".",substr($k,0,5)));
            }
        }else  $arr = 0;
        return  $arr;
    }
    private function __setProjectCoords($adr_key){
        $sql ="SELECT * FROM `project`
        WHERE `project`.`adr_id` = ?;";
         $param_type = "i";
         $param_list = [
            $adr_key
        ];
        $o =$this->fetch_records_II($sql,$param_type,$param_list);
        return $this->__obtCoords_high($o,"p_time");
    }   
    private function __setProjectCoordsX(){
        $sql ="SELECT DISTINCT * FROM `project`
        ORDER BY `project`.`p_time`;";
        $o =$this->fetch_records($sql);
        return $this->__obtCoords_high($o,"p_time");
    }   
    private function __setInvitationCoords($adr_key){
        $sql ="SELECT DISTINCT * FROM `invitations`
        WHERE `invitations`.`recipient_id` = ?
            OR `invitations`.`sender_id` = ?;";
         $param_type = "ii";
         $param_list = [
            $adr_key,
            $adr_key
        ];
        $o =$this->fetch_records_II($sql,$param_type,$param_list);
        return $this->__obtCoords_high($o,"inv_time");
    }
    private function __setDiscussionCoords($adr_key){
        $sql ="SELECT DISTINCT * FROM `discussion`
        WHERE `discussion`.`adr_id` = ?;";
         $param_type = "i";
         $param_list = [
            $adr_key
        ];
        $o =$this->fetch_records_II($sql,$param_type,$param_list);
        return $this->__obtCoords_high($o,"dsc_time");
    }
    public function projectGraphCoords($adr_key){
        $this->_projectCoords["yPlaneCoords"] = $this->_yPlaneCoords;
        $this->_projectCoords["xPlaneCoords"] = $this->__setProjectCoordsX();
        $this->_projectCoords["projectCoords"] = $this->__setProjectCoords($adr_key);
        $this->_projectCoords["invitationCoords"] = $this->__setInvitationCoords($adr_key);
        $this->_projectCoords["discussionCoords"] = $this-> __setDiscussionCoords($adr_key);
        return $this->_projectCoords;
    }
    private function __setBarCountArrs($o){
        $num = 0;
        if(is_array($o) && !empty($o)){
            $num = sizeof($o);
        }
        return $num;
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
    private function __setBarGraphFilesCountAll(){
        $sql ="SELECT * FROM `files`;";
        $o = $this->fetch_records($sql);
        return $this->__setBarCountArrs($o); 
    }
    private function __setBarGraphDocumentsCountAll(){
        $sql ="SELECT * FROM `documents`;";
        $o = $this->fetch_records($sql);
        return $this->__setBarCountArrs($o);   
    }
    private function __setBarGraphPicturesCountAll(){
        $sql ="SELECT * FROM `pictures`;";
        $o = $this->fetch_records($sql);
        return $this->__setBarCountArrs($o);   
    }
    private function _setBarTotalGraphs(){
        $this->_barFsResultsCount += $this->__setBarGraphPicturesCountAll();
        $this->_barFsResultsCount += $this->__setBarGraphDocumentsCountAll();
        $this->_barFsResultsCount += $this->__setBarGraphFilesCountAll();
        return $this->_barFsResultsCount;
    }
    private function __setBarGraphFilesPcjt($adr_key){
        $sql ="SELECT COUNT(`files`.`adr_id`) AS `count` 
                FROM `files`
                WHERE `files`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_key
                ];
                $o =$this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    public function __setBarGraphDocumentsPjct($adr_key){
        $sql ="SELECT COUNT(`documents`.`adr_id`) AS `count` 
                FROM `documents`
                WHERE `documents`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_key
                ];
                $o = $this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    private function __setBarGraphPicturesPjct($adr_key){
        $sql ="SELECT COUNT(`pictures`.`adr_id`)  AS `count`  
                FROM `pictures`
                WHERE `pictures`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_key
                ];
                $o =$this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    public function barGraphCoords($adr_key){
        $this->_barGraphCoords["totalBarFiles"] = $this->_setBarTotalGraphs();
        $this->_barGraphCoords["barDocuments"] = $this->__setBarGraphDocumentsPjct($adr_key);
        $this->_barGraphCoords["barPictures"] = $this->__setBarGraphPicturesPjct($adr_key);
        $this->_barGraphCoords["barFiles"] = $this->__setBarGraphFilesPcjt($adr_key);
        return $this->_barGraphCoords;
    }
    private function __setPieChartProjectsCountAll(){
        $sql ="SELECT COUNT(*) AS `count` 
                FROM `project`;";
                $o =$this->fetch_records($sql);
                return $this->__setBarCount($o);
    }
    private function __setPieChartProjectsPjct($adr_key){
        $sql ="SELECT COUNT(`project`.`adr_id`)  AS `count`  
                FROM `project`
                WHERE `project`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_key
                ];
                $o =$this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    private function __setPieChartActivityCountAll(){
        $sql ="SELECT COUNT(*)  AS `count` 
                FROM `activity`;";
                $o =$this->fetch_records($sql);
                return $this->__setBarCount($o);
    }
    private function __setPieChartActivityPjct($adr_key){
        $sql ="SELECT COUNT(`activity`.`uni_id`)  AS `count`  
                FROM `activity`
                WHERE `activity`.`uni_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_key
                ];
                $o =$this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    public function pieChart($adr_key){
        $this->_pieChart["totalProjects"] = $this->__setPieChartProjectsCountAll();
        $this->_pieChart["mineProjects"] = $this->__setPieChartProjectsPjct($adr_key);
        $this->_pieChart["otherProjects"] = ($this->__setPieChartProjectsCountAll() - $this->__setPieChartProjectsPjct($adr_key));
        $this->_pieChart["totalActivity"] = $this->__setPieChartActivityCountAll();
        $this->_pieChart["mineActivity"] = $this->__setPieChartActivityPjct($adr_key);
        $this->_pieChart["otherActivity"] = ($this->__setPieChartActivityCountAll() - $this->__setPieChartActivityPjct($adr_key));
        return $this->_pieChart;
    }
    private function __setInvitationCoordsPjctAlone($pj_key){
        $sql ="SELECT * FROM `invitations`
        WHERE `invitations`.`pj_id` = ?";
         $param_type = "i";
         $param_list = [
            $pj_key
        ];
        $o =$this->fetch_records_II($sql,$param_type,$param_list);
        return $this->__obtCoords_high($o,"inv_time");
    }
    private function __setDiscussionCoordsPjctAlone($pj_key){
        $sql ="SELECT * FROM `discussion`
        WHERE `discussion`.`pj_id` = ?;";
         $param_type = "i";
         $param_list = [
            $pj_key
        ];
        $o =$this->fetch_records_II($sql,$param_type,$param_list);
        return $this->__obtCoords($o,"dsc_time");
    }
    private function __setViewsCoordsPjctAlone($pj_key){
        $sql ="SELECT DISTINCT * FROM `views`
        WHERE `views`.`pj_id` = ?;";
         $param_type = "i";
         $param_list = [
            $pj_key
        ];
        $o =$this->fetch_records_II($sql,$param_type,$param_list);
        return $this->__obtCoords_high($o,"pv_time");
    }
    public function projectGraphCoordsPjctAlone($pj_key){
        $this->_projectCoords["xPlaneCoords"] = $this->__setProjectCoordsX();
        $this->_projectCoords["invitationCoords"] = $this->__setInvitationCoordsPjctAlone($pj_key);
        $this->_projectCoords["discussionCoords"] = $this->__setDiscussionCoordsPjctAlone($pj_key);
        $this->_projectCoords["viewsCoords"] = $this->__setViewsCoordsPjctAlone($pj_key);
        return $this->_projectCoords;
    }
    private function __setBarGraphFilesPcjtAlone($pj_key){
        $sql ="SELECT COUNT(`files`.`pj_id`) AS `count` 
                FROM `files`
                WHERE `files`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_key
                ];
                $o =$this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    public function __setBarGraphDocumentsPjctAlone($pj_key){
        $sql ="SELECT COUNT(`documents`.`pj_id`) AS `count` 
                FROM `documents`
                WHERE `documents`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_key
                ];
                $o = $this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    private function __setBarGraphPicturesPjctAlone($pj_key){
        $sql ="SELECT COUNT(`pictures`.`pj_id`) AS `count`  
                FROM `pictures`
                WHERE `pictures`.`pj_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $pj_key
                ];
                $o =$this->fetch_records_II($sql,$param_type,$param_list);
                return $this->__setBarCount($o); 
    }
    public function barGraphCoordsAlone($pj_key){
        $this->_barGraphCoords["totalBarFiles"] = $this->_setBarTotalGraphs();
        $this->_barGraphCoords["barDocuments"] = $this->__setBarGraphDocumentsPjctAlone($pj_key);
        $this->_barGraphCoords["barPictures"] = $this->__setBarGraphPicturesPjctAlone($pj_key);
        $this->_barGraphCoords["barFiles"] = $this->__setBarGraphFilesPcjtAlone($pj_key);
        return $this->_barGraphCoords;
    }
}
?>