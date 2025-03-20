<?php
#geestione anagrafica
$cliente = new class_anagrafica(NOMETABELLA);
#gestione calendario
$calendario = new class_calendario(NOMETABELLA);

#gestione operatore
$operatore = new class_operatori(NOMETABELLA);

#gestione del calendario cancellazionr
if (!empty($_POST['cancella'])) {

    $calendario->cancellaAppuntamento($_POST['idAppuntamenti']);
    @header("location:gestione-appuntamenti.php");
}
if (!empty($_POST['postazione'])) {
    $calendario->aggiungiPostazione($_POST['postazione']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['esito'])) {

    $calendario->updateAppuntamento();
}
?>
<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Calendario</h4>
                </div>
                <form action="gestione-appuntamenti.php" method="post">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-12 mb-1">

                                    <fieldset class="form-group">
                                        <label for="basicInput">Visualizza Altri Eventi</label>
                                        <input required type="date" class="form-control" id="basicInput" value="<?= $_POST['dataConvert']; ?>" name="dataConvert">
                                    </fieldset>

                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">

                                    <fieldset class="form-group">
                                        <label for="basicInput">Operatori</label>
                                        <select class="form-control m-b-5" name="idAmministratore">
                                            <?= $operatore->operatoriSelect($_POST['idAmministratore']); ?>
                                        </select>
                                    </fieldset>

                                </div>
                                <div class="col-xl-4 col-md-6 col-12">
                                    <fieldset class="form-group">
                                        <label><br><br><br></label>
                                        <button type="submit" class="btn btn-raised btn-primary ml-2">Visualizza Eventi</button>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <th >Data </th>
                    <th>Cliente</th>
                    <th>Operatore Assegnato</th>
                    <th>Stanza</th>
                    <th>Oggetto</th>
                    <th>Obiettivo</th>
                    <th>Risultato</th>
                    <th>Cancella</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_POST['dataConvert'])) {
                            $dataconvertita = strtotime($_POST['dataConvert']);
                        } else {
                            $dataconvertita = $_POST['data'];
                        }
                        if (!empty($_POST['idAmministratore'])) {
                            $idOperatore = 'and ' . $_POST['idAmministratore'];
                        }
                        if (!$calendario->db->Query("SELECT anagrafica.nome, anagrafica.cognome, anagrafica.idAnagrafica,  amministratore.idAmministratore, appuntamenti.*, amministratore.nome AS nominativo, postazioni.* from {$_SESSION['tabella']}.appuntamenti INNER JOIN {$_SESSION['tabella']}.anagrafica ON anagrafica.idAnagrafica=appuntamenti.idCliente LEFT JOIN {$_SESSION['tabella']}.amministratore ON amministratore.idAmministratore=appuntamenti.idAmministratore LEFT JOIN {$_SESSION['tabella']}.postazioni ON postazioni.idPostazioni=appuntamenti.idPostazione  WHERE str_data='{$dataconvertita}' $idOperatore"))
                            echo $calendario->db->Kill();
                        while ($gestioneventi = $calendario->db->Row()) {
                            ?>                  
                            <tr>
                                <?php
                               
// Imposta il fuso orario corretto (Italia)
                                date_default_timezone_set('Europe/Rome');

                                
// Imposta la localizzazione italiana
                                setlocale(LC_TIME, 'it_IT.UTF-8');

// Converte il timestamp in una data formattata in italiano
                                $data_formattata = strftime("%A %d %B %Y", $gestioneventi->str_data);

                              
                                ?>

                                <td> <?= $data_formattata . ' ' . $gestioneventi->orario; ?> </td>
                                <td><?= $gestioneventi->nome; ?> <?= $gestioneventi->cognome; ?></td>
                                <td><?= $gestioneventi->nominativo; ?></td>
                                <td><?= $gestioneventi->postazione; ?></td>
                                <td><?= $gestioneventi->testo; ?></td>
                                <td><?= $gestioneventi->obiettivi; ?></td>
                                <td><?= $gestioneventi->esito; ?></td>

                                <td>
                                    <div class="input-group">
                                        <form method="post" enctype="multipart/form-data" action="gestione-appuntamenti.php">
                                            <input type="hidden" value="<?= $gestioneventi->idAppuntamenti; ?>" name="idAppuntamenti">
                                            <input type="hidden" value="1" name="cancella">
                                            <button type="submit"  class="btn btn-primary waves-effect waves-light" onclick="return confirm('sei sicuro di voler cancellare questo evento?');"> <i class="fas fa-trash"></i></button>
                                        </form>
                                        <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-esito-<?= $gestioneventi->idAppuntamenti; ?>"><i class="fas fa-chalkboard-teacher"></i></a>
                                        <form action="gestione-appuntamenti.php" method="post" name="calendario">
                                            <div class="modal fade bd-example-modal-esito-<?= $gestioneventi->idAppuntamenti; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalform">Inserisci Esito</h5>
                                                            <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                            <input type="hidden" value="<?= $gestioneventi->idAppuntamenti; ?>" name="idApp">
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="field-2" class="control-label">Esito</label>
                                                                        <textarea  class="form-control" placeholder='scrivi  qui ...' name="esito" ></textarea>
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

<!-- postazioni -->

<!-- gestione apputamenti -->
<form action="content.php" method="post" name="postazione">
    <div class="modal fade bd-example-modal-form-postazione" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Inserisci Postazioni</h5>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Descrivi il luogo dell'appuntamento o la stanza o altro</label>
                                <textarea  class="form-control" placeholder='scrivi  qui ...' name="postazione" ></textarea>
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
<!-- gestione apputamenti -->

<form action="content.php" method="post" name="postazione">
    <div class="modal fade bd-example-modal-form-appuntamenti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                <select class="form-control" name="idAnagrafica" required="">
                                    <?PHP echo $cliente->anagraficaCliente(IDAZIENDA); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Data Visita</label>
                                <input type="date" name="str_data" required=""  class="form-control" placeholder="Inserisci la data">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Ora della visita</label>
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
                                <label for="field-2" class="control-label">Obiettivi da raggiungere</label>
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

<!-- gestione esito -->
<form action="content.php" method="post" name="postazione">
    <div class="modal fade bd-example-modal-form-esito" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Inserisci Esito</h5>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Esito</label>
                                <textarea  class="form-control" placeholder='scrivi  qui ...' name="esito" ></textarea>
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