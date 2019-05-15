<?php

//var_dump($_SERVER);
//header('Content-Type: application/json');
//$negotiator = new \Negotiation\Negotiator();
//require_once "vendor/autoload.php";

$acceptHeader = $_SERVER['HTTP_ACCEPT'];
//var_dump($acceptHeader);
/*
$negotiator = new \Negotiation\Negotiator();

$acceptHeader = $_SERVER['HTTP_ACCEPT'];
$priorities   = array('application/json , application/xml');

$mediaType = $negotiator->getBest($acceptHeader, $priorities);

$value = $mediaType->getType();
// $value == 'text/html; charset=UTF-8'
var_dump($value);
//header('Content-Type: '.$value);
*/
/*
$priorities   = array( 'application/json', 'application/xml');

//$mediaType = $negotiator->getBest($acceptHeader, $priorities);

//$value = $mediaType->getType();
// $value == 'text/html; charset=UTF-8'
//var_dump($value);

var_dump($_SERVER['HTTP_ACCEPT']);
*/
header('Content-type: application/json');


switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if($_SERVER['REQUEST_URI']=='/LO10/v1/api/project' || $_SERVER['REQUEST_URI']=='/LO10/v1/api/project/'){
            $user ='root';
            $password='';
            $dataSourceName='mysql:host=localhost;dbname=test1';
            try{
                $api_pdo= new PDO ($dataSourceName, $user, $password, array('charset'=>'utf8'));
                //$api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $api_pdo->query("SET CHARACTER SET utf8");
                $result["succes"]=true;
                $result["message"]="Connexion à la Base de donnée réussie";
            }
            catch (Exception $ex) {
                //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                //die ("Erreur ! " . $ex->getMessage());
                $result["succes"]=false;
                $result["message"]="Connexion à la Base de donnée impossible";
            }

            $requetteProjets = $api_pdo->prepare("Select * FROM `project_table`");
            $requetteProjets->execute();
            $response = $requetteProjets->fetchAll(PDO::FETCH_ASSOC);

            $result["succes"]=true;
            $result["message"]="Voici les projets";
            $result["results"]["nb"] = count($response);
            $result["results"]["project"] = $response;
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
        }
        elseif(preg_match('/LO10\/v1\/api\/project\/\b\d+\b/',$_SERVER['REQUEST_URI'])==1){
            $user ='root';
            $password='';
            $dataSourceName='mysql:host=localhost;dbname=test1';
            try{
                $api_pdo= new PDO ($dataSourceName, $user, $password, array('charset'=>'utf8'));
                //$api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $api_pdo->query("SET CHARACTER SET utf8");
                $result["succes"]=true;
                $result["message"]="Connexion à la Base de donnée réussie";
            }
            catch (Exception $ex) {
                //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                //die ("Erreur ! " . $ex->getMessage());
                $result["succes"]=false;
                $result["message"]="Connexion à la Base de donnée impossible";
            }
            
            $tab = explode("/",$_SERVER['REQUEST_URI']);
            $project_id=$tab[5];

            $requetteProjet = $api_pdo->prepare("Select * FROM `project_table` WHERE id=:integer");
            $requetteProjet->bindParam(':integer',$project_id);
            $requetteProjet->execute();
            $response = $requetteProjet->fetchAll(PDO::FETCH_ASSOC);

            if(count($response)==0){
                $result["succes"]=false;
                $result["message"]="Projet introuvable";
                $result["results"]["nb"] = count($response);
                $result["results"]["project"] = $response; 
            }else{
                $result["succes"]=true;
                $result["message"]="Voici le projet demandé";
                $result["results"]["nb"] = count($response);
                $result["results"]["project"] = $response;
            }
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
        }else{
            $result["succes"]=false;
            $result["message"]="Requette inconnue";
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
        }
        
    break;
    case 'POST':
        if($_SERVER['REQUEST_URI']=='/LO10/v1/api/project' || $_SERVER['REQUEST_URI']=='/LO10/v1/api/project/'){
             
             //var_dump($_POST);
             
            if(!empty($_POST['owner']) && !empty($_POST['name']) && !empty($_POST['cat']) && !empty($_POST['des']) && !empty($_POST['place']) && !empty($_POST['img']) && !empty($_POST['vid']) &&!empty($_POST['mode']) && intval(($_POST['goal'])>0) && !empty($_POST['lon']) && !empty($_POST['lat']) && intval(($_POST['fund'])>=0) ){
                $user ='root';
                $password='';
                $dataSourceName='mysql:host=localhost;dbname=test1';
                try{
                    $api_pdo= new PDO ($dataSourceName, $user, $password, array('charset'=>'utf8'));
                    //$api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $api_pdo->query("SET CHARACTER SET utf8");
                    $result["succes"]=true;
                    $result["message"]="Connexion à la Base de donnée réussie";
                }
                catch (Exception $ex) {
                    //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                    //die ("Erreur ! " . $ex->getMessage());
                    $result["succes"]=false;
                    $result["message"]="Connexion à la Base de donnée impossible";
                }
                $stmt = $api_pdo->prepare("INSERT INTO project_table VALUES (NULL,:owner,:name,:cat,:des,:place,:img,:vid,:mode,:goal,:lon,:lat,:fund)");

                 /*** bind the paramaters ***/
                $stmt->bindParam(':owner',$_POST['owner'], PDO::PARAM_STR,32);
                $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR, 50);
                $stmt->bindParam(':cat', $_POST['cat'], PDO::PARAM_STR, 50);
                $stmt->bindParam(':des', $_POST['des'], PDO::PARAM_STR, 280);
                $stmt->bindParam(':place', $_POST['place'], PDO::PARAM_STR,100);
                $stmt->bindParam(':img',$_POST['img'], PDO::PARAM_STR, 280);
                $stmt->bindParam(':vid', $_POST['vid'], PDO::PARAM_STR, 280);
                $stmt->bindParam(':mode', $_POST['mode'], PDO::PARAM_STR, 50);
                $stmt->bindParam(':goal', strval($_POST['goal']), PDO::PARAM_STR, 50);
                $stmt->bindParam(':lon', strval($_POST['lon']), PDO::PARAM_STR, 50);
                $stmt->bindParam(':lat', strval($_POST['lat']), PDO::PARAM_STR, 50);
                $stmt->bindParam(':fund', strval($_POST['fund']), PDO::PARAM_STR, 50);
   
                /*** execute the querry***/
                $stmt->execute();
                $result["succes"]=true;
                $result["message"]="Projet ajouté avec succès";
                echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            }
            else{
                $result["succes"]=false;
                $result["message"]="Impossible d'ajouter le projet, parametre(s) manquants";
                echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            }
        }
    case 'PUT':
        parse_str(file_get_contents("php://input"),$post_vars);
        //var_dump($post_vars);
        
        if(preg_match('/LO10\/v1\/api\/project\/\b\d+\b/',$_SERVER['REQUEST_URI'])==1){
            if(!empty($post_vars['owner']) && !empty($post_vars['name']) && !empty($post_vars['cat']) && !empty($post_vars['des']) && !empty($post_vars['place']) && !empty($post_vars['img']) && !empty($post_vars['vid']) &&!empty($post_vars['mode']) && intval(($post_vars['goal'])>0) && !empty($post_vars['lon']) && !empty($post_vars['lat']) && intval(($post_vars['fund'])>=0) ){

            $user ='root';
            $password='';
            $dataSourceName='mysql:host=localhost;dbname=test1';
            try{
                $api_pdo= new PDO ($dataSourceName, $user, $password, array('charset'=>'utf8'));
                //$api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $api_pdo->query("SET CHARACTER SET utf8");
                $api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $api_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $result["succes"]=true;
                $result["message"]="Connexion à la Base de donnée réussie";
            }
            catch (Exception $ex) {
                //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                //die ("Erreur ! " . $ex->getMessage());
                $result["succes"]=false;
                $result["message"]="Connexion à la Base de donnée impossible";
            }
            
            $tab = explode("/",$_SERVER['REQUEST_URI']);
            $project_id=$tab[5];
            var_dump($project_id);
            $requetteUpdateProjet = $api_pdo->prepare("UPDATE `project_table` SET`owner`=:owner,`name`=:name,`cat`=:cat,`description`=:des,`place`=:place,`img`=:img,`vid`=:vid,`mode`=:mode,`goal`=:goal,`longitude`=:lon,`latitude`=:lat,`fund`=:fund WHERE `id`=:integer");
            $requetteUpdateProjet->bindParam(':integer',$project_id);
            $requetteUpdateProjet->bindParam(':owner',$post_vars['owner'], PDO::PARAM_STR,32);
            $requetteUpdateProjet->bindParam(':name', $post_vars['name'], PDO::PARAM_STR, 50);
            $requetteUpdateProjet->bindParam(':cat',$post_vars['cat'], PDO::PARAM_STR, 50);
            $requetteUpdateProjet->bindParam(':des', $post_vars['des'], PDO::PARAM_STR, 280);
            $requetteUpdateProjet->bindParam(':place',$post_vars['place'], PDO::PARAM_STR,100);
            $requetteUpdateProjet->bindParam(':img',$post_vars['img'], PDO::PARAM_STR, 280);
            $requetteUpdateProjet->bindParam(':vid', $post_vars['vid'], PDO::PARAM_STR, 280);
            $requetteUpdateProjet->bindParam(':mode',$post_vars['mode'], PDO::PARAM_STR, 50);
            $requetteUpdateProjet->bindParam(':goal', strval($post_vars['goal']), PDO::PARAM_STR, 50);
            $requetteUpdateProjet->bindParam(':lon', strval($post_vars['lon']), PDO::PARAM_STR, 50);
            $requetteUpdateProjet->bindParam(':lat', strval($post_vars['lat']), PDO::PARAM_STR, 50);
            $requetteUpdateProjet->bindParam(':fund', strval($post_vars['fund']), PDO::PARAM_STR, 50);
            $requetteUpdateProjet->execute();
            //var_dump($requetteUpdateProjet->execute());
            
            
            $count = $requetteUpdateProjet->rowCount();
            //var_dump($count);
                
            $result["succes"]=true;
            $result["message"]="Le projet à bien été mis à jour";
            
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            }
        }
        
        else{
            $result["succes"]=false;
            $result["message"]="Impossible de mettre à jour le projet, parametre(s) manquants";
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
        }
        
    break;
    
    case 'DELETE':
        //parse_str(file_get_contents("php://input"),$post_vars);
        //var_dump($post_vars);
        if(preg_match('/LO10\/v1\/api\/project\/\b\d+\b/',$_SERVER['REQUEST_URI'])==1){
            

            $user ='root';
            $password='';
            $dataSourceName='mysql:host=localhost;dbname=test1';
            try{
                
                $api_pdo= new PDO ($dataSourceName, $user, $password, array('charset'=>'utf8'));
                //$api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $api_pdo->query("SET CHARACTER SET utf8");
                $api_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $api_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $result["succes"]=true;
                $result["message"]="Connexion à la Base de donnée réussie";
            }
            catch (Exception $ex) {
                //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                //die ("Erreur ! " . $ex->getMessage());
                $result["succes"]=false;
                $result["message"]="Connexion à la Base de donnée impossible";
            }
            
            $tab = explode("/",$_SERVER['REQUEST_URI']);
            $project_id=$tab[5];
            //var_dump($project_id);
            $requetteUpdateProjet = $api_pdo->prepare("DELETE FROM `project_table` WHERE id=:integer");
            $requetteUpdateProjet->bindParam(':integer',$project_id);
            $requetteUpdateProjet->execute();
            //var_dump($requetteUpdateProjet->execute());
            
            
            $count = $requetteUpdateProjet->rowCount();
            //var_dump($count);
                
            $result["succes"]=true;
            $result["message"]="Le projet à bien été supprimé";
            
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
            
        }
        
        else{
            $result["succes"]=false;
            $result["message"]="Requette invalide";
            echo json_encode(mb_convert_encoding($result, 'UTF-8', 'UTF-8'));
        }   
    break;
    
    default :
        $result["succes"]=false;
        $result["message"]="Verbe Inconnu";
    break;
}