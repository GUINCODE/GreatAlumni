<?php
include_once('../../partials/connectBDD.php');
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$annee = $_POST['annee'];
$loginn = $_POST['login'];

$passwordRec = $_POST['mdp'];
$typee = $_POST['type'];
$mdp= password_hash( $passwordRec,  PASSWORD_DEFAULT);


$stmt = $db->prepare("SELECT * FROM `utilisateur`  where  Mail=:mail LIMIT 1");
$stmt->bindParam(':mail', $mail);
$stmt->execute();
if($users = $stmt->fetch()){
  echo "existe";
}else{
   $stmt = $db->prepare("INSERT INTO utilisateur (Nom,Prenom,Mail,Mdp,Annee_promotion,Loginn,Typee)
  VALUES (:nom, :prenom, :mail, :mdp, :annee, :loginn, :typee )");
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':mail', $mail);
$stmt->bindParam(':annee', $annee);
$stmt->bindParam(':loginn', $loginn);
$stmt->bindParam(':mdp', $mdp);
$stmt->bindParam(':typee', $typee);

if ($stmt->execute()) {
    echo "<h2 class='text-center text-success mt-5'> Membre ajouté avec succès </h2>";
} else {
    echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2>";
}
}




?>