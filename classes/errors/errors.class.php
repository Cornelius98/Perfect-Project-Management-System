<?php 
namespace ErrorManager;
    class AdministratorErros 
    {
        public function error($ref,$Comment)
        {
            if(isset($_GET["$ref"]))
                echo "<br><div class='e-notice h-error'><strong>$Comment</strong></div></br>";
        }
        public function erro_n($ref,$Comment)
        {
            if(isset($_GET["$ref"]))
                echo "<span class='e-noticed'><strong>$Comment</strong></span>";
        }
    }
    class AdvertiserErros 
    {
        public function error($ref,$Comment)
        {
            if(isset($_GET["$ref"]))
                echo "<br><div class='e-notice h-error'><strong>$Comment</strong></div></br>";
        }
        public function erro_n($ref,$Comment)
        {
            if(isset($_GET["$ref"]))
                echo "<div class='e-noticed'><strong>$Comment</strong></div>";
        }
        public function error_s($ref,$Comment)
        {
            if(isset($_GET["$ref"]))
                echo "<div class='e-success'>$Comment</div>";

        }
    }
?>

