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
       //var_dump($_GET);
       //var_dump($_POST);
       //var_dump($_SESSION);
        ?>
      
    <div class="container">
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-right">
          <li id="homebtn" ><a href="./index">Acceuil</a></li>
          <li id="catbtn" class="active"><a href="./categories">Projets</a></li>
          <li id="aboutbtn"><a href="./about">A propos</a></li>
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
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-left">
            <?php
            if($_GET['c']==='art'){
            echo <<<EXCERPT
          <li id="artCat" class="active" ><a href="./categories.php?c=art">Art</a></li>
          <li id="techCat"><a href="./categories.php?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories.php?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories.php?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories.php?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories.php?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories.php?c=edition">Edition</a></li>
EXCERPT;
            }elseif($_GET['c']==='design_tech'){
                echo <<<EXCERPT
          <li id="artCat"  ><a href="./categories.php?c=art">Art</a></li>
          <li id="techCat" class="active"><a href="./categories.php?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories.php?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories.php?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories.php?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories.php?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories.php?c=edition">Edition</a></li>
EXCERPT;
                
            }elseif($_GET['c']==='cinema'){
                echo <<<EXCERPT
          <li id="artCat"  ><a href="./categories.php?c=art">Art</a></li>
          <li id="techCat"><a href="./categories.php?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat" class="active"><a href="./categories.php?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories.php?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories.php?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories.php?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories.php?c=edition">Edition</a></li>
EXCERPT;
                
            }elseif($_GET['c']==='food'){
                echo <<<EXCERPT
          <li id="artCat" ><a href="./categories.php?c=art">Art</a></li>
          <li id="techCat"><a href="./categories.php?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories.php?c=cinema">Cinema</a></li>
          <li id="foodCat" class="active"><a href="./categories.php?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories.php?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories.php?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories.php?c=edition">Edition</a></li>
EXCERPT;
                
            }elseif($_GET['c']==='game'){
                echo <<<EXCERPT
          <li id="artCat"><a href="./categories.php?c=art">Art</a></li>
          <li id="techCat"><a href="./categories.php?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories.php?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories.php?c=food">Gastronomie</a></li>
          <li id="gameCat" class="active"><a href="./categories.php?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories.php?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories.php?c=edition">Edition</a></li>
EXCERPT;
                
            }elseif($_GET['c']==='music'){
                echo <<<EXCERPT
          <li id="artCat"  ><a href="./categories.php?c=art">Art</a></li>
          <li id="techCat"><a href="./categories.php?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories.php?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories.php?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories.php?c=game">Jeux</a></li>
          <li id="musicCat" class="active"><a href="./categories.php?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories.php?c=edition">Edition</a></li>
EXCERPT;
                
            }elseif($_GET['c']==='edition'){
                echo <<<EXCERPT
          <li id="artCat" ><a href="./categories.php?c=art">Art</a></li>
          <li id="techCat"><a href="./categories.php?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories.php?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories.php?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories.php?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories.php?c=music">Musique</a></li>
          <li id="editionCat" class="active"><a href="./categories.php?c=edition">Edition</a></li>
EXCERPT;
                
            }
                  ?>
        </ul>
      </div>
        
        <?php
            include 'PDOConnect.php';
            include 'functions.php';
           
            //mp(listProjectByCat($base, $_GET['c']));
            foreach (listProjectByCat($base, $_GET['c']) as $project) {
                $pseudo = getProjectOwnerNamebyEmail($base, $project['owner'])[0]['pseudo'];
                generatePojectListViewItem($project, $pseudo);
                //var_dump($pseudo);
            }
        ?>
        



      <div class="footer">
        <p>&copy; Projector</p>
      </div>

      <!-- Modal -->
       <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>
             <div class="modal-body">
               <form id="signupForm" role="form">
                 <input type="hidden" id="theme" name="theme" value="<%= theme %>"/>
                 <div class="form-group">
                   <label for="name">Pseudo</label>
                   <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                 </div>
                 <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="Your email address">
                 </div>
                 <div class="form-group">
                   <label for="password">password</label>
                   <input type="password" class="form-control" id="password" name="password" placeholder="password">
                   </select>
                 </div>


                 <div class="form-group">
                   <label for="previewAccess">étudiant ?</label>
                   <select class="form-control" name="previewAccess">
                     <option>Oui</option>
                     <option>Non</option>
                   </select>
                 </div>
             </div>
             <div class="modal-footer">
               <button id="signup" type="button" class="btn btn-primary">S'inscrire</button>
             </div>
           </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
       </div><!-- /.modal -->

    </div> <!-- /container -->

    <script src=static/jquery/jquery-1.11.3.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
    
  </body>
</html>