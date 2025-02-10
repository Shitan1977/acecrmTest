<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_supporto extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function inserSupporto($oggetto, $corpo, $tipologia, $username, $idAzienda, $email) {
        $supporto['titolo'] = MySQL::SQLValue($oggetto, MySQL::SQLVALUE_TEXT);
        $supporto['stato'] = MySQL::SQLValue('Aperto', MySQL::SQLVALUE_TEXT);
        $supporto['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $supporto['tipologia'] = MySQL::SQLValue($tipologia, MySQL::SQLVALUE_TEXT);
        $supporto['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow('admin_acecrm.supporto', $supporto))
            echo $this->db->Kill();
        $this->insSett($corpo, $username, $oggetto,$email);
    }

    public function insSett($corpo, $username, $oggetto,$email) {
        $this->db->Query("SELECT *  from admin_acecrm.supporto order by idSupporto Desc Limit 1");
        $supporto = $this->db->Row();

        $this->insDetta($corpo, $username, $oggetto, $supporto->idSupporto,$email);
    }

    public function insDetta($corpo, $username, $oggetto, $idSupporto,$email, $stato = null) {
        $dettSupp['idSupporto'] = MySQL::SQLValue($idSupporto, MySQL::SQLVALUE_TEXT);
        $dettSupp['corpo'] = MySQL::SQLValue($corpo, MySQL::SQLVALUE_TEXT);
        $dettSupp['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_TEXT);
        $dettSupp['operatore'] = MySQL::SQLValue($username, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow('admin_acecrm.suppDett', $dettSupp))
            echo $this->db->Kill();
        if (!empty($stato)) {
            $this->updateSupp($idSupporto, $stato,$email);
        }
        $this->invioEmail($corpo, $username, $oggetto, $email, $stato = null);
    }

    public function updateSupp($idSupporto, $stato,$email) {
        $supporto['stato'] = MySQL::SQLValue($stato, MySQL::SQLVALUE_TEXT);
        $supportoF['idSupporto'] = MySQL::SQLValue($idSupporto, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows('admin_acecrm.supporto', $supporto, $supportoF))
            echo $this->db->Kill();
    }

    public function invioEmail($corpo, $username, $oggetto,$email) {

        $adminEmail = 'info@freestyleweb.it';
        $userEmail = $username;
        $userMessage = '
  <html>
    <head>
      <title>Richiesta Supporto Tecnico</title>
    </head>
    <body>
      <h1>Grazie per averci contattato</h1>
      <p>La tua richiesta è stata inoltrata. Ti risponderemo al più presto.</p>
      <ul>
        <li>Nome: {$username}</li>
        <li>Oggetto: {$oggetto}</li>
        <li>Messaggio: {$corpo}</li>
      </ul>
      <p>Lo Staff</p>
    </body>
  </html>
';
        $adminMessage = "
  <html>
    <head>
      <title>Richiesta di Assistenza</title>
    </head>
    <body>
      <h1>Assistenza Tecnica</h1>
      <ul>
        <li>Nome: {$username}</li>
        <li>Oggetto: {$oggetto}</li>
        <li>Messaggio: {$corpo}</li>
      </ul>
    </body>
  </html>
";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = "From: info@acecrm.it";
        mail($userEmail, 'Richiesta di contatto effettuata con successo', $userMessage, implode("\r\n", $headers));
        mail($adminEmail, 'Richiesta di contatto dal sito web', $adminMessage, implode("\r\n", $headers));
     //   echo "Messaggio inviato con successo";

        $this->messaggio();
    }

    // abbreviare o anteprima  testo
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

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

# risposta
}
