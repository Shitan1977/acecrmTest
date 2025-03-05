<?php
include_once 'class/config.inc';
$login = new login_class();
if (!empty($_POST['azienda'])) {
    $login->accesso($_POST['username'], $_POST['password'], $_POST['azienda']);
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>AceCrm</title>
            <meta name="description" content="AceCrm" />
            <!--Keywords -->
            <meta name="keywords" content="" />
            <meta name="author" content="AceCrm" />
            <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
            <!--Favicon -->
            <link rel="icon" type="image/png" href="vetrina/images/favicon.png" />
            <!-- Apple Touch Icon -->
            <link rel="apple-touch-icon" href="vetrina/images/apple-touch-icon.png"/>
            <!-- CSS Files -->
            <link rel="stylesheet" href="vetrina/css/plugins.css"/>
            <!-- Theme Styles -->
            <link rel="stylesheet" href="vetrina/css/style.css?v=2.0"/>
            <!-- End Page Styles -->
            <!-- Styles for titles on home -->
            <style type="text/css">
                .nr1{
                    font-size: clamp(4rem, 7vw, 7rem);
                    line-height: clamp(3rem, 5.5vw, 5.5rem);
                    margin-top:-10px;
                }
                .nr2{
                    font-size: clamp(6.7rem, 11.82vw, 11.82rem);
                    line-height:clamp(6rem, 9vw, 9rem);
                }
                .nr3{
                    font-size: clamp(1.9rem, 3.35vw, 3.35rem);
                }
                .nr4{
                    font-size: clamp(1.7rem, 3vw, 3rem);
                    line-height: clamp(1rem, 2.3vw, 2.3rem);
                }
                .nr5{
                    font-size: clamp(5.7rem, 10.1vw, 10.1rem);
                    line-height: clamp(5rem, 8vw, 8rem);
                }
                @media only screen and (max-width:664px){
                    .nr1{
                        margin-top:-5px;
                    }
                }
            </style>
    </head>
    <!-- BODY START -->
    <body>
        <!-- Website loader -->
        <div class="page-loader loader-wrapper bg-white">
            <div class="loader width-60 height-60 b-3 circle b-colored spin fast2x"></div>
        </div>
        <!-- Start Navigation -->
        <nav id="navigation" class="modern-nav fixed fixed-height fs-12 bs-xs link-hover-01 nav-white nav-lg" data-offset="75">
            <!-- Navigation container - You can change container type and padding value -->
            <div class="container nav-container">
                <!-- Row for cols in the nav -->
                <div class="row nav-wrapper justify-content-end">
                    <!-- Column for logo -->
                    <div class="col">
                        <a href="#home" class="logo mt-2">
                            <img src="vetrina/images/logos/logo_new_1.png" alt="website logo" class="logo-white mxw-100">
                                <img src="vetrina/images/logos/logo_new_1.png" alt="website logo" class="logo-dark mxw-100">
                                    </a>
                                    </div>
                                    <!-- Column for Navigation -->
                                    <div id="nav-menu" class="col ml-auto nav-menu">
                                        <!-- Navigation links, you can add nav-links-centered class for centered links -->
                                        <ul class="nav-links justify-content-end">
                                            <!-- Logo for mobile navigation -->
                                            <li class="logo-for-mobile-navigation"><img src="vetrina/images/logos/logo_01_dark.svg" alt="website logo" class="logo-white mxw-100"></li>
                                            <!-- Link -->
                                            <li><a href="#home" class="nav-link">Home</a></li>
                                            <li><a href="#about" class="nav-link">Azienda</a></li>
                                            <!-- Link, Extra Sub menu -->
                                            <li class="dd-toggle">
                                                <a href="#services" class="nav-link" data-toggle="dropdown-menu">Company</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#features" class="nav-link">Features</a></li>
                                                    <li><a href="#history" class="nav-link">History</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#works" class="nav-link">Gestionali</a></li>
                                            <li><a href="#demo" class="nav-link">Demo</a></li>
                                            <li><a href="#prices" class="nav-link">Prezzi</a></li>
                                            <!-- Link, Extra Sub menu -->

                                            <li><a href="#contact" class="nav-link">Contatti</a></li>
                                            <!-- Extra Links -->
                                            <li class="extra-links">
                                                <div class="bracket"></div>
                                                <a href="#" target="_blank" class="nav-link" title="Gold Eyes Studio Twitter Profile"><i class="bi-twitter"></i></a>
                                                <a href="#" class="nav-link" target="_blank" title="Gold Eyes Studio Linkedin Profile"><i class="bi-linkedin"></i></a>

                                                <a href="#" target="_blank" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" class="nav-button bg-colored bg-colored1-hover white fs-11 uppercase extrabold py-15" title="Instagram">Login</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- End Column for Navigation -->
                                    <!-- Mobile navigation trigger button -->
                                    <div id="hamburger-menu" class="mobile-nb">
                                        <div class="hamburger-menu">
                                            <div class="top-bun"></div>
                                            <div class="meat"></div>
                                            <div class="bottom-bun"></div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- End Row for cols in the nav -->
                                    </div>
                                    <!-- End Navigation container -->
                                    <div id="mobile-nav-bg" class="mobile-nav-bg slow"></div>
                                    </nav>
                                    <!-- End Navigation -->
                                    <!-- Start Home -->
                                    <section id="home" class="fullwidth has-parallax fullscreen d-flex align-items-center c-default">
                                        <!-- Parallax background -->
                                        <div class="parallax bg-pattern" data-bg="vetrina/images/image_Sky_Line_1.png" data-target="#home" data-bottom-top="transform:translate3d(0px,-400px,0px);" data-top-bottom="transform:translate3d(0px,400px,0px);"></div>
                                        <!-- Container for all home section details -->
                                        <div class="container relative zi-5">
                                            <!-- Row for all -->
                                            <div class="row align-items-center justify-content-center t-center">
                                                <!-- Column for titles -->
                                                <div class="col-12 d-flex justify-content-center">
                                                    <!-- Global settings -->
                                                    <div class="font-secondary uppercase gray5 medium lh-normal px-20 bl-1 br-1 b-gray4">
                                                        <!-- Start texts - you can see the styles in head tag. -->
                                                        <div class="nr1 gray3">Benvenuto in</div>
                                                        <div class="nr2 colored">AceCrm</div>
                                                        <div class="nr3 gray4">Gestionale Modulare</div>
                                                        <div class="nr4 gray6">per la tua azienda</div>
                                                        <div class="nr5 white">Chiedi Info</div>
                                                    </div>
                                                </div>
                                                <!-- End column for titles -->
                                            </div>
                                            <!-- End row for all -->
                                        </div>
                                        <!-- End container for all home section details -->
                                    </section>
                                    <!-- End Home -->
                                    <!-- About section -->
                                    <section id="about" class="py-100">
                                        <!-- Container for title and boxes -->
                                        <div class="container t-center">
                                            <!-- Row for all -->
                                            <div class="row">
                                                <!-- Column 12 for the title -->
                                                <div class="col-12 d-flex flex-column align-items-center mb-50">
                                                    <!-- Title -->
                                                    <h1 class="gray8 fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                        intuitivo, Versatile &amp; con un design <span class="colored">professionale</span>.
                                                    </h1>
                                                    <!-- Paragraph -->
                                                    <p class="mxw-800 d-inline-flex mt-15">
                                                        Il Software adatto al tuo Business
                                                    </p>
                                                </div>
                                                <!-- End column 12 for the title -->
                                                <!-- Column for box -->
                                                <div class="col-lg-3 col-md-6 col-12 mt-30 d-flex flex-column align-items-center hover-container c-default">
                                                    <!-- Icon -->
                                                    <div class="icon-xxl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2 bg-dark-hover-item c-default dark white-hover-item slow arrow-bottom">
                                                        <i class="bi-gear-wide fs-27"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="uppercase fs-17 mt-20">
                                                        100% RESPONSIVE DESIGN
                                                    </h4>
                                                    <!-- Paragraph -->
                                                    <p class="mxw-800 d-inline-flex mt-10 gray7">
                                                        Layout dinamico device free
                                                    </p>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-3 col-md-6 col-12 mt-30 d-flex flex-column align-items-center hover-container c-default">
                                                    <!-- Icon -->
                                                    <div class="icon-xxl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2 bg-dark-hover-item c-default dark white-hover-item slow arrow-bottom">
                                                        <i class="bi-card-checklist fs-27"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="uppercase fs-17 mt-20">
                                                        CLEAN CODING
                                                    </h4>
                                                    <!-- Paragraph -->
                                                    <p class="mxw-800 d-inline-flex mt-10 gray7">
                                                        Codice pulito,intuitivo e easy to edit
                                                    </p>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-3 col-md-6 col-12 mt-30 d-flex flex-column align-items-center hover-container c-default">
                                                    <!-- Icon -->
                                                    <div class="icon-xxl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2 bg-dark-hover-item c-default dark white-hover-item slow arrow-bottom">
                                                        <i class="bi-window-desktop fs-27"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="uppercase fs-17 mt-20">
                                                        ONE PAGE DESIGN
                                                    </h4>
                                                    <!-- Paragraph -->
                                                    <p class="mxw-800 d-inline-flex mt-10 gray7">
                                                        Free solution for your web business
                                                    </p>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-3 col-md-6 col-12 mt-30 d-flex flex-column align-items-center hover-container c-default">
                                                    <!-- Icon -->
                                                    <div class="icon-xxl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2 bg-dark-hover-item c-default dark white-hover-item slow arrow-bottom">
                                                        <i class="bi-stars fs-27"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="uppercase fs-17 mt-20">
                                                        EASY CUSTOMIZE
                                                    </h4>
                                                    <!-- Paragraph -->
                                                    <p class="mxw-800 d-inline-flex mt-10 gray7">
                                                        Soluzioni su misura per la tua attivita´
                                                    </p>
                                                </div>
                                                <!-- End column for box -->
                                            </div>
                                            <!-- End row for all -->
                                        </div>
                                        <!-- End container for title and boxes -->
                                    </section>
                                    <!-- End about section -->
                                    <!-- Services section -->
                                    <section id="services" class="py-120 has-parallax">
                                        <!-- Parallax background -->
                                        <div class="parallax" data-bg="vetrina/images/city_sun.png" data-target="#services" data-bottom-top="transform:translate3d(0px,-200px,0px);" data-top-bottom="transform:translate3d(0px,200px,0px);"></div>
                                        <!-- Container for title and boxes -->
                                        <div class="container t-center">
                                            <!-- Row for all -->
                                            <div class="row">
                                                <!-- Column 12 for the title -->
                                                <div class="col-12 d-flex flex-column align-items-center mb-50">
                                                    <!-- Title -->
                                                    <h1 class="white fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                        la scienza di oggi e´ la  <span class="colored">tecnologia</span> del domani
                                                    </h1>
                                                    <!-- Paragraph -->
                                                    <p class="mxw-800 d-inline-flex mt-15 gray3">
                                                        Fai Evolvere il tuo business rendi veloci e smart le tue azioni. Il tuo lavoro deve diventare la soluzione, non il problema.
                                                </div>
                                                <!-- End column 12 for the title -->
                                                <!-- Column for box -->
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 mt-30 d-flex flex-column align-items-center hover-container c-info"
                                                     data-bs-toggle="tooltip"
                                                     data-bs-placement="top"
                                                     data-animation="false"
                                                     data-bs-html="true"
                                                     title="<p class='fs-16'>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled</p>">
                                                    <!-- Icon -->
                                                    <div class="icon-xl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2-hover-item c-info gray2 dark-hover-item slow arrow-bottom">
                                                        <i class="bi-lightning-fill fs-23"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-30 gray2">
                                                        Calcolo statistiche
                                                    </h4>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 mt-30 d-flex flex-column align-items-center hover-container c-info"
                                                     data-bs-toggle="tooltip"
                                                     data-bs-placement="top"
                                                     data-animation="false"
                                                     data-bs-html="true"
                                                     title="<p class='fs-16'>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled</p>">
                                                    <!-- Icon -->
                                                    <div class="icon-xl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2-hover-item c-info gray2 dark-hover-item slow arrow-bottom">
                                                        <i class="bi-laptop fs-23"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-30 gray2">
                                                        Compatibile con tutti gli e-commerce
                                                    </h4>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 mt-30 d-flex flex-column align-items-center hover-container c-info"
                                                     data-bs-toggle="tooltip"
                                                     data-bs-placement="top"
                                                     data-animation="false"
                                                     data-bs-html="true"
                                                     title="<p class='fs-16'>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled</p>">
                                                    <!-- Icon -->
                                                    <div class="icon-xl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2-hover-item c-info gray2 dark-hover-item slow arrow-bottom">
                                                        <i class="bi-journals fs-23"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-30 gray2">
                                                        Fatturazione elettronica con tutti i gestori
                                                    </h4>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 mt-30 d-flex flex-column align-items-center hover-container c-info"
                                                     data-bs-toggle="tooltip"
                                                     data-bs-placement="top"
                                                     data-animation="false"
                                                     data-bs-html="true"
                                                     title="<p class='fs-16'>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled</p>">
                                                    <!-- Icon -->
                                                    <div class="icon-xl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2-hover-item c-info gray2 dark-hover-item slow arrow-bottom">
                                                        <i class="bi-keyboard fs-23"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-30 gray2">
                                                        Gestione Magazzino sincronizzazione ordini 
                                                    </h4>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 mt-30 d-flex flex-column align-items-center hover-container c-info"
                                                     data-bs-toggle="tooltip"
                                                     data-bs-placement="top"
                                                     data-animation="false"
                                                     data-bs-html="true"
                                                     title="<p class='fs-16'>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled</p>">
                                                    <!-- Icon -->
                                                    <div class="icon-xl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2-hover-item c-info gray2 dark-hover-item slow arrow-bottom">
                                                        <i class="bi-disc fs-23"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-30 gray2">
                                                        100% Custom per tutti gli scenari.
                                                    </h4>
                                                </div>
                                                <!-- End column for box -->
                                                <!-- Column for box -->
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 mt-30 d-flex flex-column align-items-center hover-container c-info"
                                                     data-bs-toggle="tooltip"
                                                     data-bs-placement="top"
                                                     data-animation="false"
                                                     data-bs-html="true"
                                                     title="<p class='fs-16'>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled</p>">
                                                    <!-- Icon -->
                                                    <div class="icon-xl radius-md b-1 b-gray3 b-dark-hover-item bg-gray2-hover-item c-info gray2 dark-hover-item slow arrow-bottom">
                                                        <i class="bi-brush fs-23"></i>
                                                    </div>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-30 gray2">
                                                        Agginta Moduli in qualsiasi momento.
                                                    </h4>
                                                </div>
                                                <!-- End column for box -->
                                            </div>
                                            <!-- End row for all -->
                                        </div>
                                        <!-- End container for title and boxes -->
                                    </section>
                                    <!-- End services section -->
                                    <!-- Features section -->
                                    <section id="features" class="py-100">
                                        <!-- Container for title and boxes -->
                                        <div class="container t-center">
                                            <!-- Row for all -->
                                            <div class="row">
                                                <!-- Column 12 for the title -->
                                                <div class="col-12 d-flex flex-column align-items-center mb-10 mb-20-sm">
                                                    <!-- Title -->
                                                    <h1 class="gray8 fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                        Perche´scegliere <span class="colored">Acecrm?</span>
                                                    </h1>
                                                    <!-- Paragraph -->
                                                    <p class="mxw-800 d-inline-flex mt-15">
                                                        Ti diamo tanti buoni motivi per scegliere il nostro Software. La qualita´non e´mai casuale; ma e´ il risultato di uno sforzo intelligente.
                                                    </p>
                                                </div>
                                                <!-- End column 12 for the title -->
                                                <!-- Box col -->
                                                <div class="col-lg-4 col-12 mt-70 mt-40-sm hover-container c-default">
                                                    <!-- Icon -->
                                                    <i class="bi-bank2 fs-40 gray8 colored-hover-item slow"></i>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-20 gray8 medium uppercase">
                                                        Perfect responsive
                                                    </h4>
                                                    <!-- Desc -->
                                                    <p class="gray7 mt-15">
                                                        Adattabile e fruibile da tutti i device 100% responsive design
                                                    </p>
                                                </div>
                                                <!-- End box col -->
                                                <!-- Box col -->
                                                <div class="col-lg-4 col-12 mt-70 mt-40-sm hover-container c-default">
                                                    <!-- Icon -->
                                                    <i class="bi-airplane-engines fs-40 gray8 colored-hover-item slow"></i>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-20 gray8 medium uppercase">
                                                        Velocita´di caricamento 
                                                    </h4>
                                                    <!-- Desc -->
                                                    <p class="gray7 mt-15">
                                                        Essenziale, versatile il suo codice pulito permette un alta velocita´di caricamento.
                                                    </p>
                                                </div>
                                                <!-- End box col -->
                                                <!-- Box col -->
                                                <div class="col-lg-4 col-12 mt-70 mt-40-sm hover-container c-default">
                                                    <!-- Icon -->
                                                    <i class="bi-award fs-40 gray8 colored-hover-item slow"></i>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-20 gray8 medium uppercase">
                                                        Ottimo design
                                                    </h4>
                                                    <!-- Desc -->
                                                    <p class="gray7 mt-15">
                                                        Design intuitivo progettazione semplice con un´immediata comunicazione visiva su tutte le skill.
                                                    </p>
                                                </div>
                                                <!-- End box col -->
                                                <!-- Box col -->
                                                <div class="col-lg-4 col-12 mt-70 mt-40-sm hover-container c-default">
                                                    <!-- Icon -->
                                                    <i class="bi-basket2 fs-40 gray8 colored-hover-item slow"></i>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-20 gray8 medium uppercase">
                                                        Codice pulito 
                                                    </h4>
                                                    <!-- Desc -->
                                                    <p class="gray7 mt-15">
                                                        linguaggio essenziale e chiaro sinteticita´e concisione di stile.
                                                    </p>
                                                </div>
                                                <!-- End box col -->
                                                <!-- Box col -->
                                                <div class="col-lg-4 col-12 mt-70 mt-40-sm hover-container c-default">
                                                    <!-- Icon -->
                                                    <i class="bi-battery-charging fs-40 gray8 colored-hover-item slow"></i>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-20 gray8 medium uppercase">
                                                        Risparmia tempo ed energia
                                                    </h4>
                                                    <!-- Desc -->
                                                    <p class="gray7 mt-15">
                                                        Pianifica in modo semplice il tuo Business. Il nostro software si sincronizza con te.
                                                    </p>
                                                </div>
                                                <!-- End box col -->
                                                <!-- Box col -->
                                                <div class="col-lg-4 col-12 mt-70 mt-40-sm hover-container c-default">
                                                    <!-- Icon -->
                                                    <i class="bi-disc fs-40 gray8 colored-hover-item slow"></i>
                                                    <!-- Title -->
                                                    <h4 class="fs-17 mt-20 gray8 medium uppercase">
                                                        Assisteza veloce
                                                    </h4>
                                                    <!-- Desc -->
                                                    <p class="gray7 mt-15">
                                                        Assistenza sempre a portata di clik.
                                                    </p>
                                                </div>
                                                <!-- End box col -->
                                            </div>
                                            <!-- End row for all -->
                                        </div>
                                        <!-- End container for title and boxes -->
                                    </section>
                                    <!-- End features section -->
                                    <!-- Testimonials section -->
                                    <div id="testimonials-51235612" class="pt-200 pb-150 has-parallax">
                                        <!-- Parallax background -->
                                        <div class="parallax" data-bg="vetrina/images/folders_ace.png" data-target="#testimonials-51235612" data-bottom-top="transform:translate3d(0px,-200px,0px);" data-top-bottom="transform:translate3d(0px,200px,0px);"></div>
                                        <!-- Container for text slider -->
                                        <div class="container t-center">
                                            <!-- Row for all -->
                                            <div class="row">
                                                <!-- Column for testimonials -->
                                                <div class="col-xl-8 offset-xl-2 col-lg-12">
                                                    <!-- Start text slider -->
                                                    <div class="text-slider o-hidden fullwidth">
                                                        <!-- Wrapper for slider -->
                                                        <div class="swiper-wrapper">
                                                            <!-- Slide -->
                                                            <div class="swiper-slide" data-swiper-autoplay="2000">
                                                                <!-- Flex slide wrapper -->
                                                                <div class="d-flex fullwidth fullheight flex-column align-items-center justify-content-center t-center">
                                                                    <!-- Quote -->
                                                                    <q class="white uppercase bold fs-30 fs-22-sm lh-40 lh-30-sm">
                                                                        Agli ingenieri piace risolvere i problemi. Se non ci sono<span class="colored"> problemi</span> disponibili, essi <span class="colored">Ne creeranno</span> problemdi propri.
                                                                    </q>
                                                                    <!-- Owner -->
                                                                    <abbr class="gray5 uppercase mt-30">Scott Adams</abbr>
                                                                </div>
                                                                <!-- End flex slide wrapper -->
                                                            </div>
                                                            <!-- End slide -->
                                                            <!-- Slide -->
                                                            <div class="swiper-slide" data-swiper-autoplay="2000">
                                                                <!-- Flex slide wrapper -->
                                                                <div class="d-flex fullwidth fullheight flex-column align-items-center justify-content-center t-center">
                                                                    <!-- Quote -->
                                                                    <q class="white uppercase bold fs-30 fs-22-sm lh-40 lh-30-sm">
                                                                        Il creatore dell´universo lavora in  <span class="colored">Modi misteriosi</span>. Ma egli ha uato alla base un sistema di 10 numeri e gli piaccioni i <span class="colored">numeri pari</span>.
                                                                    </q>
                                                                    <!-- Owner -->
                                                                    <abbr class="gray5 uppercase mt-30">Scott Adams</abbr>
                                                                </div>
                                                                <!-- End flex slide wrapper -->
                                                            </div>
                                                            <!-- End slide -->
                                                        </div>
                                                        <!-- End wrapper for slider -->
                                                    </div>
                                                    <!-- End text slider -->
                                                    <!-- Arrows for text slider -->
                                                    <div class="mt-30 mt-30-sm mb-20 d-flex justify-content-center">
                                                        <!-- Previous button -->
                                                        <div class="text-slider-prev white bg-blur slow icon-md bg-soft-1 zoom-out-focus bg-soft-white circle bg-colored-hover mr-10" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-284101c8261f8f8a">
                                                            <i class="bi-chevron-left fs-17"></i>
                                                        </div>
                                                        <!-- Next button -->
                                                        <div class="text-slider-next white bg-blur slow icon-md bg-soft-1 zoom-out-focus bg-soft-white circle bg-colored-hover" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-284101c8261f8f8a">
                                                            <i class="bi-chevron-right fs-17"></i>
                                                        </div>
                                                    </div>
                                                    <!-- End arrows for text slider -->
                                                </div>
                                                <!-- End column for testimonials -->
                                            </div>
                                            <!-- End row for all -->
                                        </div>
                                        <!-- End container for text slider -->
                                    </div>
                                    <!-- End testimonials section -->
                                    <!-- Note bottom of testimonials -->
                                    <div class="bg-dark7 white py-55 fullwidth d-flex align-items-center justify-content-center">
                                        <h3 class="white uppercase medium fs-28 fs-22-sm t-center">
                                            ACECRM e´il software che fa´per te!
                                        </h3>
                                    </div>
                                    <!-- End note bottom of testimonials -->
                                    <!-- History section -->
                                    <section id="history" class="pt-100 has-parallax">
                                        <!-- Parallax background -->
                                        <div class="parallax" data-bg="vetrina/images/Computer_software_4_acecrm.jpg" data-target="#history" data-bottom-top="transform:translate3d(0px,-200px,0px);" data-top-bottom="transform:translate3d(0px,200px,0px);"></div>
                                        <!-- Container for title -->
                                        <div class="container">
                                            <!-- Column 12 for the title -->
                                            <div class="d-flex flex-column align-items-center t-center mb-10 mb-20-sm">
                                                <!-- Title -->
                                                <h1 class="gray8 fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                    Cosa puoi fare con ACECRM? <br class="visible-lg"><span class="colored">Tutto ciò che ti serve.</span>
                                                </h1>
                                                <!-- Paragraph -->
                                                <p class="mxw-800 d-inline-flex mt-15">
                                                    Personalizza il tuo busisness e pianfica il tuo tempo, Grazie allo sviluppo modulare puoi aggiungere funzionie ampliare le potenzialità del tuo gestionale. 
                                                </p>
                                            </div>
                                            <!-- End column 12 for the title -->
                                        </div>
                                        <!-- End container for title -->
                                        <!-- Container for history -->
                                        <div class="container relative mt-70 pb-150">
                                            <!-- Strip for history - You can customize everything with classes -->
                                            <div class="visible-lg width-1 bg-gray3 absolute left-percent-50 top-0 move-left-half fullheight zi-0 pointer-events-none"></div>
                                            <!-- Today button -->
                                            <div class="col-12 t-center relative zi-5">
                                                <div class="lh-normal py-15 px-30 bg-dark white fs-11 bold d-inline-flex radius">TODAY</div>
                                            </div>
                                            <!-- Today button -->
                                            <!-- Row for posts and dates -->
                                            <div class="row relative zi-5" data-masonry='{"percentPosition": true }'>
                                                <!-- Post - ON LEFT -->
                                                <div class="col-lg-6 col-12 hover-container c-default height-auto relative mt-0 mt-60-sm pr-50 px-15-sm d-flex align-items-center">
                                                    <!-- Text Content -->
                                                    <div class="pt-40 pb-55 px-35 slow bg-white bg-colored-hover-item radius-md fullwidth relative">
                                                        <!-- Date -->
                                                        <h6 class="medium gray7 white-hover-item uppercase slow">Gestione Appuntamenti</h6>
                                                        <!-- Title -->
                                                        <h4 class="uppercase fs-17 medium white-hover-item gray8 mt-10 slow">
                                                            Planning
                                                        </h4>
                                                        <!-- Description -->
                                                        <p class="mt-10 gray6 white-hover-item slow">
                                                            Organizzazione di appuntamenti aziendali, pianificazione eventi, riunioni, avvisi. Puoi da oggi assegnare obiettivi ai vari operatori, appuntamenti con fornitori o potenziali clienti in tempo reale e da remoto.
                                                        </p>
                                                        <!-- Arrow -->
                                                        <div class="visible-lg b-15 arrow-right b-white b-colored-hover-item slow left-percent-100 top-percent-50 mt--15 absolute"></div>
                                                        <!-- Image and video content -->
                                                        <div class="absolute height-70px left-0 bottom-0 px-30 move-down-half fullwidth d-flex flex-wrap justify-content-lg-end justify-content-start">
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/foto_agenda.png" data-bg="vetrina/images/history/foto_agenda.png" data-fslightbox="20jan2022" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/2.jpg" data-bg="vetrina/images/history/2.jpg" data-fslightbox="20jan2022" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                        </div>
                                                        <!-- End image and video content -->
                                                    </div>
                                                    <!-- End text content -->
                                                    <!-- Ball on strip -->
                                                    <div class="visible-lg width-20 height-20 circle bg-white bg-colored-hover-item slow left-percent-100 absolute ml--10"></div>
                                                </div>
                                                <!-- End post -->
                                                <!-- Post - ON RIGHT -->
                                                <div class="col-lg-6 col-12 hover-container c-default height-auto relative mt-120 mt-60-sm pl-50 px-15-sm d-flex align-items-center">
                                                    <!-- Text Content -->
                                                    <div class="pt-40 pb-55 px-35 slow bg-white bg-colored-hover-item radius-md fullwidth relative">
                                                        <!-- Date -->
                                                        <h6 class="medium gray7 white-hover-item uppercase slow">Gestione Fornitori</h6>
                                                        <!-- Title -->
                                                        <h4 class="uppercase fs-17 medium white-hover-item gray8 mt-10 slow">
                                                            Gestisci e Organizza
                                                        </h4>
                                                        <!-- Description -->
                                                        <p class="mt-10 gray6 white-hover-item slow">
                                                            Organizza e ordina tutti i tuoi fornitori con informazioni, storico degli ordini e catalogazione di fatture.
                                                        </p>
                                                        <!-- Arrow -->
                                                        <div class="visible-lg b-15 arrow-left b-white b-colored-hover-item slow right-percent-100 top-percent-50 mt--15 absolute"></div>
                                                        <!-- Image and video content -->
                                                        <div class="absolute height-70px left-0 bottom-0 px-30 move-down-half fullwidth d-flex flex-wrap justify-content-lg-start justify-content-start">
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/9.jpg" data-bg="vetrina/images/history/9.jpg" data-fslightbox="18jan2022" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/10.jpg" data-bg="vetrina/images/history/10.jpg" data-fslightbox="18jan2022" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                            <!-- Item -->
                                                            <a href="https://www.youtube.com/watch?v=FT3ODSg1GFE" data-fslightbox="18jan2022" data-type="youtube" class="icon-xl bg-dark2 white b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus">
                                                                <i class="bi-caret-right-fill fs-20"></i>
                                                            </a>
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/7.jpg" data-bg="vetrina/images/history/7.jpg" data-fslightbox="18jan2022" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/6.jpg" data-bg="vetrina/images/history/6.jpg" data-fslightbox="18jan2022" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                        </div>
                                                        <!-- End image and video content -->
                                                    </div>
                                                    <!-- End text content -->
                                                    <!-- Ball on strip -->
                                                    <div class="visible-lg width-20 height-20 circle bg-white bg-colored-hover-item slow right-percent-100 absolute mr--10"></div>
                                                </div>
                                                <!-- End post -->
                                                <!-- Post - ON LEFT -->
                                                <div class="col-lg-6 col-12 hover-container c-default height-auto relative mt-0 mt-60-sm pr-50 px-15-sm d-flex align-items-center">
                                                    <!-- Text Content -->
                                                    <div class="pt-40 pb-55 px-35 slow bg-white bg-colored-hover-item radius-md fullwidth relative">
                                                        <!-- Date -->
                                                        <h6 class="medium gray7 white-hover-item uppercase slow">Gerarchia aziendale</h6>
                                                        <!-- Title -->
                                                        <h4 class="uppercase fs-17 medium white-hover-item gray8 mt-10 slow">
                                                            Gestisci il personale
                                                        </h4>
                                                        <!-- Description -->
                                                        <p class="mt-10 gray6 white-hover-item slow">
                                                            Gestisci le risorse, organizza i ruoli e le competenze, assegnando autorizzazioni e permessi, compartimentando la tua azienda
                                                        </p>

                                                        <!-- Arrow -->
                                                        <div class="visible-lg b-15 arrow-right b-white b-colored-hover-item slow left-percent-100 top-percent-50 mt--15 absolute"></div>
                                                        <!-- Image and video content -->
                                                        <div class="absolute height-70px left-0 bottom-0 px-30 move-down-half fullwidth d-flex flex-wrap justify-content-lg-end justify-content-start">
                                                            <!-- Item -->
                                                            <a href="https://www.youtube.com/watch?v=FT3ODSg1GFE" data-fslightbox="12jan2022" data-type="youtube" class="icon-xl bg-dark2 white b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus">
                                                                <i class="bi-caret-right-fill fs-20"></i>
                                                            </a>
                                                        </div>
                                                        <!-- End image and video content -->
                                                    </div>
                                                    <!-- End text content -->
                                                    <!-- Ball on strip -->
                                                    <div class="visible-lg width-20 height-20 circle bg-white bg-colored-hover-item slow left-percent-100 absolute ml--10"></div>
                                                </div>
                                                <!-- End post -->
                                                <!-- Post - ON RIGHT -->
                                                <div class="col-lg-6 col-12 hover-container c-default height-auto relative mt-70 mt-60-sm pl-50 px-15-sm d-flex align-items-center">
                                                    <!-- Text Content -->
                                                    <div class="pt-40 pb-55 px-35 slow bg-white bg-colored-hover-item radius-md fullwidth relative">
                                                        <!-- Date -->
                                                        <h6 class="medium gray7 white-hover-item uppercase slow">Gestione Clienti</h6>
                                                        <!-- Title -->
                                                        <h4 class="uppercase fs-17 medium white-hover-item gray8 mt-10 slow">
                                                            CLienti
                                                        </h4>
                                                        <!-- Description -->
                                                        <p class="mt-10 gray6 white-hover-item slow">
                                                            Tieni sotto controllo gli ordini dei clienti, puoi in qualsiasi momento filtrare acquisti ordini in pochi secondi.
                                                        </p>
                                                        <!-- Arrow -->
                                                        <div class="visible-lg b-15 arrow-left b-white b-colored-hover-item slow right-percent-100 top-percent-50 mt--15 absolute"></div>
                                                        <!-- Image and video content -->
                                                        <div class="absolute height-70px left-0 bottom-0 px-30 move-down-half fullwidth d-flex flex-wrap justify-content-lg-start justify-content-start">
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/foto_agenda.png" data-bg="vetrina/images/history/foto_agenda.png" data-fslightbox="11jan2022" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                        </div>
                                                        <!-- End image and video content -->
                                                    </div>
                                                    <!-- End text content -->
                                                    <!-- Ball on strip -->
                                                    <div class="visible-lg width-20 height-20 circle bg-white bg-colored-hover-item slow right-percent-100 absolute mr--10"></div>
                                                </div>
                                                <!-- End post -->
                                                <!-- Today button -->
                                                <div class="col-12 mt-70 mt-60-sm t-center relative zi-5">
                                                    <div class="lh-normal py-15 px-30 bg-white dark2 fs-11 bold d-inline-flex radius"></div>
                                                </div>
                                                <!-- Today button -->
                                                <!-- Post - ON LEFT -->
                                                <div class="col-lg-6 col-12 hover-container c-default height-auto relative mt-0 mt-60-sm pr-50 px-15-sm d-flex align-items-center">
                                                    <!-- Text Content -->
                                                    <div class="pt-40 pb-55 px-35 slow bg-white bg-colored-hover-item radius-md fullwidth relative">
                                                        <!-- Date -->
                                                        <h6 class="medium gray7 white-hover-item uppercase slow">Gestione magazzino </h6>

                                                        <!-- Title -->
                                                        <h4 class="uppercase fs-17 medium white-hover-item gray8 mt-10 slow">
                                                            Magazzino
                                                        </h4>
                                                        <!-- Description -->
                                                        <p class="mt-10 gray6 white-hover-item slow">
                                                            Gestisci il tuo magazzino in maniera facile ed efficiente, tieni traccia degli ordini, delle giaceze e delle fatture.
                                                        </p>
                                                        <!-- Arrow -->
                                                        <div class="visible-lg b-15 arrow-right b-white b-colored-hover-item slow left-percent-100 top-percent-50 mt--15 absolute"></div>
                                                        <!-- Image and video content -->
                                                        <div class="absolute height-70px left-0 bottom-0 px-30 move-down-half fullwidth d-flex flex-wrap justify-content-lg-end justify-content-start">
                                                            <!-- Item -->
                                                            <a href="https://www.youtube.com/watch?v=FT3ODSg1GFE" data-fslightbox="12jan2022" data-type="youtube" class="icon-xl bg-dark2 white b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus">
                                                                <i class="bi-caret-right-fill fs-20"></i>
                                                            </a>
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/7.jpg" data-bg="vetrina/images/history/7.jpg" data-fslightbox="24dec2021" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/6.jpg" data-bg="vetrina/images/history/6.jpg" data-fslightbox="24dec2021" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                        </div>
                                                        <!-- End image and video content -->
                                                    </div>
                                                    <!-- End text content -->
                                                    <!-- Ball on strip -->
                                                    <div class="visible-lg width-20 height-20 circle bg-white bg-colored-hover-item slow left-percent-100 absolute ml--10"></div>
                                                </div>
                                                <!-- End post -->
                                                <!-- Post - ON RIGHT -->
                                                <div class="col-lg-6 col-12 hover-container c-default height-auto relative mt-70 mt-60-sm pl-50 px-15-sm d-flex align-items-center">
                                                    <!-- Text Content -->
                                                    <div class="pt-40 pb-55 px-35 slow bg-white bg-colored-hover-item radius-md fullwidth relative">
                                                        <!-- Date -->
                                                        <h6 class="medium gray7 white-hover-item uppercase slow">Sincronizzazione</h6>
                                                        <!-- Title -->
                                                        <h4 class="uppercase fs-17 medium white-hover-item gray8 mt-10 slow">
                                                            Sincronizza
                                                        </h4>
                                                        <!-- Description -->
                                                        <p class="mt-10 gray6 white-hover-item slow">
                                                            Tieni i tuoi dati sempre sincronizzati su tutti i tuoi dispositivi.
                                                        </p>
                                                        <!-- Arrow -->
                                                        <div class="visible-lg b-15 arrow-left b-white b-colored-hover-item slow right-percent-100 top-percent-50 mt--15 absolute"></div>
                                                        <!-- Image and video content -->
                                                        <div class="absolute height-70px left-0 bottom-0 px-30 move-down-half fullwidth d-flex flex-wrap justify-content-lg-start justify-content-start">
                                                            <!-- Item -->
                                                            <a href="vetrina/images/history/4.jpg" data-bg="vetrina/images/history/4.jpg" data-fslightbox="14dec2021" data-type="image" class="icon-xl b-2 b-gray2 width-70 width-45-sm height-70 height-45-sm mx-5 mx-2-sm circle zoom-in-hover slow zoom-out-focus"></a>
                                                        </div>
                                                        <!-- End image and video content -->
                                                    </div>
                                                    <!-- End text content -->
                                                    <!-- Ball on strip -->
                                                    <div class="visible-lg width-20 height-20 circle bg-white bg-colored-hover-item slow right-percent-100 absolute mr--10"></div>
                                                </div>
                                                <!-- End post -->
                                            </div>
                                            <!-- End row for posts and dates -->
                                        </div>
                                        <!-- End history container -->
                                    </section>
                                    <!-- End history section -->
                                    <!-- Button on the bottom of the #history section -->
                                    <div class="relative zi-5 d-flex justify-content-center move-up-half">
                                        <!-- Date button -->
                                        <a href="#history" class="icon-lg bg-gradient4 white rotate--45 radius">
                                            <i class="bi-arrow-up rotate-45 fs-22"></i>
                                        </a>
                                        <!-- End Date button -->
                                    </div>
                                    <!-- End button on the bottom of the #history section -->
                                    <!-- Start works section -->
                                    <section id="works" class="pt-80 pb-100">
                                        <!-- Container for title -->
                                        <div class="container">
                                            <!-- Column 12 for the title -->
                                            <div class="d-flex flex-column align-items-center t-center">
                                                <!-- Title -->
                                                <h1 class="gray8 fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                    Ace crm il nostro Portfolio
                                                </h1>
                                                <!-- Paragraph -->
                                                <p class="mxw-800 d-inline-flex mt-15">
                                                    Grazie al suo sistema modulare e alla personalizzazione il nostro software e adattabile a tutte le attivita´. Tu dicci cosa ti serve e noi lo creeremo per te.
                                                </p>
                                            </div>
                                            <!-- End column 12 for the title -->
                                        </div>
                                        <!-- End container for title -->
                                        <!-- Container for ajax projects -->
                                        <div id="ajax-container" class="ajax-container mt-20 ready-to-load fullwidth height-auto relative">
                                            <div class="project-close-container d-flex justify-content-end absolute left-0 top-0 fullwidth pt-30 pr-30"><button type="button" class="close gray6"><i class="bi-x-lg fs-40"></i></button></div>
                                            <div id="ajax-inner" class="ajax-inner scrollbar-styled"></div>
                                        </div>
                                        <!-- End container for ajax projects -->
                                        <!-- Loader on ajax -->
                                        <div id="ajax-loader-animation" class="ajax-loader-animation">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 width="40px" height="40px" viewBox="0 0 50 50" xml:space="preserve">
                                                <path d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"></path>
                                            </svg>
                                        </div>
                                        <!-- End Loader on ajax -->
                                        <!-- Container for filters -->
                                        <div class="container t-center">
                                            <!-- Filters -->
                                            <div class="filter-options d-inline-flex uppercase bb-1 b-solid b-gray3 fs-11 mt-15 unselectable">
                                                <!-- All, empty -->
                                                <button class="active py-15 px-35 px-10-sm py-10-sm bb-1 b-transparent c-pointer b-colored-active uppercase bold top-1 d-flex justify-content-center" data-group="">
                                                    All
                                                </button>
                                                <!-- Filter item -->
                                                <button class="py-15 px-35 px-10-sm py-10-sm bb-1 b-transparent c-pointer b-colored-active uppercase bold top-1 d-flex justify-content-center" data-group="Healt, Servizi alla persona">
                                                    Healty, Servizi alla persona
                                                </button>
                                                <!-- Filter item -->
                                                <button class="py-15 px-35 px-10-sm py-10-sm bb-1 b-transparent c-pointer b-colored-active uppercase bold top-1 d-flex justify-content-center" data-group="video">
                                                    Home, Design
                                                </button>
                                                <!-- Filter item -->
                                                <button class="py-15 px-35 px-10-sm py-10-sm bb-1 b-transparent c-pointer b-colored-active uppercase bold top-1 d-flex justify-content-center" data-group="art">
                                                    e-commerce, Shop
                                                </button>
                                                <!-- Filter item -->
                                                <button class="py-15 px-35 px-10-sm py-10-sm bb-1 b-transparent c-pointer b-colored-active uppercase bold top-1 d-flex justify-content-center" data-group="photography">
                                                    Tecnologia
                                                </button>
                                            </div>
                                            <!-- End filters -->
                                        </div>
                                        <!-- End container for filters -->
                                        <!-- Container for works -->
                                        <div class="container-fluid mt-50">
                                            <!-- Star works - You can set a filter for init -->
                                            <div id="portfolio" data-default-filter="" class="row block-img unselectable row-cols-xl-5 row-cols-lg-3 row-cols-md-3 row-cols-sm-3 row-cols-xs-1">
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='design branding' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/servizi_turistici_acecrm.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Servizi Turistici
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Prenotazioni Tours,Tranfer</h5>
                                                            </div>
                                                            <a href="vetrina/images/portfolio/._Accessori_acecrm.jpg" data-fslightbox="portfolio" data-type="image" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='art design' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/studi_medici.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Studi Medici
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Gestione, Prenotazoni</h5>
                                                            </div>
                                                            <a href="https://www.youtube.com/watch?v=pWaHZ2oRE7s" title="Quick View" data-fslightbox="portfolio" data-type="youtube" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='photography video' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/centri_sportivi_scuole_di_ballo_acecrm.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Centri sportivi, Scuole di ballo
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize"> Gestione </h5>
                                                            </div>
                                                            <a href="vetrina/images/portfolio/slide1.jpg" title="Quick View" data-fslightbox="portfolio" data-type="image" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='video art' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/servizi_immobiliari_acecrm.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Servizi Immobiliari.
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Servizi</h5>
                                                            </div>
                                                            <a href="https://www.youtube.com/watch?v=ClNY7NO4BDQ" title="Quick View" data-fslightbox="portfolio" data-type="youtube" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='art' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/attivitò_commerciali_acecrm.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Attivita´commerciali.
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Negozi</h5>
                                                            </div>
                                                            <a href="vetrina/images/portfolio/slide3.jpg" title="Quick View" data-fslightbox="portfolio" data-type="image" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='design photography' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/acecmr_e_commerce.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    e-commerce, shop
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Negozio</h5>
                                                            </div>
                                                            <a href="vetrina/images/portfolio/slide4.jpg" title="Quick View" data-fslightbox="portfolio" data-type="image" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='video photography' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/produzioni_sartoriali.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Produzioni sartoriali
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Schede produzione, calcolo spese</h5>
                                                            </div>
                                                            <a href="https://www.youtube.com/watch?v=gYO1uk7vIcc" title="Quick View" data-fslightbox="portfolio" data-type="youtube" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='art' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/Istituti_scolastici.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Istituti scolastici.
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Istituti paritari, scuole private</h5>
                                                            </div>
                                                            <a href="vetrina/images/portfolio/slide5.jpg" title="Quick View" data-fslightbox="portfolio" data-type="image" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='design art' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/servizi_postali.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Servizi Postali
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Poste Private</h5>
                                                            </div>
                                                            <a href="https://www.youtube.com/watch?v=e10pVhxNOco" title="Quick View" data-fslightbox="portfolio" data-type="youtube" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                                <!-- Item -->
                                                <div class="col work-item pb-25" data-groups='photography video' title="Dance">
                                                    <!-- Your image -->
                                                    <div data-project="project-01.html" class="ajax-link bg-soft-6-active has-overlay-hover d-flex c-pointer">
                                                        <!-- Your image -->
                                                        <img src="vetrina/images/portfolio/portfolio-loader.svg" data-src="vetrina/images/portfolio/Delivery.png" alt="Portfolio picture template" class="slow">
                                                            <!-- Overlay div -->
                                                            <div class="overlay-hover bg-soft-6 bg-soft-dark8 slow-lg"><i class="bi-arrow-up white fs-26"></i></div>
                                                    </div>
                                                    <!-- Details -->
                                                    <div class="details bg-white b-1 bt-0 b-gray3">
                                                        <div class="row row-eq-height justify-content-between mx-0">
                                                            <div class="col-9 px-20 py-20 lh-normal">
                                                                <h3 class="fs-15 mt-3 dark4 lh-normal" title="How long can rocks withstand waves?">
                                                                    Delivery
                                                                </h3>
                                                                <h5 class="fs-13 gray6 mt-3 capitalize">Spedizioni</h5>
                                                            </div>
                                                            <a href="https://www.youtube.com/watch?v=e10pVhxNOco" title="Quick View" data-fslightbox="portfolio" data-type="youtube" class="col-3 mxw-80 bl-1 b-gray3 d-flex align-items-center justify-content-center t-center bg-gray-hover">
                                                                <i class="bi-plus-lg fs-20"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- End details -->
                                                </div>
                                                <!-- End item -->
                                            </div>
                                            <!-- End works -->
                                        </div>
                                        <!-- End container for works -->
                                    </section>
                                    <!-- End works section -->
                                    <!-- Why We section -->
                                    <section id="why-we" class="pt-100 pb-80 has-parallax">
                                        <!-- Parallax background -->
                                        <div class="parallax" data-bg="vetrina/images/Computer_software_5_acecrm .png" data-target="#why-we" data-bottom-top="transform:translate3d(0px,-200px,0px);" data-top-bottom="transform:translate3d(0px,200px,0px);"></div>
                                        <!-- Container for all -->
                                        <div class="container">
                                            <!-- Row for both area -->
                                            <div class="row">
                                                <!-- Column for hotspots -->
                                                <div class="col-lg-5 col-10">
                                                    <div class="hotspots">
                                                        <!-- Your map image -->
                                                        <!-- You can select your position with same map: https://snazzymaps.com/style/38/shades-of-grey -->
                                                        <img src="vetrina/images/iphone-loader.svg" data-src="vetrina/images/iphone_2.png" alt="mobile image template">
                                                            <!-- Items -->
                                                            <div class="items pointer-events-none">
                                                                <!-- Item -->
                                                                <div style="left:37.2%; bottom:71.2%;" class="item animated fast" data-animation="blurIn" data-animation-delay="0">
                                                                    <div class="width-250 width-120-sm height-40 bl-1 bb-1 b-gray5 d-flex align-items-end justify-content-end relative pointer-events-all">
                                                                        <span class="width-10 height-10 bg-gray5 circle absolute left-0 top-0 ml--5 mb-3"></span>
                                                                        <button type="button"
                                                                                data-bs-toggle="popover"
                                                                                data-bs-trigger="hover"
                                                                                data-bs-placement="left"
                                                                                data-bs-html="true"
                                                                                data-show="true"
                                                                                title="<h4 class='fs-19'>This is a shortcode!</h4>"
                                                                                data-bs-content="<p class='mt-10 lh-25 fs-15'>If you use this site regularly and would like to help keep the site on the Internet</p>"
                                                                                class="icon-md bg-dark circle bg-colored-hover white slow move-downright-half">
                                                                            <i class="bi-plus-lg"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <!-- Item -->
                                                                <div style="left:47.2%; bottom:51.3%;" class="item animated fast" data-animation="blurIn" data-animation-delay="50">
                                                                    <div class="width-250 width-120-sm height-40 bt-1 b-gray5 d-flex align-items-start justify-content-end relative pointer-events-all">
                                                                        <span class="width-10 height-10 bg-gray5 circle absolute left-0 top-0 ml--5 move-up-half"></span>
                                                                        <button type="button"
                                                                                data-bs-toggle="popover"
                                                                                data-bs-trigger="hover"
                                                                                data-bs-placement="top"
                                                                                data-bs-html="true"
                                                                                data-show="true"
                                                                                title="<h4 class='fs-19'>This is a shortcode!</h4>"
                                                                                data-bs-content="<p class='mt-10 lh-25 fs-15'>If you use this site regularly and would like to help keep the site on the Internet</p>"
                                                                                class="icon-md bg-dark circle bg-colored-hover white slow move-upright-half">
                                                                            <i class="bi-plus-lg"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <!-- Item -->
                                                                <div style="left:57.2%; bottom:37.8%;" class="item animated fast" data-animation="blurIn" data-animation-delay="100">
                                                                    <div class="width-250 width-120-sm height-40 bl-1 bt-1 b-gray5 d-flex align-items-start justify-content-end relative pointer-events-all">
                                                                        <span class="width-10 height-10 bg-gray5 circle absolute left-0 bottom-0 ml--5 mt-3"></span>
                                                                        <button type="button"
                                                                                data-bs-toggle="popover"
                                                                                data-bs-trigger="hover"
                                                                                data-bs-placement="bottom"
                                                                                data-bs-html="true"
                                                                                data-show="true"
                                                                                title="<h4 class='fs-19'>This is a shortcode!</h4>"
                                                                                data-bs-content="<p class='mt-10 lh-25 fs-15'>If you use this site regularly and would like to help keep the site on the Internet</p>"
                                                                                class="icon-md bg-dark circle bg-colored-hover white slow move-upright-half">
                                                                            <i class="bi-plus-lg"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End items -->
                                                    </div>
                                                </div>
                                                <!-- End column for hotspots -->
                                                <!-- Column for accordion -->
                                                <div class="col-lg-6 offset-lg-1">
                                                    <h1 class="gray8 fs-40 lh-40 medium font-secondary uppercase">
                                                        Perche´ <span class="font-tertiary colored capitalize fs-40">Lo Amerai?</span>
                                                    </h1>
                                                    <p class="mt-10">
                                                        Ci sono tante ragioni che ti porteranno ad amare <Span class="font-tertiary colored capitalize fs-40">Ace Crm</span>. La prima ? la semplicita´e la sua estrema versatilita´.                                         </p>
                                                    <!-- Accordion -->
                                                    <div id="accordionBar" class="mt-15">
                                                        <!-- Accordion bar -->
                                                        <div data-bs-target="#acc-01" aria-controls="acc-01" aria-expanded="true" data-bs-toggle="collapse" role="button"
                                                             class="acc-bar d-flex align-items-center black c-pointer flex-wrap slow opacity-5-hover">
                                                            <!-- Left icon and texts -->
                                                            <div class="d-flex align-items-center justify-content-start py-10">
                                                                <!-- Icon -->
                                                                <div class="width-45 height-45 radius-lg d-flex align-items-center justify-content-center bg-dark2 white">
                                                                    <i class="bi-clipboard2-pulse"></i>
                                                                </div>
                                                                <!-- Texts -->
                                                                <div class="ml-15">
                                                                    <h4 class="fs-16 fs-14-sm">Esso infatti di adatta a tutti gli scenari.</h4>
                                                                </div>
                                                            </div>
                                                            <!-- Right icons -->
                                                            <div class="ml-auto pl-40">
                                                                <i class="ti-plus gray6"></i>
                                                                <i class="ti-minus gray6"></i>
                                                            </div>
                                                        </div>
                                                        <!-- End accordion bar -->
                                                        <!-- End left icon and texts -->
                                                        <!-- Card body -->
                                                        <div id="acc-01" class="collapse show fullwidth fs-14 gray7" data-bs-parent="#accordionBar">
                                                            <div class="p-3 pb-30">
                                                                <!-- Paragraph -->
                                                                <p class="fs-18 fs-16-sm dark2 lh-30">
                                                                    Sviluppo e crescita continua sono le parole d'ordine di questo straordinario software, che in 2 anni ha aggiunto funzionalità avanzate e ampliato il suo campo di applicazione. infatti può essere impiegato sia dalle grandi aziende dalle piccole e medie fino alle grandi con analisi di costi benefici creazioni di commesse
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- End card body -->
                                                        <!-- Accordion bar -->
                                                        <div data-bs-target="#acc-02" aria-controls="acc-02" aria-expanded="false" data-bs-toggle="collapse" role="button"
                                                             class="acc-bar d-flex align-items-center black c-pointer flex-wrap slow opacity-5-hover">
                                                            <!-- Left icon and texts -->
                                                            <div class="d-flex align-items-center justify-content-start py-15">
                                                                <!-- Icon -->
                                                                <div class="width-45 height-45 radius-lg d-flex align-items-center justify-content-center bg-dark2 white">
                                                                    <i class="bi-clipboard-data"></i>
                                                                </div>
                                                                <!-- Texts -->
                                                                <div class="ml-15">
                                                                    <h4 class="fs-16 fs-14-sm">It has roots in a piece of classical Latin literature from</h4>
                                                                </div>
                                                            </div>
                                                            <!-- Right icons -->
                                                            <div class="ml-auto pl-40">
                                                                <i class="ti-plus gray6"></i>
                                                                <i class="ti-minus gray6"></i>
                                                            </div>
                                                        </div>
                                                        <!-- End accordion bar -->
                                                        <!-- End left icon and texts -->
                                                        <!-- Card body -->
                                                        <div id="acc-02" class="collapse fullwidth fs-14 gray7" data-bs-parent="#accordionBar">
                                                            <div class="p-3 pb-30">
                                                                <!-- Paragraph -->
                                                                <p class="fs-18 fs-16-sm dark2 lh-30">
                                                                    Duis ac fringilla libero. Curabitur vel placerat felis. Nam varius, velit in porttitor pulvinar, mi augue convallis felis, ut ultrices lectus felis in enim. Mauris vel gravida nisi. Vivamus ut placerat odio, a tempus velit. Ut eu bibendum odio, at imperdiet augue. Cras non placerat libero. Sed nec finibus elit, at finibus ligula.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- End card body -->
                                                        <!-- Accordion bar -->
                                                        <div data-bs-target="#acc-03" aria-controls="acc-03" aria-expanded="false" data-bs-toggle="collapse" role="button"
                                                             class="acc-bar d-flex align-items-center black c-pointer flex-wrap slow opacity-5-hover">
                                                            <!-- Left icon and texts -->
                                                            <div class="d-flex align-items-center justify-content-start py-15">
                                                                <!-- Icon -->
                                                                <div class="width-45 height-45 radius-lg d-flex align-items-center justify-content-center bg-dark2 white">
                                                                    <i class="bi-building"></i>
                                                                </div>
                                                                <!-- Texts -->
                                                                <div class="ml-15">
                                                                    <h4 class="fs-16 fs-14-sm">Sydney College in Virginia, looked up one of the more obscure Latin .</h4>
                                                                </div>
                                                            </div>
                                                            <!-- Right icons -->
                                                            <div class="ml-auto pl-40">
                                                                <i class="ti-plus gray6"></i>
                                                                <i class="ti-minus gray6"></i>
                                                            </div>
                                                        </div>
                                                        <!-- End accordion bar -->
                                                        <!-- End left icon and texts -->
                                                        <!-- Card body -->
                                                        <div id="acc-03" class="collapse fullwidth fs-14 gray7" data-bs-parent="#accordionBar">
                                                            <div class="p-3 pb-30">
                                                                <!-- Paragraph -->
                                                                <p class="fs-18 fs-16-sm dark2 lh-30">
                                                                    Duis ac fringilla libero. Curabitur vel placerat felis. Nam varius, velit in porttitor pulvinar, mi augue convallis felis, ut ultrices lectus felis in enim. Mauris vel gravida nisi. Vivamus ut placerat odio, a tempus velit. Ut eu bibendum odio, at imperdiet augue. Cras non placerat libero. Sed nec finibus elit, at finibus ligula.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- End card body -->
                                                        <!-- Accordion bar -->
                                                        <div data-bs-target="#acc-04" aria-controls="acc-04" aria-expanded="false" data-bs-toggle="collapse" role="button"
                                                             class="acc-bar d-flex align-items-center black c-pointer flex-wrap slow opacity-5-hover">
                                                            <!-- Left icon and texts -->
                                                            <div class="d-flex align-items-center justify-content-start py-15">
                                                                <!-- Icon -->
                                                                <div class="width-45 height-45 radius-lg d-flex align-items-center justify-content-center bg-dark2 white">
                                                                    <i class="bi-fan"></i>
                                                                </div>
                                                                <!-- Texts -->
                                                                <div class="ml-15">
                                                                    <h4 class="fs-16 fs-14-sm">Sed ut perspiciatis unde.</h4>
                                                                </div>
                                                            </div>
                                                            <!-- Right icons -->
                                                            <div class="ml-auto pl-40">
                                                                <i class="ti-plus gray6"></i>
                                                                <i class="ti-minus gray6"></i>
                                                            </div>
                                                        </div>
                                                        <!-- End accordion bar -->
                                                        <!-- End left icon and texts -->
                                                        <!-- Card body -->
                                                        <div id="acc-04" class="collapse fullwidth fs-14 gray7" data-bs-parent="#accordionBar">
                                                            <div class="p-3 pb-30">
                                                                <!-- Paragraph -->
                                                                <p class="fs-18 fs-16-sm dark2 lh-30">
                                                                    Duis ac fringilla libero. Curabitur vel placerat felis. Nam varius, velit in porttitor pulvinar, mi augue convallis felis, ut ultrices lectus felis in enim. Mauris vel gravida nisi. Vivamus ut placerat odio, a tempus velit. Ut eu bibendum odio, at imperdiet augue. Cras non placerat libero. Sed nec finibus elit, at finibus ligula.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- End card body -->
                                                    </div>
                                                    <!-- End accordion -->
                                                </div>
                                                <!-- End column for accordion -->
                                            </div>
                                            <!-- End row for both area -->
                                        </div>
                                        <!-- End container for all -->
                                    </section>
                                    <!-- End why We section -->
                                    <!-- Start demo section -->
                                    <section id="demo" class="py-100">
                                        <!-- Container for title -->
                                        <div class="container">
                                            <!-- Column 12 for the title -->
                                            <div class="d-flex flex-column align-items-center t-center">
                                                <!-- Title -->
                                                <h1 class="gray8 fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                    Oxygen's Creative Team
                                                </h1>
                                                <!-- Paragraph -->
                                                <p class="mxw-800 d-inline-flex mt-15">
                                                    On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and by the charms of pleasure of the moment, so blinded by desire
                                                </p>
                                            </div>
                                            <!-- End column 12 for the title -->
                                        </div>
                                        <!-- End container for title -->
                                        <!-- Container for the team members -->
                                        <div class="container mt-30">
                                            <!-- Row for all members -->
                                            <div class="row">
                                                <!-- Member column -->
                                                <div class="col-lg-4 col-sm-6 col-12 mt-30 has-overlay-hover">
                                                    <!-- Container for member details -->
                                                    <div class="has-overlay animated-container block-img">
                                                        <!-- Employee image -->
                                                        <img src="vetrina/images/demo/Shop.png" data-src="vetrina/images/demo/Shop.png" alt="example employee photo">
                                                            <!-- Employee details -->
                                                            <div class="overlay-hover bg-blur bg-soft-6 bg-soft-dark5 flex-column slow">
                                                                <!-- Name -->
                                                                <h2 class="uppercase font-secondary medium white animated-hover fast" data-animation="fadeInDown" data-animation-delay="0">
                                                                    Gestione Negozi
                                                                </h2>
                                                                <!-- Position -->
                                                                <p class ="uppercase colored fs-13 medium mt-5 animated-hover fast t-center" data-animation="fadeInDown" data-animation-delay="50">
                                                                    Demo : username demonegozio@acecrm.it, password cambiami, azienda Negozio
                                                                </p>
                                                                <!-- Social networks -->
                                                                <div class="d-flex justify-content-center white mt-15 fs-17">
                                                                    <a href="https://twitter.com/gldeyes" target="_blank" class="mx-10 color-twitter-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="150">
                                                                        <i class="bi-twitter"></i>
                                                                    </a>
                                                                    <a href="https://facebook.com/gldeyes" target="_blank" class="mx-10 color-facebook-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="200">
                                                                        <i class="bi-facebook"></i>
                                                                    </a>
                                                                    <a href="https://instagram.com/goldeyestheme" target="_blank" class="mx-10 color-instagram-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="250">
                                                                        <i class="bi-instagram"></i>
                                                                    </a>
                                                                    <a href="https://www.linkedin.com/company/gold-eyes-studio" target="_blank" class="mx-10 color-linkedin-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="300">
                                                                        <i class="bi-linkedin"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- End container for member details -->
                                                </div>
                                                <!-- End member column -->
                                                <!-- Member column -->
                                                <div class="col-lg-4 col-sm-6 col-12 mt-30 has-overlay-hover">
                                                    <!-- Container for member details -->
                                                    <div class="has-overlay animated-container block-img">
                                                        <!-- Employee image -->
                                                        <img src="vetrina/images/demo/Travels.png" data-src="vetrina/images/demo/Travels.png" alt="example employee photo">
                                                            <!-- Employee details -->
                                                            <div class="overlay-hover bg-blur bg-soft-6 bg-soft-dark5 flex-column slow">
                                                                <!-- Name -->
                                                                <h2 class ="uppercase font-secondary medium white animated-hover fast" data-animation="fadeInDown" data-animation-delay="0">
                                                                    Gestione Viaggi
                                                                </h2>
                                                                <!-- Position -->
                                                                <p class ="uppercase colored fs-13 medium mt-5 animated-hover fast t-center" data-animation="fadeInDown" data-animation-delay="50">
                                                                    Demo : username demoviaggi@acecrm.it, password cambiami, azienda Viaggi
                                                                </p>
                                                                <!-- Social networks -->
                                                                <div class="d-flex justify-content-center white mt-15 fs-17">
                                                                    <a href="https://twitter.com/gldeyes" target="_blank" class="mx-10 color-twitter-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="150">
                                                                        <i class="bi-twitter"></i>
                                                                    </a>
                                                                    <a href="https://facebook.com/gldeyes" target="_blank" class="mx-10 color-facebook-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="200">
                                                                        <i class="bi-facebook"></i>
                                                                    </a>
                                                                    <a href="https://instagram.com/goldeyestheme" target="_blank" class="mx-10 color-instagram-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="250">
                                                                        <i class="bi-instagram"></i>
                                                                    </a>
                                                                    <a href="https://www.linkedin.com/company/gold-eyes-studio" target="_blank" class="mx-10 color-linkedin-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="300">
                                                                        <i class="bi-linkedin"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- End container for member details -->
                                                </div>
                                                <!-- End member column -->
                                                <!-- Member column -->
                                                <div class="col-lg-4 col-sm-6 col-12 mt-30 has-overlay-hover">
                                                    <!-- Container for member details -->
                                                    <div class="has-overlay animated-container block-img">
                                                        <!-- Employee image -->
                                                        <img src="vetrina/images/demo/RentBuy.png" data-src="vetrina/images/demo/RentBuy.png" alt="example employee photo">
                                                            <!-- Employee details -->
                                                            <div class="overlay-hover bg-blur bg-soft-6 bg-soft-dark5 flex-column slow">
                                                                <!-- Name -->
                                                                <h2 class ="uppercase font-secondary medium white animated-hover fast" data-animation="fadeInDown" data-animation-delay="0">
                                                                    Gestione
                                                                </h2>
                                                                <h2 class ="uppercase font-secondary medium white animated-hover fast" data-animation="fadeInDown" data-animation-delay="0">
                                                                    Vendita/Affitto Case
                                                                </h2>
                                                                <!-- Position -->
                                                                <p class ="uppercase colored fs-13 medium mt-5 animated-hover fast t-center" data-animation="fadeInDown" data-animation-delay="50">
                                                                    Demo : username demohouse@acecrm.it, password cambiami, azienda House
                                                                </p>
                                                                <!-- Social networks -->
                                                                <div class="d-flex justify-content-center white mt-15 fs-17">
                                                                    <a href="https://twitter.com/gldeyes" target="_blank" class="mx-10 color-twitter-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="150">
                                                                        <i class="bi-twitter"></i>
                                                                    </a>
                                                                    <a href="https://facebook.com/gldeyes" target="_blank" class="mx-10 color-facebook-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="200">
                                                                        <i class="bi-facebook"></i>
                                                                    </a>
                                                                    <a href="https://instagram.com/goldeyestheme" target="_blank" class="mx-10 color-instagram-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="250">
                                                                        <i class="bi-instagram"></i>
                                                                    </a>
                                                                    <a href="https://www.linkedin.com/company/gold-eyes-studio" target="_blank" class="mx-10 color-linkedin-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="300">
                                                                        <i class="bi-linkedin"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- End container for member details -->
                                                </div>
                                                <!-- End member column -->
                                                 <!-- Member column -->
                                                <div class="col-lg-4 col-sm-6 col-12 mt-30 has-overlay-hover">
                                                    <!-- Container for member details -->
                                                    <div class="has-overlay animated-container block-img">
                                                        <!-- Employee image -->
                                                        <img src="vetrina/images/demo/ShopGold.jpg" data-src="vetrina/images/demo/ShopGold.jpg" alt="example employee photo">
                                                            <!-- Employee details -->
                                                            <div class="overlay-hover bg-blur bg-soft-6 bg-soft-dark5 flex-column slow">
                                                                <!-- Name -->
                                                                <h2 class="uppercase font-secondary medium white animated-hover fast" data-animation="fadeInDown" data-animation-delay="0">
                                                                    Gestione Negozi ORO
                                                                </h2>
                                                                <!-- Position -->
                                                                <p class ="uppercase colored fs-13 medium mt-5 animated-hover fast t-center" data-animation="fadeInDown" data-animation-delay="50">
                                                                    Demo : username demonegoziooro@acecrm.it, password cambiami, azienda Negozio
                                                                </p>
                                                                <!-- Social networks -->
                                                                <div class="d-flex justify-content-center white mt-15 fs-17">
                                                                    <a href="https://twitter.com/gldeyes" target="_blank" class="mx-10 color-twitter-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="150">
                                                                        <i class="bi-twitter"></i>
                                                                    </a>
                                                                    <a href="https://facebook.com/gldeyes" target="_blank" class="mx-10 color-facebook-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="200">
                                                                        <i class="bi-facebook"></i>
                                                                    </a>
                                                                    <a href="https://instagram.com/goldeyestheme" target="_blank" class="mx-10 color-instagram-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="250">
                                                                        <i class="bi-instagram"></i>
                                                                    </a>
                                                                    <a href="https://www.linkedin.com/company/gold-eyes-studio" target="_blank" class="mx-10 color-linkedin-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="300">
                                                                        <i class="bi-linkedin"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- End container for member details -->
                                                </div>
                                                <!-- End member column -->
                                                <!-- Member column -->
                                                <div class="col-lg-4 col-sm-6 col-12 mt-30 has-overlay-hover">
                                                    <!-- Container for member details -->
                                                    <div class="has-overlay animated-container block-img">
                                                        <!-- Employee image -->
                                                        <img src="vetrina/images/demo/ERP.png" data-src="vetrina/images/demo/ERP.png" alt="example employee photo">
                                                            <!-- Employee details -->
                                                            <div class="overlay-hover bg-blur bg-soft-6 bg-soft-dark5 flex-column slow">
                                                                <!-- Name -->
                                                                <h2 class="uppercase font-secondary medium white animated-hover fast" data-animation="fadeInDown" data-animation-delay="0">
                                                                    ERP
                                                                </h2>
                                                                <!-- Position -->
                                                                <p class ="uppercase colored fs-13 medium mt-5 animated-hover fast t-center" data-animation="fadeInDown" data-animation-delay="50">
                                                                    Demo : username demonherp@acecrm.it, password cambiami, azienda ERP
                                                                </p>
                                                                <!-- Social networks -->
                                                                <div class="d-flex justify-content-center white mt-15 fs-17">
                                                                    <a href="https://twitter.com/gldeyes" target="_blank" class="mx-10 color-twitter-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="150">
                                                                        <i class="bi-twitter"></i>
                                                                    </a>
                                                                    <a href="https://facebook.com/gldeyes" target="_blank" class="mx-10 color-facebook-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="200">
                                                                        <i class="bi-facebook"></i>
                                                                    </a>
                                                                    <a href="https://instagram.com/goldeyestheme" target="_blank" class="mx-10 color-instagram-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="250">
                                                                        <i class="bi-instagram"></i>
                                                                    </a>
                                                                    <a href="https://www.linkedin.com/company/gold-eyes-studio" target="_blank" class="mx-10 color-linkedin-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="300">
                                                                        <i class="bi-linkedin"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- End container for member details -->
                                                </div>
                                                <!-- End member column -->
                                                <!-- Member column -->
                                                <div class="col-lg-4 col-sm-6 col-12 mt-30 has-overlay-hover">
                                                    <!-- Container for member details -->
                                                    <div class="has-overlay animated-container block-img">
                                                        <!-- Employee image -->
                                                        <img src="vetrina/images/demo/TuttoPratiche.jpg" data-src="vetrina/images/demo/TuttoPratiche.jpg" alt="example employee photo">
                                                            <!-- Employee details -->
                                                            <div class="overlay-hover bg-blur bg-soft-6 bg-soft-dark5 flex-column slow">
                                                                <!-- Name -->
                                                                <h2 class="uppercase font-secondary medium white animated-hover fast" data-animation="fadeInDown" data-animation-delay="0">
                                                                    Gestione Tutte Pratiche
                                                                </h2>
                                                                <!-- Position -->
                                                                <p class ="uppercase colored fs-13 medium mt-5 animated-hover fast t-center" data-animation="fadeInDown" data-animation-delay="50">
                                                                    Demo : username demopratiche@acecrm.it, password cambiami, azienda Viaggi
                                                                </p>
                                                                <!-- Social networks -->
                                                                <div class="d-flex justify-content-center white mt-15 fs-17">
                                                                    <a href="https://twitter.com/gldeyes" target="_blank" class="mx-10 color-twitter-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="150">
                                                                        <i class="bi-twitter"></i>
                                                                    </a>
                                                                    <a href="https://facebook.com/gldeyes" target="_blank" class="mx-10 color-facebook-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="200">
                                                                        <i class="bi-facebook"></i>
                                                                    </a>
                                                                    <a href="https://instagram.com/goldeyestheme" target="_blank" class="mx-10 color-instagram-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="250">
                                                                        <i class="bi-instagram"></i>
                                                                    </a>
                                                                    <a href="https://www.linkedin.com/company/gold-eyes-studio" target="_blank" class="mx-10 color-linkedin-hover animated-hover fast" data-animation="fadeInDown" data-animation-delay="300">
                                                                        <i class="bi-linkedin"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- End container for member details -->
                                                </div>
                                                <!-- End member column -->
                                            </div>
                                            <!-- End row for all members -->
                                        </div>
                                        <!-- End container for the team members -->
                                    </section>
                                    <!-- End demo section -->
                                    <!-- Start facts section -->
                                    <section id="fun-facts" class="py-100 bt-1 b-gray3">
                                        <!-- Container for title -->
                                        <div class="container">
                                            <!-- Column 12 for the title -->
                                            <div class="d-flex flex-column align-items-center t-center">
                                                <!-- Title -->
                                                <h1 class="gray8 fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                    Retina ready and <span class="colored">professionel</span> design
                                                </h1>
                                                <!-- Paragraph -->
                                                <p class="mxw-800 d-inline-flex mt-15">
                                                    On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and by the charms of pleasure of the moment, so blinded by desire
                                                </p>
                                            </div>
                                            <!-- End column 12 for the title -->
                                        </div>
                                        <!-- End container for title -->
                                        <!-- Container for the team members -->
                                        <div class="container mt-50">
                                            <!-- Row for all members -->
                                            <div class="row">
                                                <!-- Fullwidth column for iMac design -->
                                                <div class="col-12 mt-30">
                                                    <!-- Image -->
                                                    <img src="vetrina/images/mac-loader.svg" data-src="vetrina/images/mac_Ace.png" alt="mobile image template" class="block fullwidth">
                                                </div>
                                                <!-- End fullwidth column for iMac design -->
                                                <!-- Column for fact -->
                                                <div class="col-lg-3 col-sm-6 col-6 mt-50">
                                                    <!-- Keeper for icon and countdowns -->
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl width-60-sm height-60-sm c-default white bg-dark relative">
                                                            <i class="bi-battery-charging fs-30 fs-20-sm"></i>
                                                            <span class="arrow-right b-dark absolute left-percent-100"></span>
                                                        </div>
                                                        <!-- End icon -->
                                                        <!-- Counter -->
                                                        <div class="ml-30 ml-15-sm t-center t-left-sm uppercase">
                                                            <div class="fact font-secondary fs-80 fs-40-sm lh-60 lh-40-sm" data-source="340"><span class="factor">0</span></div>
                                                            <p class="fs-14 mt-5">
                                                                PROJECT FINISHED
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End keeper for icon and countdowns -->
                                                </div>
                                                <!-- End column for fact -->
                                                <!-- Column for fact -->
                                                <div class="col-lg-3 col-sm-6 col-6 mt-50">
                                                    <!-- Keeper for icon and countdowns -->
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl width-60-sm height-60-sm c-default white bg-dark relative">
                                                            <i class="bi-award-fill fs-30 fs-20-sm"></i>
                                                            <span class="arrow-right b-dark absolute left-percent-100"></span>
                                                        </div>
                                                        <!-- End icon -->
                                                        <!-- Counter -->
                                                        <div class="ml-30 ml-15-sm t-center t-left-sm uppercase">
                                                            <div class="fact font-secondary fs-80 fs-40-sm lh-60 lh-40-sm" data-source="1245"><span class="factor">0</span></div>
                                                            <p class="fs-14 mt-5">
                                                                Pizza ordered
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End keeper for icon and countdowns -->
                                                </div>
                                                <!-- End column for fact -->
                                                <!-- Column for fact -->
                                                <div class="col-lg-3 col-sm-6 col-6 mt-50">
                                                    <!-- Keeper for icon and countdowns -->
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl width-60-sm height-60-sm c-default white bg-dark relative">
                                                            <i class="bi-cup-hot-fill fs-30 fs-20-sm"></i>
                                                            <span class="arrow-right b-dark absolute left-percent-100"></span>
                                                        </div>
                                                        <!-- End icon -->
                                                        <!-- Counter -->
                                                        <div class="ml-30 ml-15-sm t-center t-left-sm uppercase">
                                                            <div class="fact font-secondary fs-80 fs-40-sm lh-60 lh-40-sm" data-source="2425"><span class="factor">0</span></div>
                                                            <p class="fs-14 mt-5">
                                                                Coffee cups
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End keeper for icon and countdowns -->
                                                </div>
                                                <!-- End column for fact -->
                                                <!-- Column for fact -->
                                                <div class="col-lg-3 col-sm-6 col-6 mt-50">
                                                    <!-- Keeper for icon and countdowns -->
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl width-60-sm height-60-sm c-default white bg-dark relative">
                                                            <i class="bi-calendar-range fs-30 fs-20-sm"></i>
                                                            <span class="arrow-right b-dark absolute left-percent-100"></span>
                                                        </div>
                                                        <!-- End icon -->
                                                        <!-- Counter -->
                                                        <div class="ml-30 ml-15-sm t-center t-left-sm uppercase">
                                                            <div class="fact font-secondary fs-80 fs-40-sm lh-60 lh-40-sm" data-source="5145"><span class="factor">0</span></div>
                                                            <p class="fs-14 mt-5">
                                                                Days worked
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End keeper for icon and countdowns -->
                                                </div>
                                                <!-- End column for fact -->
                                            </div>
                                            <!-- End row for all members -->
                                        </div>
                                        <!-- End container for the team members -->
                                    </section>
                                    <!-- End facts section -->
                                    <!-- Video section -->
                                    <section id="video" class="has-parallax py-250 bg-pattern d-flex align-items-center justify-content-center" data-bg="vetrina/images/video_3.mp4">
                                        <!-- Your video -->
                                        <div data-video-id="K3YxqjUvu1M" data-startAt="0" data-endAt="" id="youtubeVideo" class="youtube-video zi-0 pointer-events-none"></div>
                                        <!-- Button -->
                                        <a href="#contact" class="p-4 bg-soft-0 bg-soft-4-hover bg-soft-dark4 slow t-center white d-flex align-items-center flex-column">
                                            <!-- Icon -->
                                            <img src="vetrina/images/icon-01.png" alt="icon template" class="d-block">
                                                <!-- Text -->
                                                <p class="mt-15 pl-15 pr-15 bl-3 br-3 b-white uppercase bold fs-50 fs-30-sm lh-40 lh-30-sm font-secondary">
                                                    <span class="relative bottom-2">
                                                        Keep in touch
                                                    </span>
                                                </p>
                                        </a>
                                    </section>
                                    <!-- End video section -->
                                    <!-- Start prices section -->
                                    <section id="prices" class="py-100">
                                        <!-- Container for title -->
                                        <div class="container">
                                            <!-- Column 12 for the title -->
                                            <div class="d-flex flex-column align-items-center t-center">
                                                <!-- Title -->
                                                <h1 class="gray8 fs-50 fs-40-sm lh-50 lh-45-sm medium font-secondary uppercase">
                                                    Our pricing tables
                                                </h1>
                                                <!-- Paragraph -->
                                                <p class="mxw-800 d-inline-flex mt-15">
                                                    On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and by the charms of pleasure of the moment, so blinded by desire
                                                </p>
                                            </div>
                                            <!-- End column 12 for the title -->
                                        </div>
                                        <!-- End container for title -->
                                        <!-- Container for the pricing tables -->
                                        <div class="container mt-40">
                                            <!-- Row for all tables -->
                                            <div class="row">
                                                <!-- Table -->
                                                <div class="col-lg-3 col-sm-6 col-12 mt-30">
                                                    <!-- Top area with image and name -->
                                                    <div class="fullwidth height-300 bg-pattern-grid p-lg-5 p-3 d-flex align-items-start bg-soft-4 bg-soft-dark4 justify-content-center t-center" data-bg="vetrina/images/prices/Tariffe.png">
                                                        <h3 class="bold uppercase t-shadow white">
                                                            Gestione Negozi
                                                        </h3>
                                                    </div>
                                                    <!-- Points list and price circle -->
                                                    <div class="pb-30 b-1 b-gray3 d-flex align-items-center justify-content-center flex-column relative zi-5">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl bg-white move-up-half circle flex-column bs-inset">
                                                            <span class="font-secondary medium fs-40 lh-45 gray8">
                                                                100€
                                                            </span>
                                                            <span class="fs-10 uppercase">
                                                                Mensili
                                                            </span>
                                                        </div>
                                                        <!-- Start list -->
                                                        <ul class="p-0 mt--15 uppercase bold fs-13 gray8 t-center fullwidth">
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Multi Negozi</span>
                                                            </li>
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Sincronizzazione con CMS</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Magazzino</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Generazione Barcode</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Assistenza 12H</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Customizzazione dei Moduli</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Autorizzazione Multilivello</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Customizzazione dei Moduli</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Autorizzazione Multilivello</span>
                                                            </li>
                                                        </ul>
                                                        <!-- Purchase button -->
                                                        <a href="#" class="btn-sm mt-10 radius-0 bg-dark uppercase white bg-colored-hover bold slow">
                                                            Buy now
                                                        </a>
                                                    </div>
                                                    <!-- End points list -->
                                                </div>
                                                <!-- End table -->
                                                <!-- Table -->
                                                <div class="col-lg-3 col-sm-6 col-12 mt-30">
                                                    <!-- Top area with image and name -->
                                                    <div class="fullwidth height-300 bg-pattern-grid p-lg-5 p-3 d-flex align-items-start bg-soft-4 bg-soft-dark4 justify-content-center t-center" data-bg="vetrina/images/prices/Tariffe.png">
                                                        <h3 class="bold uppercase t-shadow white">
                                                            Gestione Viaggi
                                                        </h3>
                                                    </div>
                                                    <!-- Points list and price circle -->
                                                    <div class="pb-30 b-1 b-gray3 d-flex align-items-center justify-content-center flex-column relative zi-5">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl bg-white move-up-half circle flex-column bs-inset">
                                                            <span class="font-secondary medium fs-40 lh-45 gray8">
                                                                100€
                                                            </span>
                                                            <span class="fs-10 uppercase">
                                                                Mensili
                                                            </span>
                                                        </div>
                                                        <!-- Start list -->
                                                        <ul class="p-0 mt--15 uppercase bold fs-13 gray8 t-center fullwidth">
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Prenotazione</span>
                                                            </li>
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Pagamenti</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Report pagamenti</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Sito Vetrina</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Assistenza 12H</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Customizzazione dei Moduli</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Autorizzazione Multilivello</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Sito Vetrina</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Assistenza 12H</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Customizzazione dei Moduli</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Autorizzazione Multilivello</span>
                                                            </li>       
                                                        </ul>
                                                        <!-- Purchase button -->
                                                        <a href="#" class="btn-sm mt-10 radius-0 bg-dark uppercase white bg-colored-hover bold slow">
                                                            Buy now
                                                        </a>
                                                    </div>
                                                    <!-- End points list -->
                                                </div>
                                                <!-- End table -->
                                                <!-- Table -->
                                                <div class="col-lg-3 col-sm-6 col-12 mt-30">
                                                    <!-- Top area with image and name -->
                                                    <div class="fullwidth height-300 bg-pattern-grid p-lg-5 p-3 d-flex align-items-start bg-soft-4 bg-soft-dark4 justify-content-center t-center" data-bg="vetrina/images/prices/Tariffe.png">
                                                        <h3 class="bold uppercase t-shadow white">
                                                            Gestione Vendita/Affitto Case
                                                        </h3>
                                                    </div>
                                                    <!-- Points list and price circle -->
                                                    <div class="pb-30 b-1 b-gray3 d-flex align-items-center justify-content-center flex-column relative zi-5">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl bg-white move-up-half circle flex-column bs-inset">
                                                            <span class="font-secondary medium fs-40 lh-45 gray8">
                                                                120€
                                                            </span>
                                                            <span class="fs-10 uppercase">
                                                                Mensile
                                                            </span>
                                                        </div>
                                                        <!-- Start list -->
                                                        <ul class="p-0 mt--15 uppercase bold fs-13 gray8 t-center fullwidth">
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Gestione Pacchetti Offerte</span>
                                                            </li>
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Anagrafiche Case/Appartamenti</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Agenda Appuntamenti Clienti</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Sito Vetrina</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Assistenza 12H</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Customizzazione dei Moduli</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Autorizzazione Multilivello</span>
                                                            </li>
                                                        </ul>
                                                        <!-- Purchase button -->
                                                        <a href="#" class="btn-sm mt-10 radius-0 bg-dark uppercase white bg-colored-hover bold slow">
                                                            Buy now
                                                        </a>
                                                    </div>
                                                    <!-- End points list -->
                                                </div>
                                                <!-- End table -->
                                                <!-- Table -->
                                                <div class="col-lg-3 col-sm-6 col-12 mt-30">
                                                    <!-- Top area with image and name -->
                                                    <div class="fullwidth height-300 bg-pattern-grid p-lg-5 p-3 d-flex align-items-start bg-soft-4 bg-soft-dark4 justify-content-center t-center" data-bg="vetrina/images/prices/Tariffe.png">
                                                        <h3 class="bold uppercase t-shadow white">
                                                            ERP
                                                        </h3>
                                                    </div>
                                                    <!-- Points list and price circle -->
                                                    <div class="pb-30 b-1 b-gray3 d-flex align-items-center justify-content-center flex-column relative zi-5">
                                                        <!-- Icon -->
                                                        <div class="icon-xxl bg-white move-up-half circle flex-column bs-inset">
                                                            <span class="font-secondary medium fs-40 lh-45 gray8">
                                                                200€
                                                            </span>
                                                            <span class="fs-10 uppercase">
                                                                Mensili
                                                            </span>
                                                        </div>
                                                        <!-- Start list -->
                                                        <ul class="p-0 mt--15 uppercase bold fs-13 gray8 t-center fullwidth">
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Gestione Azienda</span>
                                                            </li>
                                                            <li class="bt-1 b-gray3 py-15">
                                                                <span class="colored">Gestione Personale</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Gestione Amministrativa</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Sito Vetrina</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Assistenza 12H</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Customizzazione dei Moduli</span>
                                                            </li>
                                                            <li class="bt-1 bb-1 b-gray3 py-15">
                                                                <span class="colored">Autorizzazione Multilivello</span>
                                                            </li>
                                                        </ul>
                                                        <!-- Purchase button -->
                                                        <a href="#" class="btn-sm mt-10 radius-0 bg-dark uppercase white bg-colored-hover bold slow">
                                                            Buy now
                                                        </a>
                                                    </div>
                                                    <!-- End points list -->
                                                </div>
                                                <!-- End table -->
                                            </div>
                                            <!-- End row for all tables -->
                                        </div>
                                        <!-- End container for the pricing tables -->
                                    </section>
                                    <!-- End prices section -->
                                    <!-- Container for map -->
                                    <div id="map" class="hotspots fullwidth">
                                        <!-- Your map image -->
                                        <div class ="d-block fullwidth c-explore flex-fill">
                                            <!-- Your map image -->
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6030.6282640342515!2d14.3038965!3d40.9088577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133ba9cb88e5e2f1%3A0xd1194b4a219f7a56!2sIII%20Traversa%20Via%20Arcangelo%20Astone%2C%2029%2C%2080026%20Casoria%20NA!5e0!3m2!1sen!2sit!4v1740306358479!5m2!1sen!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="fullwidth">
                                            </iframe>
                                        </div>
                                    </div>
                                    <!-- End container for map -->
                                    <!-- Contact Section -->
                                    <section id="contact" class="py-100 bg-dark5 has-parallax">
                                        <!-- Parallax background -->
                                        <div class="parallax" data-bg="vetrina/images/Computer_software_6_acecrm .png" data-target="#contact" data-bottom-top="transform:translate3d(0px,-400px,0px);" data-top-bottom="transform:translate3d(0px,400px,0px);"></div>
                                        <!-- Container for contact and title -->
                                        <div class="container">
                                            <!-- Row start -->
                                            <div class="row">
                                                <!-- Column for title -->
                                                <div class="col-12 d-flex flex-column align-items-center t-center">
                                                    <!-- Header -->
                                                    <h1 class="fs-60 uppercase font-secondary" style="color:#0066A6">
                                                        KEEP IN TOUCH
                                                    </h1>
                                                    <!-- Header Strip -->
                                                    <div class="width-70 height-1 my-20 bg-gray4"></div>
                                                    <!-- Header Description -->
                                                    <p class="mxw-800 fs-16 lh-30 text-secondary">
                                                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in piece of classical Latin literature from 45 BC, it a old.
                                                    </p>
                                                </div>
                                                <!-- End column for title -->
                                                <!-- Fullwidth column for contact form -->
                                                <div id="contact-form-container" class="col-12 mt-50 d-flex fullwidth flex-column align-items-center slow-cubic">
                                                    <!-- Contact form wrapper -->
                                                    <div class="contact-form-wrapper o-hidden fullwidth slow-cubic">
                                                        <!-- Contact Form -->
                                                        <form id="contact-form" class="contact-form validate-me" novalidate name="contact_form" method="post" action="php/mail.php">
                                                            <!-- Container for inputs -->
                                                            <div class="container-fluid px-0">
                                                                <!-- Row for cols -->
                                                                <div class="row row-eq-height">
                                                                    <!-- Col for input -->
                                                                    <div class="col-lg-6 col-12">
                                                                        <div class="row">
                                                                            <div class="col-12 relative">
                                                                                <input type="text" name="name" id="name" placeholder="Your Name*" required class="py-25 px-25 b-gray9 fs-18 bg-transparent gray8 gray-placeholder mt-30">
                                                                                    <div class="invalid-tooltip top-3 mt-0 bg-transparent p-0 text-danger fs-16 font-main">Please enter your name.</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12 relative">
                                                                                <input type="email" name="email" id="email" placeholder="E-Mail*" required class="py-25 px-25 b-gray9 fs-18 bg-transparent gray8 gray-placeholder mt-30">
                                                                                    <div class="invalid-tooltip top-3 mt-0 bg-transparent p-0 text-danger fs-16 font-main">Please enter a valid e-mail.</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12 relative">
                                                                                <input type="text" name="subject" id="subject" placeholder="Subject" class= "py-25 px-25 b-gray9 fs-18 bg-transparent gray8 gray-placeholder mt-30">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End col for input -->
                                                                    <!-- Col for input -->
                                                                    <div class="col-lg-6 col-12 relative pt-30">
                                                                        <textarea name="message" id="message" placeholder="Tell us about your project.*" required class= "py-25 px-25 b-gray9 fs-18 bg-transparent gray8 gray-placeholder mnh-150 fullheight"></textarea>
                                                                        <div class="invalid-tooltip top-3 mt-0 bg-transparent p-0 text-danger fs-16 font-main">Please type your message.</div>
                                                                    </div>
                                                                    <!-- End col for input -->
                                                                    <!-- Col for input -->
                                                                    <div class="col-12 mt-30 d-flex justify-content-lg-end justify-content-center">
                                                                        <!-- Send Button -->
                                                                        <button type="submit" id="submit" class="xl-btn block b-1 b-gray9 fullwidth font-secondary uppercase bg-transparent bg-colored-hover py-25 gray5 white-hover fs-22 slow">Send Message</button>
                                                                        <!-- End Send Button -->
                                                                    </div>
                                                                    <!-- End col for input -->
                                                                </div>
                                                                <!-- End row for cols -->
                                                            </div>
                                                            <!-- End container for inputs -->
                                                        </form>
                                                        <!-- End contact Form -->
                                                    </div>
                                                    <!-- End contact form wrapper -->
                                                    <!-- Success message wrapper -->
                                                    <div class="success-message-wrapper unselectable none px-100 py-150 py-80-sm mxw-600 bg-dark t-center d-flex flex-column align-items-center slow-md">
                                                        <!-- SVG for check icon -->
                                                        <svg width="54px" height="50px" viewBox="0 0 54 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <path d="M18.9526053,50 C17.0492133,50.0026165 15.2485978,49.1358819 14.0621508,47.6459509 L0.348067622,30.4593528 C-0.250279824,29.5582555 -0.0598946109,28.3486099 0.786242025,27.6753353 C1.63237866,27.0020608 2.85255542,27.0893162 3.59449702,27.876155 L17.3085802,45.0419209 C17.7187995,45.5777448 18.3629613,45.881359 19.0368836,45.8565261 C19.7108059,45.8316931 20.3309261,45.4814922 20.7006827,44.9169275 L50.189083,0.919236234 C50.6054349,0.3014969 51.3193752,-0.046964041 52.0619694,0.00511527446 C52.8045636,0.0571945899 53.462994,0.501902075 53.7892363,1.17172072 C54.1154786,1.84153937 54.0599688,2.6347078 53.6436169,3.25244713 L24.176027,47.2293061 C23.0638578,48.8938865 21.2221934,49.9241298 19.2231411,50 L18.9526053,50 Z" fill="#49D078" fill-rule="nonzero"></path>
                                                            </g>
                                                        </svg>
                                                        <!-- End SVG for check icon -->
                                                        <h1 class="font-secondary uppercase gray2 fs-40 mt-25">
                                                            Thank you!
                                                        </h1>
                                                        <p class="fs-20 lh-30 gray5 mt-10">
                                                            Your message has reached us. We will get back to you as soon as possible.
                                                        </p>
                                                    </div>
                                                    <!-- End success message wrapper -->
                                                </div>
                                                <!-- Contact column end -->
                                            </div>
                                            <!-- Row end -->
                                        </div>
                                        <!-- End container for contact -->
                                    </section>
                                    <!-- End contact Section -->
                                    <!-- Socials and address section -->
                                    <div id="socials" class="pt-30">
                                        <!-- Container for all -->
                                        <div class="container d-flex justify-content-center align-items-center flex-column">
                                            <!-- Social networks -->
                                            <div class="d-flex justify-content-center">
                                                <a href="https://twitter.com/gldeyes" target="_blank" class="mx-10 icon-md fs-20 gray8 white-hover bg-twitter-hover">
                                                    <i class="bi-twitter"></i>
                                                </a>
                                                <a href="https://facebook.com/gldeyes" target="_blank" class="mx-10 icon-md fs-20 gray8 white-hover bg-facebook-hover">
                                                    <i class="bi-facebook"></i>
                                                </a>
                                                <a href="https://instagram.com/goldeyestheme" target="_blank" class="mx-10 icon-md fs-20 gray8 white-hover bg-instagram-hover">
                                                    <i class="bi-instagram"></i>
                                                </a>
                                                <a href="https://www.linkedin.com/company/gold-eyes-studio" target="_blank" class="mx-10 icon-md fs-20 gray8 white-hover bg-linkedin-hover">
                                                    <i class="bi-linkedin"></i>
                                                </a>
                                            </div>
                                            <!-- Strip -->
                                            <div class="mt-20 width-40 height-1 bg-gray5"></div>
                                            <!-- Phone, e-mail and address -->
                                            <p class="mt-20 uppercase bold ls--04 fs-14">
                                                <a href="tel:0810000000" class="underline-hover">081 0000000</a>
                                                &
                                                <a href="mailto:freestyleweb@gmail.com" class="underline-hover">freestyleweb@gmail.com</a>
                                                <br>
                                                    <address>
                                                        III traversa Arcangelo Astone 29 Casoria, Napoli
                                                    </address>
                                            </p>
                                            <!-- Back to top button -->
                                            <a href="#top" class="icon-md mt-20 bg-dark5 gray3 white-hover">
                                                <i class="bi-chevron-double-up"></i>
                                            </a>
                                        </div>
                                        <!-- End container for all -->
                                    </div>
                                    <!-- End socials and address section -->
                                    <!-- Footer -->
                                    <footer id="footer" class="bg-dark5">
                                        <!-- Container for footer -->
                                        <div class="container py-90">
                                            <!-- Row for footer cols -->
                                            <div class="row row-eq-height align-items-center">
                                                <!-- Column -->
                                                <div class="col-lg col-12 mt-30-sm">
                                                    <div class="t-center">
                                                        <img src="vetrina/images/logos/logo_newold.png" alt="footer logo template">
                                                            <p class="mt-15 gray4 uppercase fs-14 medium">
                                                                ©2019-2022 All Rights Reserved.
                                                                <br>
                                                                    Designed by <a href="https://freestyleweb.it" target="_blank" class="colored underline-hover">Freestyle Agency</a> Acecrm <a href="https://acecrm.it" target="_blank" class="colored underline-hover">Gestionale Aziendale.</a>
                                                            </p>
                                                    </div>
                                                </div>
                                                <!-- End column -->
                                            </div>
                                            <!-- End row for footer cols -->
                                        </div>
                                        <!-- Container for footer -->
                                    </footer>
                                    <!-- End footer -->
                                    <!-- Back To Top -->
                                    <a id="back-to-top" href="#top" class="btt hide-on-home circle width-60 width-50-sm height-60 height-50-sm bg-white b-1 b-gray2 gray7">
                                        <i class="bi-chevron-up fs-18"></i>
                                    </a>
                                    <form method="post" action="index.php">
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Effettua Login</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Azienda:</label>
                                                            <input type="text" required name="azienda" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Username:</label>
                                                            <input type="email" required name="username" class="form-control" id="recipient-name">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Password:</label>
                                                            <input type="password" required name="password" class="form-control" id="recipient-name">
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Accedi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <script src="vetrina/js/plugins.js?v=2.0"></script>
                                    <!-- MAIN SCRIPTS - Classic scripts for all theme -->
                                    <script src="vetrina/js/functions.js?v=1.0"></script>
                                    <!-- END JS FILES -->
                                </body>
                                <!-- Body End -->
                            </html>

