<?php
include_once('../partials/connectBDD.php');
$id_signaleur = $_POST['id_signaleur'];
$id_auteur_post = $_POST['id_auteur_post'];
$id_post = $_POST['id_article'];

$stmt = $db->prepare("INSERT INTO report_post (id_signaleur, id_auteur_post, id_post) VALUES (:id_signaleur,:id_auteur_post,:id_post)");
$stmt->bindParam(':id_signaleur', $id_signaleur);
$stmt->bindParam(':id_auteur_post', $id_auteur_post);
$stmt->bindParam(':id_post', $id_post);
if ($stmt->execute()) {
    echo "ok";
} else {
    echo 0;
}
