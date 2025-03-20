<?php include_once 'controller.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <th >Matricola</th>
                    <th>Nominativo</th>
                    <th>Data di Nascita</th>
                    <th>Luogo di Nascita</th>
                    <th>Mansione</th>
                    <th>Ruolo</th>
                    <th>Mobile</th>
                    <th>E-mail</th>
                    <th>
                        <div class="input-group">Azioni</div>
                    </th>

                    </thead>
                    <tbody>
                        <?php
                        if (!$this->db->Query("SELECT amministratore.*,ruolo.idRuolo,ruolo.ruolo FROM {$_SESSION['tabella']}.amministratore RIGHT OUTER JOIN {$_SESSION['tabella']}.ruolo ON amministratore.idRuolo = ruolo.idRuolo  WHERE amministratore.idAzienda={$_SESSION['idAzienda']}"))
                            echo $this->db->Kill();
                        while ($gestioneoperatore = $this->db->Row()) {
                            ?>                  
                            <tr>
                                <td> <?= $gestioneoperatore->matricola; ?> </td>
                                <td><?= $gestioneoperatore->nome; ?> <?= $gestioneoperatore->cognome; ?></td>
                                <td><?= $gestioneoperatore->nascita; ?></td>
                                <td><?= $gestioneoperatore->luogoNascita; ?></td>
                                <td><?= $gestioneoperatore->mansione; ?></td>
                                <td><?= $gestioneoperatore->ruolo; ?></td>
                                <td><?= $gestioneoperatore->tel; ?></td>
                                <td><?= $gestioneoperatore->email; ?></td>
                                <td>
                                    <div class="input-group">
                                        <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-operatori-<?= $gestioneoperatore->idAmministratore; ?>"><i class="fas fa-edit"></i></a>
                                        <form action="gestione-operatori.php" method="post" name="gestione-operatori">
                                            <div class="modal fade bd-example-modal-form-operatori-<?= $gestioneoperatore->idAmministratore; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalform">Aggiungi Operatore</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-1" class="control-label">Nome</label> <input type="text" class="form-control" id="field-1"  name="nome" required="" value="<?= $gestioneoperatore->nome; ?>"></div>
                                                                    <input type="hidden" class="form-control" id="field-1"  name="idAmministratore" required="" value="<?= $gestioneoperatore->idAmministratore; ?>">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-2" class="control-label">Cognome</label> <input required="" type="text" class="form-control" id="field-2"  name="cognome" value="<?= $gestioneoperatore->cognome; ?>"></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-2" class="control-label">Matricola</label> <input required="" type="text" class="form-control" id="field-2"  name="matricola" value="<?= $gestioneoperatore->matricola; ?>"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group"><label for="field-3" class="control-label">Indirizzo</label> <input type="text" class="form-control" id="field-3" name="indirizzo" value="<?= $gestioneoperatore->indirizzo; ?>"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group"><label for="field-3" class="control-label">Cap</label> <input type="text" class="form-control" id="field-3" name="cap" value="<?= $gestioneoperatore->cap; ?>"></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Regione</label> 
                                                                        <div class="form-group">
                                                                            <select name="regioni" id="regioni2" class="form-control">
                                                                                <?php echo $select_dinamiche->ShowRegioni(); ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">Provincia</label>
                                                                        <select name="province" id="province2"  class="form-control">
                                                                            <option value="">Scegli la provincia</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">Comuni</label>
                                                                        <select name="comuni" id="comuni2" class="form-control"  >
                                                                            <option value="">Scegli il comune</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="file" id="fileInput" class="custom-file-input" name="firma" accept="image/*" onchange="showPreview()">

                                                                        <label class="custom-file-label" for="inputGroupFile04">Carica la firma</label>
                                                                        <img id="imagePreview" src="" alt="Anteprima dell'immagine" style="max-width: 200px; max-height: 200px;">
                                                                        <script>
                                                                            function showPreview() {
                                                                                var fileInput = document.getElementById('fileInput');
                                                                                var imagePreview = document.getElementById('imagePreview');

                                                                                if (fileInput.files && fileInput.files[0]) {
                                                                                    var reader = new FileReader();
                                                                                    reader.onload = function (e) {
                                                                                        imagePreview.src = e.target.result;
                                                                                    };
                                                                                    reader.readAsDataURL(fileInput.files[0]);
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">Ruolo</label>  
                                                                        <select name="idRuolo2"  required=""  class="form-control">
                                                                            <?php echo $gestruolo->ruolo($gestioneoperatore->idRuolo); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">Mansione</label>  
                                                                        <input type="text" class="form-control" value="<?= $gestioneoperatore->mansione; ?>" id="field-3" name="telefono">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">Telefono</label> 
                                                                        <input type="text" class="form-control" value="<?= $gestioneoperatore->telefono; ?>" id="field-3" name="telefono">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-1" class="control-label">Codice Fiscale</label> <input type="text" class="form-control" id="field-1"  name="codiceFiscale" max="16" value="<?= $gestioneoperatore->codiceFiscale; ?>"></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-2" class="control-label">Luogo di Nascita</label> <input type="text" class="form-control" id="field-2"  name="luogoNascita" value="<?= $gestioneoperatore->luogoNascita; ?>" required=""></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-2" class="control-label">Data di Nascita</label> <input type="date" class="form-control" id="field-2"  name="nascita" value="<?= $gestioneoperatore->nascita; ?>" required=""></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-2" class="control-label">Email</label> <input type="text" class="form-control" id="field-2"  name="email" value="<?= $gestioneoperatore->email; ?>" required=""></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-1" class="control-label">Username</label> <input type="text" class="form-control" id="field-1" value="<?= $_SESSION['username']; ?>" disabled="disabled"  name="username" ></div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group"><label for="field-2" class="control-label">Password</label> <input type="password" class="form-control" id="field-2"  name="pws" required="required" value=""></div>
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
                                        <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target="#bd-example-modal-form-permessi-<?= $gestioneoperatore->idAmministratore; ?>"><i class="fas fa-lock"></i></a>           
                                        <div class="modal fade" id="bd-example-modal-form-permessi-<?= $gestioneoperatore->idAmministratore; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle2">Permessi Utenti</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Permessi</th>
                                                                    <th>Cancella</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                // MENU CONTENENTE LE VOCI DEL MODULI E QUELLI ATTIVI PER UTENTE

                                                                if (!$gestPermessi->db->Query("SELECT permessi.*,  moduli_attivi.modulo, moduli.modulo FROM {$_SESSION['tabella']}.permessi INNER JOIN  admin_acecrm.moduli_attivi ON moduli_attivi.idModulo = permessi.idModuli INNER JOIN admin_acecrm.moduli ON moduli.idModuli = moduli_attivi.modulo WHERE permessi.idRuolo = $gestioneoperatore->idRuolo"))
                                                                    echo $gestPermessi->db->Kill();

                                                                while ($permessi = $gestPermessi->db->Row()) {
                                                                    ?>     
                                                                    <tr>
                                                                        <th scope="row"><?= $permessi->idPermesso; ?></th>
                                                                        <td><?= $permessi->modulo; ?></td>
                                                                        <td>
                                                                            <form method="post" enctype="multipart/form-data" action="gestione-operatori.php">
                                                                                <input type="hidden" value="<?= $permessi->idPermesso; ?>" name="idPermesso">
                                                                                <input type="hidden" value="1" name="cancella_permessi">
                                                                                <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro?');"> <i class="fas fa-trash"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer"><button type="button" class="btn btn-primary">Save changes</button> <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Close</button></div>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" enctype="multipart/form-data" action="gestione-operatori.php">
                                            <input type="hidden" value="<?= $gestioneoperatore->idAmministratore; ?>" name="idAmministratore">
                                            <input type="hidden" value="1" name="cancella">
                                            <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro?');"> <i class="fas fa-trash"></i></button>
                                        </form>
                                        <form method="post" enctype="multipart/form-data" action="gestione-certificazione.php">
                                            <input type="hidden" value="<?= $gestioneoperatore->idAmministratore; ?>" name="certificazioni">
                                            <button type="submit"  class="btn btn-primary waves-effect waves-light" title="dettagli"> <i class="fas fa-cogs"></i></button>
                                        </form>
                                    </div>

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
<!-- permessi -->
<form action="gestione-operatori.php" method="post" enctype="multipart/form-data" name="gestione-operatori">
    <div class="modal fade bd-example-modal-form-operatori" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Operatore</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Nome</label> <input type="text" class="form-control" id="field-1"  name="nome" required="" value=""></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Cognome</label> <input required="" type="text" class="form-control" id="field-2"  name="cognome" value=""></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Matricola</label> <input required="" type="text" class="form-control" id="field-2"  name="matricola" value=""></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-3" class="control-label">Indirizzo</label> <input type="text" class="form-control" id="field-3" name="indirizzo" value=""></div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group"><label for="field-3" class="control-label">Cap</label> <input type="text" class="form-control" id="field-3" name="cap" value=""></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-3" class="control-label">Regione</label> 
                                <select name="regioni" id="regioni3" class="form-control">
                                    <?php echo $select_dinamiche->ShowRegioni(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Provincia</label>  
                                <select name="province" id="province3"  class="form-control">
                                    <option value="">Scegli la provincia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Comuni</label> 
                                <select name="comuni" id="comuni3" class="form-control"  >
                                    <option value="">Scegli il comune</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="file" id="fileInput" class="custom-file-input" name="firma" accept="image/*" onchange="showPreview()">

                                <label class="custom-file-label" for="inputGroupFile04">Carica la firma</label>
                                <img id="imagePreview" src="" alt="Anteprima dell'immagine" style="max-width: 200px; max-height: 200px;">
                                <script>
                                    function showPreview() {
                                        var fileInput = document.getElementById('fileInput');
                                        var imagePreview = document.getElementById('imagePreview');

                                        if (fileInput.files && fileInput.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                imagePreview.src = e.target.result;
                                            };
                                            reader.readAsDataURL(fileInput.files[0]);
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Ruolo</label>  
                                <select name="idRuolo2"  required  class="form-control">
                                    <?php echo $gestruolo->ruolo(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Mansione</label> 
                                <select name="mansione" class="form-control">
                                    <option value="Commerciale">Commerciale</option>
                                    <option value="Acquisti">Acquisti</option>
                                    <option value="Qualità">Qualità</option>
                                    <option value="Logistica">Logistica</option>
                                    <option value="Progettazione">Progettazione</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Telefono</label> 
                                <input type="text" class="form-control" value="" id="field-3" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Codice Fiscale</label> <input type="text" class="form-control" id="field-1"  name="codiceFiscale" max="16" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Luogo di Nascita</label> <input type="text" class="form-control" id="field-1"  name="luogoNascita" max="16" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Data di Nascita</label> <input type="date" class="form-control" id="field-1"  name="nascita" max="16" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Email</label> <input type="text" class="form-control" id="field-2"  name="email" value="" required=""></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Username</label> <input type="text" class="form-control" id="field-1" value="<?= $_SESSION['username']; ?>" disabled="disabled"  name="username" ></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-2" class="control-label">Password</label> <input type="password" class="form-control" id="field-2"  name="pws" required="required" value=""></div>
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
<form action="gestione-operatori.php" method="post" name="gestione-ruolo">
    <div class="modal fade bd-example-modal-form-permessi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Ruolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-1" class="control-label">Ruolo</label> 
                                <select name="idRuolo" class="form-control">
                                    <?php echo $gestruolo->ruolo(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-1" class="control-label">Moduli da Attivare</label> 
                                <select name="modulo"  class="form-control">
                                    <?php echo $mod->modulivis(); ?>
                                </select>
                            </div>
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
<form action="gestione-operatori.php" method="post" name="gestione-ruolo">
    <div class="modal fade bd-example-modal-form-ruolo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Ruolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="field-1" class="control-label">Ruolo</label> <input type="text" class="form-control" id="field-1"  name="ruolo" required="" value=""></div>
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