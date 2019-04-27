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
             session_destroy();
        ?>

    <div class="container">
        <h1 style="text-align: center">Projector</h1>
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-right">
          <li id="homebtn" ><a href="./index">Accueil</a></li>
          <li id="catbtn"><a href="./categories?c=art">Projets</a></li>
          <li id="aboutbtn"><a href="./about">A propos</a></li>
           <li id="connectbtn"><a href="./connect">Se connecter</a></li>
        </ul>
        <div class="header" style="margin-bottom: 40px">
        <ul class="nav nav-pills pull-left">
                      <?php
            if(isset($_POST['user_connected'])){
                //echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>';
            }elseif(isset($_SESSION['is_connected'])){
                //echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>';
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
          <p>Vous vous êtes bien déconnecté</p>
      </div>


      <div class="footer">
        <p>&copy; Projector</p>
      </div>

    </div> <!-- /container -->

    <script src="static/jquery/jquery-1.11.3.min.js"</script>
    <script src="static/bootstrap/js/bootstrap.min.js"</script>
    
  </body>
</html>
