<?php

include 'curl_requests.php';
include 'PDOConnect.php';
include 's3handler.php';
include 'classes/EtuUttAuth.php';
include 'classes/S3Handler.php';
include 'classes/RDSHandler.php';

/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://etu.utt.fr/api/oauth/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "grant_type=authorization_code&client_id=24048099025&client_secret=4f418cf975e0a7bf4f04176553ebcec7&authorization_code=".$_GET['authorization_code'],
  CURLOPT_HTTPHEADER => array(/*
    //"Accept: ",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Type: application/x-www-form-urlencoded",
    "Host: etu.utt.fr",
    "User-Agent: PostmanRuntime/7.11.0",
    "accept-encoding: gzip, deflate",
    "cache-control: no-cache",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
 * 
 */
   session_start();
   $EtuUttAuth = new EtuUttAuth();
   //var_dump($_GET);
   //var_dump($_POST);
   $authCode= $_GET['authorization_code'];
   $token= json_decode($EtuUttAuth->getAccessToken($authCode))->access_token;
   //$_SESSION['access_token']=json_decode($response)->access_token;
   $_SESSION['access_token']=$token;
   //var_dump($_SESSION);
   //var_dump($_SERVER);
   //var_dump($_COOKIE);
   //AJOUTER L'USER à LA BASE
   $etudiant = json_decode($EtuUttAuth->getEtuUttUserInfoRequest($_SESSION['access_token']));
   
   //var_dump($etudiant->data);
   $S3Handler = new S3Handler();
   $RDSHandler = new RDSHandler();
   if($RDSHandler->isEtuUttUserPresentInBD($base, $etudiant->data->email)){
       $keyName=basename('https://etu.utt.fr'.$etudiant->data->_links[3]->uri);
       $user_id=$RDSHandler->getUserIdByEmail($base, $etudiant->data->email);
       $RDSHandler->updateEtuUttUser($base, $user_id, $etudiant->data->fullName, $etudiant->data->email, $etudiant->data->isStudent, $etudiant->data->studentId, $etudiant->data->branch, $etudiant->data->level, $etudiant->data->speciality,$_SESSION['access_token'], "https://s3-eu-west-1.amazonaws.com/projector.image/".$keyName);
       //maj des UEs, on les suprime puis on les ajoutes
       $RDSHandler->deleteEtuUttUserUEs($base, $user_id);
       foreach ( $etudiant->data->uvs as $ue) {
           $RDSHandler->addEtuUttUserUE($base, $user_id, $ue);
       }
       //update image
       $keyName=basename('https://etu.utt.fr'.$etudiant->data->_links[3]->uri);
       
       $S3Handler->deleteFromS3($keyName);
       $S3Handler->uploadToS3('https://etu.utt.fr'.$etudiant->data->_links[3]->uri);
       
   } else{
       $RDSHandler->addEtuUttUser($base, $etudiant->data->fullName,  $etudiant->data->email, $etudiant->data->isStudent, $etudiant->data->studentId, $etudiant->data->branch,$etudiant->data->level, $etudiant->data->speciality, $_SESSION['access_token'],"https://s3-eu-west-1.amazonaws.com/projector.image/".$keyName);
       $user_id= $RDSHandler->getUserIdByEmail($base, $etudiant->data->email);
       foreach ( $etudiant->data->uvs as $ue) {
           $RDSHandler->addEtuUttUserUE($base, $user_id, $ue);
       }
       $S3Handler->uploadToS3('https://etu.utt.fr'.$etudiant->data->_links[3]->uri);
       
       //add image
       
   }
   
   
   //REDIRIGE VERS l'acceuil
     $URL="http://localhost/LO10/index";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    
   


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

