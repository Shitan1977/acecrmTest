<?php

session_start();
ob_start();
include_once 'libreria/mysql_class.php';

class login_class extends MySQL {

    private $nome_database;

    public function accesso($username, $password, $azienda) {
// cifro la password
        $pass = @md5($password);
        $user = $username;

        $this->nome_database = "test_" . $azienda;
#data odierna
        $dataordine = date('Y-m-d');

        if ($this->Query("select amministratore.idAmministratore,amministratore.cognome, amministratore.idAzienda as Azienda,amministratore.livello,amministratore.username,amministratore.email,amministratore.pws,amministratore.idRuolo,abbonamento.idAzienda,abbonamento.scadenza, a.logo FROM test_acecrm.abbonamento INNER JOIN  {$this->nome_database}.amministratore ON amministratore.idAzienda = abbonamento.idAzienda INNER JOIN test_acecrm.azienda as a ON a.idAzienda=amministratore.idAzienda  WHERE scadenza > '{$dataordine}' AND username='{$azienda}' AND pws='{$pass}' AND email='{$user}'"))
            ;

        if ($this->RowCount() > 0) {
            $login = $this->Row();

            $_SESSION['time'] = time();
            $_SESSION['username'] = $login->username;
            $_SESSION['livello'] = $login->livello;
            $_SESSION['idAzienda'] = $login->Azienda;
            $_SESSION['cognome'] = $login->cognome;
            $_SESSION['logo'] = $login->logo;
            $_SESSION['idRuolo'] = $login->idRuolo;
            $_SESSION['idAmministratore'] = $login->idAmministratore;
            $_SESSION['mails'] = $login->email;
            $_SESSION['login'] = true;
            $_SESSION['tabella'] = 'test_' . $login->username;
            @header("location:content.php");
        } else {

            if ($this->Query("select * FROM  {$this->nome_database}.alberghi  WHERE username='{$azienda}' AND pws='{$pass}' AND email='{$user}'"))
                ;
            if ($this->RowCount() > 0) {
                $login = $this->Row();
                $_SESSION['time'] = time();
                $_SESSION['username'] = $login->username;
                $_SESSION['livello'] = 2;
                $_SESSION['idAl'] = $login->idAl;
                $_SESSION['idAzienda'] = $login->idAzienda;
                $_SESSION['email'] = $login->email;
                $_SESSION['login'] = true;
                $_SESSION['tabella'] = 'test_' . $login->username;
                @header("location:struttura.php");
            } else {
                // @header("location:errore.php");

                if ($this->Query("select * FROM  {$this->nome_database}.anagrafica  WHERE username='{$azienda}' AND pws='{$pass}' AND email='{$user}'"))
                    ;
                if ($this->RowCount() > 0) {
                    $login = $this->Row();
                    $_SESSION['time'] = time();
                    $_SESSION['username'] = $login->username;
                    $_SESSION['livello'] = 3;
                    $_SESSION['idAl'] = $login->idAnagrafica;
                    $_SESSION['idAzienda'] = $login->idAzienda;
                    $_SESSION['email'] = $login->email;
                    $_SESSION['login'] = true;
                    $_SESSION['tabella'] = 'test_' . $login->username;
                    @header("location:cliente.php");
                } else {

                    if ($this->Query("select * FROM  {$this->nome_database}.fornitori  WHERE username='{$azienda}' AND pws='{$pass}' AND email='{$user}'"))
                        ;
                    if ($this->RowCount() > 0) {
                        $login = $this->Row();
                        $_SESSION['time'] = time();
                        $_SESSION['username'] = $login->username;
                        $_SESSION['livello'] = 4;
                        $_SESSION['idAl'] = $login->idAnagrafica;
                        $_SESSION['idAzienda'] = $login->idAzienda;
                        $_SESSION['email'] = $login->email;
                        $_SESSION['login'] = true;
                        $_SESSION['tabella'] = 'test_' . $login->username;
                        @header("location:fornitore.php");
                    } else {
                        @header("location:errore.php");
                    }
                }
            }
        }
    }

    public function ritrovaPassword($azienda, $email) {


        if ($this->Query("select amministratore.idAmministratore, amministratore.idAzienda as Azienda,amministratore.livello,amministratore.username,amministratore.email,amministratore.pws,amministratore.idRuolo,abbonamento.idAzienda,abbonamento.scadenza, a.logo FROM test_acecrm.abbonamento INNER JOIN  {$nome_database}.amministratore ON amministratore.idAzienda = abbonamento.idAzienda INNER JOIN test_acecrm.azienda as a ON a.idAzienda=amministratore.idAzienda  WHERE scadenza > '{$dataordine}' AND username='{$azienda}' AND email='{$email}'"))
            ;

        if ($this->RowCount() > 0) {

            $this->generatoreCodice($email, $azienda);
        } else {

            $this->messaggioError();
        }
    }

    public function messaggioError() {
        echo "<script>alert('Non sei un utente registrato')</script>";
    }

    public function generatoreCodice($email, $azienda) {
        $caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringaRandom = '';
        for ($i = 0;
                $i < 8;
                $i++) {
            $stringaRandom .= $caratteri[rand(0, strlen($caratteri) - 1)];
        }
        return $stringaRandom;
        $this->invioEmail($email, $stringaRandom);
    }

    public function invioEmail($email, $pass) {

        $adminEmail = 'info@acecrm.it';
        $userEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        $userMessage = "
  <html>
    <head>
      <title>Benvenuto </title>
    </head>
    <body>
      <h1>Gentile Operatore, di seguito le credenziali per accedere al portale</h1>
      <p>username : $email e Password: $pass</p>
      <p>Lo Staff</p>
    </body>
  </html>
";

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        mail($userEmail, 'Richiesta di credenziali', $userMessage, implode("\r\n", $headers));
//  echo "Messaggio inviato con successo";
        @header("location:index.php");
    }
}
