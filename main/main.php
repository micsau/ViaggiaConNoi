<html>    <!--ViaggiaConNoi-->
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="../css/main.css">

    <title>ViaggiaConNoi</title>
    <link href="album.css" rel="stylesheet">
    <style>
      .map-container{
        box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); 
      }
    </style>
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">ViaggiaConNoi</h4>
              <p class="text-muted">ViaggiaConNoi startup innovativa per prenotare e viaggiare comodamente ed il risparmio è garantito</p>
              <form action="..\Profile\Profile.html">
                <button type="submit" class="btn btn-success">Profilo</button>
              </form>
              <form action="..\logout\logout.php">
                <button type="submit" class="btn btn-primary">logout</button>
              </form>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Come Contattarci</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Seguici su Twitter</a></li>
                <li><a href="#" class="text-white">Metti mi piace su Facebook</a></li>
                <li><a href="#" class="text-white">Contattaci</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>ViaggiaConNoi</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
    <main role="main">
      <div class="container">
        <div class="row pt-3">
          <div class="col-6" style="height: 35vh;">
            <div class="map-container">
              <div style="padding-left: 5vh;" id="demoMap"></div>
            </div>
          </div>
          <div class="col-6">
            <h2 class="pb-3">Seleziona la tua destinazione</h2>
            <form action="main.php" method="POST">
              <div class="container-fluid px-0">
                <div class="row">
                  <div class="col-8">
                    <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
                  </div>
                  <div class="col-2">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </div>
                  <div class="col-2">
                    <a class="btn btn-outline-primary" href="/main/main.php">Refresh</a>
                  </div>
                </div>  
              </div>
            </form>
          </div>
        </div>
        <div class="row pt-3">
          <?php 
            require_once("../utils/utils.php");
            $connessione = new mysqli("remotemysql.com:3306","vlIGVKqVUg","R6OA2FGr12","vlIGVKqVUg");  
            if(empty($_POST) || !$_POST["search"]){
              $sql = "SELECT * FROM Destinazioni, Immagini WHERE Destinazioni.id = Immagini.id_dest_fk";
            }
            else{
              $citta = $_POST["search"];
              $sql = "SELECT * FROM Destinazioni, Immagini WHERE citta='$citta' AND Destinazioni.id = Immagini.id_dest_fk";
            }
            $result = $connessione->query($sql);
            $cardsData = formatCardsResult($result);
            $carouselId = 0;
            foreach($cardsData as $card) {
              $citta = $card['citta'];
              $descrizione = $card['descrizione'];
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
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="login/index.html" class="btn btn-outline-secondary">Visualizza Offerta</a>
                      </div>
                    </div>
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
      <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
      <script>
          let lat = 45.5257;
          let lon = 10.2283;
          let zoom = 10;

          let fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
          let toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
          let position = new OpenLayers.LonLat(lon, lat).transform( fromProjection, toProjection);
          map = new OpenLayers.Map("demoMap");
          let mapnik = new OpenLayers.Layer.OSM();
          map.addLayer(mapnik);
          map.setCenter(position, zoom);
          postition = navigator.geolocation.getCurrentPosition(function(posit){
            position = new OpenLayers.LonLat(posit.coords.longitude || lon, posit.coords.latitude || lat).transform(fromProjection, toProjection);
            let markers = new OpenLayers.Layer.Markers("Markers");
            map.addLayer(markers);
            markers.addMarker(new OpenLayers.Marker(position));
            map.setCenter(position, zoom);
          })
      </script>
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