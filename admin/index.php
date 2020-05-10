<?php
    session_start();
    $config = file_get_contents('../config.json');
    $jConfig = json_decode($config, true);
    $connessione = new mysqli($jConfig['DB_HOST'], $jConfig['DB_USER'], $jConfig['DB_PASSWORD'], $jConfig['DB_NAME']);
    $username=$_SESSION['Nome'];
    $sql = "SELECT * FROM Users WHERE username = '$username'";
    $result = $connessione->query($sql);
    $user = $result->fetch_assoc();
    if($user['role'] == 0){
        header("Location: /");
    }
    if(sizeof($_POST) > 0){
      $countfiles = count($_FILES['immagini']['name']);
      for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['immagini']['name'][$i];
        move_uploaded_file($_FILES['immagini']['tmp_name'][$i],'../uploads/'.$username.'.png');
      }
    }
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <link rel="icon" type="image/png" href="../assets/logo/logo-ico.png"/>
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
              <h4 class="text-white">Contatti</h4>
              <ul class="list-unstyled">
                <li><a href="mailto:michelesaulle98@gmail.com" class="text-white">Tramite e-mail</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="../assets/logo/logo.png" width=100 height="100" alt="">
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
    <form action="/admin/index.php" method="POST" enctype='multipart/form-data'>
        <input type="text" name="citta" class="form-control" placeholder="citta">    
        <input type="number" name="prezzo" class="form-control" placeholder="prezzo">    
        <input type="number" name="notti" class="form-control" placeholder="notti">
        <input type="number" name="latitudine" class="form-control" placeholder="latitudine"> 
        <input type="number" name="longitudine" class="form-control" placeholder="longitudine">
        <input type="file" name="immagini[]" class="form-control-files" placeholder="immagini" multiple>
        <textarea name="descrizione" class="form-control" placeholder="descrizione"></textarea>
        <button type="submit" class="btn btn-success">Aggiungi</button>
    </form>
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
