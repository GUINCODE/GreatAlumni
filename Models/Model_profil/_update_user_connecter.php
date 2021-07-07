<?php
include_once('../../partials/connectBDD.php');
$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$promotion = $_POST['annee'];
$departement = $_POST['departement'];
$campus = $_POST['campus'];
$profession = $_POST['profession'];
$loginn = $_POST['login'];

$passwordRec = $_POST['mdp'];
$mdp = password_hash($passwordRec,  PASSWORD_DEFAULT);



// on verifie si le mail existe et il n'est pas assoccier a un autre compte qui n'est pas ce compte 

$stmt = $db->prepare("SELECT * FROM `utilisateur`  where  Mail=:mail AND  `id` != :id_utlisateur_connecter LIMIT 1");
$stmt->bindParam(':mail', $mail);
$stmt->bindParam(':id_utlisateur_connecter', $id);
$stmt->execute();
if($users = $stmt->fetch()){
  echo "existe";
}else{
  if($passwordRec !=""){
    $stmt = $db->prepare("UPDATE `utilisateur` SET `Nom` = :nom, `Prenom` = :prenom, `Mail` = :mail, `Departement` = :departement, `Annee_promotion` = :promotion, 
   `profession` = :profession, `campus` = :campus,  `Loginn` = :loginn,  `Mdp` = :mdp   WHERE  `id` = :id ");

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':departement', $departement);
    $stmt->bindParam(':loginn', $loginn);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->bindParam(':profession', $profession);
    $stmt->bindParam(':campus', $campus);
    $stmt->bindParam(':promotion', $promotion);


    if ($stmt->execute()) {
      echo "<h2 class='text-center text-success mt-5'> Mise a jour effecutuer effectuée avec success </h2>";
    } else {
      echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération 1</h2>";
    }
  } else{
    $stmt = $db->prepare("UPDATE `utilisateur` SET `Nom` = :nom, `Prenom` = :prenom, `Mail` = :mail, `Departement` = :departement, `Annee_promotion` = :promotion, 
   `profession` = :profession, `campus` = :campus,  `Loginn` = :loginn    WHERE  `id` = :id ");

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':departement', $departement);
    $stmt->bindParam(':loginn', $loginn);
     $stmt->bindParam(':profession', $profession);
    $stmt->bindParam(':campus', $campus);
    $stmt->bindParam(':promotion', $promotion);


    if ($stmt->execute()) {
      echo "<h2 class='text-center text-success mt-5'> Mise a jour effecutuer effectuée avec success </h2>";
    } else {
      echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération 2</h2>";
    }

  }
  
}
