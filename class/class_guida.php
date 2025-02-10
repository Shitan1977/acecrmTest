<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_guida extends MySQL {

    private $tabella;
    public $db;
    public $translations;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();

        // Costruisce il percorso completo al file di traduzione e lo carica
        $translationsPath = $_SERVER["DOCUMENT_ROOT"] . '/languages/' . ($_SESSION['selectedLanguage'] ?? 'it') . '.php';
        if (file_exists($translationsPath)) {
            $this->translations = require $translationsPath;
        } else {
            die("Il file di traduzione non esiste: $translationsPath");
        }
    }

    public function inseGuida() {
        // Directory di destinazione per i file caricati
        $targetDir = "guide/";

        // Gestione caricamento file PDF
        if (!empty($_FILES['pdf']['name'])) {
            $pdfName = basename($_FILES['pdf']['name']);
            $pdfTargetPath = $targetDir . $pdfName;
            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfTargetPath)) {
                $insGuida['pdf'] = MySQL::SQLValue($pdfName, MySQL::SQLVALUE_TEXT);
            } else {
                $insGuida['pdf'] = MySQL::SQLValue('', MySQL::SQLVALUE_TEXT);
            }
        } else {
            $insGuida['pdf'] = MySQL::SQLValue('', MySQL::SQLVALUE_TEXT);
        }

        // Gestione caricamento file Guida
        if (!empty($_FILES['guida']['name'])) {
            $guidaName = basename($_FILES['guida']['name']);
            $guidaTargetPath = $targetDir . $guidaName;
            if (move_uploaded_file($_FILES['guida']['tmp_name'], $guidaTargetPath)) {
                $insGuida['guida'] = MySQL::SQLValue($guidaName, MySQL::SQLVALUE_TEXT);
            } else {
                $insGuida['guida'] = MySQL::SQLValue('', MySQL::SQLVALUE_TEXT);
            }
        } else {
            $insGuida['guida'] = MySQL::SQLValue('', MySQL::SQLVALUE_TEXT);
        }

        // Altri dati
        $insGuida['tipo'] = MySQL::SQLValue($_POST['tipo'], MySQL::SQLVALUE_TEXT);
        $insGuida['idModulo'] = MySQL::SQLValue($_POST['idModulo'], MySQL::SQLVALUE_TEXT);
        $insGuida['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        // Verifica se è un aggiornamento o un nuovo inserimento
        if (isset($_POST['idGuida'])) {

            $insGuidafiltro['idGuida'] = MySQL::SQLValue($_POST['idGuida'], MySQL::SQLVALUE_TEXT);

            if (isset($_POST['cancella'])) {
                // Cancellazione della guida esistente

                if (!$this->db->DeleteRows('admin_acecrm.guide', $insGuidafiltro)) {
                    echo $this->db->Kill();
                }
            } else {
                // Aggiornamento della guida esistente
                if (!$this->db->UpdateRows('admin_acecrm.guide', $insGuida, $insGuidafiltro)) {
                    echo $this->db->Kill();
                }
            }
        } else {

            // Inserimento di una nuova guida
            if (!$this->db->InsertRow('admin_acecrm.guide', $insGuida)) {
                echo $this->db->Kill();
            }
        }
        $this->titolo();
    }

    public function titolo() {
        // Sanitizzazione dell'input
        $idModulo = MySQL::SQLValue($_POST['idModulo'], MySQL::SQLVALUE_TEXT);

        // Esegui la query per ottenere i dati del modulo
        $this->db->Query("SELECT * FROM admin_acecrm.guide inner join admin_acecrm.moduli on moduli.idModuli=guide.idModulo WHERE idModulo = $idModulo");
         
        if ($this->db->HasRecords()) {
			
			
            $modulo = $this->db->Row();

            // Verifica se il record esiste già
            $collegamento = MySQL::SQLValue($modulo->reurl, MySQL::SQLVALUE_TEXT);
            $this->db->Query("SELECT * FROM admin_acecrm.guide WHERE idModulo = $idModulo");
			
            if ($this->db->HasRecords()) {
				
                $existingRecord = $this->db->Row();	
			
            } else {
		
                $existingRecord = null;
            }
             
            // Se il record non esiste, procedi con l'inserimento
            if ($existingRecord) {	
			
                $insTitolo['titolo'] = MySQL::SQLValue('Visualizza Guida', MySQL::SQLVALUE_TEXT);
				$collegamento = trim($collegamento, "'"); // Rimuove apici singoli solo se sono all'inizio o alla fine

				$composto = 'gg' . $collegamento;
				$insTitolo['collegamento']= $composto;
               

				$insTitolo['titolo'] = MySQL::SQLValue('Visualizza Guida', MySQL::SQLVALUE_TEXT);
				$insTitolo['collegamento'] = MySQL::SQLValue($composto, MySQL::SQLVALUE_TEXT);
				$insTitolo['page'] = MySQL::SQLValue($collegamento, MySQL::SQLVALUE_TEXT);

		      #var_dump($insTitolo); // Verifica il tipo e il valore di $collegamento
				
              
                if (!$this->db->InsertRow('admin_acecrm.titoli', $insTitolo)) {
                    echo $this->db->Kill("errore di dati");
                }
            }
        } else {
           // echo "Modulo non trovato per idModuli: $idModulo";
        }

        $this->messaggio();
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

    public function messaggioBello($prova, $pagina, $dett, $idMisure, $formId, $currentTabId = null) {
        // ... il tuo codice PHP ...
        $updateSuccess = $prova; // o false a seconda del risultato
        echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include la libreria
        if ($updateSuccess) {
            echo "<script>
Swal.fire({
    title: 'Successo!',
    text: 'Dati aggiornati con successo.',
    icon: 'success',
    confirmButtonText: 'OK'
}).then((result) => {
    if (result.value) {
        // Crea un form temporaneo per inviare i dati via POST
        var form = $('<form id=\"" . $formId . "\" action=\"" . $pagina . "\" method=\"post\">' +
            '<input type=\"hidden\" name=\"dett\" value=\"" . $dett . "\">' +
            '<input type=\"hidden\" name=\"idMisure\" value=\"" . $idMisure . "\">' +
                '<input type=\"hidden\" name=\"current_tab_id\" value=\"" . $currentTabId . "\">' +
            '</form>');
        
        // Aggiungi il form al body e invialo
        $('body').append(form);
        form.submit();
    }
});
</script>";
        }
    }

 public function getGuideData($page) {
        $query = "SELECT * FROM admin_acecrm.guide 
                  INNER JOIN admin_acecrm.moduli 
                  ON moduli.idModuli = guide.idModulo 
                  WHERE reurl = '{$page}'";
      
        $this->db->Query($query);
        $results = [];
        
        while ($row = $this->db->RowArray()) {
            $results[] = $row;
        }

        if (count($results) > 0) {
            return $results;
        } else {
            return null;
        }
    }
}
