<?php 
    $username = $_POST["Username"];
    $password =$_POST["Password"];
    $email=$_POST["Email"];
    if(!$username){
      exit("Inserisci un username!");
    }
    if(!$password){
      exit("Inserisci una password!");
    }
    if(!$email){
      exit("Inserisci una mail valida!");
    }
    $connessione = new mysqli("remotemysql.com:3306","vlIGVKqVUg","R6OA2FGr12","vlIGVKqVUg");  
    $sql = "SELECT Username FROM ViaggiaConNoi WHERE Username=$username";
    $result = mysqli_query($connessione,$sql);
    echo mysqli_num_rows($result);
    echo $result;
    if (mysqli_num_rows($result) == 0) {
      exit("Username già registrato!");
    }
    $sql = "INSERT INTO ViaggiaConNoi (Username, Password, Email) VALUES ('$username', '$password', '$email')";
            
    if (mysqli_query($connessione, $sql)) {
        echo "I nuovi dati sono stati inseriti con successo";
    } else {
        echo "Errore: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($connessione);
?>
  <form action="index.html" method="POST">
    <button type="submit"> Indietro </button>
  </form>
