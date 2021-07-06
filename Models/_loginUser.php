<?php
session_start();
include_once('../partials/connectBDD.php');
$email = $_POST['email'];
$psw = $_POST['psw'];

$stmt = $db->prepare("SELECT * FROM `utilisateur` WHERE (`Mail` = :email  AND `Mdp`=:psw) OR  (`Loginn` = :email 
AND  `Mdp`=:psw)  LIMIT 1 ");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':psw', $psw);
$stmt->execute();
 $utilisateur = $stmt->fetch();
  $id_xyz=  $utilisateur['id'];
  $profil_xyz=  $utilisateur['Photo'];
  $type_xyz=  $utilisateur['Typee'];
  $nom_xyz=  $utilisateur['Nom'];
  
 if($utilisateur){
   $_SESSION['id'] = $id_xyz;
   $_SESSION["type_user"] = $type_xyz;
   $_SESSION["profil_user"] = $profil_xyz;
   $_SESSION["name_user"] = $nom_xyz;
    echo 1;
   }
 else{
    echo 0;
 }