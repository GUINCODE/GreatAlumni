<?php
include_once('../partials/connectBDD.php');
$id_signaleur = $_POST['id_signaleur'];
$id_signaler= $_POST['id_auteur_post'];

  

$stmt = $db->prepare("INSERT INTO report_user (id_signaleur, id_signaler) VALUES (:id_signaleur,:id_signaler)");
$stmt->bindParam(':id_signaleur', $id_signaleur);
$stmt->bindParam(':id_signaler', $id_signaler);

if ($stmt->execute()) {
    echo "ok";
} else {
    echo 0;
}
