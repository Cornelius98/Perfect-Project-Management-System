<?php 
namespace UtilityManager;
use DBTemplates\DBConnectionTemplate;
class UtilityPull extends DBConnectionTemplate{
    public function pretty_print($input){
        echo "<pre>";
                print_r($input);
        echo "</pre>";
    }
    public function filesize_to_kb($bytes){
        $kb = $bytes/1024;
        return round(ceil($kb),2).'KB';
    }
    public function filesize_to_mb($bytes){
        $kb = $bytes/1024;
        $mb = $kb/1024;
        return round($mb,2).'MB';
    }
    public function discount($old_price,$new_price){
        $adjust = null;
        $sum = $old_price + $new_price;
        if($old_price>0){
             $adjust = ($new_price/$sum)*100;
        }else   
           $adjust = 0;
        return floor($adjust).'%';
    }
    public function discount_price($old_price,$new_price){
        $adjust = null;
        if($new_price<$old_price){
             $adjust = $old_price - $new_price;
        }else   
           $adjust = $new_price - $old_price;
        return $adjust;
    }
    public function cart_total_bought(){
        $amount = 0;
        foreach($_SESSION['cart']['items'] as $item){
            $amount = $amount + $item["price"];
        }
        return $amount;
    }
    public function get_cart_id(){
        $cartID = null;
        if(isset($_SESSION['cart']['BASKET']['id']) && !empty($_SESSION['cart']['BASKET']['id']))
            $cartID = $_SESSION['cart']['BASKET']['id'];
        else $cartID = 0;
        return $cartID;
    }
    public function clear_pending_purchase(){
        if(isset($_SESSION["cart"]["BASKET"]["pendingPurchase"]) && 
            is_array($_SESSION["cart"]["BASKET"]["pendingPurchase"]) && 
            !empty($_SESSION["cart"]["BASKET"]["pendingPurchase"]) && 
            ($_SESSION["cart"]["BASKET"]["pendingPurchase"]["status"]==200)){
                $amount = $_SESSION["cart"]["BASKET"]["pendingPurchase"]["amount"];
                $s_desc = $_SESSION["cart"]["BASKET"]["pendingPurchase"]["s_desc"];
                $ads_key = $_SESSION["cart"]["BASKET"]["pendingPurchase"]["adsKey"];
                $go = '../../libraries/payments/flutter/advertPayProcessor?c_back=6&&amount='.$amount.'&&s_desc='.$s_desc.'&&adsKey='.$ads_key;
                header("location:$go");
            }
    }
    public function broadcast_timezone(){
        date_default_timezone_set('Africa/Lusaka');
    }
    public function show_set($input){
        if(isset($input) && !empty($input))
            echo $input;
        else 
            echo 0;
    }
    public function int_get_param($get_param,$NameSanitizer,$err){
        if(isset($_GET["$get_param"])){
            if(!empty($_GET["$get_param"])){
                if($NameSanitizer->is_whole_int($_GET["$get_param"])){
                true;
                }else header("location:$err?err_get_param_not_int");
            }else header("location:$err?err_get_param_unset");  
        }    
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
    public function mobile_has_plus($number){
        if(preg_match("/^[+]$/",$number)){
            return $number;
        }
        else {
            $n = "+".$number;
            return str_ireplace(" ","",$n);
        }

    }
    public function gallery_name($gallery_type){
        $gallery_name = null;
        switch($gallery_type){
            case 1:
                $gallery_name = "Pictures";
                break;
            case 2:
                $gallery_name = "Documents";
                break;
            case 3:
                $gallery_name = "Files";
                break;
            default:
                $gallery_name = "Unknown";
                break;
        }
        return $gallery_name;
    }
}
?>