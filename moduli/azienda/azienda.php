<?php
#colleghiamo l'oggetto la class aziendqaq
$objazienda = new class_azienda($_SESSION['username']);

#collogamento classe select dinamiche
$select_dinamiche = new class_select();

#metodi
$objazienda->VisualizzazioneAzienda();
if (isset($_POST['marketplacecol'])) {

    $logo_name = $_FILES['logo']['name'];
    $logo_tmp = $_FILES['logo']['tmp_name'];

    $objazienda->markeplace($_SESSION['idAzienda'], $_POST['testo'], $_POST['marketplacecol'], $logo_name, $logo_tmp, $_POST['indirizzo'], $_POST['tipologia'], $_POST['iva'], $_POST['privincia'], $_POST['comuni'], $_POST['tel']);
}
if (isset($_POST['insert'])) {
    $objazienda->social($_POST['facebook'], $_POST['google'], $_POST['pinterest'], $_POST['youtube'], $_POST['linkedin']);
}
?>

        <form action="gestione-azienda.php" name="azienda" method="post" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Azienda</h4>
                            <p class="text-muted font-14">Descrivi la tua  <code class="highlighter-rouge"> azienda, collega i tuoi social per essere visibile sul markeplace acecrm.it</code> </p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Titolo o Nome dell'azienda</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="marketplacecol" type="text" value="<?= $objazienda->marketplacecol; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tipo di Azienda</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="tipologia" type="text" value="<?= $objazienda->tipologia; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Partita Iva</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="iva" type="text" value="<?= $objazienda->iva; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Indirizzo</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="indirizzo" type="text" value="<?= $objazienda->indirizzo; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Regione</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="regione" type="text" value="<?= $objazienda->regione; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Provincia</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="provincia" type="text" value="<?= $objazienda->provincia; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Comuni</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="comune" type="text" value="<?= $objazienda->comune; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stato</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="stato" type="text" value="<?= $objazienda->stato; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Telefono</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="tel" type="text" value="<?= $objazienda->tel; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label">Logo Aziendale</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="logo" type="file" value="<?= $objazienda->logo; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Descrizione</label>
                                <div class="col-sm-10">
                                    <textarea rows="10" name="testo" class="form-control" aria-label="Descrivi la tua storia della tua azienda"><?= $objazienda->testo; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label> 
                                <div class="col-sm-10">
                                    <button type="submit"   class="btn btn-primary" >Salva</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </form>

        <form action="gestione-azienda.php" name="azienda" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Social</h4>
                            <p class="text-muted font-14">Inserisci i tuoi collegamenti o pagine   <code class="highlighter-rouge">social</code> </p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="facebook" type="text" value="<?= $objazienda->facebook; ?>" id="example-text-input">   
                                    <input class="form-control" name="insert" type="hidden" value="ok" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Google</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="google" type="text" value="<?= $objazienda->google; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pinterest</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="pinterest" type="text" value="<?= $objazienda->pinterest; ?>" id="example-text-input">   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Youtube</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="youtube" type="text" value="<?= $objazienda->youtube; ?>" id="example-text-input">   
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Linkedin</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="linkedin" type="text" value="<?= $objazienda->linkedin; ?>" id="example-text-input">   
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label> 
                                <div class="col-sm-10">
                                    <button type="submit" name="submit"   class="btn btn-primary" >Salva</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </form>
