<?php
include_once 'controller.php';
?>
<script>

    $(document).ready(function () {
        $('#datatable-buttons1').DataTable({
            destroy: false,
            order: [[3, 'desc']],
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
                <table id="datatable-buttons1" class="table table-striped table-bordered dt-responsive font-12" cellspacing="0" width="100%">
                    <thead>
                    <th >ID</th>
                    <th>Nominativo</th>
                    <th>Ragione Sociale</th>
                    <th>T. Fisso</th>
                    <th>Mobile</th>
                    <th>E-mail</th>
                    <th>Città</th>
                    <th>Tipo</th>
                    <th>Cronologia</th>
                    <th>Modifica</th>
                    <th>Cancella</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!$this->db->Query("SELECT * from {$_SESSION['tabella']}.anagrafica LEFT JOIN  test_acecrm.comuni ON comuni.id_com=anagrafica.idComune "))
                            echo $this->db->Kill();
                        while ($gestioneanagrafica = $this->db->Row()) {
                            ?>                  
                            <tr>
                                <td> <?= $gestioneanagrafica->idAnagrafica; ?> </td>
                                <td><?= $gestioneanagrafica->nome; ?> <?= $gestioneanagrafica->cognome; ?></td>
                                <td><?= $gestioneanagrafica->ragioneSociale; ?></td>
                                <td><?= $gestioneanagrafica->fisso; ?></td>
                                <td><?= $gestioneanagrafica->mobile; ?></td>
                                <td><?= $gestioneanagrafica->email; ?></td>
                                <td><?= $gestioneanagrafica->comune; ?></td>
                                <td><?= $gestioneanagrafica->PosizioneRicoperta; ?></td>
                                <td> <form method="post" enctype="multipart/form-data" action="gestione-clienti-storica.php">
                                        <input type="hidden" value="<?= $gestioneanagrafica->idAnagrafica; ?>" name="idAna">

                                        <button type="submit"  class="btn btn-primary waves-effect waves-light"><i class="fas fa-file"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-clienti-<?= $gestioneanagrafica->idAnagrafica; ?>"><i class="fas fa-edit"></i></a>
                                    <form action="gestione-clienti.php" method="post" name="gestione-clienti.php">
                                        <div class="modal fade bd-example-modal-form-clienti-<?= $gestioneanagrafica->idAnagrafica; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalform">Modifica Cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="hidden" value="<?= $gestioneanagrafica->idAnagrafica; ?>" name="idAnagrafica">
                                                                <div class="form-group">
                                                                    <label class="control-label">Ragione Sociale</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestioneanagrafica->ragioneSociale; ?>" class="form-control" name="ragioneSociale">
                                                                    </div>
                                                                </div>  

                                                                <div class="form-group">
                                                                    <label class="control-label">Indirizzo</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestioneanagrafica->indirizzo; ?>" class="form-control" name="indirizzo">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Telefono</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestioneanagrafica->fisso; ?>" class="form-control" name="fisso">
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
                                                                        <input type="text"  required="required"  value="<?= $_SESSION['username']; ?>" disabled="disabled" class="form-control" name="username">
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
                                                                    <label class="control-label">Nome</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required" value="<?= $gestioneanagrafica->nome; ?>" class="form-control" name="nome">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Posizione ricoperta</label> 
                                                                    <div class="input-group">
                                                                        <select class="form-control" name="PosizioneRicoperta">
                                                                            <option <?= ($gestioneanagrafica->PosizioneRicoperta == 'Prospect') ? 'selected' : ''; ?> value="Prospect">Prospect</option>
                                                                            <option <?= ($gestioneanagrafica->PosizioneRicoperta == 'Cliente') ? 'selected' : ''; ?> value="Cliente">Cliente</option>
                                                                            <option <?= ($gestioneanagrafica->PosizioneRicoperta == 'Cliente Freddo') ? 'selected' : ''; ?> value="Cliente Freddo">Cliente Freddo</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Cap</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestioneanagrafica->cap; ?>" class="form-control" name="cap">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Cellulare</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  value="<?= $gestioneanagrafica->mobile; ?>" class="form-control" name="mobile">
                                                                    </div>
                                                                </div>  

                                                                <div class="form-group">
                                                                    <label class="control-label">Codice Fiscale</label> 
                                                                    <div class="input-group">
                                                                        <input type="text"  maxlength="16" minlength="16" value="<?= $gestioneanagrafica->codiceFiscale; ?>" class="form-control" name="codiceFiscale">
                                                                    </div>
                                                                </div>  

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Cognome</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required" value="<?= $gestioneanagrafica->cognome; ?>" class="form-control" name="cognome">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Regione</label> 
                                                                    <div class="input-group">
                                                                        <select name="regioni" class="form-control regioni-selector" data-id="<?= $gestioneanagrafica->idAnagrafica; ?>">
                                                                            <?php echo $select_dinamiche->ShowRegioni(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Province</label> 
                                                                    <div class="input-group">
                                                                        <select name="province" class="form-control province-selector" data-id="<?= $gestioneanagrafica->idAnagrafica; ?>">
                                                                            <option value="">Scegli la provincia</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Città</label> 
                                                                    <div class="input-group">
                                                                        <select name="comuni" class="form-control comuni-selector" data-id="<?= $gestioneanagrafica->idAnagrafica; ?>">
                                                                            <option value="">Scegli il comune</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label> 
                                                                    <div class="input-group">
                                                                        <input type="text" required="required"  value="<?= $gestioneanagrafica->email; ?>" class="form-control" name="email">
                                                                    </div>
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
                                </td>
                                <td>
                                    <form method="post" enctype="multipart/form-data" action="gestione-clienti.php">
                                        <input type="hidden" value="<?= $gestioneanagrafica->idAnagrafica; ?>" name="idAnagrafica">
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
<form action="gestione-clienti.php" method="post" name="gestione-clienti.php">
    <div class="modal fade bd-example-modal-form-clienti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="control-label">Ragione Sociale</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestioneanagrafica->ragioneSociale; ?>" class="form-control" name="ragioneSociale">
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="control-label">Indirizzo</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestioneanagrafica->indirizzo; ?>" class="form-control" name="indirizzo">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Telefono</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestioneanagrafica->fisso; ?>" class="form-control" name="fisso">
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
                                    <input type="text"  required="required"  value="<?= $_SESSION['username']; ?>" disabled="disabled" class="form-control" name="username">
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
                                <label class="control-label">Nome</label> 
                                <div class="input-group">
                                    <input type="text" required="required" value="<?= $gestioneanagrafica->nome; ?>" class="form-control" name="nome">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cap</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestioneanagrafica->cap; ?>" class="form-control" name="cap">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Posizione ricoperta</label> 
                                <div class="input-group">
                                    <select class="form-control" name="PosizioneRicoperta">
                                        <option value="Prospect">Prospect</option>
                                        <option value="Cliente">Cliente</option>
                                        <option value="Cliente Freddo">Cliente Freddo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cellulare</label> 
                                <div class="input-group">
                                    <input type="text"  value="<?= $gestioneanagrafica->mobile; ?>" class="form-control" name="mobile">
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="control-label">Codice Fiscale</label> 
                                <div class="input-group">
                                    <input type="text"  maxlength="16" minlength="16" value="<?= $gestioneanagrafica->codiceFiscale; ?>" class="form-control" name="codiceFiscale">
                                </div>
                            </div>  

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Cognome</label> 
                                <div class="input-group">
                                    <input type="text" required="required" value="<?= $gestioneanagrafica->cognome; ?>" class="form-control" name="cognome">
                                </div>
                            </div>
                           <div class="form-group">
    <label class="control-label">Regione</label> 
    <div class="input-group">
        <select name="regioni" id="regioni3" class="form-control regioni-selector">
            <?php echo $select_dinamiche->ShowRegioni(); ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label">Province</label> 
    <div class="input-group">
        <select name="province" id="province3" class="form-control province-selector">
            <option value="">Scegli la provincia</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label">Città</label> 
    <div class="input-group">
        <select name="comuni" id="comuni3" class="form-control comuni-selector">
            <option value="">Scegli il comune</option>
        </select>
    </div>
</div>

                            <div class="form-group">
                                <label class="control-label">Email</label> 
                                <div class="input-group">
                                    <input type="text" required="required"  value="<?= $gestioneanagrafica->email; ?>" class="form-control" name="email">
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
