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
    var email = document.forms["register_form"]["user_email"];  
    var password = document.forms["register_form"]["user_password"]; 
    
    var name_regex =/[a-zA-Z][a-zA-Z0-9-_]{3,32}/;
    var email_regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
 
   
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
    <script src="static/jquery/jquery-1.11.3.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
      
       <?php
       session_start();
        ?>

    <div class="container">
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-right">
          <li id="homebtn" ><a href="./index">Acceuil</a></li>
          <li id="catbtn"><a href="./categories?c=art">Projets</a></li>
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
          <form action="./index.php" method="post" id="connect_form" name="connect_form" onsubmit="return inputValidation()">


            <label for="user_email">Email : </label>
          <input id="user_email" type="text" name="user_email" value="mio@utt.fr">
          </br>
          
          <label for="user_password">Password</label>
          <input id="user_password" type="password" name="user_password" value="secret">
          </br>
            
          <input hidden id="user_connection_attempt" type="password" name="user_connection_attempt" value="true">
          
          <input type="submit" value="OK">
          </form>
      </div>


      <div class="footer">
        <p>&copy; Projector</p>
      </div>

    </div> <!-- /container -->


    
  </body>
</html>
