<?php
include_once('../partials/connectBDD.php');
$id = $_POST['id'];
$citation = $_POST['citation'];

   $stmt = $db->prepare("UPDATE `utilisateur` SET `Zone_de_texte` = :citation  WHERE  `id` = :id ");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':citation', $citation);
 
    if ($stmt->execute()) {
        echo "<h2 class='text-center text-success mt-5'> Citation ajoutée avec success </h2>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2>";
    }

