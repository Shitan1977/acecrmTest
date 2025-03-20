<?php
include_once 'controller.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo di Password</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email di Recupero</th>
                            <th>Operatore</th>
                            <th>Modifica</th>
                            <th>Cancella</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $objPassword->db->Query("SELECT pws_personali.*, amministratore.nome, amministratore.cognome, amministratore.idAmministratore from $tabellaprov.pws_personali INNER JOIN $tabellaprov.amministratore ON idOperatore=idAmministratore where pws_personali.idAzienda='{$_SESSION['idAzienda']}'");
                        while ($pws = $objPassword->db->Row()) {
                            ?>
                            <tr>
                                <td><?= $pws->idPersonale; ?></td>
                                <td><?= $pws->tipo; ?></td>
                                <td><?= $pws->user; ?></td>
                                <td><?= $pws->password; ?></td>
                                <td><?= $pws->domandaChiave; ?></td>
                                <td><?= $pws->nome; ?> <?= $pws->cognome; ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-password-<?= $pws->idPersonale; ?>"><i class="fas fa-edit"></i></a>
                                    <!-- apertura del modale di modifica -->
                                    <form action="gestione-password.php" method="post" name="gestione_password">
                                        <input type="hidden" value="<?= $pws->idPersonale; ?>" name="idPersonale">
                                        <div class="modal fade bd-example-modal-form-password-<?= $pws->idPersonale; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalform">Aggiungi le tue Password</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group"><label for="field-1" class="control-label">User</label> <input type="text" class="form-control" id="field-1"  name="user" required="" value="<?= $pws->user; ?>"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group"><label for="field-2" class="control-label">Password</label> <input required="" type="text" class="form-control" id="field-2"  name="password" value="<?= $pws->password; ?>"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group"><label for="field-2" class="control-label">Email di Riferimento</label> <input  type="text" class="form-control" id="field-2"   name="domandaChiave" value="<?= $pws->domandaChiave; ?>"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group"><label for="field-2" class="control-label">Tipo di Password</label> <input  type="text" class="form-control" id="field-2"  name="tipo" value="<?= $pws->tipo; ?>"></div>
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

                                </td>
                                <td>
                                    <form method="post" enctype="multipart/form-data" action="gestione-password.php">
                                        <input type="hidden" value="<?= $pws->idPersonale; ?>" name="idPersonale">
                                        <input type="hidden" value="1" name="cancella">
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
<!--- Aggiungere passl -->
<form action="gestione-password.php" method="post" name="gestione_password">
    <div class="modal fade bd-example-modal-form-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi le tue Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-1" class="control-label">User</label> <input type="text" class="form-control" id="field-1"  name="user" required="" value=""></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-2" class="control-label">Password</label> <input required="" type="text" class="form-control" id="field-2"  name="password" value=""></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-2" class="control-label">Email di Riferimento</label> <input  type="text" class="form-control" id="field-2"   name="domandaChiave" value=""></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-2" class="control-label">Tipo di Password</label> <input  type="text" class="form-control" id="field-2"  name="tipo" value=""></div>
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

