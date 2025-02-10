<?php
session_start();
ob_start();
include_once 'mysql_class.php';
//

class pagine_class extends MySQL {

    private $tabella;
    private $db;
    
    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db=new MySQL();
        
    }

    #metodo per vedere l'elendo del menu

    public function menuDinamico($azienda,$idRuolo,$livello) {
        $db=new MySQL();
     
        $this->db->Query("SELECT * FROM admin_acecrm.categorie_attive INNER JOIN admin_acecrm.categoria_moduli ON categoria_moduli.idCatMod =categorie_attive.idCatMod WHERE idAzienda={$azienda} ORDER BY  categoria");
        while($menuD=$this->db->Row()){
            echo $menuD->categoria;
                     
        }
                
    }
    
    public function sottoMenu($azienda,$idRuolo,$livello,$categoria) {
        $this->Query("SELECT moduli_attivi.modulo, moduli_attivi.idAzienda, moduli_attivi.idModulo, moduli.idModuli, moduli.idCatMod, moduli.modulo AS nome, moduli.reurl, moduli.livello, moduli.idCatMod, categorie_attive.idCatMod, permessi.idModuli, permessi.idPermesso, permessi.idRuolo FROM admin_acecrm.moduli INNER JOIN admin_acecrm.moduli_attivi ON moduli.idModuli =moduli_attivi.modulo INNER JOIN admin_acecrm.categorie_attive ON categorie_attive.idCatMod=moduli.idCatMod INNER JOIN {$tabella}.permessi ON  permessi.idModuli = moduli_attivi.idModulo WHERE moduli_attivi.idAzienda='{$azienda}' AND moduli.idCatMod='{$categoria}' AND moduli.livello='{$livello}' AND permessi.idRuolo=$idRuolo} AND categorie_attive.idAzienda ={$azienda} ORDER BY  moduli.modulo");
         while($sottoMenu=$this->Row()){
   
           $smenu='<li>';
           $smenu.="<a href='gestione-$menumoduli->reurl.php'>$menumoduli->nome</a>";
           $smenu.="</li>";
            return $smenu;
                           
         }     
    }

}
