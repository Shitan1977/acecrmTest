<?php include_once 'controller.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table font-12 table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <th >ID</th>
                    <th>Nominativo</th>
                    <th>Ragione Sociale</th>
                    <th>T. Fisso</th>
                    <th>Mobile</th>
                    <th>E-mail</th>
                    <th>Città</th>

                    <th>Modifica</th>
                    <th>Cancella</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!$this->db->Query("SELECT * from {$_SESSION['tabella']}.fornitori LEFT JOIN  admin_acecrm.comuni ON comuni.id_com=fornitori.idComune order by idFornitori Desc "))
                            echo $this->db->Kill();
                        while ($gestionefornitori = $this->db->Row()) {
                            ?>                  
                            <tr>
                                <td> <?= $gestionefornitori->idFornitori; ?> </td>
                                <td><?= $gestionefornitori->nome; ?> <?= $gestionefornitori->cognome; ?></td>
                                <td><?= $gestionefornitori->ragioneSociale; ?></td>
                                <td><?= $gestionefornitori->fisso; ?></td>
                                <td><?= $gestionefornitori->mobile; ?></td>
                                <td><?= $gestionefornitori->email; ?></td>
                                <td><?= $gestionefornitori->comune; ?></td>

                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-fornitore-<?= $gestionefornitori->idFornitori; ?>"><i class="fas fa-edit"></i></a>
                                    <form action="gestione-fornitori.php" method="post" name="gestione-fornitore.php">
                                        <div class="modal fade bd-example-modal-form-fornitore-<?= $gestionefornitori->idFornitori; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalform">Aggiungi Cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="hidden" value="<?= $gestionefornitori->idFornitori; ?>" name="idFornitori">
                                                                <div class="form-group">
                                                                    <label class="control-label">Ragione Sociale</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->ragioneSociale; ?>" class="form-control" name="ragioneSociale">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Indirizzo</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->indirizzo; ?>" class="form-control" name="indirizzo">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Telefono</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->fisso; ?>" class="form-control" name="fisso">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Partita Iva</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->iva; ?>" class="form-control" name="iva">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Pec</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->pec; ?>" class="form-control" name="pec">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Username</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"   value="<?= $_SESSION['username']; ?>" disabled="disabled" class="form-control" name="username">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Nome</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required" value="<?= $gestionefornitori->nome; ?>" class="form-control" name="nominativo">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Cap</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->cap; ?>" class="form-control" name="cap">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Cellulare</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->mobile; ?>" class="form-control" name="mobile">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Codice Fiscale</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  maxlength="16" minlength="16" value="<?= $gestionefornitori->codiceFiscale; ?>" class="form-control" name="codiceFiscale">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Codice Univoco</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->cod_fornitore; ?>" class="form-control" name="cod_fornitore">
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
                                                                        <input type="text" required="required" value="<?= $gestionefornitori->cognome; ?>" class="form-control" name="cognome">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Regione</label> 
                                                                    <div class="input-group">
                                                                        <select name="regioni" class="form-control regioni-selector" data-id="<?= $gestionefornitori->idFornitori; ?>">
                                                                            <?php echo $opt->ShowRegioni(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Province</label> 
                                                                    <div class="input-group">
                                                                        <select name="province" class="form-control province-selector" data-id="<?= $gestionefornitori->idFornitori; ?>">
                                                                            <option value="">Scegli la provincia</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Città</label> 
                                                                    <div class="input-group">
                                                                        <select name="comuni" class="form-control comuni-selector" data-id="<?= $gestionefornitori->idFornitori; ?>">
                                                                            <option value="">Scegli il comune</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Tipo</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestionefornitori->tipo; ?>" class="form-control" name="tipo">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required"  value="<?= $gestionefornitori->email; ?>" class="form-control" name="email">
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
                                    <form method="post" enctype="multipart/form-data" action="gestione-fornitori.php">
                                        <input type="hidden" value="<?= $gestionefornitori->idFornitori; ?>" name="idFornitori">
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
<form action="gestione-fornitori.php" method="post" name="gestione-fornitori.php">
    <div class="modal fade bd-example-modal-form-fornitore" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Fornitori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Ragione Sociale</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestionefornitori->ragioneSociale; ?>" class="form-control" name="ragioneSociale">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Indirizzo</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestionefornitori->indirizzo; ?>" class="form-control" name="indirizzo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Telefono</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestionefornitori->fisso; ?>" class="form-control" name="fisso">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Partita Iva</label> 
                                <div class="input-group">
                                    <input type="text"  value="" class="form-control" name="iva">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pec</label> 
                                <div class="input-group">
                                    <input type="text"  value="" class="form-control" name="pec">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Username</label> 
                                <div class="input-group">
                                    <input type="text"  required="required"  value="<?= $_SESSION['username']; ?>" disabled="disabled" class="form-control" name="username">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nome</label> 
                                <div class="input-group">
                                    <input type="text" required="required" value="<?= $gestionefornitori->nome; ?>" class="form-control" name="nominativo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cap</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestionefornitori->cap; ?>" class="form-control" name="cap">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cellulare</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestionefornitori->mobile; ?>" class="form-control" name="mobile">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Codice Fiscale</label> 
                                <div class="input-group">
                                    <input type="text"  maxlength="16" minlength="16" value="<?= $gestionefornitori->codiceFiscale; ?>" class="form-control" name="codiceFiscale">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Codice Univoco</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestionefornitori->cod_fornitore; ?>" class="form-control" name="cod_fornitore">
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
                                    <input type="text" required="required" value="<?= $gestionefornitori->cognome; ?>" class="form-control" name="cognome">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Regione</label> 
                                <div class="input-group">
                                    <select name="regioni" id="regioni3" class="form-control">
                                        <?php echo $opt->ShowRegioni(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Province</label> 
                                <div class="input-group">
                                    <select name="province" id="province3"  class="form-control">
                                        <option value="">Scegli la provincia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Città</label> 
                                <div class="input-group">
                                    <select name="comuni" id="comuni3" class="form-control"  >
                                        <option value="">Scegli il comune</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tipo</label> 
                                <div class="input-group">
                                    <input type="text"  value="" class="form-control" name="tipo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label> 
                                <div class="input-group">
                                    <input type="text" required="required"  value="<?= $gestionefornitori->email; ?>" class="form-control" name="email">
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

<!-- aggiungere fatture -->
<form action="gestione-fornitori.php" method="post" name="gestione-fornitori.php" enctype="multipart/form-data">
    <div class="modal fade bd-example-modal-form-fatture" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Fattura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input  type="hidden" value="1" name="fattura">
                                <label for="field-2" class="control-label">Progressivo</label>
                                <input  type="text" value="" name="progressivo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Fattura</label>
                                <div class="input-group">
                                    <input type="file"  value="" class="form-control" name="documento">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tipologia</label>
                                <div class="input-group">
                                    <select name="tipologia" class="form-control">
                                        <option value="cliente">Emesse</option>
                                        <option value="fornitore">Ricevute</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="field-2" class="control-label">Data</label>
                                <input  type="date" class="form-control" id="field-2" format="yyyy/mm/dd" name="dataDocumento" value=""></div>
                            <div class="form-group">
                                <label for="field-2" class="control-label">Oggetto</label>
                                <textarea class="form-control" name="oggetto"></textarea>
                            </div>                         
                            <div class="form-group">
                                <label for="field-2" class="control-label">Fornitore</label>
                                <select name="idFornitore" class="form-control">
                                    <?= $objFornitori->FornitoriSelect(); ?>
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