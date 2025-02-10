<div class="topbar-main">
    <div class="container-fluid">

        <!-- Logo container-->
        <div class="logo">
            <?php if (!empty($_SESSION['idAl'])) { ?>
                <a href="struttura.php" class="logo">
                <?php } else if (!empty($_SESSION['idAnagrafica'])) { ?>
                    <a href="cliente.php" class="logo">
                    <?php } else if (!empty($_SESSION['idFornitore'])) { ?>
                        <a href="fornitore.php" class="logo">
                        <?php } else { ?>
                            <a href="content.php" class="logo">
                            <?php } ?>
                            <img src="assets/images/logo_sm_azzurro.png" alt="" class="logo-small">
                            <img src="assets/images/logo_ace_bianco.png"  alt="" class="logo-large">
                        </a>
                        </div>
                        <!-- End Logo container-->
                        <div class="menu-extras topbar-custom">

                            <ul class="list-inline float-right mb-0 ">
                                <!-- language-->

                                <li class="list-inline-item dropdown notification-list">
                                    <div class="list-inline-item hide-phone app-search">
                                        <form role="search" class="" method="post">
                                            <input type="hidden" value="<?= isset($_REQUEST['tour']) ? $_REQUEST['tour'] : ''; ?>" name="tour">
                                            <div class="form-group mb-0 bmd-form-group"> 
                                                <select class="form-control form-control-sm" style="background-color: #2b3a4a; color: #fff"
                                                        name="idLingue" onchange="this.form.submit()">

                                                    <?= $lingua->selectLingue($_SESSION['selectedLanguage'] ?? null); ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>   
                                </li>
                                <?php if (!empty($_SESSION['idAmministratore'])) { ?>
                                    <li class="list-inline-item dropdown notification-list ml-2">
                                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown"
                                           href="#" role="button" aria-haspopup="false" aria-expanded="false"><i
                                                class="ti-email noti-icon"></i> <span
                                                class="badge badge-danger heartbit noti-icon-badge"><?= $assistenza->contatore; ?></span></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                            <!-- item-->
                                            <div class="dropdown-item noti-title align-self-center">
                                                <h5><span
                                                        class="badge badge-danger float-right"><?= $assistenza->contatore; ?></span>Assistenza
                                                </h5>
                                            </div>
                                            <?php
                                            if (!$assistenza->db->Query("SELECT * from admin_acecrm.supporto WHERE  idAzienda={$_SESSION['idAzienda']} ORDER BY idSupporto DESC LIMIT 3"));

                                            while ($breviass = $assistenza->db->Row()) {
                                                ?>
                                                <!-- item-->
                                                <a href="gestione-supporto-azienda.php" class="dropdown-item notify-item">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-alert-circle"></i>
                                                    </div>
                                                    <p class="notify-details"><b><?= $breviass->tipologia; ?></b><small
                                                            class="text-secondary"><?= $assistenza->anteprima($breviass->titolo, 80, true); ?></small>
                                                    </p>
                                                </a>
                                            <?php } ?>

                                            <div class="dropdown-divider"></div>
                                            <!-- All--> <a href="gestione-supporto-azienda.php" class="dropdown-item notify-item">Guarda
                                                Tutti</a>
                                        </div>
                                    </li>
                                <?php } ?>

                                <?php if (!empty($_SESSION['idAmministratore'])) { ?>
                                    <li class="list-inline-item dropdown notification-list">
                                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown"
                                           href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <i class="ti-bell noti-icon"></i>
                                            <span class="badge badge-success a-animate-blink noti-icon-badge">3</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                            <!-- item-->
                                            <div class="dropdown-item noti-title">
                                                <h5>
                                                    <span class="badge badge-success float-right">3</span>Avvisi
                                                </h5>
                                            </div><!-- item-->
                                            <?php
                                            if (!$avvisi->db->Query("SELECT * from {$tabella}.avvisi  where scadenza > subdate(curdate(), INTERVAL 2 DAY) ORDER BY id ASC LIMIT 3"))
                                                ;

                                            while ($avv = $avvisi->db->Row()) {
                                                ?>
                                                <a href="gestione-avvisi.php" class="dropdown-item notify-item">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-gauge"></i>
                                                    </div>
                                                    <p class="notify-details">
                                                        <b><?= $avv->scadenza; ?></b>
                                                        <small
                                                            class="text-secondary"><?= $avvisi->anteprima($avv->avviso, 80, true); ?></small>
                                                    </p>
                                                </a><!-- item-->
                                            <?php } ?>
                                            <div class="dropdown-divider"></div><!-- All-->
                                            <a href="gestione-avvisi.php" class="dropdown-item notify-item">View </a>
                                        </div>
                                    </li>
                                <?php } ?>
                                <li class="list-inline-item dropdown notification-list">
                                    <div class="dropdown notification-list nav-pro-img">
                                        <a class="dropdown-toggle nav-link arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <img src="assets/images/users/avatar-10.jpg" alt="user" class="rounded-circle">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                            <!-- item-->
                                            <div class="dropdown-item noti-title">
                                                <h5>Welcome</h5>
                                            </div>
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>
                                            <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">5</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                        </div>                                                                    
                                    </div>
                                </li>
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link" id="mobileToggle">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>    
                            </ul>
                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                        </div> <!-- end container -->
                        </div>