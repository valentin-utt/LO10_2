<?php
$user ='root';
$password='';
$dataSourceName='mysql:host=localhost:3306;dbname=test1';
try{
    $base= new PDO ($dataSourceName, $user, $password,array('charset'=>'utf8'));
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->query("SET CHARACTER SET utf8");
}
catch (Exception $ex) {
    throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
    
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
  
function getUserIdByEmail(PDO $pdo, $email){ 
    $requetteUser = "Select id FROM user_table WHERE email='".$email."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    //var_dump($resultat);
    return $resultat[0]['id'];
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


function getProjectsTableByOwner(PDO $pdo,$email){ 
    $requetteUser = "SELECT * FROM project_table WHERE owner='".$email."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}

function getUEByUserId(PDO $pdo,$user_id){ 
    $requetteUser = "SELECT * FROM ue_table WHERE user_id='".$user_id."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}



function getProjectOwnerNamebyEmail(PDO $pdo,$email){ 
    $requetteUser = "SELECT * FROM user_table WHERE email='".$email."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    return $resultat;
}

function getUserbyToken(PDO $pdo,$token){ 
    $requetteUser = "SELECT * FROM user_table WHERE access_token='".$token."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    //var_dump($resultat);
    return $resultat;
}

function getUserbyEmail(PDO $pdo,$email){ 
    $requetteUser = "SELECT * FROM user_table WHERE email='".$email."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    //var_dump($resultat);
    return $resultat;
}
  
 function addUser(PDO $pdo, $pseudo, $email, $password ,$student){
    $requette = "INSERT INTO user_table VALUES (NULL,'$pseudo','$email','$password','$student')";
    //var_dump($requette);
    $pdo->exec($requette);
 }
 

 function isEtuUttUserPresentInBD(PDO $pdo,$email){ 
    $requetteUser = "SELECT COUNT(*) FROM user_table WHERE email='".$email."'";
    $resultat=$pdo->query($requetteUser)->fetchAll();
    $resultat;
    //var_dump($resultat);
    if ($resultat[0][0]==0){
        return false;
    } else {
        return true;
    }
}
 
 function addEtuUttUser(PDO $pdo,$fullname, $email, $student, $studentid, $branch , $level ,$speciality,$access_token,$img_url){
    $stmt = $pdo->prepare("INSERT INTO user_table VALUES (NULL,:fullname,:email,NULL,:student,:studentid,:branch,:level,:speciality,:acess_token,:img_url)");

    if (strval($student)==1){
        $student="true";
    }else{
        $student="false";
    }
    
   /*** bind the paramaters ***/
   $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR,70);
   $stmt->bindParam(':email', $email, PDO::PARAM_STR, 70);
   $stmt->bindParam(':student', $student, PDO::PARAM_STR, 10);
   $stmt->bindParam(':student', $studentid, PDO::PARAM_INT, 10);
   $stmt->bindParam(':branch', $branch, PDO::PARAM_STR, 10);
   $stmt->bindParam(':level', $level, PDO::PARAM_STR,10);
   $stmt->bindParam(':speciality', $speciality, PDO::PARAM_STR, 15);
   $stmt->bindParam(':acces_token', $access_token, PDO::PARAM_STR, 32);
   $stmt->bindParam(':img_url', $img_url, PDO::PARAM_STR, 150);

   
   /*** execute the querry***/
   $stmt->execute();
   
    //$requette = "INSERT INTO project_table VALUES (NULL,'$owner','$name','$cat','$des','$place','$img','$vid', '$mode','$goal','$lon','$lat')";
    //var_dump($requette);
    //$pdo->exec($requette);
  }
  
   function UpdateEtuUttUser(PDO $pdo,$user_id,$fullname, $email, $student, $studentid, $branch , $level ,$speciality, $access_token, $img_url){
    $stmt = $pdo->prepare("UPDATE user_table SET pseudo=:fullname,email=:email,student=:student,studentid=:studentid,branch=:branch,level=:level,speciality=:speciality,access_token=:access_token,img_url=:img_url WHERE id=:user_id");
    
    if (strval($student)==1){
        $student="true";
    }else{
        $student="false";
    }
    
   /*** bind the paramaters ***/
   $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR,70);
   $stmt->bindParam(':email', $email, PDO::PARAM_STR, 70);
   $stmt->bindParam(':student', $student, PDO::PARAM_STR, 10);
   $stmt->bindParam(':studentid', $studentid, PDO::PARAM_INT, 10);
   $stmt->bindParam(':branch', $branch, PDO::PARAM_STR, 10);
   $stmt->bindParam(':level', $level, PDO::PARAM_STR,10);
   $stmt->bindParam(':speciality', $speciality, PDO::PARAM_STR, 15);
   $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT, 10);
   $stmt->bindParam(':access_token', $access_token, PDO::PARAM_STR, 32);
   $stmt->bindParam(':img_url', $img_url, PDO::PARAM_STR, 150);
   
   /*** execute the querry***/
   $stmt->execute();

  }
  
  
  function addEtuUttUserUE(PDO $pdo,$user_id, $ue_sigle){
    $stmt = $pdo->prepare("INSERT INTO ue_table VALUES (NULL,:user_id,:ue_sigle)");

   /*** bind the paramaters ***/
   $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT,10);
   $stmt->bindParam(':ue_sigle', $ue_sigle, PDO::PARAM_STR, 6);
   
   /*** execute the querry***/
   $stmt->execute();
   

  }
  
  
  
    function deleteEtuUttUserUEs(PDO $pdo,$user_id){
    $stmt = $pdo->prepare("DELETE FROM ue_table WHERE user_id=:user_id");

   /*** bind the paramaters ***/
   $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT,10);
   
   /*** execute the querry***/
   $stmt->execute();
   
 
  }
  
    function addUserlikeProject(PDO $pdo,$project_id, $user_id){
    $stmt = $pdo->prepare("INSERT INTO likes_table VALUES (NULL,:project_id,:user_id)");

   /*** bind the paramaters ***/
   $stmt->bindParam(':project_id', $user_id, PDO::PARAM_INT,10);
   $stmt->bindParam(':user_id', $ue_sigle, PDO::PARAM_STR, 6);
   
   /*** execute the querry***/
   $stmt->execute();
   

  }
  
  function addFundToProjectFromUser(PDO $pdo,$project_id, $user_id){
    $stmt = $pdo->prepare("INSERT INTO likes_table VALUES (NULL,:project_id,:user_id)");

   /*** bind the paramaters ***/
   $stmt->bindParam(':project_id', $user_id, PDO::PARAM_INT,10);
   $stmt->bindParam(':user_id', $ue_sigle, PDO::PARAM_STR, 6);
   
   /*** execute the querry***/
   $stmt->execute();
   

  }
 
 
  function addProject(PDO $pdo,$owner, $name, $cat, $des , $place ,$img, $vid, $mode,$goal,$lon,$lat,$fund){
    $stmt = $pdo->prepare("INSERT INTO project_table VALUES (NULL,:owner,:name,:cat,:des,:place,:img,:vid,:mode,:goal,:lon,:lat,:fund)");

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
   $stmt->bindParam(':fund', strval($fund), PDO::PARAM_STR, 50);
   
   /*** execute the querry***/
   $stmt->execute();
   
   
  }
  
    function addProjectNolocation(PDO $pdo,$owner, $name, $cat, $des , $place ,$img, $vid, $mode,$goal,$fund){
    $stmt = $pdo->prepare("INSERT INTO project_table VALUES (NULL,:owner,:name,:cat,:des,:place,:img,:vid,:mode,:goal,NULL,NULL,:fund)");

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
   $stmt->bindParam(':fund', strval($fund), PDO::PARAM_STR, 50);

   
   /*** execute the querry***/
   $stmt->execute();
   
  }


