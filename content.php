<?php
session_start();
ob_start();
#gestione della tabelle per le sessioni
$tabella = 'test_' . $_SESSION['username'];
define('NOMETABELLA', $tabella);
define('IDAZIENDA', $_SESSION['idAzienda']);

#file per funzione per richiamare le classi
include 'control/config.inc';
#lingua
include 'html/lingua.php';
#oggetti 
include 'control/oggetti.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ACE CRM - Amministrazione</title>
        <meta content="Ace Gestionale" name="gestionale web" />
        <meta content="Themesdesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/ace_favoicon.ico">
        <!-- insert del file css -->
        <?php include_once 'html/css.php'; ?>

    </head>

    <body>
        <?php if (!empty($_SESSION['idAmministratore'])) { ?>
            <!-- Navigation Bar-->
            <header id="topnav">
                <!-- inizio topbar main -->
                <?php include_once 'html/topbar.php'; ?>
                <!-- end topbar-main -->

                <!-- MENU Start -->
                <?php include_once 'html/menu.php'; ?>
                <!-- fine menu -->
            </header>
            <!-- End Navigation Bar-->


            <div class="wrapper">
                <div class="container-fluid">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="btn-group float-right">
                                    <ol class="breadcrumb hide-phone p-0 m-0">
                                        <li class="breadcrumb-item"><a href="#">Dashor</a></li>
                                        <li class="breadcrumb-item active">Calendar</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Calendar</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title end breadcrumb -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-xl-2 col-lg-3 col-md-4">

                                            <h4 class="m-b-15 font-16">Created Events</h4>
                                            <form method="post" id="add_event_form" class="input-group m-b-15">
                                                <input type="text" class="form-control new-event-form" placeholder="Add new event..." />
                                            </form>

                                            <div id='external-events'>
                                                <h4 class="m-b-15 font-16">Draggable Events</h4>
                                                <div class='fc-event'>My Event 1</div>
                                                <div class='fc-event'>My Event 2</div>
                                                <div class='fc-event'>My Event 3</div>
                                                <div class='fc-event'>My Event 4</div>
                                                <div class='fc-event'>My Event 5</div>
                                            </div>

                                            <!-- checkbox -->

                                            <div class="custom-control pl-0 custom-checkbox mt-3">
                                                <label class="ckbox">
                                                    <input type="checkbox" id="drop-remove"><span>Remove after drop</span>
                                                </label>
                                            </div>

                                        </div>

                                        <div id='calendar' class="col-xl-10 col-lg-9 col-md-8"></div>

                                    </div>
                                    <!-- end row -->

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row --> 

                </div> <!-- end container -->
            </div>
            <!-- end wrapper -->


            <!-- Footer -->
            <?php include_once 'html/footer.php'; ?>
            <!-- End Footer -->
        <?php } else { ?>
            <div id="stars"></div>
            <div id="stars2"></div>
            <div class="wrapper-page">
                <div class="card">
                    <div class="card-block">
                        <div class="ex-page-content text-center">
                            <h1 class="mb-0">Grazie!</h1>
                            <h5 class="">Logout effettuato con successo!</h5>
                            <br><a class="btn btn-danger mb-5 waves-effect waves-light text-light" href="index.php">Torna indietro</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
        ?>
        <!-- parte js -->
        <?php include_once 'html/js.php'; ?>

    </body>
</html>
<?PHP
ob_end_flush();
?>
  
