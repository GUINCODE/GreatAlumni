<?php
session_start();
include_once('../partials/connectBDD.php');
$email = $_POST['email'];
$psw = $_POST['psw'];
// $psw= password_hash($passwordRec,  PASSWORD_DEFAULT);
// // $psw=password_verify($passwordRec,)


$stmt = $db->prepare("SELECT * FROM `utilisateur` WHERE (`Mail` = :email ) OR  (`Loginn` = :email)  LIMIT 1 ");
$stmt->bindParam(':email', $email);

$stmt->execute();
 $utilisateur = $stmt->fetch();
  $id_xyz=  $utilisateur['id'];
  $profil_xyz=  $utilisateur['Photo'];
  $type_xyz=  $utilisateur['Typee'];
  $nom_xyz=  $utilisateur['Nom'];
  
 if($utilisateur){

  if(password_verify($psw, $utilisateur['Mdp'])){
    $_SESSION['id'] = $id_xyz;
    $_SESSION["type_user"] = $type_xyz;
    $_SESSION["profil_user"] = $profil_xyz;
    $_SESSION["name_user"] = $nom_xyz;
    echo 1;
  }
   
   }
 else{
    echo 0;
 }