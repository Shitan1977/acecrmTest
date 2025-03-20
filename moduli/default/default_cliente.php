<?php
#geestione anagrafica
$cliente = new class_anagrafica(NOMETABELLA);
#gestione calendario
$calendario = new class_calendario(NOMETABELLA);

#gestione operatore
$operatore = new class_operatori(NOMETABELLA);

?>
<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right"><i class="mdi mdi-cube-outline"></i></div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Strutture</h6>
                <div class="float-right">
                    <p class="mb-0"><b>Conteggio:</b> totali</p>
                </div>
                <h4 class="mb-0">
                    0<small class="ml-2"><i class="mdi mdi-arrow-up text-primary"></i></small>
                </h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right"><i class="mdi mdi-buffer"></i></div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Attive</h6>
                <div class="float-right">
                    <p class="mb-0"><b>Effettivi:</b></p>
                </div>
                <h4 class="mb-0">
                    0<small class="ml-2"><i class="mdi mdi-arrow-down text-danger"></i></small>
                </h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card mini-stat">
            <div class="mini-stat-icon text-right"><i class="mdi mdi-tag-text-outline"></i></div>
            <div class="p-4">
                <h6 class="text-uppercase mb-3">Disattivate</h6>
                <div class="float-right">
                    <p class="mb-0"><b>Partecipanti:</b> </p>
                </div>
                <h4 class="mb-0">
                    0<small class="ml-2"><i class="mdi mdi-arrow-up text-primary"></i></small>
                </h4>
            </div>
        </div>
    </div>

</div>