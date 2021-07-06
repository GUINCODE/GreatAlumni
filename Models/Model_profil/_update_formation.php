<?php
include_once('../../partials/connectBDD.php');
$id_formation = $_POST['id'];
$formation = $_POST['formation'];
$etablissement = $_POST['ecole'];
$annee = $_POST['annee'];



$stmt = $db->prepare("UPDATE `cursusscolaire` SET `annee` = :annee, `formation`=:formation, `etablissement`=:etablissement  WHERE  `id` = :id ");

$stmt->bindParam(':id', $id_formation);
$stmt->bindParam(':formation', $formation);
$stmt->bindParam(':etablissement', $etablissement);
$stmt->bindParam(':annee', $annee);


if ($stmt->execute()) {
    echo "<h2 class='text-center text-success mt-5'> Mise à jour éffectuéex ajoutée</h2>";
} else {
    echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</h2>";
}
