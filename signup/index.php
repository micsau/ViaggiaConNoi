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
    <title>Sign Up</title>
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
            $email=$_POST["email"];
            $birthday=$_POST["birthday"];
            $birthplace=$_POST["birthplace"];
            $name=$_POST["name"];
            $surname=$_POST["surname"];
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
            if(!$email){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Inserisci una email!";
              echo $backButton;
              exit($divClose);
            }
            if(!$name){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Inserisci un nome!";
              echo $backButton;
              exit($divClose);
            }
            if(!$surname){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Inserisci un cognome!";
              echo $backButton;
              exit($divClose);
            }
            if(!$birthday){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Inserisci la tua data di nascita!";
              echo $backButton;
              exit($divClose);
            }
            if(!$birthplace){
              echo '<h1 class="pt-2">Errore:</h1>';
              echo $errorDivOpen;
              echo "Inserisci il luogo di nascita!";
              echo $backButton;
              exit($divClose);
            }
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
            $sql = "INSERT INTO Users (username, password, role, email, luogo_nascita, data_nascita, nome, cognome) VALUES ('$username', '$password', 0, '$email','$birthplace','$birthday','$name','$surname')";
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
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

