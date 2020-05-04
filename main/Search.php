<?php 
    $Destinazione = $_POST["Destinazione"];
    $connessione = new mysqli("remotemysql.com:3306","vlIGVKqVUg","R6OA2FGr12","vlIGVKqVUg");  
    $sql = "SELECT * FROM Destinazioni WHERE Destinazione='$Destinazione'";
    $result = $connessione->query($sql);
    if (!$result) {
      trigger_error('Invalid query: ' . $connessione->error);
  }
    if ($result->num_rows > 0){
      echo("Siamo Spiacenti ma non è disponibile nessun viaggio per quella destinazione");
    }
    mysqli_close($connessione);
    ?>