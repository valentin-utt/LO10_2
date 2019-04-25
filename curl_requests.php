<<<<<<< HEAD
<?php

function nominatimGeocodeRequest($string){
    
    $curl = curl_init();
  

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://nominatim.openstreetmap.org/search?q=".$string."&format=json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_REFERER => "www.projector.net",
  //CURLOPT_AUTOREFERER => true,
  CURLOPT_FOLLOWLOCATION => true, 
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  //CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Accept: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}

    
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

=======
<?php

function nominatimGeocodeRequest($string){
    
    $curl = curl_init();
  

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://nominatim.openstreetmap.org/search?q=".$string."&format=json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_REFERER => "www.projector.net",
  //CURLOPT_AUTOREFERER => true,
  CURLOPT_FOLLOWLOCATION => true, 
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  //CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Accept: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}

    
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

>>>>>>> 09de3f14e0dcbca814c4e5e943a70f41fa58987b
