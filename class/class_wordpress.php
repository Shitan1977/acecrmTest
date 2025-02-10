<?php

ini_set('error_reporting', E_ALL);
ini_set("display_errors", "1");
error_reporting(1);
include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_wordpress extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public $servername = "195.231.24.132";
    public $username = "wp_paola";
    public $password = "!Demetrio1977Adele";
    public $dbname = "admin_paola";

//        public $servername = "89.46.111.139";
//    public $username = "Sql1683530";
//    public $password = "Europaservice22@";
//    public $dbname = "Sql1683530_1";
    
    public function pubblica() {

        $this->db->Query("SELECT *, c.idProdotto as idProc , d.prezzo as price from $this->tabella.carrello_online as c inner join $this->tabella.prodotto as p on p.idProdotto=c.idProdotto left join $this->tabella.listini as l on l.idProdotto=p.idProdotto left join $this->tabella.categorie as ca on ca.idCategorie=p.idCategorie left join $this->tabella.marche as m on p.idMarca=m.idMarca left join $this->tabella.dettList as d on d.idProdotto=p.idProdotto");
        while ($pub = $this->db->Row()) {

            $this->InserimentoWordpress($pub->prodotto, $pub->barcode, $pub->marca, $pub->categoria, $pub->price, $pub->descrizione, $pub->qyt, $pub->idProc);
        }
    }

    public function pubblicaT() {


        $this->db->Query("SELECT p.*, p.idProdotto as idProc , d.prezzo as price from  $this->tabella.prodotto as p  left join $this->tabella.listini as l on l.idProdotto=p.idProdotto left join $this->tabella.categorie as ca on ca.idCategorie=p.idCategorie left join $this->tabella.marche as m on p.idMarca=m.idMarca left join $this->tabella.dettList as d on d.idProdotto=p.idProdotto");
        while ($pub = $this->db->Row()) {

            //   $this->InserimentoWordpress($pub->prodotto, $pub->barcode, $pub->marca, $pub->categoria, $pub->price, $pub->descrizione, $pub->qyt, $pub->idProc);
        }
    }

    public function InserimentoWordpress($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto) {

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $data = date('Y-m-d h:s:i');
        $guid = str_replace(' ', '-', $titolo);
        $minuscolo = strtolower($guid);

        $sql = "INSERT INTO paola_posts (post_author, post_date, post_date_gmt,post_content,post_title,post_status,comment_status,ping_status,post_name,post_modified,post_modified_gmt,post_parent,post_type,post_excerpt,to_ping,pinged,post_content_filtered,guid) VALUES ('1', '$data', '$data','$descrizione','$titolo','publish','open','closed','$minuscolo','$data','$data','0','product','$descrizione','','','','https://egyptdreamhouse.com/paola2/$minuscolo/')";

        if ($conn->query($sql) === TRUE) {
//              echo "New record created successfully";      } else {
//            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
        $this->trovaId($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto);
    }

    public function trovaId($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        $sql = "SELECT ID FROM paola_posts where post_title='$titolo' order by ID DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
           
            while ($row = $result->fetch_assoc()) {
                $this->inserimentiAtt($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $row["ID"]);
            }
        }
    }

    public function inserimentiAtt($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO paola_postmeta (post_id,meta_key,meta_value)
VALUES ($product_id,'_sku','$barcode')";
        $conn->query($sql);
           
        $this->inserimentiMag($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id);
    }

    public function inserimentiMag($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO paola_postmeta (post_id,meta_key,meta_value)
VALUES ($product_id,'_manage_stock','Yes')";
        $conn->query($sql);
        $this->inserimentiQua($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id);
    }

    public function inserimentiQua($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO paola_postmeta (post_id,meta_key,meta_value)
VALUES ($product_id,'_stock','$qyt')";
        $conn->query($sql);
        $this->inserimentiPrezzo($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id);
    }

    public function inserimentiPrezzo($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO paola_postmeta (post_id,meta_key,meta_value)
VALUES ($product_id,'_price','$prezzo')";
        $conn->query($sql);
        $this->inserimentiPrezReg($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id);
    }

    public function inserimentiPrezReg($titolo, $barcode, $marca, $categoria, $prezzo, $descrizione, $qyt, $prodotto, $product_id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO paola_postmeta (post_id,meta_key,meta_value)
VALUES ($product_id,'_regular_price','$prezzo')";
        $conn->query($sql);
        $this->aggProdotti($prodotto);
    }

    public function aggProdotti($prodotto) {
        //connessione a prestashop e aggiornamento del database

        $prodot['web'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $prodotF['idProdotto'] = MySQL::SQLValue($prodotto, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . ".prodotto", $prodot, $prodotF))
            ;

        $this->eliminaprodotti($prodotto);
    }

    public function eliminaprodotti($idProdotto) {
        $prodotD['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
       
        if (!$this->db->DeleteRows($this->tabella . ".carrello_online", $prodotD))
            ;

        //$this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

}
