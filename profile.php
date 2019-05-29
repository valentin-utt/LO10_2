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

    <style>
    .catbox-container {
        display: flex;
        flex-wrap: wrap;
        
    }

    .catbox {
        flex: 0 0 23%;
        margin: 10px;
        padding: 10px;
        
    }

    * {
        margin: 0;
        box-sizing: border-box;
    }
    </style>

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
          </ul>
        <ul class="nav nav-pills pull-right">
                    <?php
          
          if(isset($_POST['user_connected'])){
              session_start();
              $_SESSION['is_connected']='true';
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }elseif( isset($_SESSION['is_connected']) || isset($_SESSION['access_token'] ) ){
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

      <?php
        include 'PDOConnect.php';
        include 'functions.php';
        
        $CurrentUser = getUserbyToken($base,$_SESSION['access_token'])[0];
        //var_dump($CurrentUser);
        $ue_table=getUEByUserId($base, $CurrentUser['id']);
        //var_dump($ue_table);
        $project_table=getProjectsTableByOwner($base,$CurrentUser['email']);
        //var_dump($project_table);
        
        
         generateProfileView($CurrentUser['img_url'],$CurrentUser['pseudo'],$CurrentUser['branch'],$CurrentUser['level'],$CurrentUser['speciality'], $project_table, $ue_table );
      
      ?>
        
      


      <div class="footer">
        <p>&copy; Projector</p>
      </div>

    </div> <!-- /container -->

    <script src="static/jquery/jquery-1.11.3.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>
