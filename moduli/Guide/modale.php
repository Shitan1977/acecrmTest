<?php include_once 'controller.php'; ?>


<form action="gestione-<?= $_GET['pag']; ?>.php" method="post" name="gestione-<?= $_GET['pag']; ?>">
    <div class="modal fade bd-example-modal-form-gg<?= $_GET['pag']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalform">Guide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($data): ?>
                                <?php foreach ($data as $row): ?>
                                    <?php if (!empty($row['guida'])): ?>
                                         <video controls width="350">
                                            <source src="guide/<?= $row['guida']; ?>" type="video/mp4">
                                            Il tuo browser non supporta il tag video.
                                        </video>
                                    <?php else: ?>
                                        <p>Nessun video disponibile.</p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Nessun video disponibile.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if ($data): ?>
                                <?php foreach ($data as $row): ?>
                                    <?php if (!empty($row['pdf'])): ?>
                            <a href="guide/<?= $row['pdf']; ?>" download="guide/<?= $row['pdf']; ?>" target="_blank">Scarica PDF</a>
                                    <?php else: ?>
                                        <p>Nessun PDF disponibile.</p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Nessun PDF disponibile.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>