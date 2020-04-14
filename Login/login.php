<?php
session_start();         //funzione di login.
$username = $_POST["Nome"];
$password = $_POST["Password"];       //prendo da input lo username e la password.
if (!$username) {
  exit("Inserisci un username per accedere!");
}
if (!$password) {                                 // se non trova scritto user e pass da erore.
  exit("la password non è corretta, riprova!");
}
$connessione = new mysqli("remotemysql.com:3306", "vlIGVKqVUg", "R6OA2FGr12", "vlIGVKqVUg"); //connessione al db.
$sql = "SELECT * FROM ViaggiaConNoi where Username='$username' AND Password='$password'";
$result = mysqli_query($connessione, $sql);   //eseguo la query.
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $_SESSION["Nome"] = $username;
  ob_start();
  header('Location: \main\main.html');  //mi posiziono su dizionario una volta effettuato il login.
  ob_end_flush();
  exit();
} else {
  session_destroy();
  echo("Username o Password errati, Riprova!");
  exit('<br><br><a class ="btn btn-primary" href="../Login/LoginPage.html"> Ritorna Indietro </button>');
}
?>
<!--fine login -->