<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
//var_dump($_POST);
session_start(); 
//var_dump($_SESSION);
include 'PDOConnect.php';
include 'functions.php';
include 'curl_requests.php';

?>


<html>
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projector</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap/css/theme/flatly/bootstrap.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="static/bootstrap/css/jumbotron-narrow.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    
   


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
            crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
            crossorigin=""></script>
		<script type="text/javascript">
			// On initialise la latitude et la longitude de Troyes (centre de la carte)
			var lat = 48.3;
			var lon = 4.0833;
			var macarte = null;
			// Fonction d'initialisation de la carte
			function initMap() {
				// Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
                macarte = L.map('map').setView([lat, lon], 11);
                <?php
                foreach (listProject($base) as $project) { 
                    if(!is_null($project['latitude']) && !is_null($project['longitude'])){
                        echo 'var marker'.$project['id'].' = L.marker(['.$project['latitude'].','.$project['longitude'].']).addTo(macarte);';
                        echo "\n";
                        //echo 'marker'.$project['id'].'.bindPopup("<a href="\./view?p='.$project['id'].'">'.$project['name'].'</a>");';
                        $centeredDiv = '<div style=\'text-align: center;\'>' ;
                        $htmlLink = '<a href=\'./view?p='.$project['id'].'\'> '.$project['name'].' </a>';
                        $br ='</br>';
                        $htmlImg = '<div style=\'width: 64px; height:64px;overflow: hidden;display: inline-block;background-size: cover;background-position: center;background-image: url('.$project['img'].');-moz-border-radius: 16px;webkit-border-radius: 16px;border-radius: 16px;\'>; ';
                        $div ='</div>' ;
                        echo 'marker'.$project['id'].'.bindPopup("'.$centeredDiv.$htmlLink.$br.$htmlImg.$div.'");';
                        echo "\n";
                    }
                }
                ?>
                

                
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    // Il est toujours bien de laisser le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
            }
			window.onload = function(){
				// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
				initMap();
			};
		</script>
		<style type="text/css">
			#map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
				height:400px;
			}
		</style>

</head>
    <body> 
        
    
    <div class="container">
        <h1 style="text-align: center">Projector</h1>
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-right">
            <li id="homebtn" class="active"><a href="./index.php">Accueil</a></li>
          <li id="catbtn"><a href="./categories.php?c=art">Projets</a></li>
          <li id="aboutbtn"><a href="./about.php">A propos</a></li>
          <?php
          
          if(isset($_POST['user_connection_attempt'])){ //si l'utilisateur viens de connect.php
              //var_dump(listUser($base,$_POST['user_email']));
              if(!empty(listUserByEmail($base,$_POST['user_email']))){
                  if(listUserByEmailAndPassword($base, $_POST['user_email'],$_POST['user_password'])){
                    $_SESSION['is_connected']='true';
                    $_SESSION['connected_user_email']=$_POST['user_email'];
                    echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
                  }else{
                       echo "<script>alert('Erreur : le mot de passe est incorect.');</script>";
                       echo '<li id="connectbtn"><a href="./connect">Se connecter</a></li>';
                  }
              }else{
                  echo "<script>alert('Erreur : l\'utilisateur n\'existe pas.');</script>";
                  echo '<li id="connectbtn"><a href="./connect">Se connecter</a></li>';
              }
              
              
          }elseif(isset($_SESSION['is_connected'])){
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }else{
              echo '<li id="connectbtn"><a href="./connect">Se connecter</a></li>';
          }
          if(isset($_POST['user_name_field'])){ //si l'utilisateur viens de register.php
              //include 'PDOConnect.php';
              //var_dump(listUserByEmail($base, $_POST['user_email']));
              if(empty(listUserByEmail($base, $_POST['user_email']))){
                  addUser($base, $_POST['user_name_field'],$_POST['user_email'], $_POST['user_password'], $_POST['is_user_student']);
              }
              else{
                   echo "<script>alert('Erreur : votre adresse email est déjà inscrite');</script>";
              }
          }
          ?>
        </ul>
          <div class="header" style="margin-bottom: 40px">
        <ul class="nav nav-pills pull-left">
            <?php
            if(isset($_POST['user_connected'])){    
                echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>';
            }elseif(isset($_SESSION['is_connected'])){
                echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>';
            }
           ?>
        </ul>
            </div>
      </div>
	  
      <div id="signupSuccess" class="alert alert-success" style="display:none">
        <p id="signupSuccessText">Merci de vous être inscrits</p>
      </div>
      <div id="signupDuplicate" class="alert alert-success" style="display:none">
        <p id="signupDuplicateText">Vous êtes déja inscrit</p>
      </div>
      <div id="signupError" class="alert alert-info" style="display:none">
        <p id="signupErrorText">Erreur lors de l'inscription</p>
      </div>
      <div class="jumbotron">
        
        <p class="lead">Le portail des projets étudiants</p>
        
        <?php
        
            if(isset($_POST['user_connected'])){    
                echo '<p hidden ><a class="btn btn-lg btn-success"  data-toggle="modal" href="./register">Inscrivez vous maintenant</a></p>';
            }elseif(isset($_SESSION['is_connected'])){
                echo '<p hidden ><a class="btn btn-lg btn-success"  data-toggle="modal" href="./register">Inscrivez vous maintenant</a></p>';
            }else{
                echo '<p><a class="btn btn-lg btn-success"  data-toggle="modal" href="./register">Inscrivez vous maintenant</a></p>';
            }
           ?>
      </div>
        
        
        <div style="width: 50%; float:left" id="map" >
  <!-- Ici s'affichera la carte -->
        </div>
        <div style="width: 50%; float:right; height:400px" >
            <canvas style="height:400px"  id="myChart"></canvas>
        </div>
        
    </div>
        
        <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        //ctx.height = 900;
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Art', 'Design et Technologies', 'Cinema', 'Gastronomie', 'Jeux', 'Musique', 'Edition'],
        datasets: [{
            label: 'Argent récolté',
            backgroundColor: 'rgb(24, 188, 156)',
            borderColor: 'rgb(24, 188, 156)',
            data: [10, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {
        maintainAspectRatio: false,
        
    }
});
    </script>


      <div class="footer">
        <p>Projector</p>
      </div>
       
    </body>
</html>
