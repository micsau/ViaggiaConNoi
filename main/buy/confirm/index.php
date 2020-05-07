<?php
  require_once('../../../vendor/autoload.php');
  $id = $_POST['id_dest'];
  $config = file_get_contents('../../../config.json');
  $jConfig = json_decode($config, true);
  $connessione = new mysqli($jConfig["DB_HOST"], $jConfig["DB_USER"], $jConfig["DB_PASSWORD"], $jConfig["DB_NAME"]);
  $sql = "SELECT * FROM Destinazioni WHERE id='$id'"; 
  $result = $connessione->query($sql);
  $dest = $result->fetch_assoc();
  $citta = $dest['citta'];
  $descrizione = $dest['descrizione'];
  $prezzo = $dest['prezzo'] * 100;
  $notti = $dest['notti'];
  $baseurl = $jConfig["BASE_URL"];

  // ***STARTING STRIPE CONFIGURATION***
  \Stripe\Stripe::setApiKey($jConfig["STRIPE_API_KEY"]);

  // Session is an array wich includes the id for the checkout
  $session = \Stripe\Checkout\Session::create([
    'success_url' => "http://$baseurl/main/buy/success",
    'cancel_url' => "http://$baseurl",
    'payment_method_types' => ['card'],
    'line_items' => [
      [
        'name' => "$citta",
        'description' => "$descrizione",
        'amount' => $prezzo,
        'currency' => 'eur',
        'quantity' => 1,
      ],
    ],
  ]);
?>
<button id="confirm">Confirm</button>
<script src="https://js.stripe.com/v3/"></script>
<script>
  var stripe=Stripe("<?php echo $jConfig["STRIPE_API_KEY_PUBLIC"]?>");
  var confirmBtn=document.getElementById("confirm");

  confirmBtn.addEventListener("click",function(){
    // Redirects to Stripe checkout page
    stripe.redirectToCheckout({
      sessionId:"<?php echo $session["id"]?>"
    });
  });
</script>