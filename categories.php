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
            .give-button{
                position: relative;
                padding: 5px;
                margin: 20px;
                left: 40px;

            }

        </style>


    </head>

    <body>

        <?php
        session_start();
        if (!isset($_GET['c'])) {
            $_GET['c'] = 'art';
        }
        ?>


        <div class="container">
            <div style="overflow: hidden;">
                <img style="float: left" src="./projector.jpg" alt="Projector logo">
                <h1 style="text-align: center; padding: 40px">Projector</h1>
            </div>
            <div class="header" style="margin-bottom: 50px">
                <ul class="nav nav-pills pull-left">
                    <li id="homebtn" ><a href="./index">Accueil</a></li>
                    <li id="catbtn" class="active"><a href="./categories?c=art">Projets</a></li>
                    <li id="aboutbtn"><a href="./about">A propos</a></li>
                </ul>
                <ul class="nav nav-pills pull-right">
<?php
if (isset($_POST['user_connected'])) {
    session_start();
    $_SESSION['is_connected'] = 'true';
    echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
} elseif (isset($_SESSION['is_connected']) || isset($_SESSION['access_token'])) {
      echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>';
    echo '<li id="profil" ><a href="./profile">Profil</a></li>';
    echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
} else {

    echo '<li id="connectbtn"><a href="http://etu.utt.fr/api/oauth/authorize?client_id=24048099025&scope=public%20private_user_account&response_type=code&state=xyz">Se connecter</a></li>';
}
?>
                </ul>
                <div class="header" style="margin-bottom: 40px">
                    <ul class="nav nav-pills pull-left">
                    </ul>
                </div>
            </div>
            <div class="header" style="margin-bottom: 0px">
                <ul class="nav nav-pills nav-justified">
<?php
if ($_GET['c'] === 'art') {
    echo <<<EXCERPT
          <li id="artCat" class="active" ><a href="./categories?c=art">Art</a></li>
          <li id="techCat"><a href="./categories?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories?c=edition">Edition</a></li>
EXCERPT;
} elseif ($_GET['c'] === 'design_tech') {
    echo <<<EXCERPT
          <li id="artCat"  ><a href="./categories?c=art">Art</a></li>
          <li id="techCat" class="active"><a href="./categories?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories?c=edition">Edition</a></li>
EXCERPT;
} elseif ($_GET['c'] === 'cinema') {
    echo <<<EXCERPT
          <li id="artCat"  ><a href="./categories?c=art">Art</a></li>
          <li id="techCat"><a href="./categories?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat" class="active"><a href="./categories?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories?c=edition">Edition</a></li>
EXCERPT;
} elseif ($_GET['c'] === 'food') {
    echo <<<EXCERPT
          <li id="artCat" ><a href="./categories?c=art">Art</a></li>
          <li id="techCat"><a href="./categories?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories?c=cinema">Cinema</a></li>
          <li id="foodCat" class="active"><a href="./categories?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories?c=edition">Edition</a></li>
EXCERPT;
} elseif ($_GET['c'] === 'game') {
    echo <<<EXCERPT
          <li id="artCat"><a href="./categories?c=art">Art</a></li>
          <li id="techCat"><a href="./categories?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories?c=food">Gastronomie</a></li>
          <li id="gameCat" class="active"><a href="./categories?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories?c=edition">Edition</a></li>
EXCERPT;
} elseif ($_GET['c'] === 'music') {
    echo <<<EXCERPT
          <li id="artCat"  ><a href="./categories?c=art">Art</a></li>
          <li id="techCat"><a href="./categories?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories?c=game">Jeux</a></li>
          <li id="musicCat" class="active"><a href="./categories?c=music">Musique</a></li>
          <li id="editionCat"><a href="./categories?c=edition">Edition</a></li>
EXCERPT;
} elseif ($_GET['c'] === 'edition') {
    echo <<<EXCERPT
          <li id="artCat" ><a href="./categories?c=art">Art</a></li>
          <li id="techCat"><a href="./categories?c=design_tech">Design et Technologies</a></li>
          <li id="cinemaCat"><a href="./categories?c=cinema">Cinema</a></li>
          <li id="foodCat"><a href="./categories?c=food">Gastronomie</a></li>
          <li id="gameCat"><a href="./categories?c=game">Jeux</a></li>
          <li id="musicCat"><a href="./categories?c=music">Musique</a></li>
          <li id="editionCat" class="active"><a href="./categories?c=edition">Edition</a></li>
EXCERPT;
}
?>
                </ul>
            </div>
            <div >
                <div>
                    <?php
                    include 'PDOConnect.php';
                    include 'functions.php';
                    include 'classes/RDSHandler.php';
                    if (isset($_POST['montant'])) {
                        $fund = $_POST['montant'];
                        $project_id = $_POST['projectId'];
                        $RDSHandler = new RDSHandler();
                        $token = $_SESSION['access_token'];
                        $CurrentUser = $RDSHandler->getUserbyToken($RDSHandler->getBase(), $token);
                        $user_id = $CurrentUser[0]['id'];
                        $RDSHandler->addFundToProjectFromUser($RDSHandler->getBase(), $user_id, $project_id, $fund);
                    }
                    foreach (listProjectByCat($base, $_GET['c']) as $project) {
                        $pseudo = getProjectOwnerNamebyEmail($base, $project['owner'])[0]['pseudo'];
                        $user_id = getProjectOwnerNamebyEmail($base, $project['owner'])[0]['id'];

                        if (!isset($_SESSION['access_token'])) {
                            generateProjectListViewItem2($project, $pseudo);
                        } else {
                            generateProjectListViewItem2WithButton($project, $pseudo, $user_id);
                        }
                    }
                    ?>
                </div>



            </div>





            <div class="footer">
                <p>&copy; Projector</p>
            </div>



        </div> <!-- /container -->

        <script src="static/jquery/jquery-1.11.3.min.js"></script>
        <script src="static/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>
