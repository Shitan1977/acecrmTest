<?php
include_once 'controller.php';
?>
<script>

    $(document).ready(function () {
        $('#datatable-buttons3').DataTable({
            destroy: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                'colvis'
            ]
        });
    });


</script>
<script>

    $(document).ready(function () {
        $('#datatable-buttons1').DataTable({
            destroy: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                'colvis'
            ]
        });
    });


</script>
<script>

    $(document).ready(function () {
        $('#datatable-buttons2').DataTable({
            destroy: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                'colvis'
            ]
        });
    });


</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">
                    <?php
                    if (!$this->db->Query("SELECT * from {$_SESSION['tabella']}.anagrafica LEFT JOIN  admin_acecrm.comuni ON comuni.id_com=anagrafica.idComune where idAnagrafica={$_POST['idAna']}"))
                        echo $this->db->Kill();
                    $azienda = $this->db->Row();
                    echo $azienda->ragioneSociale . ' ' . $azienda->nome . ' ' . $azienda->congome;
                    ?>                  </h4>
                <table id="datatable-buttons2" class="table table-striped table-bordered dt-responsive font-12" cellspacing="0" width="100%">
                    <thead>
                    <th >ID</th>
                    <th>Nominativo</th>


                    <th>Mobile</th>
                    <th>E-mail</th>
                    <th>Posizione Ricoperta</th>
                    <th>Azioni</th>

                    </thead>
                    <tbody>
                        <?php
                        if (!$this->db->Query("SELECT * from {$_SESSION['tabella']}.referenti_clienti  where idCLiente={$_POST['idAna']}"))
                            echo $this->db->Kill();
                        while ($gestioneanagrafica = $this->db->Row()) {
                            ?>                  
                            <tr>
                                <td> <?= $gestioneanagrafica->idCLiente; ?> </td>
                                <td><?= $gestioneanagrafica->nome; ?> <?= $gestioneanagrafica->cognome; ?></td>
                                <td><?= $gestioneanagrafica->telefono; ?></td>
                                <td><?= $gestioneanagrafica->email; ?></td>
                                <td><?= $gestioneanagrafica->tipo; ?></td>

                                <td>
                                    <div class="btn-group m-b-2">
                                        <form method="post" enctype="multipart/form-data" action="gestione-clienti-storica.php">
                                            <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                                            <input type="hidden" value="<?= $gestioneanagrafica->nome; ?>" name="nomeReferente">
                                            <input type="hidden" value="<?= $gestioneanagrafica->cognome; ?>" name="cognome">
                                            <input type="hidden" value="<?= $gestioneanagrafica->idRef; ?>" name="cancellaCl">
                                            <input type="hidden" value="<?= $gestioneanagrafica->idRef; ?>" name="idRef">
                                            <button type="submit"  class="btn btn-primary waves-effect waves-light" title="cancella" onclick="return confirm('sei sicuro?');"> <i class="fas fa-trash"  title="Cancella"></i></button>
                                        </form>
                                        <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-cli-<?= $gestioneanagrafica->idRef; ?>"><i class="fas fa-edit" title="Modifica"></i></a>
                                        <form action="gestione-clienti-storica.php" method="post" name="gestione-marche">
                                            <div class="modal fade bd-example-modal-form-cli-<?= $gestioneanagrafica->idRef; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalform">Modifica</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group  ">
                                                                        <label for="Nome" class=" control-labelt"> Nome  *</label>
                                                                        <input class="form-control parsley-validated" placeholder="" required="true" name="nomeReferente" type="text" value="<?= $gestioneanagrafica->nome; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-group  ">
                                                                        <label for="Data Emissione"  class=" control-labelt">Cognome * </label>

                                                                        <input class="form-control date parsley-validated" placeholder="<?= $rfqw->data_emissione; ?>" required="true" name="cognome" type="text" value="<?= $gestioneanagrafica->cognome; ?>">
                                                                        <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                                                                        <input type="hidden" value="<?= $gestioneanagrafica->idRef; ?>" name="idRef">

                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-group  ">
                                                                        <label for="Data Scadenza" class=" control-labelt">Mobile * </label>

                                                                        <input class="form-control date parsley-validated" required="true" placeholder="<?= $gestioneanagrafica->telefono; ?>" name="telefono" type="text" value="<?= $gestioneanagrafica->telefono; ?>">


                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">


                                                                <div class="col-4">
                                                                    <div class="form-group  ">
                                                                        <label for="Carica File" class=" control-labelt">Email * </label>
                                                                        <input type="text"   name="email"  value="<?= $gestioneanagrafica->email; ?>" class="form-control">
                                                                        <div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group  ">
                                                                        <label for="Carica File" class=" control-labelt">Posizione Ricoperta * </label>
                                                                        <input name="tipo" class="form-control" value="<?= $gestioneanagrafica->tipo; ?>">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="field-2" class="control-label">Assegnato A</label>
                                                                        <select class="form-control" name="idAmministratore">
                                                                            <?= $operatore->operatoriSelect(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer"><button type="submit" class="btn btn-raised btn-primary ml-2">Modifica                           
                                                            </button> <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-cliInvio-<?= $gestioneanagrafica->idRef; ?>"><i class="fas fa-envelope-open" title="Modifica"></i></a>
                                        <form action="gestione-clienti-storica.php" method="post" name="gestione-marche">
                                            <div class="modal fade bd-example-modal-form-cliInvio-<?= $gestioneanagrafica->idRef; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <input type="hidden" value="<?= $gestioneanagrafica->nome; ?>" name="nomeInvio">
                                                <input type="hidden" value="<?= $gestioneanagrafica->cognome; ?>" name="cognome">
                                                <input type="hidden" value="<?= $gestioneanagrafica->email; ?>" name="email">
                                                <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                                                <input type="hidden" value="<?= $gestioneanagrafica->idRef; ?>" name="idRef">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalform">Invio</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group  ">
                                                                        <label for="Nome" class=" control-labelt"> Oggetto  *</label>
                                                                        <input class="form-control parsley-validated" placeholder="" required="true" name="oggetto" type="text" value="">
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <div class="row">


                                                                <div class="col-12">
                                                                    <div class="form-group  ">
                                                                        <label for="Carica File" class=" control-labelt">Messaggio * </label>
                                                                        <textarea name="messaggio" rows="3" class="form-control" placeholder="Corpo del Messaggio"></textarea>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer"><button type="submit" class="btn btn-raised btn-primary ml-2">Invia                           
                                                            </button> <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Elenco Appuntamenti</h4>
                  <table id="datatable-buttons1" class="table table-striped table-bordered dt-responsive font-12" cellspacing="0" width="100%">
                    <thead>
                    <th >Data Appuntamento </th>
                    <th>Ore Appuntamento</th>
                    <th>Operatore</th>       
                    <th>Luogo </th>
                    <th>Motivo</th>
                    <th>Note</th>
                    <th>Cancella</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!$objlienti->db->Query("SELECT anagrafica.nome, anagrafica.cognome, anagrafica.idAnagrafica, amministratore.idAmministratore, appuntamenti.*, amministratore.nome AS nominativo, postazioni.* from {$_SESSION['tabella']}.appuntamenti INNER JOIN {$_SESSION['tabella']}.anagrafica ON anagrafica.idAnagrafica=appuntamenti.idCliente LEFT JOIN {$_SESSION['tabella']}.amministratore ON amministratore.idAmministratore=appuntamenti.idAmministratore LEFT JOIN {$_SESSION['tabella']}.postazioni ON postazioni.idPostazioni=appuntamenti.idPostazione  WHERE anagrafica.idAnagrafica={$_POST['idAna']}"))
                            echo $objlienti->db->Kill();
                        while ($gestioneventi = $objlienti->db->Row()) {
                            ?>
                            <tr>
                                <td> <?= date('d-m-Y', $gestioneventi->str_data) ?> </td>
                                <td> <?= $gestioneventi->orario; ?> </td>                 
                                <td> <?= $gestioneventi->nominativo ?> </td>
                                <td> <?= $gestioneventi->postazione ?> </td>
                                <td> <?= $gestioneventi->testo ?> </td>
                                <td> <?= $gestioneventi->obiettivi ?> </td>

                                <td><form method="post" enctype="multipart/form-data" action="gestione-clienti-storica.php">
                                        <input type="hidden" value="<?= $gestioneventi->str_data; ?>" name="str_data">
                                         <input type="hidden" value="<?= $gestioneventi->idAppuntamenti; ?>" name="idAppuntamenti">
                                        <input type="hidden" value="1" name="cancella">
                                        <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                                        <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro di voler cancellare questo evento?');"> <i class="fas fa-trash"></i></button>
                                    </form></td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Elenco Interazione</h4>
                <table id="datatable-buttons3" class="table table-striped table-bordered dt-responsive font-12" cellspacing="0" width="100%">
                    <thead>
                    <th >Data Interazione </th>
                    <th>Ore Interazione</th>
                    <th>Operatore</th>       
                    <th>Contatto </th>
                    <th>Motivo</th>
                    <th>Note</th>
                    <th>Cancella</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!$objlienti->db->Query("SELECT anagrafica.nome, anagrafica.cognome, anagrafica.idAnagrafica, amministratore.idAmministratore, interazioneCliente.*, amministratore.nome AS nominativo from {$_SESSION['tabella']}.interazioneCliente INNER JOIN {$_SESSION['tabella']}.anagrafica ON anagrafica.idAnagrafica=interazioneCliente.idCliente LEFT JOIN {$_SESSION['tabella']}.amministratore ON amministratore.idAmministratore=interazioneCliente.idAmministratore  WHERE anagrafica.idAnagrafica={$_POST['idAna']}"))
                            echo $objlienti->db->Kill();
                        while ($gestioneventi = $objlienti->db->Row()) {
                            ?>
                            <tr>
                                <td> <?= $gestioneventi->dataInterazione ?> </td>
                                <td> <?= $gestioneventi->OraInterazione; ?> </td>                 
                                <td> <?= $gestioneventi->nominativo ?> </td>
                                <td> <?= $gestioneventi->contatto ?> </td>
                                <td> <?= $gestioneventi->testo ?> </td>
                                <td> <?= $gestioneventi->note ?> </td>

                                <td><form method="post" enctype="multipart/form-data" action="gestione-clienti-storica.php">
                                        <input type="hidden" value="<?= $gestioneventi->idInt; ?>" name="idInt">
                                        <input type="hidden" value="<?= $gestioneventi->idCliente; ?>" name="idClienteRefere">
                                        <input type="hidden" value="1" name="cancellaInt">
                                        <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                                        <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro di voler cancellare questo evento?');"> <i class="fas fa-trash"></i></button>
                                    </form></td>

                            </tr>
    <?php
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- gestione apputamenti -->

<form action="gestione-clienti-storica.php" method="post" name="postazione">
    <div class="modal fade bd-example-modal-form-aggApp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiugi Appuntamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Cliente</label>
                                <select class="form-control" name="idAna" required="">
<?PHP echo $cliente->anagraficaCliente(IDAZIENDA); ?>
                                </select>
                                <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Data </label>
                                <input type="date" name="str_data" required=""  class="form-control" placeholder="Inserisci la data">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Ora </label>
                                <input type="time" name="orario" required="" class="form-control" placeholder="Inserisci l'ora">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Postazioni</label>
                                <select class="form-control" name="idPostazione">
<?= $calendario->postazione(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Operatore</label>
                                <select class="form-control" name="idAmministratore">
<?= $operatore->operatoriSelect(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Dettagli Appuntamenti</label>
                                <textarea class="form-control" required="" placeholder="Dettagli Appuntamento" name="testo"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Note</label>
                                <textarea class="form-control" placeholder="Aggiungi gli Obiettivi o note" required="" name="obiettivi"></textarea>
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


<!-- gestione referenti -->

<form action="gestione-clienti-storica.php" method="post" name="postazione">
    <div class="modal fade bd-example-modal-form-aggRef" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiugi Referente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Nome *</label>
                                <input type="text" name="nomeReferente" required=""  class="form-control" placeholder="Inserisci il nome">
                                <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Cognome *</label>
                                <input type="text" name="cognome" required=""  class="form-control" placeholder="Inserisci il cognome">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Telefono</label>
                                <input type="text" name="telefono" required="" class="form-control" placeholder="Telefono....">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Email *</label>
                                <input type="text" name="email" required="" class="form-control" placeholder="Email...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Posizione Ricoperta *</label>
                                <input name="tipo" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Assegnato A</label>
                                <select class="form-control" name="idAmministratore">
<?= $operatore->operatoriSelect(); ?>
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


<!-- gestione interazione -->

<form action="gestione-clienti-storica.php" method="post" name="postazione">
    <div class="modal fade bd-example-modal-form-aggInte" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiugi Interazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Cliente</label>
                                <select class="form-control" name="idClienteRefere" required="">
<?PHP echo $cliente->anagraficaCliente(IDAZIENDA); ?>
                                </select>
                                <input type="hidden" value="<?= $_POST['idAna']; ?>" name="idAna">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Data </label>
                                <input type="date" name="dataInterazione" required=""  class="form-control" placeholder="Inserisci la data">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Ora </label>
                                <input type="time" name="OraInterazione" required="" class="form-control" placeholder="Inserisci l'ora">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Tipo di Contatto</label>
                                <select class="form-control" name="contatto">
                                    <option value="Telefonico">Telefonico</option>
                                    <option value="Email">Email</option>
                                    <option value="Altro">Altro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Operatore</label>
                                <select class="form-control" name="idAmministratore">
<?= $operatore->operatoriSelect(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Dettaglio</label>
                                <textarea class="form-control" required="" placeholder="Dettaglo" name="testo"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Note</label>
                                <textarea class="form-control" placeholder="Aggiungi note" required="" name="note"></textarea>
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