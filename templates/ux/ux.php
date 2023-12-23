<?php 
namespace TemplateManager\UserTemplates;
use AccountsManager\UserAccountPull;
use ProductManager\ProductPull;
class UXTemplate extends UserAccountPull{
    public function nav(){
        $o =$this->get_world_locations();
        echo '<nav class="navbar navbar-expand-sm navbar-light">
                <div class="container">
                    <a href="index" class="navbar-brand">
                        <img src="./assets/favicon.png" alt="logo"/>
                    </a>
                    <div id="navbarCollapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a href="" class="nav-link">FOR PROJECTS</a></li>
                            <li class="nav-item"><a href="" class="nav-link">FOR MANAGERS</a></li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">USAGE</a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item">Individuals</a>
                                    <a href="" class="dropdown-item">Start-ups</a>
                                    <a href="" class="dropdown-item">Businesses</a>
                                    <a href="" class="dropdown-item">Enterprises</a>
                                    <a href="" class="dropdown-item">Companies</a>
                                    <a href="" class="dropdown-item">Governments</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">PRICING</a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item">Min: K100 - K200</a>
                                    <a href="" class="dropdown-item">Medium: K500 - K850</a>
                                    <a href="" class="dropdown-item">Standard: K1,000 - K1,500</a>
                                    <a href="" class="dropdown-item">Premium: K2,000 - K2,500</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">SECTORS</a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item">Education</a>
                                    <a href="" class="dropdown-item">Medicine</a>
                                    <a href="" class="dropdown-item">Agriculture</a>
                                    <a href="" class="dropdown-item">Legislation</a>
                                    <a href="" class="dropdown-item">Politics</a>
                                    <a href="" class="dropdown-item">Economics</a>
                                    <a href="" class="dropdown-item">IT And ICT</a>
                                    <a href="" class="dropdown-item">Technology</a>
                                    <a href="" class="dropdown-item">Science</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">EFFICIENCY</a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item">Collection</a>
                                    <a href="" class="dropdown-item">Organization</a>
                                    <a href="" class="dropdown-item">Sharing</a>
                                    <a href="" class="dropdown-item">Available 24/7</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">FEATURES</a>
                            <div class="dropdown-menu">
                                <a href="" class="dropdown-item">Quick creation</a>
                                <a href="" class="dropdown-item">Accuracy</a>
                                <a href="" class="dropdown-item">Optimization</a>
                                <a href="" class="dropdown-item">Storage</a>
                            </div>
                        </li>
                        </li>
                        </ul>
                    </div>
                    <button type="button" class="navbar-toggler" style="color:white;" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a data-toggle="modal" data-target="#quickSignupModal" class="btn btn-sm btn-primary motoka-nav-ads-btnlg"><strong>Sign Up</strong></a>
                </div>
            </nav>';
    }
    public function headers(){
        echo '<title>Pro Zambia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <link rel="icon" href="assets/favicon.png" type="image/png" size="16x16">
        <meta name="keywords" content="Project Manager Zambia | Project Manager | Project | Managers | Directors">
        <meta name="Author" content="Gift Sinyangwe">
        <meta name="Description" content="Project Manager For All Types Of Projects"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />        
        <link rel="stylesheet" type="text/css" href="./libraries/styles/css/app/anime.css">
        <link rel="stylesheet" type="text/css" href="./libraries/styles/css/app/home.gw.css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="./libraries/js/anime.js" type="text/javascript"></script>';
    }
    public function headers_footer(){
        echo '
            <script src="./libraries/js/app/utilsJQ.js"></script>
            <script src="./libraries/js/app/utils.js"></script>
            <script src="./libraries/js/anime.js" type="text/javascript"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>';
    }
}
?>