<?php
  session_start();
  $username = $_SESSION["Nome"];
  //$config = file_get_contents('../../config.json');
  //$_ENV = json_decode($config, true);
  $connessione = new mysqli ($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
  $sql = "SELECT id FROM Users WHERE username = '$username'";
  $result = $connessione->query($sql);
  $utente=$result->fetch_assoc();
  $userid=$utente['id'];
?>
<html>    <!--ViaggiaConNoi-->
  <head>
    <link rel="icon" type="image/png" href="../../assets/logo/logo-ico.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Viaggia Con Noi: divertiti viaggiando!">
    <meta name="author" content="Michele Saulle">
    <link rel="stylesheet" href="../../css/main.css">
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
              <form action="..\..\logout\logout.php">
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
            <img src="../../assets/logo/logo.png" width=100 height="100" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
    <main role="main">
      <div class="container mt-3">
        <div class="row">
            <?php
              require_once("../../utils/utils.php");
              $connessione = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
              if(empty($_POST) || !$_POST["search"]){
                $sql = "SELECT Destinazioni.latitudine, Destinazioni.longitudine, Destinazioni.citta, Destinazioni.id, Destinazioni.prezzo, Destinazioni.notti, Destinazioni.descrizione, Destinazioni.quantità, Destinazioni.isBought, Immagini.id_dest_fk, Immagini.url FROM Destinazioni, Immagini, Acquisti WHERE Destinazioni.id = Immagini.id_dest_fk AND Acquisti.id_dest_fk = Destinazioni.id AND Acquisti.id_user_fk ='$userid'";
              }
              $result = $connessione->query($sql);
              $cardsData = formatCardsResult($result);
              $carouselId = 0;
              foreach($cardsData as $card) {
                $citta = $card['citta'];
                $id = $card['id'];
                $descrizione = $card['descrizione'];
                $prezzo = $card['prezzo'];
                $urls = $card['urls'];
                $images = array();
                $isFirstUrl = true;
                foreach($urls as $url){
                  $divClass = $isFirstUrl? "carousel-item active" : "carousel-item";
                  $div = '
                    <div class="'.$divClass.'" data-interval="5000">
                      <img src="'.$url.'" class="d-block w-100">
                    </div>
                  ';
                  array_push($images, $div);
                  $isFirstUrl = false;
                }
                $cards = '
                  <div class="col-3">
                    <div class="card mb-4 box-shadow">
                      <div id="destImagesCarousel'.$carouselId.'" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">'
                          . implode($images) .
                        '</div>
                        <a class="carousel-control-prev" href="#destImagesCarousel'.$carouselId.'" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#destImagesCarousel'.$carouselId.'" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">'.$citta.'</h5>
                        <p class="card-text">'.$descrizione.'</p>
                        <h6 class="card-subtitle mb-2 text-muted">'.$prezzo.' €/notte</h6>
                      </div>
                    </div>
                  </div>
                ';
                $carouselId++;
                echo($cards);
              }
              mysqli_close($connessione);
            ?>  
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