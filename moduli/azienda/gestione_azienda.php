<?php
include_once 'controller.php';
#collogamento classe select dinamiche
$select_dinamiche=new class_select();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>

                    <th >Ragione Sociale</th>
                    <th>Tipologoa</th>
                    <th>Iva</th>
                    <th>Indirizzo</th>
                    <th>Telefono</th>

                    <th>Modifica</th>
                    <th>Disattiva</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!$this->db->Query("SELECT * from admin_acecrm.azienda as az LEFT JOIN admin_acecrm.comuni ON comuni.id_com=az.idComune"))
                            echo $this->db->Kill();
                        while ($viewAzienda = $this->db->Row()) {
                            ?>                  
                            <tr>
                                <td> <?= $viewAzienda->ragioneSociale; ?> </td>
                                <td><?= $viewAzienda->tipologia; ?></td>
                                <td><?= $viewAzienda->iva; ?></td>
                                <td><?= $viewAzienda->indirizzo; ?></td>
                                <td><?= $viewAzienda->tel; ?></td>
                                <td><a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-azienda-<?= $viewAzienda->idAzienda; ?>"><i class="fas fa-edit"></i></a>
                                    <form action="gestione-gestione_azienda.php" method="post" name="gestione-gestione_azienda.php">
                                        <div class="modal fade bd-example-modal-form-azienda-<?= $viewAzienda->idAzienda; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalform">Aggiungi Cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="hidden" value="<?=$viewAzienda->idAziend; ?>" name="idAzienda">
                                                                <div class="form-group">
                                                                    <label class="control-label">Ragione Sociale</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?=$viewAzienda->ragioneSociale; ?>" class="form-control" name="ragioneSociale">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Indirizzo</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?=$viewAzienda->indirizzo; ?>" class="form-control" name="indirizzo">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Telefono</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?=$viewAzienda->tel; ?>" class="form-control" name="tel">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Partita Iva</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?=$viewAzienda->iva; ?>" class="form-control" name="iva">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Username</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  required="required"  value="<?=$_SESSION['username']; ?>" disabled="disabled" class="form-control" name="username">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Nome</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required" value="<?=$viewAzienda->nome; ?>" class="form-control" name="nome">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Cap</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $viewAzienda->cap; ?>" class="form-control" name="cap">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Cellulare</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $viewAzienda->mobile; ?>" class="form-control" name="mobile">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Codice Fiscale</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  maxlength="16" minlength="16" value="<?= $viewAzienda->codiceFiscale; ?>" class="form-control" name="codiceFiscale">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Password</label> 
                                                                    <div class="input-group">
                                                                        <input type="password"  value="" class="form-control" name="pws">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Cognome</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required" value="<?= $viewAzienda->cognome; ?>" class="form-control" name="cognome">
                                                                    </div>
                                                                </div>
                                                             
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required"  value="<?= $viewAzienda->email; ?>" class="form-control" name="email">
                                                                    </div>
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
                                </td>
                                <td>
                                    <form method="post" enctype="multipart/form-data" action="gestione-clienti.php">
                                        <input type="hidden" value="<?= $viewAzienda->idFornitori; ?>" name="idFornitori">
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


<!-- aggiungere modali -->
<form action="gestione-gestione_azienda.php" method="post" name="gestione-azienza">
    <div class="modal fade bd-example-modal-form-aggAzienda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Ragione Sociale</label> 
                                <div class="input-group">
                                    <input type="text" required=""  value="" class="form-control" name="ragioneSociale">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Indirizzo</label> 
                                <div class="input-group">
                                    <input type="text"  value="" class="form-control" name="indirizzo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Telefono</label> 
                                <div class="input-group">
                                    <input type="text"  value="" class="form-control" name="tel">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tipo di Azienda</label> 
                                <div class="input-group">
                                    <select name="tipologia" class="form-control" required="">
                                        <option value="Società semplice">Società semplice</option>
                                        <option value="Persona Fisica">Persona Fisica</option>
                                        <option value="Libero Professionista">Libero Professionista</option>
                                        <option value="Ditta Individuale">Ditta Individuale</option>
                                        <option value="Società in accomandita per azioni">Società in accomandita per azioni</option>
                                        <option value="Società per azioni">Società per azioni</option>
                                        <option value="Società in accomandita semplice">Società in accomandita semplice</option>
                                        <option value="Società in nome collettivo">Società in nome collettivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Partita Iva</label> 
                                <div class="input-group">
                                    <input type="text"  value="" class="form-control" name="iva">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Username</label> 
                                <div class="input-group">
                                    <input type="text"   required="required"  value=""  class="form-control" name="username">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nome Amministratore</label> 
                                <div class="input-group">
                                    <input type="text" required="required" value="<?= $viewAzienda->nome; ?>" class="form-control" name="nome">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Cap</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $viewAzienda->cap; ?>" class="form-control" name="cap">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cellulare</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $viewAzienda->mobile; ?>" class="form-control" name="mobile">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Codice Fiscale</label> 
                                <div class="input-group">
                                    <input type="text"  maxlength="16" minlength="16" value="<?= $viewAzienda->codiceFiscale; ?>" class="form-control" name="codiceFiscale">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label> 
                                <div class="input-group">
                                    <input type="password"  value="" class="form-control" name="pws">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Cognome</label> 
                                <div class="input-group">
                                    <input type="text" required="required" value="<?= $viewAzienda->cognome; ?>" class="form-control" name="cognome">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Regione</label> 
                                <div class="input-group">
                                    <select name="regioni" id="regioni2" class="form-control">
                                        <?php echo $select_dinamiche->ShowRegioni(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Province</label> 
                                <div class="input-group">
                                    <select name="province" id="province2"  class="form-control">
                                        <option value="">Scegli la provincia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Città</label> 
                                <div class="input-group">
                                    <select name="comuni" id="comuni2" class="form-control"  >
                                        <option value="">Scegli il comune</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label> 
                                <div class="input-group">
                                    <input type="text" required="required"  value="<?= $viewAzienda->email; ?>" class="form-control" name="email">
                                </div>
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