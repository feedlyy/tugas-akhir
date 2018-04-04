<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sitem Informasi Penjadwalan Kegiatan</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('Customs/1/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ url('Customs/1/custom/css/flexslider.css') }}" type="text/css" media="screen">
    <link rel="stylesheet" href="{{ url('Customs/1/custom/css/parallax-slider.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('Customs/1/font-awesome-4.0.3/css/font-awesome.min.css') }}" type="text/css">

    <!-- Custom styles for this template -->

    <link href="{{ url('Customs/1/custom/css/business-plate.css') }}" rel="stylesheet">
<!-- <link rel="shortcut icon" href="{{ url('') }}Customs/1/custom/ico/favicon.ico"> -->
    <!-- JS Global Compulsory -->
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/jquery-1.8.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/modernizr.custom.js') }}"></script>
    <script type="text/javascript" src="{{ url('Customs/1/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- JS Implementing Plugins -->
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/jquery.flexslider-min.js') }}"></script>
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/jquery.cslider.js') }}"></script>
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/back-to-top.js') }}"></script>
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/jquery.sticky.js') }}"></script>

    <!-- JS Page Level -->
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ url('Customs/1/custom/js/index.js') }}"></script>
</head>
<!-- NAVBAR
================================================== -->
<body>
<div class="top">
    <div class="container">
        <div class="row-fluid">
            <ul class="phone-mail">
                <li><i class="fa fa-phone"></i><span>(0274) 541020, (0274) 582598</span></li>
                <li><i class="fa fa-envelope"></i><span>sv@ugm.ac.id</span></li>
            </ul>
            <ul class="loginbar">
                <li class="devider">&nbsp;</li>
                <li><a href="{{ route('login') }}" class="login-btn"><i class="glyphicon glyphicon-log-in" style="font-size:10px"></i>&nbsp;&nbsp;Login</a></li></li>
            </ul>
        </div>
    </div>
</div>

<!-- topHeaderSection -->
<div class="topHeaderSection">
    <div class="header">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('Customs/1/custom/img/logo1.png') }}" alt="Sistem Informasi Penjadwalan Kegiatan" /></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="{{ url('/') }}">Home</a></li>
                    <li ><a href="{{ url('jadwal') }}">Jadwal</a></li>
                    <li><a href="{{ url('visi') }}">Visi dan Misi</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<!-- bannerSection -->
<div class="bannerSection">
    <div class="slider-inner">
        <div id="da-slider" class="da-slider">
            <div class="da-slide">
                <h2><i>Sekolah Vokasi UGM</i> <br> <i>Gelar Ceremonial </i> <br> <i>Penandatanganan</i><br> <i>MoU dengan </i> <br> <i>EC-Council</i></h2>
                <div class="da-img"><img src="{{ url('Customs/1/custom/img/1.jpg') }}" alt="" /></div>
            </div>

            <div class="da-slide">
                <h2><i>UGM dan ANRI</i> <br> <i>Kerja Sama Pengem-</i> <br> <i>bangan Program</i> <br> <i>D4 Kearsipan SV UGM</i></h2>
                <div class="da-img"><img src="{{ url('Customs/1/custom/img/2.jpg') }}" alt="" /></div>
            </div>
            <div class="da-slide">
                <h2><i>Dies Natalis ke-23</i> <br> <i>Program Studi </i> <br> <i>Kesehatan Hewan</i></h2>
                <div class="da-img"><img src="{{ url('Customs/1/custom/img/3.png') }}" alt="" /></div>
            </div>
            <nav class="da-arrows">
                <span class="da-arrows-prev"></span>
                <span class="da-arrows-next"></span>
            </nav>
        </div><!--/da-slider-->
    </div><!--/slider-->
    <!--=== End Slider ===-->
</div>

<!-- footerTopSection -->
<div class="footerTopSection">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <center><h3>About Us</h3>
                    <strong>Sekolah Vokasi Universitas Gadjah Mada</strong><br>
                    Gedung SV UGM, Sekip Unit 1 Catur Tunggal<br>
                    Depok Sleman Yogyakarta, Indonesia. 55281<br>
                    <p class="glyphicon glyphicon-envelope" style="font-size:15px;"> sv@ugm.ac.id</p><br>
                    <p class="glyphicon glyphicon-phone-alt" style="font-size:15px;"> (0274) 541020, (0274) 582598</p><br>
                    <p> (0274) 541020</p></center>
            </div>
            <div class="col-md-4">
                <center><h3>Sosial Media</h3>
                    <p>
                        <a href="https://www.facebook.com/VokasiUGM/"> Facebook </a> <br>
                        <a href="https://twitter.com/sv_ugm"> Twitter </a><br>
                        <a href="https://www.instagram.com/sv_ugm/"> Instagram </a><br>
                        <a href="https://www.youtube.com/user/UGMOfficial"> Youtube </a><br>
                        <a href="http://sv.ugm.ac.id/feed"> RSS Feed </a><br>
                        <a href="https://play.google.com/store/apps/details?id=co.amijaya.vokasi"> Vokasi Apps </a>
                    </p></center>
            </div>

            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>
<!-- footerBottomSection -->
<div class="footerBottomSection">
    <div class="container">
        &copy; 2017, Allright reserved. <a href="#">Terms and Condition</a> | <a href="#">Privacy Policy</a>
        <div class="pull-right"> <a href="{{ url('/') }}"><img src="{{ url('Customs/1/custom/img/logo.png') }}" alt="Sistem Informasi Penjadwalan Kegiatan" /></a></div>
    </div>
</div>




<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initSliders();
        Index.initParallaxSlider();
    });
</script>


</body>
</html>
