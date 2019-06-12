<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Projector</title>
        <script src="static/jquery/jquery-1.11.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="static/bootstrap/css/theme/flatly/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="static/bootstrap/css/jumbotron-narrow.css" rel="stylesheet">
        <style>
            .content_container {
                overflow: hidden;
            }
            #likeButtonParent.act{
                background-color: #18bc9c;
            }
            .main-bar {
                float: left;
                width: 70%;
            }
            .side-bar {
                float: right;
                width: 30%;
                background: black;
            }
        </style>
        
        <script>
            $(document).ready(function () {

                var projectId = $("#projectId").attr("value"); // postmember
                var userId = $("#userId").attr("value"); // likeid

                $(".btn-group-toggle").click(function () {
                    $("#likeButtonParent").toggleClass('act');

                    if ($('#likeButtonParent').hasClass("act")) {
                        var addLike = 'addLike';
                        $.ajax({
                            type: "post",
                            data: "action=" + addLike + "&userId=" + userId + "&projectId=" + projectId,
                            url: './modifyLike.php',
                            success: function () {

                            }
                        });
                    } else {
                        var removeLike = 'removeLike';
                        $.ajax({
                            type: "post",
                            data: "action=" + removeLike + "&userId=" + userId + "&projectId=" + projectId,
                            url: './modifyLike.php',
                            success: function () {


                            }
                        });
                    }
                });
            });
        </script>    

 


    </head>

    <body>

        <?php
        session_start();
        if (!isset($_GET['p'])) {
            $_GET['p'] = '40';
        }
        //var_dump($_POST);
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
                    <li id="aboutbtn" ><a href="./about">A propos</a></li>
                </ul>
                <ul class="nav nav-pills pull-right">
                    <?php
                    if (isset($_POST['user_connected'])) {
                        session_start();
                        $_SESSION['is_connected'] = 'true';
                        echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
                    } elseif (isset($_SESSION['is_connected']) || isset($_SESSION['access_token'])) {
                        echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>';
                        echo '<li id="connectbtn"><a href="./disconnect">Se déconnecter</a></li>';
                        echo '<li id="profil" ><a href="./profile">Profil</a></li>';
                    } else {

                        echo '<li id="connectbtn"><a href="http://etu.utt.fr/api/oauth/authorize?client_id=24048099025&scope=public%20private_user_account&response_type=code&state=xyz">Se connecter</a></li>';
                    }
                    ?>
                </ul>
                <div class="header" style="margin-bottom: 40px">
                    <ul class="nav nav-pills pull-left">
                        <?php
                        if (isset($_POST['user_connected'])) {
                            echo '<li id="addProject" ><a href="./addProject">Ajouter un projet</a></li>';
                        } elseif (isset($_SESSION['is_connected']) || isset($_SESSION['access_token'])) {
                            
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <?php
            include 'PDOConnect.php';
            include 'functions.php';
            include 'classes/RDSHandler.php';
            $RDSHandler = new RDSHandler();
            $project = $RDSHandler->getProjectById($RDSHandler->getBase(), $_GET['p'])[0];
            $pseudo = $RDSHandler->getProjectOwnerNamebyEmail($RDSHandler->getBase(), $project['owner'])[0]['pseudo'];
            $chef = getUserbyEmail($base, $project['owner'])[0];
            if (isset($_SESSION['access_token'])) {
                $CurrentUser = $RDSHandler->getUserbyToken($RDSHandler->getBase(), $_SESSION['access_token'])[0];
                $liked = $RDSHandler->ProjectLikedByUser($RDSHandler->getBase(), $project['id'], $CurrentUser['id']);
                //var_dump($liked);
                $user_id = $CurrentUser['id'];
            } else {
                $liked = "notConnected";
                $user_id = "none";
            }
            if (isset($_POST['montant'])) {
                $fund = $_POST['montant'];
                $project_id = $_POST['projectId'];
                $RDSHandler = new RDSHandler();
                $token = $_SESSION['access_token'];
                $CurrentUser = $RDSHandler->getUserbyToken($RDSHandler->getBase(), $token);
                $user_id = $CurrentUser[0]['id'];
                $RDSHandler->addFundToProjectFromUser($RDSHandler->getBase(), $user_id, $project_id, $fund);
                $project['fund'] = $RDSHandler->getProjectById($RDSHandler->getBase(), $_GET['p'])[0]['fund'];
            }
            generateProjectView($project['id'], $project['name'], $pseudo, $project['cat'], $project['place'], $project['description'], $project['img'], $project['vid'], $project['mode'], $project['goal'], $chef, $liked, $user_id, $project['fund']);
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
