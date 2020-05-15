<?php
class Geolocalization{
    private $curl;
    public function __construct($citta){
        $this->curl = curl_init();
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://eu1.locationiq.com/v1/search.php?key=1481607cba2ad5&q=$citta&format=json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Cookie: __cfduid=d8d76ff2b653d010fe13ae425b80777671589543472"
            ),
        ));
    }
    public function getLonLat(){
        $response = curl_exec($this->curl);
        $response = json_decode($response,true);
        curl_close($this->curl);
        $lat=$response[0]['lat'];
        $lon=$response[0]['lon'];
        return array('lat'=>$lat,'lon'=>$lon);
        }
    }
?>