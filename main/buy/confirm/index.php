<?php
    require_once('../../../vendor/autoload.php');
    $config = file_get_contents('../../../config.json');
    $jConfig = json_decode($config, true);
    $id = $_POST['id_dest'];
    $connessione =new mysqli($jConfig["DB_HOST"], $jConfig["DB_USER"], $jConfig["DB_PASSWORD"], $jConfig["DB_NAME"]);
    $sql = "SELECT * FROM Destinazioni WHERE id='$id'"; 
    $result = $connessione->query($sql);
    $dest = $result->fetch_assoc();
    $citta = $dest['citta'];
    $descrizione = $dest['descrizione'];
    $prezzo = $dest['prezzo'] * 100;
    $notti = $dest['notti'];
    $baseurl = $jConfig["BASE_URL"];
    \Stripe\Stripe::setApiKey($jConfig["STRIPE_API_KEY"]);

    $session=\Stripe\Checkout\Session::create([
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
    var stripe=Stripe("<?php echo $jConfig["STRIPE_API_KEY_PUBLIC"]?>")
    var confirmBtn=document.getElementById("confirm")
    confirmBtn.addEventListener("click",function(){
        console.log('aaa');
        stripe.redirectToCheckout({
            sessionId:"<?php echo $session["id"]?>"
        })
    }) 
</script>