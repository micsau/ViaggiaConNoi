<?php
  session_start();
  $username = $_SESSION["Nome"];
  $config = file_get_contents('../config.json');
  $jConfig = json_decode($config, true);
  $connessione = new mysqli ($jConfig['DB_HOST'], $jConfig['DB_USER'], $jConfig['DB_PASSWORD'], $jConfig['DB_NAME']);
  $sql = "SELECT * FROM Users WHERE username = '$username'";
  $result = $connessione->query($sql);
  $utente=$result->fetch_assoc();
  $name=$utente['nome'];
  $surname=$utente['cognome'];
  $birthday=$utente['data_nascita'];
  $birthplace=$utente['luogo_nascita'];
  $email=$utente['email'];
  $imageid=$utente['id_profilepic_fk'];
  $sql = "SELECT url FROM Profilepics WHERE id = '$imageid'";
  $result = $connessione->query($sql);
  $image = $result->fetch_assoc();
  $imageURL = $image['url'];
?>
<html>    <!--ViaggiaConNoi-->
  <head>
    <link rel="icon" type="image/png" href="../assets/logo/logo-ico.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Viaggia Con Noi: divertiti viaggiando!">
    <meta name="author" content="Michele Saulle">
    <link rel="stylesheet" href="../css/main.css">
    <title>ViaggiaConNoi</title>
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">ViaggiaConNoi</h4>
              <p class="text-muted">ViaggiaConNoi startup innovativa per prenotare e viaggiare comodamente ed il risparmio è garantito</p>
              <form action="/profile/index.php">
                <button type="submit" class="btn btn-success">Profilo</button>
              </form>
              <form action="..\logout\logout.php">
                <button type="submit" class="btn btn-primary">logout</button>
              </form>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contatti</h4>
              <ul class="list-unstyled">
                <li><a href="mailto:michelesaulle98@gmail.com" class="text-white">Tramite e-mail</a></li></ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="../assets/logo/logo.png" width=100 height="100" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
    <main role="main">
      <div class="container profile-data mt-3">
        <div class="row">
          <div class="col p-3" style="border-right:1px solid #e6e5e3">
            <?php
              echo "
                <div class='media'>
                <img src='$imageURL' class='mr-3 align-self-center img-thumbnail' width='200'></img>
                <div class='media-body'>
                <h5>$username</h5>
                </div>
                </div>
              ";
              echo "<hr>";
              echo "<h5>Nome</h5> <p>$name<p>";
              echo "<hr>";
              echo "<h5>Cognome</h5> <p>$surname<p>";
              echo "<hr>";
              echo "<h5>email</h5> <p>$email<p>";
              echo "<hr>";
              echo "<h5>Data di Nascita</h5> <p>$birthday<p>";
              echo "<hr>";
              echo "<h5>Luogo di Nascita</h5> <p>$birthplace<p>";
            ?>
          </div>
          <div class="col-3 p-3">
            <div class="btn-toolbar justify-content-end pb-2" role="toolbar">
              <a href="/profile/update/index.php" class="btn btn-primary">Modifica Profilo</a>
            </div>
            <div class="btn-toolbar justify-content-end" role="toolbar">
              <a href="/profile/orders/index.php" class="btn btn-outline-secondary">Visualizza Ordini</a>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="text-muted" style="padding-top: 5vh;">
      <div class="container">
        <p class="float-right">
          <a href="#">Torna in Cima</a>
        </p>
        <p>ViaggiaConNoi creata da Michele Saulle, per bug e altri problemi contattatelo a michelesaulle98@gmail.com</p>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body> 
</html>