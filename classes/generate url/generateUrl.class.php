<?php 
    class GenerateURL{
        protected $_baseURL;
        protected function bhURL($URL,$FOLDER_NAME)
        {   $dir_name = str_ireplace("","_",$FOLDER_NAME);
            mkdir($URL.$dir_name,0777,true);
            $newDirURL = $URL.$dir_name.'/';
            return $newDirURL;
        }
        public function bh_file_url($URL,$FOLDER_NAME)
        {   $dir_name = str_ireplace("","_",$FOLDER_NAME);
            mkdir($URL.$dir_name,0777,true);
            $newDirURL = $URL.$dir_name.'/';
            return $newDirURL;
        }
    }
?>