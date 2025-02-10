<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_rfq extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function nBando($nome_bando, $data_emissione, $data_scadenza, $descrizione, $file_name, $file_tmp, $firma, $revisione, $id = null) {


        if (!$this->db->Query("SELECT * FROM $this->tabella.bandi WHERE nome_azienda_app='MES' and year(data_emissione)=year(now()) ORDER BY numero_bando DESC"))
            ;
        $ban = $this->db->Row();
        if (empty($id) || $revisione != 0) {
            ++$ban->numero_bando;
        }
        $this->insBando($nome_bando, $data_emissione, $data_scadenza, $descrizione, $file_name, $file_tmp, $ban->numero_bando, $firma, $revisione, $id);
    }

    public function insBando($nome_bando, $data_emissione, $data_scadenza, $descrizione, $file_name, $file_tmp, $n_bando, $firma, $revisione, $id = null) {
        $file_dir = "rfq_documenti/";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }
        $rfq['numero_bando'] = MySQL::SQLValue($n_bando, MySQL::SQLVALUE_TEXT);
        $rfq['nome_bando'] = MySQL::SQLValue($nome_bando, MySQL::SQLVALUE_TEXT);
        $rfq['data_emissione'] = MySQL::SQLValue($data_emissione, MySQL::SQLVALUE_DATE);
        $rfq['data_scadenza'] = MySQL::SQLValue($data_scadenza, MySQL::SQLVALUE_DATE);
        $rfq['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $rfq['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        $rfq['n_revisione'] = MySQL::SQLValue($revisione, MySQL::SQLVALUE_TEXT);
        $rfq['firma'] = MySQL::SQLValue($firma, MySQL::SQLVALUE_TEXT);
        $rfq['stato'] = MySQL::SQLValue('Aperto', MySQL::SQLVALUE_TEXT);

        if (!empty($file_name)) {
            $rfq['link_file'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        }

        if (!empty($id) && $revisione == 0) {

            $rfqF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . ".bandi", $rfq, $rfqF))
                ;
        } else {

            if (!$this->db->InsertRow($this->tabella . ".bandi", $rfq))
                ;
        }

        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function delRfq($id) {
        $rfqD['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".bandi", $rfqD))
            ;
    }

    public function modUp($nome_bando, $data_emissione, $data_scadenza, $descrizione, $assegnazione, $assegnazione2, $assegnazione3, $valore, $valore2, $valore3, $oda, $oda2, $oda3, $firma, $revisione, $stato, $ragioneSociale, $id) {


        $rfqUP['nome_bando'] = MySQL::SQLValue($nome_bando, MySQL::SQLVALUE_TEXT);
        $rfqUP['data_emissione'] = MySQL::SQLValue($data_emissione, MySQL::SQLVALUE_DATE);
        $rfqUP['data_scadenza'] = MySQL::SQLValue($data_scadenza, MySQL::SQLVALUE_DATE);
        $rfqUP['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $rfqUP['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        $rfqUP['n_revisione'] = MySQL::SQLValue($revisione, MySQL::SQLVALUE_TEXT);
        $rfqUP['rag_soc_assegnatario'] = MySQL::SQLValue($ragioneSociale, MySQL::SQLVALUE_TEXT);
        $rfqUP['firma'] = MySQL::SQLValue($firma, MySQL::SQLVALUE_TEXT);
        $rfqUP['stato'] = MySQL::SQLValue($stato, MySQL::SQLVALUE_TEXT);
        $rfqUP['assegnazione'] = MySQL::SQLValue($assegnazione, MySQL::SQLVALUE_TEXT);
        $rfqUP['assegnazione2'] = MySQL::SQLValue($assegnazione2, MySQL::SQLVALUE_TEXT);
        $rfqUP['assegnazione3'] = MySQL::SQLValue($assegnazione3, MySQL::SQLVALUE_TEXT);
        $rfqUP['valore'] = MySQL::SQLValue($valore, MySQL::SQLVALUE_TEXT);
        $rfqUP['valore2'] = MySQL::SQLValue($valore2, MySQL::SQLVALUE_TEXT);
        $rfqUP['valore3'] = MySQL::SQLValue($valore3, MySQL::SQLVALUE_TEXT);
        $rfqUP['oda'] = MySQL::SQLValue($oda, MySQL::SQLVALUE_TEXT);
        $rfqUP['oda2'] = MySQL::SQLValue($oda2, MySQL::SQLVALUE_TEXT);
        $rfqUP['oda3'] = MySQL::SQLValue($oda3, MySQL::SQLVALUE_TEXT);

        $rfqfF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . ".bandi", $rfqUP, $rfqfF))
            ;
    }

    #estraggo la ragione sociale del fornitore

    public function insragSocFornitore($nome_bando, $data_emissione, $data_scadenza, $descrizione, $assegnazione, $assegnazione2, $assegnazione3, $valore, $valore2, $valore3, $oda, $oda2, $oda3, $firma, $revisione, $stato2, $id) {

        if (!$this->db->Query("SELECT * FROM $this->tabella.fornitori WHERE nome_azienda_app='MES' and idFornitori='{$assegnazione}'"))
            ;

        $assq = $this->db->Row();

        $this->modUp($nome_bando, $data_emissione, $data_scadenza, $descrizione, $assegnazione, $assegnazione2, $assegnazione3, $valore, $valore2, $valore3, $oda, $oda2, $oda3, $firma, $revisione, $stato2, $assq->ragioneSociale, $id);
    }

    #aggiungi aziende 

    public function aggInvitati($idFormitori, $numero_rfq) {
        $rfqAz['idFornitore'] = MySQL::SQLValue($idFormitori, MySQL::SQLVALUE_TEXT);
        $rfqAz['numero_rfq'] = MySQL::SQLValue($numero_rfq, MySQL::SQLVALUE_TEXT);
        $rfqAz['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        if (!$this->db->InsertRow($this->tabella . ".aziende_invitate", $rfqAz))
            ;
        $this->messaggio();
    }

    public function delAz($id) {
        $rfqDe['idAzIn'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".aziende_invitate", $rfqDe))
            ;
    }

    # inserimento protti

    public function aggProd($idProd, $idBando, $qnt, $dimensione, $note) {
        $rfqAz['idBando'] = MySQL::SQLValue($idBando, MySQL::SQLVALUE_TEXT);
        $rfqAz['idProd'] = MySQL::SQLValue($idProd, MySQL::SQLVALUE_TEXT);
        $rfqAz['qnt'] = MySQL::SQLValue($qnt, MySQL::SQLVALUE_TEXT);
        $rfqAz['dimensione'] = MySQL::SQLValue($dimensione, MySQL::SQLVALUE_TEXT);
        $rfqAz['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $rfqAz['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        if (!$this->db->InsertRow($this->tabella . ".prodotti_rfq_collegati", $rfqAz))
            ;
        $this->messaggio();
    }

    public function delAp($id) {
        $rfqDe['idProdC'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".prodotti_rfq_collegati", $rfqDe))
            ;
    }

    public function controlloAziende($idBando) {
        if (!$this->db->Query("SELECT email FROM $this->tabella.aziende_invitate inner join $this->tabella.fornitori as f on f.idFornitori=idFornitore WHERE numero_rfq='{$idBando}'"))
            ;

        while ($emal = $this->db->Row()) {
            $this->invioEmail($emal->email, $idBando);
        }
    }

    public function invioEmail2($email, $idBando) {
        $destinatario = $email;
        $oggetto = "Oggetto dell'email";
        // Intestazioni dell'email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <mittente@example.com>' . "\r\n";
        $messaggio = '
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

        $this->db->Query("SELECT * FROM $this->tabella.prodotti_rfq as r inner join $this->tabella.prodotti_rfq_collegati as p on r.idProd=p.idProd where idBando={$idBando} order by prodotto asc");
        while ($rfin = $this->db->Row()) {

            $userMessage .= "  <tr>
                <td >{$rfin->prodotto}</d>
                <td>{$rfin->qnt}</td>
                <td>{$rfin->dimensione}</td>
                <td>{$rfin->note}</td>
               
            </tr>";
        }
        $userMessage .= '</tbody>
</table>';
        $userMessage .= ' <p>In attesa di Vostro gentile riscontro,Saluti</p>
 <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="middle" class="bg_light footer email-section">
            <table>
            	<tr>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="text-align: left; padding-right: 10px;">
                      	<h3 class="heading">About</h3>
                      	<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                      </td>
                    </tr>
                  </table>
                </td>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                      	<h3 class="heading">Contact Info</h3>
                      	<ul>
					                <li><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
					                <li><span class="text">+2 392 3929 210</span></a></li>
					              </ul>
                      </td>
                    </tr>
                  </table>
                </td>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="text-align: left; padding-left: 10px;">
                      	<h3 class="heading">Useful Links</h3>
                      	<ul>
					                <li><a href="#">Home</a></li>
					                <li><a href="#">About</a></li>
					                <li><a href="#">Services</a></li>
					                <li><a href="#">Work</a></li>
					              </ul>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end: tr -->
        <tr>
          <td class="bg_light" style="text-align: center;">
          	<p>No longer want to receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
          </td>
        </tr>
      </table>
</body>
</html>
';

        // Invia l'email
        if (mail($destinatario, $oggetto, $messaggio, $headers)) {
            echo "Email con footer inviata con successo";
        } else {
            echo "Errore nell'invio dell'email";
        }
    }

    public function invioEmail($email, $idBando) {

        $adminEmail = 'info@acecrm.it';
        $userEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
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

        $this->db->Query("SELECT * FROM $this->tabella.prodotti_rfq as r inner join $this->tabella.prodotti_rfq_collegati as p on r.idProd=p.idProd where idBando={$idBando} order by prodotto asc");
        while ($rfin = $this->db->Row()) {

            $userMessage .= "  <tr>
                <td >{$rfin->prodotto}</d>
                <td>{$rfin->qnt}</td>
                <td>{$rfin->dimensione}</td>
                <td>{$rfin->note}</td>
               
            </tr>";
        }
        $userMessage .= '</tbody>
</table>';
        $userMessage .= ' <p>In attesa di Vostro gentile riscontro,Saluti</p>

</body>
</html>
';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        mail($userEmail, 'Richiesta di preventivo', $userMessage, implode("\r\n", $headers));
       
        mail($adminEmail, 'Richiesta di preventivo', $userMessage, implode("\r\n", $headers));
        $this->messaggio();
       // header("location:gestione-rfq.php");
    }

}
