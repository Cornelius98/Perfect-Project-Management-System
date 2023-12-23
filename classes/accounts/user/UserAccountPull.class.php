<?php 
namespace AccountsManager;
use DBTemplates\DBConnectionTemplate;
class UserAccountPull extends DBConnectionTemplate{
    private function get_countries(){
        $sql ="SELECT `country`.`ctr_name`,`country`.`ctr_code`,
                        `country`.`ctr_id`,
                        `country`.`ctr_dial_code`
                FROM `country`
                ORDER BY `country`.`ctr_name` DESC;";
                return $this->fetch_records($sql);
    }
    private function get_country_states(){
        $sql ="SELECT `state`.`stt_name`,
                       `state`.`stt_id`,
                       `country`.`ctr_name`
                FROM `state`
                INNER JOIN `country`
                    ON `country`.`ctr_id` = `state`.`ctr_id`
                ORDER BY `country`.`ctr_id`;";
                return $this->fetch_records($sql);
    }
    private function get_country_districts(){
        $sql ="SELECT `district`.`dst_name`,
                       `district`.`dst_id`,
                       `state`.`stt_name`,
                       `state`.`stt_id`,
                       `country`.`ctr_name`,
                       `country`.`ctr_id`
                FROM `district`
                INNER JOIN `state`
                    ON `state`.`stt_id` = `district`.`stt_id`
                INNER JOIN `country`
                    ON `country`.`ctr_id` = `state`.`ctr_id`
                ORDER BY `state`.`stt_name` ASC;";
                return $this->fetch_records($sql);
    }
    public function get_eadvertplan_nonecommerce_id($plan_id){
        $sql ="SELECT * FROM `advert_package_plan`
                WHERE `advert_package_plan`.`pkg_id` = ?;";
                $param_type = "i";
                $param_arr = [$plan_id];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    private function get_mirror_account_routes_o(){
        $sql = "SELECT `advertiser`.`fname`,`advertiser`.`sname`,
                    `advertiser`.`adr_id`,`advertiser`.`rand_id`,
                    `advertiser`.`adr_code`
                FROM `advertiser` 
                ORDER BY `advertiser`.`adr_id` DESC;";
                return $this->fetch_records($sql);
    }
    public function get_manufacturers(){
        $sql ="SELECT * FROM `brand`
                ORDER BY `brand`.`b_id` ASC;";
                return $this->fetch_records($sql);
    }
    public function get_brands(){
        $sql ="SELECT * FROM `brand_genres`
                ORDER BY `brand_genres`.`bg_id` ASC;";
                return $this->fetch_records($sql);
    }
    private function get_fuels(){
        $sql ="SELECT * FROM `fuel_category`
                ORDER BY `fuel_category`.`fl_id` ASC;";
                return $this->fetch_records($sql);
    }
    private function get_designs(){
        $sql ="SELECT * FROM `design_category`
                ORDER BY `design_category`.`dsn_id` ASC;";
                return $this->fetch_records($sql);
    }
    private function get_wheels(){
        $sql ="SELECT * FROM `wheel_category`
                ORDER BY `wheel_category`.`whl_id` ASC;";
                return $this->fetch_records($sql);
    }
    private function get_transmissions(){
        $sql ="SELECT * FROM `transmission_category`
                ORDER BY `transmission_category`.`tms_id` ASC;";
                return $this->fetch_records($sql);
    }
    private function get_pricing(){
        $sql ="SELECT * FROM `pricing`
                ORDER BY `pricing`.`pr_id` ASC;";
                return $this->fetch_records($sql);
    }
    public function get_world_locations(){
        $o =[];
        $o['countries'] = $this->get_countries();
        $o['states'] = $this->get_country_states();
        $o['districts'] = $this->get_country_districts();
        $o['manufacturers'] = $this->get_manufacturers();
        $o['brands'] = $this->get_brands();
        $o['fuels'] = $this->get_fuels();
        $o['designs'] = $this->get_designs();
        $o['wheels'] = $this->get_wheels();
        $o['prices'] = $this->get_pricing();
        $o['transmissions'] = $this->get_transmissions();
        if(is_array($o) && !empty($o))
            return $o;
        else 
            return false;
    }
    public function does_email_exist($email_address){
        $unique_email_check = "SELECT * FROM `advertiser` WHERE `email` = ? ;";
        if($stmt = $GLOBALS['zumDatabaseConnection']->prepare($unique_email_check))
        {  $stmt->bind_param("s",$email_address);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
                return true;
            else 
                return false;
            $stmt->close();
        }
    }
    public function advertiser_exist($seck){
        $sql = "SELECT * FROM `advertiser` 
        WHERE `advertiser`.`adr_id` = ?;";
        $param_type = "i";
        $param_list = [
            $seck
        ];
        return $this->fetch_bool_II($sql,$param_type,$param_list);
    }
    public function does_phone_exist($phone_number){
        $sql = "SELECT * FROM `advertiser` 
                WHERE `adr_mobile` = ?;";
                $param_type = "s";
                $param_list = [$phone_number];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }                          
    public function get_with_email($email){
        $sql = "SELECT * FROM `advertiser` 
                WHERE `email` = ?;";
                $param_type = "s";
                $param_arr = [$email];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_with_mobile($phone_number){
        $sql = "SELECT * FROM `advertiser` 
                WHERE `adr_mobile` = ?;";
                $param_type = "s";
                $param_arr = [$phone_number];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_with_code($code){
        $sql = "SELECT * FROM `advertiser` 
                WHERE  `advertiser`.`adr_code` = ?;";
                $param_type = "s";
                $param_arr = [$code];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_with_otp($otp){
        $sql = "SELECT * FROM `advertiser` 
                WHERE `advertiser`.`email_vf` = ?;";
                $param_type = "i";
                $param_arr = [$otp];
                return $this->fetch_bool_II($sql,$param_type,$param_arr);
    }
    public function get_password_with_mobile($phone_number){
        $sql = "SELECT `adr_password` FROM `advertiser` 
                WHERE `adr_mobile` = ?;";
                $param_type = "s";
                $param_arr = [$phone_number];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_with_randid($rand){
        $sql = "SELECT * FROM `advertiser` 
                WHERE advertiser.`rand_id` = ?;";
                $param_type = "s";
                $param_arr = [$rand];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_with_id($id){
        $sql = "SELECT * FROM `advertiser` 
                WHERE advertiser.`adr_id` = ?;";
                $param_type = "s";
                $param_arr = [$id];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function get_advertiser_with_id($id){
        $sql = "SELECT * FROM `advertiser` 
                LEFT JOIN `gender_category` 
                    ON `advertiser`.`gndr_id` = `gender_category`.`gndr_id`
                LEFT JOIN `street` 
                    ON `advertiser`.`strt_id` = `street`.`strt_id`
                LEFT JOIN `district` 
                    ON `advertiser`.`dst_id` = `district`.`dst_id`
                LEFT JOIN `state` 
                    ON `advertiser`.`stt_id` = `state`.`stt_id` 
                LEFT JOIN `country` 
                    ON `advertiser`.`ctr_id` = `country`.`ctr_id`
                LEFT JOIN `advertiser_billing_details` 
                    ON `advertiser`.`adr_id` = `advertiser_billing_details`.`adr_id` 
                WHERE advertiser.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [$id];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_complete_with_id($id){
        $sql = "SELECT * FROM `advertiser` 
                INNER JOIN `gender_category` 
                    ON `advertiser`.`gndr_id` = `gender_category`.`gndr_id`
                INNER JOIN `street` 
                    ON `advertiser`.`strt_id` = `street`.`strt_id`
                INNER JOIN `district` 
                    ON `advertiser`.`dst_id` = `district`.`dst_id`
                INNER JOIN `state` 
                    ON `advertiser`.`stt_id` = `state`.`stt_id` 
                INNER JOIN `country` 
                    ON `advertiser`.`ctr_id` = `country`.`ctr_id`
                LEFT JOIN `advertiser_billing_details` 
                    ON `advertiser`.`adr_id` = `advertiser_billing_details`.`adr_id` 
                WHERE advertiser.`adr_id` = ?;";
                $param_type = "s";
                $param_arr = [$id];
                $o = $this->fetch_record_II($sql,$param_type,$param_arr);
                $o["adverts"]=$this->get_adverts_summary_with_id($id,2);
                return $o;
    }
    public function get_adverts_summary_with_id($adr_seck,$cli_cat){
        $sql = "SELECT `collection_category`.`pcc_id`,
                        `collection_category`.`pcc_name`,
                        COUNT(`product`.`pcc_id`) AS `pcc_sum`,
                        COUNT(`product`.`pcc_id`) AS `pcc_sum`
                FROM `product` 
                INNER JOIN `collection_category` 
                    ON `collection_category`.`pcc_id` = `product`.`pcc_id`
                WHERE `product`.`uni_id` = ? AND  `product`.`cli_id` = ?
                GROUP BY `collection_category`.`pcc_name`
                ORDER BY `collection_category`.`pcc_id`;";
                $param_type = "ii";
                $param_arr = [
                    $adr_seck,
                    $cli_cat
                ];
                return $this->fetch_records_II($sql,$param_type,$param_arr);
    }
    public function get_adverts_type_summary_with_id($adr_seck,$cli_cat,$collection_cat){
        $sql = "SELECT	`advert_package_plan`.`pkg_name`,
                        COUNT(`advert_package_plan`.`pkg_id`) AS `advert_pack_sum`
                FROM `product` 
                INNER JOIN `advert_package_plan` 
                    ON `advert_package_plan`.`pkg_id` = `product`.`pkg_id`
                WHERE `product`.`uni_id` = '$adr_seck'
                        AND  `product`.`cli_id` = '$cli_cat'
                        AND  `product`.`pcc_id` = ' $collection_cat'
                GROUP BY `advert_package_plan`.`pkg_name`
                ORDER BY `advert_package_plan`.`pkg_id`;";
                return $this->fetch_records($sql);
    }
    public function get_type_sales_summary($adr_seck,$cli_cat,$collection_cat){
        $sql = "SELECT `advert_package_plan`.`pkg_name`,
                    COUNT(`advert_package_plan`.`pkg_id`) AS `advert_pack_sum`,
                    SUM(`product`.`price`) AS `total_amount`
                FROM `product_order_items` 
                INNER JOIN `product_order` 
                    ON `product_order`.`o_id` = `product_order_items`.`o_id`
                INNER JOIN `product` 
                    ON `product`.`p_id` = `product_order_items`.`p_id`
                INNER JOIN `advert_package_plan` 
                    ON `advert_package_plan`.`pkg_id` = `product`.`pkg_id`   
                WHERE `product`.`uni_id` = '$adr_seck' 
                    AND `product`.`cli_id` = '$cli_cat' 
                    AND `product`.`pcc_id` = '$collection_cat'
                GROUP BY `advert_package_plan`.`pkg_name`;";
                return $this->fetch_records($sql);
    }
    public function get_adverts_type_accummulated_summary($adr_seck,$cli_cat){
        $sql = "SELECT	`advert_package_plan`.`pkg_name`,
                        COUNT(`advert_package_plan`.`pkg_id`) AS `advert_pack_sum`,
                        COUNT(`product`.`pcc_id`) AS `product_type`
                FROM `product` 
                INNER JOIN `advert_package_plan` 
                    ON `advert_package_plan`.`pkg_id` = `product`.`pkg_id`
                WHERE `product`.`uni_id` = ?
                        AND  `product`.`cli_id` = ?
                GROUP BY `advert_package_plan`.`pkg_name`
                ORDER BY `advert_package_plan`.`pkg_id`;";
                $param_type = "ii";
                $param_arr = [
                    $adr_seck,
                    $cli_cat
                ];
                return $this->fetch_records_II($sql,$param_type,$param_arr);
    }
    public function get_type_sales_accummulated_summary($adr_seck,$cli_cat){
        $sql = "SELECT `advert_package_plan`.`pkg_name`,
                    COUNT(`advert_package_plan`.`pkg_id`) AS `advert_pack_sum`,
                    SUM(`product`.`price`) AS `total_amount`
                FROM `product_order_items` 
                INNER JOIN `product_order` 
                    ON `product_order`.`o_id` = `product_order_items`.`o_id`
                INNER JOIN `product` 
                    ON `product`.`p_id` = `product_order_items`.`p_id`
                INNER JOIN `advert_package_plan` 
                    ON `advert_package_plan`.`pkg_id` = `product`.`pkg_id`   
                WHERE `product`.`uni_id` = '$adr_seck' 
                    AND `product`.`cli_id` = '$cli_cat' 
                GROUP BY `advert_package_plan`.`pkg_name`;";
                return $this->fetch_records($sql);
    }
    public function get_donors(){
        $sql = "SELECT `name` 
                FROM `donations`
                ORDER BY `dn_id` DESC;";
        return $this->fetch_records($sql);
    }
    public function get_lock_sys_attr(int $adrSeck){
        $sql = "SELECT  `advertiser`.`email_vf`, 
                        `advertiser`.`blln_vf`,
                        `advertiser`.`phone_vf`,
                        `advertiser`.`icon_vf`,
                        `advertiser`.`adr_block`,
                        `advertiser`.`adv_block`,
                        `advertiser`.`adr_apprvd`
                FROM `advertiser`
                WHERE `advertiser`.`adr_id` = ?;";
                $param_type = "i";
                $param_arr = [
                    $adrSeck
                ];
                return $this->fetch_record_II($sql,$param_type,$param_arr);
    }
    public function account_products($adrUniSeck){
        $sql = "SELECT * FROM `product` 
                WHERE `product`.`uni_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adrUniSeck
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function get_billing_details($adr_seck){
        $sql = "SELECT * FROM `advertiser_billing_details` 
                WHERE `advertiser_billing_details`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_seck
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function delete_avatar_change($adr_id){
        $sql = "DELETE FROM `advertiser_avartar_change` 
                WHERE `advertiser_avartar_change`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_billing_method_change($adr_id){
        $sql = "DELETE FROM `advertiser_billin_method_change` 
                WHERE `advertiser_billin_method_change`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_billing_name_change($adr_id){
        $sql = "DELETE FROM `advertiser_billin_name_change` 
                WHERE `advertiser_billin_name_change`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_billing_number_change($adr_id){
        $sql = "DELETE FROM `advertiser_billin_number_change` 
                WHERE `advertiser_billin_number_change`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_billing_details($adr_id){
        $sql = "DELETE FROM `advertiser_billing_details` 
                WHERE `advertiser_billing_details`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_order_billing($p_id){
        $sql = "DELETE FROM `product_order_billing` 
                WHERE `product_order_billing`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $p_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_device_change($adr_id){
        $sql = "DELETE FROM `advertiser_device_change` 
                WHERE `advertiser_device_change`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_password_change($adr_id){
        $sql = "DELETE FROM `advertiser_password_change` 
                WHERE `advertiser_password_change`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_account($adr_id){
        $sql = "DELETE FROM `advertiser` 
                WHERE `advertiser`.`adr_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_logins($adr_id){
        $sql = "DELETE FROM `logins` 
                WHERE `logins`.`uni_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_logouts($adr_id){
        $sql = "DELETE FROM `logouts` 
                WHERE `logouts`.`uni_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function delete_activity($adr_id){
        $sql = "DELETE FROM `activity` 
                WHERE `activity`.`uni_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $adr_id
                ];
                return $this->drop_record($sql,$param_type,$param_list);
    }
    public function get_user_ads_stats(){
        $o = [];
        $o["total_audio"] =0;
        $o["audio_sold"] =0;
        $o["audio_amount"] =0;
        $o["total_video"] =0;
        $o["video_sold"] =0;
        $o["video_amount"] =0;
        $o["total_album"] =0;
        $o["album_sold"] =0;
        $o["album_amount"] =0;
        $aSummary = $this->get_adverts_type_summary_with_id($_SESSION["uSessn"]["uSeck"],2,1);
        $aEcommerce = $this->get_type_sales_summary($_SESSION["uSessn"]["uSeck"],2,1);

        $vSummary = $this->get_adverts_type_summary_with_id($_SESSION["uSessn"]["uSeck"],2,2);
        $vEcommerce = $this->get_type_sales_summary($_SESSION["uSessn"]["uSeck"],2,2);

        $bSummary = $this->get_adverts_type_summary_with_id($_SESSION["uSessn"]["uSeck"],2,3);
        $bEcommerce = $this->get_type_sales_summary($_SESSION["uSessn"]["uSeck"],2,3);

        if(is_array($aSummary) && !empty($aSummary)) {
            foreach($aSummary AS $summary){
                $o["total_audio"] +=$summary["advert_pack_sum"];
            }
        }else $o["total_audio"] = 0.00;

        if(is_array($aEcommerce) && !empty($aEcommerce)) {
            foreach($aEcommerce AS $ecommerce){
                $o["audio_amount"] +=$ecommerce["total_amount"];
                $o["audio_sold"] +=$ecommerce["advert_pack_sum"];
            }
        }else $o["audio_amount"] = 0.00;

        if(is_array($vSummary) && !empty($vSummary)) {
            foreach($vSummary AS $summary){
                $o["total_video"] +=$summary["advert_pack_sum"];
            }
        }else $o["total_video"] = 0.00;

        if(is_array($vEcommerce) && !empty($vEcommerce)) {
            foreach($vEcommerce AS $ecommerce){
                $o["video_amount"] +=$ecommerce["total_amount"];
                $o["video_sold"] +=$ecommerce["advert_pack_sum"];
            }
        }else $o["video_amount"] = 0.00;

        if(is_array($bSummary) && !empty($bSummary)) {
            foreach($bSummary AS $summary){
                $o["total_album"] +=$summary["advert_pack_sum"];
            }
        }else $o["total_album"] = 0.00;

        if(is_array($bEcommerce) && !empty($bEcommerce)) {
            foreach($bEcommerce AS $ecommerce){
                $o["album_amount"] +=$ecommerce["total_amount"];
                $o["album_sold"] +=$ecommerce["advert_pack_sum"];
            }
        }else $o["album_amount"] = 0.00;
        $o["total_revenue"] = $o["audio_amount"]+$o["video_amount"]+$o["album_amount"];
        return $o;
    }
    public function get_user_products_views(){
        $sql = "SELECT COUNT(`product_views`.`p_id`) AS `total_views`
                FROM `product`
                INNER JOIN `product_views`
                    ON `product_views`.`p_id` = `product`.`p_id`
                WHERE `product`.`uni_id` = ? 
                    OR `product_views`.`uni_id`=?;";
                $param_type = "ii";
                $param_list = [
                    $_SESSION["uSessn"]["uSeck"],
                    $_SESSION["uSessn"]["uSeck"]
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_user_products_downloads(){
        $sql = "SELECT COUNT(`product_downloads`.`p_id`) AS `total_downloads`
                FROM `product`
                INNER JOIN `product_downloads`
                    ON `product_downloads`.`p_id` = `product`.`p_id`
                WHERE `product`.`uni_id` = ?
                    OR `product_downloads`.`uni_id`=?;";
                $param_type = "ii";
                $param_list = [
                    $_SESSION["uSessn"]["uSeck"],
                    $_SESSION["uSessn"]["uSeck"]
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_user_products_cart_entry(){
        $sql = "SELECT COUNT(`product_cart_entry`.`p_id`) AS `total_cart_entries`
                FROM `product`  
                INNER JOIN `product_cart_entry`
                    ON `product_cart_entry`.`p_id` = `product`.`p_id`
                WHERE `product`.`uni_id` = ?
                    OR `product_cart_entry`.`uni_id`=?;";
                $param_type = "ii";
                $param_list = [
                    $_SESSION["uSessn"]["uSeck"],
                    $_SESSION["uSessn"]["uSeck"]
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_user_products_cart_delete(){
        $sql = "SELECT COUNT(`product_cart_delete`.`p_id`) AS `total_cart_delete`
                FROM `product`  
                INNER JOIN `product_cart_delete`
                    ON `product_cart_delete`.`p_id` = `product`.`p_id`
                WHERE `product`.`uni_id` = ?
                    OR `product_cart_delete`.`uni_id`=?;";
                $param_type = "ii";
                $param_list = [
                    $_SESSION["uSessn"]["uSeck"],
                    $_SESSION["uSessn"]["uSeck"]
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_user_products_shares(){
        $sql = "SELECT COUNT(`product_shares`.`p_id`) AS `total_shares`
                FROM `product`
                INNER JOIN `product_shares`
                    ON `product_shares`.`p_id` = `product`.`p_id`
                WHERE `product`.`uni_id` = ?
                    OR `product_shares`.`uni_id`=?;";
                $param_type = "ii";
                $param_list = [
                    $_SESSION["uSessn"]["uSeck"],
                    $_SESSION["uSessn"]["uSeck"]
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_user_products_orders_stats(){
        $sql = "SELECT COUNT(`product_order_items`.`p_id`) AS `total_orders`
                FROM `product` 
                INNER JOIN `product_order_items`
                    ON `product_order_items`.`p_id` = `product`.`p_id`
                WHERE `product`.`uni_id` = ?;";
                $param_type = "i";
                $param_list = [
                    $_SESSION["uSessn"]["uSeck"]
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
    public function get_gw_interractions_stats(){
        $sql ="SELECT 
                        `media_type`.`pmc_id`,`media_type`.`pmc_name`,
                        (SELECT COUNT(`product_views`.`uni_id`) FROM `product_views`) AS `gw_views`,
                        (SELECT COUNT(`product_downloads`.`uni_id`) FROM `product_downloads`) AS `gw_downloads`,
                        (SELECT COUNT(`product_cart_entry`.`uni_id`) FROM `product_cart_entry`) AS `gw_cart_entry`,
                        (SELECT COUNT(`product_cart_delete`.`uni_id`) FROM `product_cart_delete`) AS `gw_cart_deletes`,
                        (SELECT COUNT(`product_shares`.`uni_id`) FROM `product_shares`) AS `gw_shares`,
                        (SELECT COUNT(`product_order_items`.`p_id`) FROM `product_order_items`) AS `gw_orders`
                FROM `product`
                        LEFT JOIN `media_type`
                                ON `media_type`.`pmc_id` = `product`.`pmc_id`
                        LEFT JOIN `product_views`
                                        ON `product_views`.`p_id` = `product`.`p_id`
                        LEFT JOIN `product_downloads`
                                        ON `product_downloads`.`p_id` = `product`.`p_id`
                        LEFT JOIN `product_cart_entry`
                                        ON `product_cart_entry`.`p_id` = `product`.`p_id`
                        LEFT JOIN `product_cart_delete`
                                        ON `product_cart_delete`.`p_id` = `product`.`p_id`
                        LEFT JOIN `product_shares`
                                        ON `product_shares`.`p_id` = `product`.`p_id`
                        LEFT JOIN `product_order_items`
                                        ON `product_order_items`.`p_id` = `product`.`p_id`
                GROUP BY `media_type`.`pmc_name`
                ORDER BY `media_type`.`pmc_id`
                LIMIT 1;";
                return $this->fetch_records($sql);
    }
    public function get_product_interractions_stats(){
        $shares = SELF::get_user_products_shares();
        $views = SELF::get_user_products_views();
        $downloads = SELF::get_user_products_downloads();
        $cart_entry = SELF::get_user_products_cart_entry();
        $cart_deletes = SELF::get_user_products_cart_delete();
        $orders = SELF::get_user_products_orders_stats();
        $o = [];
        $o['total_shares'] = $shares['total_shares'];
        $o['total_views'] = $views['total_views'];
        $o['total_downloads'] = $downloads['total_downloads'];
        $o['total_cart_entries'] = $cart_entry['total_cart_entries'];
        $o['total_cart_deletes'] = $cart_deletes['total_cart_delete'];
        $o['total_orders'] = $orders['total_orders'];
        return $o;
    }
    private function stats_percentage($numarator,$denominator){
        $result = "";
        if($denominator >0){
            $percent = ceil(($numarator/$denominator)* 100);
            $result = $percent.'%';
        }else { $result = "0%";}
        return $result;
    }
    public function user_adverts_interraction_statistics(){
        $gwStats = $this->get_gw_interractions_stats();
        $adStats = $this->get_product_interractions_stats();
        $o = [];
        $o["total_views"] = $adStats["total_views"];
        $o["total_shares"] = $adStats["total_shares"];
        $o["total_downloads"] = $adStats["total_downloads"];
        $o["total_cart_entries"] = $adStats["total_cart_entries"];
        $o["total_cart_deletes"] = $adStats["total_cart_deletes"];
        $o["total_cart_actions"] = ($adStats["total_cart_deletes"] + $adStats["total_cart_entries"]);
        $o["total_orders"] = $adStats["total_orders"];
        $o["views_percentile"] = $this->stats_percentage($adStats["total_views"],$gwStats[0]["gw_views"]);
        $o["share_percentile"] = $this->stats_percentage($adStats["total_shares"],$gwStats[0]["gw_shares"]);
        $o["download_percentile"] = $this->stats_percentage($adStats["total_downloads"],$gwStats[0]["gw_downloads"]);
        $o["cart_entry_percentile"] = $this->stats_percentage($adStats["total_cart_entries"],$gwStats[0]["gw_cart_entry"]);
        $o["cart_delete_percentile"] = $this->stats_percentage($adStats["total_cart_deletes"],$gwStats[0]["gw_cart_deletes"]);
        $o["order_percentile"] = $this->stats_percentage($adStats["total_orders"],$gwStats[0]["gw_orders"]);
        return $o;
    }
    public function user_product_sold_media_type(){
        $sql = "SELECT 
                    `media_type`.`pmc_id`,
                    `media_type`.`pmc_name`,
                    COUNT(`product`.`p_id`) AS `total_media`
                FROM `product_order_items`
                INNER JOIN `product` 
                    ON `product_order_items`.`p_id` = `product`.`p_id`
                LEFT JOIN `media_type`
                    ON `media_type`.`pmc_id` = `product`.`pmc_id`
                WHERE `product`.`uni_id` = ?
                GROUP BY `product`.`pcc_id`;";
                $param_type = "i";
                $param_list = [
                    $_SESSION["uSessn"]["uSeck"]
                ];
                return $this->fetch_records_II($sql,$param_type,$param_list);
    }
    public function user_product_sold_media_type_o(){
        $sql = "SELECT 
                    `media_type`.`pmc_id`,
                    `media_type`.`pmc_name`,
                    COUNT(`product`.`p_id`) AS `total_media`
                FROM `product_order_items`
                INNER JOIN `product` 
                    ON `product_order_items`.`p_id` = `product`.`p_id`
                LEFT JOIN `media_type`
                    ON `media_type`.`pmc_id` = `product`.`pmc_id`
                GROUP BY `product`.`pcc_id`;";
                return $this->fetch_records($sql);
    }
    public function user_product_media_type_percentile_sold(){
        $gwStats = $this->get_gw_interractions_stats();
        $adStats = $this->user_product_sold_media_type();
        $o = [];
        $o["audio_sales_percentile"] = $this->stats_percentage(!empty($adStats[0]["total_media"])?$adStats[0]["total_media"]:0,$gwStats[0]["gw_orders"]);
        $o["video_sales_percentile"] = $this->stats_percentage(!empty($adStats[1]["total_media"])?$adStats[0]["total_media"]:0,$gwStats[0]["gw_orders"]);
        $o["album_sales_percentile"] = $this->stats_percentage(!empty($adStats[2]["total_media"])?$adStats[0]["total_media"]:0,$gwStats[0]["gw_orders"]);
        return $o;
    }
    public function get_ads_graph_plotts(){
        $o = [];
        $o["graphXValues"] =[];
        $o["audioYValues"] =[];
        $o["videoYValues"] =[];
        $o["albumYValues"] =[];
        $o["estimatedMaxYCoord"] = 0;
        $sql = "SELECT 
                    `media_type`.`pmc_id`,`media_type`.`pmc_name`,
                    COUNT(`product`.`pcc_id`) as `collected_per_time`,`p_time`
                FROM `product`
                LEFT JOIN `media_type`
                    ON `media_type`.`pmc_id` = `product`.`pmc_id`
                GROUP BY SECOND(`product`.`p_time`);";
                $graphCoords = $this->fetch_records($sql);
                if(count($graphCoords)>0){
                    foreach($graphCoords AS $coords){
                        array_push($o["graphXValues"],date("H:m A",strtotime($coords["p_time"])));
                        switch($coords["pmc_id"]){
                            case 1:
                                array_push($o["audioYValues"],$coords["collected_per_time"]);
                                break;
                            case 2:
                                array_push($o["videoYValues"],$coords["collected_per_time"]);
                                break;
                            case 3:
                                array_push($o["albumYValues"],$coords["collected_per_time"]);
                                break;
                        }
                    }
                    $result = array_merge($o["audioYValues"],$o["videoYValues"],$o["albumYValues"]);
                    sort($result,SORT_ASC);
                    if(count($result)>0){
                        $o["estimatedMaxYCoord"] = end($result);
                    }
                }
                return $o;
    }
    public function get_mirror_account_route_o($adr_seck){
        $sql = "SELECT `advertiser`.`fname`,`advertiser`.`sname`,
                    `advertiser`.`adr_id`,`advertiser`.`rand_id`,
                    `advertiser`.`adr_code`,`advertiser`.`email`,
                    `advertiser`.`adr_mobile`,
                    `advertiser`.`phone_vf`,
                    `advertiser`.`email_vf`,
                    `advertiser`.`adv_block`,
                    `advertiser`.`adr_block`,
                    `advertiser`.`masterblock`
                FROM `advertiser` 
                WHERE `adr_id` = ?;";
                $param_type = "i";
                $param_list= [
                    $adr_seck
                ];
                return $this->fetch_record_II($sql,$param_type,$param_list);
    }
}
?>