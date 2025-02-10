<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_booking extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function aggAppartamento($titolo, $descrizione, $idCategoria, $idCliente, $idProvince, $idComuni, $idRegione, $indirizzo, $stato, $Nsquare, $idAppartamento = null) {
        $aggA['titolo'] = MySQL::SQLValue($titolo, MySQL::SQLVALUE_TEXT);
        $aggA['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $aggA['idCategoria'] = MySQL::SQLValue($idCategoria, MySQL::SQLVALUE_TEXT);
        $aggA['idFornitore'] = MySQL::SQLValue($idCliente, MySQL::SQLVALUE_TEXT);
        $aggA['idProvince'] = MySQL::SQLValue($idProvince, MySQL::SQLVALUE_TEXT);
        $aggA['idComuni'] = MySQL::SQLValue($idComuni, MySQL::SQLVALUE_TEXT);
        $aggA['idRegione'] = MySQL::SQLValue($idRegione, MySQL::SQLVALUE_TEXT);
        $aggA['indirizzo'] = MySQL::SQLValue($indirizzo, MySQL::SQLVALUE_TEXT);
        $aggA['stato'] = MySQL::SQLValue($stato, MySQL::SQLVALUE_TEXT);
        $aggA['Nsquare'] = MySQL::SQLValue($Nsquare, MySQL::SQLVALUE_TEXT);
        $aggAU['idAppartamento'] = MySQL::SQLValue($idAppartamento, MySQL::SQLVALUE_TEXT);
        if (!empty($idAppartamento)) {
            if (!$this->db->UpdateRows($this->tabella . '.appartamentoNew', $aggA, $aggAU))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.appartamentoNew', $aggA))
                echo $this->db->Kill();
        }
    }

    public function delBook($idAPP) {
        $delAU['idApp'] = MySQL::SQLValue($idAPP, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.appartamentoNew', $delAU)) {
            echo $this->db->Kill();
        }
    }

    # AGGIUNGI DEETTAGLI DELLA STANZA

    public function insDett($idAppartamento, $proprieta, $prezzo, $mq, $AnnoCostruzione, $tipoProprieta, $StatoProprieta, $NGarage, $nStanze, $nBagni, $DimensioneGarage, $idDettIm = null) {
        $indDettU['idDettIm'] = MySQL::SQLValue($idDettIm, MySQL::SQLVALUE_TEXT);
        $indDett['idAppartamento'] = MySQL::SQLValue($idAppartamento, MySQL::SQLVALUE_TEXT);
        $indDett['proprieta'] = MySQL::SQLValue($proprieta, MySQL::SQLVALUE_TEXT);
        $indDett['prezzo'] = MySQL::SQLValue($prezzo, MySQL::SQLVALUE_TEXT);
        $indDett['mq'] = MySQL::SQLValue($mq, MySQL::SQLVALUE_TEXT);
        $indDett['AnnoCostruzione'] = MySQL::SQLValue($AnnoCostruzione, MySQL::SQLVALUE_TEXT);
        $indDett['tipoProprieta'] = MySQL::SQLValue($tipoProprieta, MySQL::SQLVALUE_TEXT);
        $indDett['StatoProprieta'] = MySQL::SQLValue($StatoProprieta, MySQL::SQLVALUE_TEXT);
        $indDett['NGarage'] = MySQL::SQLValue($NGarage, MySQL::SQLVALUE_TEXT);
        $indDett['nStanze'] = MySQL::SQLValue($nStanze, MySQL::SQLVALUE_TEXT);
        $indDett['nBagni'] = MySQL::SQLValue($nBagni, MySQL::SQLVALUE_TEXT);
        $indDett['DimensioneGarage'] = MySQL::SQLValue($DimensioneGarage, MySQL::SQLVALUE_TEXT);

        if (!empty($idDettIm)) {
            if (!$this->db->UpdateRows($this->tabella . '.dettaglio_immobile', $indDett, $indDettU)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.dettaglio_immobile', $indDett)) {
                echo $this->db->Kill();
            }
        }
    }

    public function delBookD($idAPP) {
        $delAU['idDettIm'] = MySQL::SQLValue($idAPP, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.dettaglio_immobile', $delAU)) {
            echo $this->db->Kill();
        }
    }

    #inserimento servizi

    public function insServizi($servizi, $idAppartamento, $idSA = null) {
        $indServ['servizi'] = MySQL::SQLValue($servizi, MySQL::SQLVALUE_TEXT);
        $indServ['idAppartamento'] = MySQL::SQLValue($idAppartamento, MySQL::SQLVALUE_TEXT);
        $indServ['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $indServA['idSerBook'] = MySQL::SQLValue($idSA, MySQL::SQLVALUE_TEXT);

        if (!empty($idSA)) {

            if (!$this->db->UpdateRows($this->tabella . '.serviziBooking', $indServ, $indServA)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.serviziBooking', $indServ)) {
                echo $this->db->Kill();
            }
        }
    }

    public function delServ($idSerBook) {
        $delAU['idSerBook'] = MySQL::SQLValue($idSerBook, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.serviziBooking', $delAU)) {
            echo $this->db->Kill();
        }
    }

    # inserimento delle dimensione ROOM

    public function insRoom($room, $dimensione, $idAppartamento, $idDR = null) {
        $indServ['room'] = MySQL::SQLValue($room, MySQL::SQLVALUE_TEXT);
        $indServ['dimensione'] = MySQL::SQLValue($dimensione, MySQL::SQLVALUE_TEXT);
        $indServ['idApp'] = MySQL::SQLValue($idAppartamento, MySQL::SQLVALUE_TEXT);
        $indServ['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $indServA['idDR'] = MySQL::SQLValue($idDR, MySQL::SQLVALUE_TEXT);

        if (!empty($idDR)) {

            if (!$this->db->UpdateRows($this->tabella . '.dimensioneRoom', $indServ, $indServA)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.dimensioneRoom', $indServ)) {
                echo $this->db->Kill();
            }
        }
    }

    public function delRoom($idDR) {
        $delAU['idDR'] = MySQL::SQLValue($idDR, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.dimensioneRoom', $delAU)) {
            echo $this->db->Kill();
        }
    }

    # proprietà

    public function insPro($file_name, $file_tmp, $file_name2, $file_tmp2, $idApp, $idAzienda, $mappa, $idPr = NULL) {

        $file_dir = "booking_documenti/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }

        $cat['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $cat['idApp'] = MySQL::SQLValue($idApp, MySQL::SQLVALUE_TEXT);
        $cat['mappa'] = MySQL::SQLValue($mappa, MySQL::SQLVALUE_TEXT);
        $cat['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!empty($file_name)) {
            $cat['documenti'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        }
        if (!empty($file_name)) {
            $cat['documentiDue'] = MySQL::SQLValue($file_name2, MySQL::SQLVALUE_TEXT);
        }



        if (!empty($idPr)) {

            $catF['idPr'] = MySQL::SQLValue($idPr, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . ".proprietaBooking", $cat, $catF))
                ;
        } else {

            if (!$this->db->InsertRow($this->tabella . ".proprietaBooking", $cat))
                ;
        }
        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }

        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name2; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp2, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function cancellaPro($delpro) {
        $delca['idPr'] = MySQL::SQLValue($delpro, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".proprietaBooking", $delca))
            ;
    }

#IMMAGINI 

    public function insImg($file_name, $file_tmp, $idApp, $idAzienda) {

        $file_dir = "booking_image/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }

        $cat['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $cat['idApp'] = MySQL::SQLValue($idApp, MySQL::SQLVALUE_TEXT);

        $cat['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!empty($file_name)) {
            $cat['image'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        }

        if (!$this->db->InsertRow($this->tabella . ".galleriaBooking", $cat))
            ;

        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }

        $this->messaggio();
    }

    public function cancellaImg($delImg) {
        $delca['idGal'] = MySQL::SQLValue($delImg, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".galleriaBooking", $delca))
            ;
    }

    # proprietà

    public function insPiano($file_name, $file_tmp, $idApp, $idAzienda, $size, $piano, $rooms, $bathss, $idFloor = NULL) {

        $file_dir = "booking_floor/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }

        $catt['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $catt['idApp'] = MySQL::SQLValue($idApp, MySQL::SQLVALUE_TEXT);
        $catt['piano'] = MySQL::SQLValue($piano, MySQL::SQLVALUE_TEXT);
        $catt['baths'] = MySQL::SQLValue($bathss, MySQL::SQLVALUE_TEXT);
        $catt['size'] = MySQL::SQLValue($size, MySQL::SQLVALUE_TEXT);
        $catt['rooms'] = MySQL::SQLValue($rooms, MySQL::SQLVALUE_TEXT);
        $catt['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!empty($file_name)) {
            $catt['mappa'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        }



        if (!empty($idFloor)) {

            $catF['idFloor'] = MySQL::SQLValue($idFloor, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . ".floorPlans", $catt, $catF))
                ;
        } else {

            if (!$this->db->InsertRow($this->tabella . ".floorPlans", $catt))
                ;
        }
        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }



        $this->messaggio();
    }

    public function cancellaPiano($delpiano) {
        $delca['idFloor'] = MySQL::SQLValue($delpiano, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".floorPlans", $delca))
            ;
    }

}

?>
