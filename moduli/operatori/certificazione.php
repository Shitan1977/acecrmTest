<?php include_once 'controller.php'; ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Specifiche Operatore</h4>

                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item  waves-effect waves-light"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-selected="true">Requisiti Culturali e Professionali</a></li>
                    <li class="nav-item waves-effect waves-light"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-selected="false">Dettagli Lavorativi</a></li>
                    <li class="nav-item waves-effect waves-light"><a class="nav-link" data-toggle="tab" href="#messages-1" role="tab" aria-selected="false">Modalità d'Assunzione</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane p-3 active" id="home-1" role="tabpanel">
                        <p class="font-14 mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table  class="table sorting_desc  table-bordered dt-responsive font-12" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>

                                                    <th>Qualifica</th>
                                                    <th>Titoli di studio</th>
                                                    <th>Titoli di specializzazione</th>
                                                    <th>Esperienze</th>
                                                    <th>Formazione</th>
                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $gestoperatore->db->Query("SELECT * from {$_SESSION['tabella']}.certificazioni where idOperatore=$gestoperatore->idCertificazioni");
                                                while ($certificazioni = $gestoperatore->db->Row()) {
                                                    ?>

                                                    <tr>
                                                        <td><?= $certificazioni->qualifica; ?></td>
                                                        <td><?= $certificazioni->titolo_studio; ?></td>
                                                        <td><?= $certificazioni->titoli_spec; ?></td>
                                                        <td><?= $certificazioni->esperienze; ?></td>
                                                        <td><?= $certificazioni->formazione; ?></td>
                                                        <td>  
                                                            <form method="post" enctype="multipart/form-data" action="gestione-certificazione.php">
                                                                <input type="hidden" value="<?= $certificazioni->idCertificazioni; ?>" name="idCertificazioni">
                                                                <input type="hidden" value="<?= $_POST['certificazioni']; ?>" name="certificazioni">
                                                                <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro?');"> <i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        </p>
                    </div>
                    <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                        <p class="font-14 mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table  class="table sorting_desc  table-bordered dt-responsive font-12" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>

                                                    <th>Sede di lavoro</th>
                                                    <th>Responsabile di Reparto</th>
                                                    <th>Mansione</th>                                                
                                                    <th>SPP</th>
                                                    <th>CV</th>
                                                    <th>CVA</th>
                                                    <th>Costo Orario</th>
                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $gestoperatore->db->Query("SELECT * from {$_SESSION['tabella']}.dettagli_lavoro where idOperatore=$gestoperatore->idCertificazioni");
                                                while ($lavoro = $gestoperatore->db->Row()) {
                                                    ?>

                                                    <tr>
                                                        <td><?= $lavoro->sede_lavoro; ?></td>
                                                        <td><?= $lavoro->resp_reparto; ?></td>
                                                        <td><?= $lavoro->mansione; ?></td>
                                                        <td><?= $lavoro->spp; ?></td>
                                                        <td><?= $lavoro->cv; ?></td>
                                                        <td><?= $lavoro->cva; ?></td>
                                                        <td><?= $lavoro->costo_orario; ?></td>
                                                        <td>  
                                                            <form method="post" enctype="multipart/form-data" action="gestione-certificazione.php">
                                                                <input type="hidden" value="<?= $lavoro->idLavoro; ?>" name="idLavoro">
                                                                <input type="hidden" value="<?= $_POST['certificazioni']; ?>" name="certificazioni">
                                                                <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro?');"> <i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        </p>
                    </div>
                    <div class="tab-pane p-3" id="messages-1" role="tabpanel">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table  class="table sorting_desc  table-bordered dt-responsive font-12" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>

                                                    <th>Data inizio</th>
                                                    <th>Data fine</th>
                                                    <th>Avvisi</th>
                                                    <th>Durata (MM)</th>
                                                    <th>Tempo</th>
                                                    <th>Contratto</th>

                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $gestoperatore->db->Query("SELECT * from {$_SESSION['tabella']}.modalita_assunzione where idOperatore=$gestoperatore->idCertificazioni");
                                                while ($assunzioni = $gestoperatore->db->Row()) {
                                                    ?>

                                                    <tr>
                                                        <td><?= $assunzioni->ass_inizio; ?></td>
                                                        <td><?= $assunzioni->ass_fine; ?></td>
                                                        <td><?= $assunzioni->ass_avvisi; ?></td>
                                                        <td><?= $assunzioni->ass_durata; ?></td>
                                                        <td><?= $assunzioni->ass_tempo; ?></td>
                                                        <td><?= $assunzioni->ass_contratto; ?></td>

                                                        <td>  
                                                            <form method="post" enctype="multipart/form-data" action="gestione-certificazione.php">
                                                                <input type="hidden" value="<?= $assunzioni->idAssunzione; ?>" name="idAssunzione">
                                                                <input type="hidden" value="<?= $_POST['certificazioni']; ?>" name="certificazioni">
                                                                <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro?');"> <i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- aggiungi certificazioni -->
<form action="gestione-certificazione.php" method="post" name="gestione-operatori">
    <div class="modal fade bd-example-modal-form-aggCertifica" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Certificazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Qualifica</label> 
                                <input type="text" class="form-control" id="field-1"  name="qualifica" required="" value="">
                                <input type="hidden" value="<?= $_POST['certificazioni']; ?>" name="certificazione">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Titolo di studio</label> <input required="" type="text" class="form-control" id="field-2"  name="titolo_studio" value=""></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Titoli di specializzazione</label> <input required="" type="text" class="form-control" id="field-2"  name="titoli_spec" value=""></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-3" class="control-label">Esperienze</label> <input type="text" class="form-control" id="field-3" name="esperienze" value=""></div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group"><label for="field-3" class="control-label">Formazione</label> <input type="text" class="form-control" id="field-3" name="formazione" value=""></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-raised btn-primary ml-2">Aggiungi                           
                    </button> <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- aggiungi dettagli Lavoro -->
<form action="gestione-certificazione.php" method="post" name="gestione-operatori">
    <div class="modal fade bd-example-modal-form-aggDettLavoro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Dettagli di Lavoro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Sede di Lavoro</label> 
                                <input type="text" class="form-control" id="field-1"  name="sede_lavoro" required="" value="">
                                <input type="hidden" value="<?= $_POST['certificazioni']; ?>" name="certificazioni">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Responsabile del settore</label> <input required="" type="text" class="form-control" id="field-2"  name="resp_reparto" value=""></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">SPP</label> <input required="" type="text" class="form-control" id="field-2"  name="spp" value=""></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-3" class="control-label">CV</label> <input type="text" class="form-control" id="field-3" name="cv" value=""></div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group"><label for="field-3" class="control-label">CVA</label> <input type="text" class="form-control" id="field-3" name="cva" value=""></div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group"><label for="field-3" class="control-label">Costo Orario</label> <input type="text" class="form-control" id="field-3" name="costo_orario" value=""></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-raised btn-primary ml-2">Aggiungi                           
                    </button> <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- aggiungi dettagli assunzione -->
<form action="gestione-certificazione.php" method="post" name="gestione-operatori">
    <div class="modal fade bd-example-modal-form-aggAssunzioni" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Dettagli di Lavoro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Data inizio</label> 
                                <input type="date" class="form-control" id="field-1"  name="ass_inizio" required="" value="">
                                <input type="hidden" value="<?= $_POST['certificazioni']; ?>" name="certificazioni">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Data fine</label> <input required="" type="date" class="form-control" id="field-2"  name="ass_fine" value=""></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Avvisi</label> <input required="" type="text" class="form-control" id="field-2"  name="ass_avvisi" value=""></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-3" class="control-label">Durata (MM)</label> <input type="text" class="form-control" id="field-3" name="ass_durata" value=""></div>
                        </div>
                   
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-3" class="control-label">Tempo</label> <input type="text" class="form-control" id="field-3" name="ass_tempo" value=""></div>
                        </div>
                   
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-3" class="control-label">Contratto</label> <input type="text" class="form-control" id="field-3" name="ass_contratto" value=""></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-raised btn-primary ml-2">Aggiungi                           
                    </button> <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

