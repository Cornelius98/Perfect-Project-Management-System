<?php 
namespace path_finder {
    class resource_url {
        public function pavartar_url($rand_id,$code)
        {   $dir_name = $rand_id.'_'.$code;
            $full_url = null;
            mkdir('../eStore/avartars/partners/'.$dir_name,0777,true);
            $full_url = '../eStore/avartars/partners/'.$dir_name.'/';
            return $full_url;
        }
        public function make_store_uri($uploaded_file_name,$unique_folder)
        {
            $full_uri = '';
            $cleaned_file_name = explode('.',$uploaded_file_name);//explode into array
            $cleaned_file_name = str_ireplace('','_', $cleaned_file_name);
            mkdir('../store/audios/'.$cleaned_file_name[0].'_'.$unique_folder,0777,true);
            $full_uri = '../store/audios/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            return $full_uri;
        }
        public function make_beat_url($uploaded_file_name,$unique_folder)
        {
            $full_url = '';
            $cleaned_file_name = explode('.',$uploaded_file_name);//explode into array
            $cleaned_file_name = str_ireplace('','_', $cleaned_file_name);
            mkdir('../store/instruments/'.$cleaned_file_name[0].'_'.$unique_folder,0777,true);
            $full_url = '../store/instruments/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            return $full_url;
        }
        public function make_admin_store_icon_url($uploaded_file_name)
        {
            $full_uri = '';
            $cleaned_file_name = str_ireplace('','_',$uploaded_file_name);
            $unique_folder = uniqid();
            mkdir('../store/avartar_icons/admin/'.$cleaned_file_name.'_'.$unique_folder,0777,true);
            $full_uri = '../store/avartar_icons/admin/'.$cleaned_file_name.'_'.$unique_folder.'/';
            return $full_uri;

        }
        public function make_video_store_url($uploaded_file_name,$unique_folder)
        {
            $full_uri = '';
            $cleaned_file_name = explode('.',$uploaded_file_name);//explode into array
            $cleaned_file_name = str_ireplace('','_', $cleaned_file_name);
            mkdir('../store/videos/'.$cleaned_file_name[0].'_'.$unique_folder,0777,true);
            $full_url = '../store/videos/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            $db = './store/videos/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            $urls = Array(
                'save' =>$full_url,
                'db' =>$db
            );
            return $urls;
        }
        public function album_adest_url($album_title)
        {   
            $id = uniqid();
            $album = str_ireplace(" ",'_',$album_title);
            $dir_name = $album.'_'.$id;
            $full_uri = null;
            mkdir('../store/albums/'.$dir_name,0777,true);
            $file_url = '../store/albums/'.$dir_name.'/';
            return $file_url;
        }
        public function artist_icon_dest_url($artist_name,$rand_id)
        {  
            $artist_name = str_ireplace(" ","_",$artist_name);
            $dir_name = $artist_name.'_'.$rand_id;
            $full_uri = null;
            mkdir('../store/profiles/'.$dir_name,0777,true);
            $file_url = '../store/profiles/'.$dir_name.'/';
            $arr = array(
                'name' =>$dir_name,
                'file_url' =>$file_url
            );
            return $arr;
        }
        public function challenge_url($rand_id)
        {   $full_url= null;
            $dir_name = $rand_id;
            mkdir('../../../store/challenges/january/'.$dir_name,0777,true);
            $full_url = '../../../store/challenges/january/'.$dir_name.'/';
            return $full_url;
        }
        //eStore
        public function make_pstore_music_url($uploaded_file_name,$unique_folder){
            $full_url = "";
            $cleaned_file_name = explode('.',$uploaded_file_name);//explode into array
            $cleaned_file_name = str_ireplace('','_', $cleaned_file_name);
            mkdir('../store/partner/audio/'.$cleaned_file_name[0].'_'.$unique_folder,0777,true);
            $full_url = '../store/partner/audio/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            return $full_url;
        }
        public function make_pstore_vidoe_url($uploaded_file_name,$unique_folder){
            $full_url = "";
            $cleaned_file_name = explode('.',$uploaded_file_name);//explode into array
            $cleaned_file_name = str_ireplace('','_', $cleaned_file_name);
            mkdir('../store/partner/video/'.$cleaned_file_name[0].'_'.$unique_folder,0777,true);
            $full_url = '../store/partner/video/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            return $full_url;
        }
        //coupons 
        public function make_cstore_music_url($uploaded_file_name,$unique_folder){
            $full_url = "";
            $cleaned_file_name = explode('.',$uploaded_file_name);
            $cleaned_file_name = str_ireplace('','_', $cleaned_file_name);
            mkdir('../eStore/Coupon/audios/'.$cleaned_file_name[0].'_'.$unique_folder,0777,true);
            $full_url = '../eStore/Coupon/audios/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            return $full_url;
        }
        public function make_cstore_video_url($uploaded_file_name,$unique_folder){
            $full_url = "";
            $cleaned_file_name = explode('.',$uploaded_file_name);//explode into array
            $cleaned_file_name = str_ireplace('','_', $cleaned_file_name);
            mkdir('../eStore/Coupon/videos/'.$cleaned_file_name[0].'_'.$unique_folder,0777,true);
            $full_url = '../eStore/Coupon/videos/'.$cleaned_file_name[0].'_'.$unique_folder.'/';
            return $full_url;
        }

    }

}

?>