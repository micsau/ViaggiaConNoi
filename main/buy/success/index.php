<!-- TODO ALL -->
<?php 
    session_start();
    $username = $_SESSION["Nome"];
    $id_destinazione = $_SESSION['id_dest'];
    $stripe = $_SESSION['id_checkout_stripe'];
    $config = file_get_contents('../../../config.json');
    $jConfig = json_decode($config, true);
    $connessione = new mysqli($jConfig["DB_HOST"], $jConfig["DB_USER"], $jConfig["DB_PASSWORD"], $jConfig["DB_NAME"]);
    $sql = "SELECT * FROM Users WHERE username = '$username'";
    $result = $connessione->query($sql);
    $user = $result->fetch_assoc();
    $idutente = $user['id']; 
    $sql = "UPDATE Destinazioni SET isBought = true, id_user_fk = '$idutente' WHERE id = '$id_destinazione'";
    $result = $connessione->query($sql);
    $sql = "SELECT * FROM Destinazioni WHERE id = '$id_destinazione'";
    $result = $connessione->query($sql);
    $destinazione = $result->fetch_assoc();
    print_r($destinazione); 
?>