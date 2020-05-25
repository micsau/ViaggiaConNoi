<html>    <!--ViaggiaConNoi-->
  <head>
    <link rel="icon" type="image/png" href="../../assets/logo/logo-ico.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
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
              <form action="..\..\Profile\Profile.html">
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
    
    <main class="pt-3">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <?php 
                require_once('../../utils/utils.php');
                $id = $_POST['id'];
                $config = file_get_contents('../../config.json');
                $jConfig = json_decode($config, true);
                $connessione = new mysqli($jConfig['DB_HOST'], $jConfig['DB_USER'], $jConfig['DB_PASSWORD'], $jConfig['DB_NAME']);
                $sql = "SELECT Destinazioni.latitudine, Destinazioni.longitudine, Destinazioni.citta, Destinazioni.id, Destinazioni.prezzo, Destinazioni.notti, Destinazioni.descrizione, Destinazioni.isBought, Destinazioni.quantità, Immagini.id_dest_fk, Immagini.url FROM Destinazioni, Immagini WHERE Destinazioni.id = '$id' AND Destinazioni.id = Immagini.id_dest_fk";
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
                  ';
                  $carouselId++;
                  echo($cards);
                }
                mysqli_close($connessione);    
            ?>
          </div>
          <div class="col">
            <!-- SE METTIAMO LA EMAIL COME ATTRIBUTO DI USER NON SERVIRA PIU QUESTO FORM -->
            <form action="confirm/index.php" method="POST">
              <h5 class="pb-3">Clicca su Acquista per procedere al pagamento, altrimenti clicca cancella</h5>
                <?php 
                  echo "<input type='hidden' name='id_dest' value='$id'>";
                ?>
              <div class="btn-toolbar justify-content-end" role="toolbar" aria-label="Toolbar with button groups">
                <a href="/main/main.php" class="btn btn-outline-danger mt-3 mr-3">Cancella</a> 
                <button type="submit" class="btn btn-primary mt-3">Acquista Ora</button> 
              </div>
            </form>
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