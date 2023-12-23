<?php 
namespace pathFinder {
    class resource_url{
        public function make_avartar_url($unqid,$phone){   
            $dir_name = 'avartar_'.$unqid.'_'.$phone;
            $full_uri = '';
            mkdir('../store/managerAvartar/'.$dir_name,0777,true);
            $full_uri = '../store/managerAvartar/'.$dir_name.'/';
            return $full_uri;
        }
    }
}
?>