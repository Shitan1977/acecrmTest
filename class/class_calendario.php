<?php
include_once 'mysql.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClassCalendario
 *
 * @author shitan
 */
class ClassCalendario {
    public $tabella;
  
    public  function __construct($tabella)
    {
        $this->tabella=$tabella;
    }
    
    public function ShowCalendar($m,$y) {
         if ((!isset($_GET['d']))||($_GET['d'] == ""))
         {
            $m = date('n');
            $y = date('Y'); 
         }else{
            $m = (int)strftime("%m",(int)$_GET['d']);
            $y = (int)strftime("%Y",(int)$_GET['d']);
            $m = $m;
            $y = $y;
        }
        $precedente = mktime(0, 0, 0, $m -1, 1, $y);
        $successivo = mktime(0, 0, 0, $m +1, 1, $y);
        $nomi_mesi = array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
        $nomi_giorni = array("Lun","Mar","Mer","Gio","Ven","Sab","Dom");
        $cols = 7;
        $days = date("t",mktime(0, 0, 0, $m, 1, $y)); 
        $lunedi= date("w",mktime(0, 0, 0, $m, 1, $y));
        if($lunedi==0) $lunedi = 7;
        echo '<div class="calendar-header">';
        echo "<h1><a href='content.php?d=$precedente'><i class=\"fas fa-angle-left\"></i> </a>";
        echo $nomi_mesi[$m-1];
        echo "<a href='content.php?d=$successivo'> <i class=\"fas fa-angle-right\"></i> </a></h1>";
        echo "<p>".date("Y")."</p>";
        echo '</div>';
        echo '<div class="calendar">';
        foreach($nomi_giorni as $v)
        {
           echo "<span class=\"day-name\">$v</span>"; 
           
           
        }
        for($j = 1; $j<$days+$lunedi; $j++)
        {
            
             if($j<$lunedi)
           {
                echo "  <div class=\"day\"></div>";
             }else{
            $day= $j-($lunedi-1);
            $data = strtotime(date($y."-".$m."-".$day));
            $oggi = strtotime(date("Y-m-d"));
            $db=new MySQL();
            $nomedb=$this->tabella.'.appuntamenti';
            $nomedb2=$this->tabella.'.anagrafica';
            $db->Query("SELECT * FROM $nomedb INNER JOIN $nomedb2 ON anagrafica.idAnagrafica=appuntamenti.idCliente ORDER BY orario"); 
            
            if($db->RowCount()>0){
           while( $cale=$db->Row()){
                 $str_data=$cale->str_data;
              if ($str_data == $data)
            {
            $day = "$day <form action='gestione-appuntamenti.php' method='post'><input type='hidden' value='$str_data' name='data'><input type='submit' name='' value='$cale->cognome orario $cale->orario' class='fc-event  m-b-15 font-10'></form>";
            
             }   
                
            }
            }
             if($data != $oggi)
              {
               echo "<div class=\"day\">".$day."</div>";
               }else{
                 echo "<div class=\"day text-info\">".$day."</div>";
                }
             }
           
         }
        echo "</div>";
    }
    public function gestioneCalendario($idCliente=null,$testo=null,$str_data=null,$idPostazione=null,$orario=null,$idAppuntamenti=null,$cancella=null,$idAmministratore=null,$obbiettivi=null) {
        $db=new MySQL();
        $aggEventi['idCliente'] = MySQL::SQLValue($idCliente, MySQL::SQLVALUE_TEXT);
        $aggEventi['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $aggEventi['testo'] = MySQL::SQLValue($testo, MySQL::SQLVALUE_TEXT);
        $dataConvertita = strtotime($str_data);
        $aggEventi['idPostazione'] = MySQL::SQLValue($idPostazione, MySQL::SQLVALUE_TEXT);
        $aggEventi['str_data'] = MySQL::SQLValue($dataConvertita, MySQL::SQLVALUE_TEXT);
        $aggEventi['orario'] = MySQL::SQLValue($orario, MySQL::SQLVALUE_TEXT);
        $aggEventi['idOperatore'] = MySQL::SQLValue($_SESSION['idAmministratore'], MySQL::SQLVALUE_TEXT);
        $aggEventi['idAmministratore'] = MySQL::SQLValue($idAmministratore, MySQL::SQLVALUE_TEXT);
        $aggEventi['obiettivi'] = MySQL::SQLValue($obbiettivi, MySQL::SQLVALUE_TEXT);
        $aggEventiFil['idAppuntamenti'] = MySQL::SQLValue($idAppuntamenti, MySQL::SQLVALUE_TEXT);
        $nomedb=$this->tabella.'.appuntamenti';
        if(empty($idAppuntamenti)){
        if (!$db->InsertRow($nomedb, $aggEventi))echo $db->Kill();
        }else{
            if(!empty($cancella)){
                 if (!$db->DeleteRows($nomedb,$aggEventiFil))echo $db->Kill();
            }else{
         if (!$db->UpdateRows($nomedb, $aggEventi,$aggEventiFil))echo $db->Kill();
            }
        }
             @header('location:content.php');

        
    }
    public function aggiungiPostazione($postazione) {
          $db=new MySQL();
        $aggPostazione['postazione'] = MySQL::SQLValue($postazione, MySQL::SQLVALUE_TEXT); 
        $nomedb=$this->tabella.'.postazioni';
         if (!$db->InsertRow($nomedb, $aggPostazione))echo $db->Kill();
    }
}
