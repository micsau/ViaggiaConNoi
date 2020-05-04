<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Viaggia Con Noi: divertiti viaggiando!">
    <meta name="author" content="Michele Saulle">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/main.css">
    <title>Login</title>
  </head>
  <body>
    <header id="head">
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">ViaggiaConNoi</h4>
              <p class="text-muted">
                ViaggiaConNoi startup innovativa per prenotare e viaggiare
                comodamente ed il risparmio è garantito
              </p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Come Contattarci</h4>
              <ul class="list-unstyled">
                <!-- aggiungere link veri -->
                <li><a href="#" class="text-white">Seguici su Twitter</a></li>
                <li>
                  <a href="#" class="text-white">Metti mi piace su Facebook</a>
                </li>
                <li><a href="#" class="text-white">Contattaci</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <!-- QUI CI VA IL LOGO -->
            <strong>ViaggiaConNoi</strong>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarHeader"
            aria-controls="navbarHeader"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
    <div class="container">
      <div class="row">
        <div class="col">
          <?php 
            $username = $_POST["username"];
            $password =$_POST["password"];
            // $email=$_POST["email"];
            $errorDivOpen = '<div class="alert alert-danger">';
            $successDivOpen = '<div class="alert alert-success">';
            $divClose = '</div>';
            $backButton = '<br><br><a class ="btn btn-primary" href="index.html">Ritorna Indietro</a>';
            if(!$username){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Inserisci un username!";
              echo $backButton;
              exit($divClose);
            }
            if(!$password){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Inserisci una password!";
              echo $backButton;
              exit($divClose);
            }
            // if(!$email){
            //   echo '<h1 class="pt-2">Errore:</h1>';
            //   echo $errorDivOpen;
            //   echo "Inserisci una email!";
            //   echo $backButton;
            //   exit($divClose);
            // }
            $config = file_get_contents('../config.json');
            $jConfig = json_decode($config, true);
            $connessione = new mysqli($jConfig['DB_HOST'], $jConfig['DB_USER'], $jConfig['DB_PASSWORD'], $jConfig['DB_NAME']);
            $sql = "SELECT * FROM Users WHERE username='$username'";
            $result = $connessione->query($sql);
            if ($result->num_rows > 0){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Username già esistente!";
              echo $backButton;
              exit($divClose);
            }
            // $sql = "INSERT INTO Users (username, password, email) VALUES ('$username', '$password', '$email')";
            $sql = "INSERT INTO Users (username, password, role) VALUES ('$username', '$password', 0)";
            if ($connessione->query($sql)) {
              echo '<h1 class="pt-2">Successo:</h1>';
              echo $successDivOpen;
              echo "I nuovi dati sono stati inseriti con successo!";
              echo '<br><br><a class ="btn btn-primary" href="/login/index.html">Accedi</a>';
              exit($divClose);
              echo "I nuovi dati sono stati inseriti con successo";
            } else {
              echo "Errore: " . $sql . "<br>" . $connessione->error;
            }
            $connessione->close();
          ?>
        </div>
      </div>
    </div>
  </body>
</html>

