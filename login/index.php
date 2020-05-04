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
          <h1 class="pt-2">Errore:</h1>
          <div class="alert alert-danger">
            <?php
              session_start();         //funzione di login.
              $username = $_POST["username"];
              $password = $_POST["password"];       //prendo da input lo username e la password.
              if (!$username) {
                echo("Inserisci un username per accedere!");
                exit('<br><br><a class ="btn btn-primary" href="index.html">Ritorna Indietro </a>');
              }
              if (!$password) {                                 // se non trova scritto user e pass da erore.
                echo("Inserisci una password per accedere!");
                exit('<br><br><a class ="btn btn-primary" href="index.html">Ritorna Indietro </a>');
              }
              $config = file_get_contents('../config.json');
              $jConfig = json_decode($config, true);
              $connessione = new mysqli($jConfig['DB_HOST'], $jConfig['DB_USER'], $jConfig['DB_PASSWORD'], $jConfig['DB_NAME']);
              $sql = "SELECT * FROM Users where username='$username' AND password='$password'";
              $result = $connessione->query($sql);   //eseguo la query.
              if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["Nome"] = $username;
                ob_start();
                header('Location: \main\main.php');  //mi posiziono su dizionario una volta effettuato il login.
                ob_end_flush();
                exit();
              } else {
                session_destroy();
                echo("Username o Password errati, Riprova!");
                exit('<br><br><a class ="btn btn-primary" href="index.html">Ritorna Indietro </a>');
              }
              $connessione->close();
            ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>