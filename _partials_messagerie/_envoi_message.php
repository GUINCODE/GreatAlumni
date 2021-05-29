<?php

include_once('../partials/connectBDD.php');
$id_userConnecter = $_POST['id_userConnecter'];
$id_destinataire = $_POST['id_destinataire'];
$messages = $_POST['message'];


$stmt = $db->prepare("INSERT INTO messagerie (texts, id_expeditaire, id_destinataire ) VALUES (:messages, :id_userConnecter ,:id_destinataire)");
$stmt->bindParam(':id_userConnecter', $id_userConnecter);
$stmt->bindParam(':id_destinataire', $id_destinataire);
$stmt->bindParam(':messages', $messages);
if ($stmt->execute()) {
    echo "message envoyé";
}else {
    echo " echech d'envoi message ";
}



?>