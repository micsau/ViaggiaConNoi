<html>    <!--ViaggiaConNoi-->
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>ViaggiaConNoi</title>


    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">


    <link href="album.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">ViaggiaConNoi</h4>
              <p class="text-muted">ViaggiaConNoi startup innovativa per prenotare e viaggiare comodamente ed il risparmio è garantito</p>
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
      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">BENVENUTO</h1>
          <p class="lead text-muted">Visualizza le nostre offerte, e trova quella più conveniente per te!</p>
          <p>
            <form action="Login/LoginPage.html" method="POST">
              <button type="submit" class="btn btn-primary">Accedi</button>
            </form>
            <form action="Signup/SignupPage.html" method="POST">
              <button type="submit" class="btn btn-outline-secondary">Registrati</button>
          </form>
          </p>
        </div>
      </section>
      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            <?php
              $connessione = new mysqli("remotemysql.com:3306","vlIGVKqVUg","R6OA2FGr12","vlIGVKqVUg");
              $sql = "SELECT * FROM Destinazioni, Immagini WHERE Destinazioni.id = Immagini.id_dest_fk";
              $result = $connessione->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $citta=$row['citta'];
                  $prezzo=$row['prezzo'];
                  $notti=$row['notti'];
                  $descrizione=$row['descrizione'];
                  //$url_immagine=$row['url'];
                  print_r($row);
                }
              }
                  // $cards = '
                  // <div class="col-md-4">
                  //   <h5 class="card-title">'.$citta.'</h5>
                  //   <div class="card mb-4 box-shadow">
                  //     <img src="'.$url_immagine.'" width="348" height="159">
                  //     <div class="card-body">
                  //       <p class="card-text">$descrizione</p>
                  //       <div class="d-flex justify-content-between align-items-center">
                  //         <div class="btn-group">
                  //           <form action="Login/LoginPage.php" method="POST">
                  //             <button type="submit" class="btn btn-outline-secondary">Visualizza</button>
                  //           </form>
                  //         </div>
                  //       </div>
                  //     </div>
                  //   </div>
                  // </div>
                  // ';
                  // echo $cards;
                  // echo $citta;
                  // echo $prezzo;
                  // echo $notti;
                  // echo $descrizione;
                  // echo $url_immagine;
              
            ?>

            <!-- <div class="col-md-4">
              <h5 class="card-title">Roma</h5>
              <div class="card mb-4 box-shadow">
                <img src="https://viaggiaconnoiimages.s3-eu-west-1.amazonaws.com/Roma.jpg" width="348" height="159">
                <div class="card-body">
                  <p class="card-text">Viaggio per Roma a Partire da 25 Euro</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <form action="Login/LoginPage.php" method="POST">
                        <button type="submit" class="btn btn-outline-secondary">Visualizza</button>
                    </form>
                    </div>
                    <small class="text-muted">20 min</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <h5 class="card-title">Amsterdam</h5>
              <div class="card mb-4 box-shadow">
                <img src="https://viaggiaconnoiimages.s3-eu-west-1.amazonaws.com/Amsterdam.jpg" width="348" height="159">
                <div class="card-body">
                  <p class="card-text">Guarda draghi e sballati come non mai ad Amsterdam per 75 euro a persona</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <form action="Login/LoginPage.php" method="POST">
                        <button type="submit" class="btn btn-outline-secondary">Visualizza</button>
                    </form>
                    </div>
                    <small class="text-muted">1 ora fa</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <h5 class="card-title">Parigi</h5>
              <div class="card mb-4 box-shadow">
                <img src="https://viaggiaconnoiimages.s3-eu-west-1.amazonaws.com/Parigi.jpg" width="348" height="159">
                <div class="card-body">
                  <p class="card-text">Una volta ogni tanto fai felice la tua ragazza e portala a Parigi per 55 euro a persona!!</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <form action="Login/LoginPage.php" method="POST">
                        <button type="submit" class="btn btn-outline-secondary">Visualizza</button>
                    </form>
                    </div>
                    <small class="text-muted">2 giorni fa</small>
                  </div>
                </div>
              </div>
            </div> -->
    </main>
    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Torna in Cima</a>
        </p>
        <p>ViaggiaConNoi creata da Michele Saulle, per bug e altri problemi contattatelo a michelesaulle98@gmail.com</p>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>