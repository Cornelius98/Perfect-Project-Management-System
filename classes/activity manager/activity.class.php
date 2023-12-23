<?php 
namespace ActivityManager{ 
    use AccountsManager\UserAccountPull;
    use DBTemplates\DBConnectionTemplate;
    $DBConnectionTemplate = new DBConnectionTemplate();
    class Activity extends UserAccountPull
    {
        protected $_aID;
        protected $_uID;
        protected $_sessnID;
        protected $_device;
        protected $_actnName;
        protected $_scrName;
        protected $_scrURL;
        protected $_uploadPermit;
        protected $_fileName;
        protected $_fileURL;
        protected $_day;
        protected $_month;
        protected $_year;
        protected $_ip;
        private function global_activity_registry(){
            $_SESSION['GlobalActivityRegistry'] = [
                'user'=> [
                    'home.php'=>[
                        'action'=>'User Dashboard home',
                        'is_uploading'=>0
                    ],
                    'advertise_audio.php'=>[
                        'action'=>'User Audio Music Upload Dashboard',
                        'is_uploading'=>1
                    ],
                    'advertised_audio.php'=>[
                        'action'=>'User Preview Uploaded Audio Music',
                        'is_uploading'=>1
                    ],
                    'advertise_video.php'=>[
                        'action'=>'User Video Music Upload Dashboard',
                        'is_uploading'=>1
                    ],
                    'advertised_video.php'=>[
                        'action'=>'User Preview Uploaded Video Music',
                        'is_uploading'=>1
                    ],
                    'advertise_album.php'=>[
                        'action'=>'User Album Upload Dashboard',
                        'is_uploading'=>1
                    ],
                    'advertised_album.php'=>[
                        'action'=>'User Album Uploaded',
                        'is_uploading'=>1
                    ],
                    'advert_edit.php'=>[
                        'action'=>'User Advert Edit',
                        'is_uploading'=>0
                    ],
                    'advert_package_change.php'=>[
                        'action'=>'User Advert Package Change',
                        'is_uploading'=>0
                    ],
                    'logout.php'=>[
                        'action'=>'User Logout',
                        'is_uploading'=>0
                    ],
                    'profile.php'=>[
                        'action'=>'User Profile',
                        'is_uploading'=>0
                    ],
                    'billing_details_commit.php'=>[
                        'action'=>'User Adding Billing Details',
                        'is_uploading'=>0
                    ],
                    'password_change.php'=>[
                        'action'=>'User Password Change',
                        'is_uploading'=>0
                    ],
                    'phone_verify.php'=>[
                        'action'=>'User Phone Number Verification',
                        'is_uploading'=>0
                    ],
                    'email_verify.php'=>[
                        'action'=>'User Email Verification',
                        'is_uploading'=>0
                    ],
                    'adverts.php'=>[
                        'action'=>'User Preview All Adverts',
                        'is_uploading'=>0
                    ],
                    'sales_audio.php'=>[
                        'action'=>'User Audio Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'sales_video.php'=>[
                        'action'=>'User Video Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'sales_album.php'=>[
                        'action'=>'User Album Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'auth_billing.php'=>[
                        'action'=>'User Billing Information Authentication',
                        'is_uploading'=>0
                    ],
                    'mw_auth_billing_skip.php'=>[
                        'action'=>'User Billing Information Authentication Skip',
                        'is_uploading'=>0
                    ],
                    'mw_auth_billing.php'=>[
                        'action'=>'User Billing Information Authentication For E-commerce Users',
                        'is_uploading'=>0
                    ],
                    'auth_email.php'=>[
                        'action'=>'User Email Authentication',
                        'is_uploading'=>0
                    ],
                    'mw_auth_email_confirm.php'=>[
                        'action'=>'User Email OTP Authentication',
                        'is_uploading'=>0
                    ],
                    'mw_auth_email.php'=>[
                        'action'=>'User Email Authentication Middleware',
                        'is_uploading'=>0
                    ],
                    'userAccountPermissivefilters.php'=>[
                        'action'=>'User Authentication Before Going To Dashboard Home',
                        'is_uploading'=>0
                    ],
                    'mw_forgot_password.php'=>[
                        'action'=>'User Authenticate Forgot Password',
                        'is_uploading'=>0
                    ],
                    'mw_reset_forgot_password.php'=>[
                        'action'=>'User Change New Password Once Forgot Password',
                        'is_uploading'=>0
                    ],
                    'mw_banks.php'=>[
                        'action'=>'User Billing Information Authentication, Fetch Banks',
                        'is_uploading'=>0
                    ],
                    'print_master.php'=>[
                        'action'=>'User Information Print master: sales receipts, summaries and any other',
                        'is_uploading'=>0
                    ],
                    'sales_audio_accummulated.php'=>[
                        'action'=>'User All Adverts Accummulated Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'my_orders.php'=>[
                        'action'=>'User All Orders, Purchased Adverts.Dowload bought adverts from here',
                        'is_uploading'=>0
                    ],
                    'order_items.php'=>[
                        'action'=>'User Order Items',
                        'is_uploading'=>0
                    ],
                    'order_items_album.php'=>[
                        'action'=>'User Order Album Songs',
                        'is_uploading'=>0
                    ],
                    'advert_consumers.php'=>[
                        'action'=>'Advertiser Advert Consumers',
                        'is_uploading'=>0
                    ],
                    'adjust_ads_price.php'=>[
                        'action'=>'Advertiser Adjust E-commerce Advert Price ',
                        'is_uploading'=>0
                    ],
                    'mw_price_change.php'=>[
                        'action'=>'Advertiser Adjust E-commerce Advert Price Middleware',
                        'is_uploading'=>0
                    ],
                    'mw_advert_publicity.php'=>[
                        'action'=>'Advertiser Adjust Advert Publicity',
                        'is_uploading'=>0
                    ],
                    'name_change.php'=>[
                        'action'=>'Advertiser Add Middle Name',
                        'is_uploading'=>0
                    ],
                    'mw_name_change.php'=>[
                        'action'=>'Advertiser Add Middle Name Middleware',
                        'is_uploading'=>0
                    ],
                    'account_closure.php'=>[
                        'action'=>'Advertiser Close Or Delete Account Choice',
                        'is_uploading'=>0
                    ],
                    'auth_billing_update.php'=>[
                        'action'=>'Advertiser Update Billing Details',
                        'is_uploading'=>0
                    ],
                    'mw_auth_billing_update.php'=>[
                        'action'=>'Advertiser Update Billing Details Middleware',
                        'is_uploading'=>0
                    ],
                    'mw_ads_graph_coords.php'=>[
                        'action'=>'Advertiser Fetch User Graph data',
                        'is_uploading'=>0
                    ],
                    'advertPayProcessor.php'=>[
                        'action'=>'Advertiser Payment Processor',
                        'is_uploading'=>0
                    ],
                    'advertPayEventListener.php'=>[
                        'action'=>'Advertiser Payment Processor Event Listener',
                        'is_uploading'=>0
                    ],
                    'unpublished.php'=>[
                        'action'=>'Advertiser Unpublished And Expired Adverts',
                        'is_uploading'=>0
                    ]
                ],
                'administrator' => [
                    'home.php'=>[
                        'action'=>'Administrator Dashboard home',
                        'is_uploading'=>0
                    ],'logout.php'=>[
                        'action'=>'Administrator Logout',
                        'is_uploading'=>0
                    ],
                    'profile.php'=>[
                        'action'=>'Administrator Profile',
                        'is_uploading'=>0
                    ],
                    'password_change.php'=>[
                        'action'=>'Administrator Mirror User Password Change',
                        'is_uploading'=>0
                    ],
                    'email_verify.php'=>[
                        'action'=>'Administrator Email Verification',
                        'is_uploading'=>0
                    ],
                    'adverts.php'=>[
                        'action'=>'Administrator Preview All Adverts',
                        'is_uploading'=>0
                    ],
                    'AdministratorAccountPermissivefilters.php'=>[
                        'action'=>'Administrator Authentication Before Going To Dashboard Home',
                        'is_uploading'=>0
                    ],
                    'mw_forgot_password.php'=>[
                        'action'=>'Administrator Authenticate Forgot Password',
                        'is_uploading'=>0
                    ],
                    'mw_reset_forgot_password.php'=>[
                        'action'=>'Administrator Change New Password Once Forgot Password',
                        'is_uploading'=>0
                    ],
                    'mw_banks.php'=>[
                        'action'=>'Administrator Billing Information Authentication, Fetch Banks',
                        'is_uploading'=>0
                    ],
                    'print_master.php'=>[
                        'action'=>'Administrator Information Print master: sales receipts, summaries and any other',
                        'is_uploading'=>0
                    ],
                    'sales_audio_accummulated.php'=>[
                        'action'=>'Administrator All Adverts Accummulated Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'mirror_my_orders.php'=>[
                        'action'=>'Administrator Mirror User All Orders, Purchased Adverts.Dowload bought adverts from here',
                        'is_uploading'=>0
                    ],
                    'mirror_order_items.php'=>[
                        'action'=>'Mirror Administrator Order Items',
                        'is_uploading'=>0
                    ],
                    'mirror_order_items_album.php'=>[
                        'action'=>'Administrator Order Album Songs',
                        'is_uploading'=>0
                    ],
                    'advert_consumers.php'=>[
                        'action'=>'Administrator Advert Consumers',
                        'is_uploading'=>0
                    ],
                    'mirror_advert_consumers.php'=>[
                        'action'=>'Administrator Mirror User Advert Consumers',
                        'is_uploading'=>0
                    ],
                    'adjust_ads_price.php'=>[
                        'action'=>'Administrator Adjust E-commerce Advert Price ',
                        'is_uploading'=>0
                    ],
                    'mirror_adjust_ads_price.php'=>[
                        'action'=>'Administrator Mirror User Adjust E-commerce Advert Price ',
                        'is_uploading'=>0
                    ],
                    'mw_price_change.php'=>[
                        'action'=>'Administrator Adjust E-commerce Advert Price Middleware',
                        'is_uploading'=>0
                    ],
                    'mw_mirror_price_change.php'=>[
                        'action'=>'Administrator Mirror User Adjust E-commerce Advert Price Middleware',
                        'is_uploading'=>0
                    ],
                    'mw_advert_publicity.php'=>[
                        'action'=>'Administrator Adjust Advert Publicity',
                        'is_uploading'=>0
                    ],
                    'name_change.php'=>[
                        'action'=>'Administrator Add Middle Name',
                        'is_uploading'=>0
                    ],
                    'mw_name_change.php'=>[
                        'action'=>'Administrator Add Middle Name Middleware',
                        'is_uploading'=>0
                    ],
                    'account_closure.php'=>[
                        'action'=>'Administrator Close Or Delete Account Choice',
                        'is_uploading'=>0
                    ],
                    'mirror_account_closure.php'=>[
                        'action'=>'Administrator Mirror User Account Close Or Delete Choice',
                        'is_uploading'=>0
                    ],
                    'auth_billing_update.php'=>[
                        'action'=>'Administrator Update Billing Details',
                        'is_uploading'=>0
                    ],
                    'mirror_auth_billing_update.php'=>[
                        'action'=>'Administrator Mirror User Update Billing Details',
                        'is_uploading'=>0
                    ],
                    'mw_auth_billing_update.php'=>[
                        'action'=>'Administrator Update Billing Details Middleware',
                        'is_uploading'=>0
                    ],
                    'mw_ads_graph_coords.php'=>[
                        'action'=>'Administrator Fetch Administrator Graph data',
                        'is_uploading'=>0
                    ],
                    'advertPayProcessor.php'=>[
                        'action'=>'Administrator Payment Processor',
                        'is_uploading'=>0
                    ],
                    'advertPayEventListener.php'=>[
                        'action'=>'Administrator Payment Processor Event Listener',
                        'is_uploading'=>0
                    ],
                    'unpublished.php'=>[
                        'action'=>'Administrator Unpublished And Expired Adverts',
                        'is_uploading'=>0
                    ],
                    'accountPermissivefilters.php'=>[
                        'action'=>'Administrator Verify And Sign In Account',
                        'is_uploading'=>0
                    ],
                    'users.php'=>[
                        'action'=>'Administrator View Users',
                        'is_uploading'=>0
                    ],
                    'user_menu.php'=>[
                        'action'=>'Administrator Users\'s Menu',
                        'is_uploading'=>0
                    ],
                    'mirror_sales_audio.php'=>[
                        'action'=>'Administrator Mirror User Audio Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'mirror_sales_video.php'=>[
                        'action'=>'Administrator Mirror User Video Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'mirror_sales_album.php'=>[
                        'action'=>'Administrator Mirror User Album Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'mirror_sales_audio_accummulated.php'=>[
                        'action'=>'Administrator Mirror User Accummulated Sales Statistics',
                        'is_uploading'=>0
                    ],
                    'mw_block_account_advertising.php'=>[
                        'action'=>'Administrator Block Advertising For User Mirror Account',
                        'is_uploading'=>0
                    ],
                    'mw_block_account_loggins.php'=>[
                        'action'=>'Administrator Block Advertiser Loggins For User Mirror Account',
                        'is_uploading'=>0
                    ],
                    'mw_close_account.php'=>[
                        'action'=>'Administrator Close Advertiser Account',
                        'is_uploading'=>0
                    ],
                    'mw_mirror_close_account.php'=>[
                        'action'=>'Administrator Mirror User Close Advertiser Account',
                        'is_uploading'=>0
                    ],
                    'mw_delete_account.php'=>[
                        'action'=>'Administrator Delete Advertiser Account',
                        'is_uploading'=>0
                    ],
                    'mw_mirror_delete_account.php'=>[
                        'action'=>'Administrator Mirror User Delete Advertiser Account',
                        'is_uploading'=>0
                    ],
                    'mirror_unpublished.php'=>[
                        'action'=>'Administrator Mirror Advertiser Unpublished',
                        'is_uploading'=>0
                    ],

                    'manufacturer.php'=>[
                        'action'=>'Administrator Add Manufacturer Name',
                        'is_uploading'=>0
                    ],
                    'manufacturer.php'=>[
                        'action'=>'Administrator Add Manufacturer Name',
                        'is_uploading'=>0
                    ],
                    'mw_manufacturer_push.php'=>[
                        'action'=>'Administrator Add Manufacturer Name Middleware',
                        'is_uploading'=>0
                    ],
                    'brand.php'=>[
                        'action'=>'Administrator Add Brand Name',
                        'is_uploading'=>0
                    ],
                    'mw_brand_push.php'=>[
                        'action'=>'Administrator Add Brand Name Middleware',
                        'is_uploading'=>0
                    ],
                    'advertised_vehicle.php'=>[
                        'action'=>'Administrator All Advertised Vehicles',
                        'is_uploading'=>0
                    ],
                    'create.php'=>[
                        'action'=>'Create Project',
                        'is_uploading'=>1
                    ],
                    'projects.php'=>[
                        'action'=>'Display Created Projects',
                        'is_uploading'=>0
                    ],
                    'project.php'=>[
                        'action'=>'Preview Project',
                        'is_uploading'=>0
                    ],
                    'gallery.php'=>[
                        'action'=>'Preview Project Pictures, Documents And Files',
                        'is_uploading'=>0
                    ],
                    'progress.php'=>[
                        'action'=>'Record Project Progress',
                        'is_uploading'=>0
                    ],
                    'project_edit.php'=>[
                        'action'=>'Edit Pushed Project',
                        'is_uploading'=>0
                    ],
                    'project_new_files.php'=>[
                        'action'=>'Project Add New Files',
                        'is_uploading'=>0
                    ],
                    'invite.php'=>[
                        'action'=>'Project Select Invite',
                        'is_uploading'=>0
                    ],
                    'discuss.php'=>[
                        'action'=>'Project Discussion Room',
                        'is_uploading'=>0
                    ],
                    'share.php'=>[
                        'action'=>'Share Project',
                        'is_uploading'=>0
                    ],
                    'pdfGenerate.php'=>[
                        'action'=>'Generate Reports',
                        'is_uploading'=>0
                    ],
                    'invited.php'=>[
                        'action'=>'User Invitations To Projects',
                        'is_uploading'=>0
                    ],
                    'inviting.php'=>[
                        'action'=>'User Invitations Fo Project Participants Sent',
                        'is_uploading'=>0
                    ],
                    'notifications.php'=>[
                        'action'=>'Notifications Previews',
                        'is_uploading'=>0
                    ],
                    'discussed.php'=>[
                        'action'=>'Display Projects Discussed',
                        'is_uploading'=>0
                    ],
                    'activities.php'=>[
                        'action'=>'Display Project Activities',
                        'is_uploading'=>0
                    ],
                    'network.php'=>[
                        'action'=>'Display People Who Accepted Invites',
                        'is_uploading'=>0
                    ],
                    'settings.php'=>[
                        'action'=>'Display Account Settings',
                        'is_uploading'=>0
                    ],
                    'settings_timeline.php'=>[
                        'action'=>'Display Account Timeline',
                        'is_uploading'=>0
                    ],
                    'settings_password.php'=>[
                        'action'=>'Change Account Password',
                        'is_uploading'=>0
                    ]
                ],
                'app' => []
            ];
        }
        public function get_script_name(){
            $false = 'unknown';
            $scriptArr = explode("/",$_SERVER['SCRIPT_NAME']);
            $script_name = end($scriptArr);
            if(!empty($script_name))
                return $script_name;
            else 
                return $false;
        }
        private function activity_owner_user(){
            $script_name = $this->get_script_name();
            $ActivityRegister = [
                'cli_id' => 2,
                'u_id' => !empty($_SESSION['uSessn']['uSeck'])? $_SESSION['uSessn']['uSeck']: 0,
                's_id' => session_id(),
                'scr_name' => $script_name,
                'scr_url' => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
                'actn_name' =>$_SESSION['GlobalActivityRegistry']['user'][$script_name]['action'],
                'upld_permt' =>$_SESSION['GlobalActivityRegistry']['user'][$script_name]['is_uploading'],
                'f_url' => 0,
                'f_name' => 0,
                'd' => date("d"),
                'm' => date("m"),
                'y' => date("Y")
            ];
            return $ActivityRegister;
        }
        private function activity_owner_admin(){
            $script_name = $this->get_script_name();
            $ActivityRegister = [
                'cli_id' => 1,
                'u_id' => !empty($_SESSION['aSessn']['aSeck'])? $_SESSION['aSessn']['aSeck']: 0,
                's_id' => session_id(),
                'scr_name' => $script_name,
                'scr_url' => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
                'actn_name' =>$_SESSION['GlobalActivityRegistry']['administrator'][$script_name]['action'],
                'upld_permt' =>$_SESSION['GlobalActivityRegistry']['administrator'][$script_name]['is_uploading'],
                'f_url' => 0,
                'f_name' => 0,
                'd' => date("d"),
                'm' => date("m"),
                'y' => date("Y")
            ];
            return $ActivityRegister;
        }
        private function activity_owner_guest(){
            $script_name = $this->get_script_name();
            $ActivityRegister = [
                'scpt_name' => $script_name,
                'pg_url' => 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
                'actn_name' =>$_SESSION['GlobalActivityRegistry'][$script_name]['name'],
                'upld_permt' =>$_SESSION['GlobalActivityRegistry'][$script_name]['is_uploading'],
                'f_url' => 0,
                'f_name' => 0,
                'd' => date("d"),
                'm' => date("m"),
                'y' => date("Y")
            ];
            return $ActivityRegister;
        }
        public function owner(){
            $this->global_activity_registry();
            if(isset($_SESSION['GlobalActivityRegistry']))
                return $this->activity_owner_user();
            else 
                return false;
        }
        public function aOwner(){
            $this->global_activity_registry();
            if(isset($_SESSION['GlobalActivityRegistry']))
                return $this->activity_owner_admin();
            else 
                return false;
        }
        public function init_guest_activity(){
            $this->global_activity_registry();
            if(isset($_SESSION['GlobalActivityRegistry']))
                return $this->activity_owner_guest();
            else 
                return false;
        }
        protected function set_activity($o){
            $this->_aID = $o['data']['activityOwner']['a_id'];
            $this->_uID =$o['data']['activityOwner']['u_id'];
            $this->_sessnID = $o['data']['activityOwner']['s_id'];
            $this->_device = json_encode($o['data']['device']);
            $this->_actnName = $o['data']['activityOwner']['actn_name'];
            $this->_scrName = $o['data']['activityOwner']['scpt_name'];
            $this->_scrURL = $o['data']['activityOwner']['pg_url'];
            $this->_uploadPermit = $o['data']['activityOwner']['upld_permt'];
            $this->_fileName = $o['data']['activityOwner']['f_name'];
            $this->_fileURL = $o['data']['activityOwner']['f_url'];
            $this->_day = $o['data']['activityOwner']['d'];
            $this->_month = $o['data']['activityOwner']['m'];
            $this->_year = $o['data']['activityOwner']['y'];
            if(!empty($this->_aID) && !empty($this->_year))
                return true;
            else 
                return false;
        }
        public function client_ip(){
            $ip = null;
             if(!empty($_SERVER['REMOTE_ADDR']))
                $ip = $_SERVER['REMOTE_ADDR'];
             elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
             elseif(!empty($_SERVER['HTTP_CLIENT_IP']))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
             else 
                $ip = 'unknown';
            return $ip;
        }

    }
    class User extends Activity{
        public function register_users_activity(){
            $o = $this->owner();
            $sql = "INSERT INTO `activity`(`cli_id`,`uni_id`,`sesn_id`,`device`,
                                            `actn_name`,`scr_name`,`scr_url`,
                                            `upload_prmssn`,`f_name`,`f_url`,
                                            `actvt_d`,`actvt_m`,`actvt_y`
                                        )VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";
            $param_type = "iisssssissiii";
            $param_list = [   
                $o["cli_id"],
                $o["u_id"],
                $o["s_id"],
                $o["device"] =0,
                $o["actn_name"],
                $o["scr_name"],
                $o["scr_url"],
                $o["upld_permt"],
                $o["f_name"],
                $o["f_url"],
                $o["d"],
                $o["m"],
                $o["y"]
            ];
            return $GLOBALS['DBConnectionTemplate']->push_record($sql,$param_type,$param_list);
        }
        public function script_name(){
            $scripts = explode("/",$_SERVER['SCRIPT_NAME']);
            $arr = explode(".",end($scripts));
            return $arr[0];
        }
    }
    class Administrator extends Activity{
        public function register_activity(){
            $o = $this->aOwner();
            $sql = "INSERT INTO `activity`(`cli_id`,`uni_id`,`sesn_id`,`device`,
                                            `actn_name`,`scr_name`,`scr_url`,
                                            `upload_prmssn`,`f_name`,`f_url`,
                                            `actvt_d`,`actvt_m`,`actvt_y`
                                        )VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";
            $param_type = "iisssssissiii";
            $param_list = [   
                $o["cli_id"],
                $o["u_id"],
                $o["s_id"],
                $o["device"] =0,
                $o["actn_name"],
                $o["scr_name"],
                $o["scr_url"],
                $o["upld_permt"],
                $o["f_name"],
                $o["f_url"],
                $o["d"],
                $o["m"],
                $o["y"]
            ];
            return $GLOBALS['DBConnectionTemplate']->push_record($sql,$param_type,$param_list);
        }
        public function script_name(){
            $scripts = explode("/",$_SERVER['SCRIPT_NAME']);
            $arr = explode(".",end($scripts));
            return $arr[0];
        }
    }
}
?>