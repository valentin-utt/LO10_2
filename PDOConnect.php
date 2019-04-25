<?php
$user ='root';
$password='';
$dataSourceName='mysql:host=localhost;dbname=test1';
try{
    $base= new PDO ($dataSourceName, $user, $password);
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $ex) {
    throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
    //die ("Erreur ! " . $ex->getMessage());
}

function listUser(PDO $pdo){ 
    $requetteUser = "Select * FROM user_table";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
  }
  
function listUserByEmail(PDO $pdo, $email){ 
    $requetteUser = "Select * FROM user_table WHERE email='".$email."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
  }
  
function listUserByEmailAndPassword(PDO $pdo, $email, $password){ 
    $requetteUser = "Select * FROM user_table WHERE ( email='".$email."' AND password='".$password."')";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
  }
  
function listProject(PDO $pdo){ 
    $requetteUser = "Select * FROM project_table";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}

function listLocalisableProjects(PDO $pdo){ 
    $requetteUser = "Select * FROM project_table WHERE (longitude!= NULL AND latitude!=NULL)";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}

function listProjectByCat(PDO $pdo,$categorie){ 
    $requetteUser = "SELECT * FROM project_table WHERE cat='".$categorie."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}



function getProjectById(PDO $pdo,$id){ 
    $requetteUser = "SELECT * FROM project_table WHERE id='".$id."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}

function getProjectOwnerNamebyEmail(PDO $pdo,$email){ 
    $requetteUser = "SELECT * FROM user_table WHERE email='".$email."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}
  
 function addUser(PDO $pdo, $pseudo, $email, $password ,$student){
    $requette = "INSERT INTO user_table VALUES (NULL,'$pseudo','$email','$password','$student')";
    //var_dump($requette);
    $pdo->exec($requette);
 }
 
  function addProject(PDO $pdo,$owner, $name, $cat, $des , $place ,$img, $vid, $mode,$goal,$lon,$lat){
    $stmt = $pdo->prepare("INSERT INTO project_table VALUES (NULL,:owner,:name,:cat,:des,:place,:img,:vid,:mode,:goal,:lon,:lat)");

   /*** bind the paramaters ***/
   $stmt->bindParam(':owner', $owner, PDO::PARAM_STR,32);
   $stmt->bindParam(':name', $name, PDO::PARAM_STR, 50);
   $stmt->bindParam(':cat', $cat, PDO::PARAM_STR, 50);
   $stmt->bindParam(':des', $des, PDO::PARAM_STR, 280);
   $stmt->bindParam(':place', $place, PDO::PARAM_STR,100);
   $stmt->bindParam(':img', $img, PDO::PARAM_STR, 280);
   $stmt->bindParam(':vid', $vid, PDO::PARAM_STR, 280);
   $stmt->bindParam(':mode', $mode, PDO::PARAM_STR, 50);
   $stmt->bindParam(':goal', strval($goal), PDO::PARAM_STR, 50);
   $stmt->bindParam(':lon', strval($lon), PDO::PARAM_STR, 50);
   $stmt->bindParam(':lat', strval($lat), PDO::PARAM_STR, 50);
   
   /*** execute the querry***/
   $stmt->execute();
   
    //$requette = "INSERT INTO project_table VALUES (NULL,'$owner','$name','$cat','$des','$place','$img','$vid', '$mode','$goal','$lon','$lat')";
    //var_dump($requette);
    //$pdo->exec($requette);
  }
  
    function addProjectNolocation(PDO $pdo,$owner, $name, $cat, $des , $place ,$img, $vid, $mode,$goal){
    $stmt = $pdo->prepare("INSERT INTO project_table VALUES (NULL,:owner,:name,:cat,:des,:place,:img,:vid,:mode,:goal,NULL,NULL)");

   /*** bind the paramaters ***/
   $stmt->bindParam(':owner', $owner, PDO::PARAM_STR,32);
   $stmt->bindParam(':name', $name, PDO::PARAM_STR, 50);
   $stmt->bindParam(':cat', $cat, PDO::PARAM_STR, 50);
   $stmt->bindParam(':des', $des, PDO::PARAM_STR, 280);
   $stmt->bindParam(':place', $place, PDO::PARAM_STR,100);
   $stmt->bindParam(':img', $img, PDO::PARAM_STR, 280);
   $stmt->bindParam(':vid', $vid, PDO::PARAM_STR, 280);
   $stmt->bindParam(':mode', $mode, PDO::PARAM_STR, 50);
   $stmt->bindParam(':goal', strval($goal), PDO::PARAM_STR, 50);

   
   /*** execute the querry***/
   $stmt->execute();
   
    //$requette = "INSERT INTO project_table VALUES (NULL,'$owner','$name','$cat','$des','$place','$img','$vid', '$mode','$goal','$lon','$lat')";
    //var_dump($requette);
    //$pdo->exec($requette);
  }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

