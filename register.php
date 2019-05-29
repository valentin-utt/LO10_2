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
        //alert("executed");
    var name = document.forms["register_form"]["user_name_field"];
    var email = document.forms["register_form"]["user_email"];  
    var password = document.forms["register_form"]["user_password"]; 
    
    var name_regex =/[a-zA-Z][a-zA-Z0-9-_]{3,32}/;
    var email_regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
 
   
    /*if (name.value.match(/[a-zA-Z][a-zA-Z0-9-_]{3,32}/gi) === false)                                  
    { 
        window.alert("Votre nom ne peux contenir que 3 à 32 des caractères alpha-numériques"); 
        name.focus(); 
        return false; 
    } */
   
    if (name_regex.test(name.value) === false)                                  
    { 
        window.alert("Votre nom ne peux contenir que 3 à 32 des caractères alphanumériques"); 
        name.focus(); 
        return false; 
    } 
    if (email_regex.test(email.value) === false)                               
    { 
        window.alert("Adresse email invalide"); 
        email.focus(); 
        return false; 
    } 
       
    if (name_regex.test(password.value) === false)                                   
    { 
        window.alert("Votre mot de passe ne peux contenir que 3 à 32 caractères alphanumériques"); 
        password.focus(); 
        return false; 
    }  
    return true;
    }  
    </script>

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
        <ul class="nav nav-pills pull-right">
          <li id="homebtn" ><a href="./index">Accueil</a></li>
          <li id="catbtn"><a href="./categories?c=art">Projets</a></li>
          <li id="aboutbtn" ><a href="./about">A propos</a></li>
          </ul>
        <ul class="nav nav-pills pull-right">
                     <?php
          
          if(isset($_POST['user_connected'])){
              
              $_SESSION['is_connected']='true';
              echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
          }elseif(isset($_SESSION['is_connected']) || isset($_SESSION['access_token'] ) ){
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
      <div style="margin-bottom: 50px">
          <form action="./index.php" name="register_form" onsubmit="return inputValidation()" method="post" id="register_form">

          <div class="form-group">
            <label for="user_name">Nom : </label>
            <input class="form-control" id="user_name" type="text" name="user_name_field" value="Mio">
            </br>
          </div>

          <div class="form-group">
            <label for="user_email">Email : </label>
          <input class="form-control" id="user_email" type="text" name="user_email" value="mio@utt.fr">
          </br>
          </div>
          
              <div class="form-group">
                <label for="user_password">Mot de Passe :</label>
                <input class="form-control" id="user_password" type="password" name="user_password" value="secret">
                </br>
              </div>
            
          <label for="is_user_student" style="text-align: center;margin-bottom: 20px" >Etudiant : </label>
          <select id="is_user_student" name="is_user_student" form="register_form">
            <option value="yes">Oui</option>
            <option value="no">Non</option>
          </select>
          </br>

          <div style="text-align: center">
            <input   class="btn btn-default" type="submit" value="Se connecter">
          </div>
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
