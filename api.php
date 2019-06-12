


<?php

//header('Content-type: application/json'); 
//var_dump($_SERVER);
//header('Content-Type: application/json');
//$negotiator = new \Negotiation\Negotiator();
require_once "vendor/autoload.php";
include 'classes/ProjectorAPI.php';
include 'classes/StatAPI.php';
include 'classes/Project.php';

$acceptHeader = $_SERVER['HTTP_ACCEPT'];
//var_dump($acceptHeader);
$negotiator = new \Negotiation\Negotiator();

$priorities = array('application/json', 'application/xml', 'text/html');

$mediaType = $negotiator->getBest($acceptHeader, $priorities);



//$value = $mediaType->getValue();
// $value == 'text/html; charset=UTF-8'

if ($mediaType == null) {
    echo "Negociation Failed";
    exit();
} else {
    $format = $mediaType->getValue();
    header('Content-type: ' . $mediaType->getValue());
    //echo "$format";
    //exit();  
}


$ProjectorApi = new ProjectorAPI();
$StatApi = new StatAPI();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        if (preg_match('/LO10\/api\/project($|\?.*|\/)/', $_SERVER['REQUEST_URI']) == 1 && !preg_match('/LO10\/api\/project\/\b\d+\b/', $_SERVER['REQUEST_URI']) == 1) {
            echo $ProjectorApi->GET_ALL($format);
        } elseif (preg_match('/LO10\/api\/project\/\b\d+\b/', $_SERVER['REQUEST_URI']) == 1) {
            $tab = explode("/", $_SERVER['REQUEST_URI']);
            $project_id = $tab[4];
        echo $ProjectorApi->GET($project_id, $format);
        }
        elseif (preg_match('/LO10\/api\/stats/', $_SERVER['REQUEST_URI']) == 1) {
            var_dump(parse_str(parse_url ( $_SERVER['REQUEST_URI'], PHP_URL_QUERY ),$querry_array));
            if (array_key_exists ( "cat" , $querry_array)){
                echo $StatApi->GET($format,$querry_array['cat'] , 0.0, 0.0, 0.0);
            }else{
                echo $StatApi->GET($format,"" , 0.0, 0.0, 0.0);
            }
            
        } else {
            $result["succes"] = false;
            $result["message"] = "Requette inconnue";
            if ($format == 'application/json') {
                echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            } elseif ($format == 'application/xml') {
                echo $ProjectorApi->xml_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            }
        }

        break;
    case 'POST':
        if ($_SERVER['REQUEST_URI'] == '/LO10/api/project' || $_SERVER['REQUEST_URI'] == '/LO10/api/project/') {

            //var_dump($_POST);

            if (!empty($_POST['owner']) && !empty($_POST['name']) && !empty($_POST['cat']) && !empty($_POST['des']) && !empty($_POST['place']) && !empty($_POST['img']) && !empty($_POST['vid']) && !empty($_POST['mode']) && intval(($_POST['goal']) > 0) && !empty($_POST['lon']) && !empty($_POST['lat']) && intval(($_POST['fund']) >= 0)) {
                $newProject = new Project($_POST['owner'], $_POST['name'], $_POST['cat'], $_POST['des'], $_POST['place'], $_POST['img'], $_POST['vid'], $_POST['mode'], $_POST['goal'], $_POST['lon'], $_POST['lat'], $_POST['fund']);
                echo $ProjectorApi->POST($newProject, $format);
            } else {
                $result["succes"] = false;
                $result["message"] = "Impossible d'ajouter le projet, parametre(s) manquants";
                if ($format == 'application/json') {
                    echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
                } elseif ($format == 'application/xml') {
                    echo $ProjectorApi->xml_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
                }
            }
        }
    case 'PUT':
        parse_str(file_get_contents("php://input"), $post_vars);
        //var_dump($post_vars);

        if (preg_match('/LO10\/api\/project\/\b\d+\b/', $_SERVER['REQUEST_URI']) == 1) {
            if (!empty($post_vars['owner']) && !empty($post_vars['name']) && !empty($post_vars['cat']) && !empty($post_vars['des']) && !empty($post_vars['place']) && !empty($post_vars['img']) && !empty($post_vars['vid']) && !empty($post_vars['mode']) && intval(($post_vars['goal']) > 0) && !empty($post_vars['lon']) && !empty($post_vars['lat']) && intval(($post_vars['fund']) >= 0)) {

                $user = 'root';
                $password = '';
                $dataSourceName = 'mysql:host=localhost;dbname=test1';
                try {
                    $api_pdo = new PDO($dataSourceName, $user, $password, array('charset' => 'utf8'));
                    //$api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $api_pdo->query("SET CHARACTER SET utf8");
                    $api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $api_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    $result["succes"] = true;
                    $result["message"] = "Connexion à la Base de donnée réussie";
                } catch (Exception $ex) {
                    //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                    //die ("Erreur ! " . $ex->getMessage());
                    $result["succes"] = false;
                    $result["message"] = "Connexion à la Base de donnée impossible";
                }

                $tab = explode("/", $_SERVER['REQUEST_URI']);
                $project_id = $tab[5];
                var_dump($project_id);
                $requetteUpdateProjet = $api_pdo->prepare("UPDATE `project_table` SET`owner`=:owner,`name`=:name,`cat`=:cat,`description`=:des,`place`=:place,`img`=:img,`vid`=:vid,`mode`=:mode,`goal`=:goal,`longitude`=:lon,`latitude`=:lat,`fund`=:fund WHERE `id`=:integer");
                $requetteUpdateProjet->bindParam(':integer', $project_id);
                $requetteUpdateProjet->bindParam(':owner', $post_vars['owner'], PDO::PARAM_STR, 32);
                $requetteUpdateProjet->bindParam(':name', $post_vars['name'], PDO::PARAM_STR, 50);
                $requetteUpdateProjet->bindParam(':cat', $post_vars['cat'], PDO::PARAM_STR, 50);
                $requetteUpdateProjet->bindParam(':des', $post_vars['des'], PDO::PARAM_STR, 280);
                $requetteUpdateProjet->bindParam(':place', $post_vars['place'], PDO::PARAM_STR, 100);
                $requetteUpdateProjet->bindParam(':img', $post_vars['img'], PDO::PARAM_STR, 280);
                $requetteUpdateProjet->bindParam(':vid', $post_vars['vid'], PDO::PARAM_STR, 280);
                $requetteUpdateProjet->bindParam(':mode', $post_vars['mode'], PDO::PARAM_STR, 50);
                $requetteUpdateProjet->bindParam(':goal', strval($post_vars['goal']), PDO::PARAM_STR, 50);
                $requetteUpdateProjet->bindParam(':lon', strval($post_vars['lon']), PDO::PARAM_STR, 50);
                $requetteUpdateProjet->bindParam(':lat', strval($post_vars['lat']), PDO::PARAM_STR, 50);
                $requetteUpdateProjet->bindParam(':fund', strval($post_vars['fund']), PDO::PARAM_STR, 50);
                $requetteUpdateProjet->execute();
                //var_dump($requetteUpdateProjet->execute());


                $count = $requetteUpdateProjet->rowCount();
                //var_dump($count);

                $result["succes"] = true;
                $result["message"] = "Le projet à bien été mis à jour";

                echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            }
        } else {
            $result["succes"] = false;
            $result["message"] = "Impossible de mettre à jour le projet, parametre(s) manquants";
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
        }

        break;

    case 'DELETE':

        if (preg_match('/LO10\/api\/project\/\b\d+\b/', $_SERVER['REQUEST_URI']) == 1) {

            $tab = explode("/", $_SERVER['REQUEST_URI']);
            $project_id = $tab[4];
            echo $ProjectorApi->DELETE($project_id, $format);
        } else {
             if ($format == 'application/json') {
                echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            } elseif ($format == 'application/xml') {
                echo $ProjectorApi->xml_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            }
        }
        break;

    default :
        $result["succes"] = false;
        $result["message"] = "Verbe Inconnu";
        break;
}