<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Bergerak di Bidang Jasa Pengiriman Motor, Mobil, Alat Berat, Cargo dan Kendaraan Lainnya Antar Pulau. Hingga Pelosok Nusantara Secara Port to Port Hingga Door to Door" />
    <meta name="keywords" content="expedisi, pengiriman, jasa pengiriman, melayani jasa pengiriman" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="keendevs">
    <!-- ======== Page title ============ -->
    <title>PT. DUNIA LINTAS MANDIRI</title>
    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">
    <!-- ===========  All Stylesheet ================= -->
    <!--  Icon css plugins -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/icons.css') }}">
    <!--  animate css plugins -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/animate.css') }}">
    <!--  magnific-popup css plugins -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/magnific-popup.css') }}">
    <!--  owl carosuel css plugins -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/owl.carousel.min.css') }}">
    <!-- metisMenu css file -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/metismenu.css') }}">
    <!-- progresscircle css file -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/progresscircle.css') }}">
    <!--  owl theme css plugins -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/owl.theme.css') }}">
    <!--  Bootstrap css plugins -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/bootstrap.min.css') }}">
    <!--  main style css file -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- template main style css file -->
    <link rel="stylesheet" href="{{ asset('landing/assets/style.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- preloader -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                <span data-text-preloader="L" class="letters-loading">
                    L
                </span>
                <span data-text-preloader="O" class="letters-loading">
                    O
                </span>
                <span data-text-preloader="A" class="letters-loading">
                    A
                </span>
                <span data-text-preloader="D" class="letters-loading">
                    D
                </span>
                <span data-text-preloader="I" class="letters-loading">
                    I
                </span>
                <span data-text-preloader="N" class="letters-loading">
                    N
                </span>
                <span data-text-preloader="G" class="letters-loading">
                    G
                </span>
            </div>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>

    <header class="header-section header-style-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-6">
                    <div class="logo">
                        <img src="{{ asset('logo.png') }}" width="60px" alt="">
                    </div>
                </div>
                <div class="col-lg-10 d-none d-lg-block text-right">
                    <div class="main-menu">
                        <ul class="d-flex align-items-center justify-content-end">
                            <li><a href="#">Home</a></li>
                            <li><a href="#services">services</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#resume">Visi Misi</a></li>
                            <li><a href="#portfolio">Documentation</a></li>
                            <li><a href="#testimonial">Our Company</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#" class="wow fadeInLeft text-white btn btn-dark bg-info p-2"
                                    data-wow-duration="1.5s" data-wow-delay="1.9s">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 d-block d-lg-none">
                    <div class="menu-toggle text-right">
                        <div id="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- mobile menu - responisve menu  -->
                    <div class="mobile-nav">
                        <button type="button" class="close-nav">
                            <i class="fal fa-times-circle"></i>
                        </button>
                        <nav class="sidebar-nav">
                            <ul class="metismenu" id="mobile-menu">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li>
                                    <a href="#services">services</a>
                                </li>
                                <li>
                                    <a href="#about">about</a>
                                </li>
                                <li>
                                    <a href="#resume">visi misi</a>
                                </li>
                                <li>
                                    <a href="#portfolio">documentation</a>
                                </li>
                                <li>
                                    <a href="#testimonial">our company</a>
                                </li>
                                <li>
                                    <a href="#contact">contact</a>
                                </li>
                                <li><a href="#" class="wow fadeInLeft text-white btn btn-dark bg-info p-2 m-3"
                                        data-wow-duration="1.5s" data-wow-delay="1.9s">Hubungi Kami</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="hero-section hero-1" style="background-image: url('landing/assets/img/hero_bg_element.png')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-sm-12 text-center text-lg-left">
                    <div class="hero-content overflow-hidden">
                        <span class="hello-tooltip wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">Hi!
                            There</span>
                        <h1 class="wow fadeInLeft" data-wow-duration="1.3s" data-wow-delay=".9s">PT. DUNIA LINTAS
                            MANDIRI</h1>
                        <div class="typed mb-0">
                            <h3 class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="1.3s">Kami Siap <span
                                    class="profession"></span></h3>
                        </div>
                        <p class="wow fadeInLeft font-weight-bold" data-wow-duration="1.5s" data-wow-delay="1.6s">
                            Kepuasan
                            Anda Adalah
                            Prioritas Kami.</p>
                        <a href="#" class="theme-btn wow fadeInLeft" data-wow-duration="1.5s"
                            data-wow-delay="1.9s">--> Hubungi Kami</a>

                        <div class="social-profile">
                            <a href="https://www.facebook.com/DualimaExpress" target="_blank" class="wow fadeInLeft"
                                data-wow-duration="1.2s" data-wow-delay="2.2s"
                                style="color: #0658e5; margin-right: 13px"><i class="fab fa-facebook"></i>facebook</a>
                            <a href="https://www.instagram.com/dualima_express" target="_blank"
                                class="wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay="2.5s"
                                style="color: #ab1247; margin-right: 13px"><i
                                    class="fab fa-instagram"></i>instagram</a>
                            <a href="https://id.linkedin.com/in/diky-w-723072245" class="wow fadeInLeft"
                                data-wow-duration="1.2s" data-wow-delay="2.7s"
                                style="color: #0c59ff; margin-right: 13px"><i
                                    class="fab fa-linkedin"></i></i>Linkedin</a>
                            <a href="https://www.tiktok.com/@dualima_express" class="wow fadeInLeft"
                                data-wow-duration="1.2s" data-wow-delay="2.9s"
                                style="color: #0f1011; margin-right: 13px"><i class="fab fa-tiktok"></i>Tiktok</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 col-sm-12 text-center overflow-hidden">
                    <div class="hero-profile-img wow fadeInUp" data-wow-duration="2s" data-wow-delay=".9s">
                        <img src="landing/img/1.jpeg" alt="Spruce" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- service section -->
    <section class="services-section section-padding" id="services">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center col-lg-10 offset-lg-1">
                    <div class="section-title-one wow fadeInDown" data-wow-duration="1.2s">
                        <span>my services</span>
                        <h2>Kami memberikan layanan yang
                            fleksibel, dengan harga kompotitif.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-service service-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="icon">
                            <img src="landing/assets/img/icons/aircraft.svg" alt="">
                        </div>
                        <h3>Service Sky Logistic Cargo</h3>
                        <p style="text-align: justify;">Dengan teknologi canggih dan prosedur ketat, kami menjaga
                            keamanan kargo Anda selama perjalanan udara.</p>
                    </div>
                </div> <!-- /.single-service -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-service service-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                        <div class="icon">
                            <img src="landing/assets/img/icons/ship.svg" alt="">
                        </div>
                        <h3>Service Sea Logistic Cargo</h3>
                        <p style="text-align: justify;">Kami menyediakan solusi pengiriman laut yang efisien dan dapat
                            diandalkan, memastikan barang
                            Anda tiba tepat waktu.</p>
                    </div>
                </div> <!-- /.single-service -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-service service-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s">
                        <div class="icon">
                            <img src="landing/assets/img/icons/cargo.svg" alt="">
                        </div>
                        <h3>Service Truck Logistic Cargo</h3>
                        <p style="text-align: justify;">Kami menawarkan layanan pengiriman darat yang cepat dan dapat
                            diandalkan, memastikan barang
                            Anda tiba tepat waktu.</p>
                    </div>
                </div> <!-- /.single-service -->
            </div>
        </div>
    </section>

    <!-- about-me section -->
    <section class="about-section section-padding theme-bg-gray" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1 achivements-area">
                    <div class="single-achivement">
                        <div class="icon">
                            <img src="landing/assets/img/icons/start-up.png" alt="">
                        </div>
                        <div class="achive-heading">
                            <h3>Top Rated</h3>
                            <span>Expedisi</span>
                        </div>
                    </div> <!-- single-achivement -->
                    <div class="single-achivement">
                        <div class="icon">
                            <img src="landing/assets/img/icons/client.png" alt="">
                        </div>
                        <div class="achive-heading">
                            <h3>500+</h3>
                            <span>Satisfied Clients</span>
                        </div>
                    </div> <!-- single-achivement -->
                    <div class="single-achivement">
                        <div class="icon">
                            <img src="landing/assets/img/icons/career.png" alt="">
                        </div>
                        <div class="achive-heading">
                            <h3>Experienced</h3>
                            <span>Have an Experienced Team</span>
                        </div>
                    </div> <!-- single-achivement -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 col-12 wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay=".1s">
                    <div class="main-profile-img">
                        <img src="landing/img/2.jpeg" class="rounded" alt="profile image">
                        <span>+</span>
                        <div class="dots_animate"></div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 col-12 wow fadeInRight" data-wow-duration="1.2s"
                    data-wow-delay=".4s">
                    <div class="about-content">
                        <h1>Welcome to Our Company</h1>
                        <h3>PT DUNIA LINTAS MANDIRI (Dualima Express)</h3>
                        <p style="text-align: justify">
                            Didirikan oleh para profesional di bidangnya, PT DUNIA LINTAS MANDIRI (Dualima Express)
                            hadir untuk memenuhi kebutuhan
                            distribusi unit kendaraan maupun barang dari satu wilayah ke wilayah lainnya. Sebagai
                            penyedia jasa pengiriman via laut dan darat, Dualima Express telah mengembangkan layanan
                            yang lebih efektif dengan berbagai pilihan, termasuk Port to Port, Port to Door, Door to
                            Port, dan Door to Door.

                            Dengan tujuan memberikan kenyamanan berkualitas kepada mitra bisnis serta harga yang
                            kompetitif, Dualima Express menawarkan layanan pengiriman barang, motor, mobil, kontainer,
                            dan alat berat hingga ke pelosok sesuai kebutuhan pelanggan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="skills-experiance-resume section-padding" id="resume">
        <div class="container" style="background-color: lavender">
            <div class="row">
                <div class="col-12 text-center col-lg-10 offset-lg-1">
                    <div class="section-title-one">
                        <h2>Company Vision & Mission</h2>
                    </div>
                </div>
            </div>

            <div class="px-5">
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <div class="resume-timeline-wraper mt-5">
                            <h4 class="p-2 px-4 bg-info rounded text-white" style="width: max-content;">VISION</h4>
                            <div class="mt-3">
                                Menjadi perusahaan logistik yang
                                terintegrasi yang andal ,bermutu, dan
                                bertaraf internasional
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="resume-timeline-wraper mt-5">
                            <h4 class="p-2 px-4 bg-info rounded text-white" style="width: max-content;">MISSION</h4>
                            <div class="mt-3" style="padding-left: 15px">
                                <ul style="list-style-type: disc">
                                    <li style="list-style-type: disc">Memberikan layanan yang berstandar prosedur
                                        dengan aman dan nyaman.</li>
                                    <li style="list-style-type: disc">Menjaga kebersamaan serta kerja antar team yang
                                        bersinergi.</li>
                                    <li style="list-style-type: disc">Menjunjung integritas terhadap pelanggan dan
                                        rekan bisnis.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="portfolio-showcase section-padding pt-0" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center col-lg-10 offset-lg-1">
                    <div class="section-title-one">
                        <span>documentation</span>
                        <h2>Layanan kami aman dan nyaman, dengan tim yang solid dan integritas tinggi.</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="portfolio-filter mt-4 mt-sm-5">
                        <button id="active-button" data-filter=".wordpress" class="active"
                            onclick="filterPortfolio('.wordpress')">Gambar 1</button>
                        <button data-filter=".branding" onclick="filterPortfolio('.branding')">Gambar 2</button>
                        <button data-filter=".website" onclick="filterPortfolio('.website')">Gambar 3</button>
                        <button data-filter=".app" onclick="filterPortfolio('.app')">Gambar 4</button>
                    </div>
                </div>
            </div>
            <div class="row d-flex p-0">
                <div class="col-lg-4 col-md-6 col-12 grid-item branding">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/1.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/1.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item website">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/2.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/2.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item wordpress">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/3.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/3.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item app">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/4.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/4.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item wordpress">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/5.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/5.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item branding">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/6.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/6.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item website">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/7.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/7.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item app">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/8.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/8.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item wordpress">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/9.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/9.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item branding">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/10.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/10.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item website">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/11.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/11.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item app">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/16.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/16.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item wordpress">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/13.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/13.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item branding">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/14.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/14.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item website">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/15.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/15.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item app">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/12.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/12.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item wordpress">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/17.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/17.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item branding">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/18.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/18.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 grid-item website">
                    <div class="single-portfolio-item">
                        <a href="landing/galeri/19.jpeg" class="popup-gallery">
                            <img class="img-fluid" src="landing/galeri/19.jpeg" alt="">
                            <span class="zoom-icon">+</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- testimonial section -->
    <section id="testimonial" class="testimonial-section section-padding theme-bg-gray"
        style="background-image: url('landing/assets/img/testimonial_bg.png');">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center col-lg-10 offset-lg-1">
                    <div class="section-title-one">
                        <span>Our Company</span>
                        <h2>COSTUMER</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-carousel-active text-center owl-carousel owl-theme">
                        <div class="single-testimonial-box">
                            <div class="client-img"
                                style="background-image: url('landing/company/1.png'); background-color: transparent; border-radius: inherit; width: 120px;">
                            </div>
                            <div class="client-info">
                                <h3>CV DWI SANTOSA</h3>
                            </div>
                        </div>
                        <div class="single-testimonial-box">
                            <div class="client-img"
                                style="background-image: url('landing/company/2.png'); background-color: transparent; border-radius: inherit; width: 120px;">
                            </div>
                            <div class="client-info">
                                <h3>PT EKA MULTI LOGISTIK</h3>
                            </div>
                        </div>
                        <div class="single-testimonial-box">
                            <div class="client-img"
                                style="background-image: url('landing/company/3.png'); background-color: transparent; border-radius: inherit; width: 120px;">
                            </div>
                            <div class="client-info">
                                <h3>PT ABIKARYA PERKASA</h3>
                            </div>
                        </div>
                        <div class="single-testimonial-box">
                            <div class="client-img"
                                style="background-image: url('landing/company/5.png'); background-color: transparent; border-radius: inherit; width: 120px;">
                            </div>
                            <div class="client-info">
                                <h3>PT AFID LOGISTIK NUSANTARA</h3>
                            </div>
                        </div>
                        <div class="single-testimonial-box">
                            <div class="client-img"
                                style="background-image: url('landing/company/4.png'); background-color: transparent; border-radius: inherit; width: 100%; 75px;">
                            </div>
                            <div class="client-info">
                                <h3>OCEAN NETWORK EXPERT</h3>
                            </div>
                        </div>
                        <div class="single-testimonial-box">
                            <div class="client-img"
                                style="background-image: url('landing/company/6.png'); background-color: transparent; border-radius: inherit; width: 100%; height: 75px;">
                            </div>
                            <div class="client-info">
                                <h3>KAMAYA ENERGY INDONESIA</h3>
                            </div>
                        </div>
                        <div class="single-testimonial-box">
                            <div class="client-img"
                                style="background-image: url('landing/company/7.png'); background-color: transparent; border-radius: inherit; width: 100%; height: 75px;">
                            </div>
                            <div class="client-info">
                                <h3>PT RIMAU ENERGY MINING</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- blog section -->
    <section id="contact" class="contact-section section-padding theme-bg-gray"
        style="background-image: url('landing/assets/img/testimonial_bg.png');">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center col-lg-10 offset-lg-1">
                    <div class="section-title-one">
                        <span>Contact us</span>
                        <h2>Visit Us OR Contact Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="contact-form-wraper">
                        <!--begin::Col-->
                        <div class="mb-4">
                            <!--begin::Block-->
                            <div class="rounded landing-dark-border p-9 mb-10 embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.507344726301!2d119.44193846899735!3d-5.182616883290996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee3f14e73dd4b%3A0x4bbaee7a513ca45c!2sPT.%20Dunia%20Lintas%20Mandiri!5e0!3m2!1sid!2sid!4v1722334452696!5m2!1sid!2sid"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <!--end::Block-->
                        </div>
                        <!--begin::Col-->
                        <div class="mb-3">
                            <!--begin::Block-->
                            <div class="rounded landing-dark-border p-9 mb-10 embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.050166687582!2d106.89203337387819!3d-6.123951193862744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1f2b5606554b%3A0x2213b0ee5535c85c!2sPt%20dunia%20lintas%20mandiri.%20Expedisi!5e0!3m2!1sid!2sid!4v1722334514806!5m2!1sid!2sid"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <!--end::Block-->
                        </div>
                        <style>
                            .embed-responsive {
                                position: relative;
                                display: block;
                                width: 100%;
                                height: 55vh;
                                padding: 0;
                                overflow: hidden;
                            }

                            .embed-responsive::before {
                                content: "";
                                display: block;
                                padding-top: 56.25%;
                                /* 16:9 aspect ratio */
                            }

                            .embed-responsive .embed-responsive-item,
                            .embed-responsive iframe,
                            .embed-responsive embed,
                            .embed-responsive object,
                            .embed-responsive video {
                                position: absolute;
                                top: 0;
                                left: 0;
                                bottom: 0;
                                width: 100%;
                                height: 100%;
                                border: 0;
                            }
                        </style>
                        <!--end::Col-->
                    </div>
                </div> <!-- col-12 col-lg-8 -->
                <div class="col-lg-4 col-12 offset-lg-1">
                    <div class="contact-info">
                        <div class="single-info" style="margin-bottom: 20px; padding: 14px 35px; font-size: 15px;">
                            <h4>eMail :</h4>
                            <span>Dunialintasmandiri@gmail.com</span>
                        </div>
                        <div class="single-info" style="margin-bottom: 20px; padding: 14px 35px; font-size: 15px;">
                            <h4>Phone :</h4>
                            <span>021-2452 3331</span>
                        </div>
                        <div class="single-info" style="margin-bottom: 20px; padding: 14px 35px; font-size: 15px;">
                            <h4>Office :</h4>
                            <span>Jl. Kelapa Hibrida I Blok GI N 0.3 Kelapa Gading, Jakarta Utara 14240</span>
                        </div>
                        <div class="single-info" style="margin-bottom: 20px; padding: 14px 35px; font-size: 15px;">
                            <h4>Gudang :</h4>
                            <span>Jl. Berdikari No. 1, Koja, Rawabadak Utara, Jakarta Utara</span>
                        </div>
                        <div class="single-info" style="margin-bottom: 20px; padding: 14px 35px; font-size: 15px;">
                            <h4>Office/Gudang :</h4>
                            <span>Jl. Talasalapang Komp Ruko Puri Bukit Mas, Blok D No 14, Makassar
                                90222</span>
                        </div>
                    </div>
                </div><!-- col-lg-4 col-12 -->
            </div>
        </div>
    </section>

    <footer class="footer-one text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    &copy; 2024 Copyright Reserved - <a href="#">PT DUALIMA LINTAS MANDIRI</a>
                </div>
            </div>
        </div>
    </footer>

    <div class="contact-us">
        <a href="javascript:void(0);" class="whatsapp-button">
            <img src="{{ asset('logo_wa.png') }}" alt="WhatsApp">
            <span>Contact Us</span>
        </a>
    </div>

    <div class="contact-container d-none">
        <a href="https://wa.me/08111252547" target="_blank" class="whatsapp-button-container mb-3">
            <img src="{{ asset('logo_wa.png') }}" alt="WhatsApp">
            <span>Contact Us 1</span>
        </a>
        <a href="https://wa.me/0811425254" target="_blank" class="whatsapp-button-container">
            <img src="{{ asset('logo_wa.png') }}" alt="WhatsApp">
            <span>Contact Us 2</span>
        </a>
    </div>

    <div>
        <div></div>
    </div>

    <!--  ALl JS Plugins
    ====================================== -->
    <script src="{{ asset('landing/assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/modernizr-3.7.1.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('landing/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/imageload.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/scrollUp.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/waypoint.js') }}"></script>
    <script src="{{ asset('landing/assets/js/counterup.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/typed.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/metismenu.js') }}"></script>
    <script src="{{ asset('landing/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/progresscircle.js') }}"></script>
    <script src="{{ asset('landing/assets/js/barfiller.js') }}"></script>
    <script src="{{ asset('landing/assets/js/ajax-mail.js') }}"></script>
    <script>
        let typed = new Typed('.profession', {
            strings: ["mengantar impian Anda.", "melaju, barang tiba tepat waktu.",
                "melintasi jarak, menyatukan tujuan.", "cepat, aman, dan terpercaya.",
                "melayani anda dengan sepenuh hati.", "membawa kepercayaan anda.",
                "menjadi partner pengiriman terbaik anda."
            ],
            typeSpeed: 80,
            loop: true,
            startDelay: 200,
            backSpeed: 50,
        });
    </script>
    <script src="{{ asset('landing/assets/js/active.js') }}"></script>
    <script>
        function filterPortfolio(filter) {
            // Hapus class 'active' dari semua tombol
            var buttons = document.querySelectorAll('.portfolio-filter button');
            buttons.forEach(function(button) {
                button.classList.remove('active');
            });

            // Tambahkan class 'active' ke tombol yang diklik
            var activeButton = document.querySelector('.portfolio-filter button[data-filter="' + filter + '"]');
            if (activeButton) {
                activeButton.classList.add('active');
            }

            // Filter grid items
            var items = document.querySelectorAll('.grid-item');
            items.forEach(function(item) {
                if (item.classList.contains(filter.slice(1)) || filter === '.all') {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Pastikan tombol pertama langsung terklik saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            var buttonActive = document.getElementById('active-button');
            if (buttonActive) {
                buttonActive.click();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var whatsappButton = document.querySelector('.whatsapp-button');
            var contactContainer = document.querySelector('.contact-container');

            whatsappButton.addEventListener('click', function() {
                if (contactContainer.classList.contains('d-none')) {
                    contactContainer.classList.remove('d-none');
                    contactContainer.classList.add('d-block');
                } else {
                    contactContainer.classList.remove('d-block');
                    contactContainer.classList.add('d-none');
                }
            });
        });
    </script>
</body>

</html>
