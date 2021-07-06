<?php

include_once('../../partials/connectBDD.php');
$id_userConnecter = $_POST['id_userConnecter'];
$id_destinataire = $_POST['id_destinataire'];
$messages = $_POST['message'];

$notif="notif sms";
$type="message";


$stmt = $db->prepare("INSERT INTO messagerie (texts, id_expeditaire, id_destinataire ) VALUES (:messages, :id_userConnecter ,:id_destinataire)");
$stmt->bindParam(':id_userConnecter', $id_userConnecter);
$stmt->bindParam(':id_destinataire', $id_destinataire);
$stmt->bindParam(':messages', $messages);
if ($stmt->execute()) {
    echo "message envoyé";

    $stmt = $db->prepare("INSERT INTO notifications (resume, type, id_user ) VALUES (:notif, :type ,:id_user)");
    $stmt->bindParam(':notif', $notif);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':id_user', $id_destinataire);
    $stmt->execute();
}else {
    echo " echech d'envoi message ";
}



?>