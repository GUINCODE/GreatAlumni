<?php
include_once('../../partials/connectBDD.php');
$id_user = $_POST['id'];
$formation = $_POST['formation'];
$etablissement = $_POST['ecole'];
$annee = $_POST['annee'];

$stmt = $db->prepare("INSERT INTO cursusscolaire (id_user, formation, etablissement,annee ) VALUES (:id_user, :formation ,:etablissement,:annee)");

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':formation', $formation);
    $stmt->bindParam(':etablissement', $etablissement);
    $stmt->bindParam(':annee', $annee);


    if ($stmt->execute()) {
        echo "<h2 class='text-center text-success mt-5'> Formation ajoutée</h2>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</h2>";
    }

