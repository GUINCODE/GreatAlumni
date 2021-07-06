<?php
include_once('../../partials/connectBDD.php');
$id_experience= $_POST['id'];
$date_debX = $_POST['date_debX'];
$date_finX = $_POST['date_finX'];
$poste = $_POST['poste'];
$type_poste = $_POST['type_poste'];
$entreprise = $_POST['entreprise'];

if (is_null($date_finX) or empty($date_finX)) {
    $stmt = $db->prepare("UPDATE  `parcousprofessionnel`  SET  `date_debut`=:date_debX,     `post_occupe`=:poste,     `type_emploi`=:type_poste,     `entreprise`=:entreprise  where   `id`=:id_experience
     ");

    $stmt->bindParam(':id_experience', $id_experience);
    $stmt->bindParam(':date_debX', $date_debX);
    $stmt->bindParam(':poste', $poste);
    $stmt->bindParam(':type_poste', $type_poste);
    $stmt->bindParam(':entreprise', $entreprise);


    if ($stmt->execute()) {
        echo "<h5 class='text-center text-success mt-5'> Mise à jour effectuée</h5>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</h2>";
    }

}
else{
    $stmt = $db->prepare("UPDATE  `parcousprofessionnel`  SET `date_debut`=:date_debX,     `date_fin`=:date_finX,     `post_occupe`=:poste,     `type_emploi`=:type_poste,     `entreprise`=:entreprise  where   `id`=:id_experience
     ");

    $stmt->bindParam(':id_experience', $id_experience);
    $stmt->bindParam(':date_debX', $date_debX);
    $stmt->bindParam(':date_finX', $date_finX);
    $stmt->bindParam(':poste', $poste);
    $stmt->bindParam(':type_poste', $type_poste);
    $stmt->bindParam(':entreprise', $entreprise);


    if ($stmt->execute()) {
        echo "<h5 class='text-center text-success mt-5'> Mise à jour effectuée</h5>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</h2>";
    }
}
