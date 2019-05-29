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
    
    <script> 
    function inputValidation() 
    { 
    var name = document.forms["project_form"]["name_field"];  
    var description = document.forms["project_form"]["des_field"]; 
    var image = document.forms["project_form"]["image_field"];
    var video = document.forms["project_form"]["video_field"];
    var goal = document.forms["project_form"]["goal_field"];
    
    var name_regex =/[a-zA-Z][a-zA-Z0-9-_]{3,32}/;
    var des_regex =/[a-zA-Z][a-zA-Z0-9-_]{3,280}/;
    var yt_regex = /(?:https?:\/\/)?(?:(?:(?:www\.?)?youtube\.com(?:\/(?:(?:watch\?.*?(v=[^&\s]+).*)|(?:v(\/.*))|(channel\/.+)|(?:user\/(.+))|(?:results\?(search_query=.+))))?)|(?:youtu\.be(\/.*)?))/;
    var img_regex = /(?:(?:https?:\/\/))[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,4}\b(?:[-a-zA-Z0-9@:%_\+.~#?&\/=]*(\.jpg|\.png|\.jpeg))/;
    var goal_regex = /[^a-z ]\ *([.0-9])*\d/;
       
    if (name_regex.test(name.value) === false)                                   
    { 
        window.alert("Votre titre ne peux contenir que 4 à 32 caractères alphanumériques"); 
        name.focus(); 
        return false; 
    }
    if (des_regex.test(description.value) === false)                                   
    { 
        window.alert("Votre description ne peux contenir que 4 à 32 caractères alphanumériques"); 
        description.focus(); 
        return false; 
    }
    if (img_regex.test(image.value) === false)                                   
    { 
        window.alert("Uri de l'image invalide"); 
        image.focus(); 
        return false; 
    } 
    if (yt_regex.test(video.value) === false)                                   
    { 
        window.alert("Uri de la video Youtube invalide"); 
        video.focus(); 
        return false; 
    }
    if (goal_regex.test(goal.value) === false || goal.value<=0)                                   
    { 
        window.alert("Montant du financement invalide"); 
        goal.focus(); 
        return false; 
    } 
    return true;
    }  

</script>



  </head>

  <body>
      
       <?php 
       session_start();
       //var_dump($_POST);
       //var_dump($_SESSION);
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
          <li id="aboutbtn"><a href="./about">A propos</a></li>
          </ul>
        <ul class="nav nav-pills pull-right">
                    <?php
          
          if(isset($_POST['user_connected'])){
              session_start();
              $_SESSION['is_connected']='true';
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }elseif(isset($_SESSION['is_connected']) || isset($_SESSION['access_token']) ){
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
                echo '<li id="addProject" class="active" ><a href="./addProject">Ajouter un projet</a></li>';
            }elseif(isset($_SESSION['is_connected'])){
                echo '<li id="addProject" class="active"><a href="./addProject">Ajouter un projet</a></li>';
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
        <div style="text-align: left;font-size: 14px;margin-bottom: 40px ">
          <form action="./project_added" method="post" id="project_form" name="project_form" onsubmit="return inputValidation()">

          <div class="form-group">
            <label for="project_name">Nom du projet : </label>
            <input size="34" id="project_name" class="form-control" type="text" name="name_field" value="Voiture solaire">
            </br>
            </br>
           </div>

          <div class="form-group">  
          <label for="project_cat">Categorie : </label>
          <select id="catlist" name="catlist" form="project_form">
            <option value="art">Art</option>
            <option value="design_tech">Design et Technologie</option>
            <option value="cinema">Cinema</option>
            <option value="food">Gastronomie</option>
            <option value="game">Jeux</option>
            <option value="music">Musique</option>
            <option value="edition">Edition</option>
          </select>
          </br>
          </br>
          </div>

          <div class="form-group">
            <label for="project_des">Description (300 caractères minimum) : </label>
            <textarea id="project_des" class="form-control" rows="7" cols="80" name="des_field" form="project_form">Entrez votre description ici...</textarea>
            </br>
            </br>
          </div>

          
          
        <div class="form-group">
          <label for="project_place">Lieu : </label>
          <input size="34" id="project_place" type="text" class="form-control" name="place_field" value="Troyes">
          </br>
          </br>
        </div>

          <div class="form-group">
            <label for="project_img">Lien de l'image : </label>
            <input size="48" id="project_image" type="text" name="image_field" class="form-control" value="https://www.ecosources.info/images/energie_transport/voiture_solaire_Eclectic.jpg">
            </br>
            </br>
          </div>

          <div class="form-group">
            <label for="project_video">Lien vidéo Youtube :</label>
            <input size="48" id="project_video" type="text" class="form-control" name="video_field" value="https://www.youtube.com/watch?v=HecSq29L6DI">
            </br>
            </br>
          </div>

          <div class="form-group">
            <label for="project_funding"> Mode de financement : </label>
            
          </div>
         
          <div class="radio">
              <label><input  type="radio" name="project_funding" value="Cagnote" checked>Cagnote</label>
          </div>
          <div class="radio">  
            <label><input type="radio" name="project_funding" value="Forfait">Forfait</label>
          </div>
          </br>
          <div class="form-group">
            <label for="project_goal">Montant (€) : </label>
            <input class="form-control" id="project_goal" type="number" name="goal_field" value="1500">
            </br>
            </br>
          </div>

          <input class="btn btn-default" type="submit" value="Ajout du projet">
      </form>


      </div>


      <div class="footer">
        <p>&copy; Projector</p>
      </div>
    </div> <!-- /container -->

    <script src="static/jquery/jquery-1.11.3.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
    
  </body>
</html>
