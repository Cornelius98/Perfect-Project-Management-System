<?php
namespace DBTemplates;
require_once "config.class.php";
use initServers\initDatabase;
$initDatabase = new initDatabase();
$zumDatabaseConnection = $initDatabase->zumDBConnection();
class DBConnectionTemplate{
    private $oArr =[];
    public function fetch_records($sql){
        $o = [];
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($o,$row);
            }
            return $o;
        }
        else 
            return false;
        $stmt->close();
    }
    public function fetch_record($sql,$param_type,$param_arr,$param_list){
        $o = [];
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",$param_list);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            array_push($o,$row);
            return $o;
        }
        else 
            return false;
        $stmt->close();
    }
    public function fetch_record_II($sql,$param_type,$param_list){
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",...$param_list);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }
        else 
            return false;
        $stmt->close();
    }
    public function fetch_records_II($sql,$param_type,$param_list){
        $o =[];
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",...$param_list);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($this->oArr,$row);
            }
            return $this->oArr;
        }
        else 
            return false;
        $stmt->close();
    }
    public function fetch_bool($sql,$param_type,$param_list){
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",$param_list);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0)
            return true;
        else 
            return false;
        $stmt->close();
    }
    public function fetch_bool_II($sql,$param_type,$param_list){
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",...$param_list);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0)
            return true;
        else 
            return false;
        $stmt->close();
    }
    public function push_record($sql,$param_type,$param_list){
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",...$param_list);
        if($stmt->execute())
            return true;
        else 
            return false;
        $stmt->close();
    }
    public function push_record_get_id($sql,$param_type,$param_list){
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",...$param_list);
        if($stmt->execute())
            return $stmt->insert_id;
        else 
            return false;
        $stmt->close();
    }
    public function drop_record($sql,$param_type,$param_list){
        $stmt = $GLOBALS['zumDatabaseConnection']->prepare($sql);
        $stmt->bind_param("$param_type",...$param_list);
        if($stmt->execute())
            return true;
        else 
            return false;
        $stmt->close();
    }
}
?>
