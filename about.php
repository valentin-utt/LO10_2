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
        ?>

    <div class="container">
        <div style="overflow: hidden;">
            <img style="float: left" src="./projector.jpg" alt="Projector logo">
            <h1 style="text-align: center; padding: 40px">Projector</h1>
         </div>
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-left">
          <li id="homebtn" ><a href="./index">Accueil</a></li>
          <li id="catbtn"><a href="./categories?c=art">Projets</a></li>

          <li id="aboutbtn" class="active"><a href="./about">A propos</a></li>
            <?php
            if(isset($_SESSION['access_token'])){
                
            }
            ?>
          
          </ul>
        <ul class="nav nav-pills pull-right">
                    <?php
          
          if(isset($_POST['user_connected'])){
              session_start();
              $_SESSION['is_connected']='true';
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }elseif( isset($_SESSION['is_connected']) || isset($_SESSION['access_token'] ) ){
              echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>'; 
              echo '<li id="profil" ><a href="./profile">Profil</a></li>';
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }else{
              
              echo '<li id="connectbtn"><a href="http://etu.utt.fr/api/oauth/authorize?client_id=24048099025&scope=public%20private_user_account&response_type=code&state=xyz">Se connecter</a></li>';
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
      <div class="jumbotron">
          <p>La base légale de projector.net est l’article 6.1.a du règlement européen en matière de protection des données personnelles (consentement). </p>
          <p>les destinataires ou les catégories de destinataires des données à caractère personnel sont projector SARL. </p>
          <p>les destinataires de données sont le responsable de traitement, ses services internes en charge de la gestion de la mailing list, le sous-traitant opérant la gestion du serveur web (AmazonWebServices), ainsi que toute personne légalement autorisée à accéder aux données (services judiciaires, le cas échéant). </p>
          <p>La durée de traitement des données est limité au temps pendant lequel vous êtes inscrit à nos services de communication, étant entendu que vous pouvez vous y désinscrire à tout moment.</p>
          <p>Le responsable du traitement est la SARL projector ( 6 rue Marie Curie, 1000 Troyes, contact@projector.net)

Vous disposez du droit de demander au responsable du traitement l’accès aux données à caractère personnel, la rectification ou l’effacement de celles-ci, ou une limitation du traitement relatif à la personne concernée, ou du droit de s’opposer au traitement et du droit à la portabilité des données.  

Vous avez également le droit d’introduire une réclamation auprès d’une autorité de contrôle.</p>
      </div>


      <div class="footer">
        <p>&copy; Projector</p>
      </div>

    </div> <!-- /container -->

    <script src="static/jquery/jquery-1.11.3.min.js"</script>
    <script src="static/bootstrap/js/bootstrap.min.js"</script>

  </body>
</html>
