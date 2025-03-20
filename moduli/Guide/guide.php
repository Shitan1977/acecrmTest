<?php include_once 'controller.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>

                            <th>Data Creazione</th>
                            <th>Tipo</th>
                            <th>Video</th>
                            <th>Pdf</th>
                            <th>Modulo</th>
                            <th>Modifica</th>
                            <th>Cancella</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $objGuide->db->Query("SELECT * from admin_acecrm.guide as g inner join admin_acecrm.moduli as m on m.idModuli=g.idModulo");
                        while ($guide = $objGuide->db->Row()) {
                            ?>
                            <tr>
                                <td><?= $guide->dataCreazione; ?></td>
                                <td><?= $guide->tipo; ?></td>
                                <td><a href="guide/<?= $guide->guida; ?>" download=""><i class="fa fa-camera-retro"></i></a></td>
                                <td><a href="guide/<?= $guide->pdf; ?>" download=""><i class="fa fa-file-pdf-o"></i></a></td>
                                <td><?= $guide->modulo; ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-primary waves-effect waves-light" data-target=".bd-example-modal-form-guida-<?= $guide->idGuida; ?>"><i class="fas fa-edit"></i></a>
                                    <form action="gestione-guide.php" method="post" name="gestione-azienza">
                                        <div class="modal fade bd-example-modal-form-guida-<?= $guide->idGuida; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalform">Modifica</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Titolo</label> 
                                                                    <div class="input-group">
                                                                        <input name="tipo" value="<?= $guide->tipo; ?>" type="text" required="" class="form-control" placeholder="Inserisci il nome" /> 
                                                                        <input name="idGuida" value="<?= $guide->idGuida; ?>"  type="hidden" class="form-control" placeholder="Inserisci il nome" />

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input name="pdf" value="<?= $guide->pdf; ?>" type="file"  class="form-control" placeholder="Inserisci il nome" /> 


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Video</label> 
                                                                    <div class="input-group">
                                                                        <input name="guida" value="<?= $guide->video; ?>" type="file" required="" class="form-control" placeholder="Inserisci il nome" /> 


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Modulo</label> 
                                                                    <div class="input-group">
                                                                        <select name="idModulo" class="form-control">
                                                                            <?= $moduli->selectMod($guide->idModulo); ?>
                                                                        </select>
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
                                    <form method="post" enctype="multipart/form-data" action="gestione-guide.php">
                                        <input type="hidden" value="<?= $guide->idGuida; ?>" name="idGuida">
                                         <input type="hidden" value="<?= $guide->tipo; ?>" name="tipo">
                                        <input type="hidden" value="<?= $guide->idGuida; ?>" name="cancella">
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

<!-- aggiungi listino -->

<form action="gestione-guide.php" method="post" enctype="multipart/form-data" name="gestione-guide">
    <div class="modal fade bd-example-modal-form-addGuida" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Aggiungi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Titolo</label> 
                                <div class="input-group">
                                    <input name="tipo" value="<?= $guide->tipo; ?>" type="text" required="" class="form-control" placeholder="Inserisci il nome" /> 

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Pdf</label> 
                                <div class="input-group">
                                    <input name="pdf" value="" type="file"  class="form-control" placeholder="Inserisci il nome" /> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Video</label> 
                                <div class="input-group">
                                    <input name="guida" value="" type="file"  class="form-control" placeholder="Inserisci il nome" /> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Modulo</label> 
                                <div class="input-group">
                                    <select name="idModulo" class="form-control">
                                        <?= $moduli->selectMod(); ?>
                                    </select>
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
