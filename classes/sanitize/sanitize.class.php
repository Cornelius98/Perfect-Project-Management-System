<?php
namespace SanitizeManager;
use DBTemplates\DBConnectionTemplate;
    function char_sanitize($input){
        $clean_word = trim($input);
        $clean_word = strtolower($clean_word);
        $clean_word = htmlentities($clean_word);
        $clean_word = htmlspecialchars($clean_word);
        $clean_word = stripslashes($clean_word);
        $clean_word = strip_tags($clean_word);
        $clean_word = $GLOBALS['zumDatabaseConnection']->real_escape_string($clean_word);
        return $clean_word;
    }
    class NameSanitizer extends DBConnectionTemplate
    {
        public function uniq_code(){
            $code = substr(random_int(1,PHP_INT_MAX),0,6);
            if(empty($code))
                return false; 
            else 
                return $code;
        }
        public function file_size($input){
            $song_bytes = char_sanitize($input);
            $kilo_byte = 1024;
            $byte = 1024;
            $song_kb = ($song_bytes/$kilo_byte);
            $song_mb = ($song_kb/$byte);
            $s_mb = round($song_mb,2);
            return $s_mb;
        }
        public function country_dial_code($code){
            if(preg_match("/^([+]|[-]|[^-+])*([\d]){1,5}$/",$code)){
                $cln_code = char_sanitize($code);
                return true;
            }
            else 
                return false;
        }
        public function country_code($input){
            if(preg_match("/^([a-zA-Z0-9]){1,8}$/",$input)){
                $cln_code = char_sanitize($input);
                return true;
            }
            else 
                return false;
        }
        public function youtube_link($url){
            if(preg_match("/^([a-z:\/\/]{8})([a-z]{3})[.]([a-z]{7})[.]([a-z]{3})[\/]([a-z]{5})[\/]([a-z0-9-_]*)$/mi",$url)){
                $cln_url = char_sanitize($url);
                return $cln_url;
            }
            else 
                return false;
        }
        public function search_term($search_term){
            $cleaned_search_term = 1;
            if(preg_match("/^[\w\s]*[0-9]*$/",$search_term)){
                $cleaned_search_term = char_sanitize($search_term);
                return $cleaned_search_term;
            }else 
                return $cleaned_search_term;
        }
        public function page_number_isInt($page){
            $nPage = 1;
            if(preg_match("/^[0-9]$/",$page)){
                $nPage = char_sanitize($page);
            }else $nPage = 1;
            return $nPage;
        }
        public function is_whole_int($input){
            $result = false;
            if(preg_match("/^[0-9]$/",$input))
                $result = char_sanitize($input);
            return $input;
        }
        public function script_name(){
            $arr = explode("/",$_SERVER['SCRIPT_NAME']);
            return end($arr);
        }
        public function code($code){
            if(preg_match("/^([0-9]{1,4})?$/",$code)){
                $cln_code = char_sanitize($code);
                return true;
            }
            else 
                return false;
        }
        public function param_code($code){
            $PHP_INT_MAX = random_int(PHP_INT_MAX,PHP_INT_MAX);
            if(preg_match("/^([0-9][1,$PHP_INT_MAX])?$/",$code)){
                return true;
            }
            else 
                return false;
                
        }
        public function param_code_int($code){
            $PHP_INT_MAX = random_int(PHP_INT_MAX,PHP_INT_MAX);
            if(preg_match("/^([0-9][1,$PHP_INT_MAX])?$/",$code)){
                return char_sanitize($code);
            }
            else 
                return false;
        }
        public function pure_int($code){
            $PHP_INT_MAX = random_int(PHP_INT_MAX,PHP_INT_MAX);
            if(preg_match("/^([0-9][1,$PHP_INT_MAX])?$/",$code)){
                return $code;
            }
            else 
                return false;
        }
        public function reset_code($code){
            if(preg_match("/^([0-9]{1,10})?$/",$code)){
                $cln_code = char_sanitize($code);
                return $cln_code;
            }
            else 
                return false;
        }
        public function students_allowed($input){
            if(preg_match("/^([0-9]{1,4})?$/",$input)){
                $cln_code = char_sanitize($input);
                return $cln_code;
            }
            else 
                return false;
        }
        public function minutes($input){
            if(preg_match("/^([\w\s])*$/",$input)){
                return char_sanitize($input);
            }
            else 
                return false;
        }
        public function change_file_name($dirt_name,$rand_id)
        {
            $arr = [];
            $file_name_arr = explode('.',$dirt_name);
            $file_name = $file_name_arr[0] = $rand_id.'.'.end($file_name_arr);
            $arr['file_name'] = $file_name;
            $arr['ext'] = end($file_name_arr);
            return $arr;
        }
        public function ref($dirty_ref)
        {
            if(preg_match("/^([a-zA-Z0-9]{4,10})?$/",$dirty_ref)){
                return char_sanitize($dirty_ref);
            }
            else 
                return false;
        }
        public function aprt_num($dirty_ref)
        {
            if(preg_match("/^([0-9]{1,6})?$/",$dirty_ref))
            {
                $cleaned_ref = char_sanitize($dirty_ref);
                return $cleaned_ref;
            }
            else 
                return false;
        }
        public function bh_name($dirty_name){
            if(preg_match("/^(\s*[a-zA-Z\_\-&]*\s*)*(\s*[a-zA-Z\_\-&]*\s*)*$/",$dirty_name)){
                return true;;
            }
            else 
                return false;
        }
        public function name($dirty_name){
            if(preg_match("/^(\s*[a-zA-Z\_\-&]*\s*)*(\s*[a-zA-Z\_\-&]*\s*)*$/",$dirty_name)){
                return char_sanitize($dirty_name);
            }
            else 
                return false;
        }
        public function artist_name($input_name){
            if(preg_match("/^(\s*[a-zA-Z0-9\_\-&,]*\s*)*(\s*[a-zA-Z0-9\_\-&,]*\s*)*$/",$input_name)){
                return char_sanitize($input_name);
            }
            else 
                return false;
        }
        public function single_name($name){
            if(preg_match("/^([a-zA-Z]{1})$/",$name)){
                return char_sanitize($name);
            }
            else 
                return false;
        }
        public function occupation($occupation){
            if(preg_match("/^[\w\s]{1,50}$/",$occupation)){
                return char_sanitize($occupation);
            }
            else 
                return false;
        }
        public function aka($name){
            if(preg_match("/^([a-zA-Z0-9\s-_]{1})$/",$name)){
                return char_sanitize($name);
            }
            else 
                return false;
        }
        public function package($input){
            if(preg_match("/^[\w]*$/",$input)){
                return char_sanitize($input);
            }
            else 
                return false;
        }
        public function reco($input){
            if(preg_match("/^[\w]{1}$/",$input)){
                return char_sanitize($input);
            }
            else 
                return false;
        }
        public function ssr($input){
            if(preg_match("/^([\w,\s])*$/",$input)){
                return char_sanitize($input);
            }
            else 
                return false;
        }
        public function space($input){
            if(preg_match("/^([0-9]{1,3})$/",$input)){
                return char_sanitize($input);
            }
            else 
                return false;
        }
        public function title($dirty_title_to_clean)
        {
            if(preg_match("/^(\s*[a-zA-Z\w\-\_]*\s*)*$/",$dirty_title_to_clean))
            {
                $cleaned_title = char_sanitize($dirty_title_to_clean);
                return $cleaned_title;
            }
            else 
                return false; 
        }
        public function genre($dirty_genre_name)
        {
            if(preg_match("/^(\s*[a-zA-Z]\s*)*(\s*[a-zA-Z]\s*)*$/",$dirty_genre_name))
            {
                $cleaned_genre_name = char_sanitize($dirty_genre_name);
                return $cleaned_genre_name;
            }
            else 
                return false;
        }
        public function gender($dirty_gender){
            if(preg_match("/^[\w]{1}$/",$dirty_gender)){
                return char_sanitize($dirty_gender);
            }
            else 
                return false;
        }
        public function validate_or_send_to_register_form($validate_test_to_check,$error_name){
            if($validate_test_to_check)
                return $validate_test_to_check;
            else
                header("Location: u_registration_iso.php?$error_name");
        }

        
    }
    class PasswordSanitize
    {
        public function password($input){
            if(preg_match("/^[\w]{3,20}$/",$input)){
                $password = char_sanitize($input);
                return true;
            }
            else
                return false;
        }
        public function clean_password($dirty_password){
            if(preg_match("/^[\w@,.$%^*\"\'~#?+=!]{3,20}$/",$dirty_password)){
                $cleaned_password = char_sanitize($dirty_password);
                return $cleaned_password;
            }
            else
                return false;
        }

        public function cypher_cleaned_password($unhashed_password)
        {   
            $this->clean_password($unhashed_password);
            $hashed_password = password_hash($unhashed_password,PASSWORD_DEFAULT);
            return $hashed_password;
        }
    }
    class NumberEmailSanitize 
    {
        public function email_address($input)
        {   if(preg_match("/^([\w])*([@]{1})([\w])*(([.])(\w)*)*$/",$input)){   
                return true;
            }
            else
                return false;
        }

        public function mobile_number($input){  
            if(preg_match("/^([+]|[-]|[^-+])*([\d]){10,13}$/",$input))
                return true;
            else
                return false;
        }
        public function solid_email_address($input){
            if(preg_match("/^([\w])*([@]{1})([\w])*(([.])(\w)*)*$/",$input))
                return char_sanitize($input);
            else
                return false;
        }

        public function solid_mobile_number($input){
            if(preg_match("/^([+]|[-]|[^-+])*([\d]){10,15}$/",$input)){
                return char_sanitize($input);
            }else{
                return false;
            }
        }

        public function account_number($input){
            if(preg_match("/^([+]|[-]|[^-+])*([\d]){10,30}$/",$input)){
                return char_sanitize($input);
            }else{
                return false;
            }
        }
    }
    class RecognizeNumberEmailSanitize extends NumberEmailSanitize 
    {   
        public function is_email_or_phone($email_or_phone)
        {   if($email = $this->solid_email_address($email_or_phone)){
                return $email;
            }
            else 
            {
                if($phone = $this->solid_mobile_number($email_or_phone)){   
                    return $phone;
                }
                else
                    return false;
            }
        }
    }
    class DescriptionSanitize
    {
        public function message($message){
            $message = char_sanitize($message);
            if(preg_match("/^([a-zA-Z\_!:;,()&%^£$`¬)(\/\|#?'\".0-9.](\s)*)*$/im",$message))
            {   $message = nl2br($message);
                return $message;
            }else 
                return false;
        }

        public function comment_from_database($word_to_remove_html_chars){
            $clean_word = ucwords($word_to_remove_html_chars);
            $clean_word = html_entity_decode($clean_word);
            $clean_word =  htmlspecialchars_decode($clean_word);
            return $clean_word;
        }
        public function description($input){
            if(preg_match("/^([\w,\s.])*$/",char_sanitize($input))){
                return ucwords(nl2br($input));
            }else 
                return false;
        }
        public function reason($input){
            if(preg_match("/^([\w])*$/",char_sanitize($input))){
                return ucwords(nl2br($input));
            }else 
                return false;
        }
    }
    class MonieSanitize 
    {   
        public function cash($dirty_money)
        {   if(preg_match("/^[A-Za-z0-9.]{1,6}$/",$dirty_money))
            {   $cleaned_money = char_sanitize($dirty_money);
                return $cleaned_money;
            }
            else
                return false;
        }
        public function flatten_number($number){
            $flat_num_value = null;
            $thousandFig = 1000;
            $millionFig = 1000000;
            $billionFig = 1000000000;
            $trillionFig =1000000000000;
            if(!is_nan($number)){
                if(($number>=1000) && ($number<$millionFig)){
                    $flat_num_value = round(($number/$thousandFig),1).'K';
                }elseif(($number>=$millionFig) && ($number<$billionFig)){
                    $flat_num_value = round(($number/$millionFig),1).'M';
                }elseif(($number>=$billionFig) && ($number<$trillionFig)){
                    $flat_num_value = round(($number/$billionFig),1).'B';
                }elseif($number>=$trillionFig){
                    $flat_num_value = round(($number/$trillionFig),1).'T';
                }else $flat_num_value = $number;
            }else $flat_num_value = "ERR_NAN";
            return $flat_num_value;
        }
    }
    class GeocoordSanitize {
        public function coords($coords){
            if(preg_match("/^([+]|[-]|[^-+])*([\d])$/",$coords)){
                return char_sanitize($coords);
            }
            else 
                return false;
        }
    }
?>

    