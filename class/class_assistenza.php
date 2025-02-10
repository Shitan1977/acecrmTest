<?php

require_once 'libreria/mysql_class.php';

class class_assistenza extends MySQL {

    private $tabella;
    public $contatoreAssistenza;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db=new MySQL();
    }

    public function contatore() {

        $this->db->Query("SELECT COUNT(idAzienda) AS assistenzacontatore from admin_acecrm.ibox WHERE  idAzienda={$_SESSION['idAzienda']} ORDER BY idibox DESC");
        $assistenzacount = $this->db->Row();
        $this->contatoreAssistenza = $assistenzacount->assistenzacontatore;
    }

    #Anteprima assistenza

    public function anteprima($testo, $lunghezza, $puntini) {
        $ellipses = $puntini;
        // eliminazione tag
        $testo = strip_tags($testo);
        // se il testo è già più corto della lunghezza massima viene restituito pulito dai tag
        if (strlen($testo) <= $lunghezza) {
            return $testo;
        }
        // cerca l'ultimo spazio per non restituire parole tagliate
        $ultimo_spazio = strrpos(substr($testo, 0, $lunghezza), ' ');
        $ant = substr($testo, 0, $ultimo_spazio);
        // aggiunge i ... ad indicare che segue
        if ($ellipses) {
            $ant .= '...';
        }
        // restituisce l'anteprima pulita dai tag e del numero di caratteri massimo
        return $ant;
    }

}
