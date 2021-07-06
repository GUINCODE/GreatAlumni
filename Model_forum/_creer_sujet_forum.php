<?php
include_once('../partials/connectBDD.php');

$id_auteur = $_POST['id'];
$sujet = $_POST['sujet'];
$categorie = $_POST['categorie'];


$stmt = $db->prepare("INSERT INTO sujet_forum (titre, categorie, id_auteur ) VALUES (:sujet, :categorie, :id_auteur)");

$stmt->bindParam(':sujet', $sujet);
$stmt->bindParam(':categorie', $categorie);
$stmt->bindParam(':id_auteur', $id_auteur);


if ($stmt->execute()) {
    echo "<span class='text-center text-success mt-5'> Sujet Créé avec succes</span>";
    $stmtp = $db->prepare("SELECT * FROM `utilisateur`  where `id` !=:id_user_auteur");
    $stmtp->bindParam(':id_user_auteur', $id_auteur);
    $stmtp->execute();
    $users_list = $stmtp->fetchAll();
    foreach ($users_list as $row => $colonne) {
        $id_authe_user = $colonne['id'];

        $notif = "notif autre";
        $type = "autre";

        $stmt5 = $db->prepare("INSERT INTO notifications (resume, type, id_user ) VALUES (:notif, :type ,:id_user)");
        $stmt5->bindParam(':notif', $notif);
        $stmt5->bindParam(':type', $type);
        $stmt5->bindParam(':id_user', $id_authe_user);
        $stmt5->execute();
    }

} else {
    echo "<span class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</span>";
}
