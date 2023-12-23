<?php
require_once (dirname(__DIR__).'../sanitize/sanitize.class.php');
require_once (dirname(__DIR__).'../generate Url/generateUrl.class.php');
use SanitizeManager\NameSanitizer;
use SanitizeManager\RecognizeNumberEmailSanitize as contact;
use SanitizeManager\PasswordSanitize;

$clean_namer = new NameSanitizer();
$clean_password = new PasswordSanitize();
$clean_contact = new contact();
class FileUploadHandler extends GenerateURL
{
    private $_fileName;
    private $_fileTempName;
    private $_fileSize;
    private $_fileFormat;
    private $_numFiles;
    private $_destinationURL;
    private $_acceptedFormats;
    private $_fileArr;
    public function setName($FILE){
        $name = "MTK_CIMG_".random_int(0,PHP_INT_MAX).substr(time(),-4);
        $n = explode("/",$FILE['cover']['type']);
        $format = end($n);
        $imgNewName = $name.'.'.$format;
        $this->_fileName = $imgNewName;
        if(!empty($this->_fileName))
            return $this->_fileName;
        else
        {
            echo 'Err Upload: File Name Not Set';
            return false;
        }
    }
    public function updateFileName($newName){
        $this->_fileName = $newName;
        if(!empty($this->_fileName))
            return $this->_fileName;
        else{ return false; }
    }
    public function setSongName($o){
        $name  = null;
        if(in_array($o["pcc_id"],[1,2])){
            if(array_key_exists("featured_artist",$o) && $o['featured_artist']!=0)
                $name = $o['main_artist'].'_'.$o['title'].'_ft_'.$o['featured_artist'];
            else $name = $o['main_artist'].'_'.$o['title'];
        }else $name = $o['title'].'_'.$o['main_artist'].'_'.$o['rand_id'];
        $this->_fileName = str_ireplace(" ","_",strtolower($name));
        if(!empty($this->_fileName))
            return $this->_fileName;
        else
        {
            echo 'Err Upload: File Name Not Set';
            return false;
        }
    }
    public function getSongFileName($FILE){
        $n = explode("/",$FILE['type']);
        $format = end($n);
        $songNewName = $this->_fileName.'.'.$format;
        if(!empty($this->_fileName))
            return $songNewName;
        else
        {
            echo 'Err Upload: Song File Name Not Set';
            return false;
        }
    }
    public function getFileFormat($FILE){
        $n = explode("/",$FILE['type']);
        $format = end($n);
        return strtolower($format);
    }
    public function setTempName($tmpName){
        $this->_fileTempName = $tmpName;
        if(!empty($this->_fileTempName))
            return true;
        else
        {
            echo 'Err Upload: Temporary Name Not Set';
            return false;
        }
    }
    public function setMultiFilesArr($FILES){
        $this->_fileArr = $FILES;
        if(!empty($this->_fileArr) && $this->_numFiles>0)
            return true;
        else
        {
            echo 'Err Upload: Failed To Set Multiple Files';
            return false;
        }
    }
    public function setNumberFiles($FILE){
        $this->_numFiles = sizeof($FILE['avatar']['name']);
        if(!empty($this->_numFiles) && $this->_numFiles>0)
            return true;
        else
        {
            echo 'Err Upload: Number of Files';
            return false;
        }
    }
    public function setFormat($FILE,$FORMATS){
        $this->_acceptedFormats = $FORMATS;
        if(!empty($this->_acceptedFormats))
            return true;
        else
        {
            echo 'Err Upload: Unsupported File Format';
            return false;
        }
    }
    public function setUploadLocation($URL,$FOLDER_NAME){
        $this->_destinationURL = $this->bhURL($URL,$FOLDER_NAME);
        if(!empty($this->_destinationURL))
            return $this->_destinationURL;
        else
        {
            echo 'Err Upload: Upload Path';
            return false;
        }
    }
    public function updateUploadLocation($URL){
        $this->_destinationURL = $URL;
        if(!empty($this->_destinationURL))
            return $this->_destinationURL;
        else
        {
            echo 'Err Upload: Upload Path Failed to Update';
            return false;
        }
    }
    public function setSize($FILE){
        $this->_fileSize = $FILE['cover']['size'];
        if(!empty($this->_fileSize))
            return $this->_fileSize;
        else
        {
            echo 'Err Upload: Unsupported File Size';
            return false;
        }
    }
    public function checkSize($SIZE){
        if($this->_fileSize <= $SIZE)
            return true;
        else 
        {
            echo 'Err Upload: File Size Too Large';
            return false;
        }
    }
    public function compressImage($source, $destination,$quality) {
        $info = getimagesize($source);
        $image = null;
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
    
        if(imagejpeg($image,$destination,$quality))
            return true;
        else
            return false;
    }
    public function imageUpload(){
        $destination = $this->_destinationURL.$this->_fileName;
        $source = $this->_fileTempName;
        $quality = 75;
        if($this->compressImage($source,$destination,$quality))
            return true;
        else 
           return false;
    }
    public function songFileUpload(){
        $destination = $this->_destinationURL.$this->_fileName;
        $source = $this->_fileTempName;
        if(move_uploaded_file($source,$destination))
            return true; 
        else 
            return false;
    }
    private function preciseFileName($name,$FILES,$i){
        $type = explode("/",$FILES['files']['type'][$i]);
        $s_type = $type[1];
        if($s_type == "mpeg"){
            $format = "mp3";
            $s_name =  substr($name,0,strlen($name)-4);
        }elseif($s_type == "mp3") {
            $format = "mp3";
            $s_name = substr($name,0,strlen($name)-4);
        }else{
            $format = "mp4";
            $s_name = substr($name,0,strlen($name)-4);
        }
        $s_name = strtolower($s_name);
        return [
            "s_name"=>preg_replace("/[^A-Za-z0-9]/"," ",$s_name),
            "s_fname"=>$s_name,
            "s_format"=>$format
        ];
    }
    public function albumSongsUpload($o,$FILES,$ProductPush){
        $hash_id = $o["rand_id"];
        $i =0;
        $num_files = sizeof($FILES['files']['name']); 
        if($num_files>0){
            $max = $num_files-1;
            $redFlag = 0;
            $greenFlag = 0;
            for($i;$i<=$max;$i++){
                $name = $FILES['files']['name'][$i];
                $k = $this->preciseFileName($name,$FILES,$i);

                $o['s_title'] = $k["s_name"];
                $s_fname = $k["s_fname"].".".$k["s_format"];
                $size = $FILES['files']['size'][$i];
                $o['s_rand'] = $hash_id.substr(random_int(0,PHP_INT_MAX),0,4);
                $o['s_fname'] = $s_fname;
                $o['s_size'] = $size;
                if(move_uploaded_file($FILES['files']['tmp_name'][$i],$this->_destinationURL.$s_fname)){
                    if($ProductPush->album_songs($o))
                        $greenFlag+=1;
                    else 
                        $redFlag+=1;  
                }else 
                    $redFlag+=1;  
            }
            if($redFlag==0){
            return true;
            }else 
                return false;
        } else return false;
    }
    public function imagesUpload($FILES,$PROPS){

        $o = [];
        $a = [];
        $img =[];
        $a['imgURL'] = str_ireplace("../../../","./",$PROPS['uploadURL']);
        $a['activityID'] = $_COOKIE['activityID'];
        $i =0;
        $num_files = sizeof($FILES['cover']['name']); 
        $max = $num_files-1;
        for($i;$i<=$max;$i++)
        {
            $name = $FILES['cover']['name'][$i];
            array_push($img,$name);
            $source = $FILES['cover']['tmp_name'][$i];
            $size = $FILES['cover']['size'][$i];
            $destination = $PROPS['uploadURL'].$name;
            $quality = 75;
            $o['name'] = $name;
            $o['bid'] = $PROPS['BH_ID'];
            $o['d'] = date("d");
            $o['m'] = date("m");
            $o['y'] = date("Y");
            if($this->compressImage($source,$destination,$quality)){
                if($PROPS['ACCOMMODATIONHANDLER']->add_bh_pictures($o)){
                    if($i===$max){
                        $a['imgName'] = json_encode($img);
                        if($PROPS['ACCOMMODATIONACTIVITY']->register_uploaded_file_props($a))
                           return true;
                        else 
                            return false;
                    }
                }else 
                    return false;
            }
            else 
                return false;
        }
    }

    private function rename_img($FILES,$i){
        $name = "PMG_IMG_".random_int(0,PHP_INT_MAX).substr(time(),-4);
        $n = explode("/",$FILES['artwork']['type'][$i]);
        $format = end($n);
        $imgNewName = $name.'.'.$format;
        return $imgNewName;
    }
    public function imagesUploadForVehicle($FILES,$o,$ProductPush){
        $i =0;
        $count =0;
        $store_url = str_ireplace("./","../../../",$o["store_url"]);
        $num_files = sizeof($FILES['artwork']['name']);
        $max = $num_files-1;
        if($num_files>0){
            for($i;$i<=$max;$i++){
                $name = $this->rename_img($FILES,$i);
                $source = $FILES['artwork']['tmp_name'][$i];
                $size = $FILES['artwork']['size'][$i];
                $destination = $store_url.$name;
                $quality = 75;
                if($this->compressImage($source,$destination,$quality)){
                    if($ProductPush->product_images($o["p_id"],$name,$size,$o["d"],$o["m"],$o["y"])){
                       $count+=1;
                    } else continue;
                } else continue;
            }
            if($num_files === $count)
               return true;
            else return false;
        }
    }
    private function rename_files($FILES,$FILES_ARR,$FILES_KEY,$i){
        $generated_fname = "PMG_".$FILES_KEY."_".random_int(0,PHP_INT_MAX).substr(time(),-4);
        $n = explode("/",$FILES["$FILES_ARR"]['type'][$i]);
        $format = end($n);
        $new_fname = $generated_fname.'.'.$format;
        return $new_fname;
    }
    private function dbOperationPerUpload($DB_OPERATION_KEY,$o,$ProductPush,$name,$size,$source,$destination,$quality,$count_pictures,$count_documents,$count_files){
        switch($DB_OPERATION_KEY){
            case 1:
                if($this->compressImage($source,$destination,$quality)){
                    if($ProductPush->picture($o["pj_id"],$o["uni_id"],$name,$size))
                        $count_pictures+=1;
                }
                break;
            case 2:
                if(move_uploaded_file($source,$destination)){
                    if($ProductPush->document($o["pj_id"],$o["uni_id"],$name,$size))
                        $count_documents+=1;
                }
                break;
            case 3:
                if(move_uploaded_file($source,$destination)){
                    if($ProductPush->file($o["pj_id"],$o["uni_id"],$name,$size))
                        $count_files+=1;
                }
                break;
            default:
                header("location: ../../dashboards/administrator/create");
        }
    }
    public function filesPushRemote($FILES,$FILES_ARR,$FILES_KEY,$DB_OPERATION_KEY,$o,$ProductPush){
        $i =0;
        $count_pictures =0;
        $count_documents =0;
        $count_files =0;
        $store_url = str_ireplace("./","../../../",$o["store_url"]);
        $num_files = sizeof($FILES["$FILES_ARR"]['name']);
        $max = $num_files-1;
        if($num_files>0){
            for($i;$i<=$max;$i++){
                $name = $this->rename_files($FILES,$FILES_ARR,$FILES_KEY,$i);
                $source = $FILES["$FILES_ARR"]['tmp_name'][$i];
                $size = $FILES["$FILES_ARR"]['size'][$i];
                $destination = $store_url.$name;
                $quality = 75;
                $this->dbOperationPerUpload($DB_OPERATION_KEY,$o,$ProductPush,$name,$size,$source,$destination,$quality,$count_pictures,$count_documents,$count_files);
            }
            return true;
        }
    }
}
?>