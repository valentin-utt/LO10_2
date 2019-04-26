<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projector</title>

    <!-- Bootstrap core CSS -->
    <link href="static/bootstrap/css/theme/flatly/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/bootstrap/css/jumbotron-narrow.css" rel="stylesheet">



  </head>

  <body>
      
    <script src="static/jquery/jquery-1.11.3.min.js"> </script>
    <script src="static/bootstrap/js/bootstrap.min.js"> </script>
      
       <?php 
       session_start();
       var_dump($_POST);
       //var_dump($_SESSION);
       
       if(isset($_POST['name_field'])){
              include 'PDOConnect.php';
              include 'curl_requests.php';
              //addUser($base, $_POST['user_name_field'],$_POST['user_email'], $_POST['user_password'], $_POST['is_user_student']);
              $place = json_decode((nominatimGeocodeRequest($_POST['place_field'])),true);
              var_dump($place[0]);
              if(!is_null($place)){
                addProject($base,$_SESSION['connected_user_email'] ,$_POST['name_field'], $_POST['catlist'],$_POST['des_field'], $_POST['place_field'] ,$_POST['image_field'], $_POST['video_field'], $_POST['project_funding'],$_POST['goal_field'], $place[0]['lon'], $place[0]['lat'],0 ); 
              }else{
                addProjectNolocation($base,$_SESSION['connected_user_email'] ,$_POST['name_field'], $_POST['catlist'],$_POST['des_field'], $_POST['place_field'] ,$_POST['image_field'], $_POST['video_field'], $_POST['project_funding'],$_POST['goal_field'],0); 
              }      
       } 
       ?>

    <div class="container">
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-right">
          <li id="homebtn" ><a href="./index">Acceuil</a></li>
          <li id="catbtn"><a href="./categories?c=art">Projets</a></li>
          <li id="aboutbtn" class="active"><a href="./about">A propos</a></li>
                    <?php
          
          if(isset($_POST['user_connected'])){
              session_start();
              $_SESSION['is_connected']='true';
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }elseif(isset($_SESSION['is_connected'])){
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }else{
              
              echo '<li id="connectbtn"><a href="./connect">Se connecter</a></li>';
          }
          ?>
        </ul>
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
      <div id="signupSuccess" class="alert alert-success" style="display:none">
        <p id="signupSuccessText">Merci de vous être inscrits</p>
      </div>
      <div id="signupDuplicate" class="alert alert-success" style="display:none">
        <p id="signupDuplicateText">Vous êes déja inscrit</p>
      </div>
      <div id="signupError" class="alert alert-info" style="display:none">
        <p id="signupErrorText">Erreur lors de l'inscription</p>
      </div>
      <div class="jumbotron">
          <p>Votre projet à été ajouté</p>
      </div>


      <div class="footer">
        <p>&copy; Projector</p>
      </div>

    </div> <!-- /container -->


   
  </body>
</html>