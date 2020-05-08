<?php
function formatCardsResult($result){
  $cardsData = array();
  $rows = array();
  while($row=$result->fetch_assoc()){
    $rowData = array(
      'id' => $row['id'], 
      'citta' => $row['citta'],  
      'notti' => $row['notti'],
      'descrizione' => $row['descrizione'],
      'latitudine' => $row['latitudine'],
      'longitudine' => $row['longitudine'],
      'id_dest_fk' => $row['id_dest_fk'], 
      'prezzo' => $row['prezzo'],
      'urls' => array($row['url'])
    );
    array_push($rows, $rowData);
  }
  usort($rows, function($a, $b) {
    if ($a['id_dest_fk'] == $b['id_dest_fk']) {
      return 0;
    }
    return ($a['id_dest_fk'] < $b['id_dest_fk']) ? -1 : 1;
  });
  foreach($rows as $row){
    $exists = exists($cardsData, 'id_dest_fk', $row['id_dest_fk']);
    if($exists){
      array_push($cardsData[indexOf($cardsData, 'id_dest_fk', $row['id_dest_fk'])]['urls'], $row['urls'][0]);
    }else{
      array_push($cardsData, $row);
    }
  }
  return $cardsData;
}
function exists($array, $key, $value){
  foreach($array as $data){
    if($data[$key] == $value){
      return true;
    }
  }
  return false;
}
function indexOf($array, $key, $value){
  for($i = 0; $i < sizeof($array); $i++){
    if($array[$i][$key] == $value){
      return $i;
    }
  }
}
?>