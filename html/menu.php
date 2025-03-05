<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <?php
                if (!$varie->db->Query("SELECT * FROM test_acecrm.categorie_attive INNER JOIN test_acecrm.categoria_moduli ON categoria_moduli.idCatMod =categorie_attive.idCatMod WHERE idAzienda='{$_SESSION['idAzienda']}' and livello='{$_SESSION['livello']}' ORDER BY  categoria"))
                    ;

                while ($categoriemenu = $varie->db->Row()) {
                    ?>  

                    <li class="has-submenu">
                        <a href="#"><i class="mdi <?= $categoriemenu->icone_interne; ?>"></i>

                            <?= $translations[$categoriemenu->categoria] ?? $categoriemenu->categoria; ?>
                        </a>
                        <ul class="submenu">
                            <?php
                            // MENU CONTENENTE LE VOCI DEL MODULI E QUELLI ATTIVI PER UTENTE

                            if (!$assistenza->db->Query("SELECT moduli_attivi.modulo, moduli_attivi.idAzienda, moduli_attivi.idModulo, moduli.idModuli, moduli.idCatMod, moduli.modulo AS nome, moduli.reurl, moduli.livello, moduli.idCatMod, categorie_attive.idCatMod, permessi.idModuli, permessi.idPermesso, permessi.idRuolo FROM test_acecrm.moduli INNER JOIN test_acecrm.moduli_attivi ON moduli.idModuli =moduli_attivi.modulo INNER JOIN test_acecrm.categorie_attive ON categorie_attive.idCatMod=moduli.idCatMod INNER JOIN {$tabella}.permessi ON  permessi.idModuli = moduli_attivi.idModulo WHERE moduli_attivi.idAzienda='{$_SESSION['idAzienda']}' AND moduli.idCatMod='{$categoriemenu->idCatMod}' AND moduli_attivi.livello='{$_SESSION['livello']}' AND permessi.idRuolo={$_SESSION['idRuolo']} AND categorie_attive.idAzienda ={$_SESSION['idAzienda']} ORDER BY  moduli.modulo")) echo $assistenza->db->Kill();

                            while ($menumoduli = $assistenza->db->Row()) {
                                ?>        
                                <li>
                                    <a href="gestione-<?= $menumoduli->reurl; ?>.php"><?= $menumoduli->nome; ?></a>

                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <!-- End navigation menu -->
        </div> <!-- end navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->