<?php
include_once('../../partials/connectBDD.php');

$id_sujet = $_POST['idSujete'];
$reponse = $_POST['champReponseSujet'];
$id_repondeur = $_POST['id_user_connecter'];


$stmt = $db->prepare("INSERT INTO reponse_sujet (id_sujet, reponse, id_repondeur ) VALUES (:id_sujet, :reponse ,:id_repondeur)");
$stmt->bindParam(':id_sujet', $id_sujet);
$stmt->bindParam(':reponse', $reponse);
$stmt->bindParam(':id_repondeur', $id_repondeur);
if ($stmt->execute()) {
    echo "message envoyé";
} else {
    echo " echech d'envoi message ";
}

?>