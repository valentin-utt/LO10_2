<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projector</title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
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
    <!-- <script src="static/jquery/jquery-1.11.3.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script> -->
      
       <?php
       session_start();
        ?>

    <div class="container">
        <h1 style="text-align: center">Projector</h1>
      <div class="header" style="margin-bottom: 50px">
        <ul class="nav nav-pills pull-right">
          <li id="homebtn" ><a href="./index">Accueil</a></li>
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
              
              echo '<li id="connectbtn" class="active"><a href="./connect">Se connecter</a></li>';
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
          <form action="./index.php" method="post" id="connect_form" name="connect_form" onsubmit="return inputValidation()">

              <div class="form-group">
                <label for="user_email">Email : </label>
                <input  class="form-control" id="user_email" type="text" name="user_email" value="mio@utt.fr">
                </br>
            </div>

          <div class="form-group">
                <label for="user_password">Mot de Passe : </label>
                <input  class="form-control" id="user_password" type="password" name="user_password" value="secret">
          </br>
          </div>
           
              
            <input hidden id="user_connection_attempt" type="password" name="user_connection_attempt" value="true">
            <div style="text-align: center">
                <input type="submit" class="btn btn-default" value="Se connecter">
            </div>
            
          </form>
      </div>


      <div class="footer">
        <p>&copy; Projector</p>
      </div>

    </div> <!-- /container -->


    
  </body>
</html>
