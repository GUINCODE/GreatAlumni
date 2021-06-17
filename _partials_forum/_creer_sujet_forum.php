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
} else {
    echo "<span class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</span>";
}
