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
      
       <?php 
       session_start();
       //var_dump($_POST);
        ?>

    <div class="container">
        <h1 style="text-align: center">Projector</h1>
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-right">
          <li id="homebtn" ><a href="./index">Accueil</a></li>
          <li id="catbtn" class="active"><a href="./categories?c=art">Projets</a></li>
          <li id="aboutbtn" ><a href="./about">A propos</a></li>
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
        <p id="signupDuplicateText">Vous êes déja inscrit</p>
      </div>
      <div id="signupError" class="alert alert-info" style="display:none">
        <p id="signupErrorText">Erreur lors de l'inscription</p>
      </div>
     
        <?php
           include 'PDOConnect.php';
           include 'functions.php';
           $project = getProjectById($base, $_GET['p'])[0];
           $pseudo = getProjectOwnerNamebyEmail($base, $project['owner'])[0]['pseudo'];
           //var_dump($pseudo);
           //var_dump($project);
           generateProjectView($project['name'],$pseudo, $project['cat'], $project['place'], $project['description'], $project['img'], $project['vid'], $project['mode'], $project['goal']);
        ?>
        
<!--     
<table>
  <tr>
      <th colspan="2">
          <h1>Voiture Solaire</h1>
          <h2>Un projet de design et techologie par Nicolas Huchon</h2>
          
      </th>
      <th>
          <h3>Objectif : 1500 €</h3>
      </th>
  </tr>
  <tr>
      <td colspan="3" style="text-align: center">
          <br>
          <img src="https://www.ecosources.info/images/energie_transport/voiture_solaire_Eclectic.jpg" width="500" height="500" alt="Image Projet" style="display: inline-block"/>
          <br>
          <h3>Quam ob rem id primum videamus, si placet, quatenus amor 
                        in amicitia progredi debeat. Numne, si Coriolanus habuit
                        amicos, ferre contra patriam arma illi cum Coriolano
                        debuerunt? num Vecellinum amici regnum adpetentem,
                        num Maelium debuerunt iuvare?
                    </h3>
          <br>
                    <iframe width="720" height="480" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                    </iframe> 
      </td>
  </tr>
</table> 
    -->    

      <div class="footer">
        <p>&copy; Projector</p>
      </div>

    </div> <!-- /container -->

    <script src="static/jquery/jquery-1.11.3.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
    
  </body>
</html>
