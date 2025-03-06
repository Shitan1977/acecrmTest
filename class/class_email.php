<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_email extends MySQL {

    private $tabella;
    public $db;
    public $db2;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
        $this->db2 = new MySQL();
    }

    #metodo notifica operatori

    public function notificaOperatori() {


        if (!$this->db->Query("SELECT email FROM $this->tabella.notifiche_personale inner join $this->tabella.amministratore as a on a.idAmministratore=idFornitore WHERE idOfferte='{$_POST['id_master']}'"))
            ;

        while ($emal = $this->db->Row()) {



            $this->sendEmail($emal->email, "Nuova Offerta", "Alla vostra cortese attenzione, una nuova offerta richiede la vostra attenzione sul gestionale");
        }
    }

    public function sendEmail($to, $subject, $message, $attachment = null) {

        // Mittente e intestazioni dell'email
        $from = "info@acecrm.it";
        $headers = array();
        $headers[] = 'From: ' . $from;
        $headers[] = 'Reply-To: ' . $from;
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';

        // Verifica se un allegato è stato fornito
        if ($attachment !== null && file_exists($attachment)) {
            // Leggi il file dell'allegato
            $attachment_content = file_get_contents($attachment);
            $attachment_name = basename($attachment);

            // Crea il separatore per l'allegato
            $boundary = md5(uniqid());

            // Intestazioni per l'allegato
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

            // Corpo dell'email
            $message = "--$boundary\r\n";
            $message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
            $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $message .= $message . "\r\n";

            // Allegato
            $message .= "--$boundary\r\n";
            $message .= "Content-Type: application/octet-stream; name=\"$attachment_name\"\r\n";
            $message .= "Content-Disposition: attachment; filename=\"$attachment_name\"\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $message .= chunk_split(base64_encode($attachment_content)) . "\r\n";
            $message .= "--$boundary--";
        }


        if (mail($to, $subject, $message, implode("\r\n", $headers))) {
            //    $this->messaggio();
        } else {

            echo "Errore nell'invio dell'email.";
        }
    }

    public function notificaRisorseAssegnate() {


        if (!$this->db->Query("SELECT email FROM $this->tabella.assegnazioneRisorse as ass inner join $this->tabella.amministratore as a on a.idAmministratore=ass.idAmministratore WHERE idMaster='{$_POST['invioEmailAssegnati']}'"))
            ;

        while ($emal = $this->db->Row()) {


            $this->sendEmail($emal->email, "Alla Cortese Attenzione dello staff", "Ti chiediamo di visionare l'offerta n {$_POST['nOfferta']} e di scaricare il pdf allegato per una corretta visione dell'offerta creata {$_SESSION['cognome']}");
        }
    }

    public function messaggio() {
        echo "<script>
    Swal.fire({
        title: 'Successo!',
        text: 'Aggiornamento riuscito con successo.',
        icon: 'success',
        confirmButtonText: 'Ok'
    });
    </script>";
    }

    #invio email rfq

    public function controlloAziende($idBando) {
      
        $query = "SELECT email FROM $this->tabella.aziende_invitate inner join $this->tabella.fornitori as f on f.idFornitori=idFornitore WHERE numero_rfq='{$idBando}'";
        if (!$this->db->Query($query)) {
            // Gestisci l'errore qui, ad esempio:
            echo "Errore nell'esecuzione della query.";
            return;
        }

        while ($email = $this->db->Row()) {
            $this->notificaRFQ($email->email, $idBando);
        }
    }

    public function notificaRFQ($email, $idBando) {

        $userMessage = '
  <html>
    <head>
      <title>Richiesta di Preventivo</title>
    </head>
    <body>
      <h1>Salve</h1>
      <p>Si richiede vs migliore offerta e tempi di consegna per quanto sotto riportato</p>
        <table width="80%" style="border-style: solid; border-width: 2px; padding:8px;text-align:left">
                        <thead>
                            <tr>
                                 <th>Prodotto</th>
                                <th>Quantità </th>
                                <th>Dimensioni </th>
                                <th>Note </th>
                            </tr>
                        </thead>
                        <tbody>';

        $this->db2->Query("SELECT * FROM $this->tabella.prodotti_rfq as r inner join $this->tabella.prodotti_rfq_collegati as p on r.idProd=p.idProd where idBando={$idBando} order by prodotto asc");
        if ($this->db2->RowCount() > 0) {
            while ($rfin = $this->db2->Row()) {

                $userMessage .= "  <tr>
                <td >{$rfin->prodotto}</d>
                <td>{$rfin->qnt}</td>
                <td>{$rfin->dimensione}</td>
                <td>{$rfin->note}</td>
            </tr>";
            }
        }
        $userMessage .= '</tbody>
</table>';
        $userMessage .= "<p>In attesa di Vostro gentile riscontro,Saluti <br>{$_SESSION['email']}</p>

</body>
</html>
";

        $this->sendEmail($email, "Richiesta di Preventivo", $userMessage);
    }
}

?>