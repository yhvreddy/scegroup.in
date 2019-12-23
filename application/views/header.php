<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$page_title?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?=base_url()?>assets/images/favicon.png" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="<?=base_url()?>assets/vendors/animate/animate.css" rel="stylesheet">
    <!-- Icon CSS-->
	<link rel="stylesheet" href="<?=base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- Camera Slider -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendors/camera-slider/camera.css">
    <!-- Owlcarousel CSS-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/vendors/owl_carousel/owl.carousel.css" media="all">
    <!--Theme Styles CSS-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css" media="all" />
    <!-- jQuery JS -->
    <script src="<?=base_url()?>assets/js/jquery-1.12.0.min.js"></script>

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Preloader -->
    <div class="preloader"></div>

	<!-- Top Header_Area -->
	<section class="top_header_area">
	    <div class="container">
            <ul class="nav navbar-nav top_nav">
                <li><a href="#"><i class="fa fa-phone"></i>+91 9876543210</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i>info@scegroup.in</a></li>
                <li><a href="#"><i class="fa fa-clock-o"></i>Mon - Sat 09:00 AM - 06:00 PM</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right social_nav">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul>
	    </div>
	</section>
	<!-- End Top Header_Area -->

	<!-- Header_Area -->
    <nav class="navbar navbar-default header_aera" id="main_navbar">
        <div class="container">
            <!-- searchForm -->
            <!-- <div class="searchForm">
                <form action="#" class="row m0">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="search" name="search" class="form-control" placeholder="Type & Hit Enter">
                        <span class="input-group-addon form_hide"><i class="fa fa-times"></i></span>
                    </div>
                </form>
            </div> -->
            <!-- End searchForm -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="col-md-2 p0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#min_navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url()?>assets/images/logo.png" alt=""></a>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-md-10 p0">
                <div class="collapse navbar-collapse" id="min_navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><a href="<?=base_url()?>">Home</a></a></li>
                        <li><a href="#"><a href="<?=base_url('aboutus')?>">Aboutus</a></a></li>
                        <li><a href="#"><a href="<?=base_url('projects')?>">Projects</a></a></li>
                        <li><a href="#"><a href="<?=base_url('services')?>">Services</a></a></li>
                        <li><a href="#"><a href="<?=base_url('contactus')?>">Contactus</a></a></li>
                        <!-- <li><a href="#" class="nav_searchFrom"><i class="fa fa-search"></i></a></li> -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div><!-- /.container -->
    </nav>
	<!-- End Header_Area -->