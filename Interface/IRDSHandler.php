<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 *
 * @author val-r
 */
interface IRDSHandler {

    public function listUser(PDO $pdo);

    public function listUserByEmail(PDO $pdo, $email);

    public function listUserByEmailAndPassword(PDO $pdo, $email, $password);

    public function getUserIdByEmail(PDO $pdo, $email);

    public function listProject(PDO $pdo);
    
    public function listProjectByCat(PDO $pdo, $categorie);

    public function getProjectById(PDO $pdo, $id);

    public function getProjectsTableByOwner(PDO $pdo, $email);

    public function getUEByUserId(PDO $pdo, $user_id);

    public function getProjectOwnerNamebyEmail(PDO $pdo, $email);

    public function getUserbyToken(PDO $pdo, $token);

    public function getUserbyEmail(PDO $pdo, $email);

    public function listLocalisableProjects(PDO $pdo);

    public function addUser(PDO $pdo, $pseudo, $email, $password, $student);

    public function isEtuUttUserPresentInBD(PDO $pdo, $email);

    public function addEtuUttUser(PDO $pdo, $fullname, $email, $student, $studentid, $branch, $level, $speciality, $access_token, $img_url);

    public function UpdateEtuUttUser(PDO $pdo, $user_id, $fullname, $email, $student, $studentid, $branch, $level, $speciality, $access_token, $img_url);

    public function addEtuUttUserUE(PDO $pdo, $user_id, $ue_sigle);

    public function deleteEtuUttUserUEs(PDO $pdo, $user_id);

    public function addFundToProjectFromUser(PDO $pdo, $project_id, $user_id, $fund);
    
   // public function listFundFromUser(PDO $pdo, $user_id);

    public function addProject(PDO $pdo, $owner, $name, $cat, $des, $place, $img, $vid, $mode, $goal, $lon, $lat, $fund);

  
    
    public function addProjectNolocation(PDO $pdo, $owner, $name, $cat, $des, $place, $img, $vid, $mode, $goal, $fund);
}
