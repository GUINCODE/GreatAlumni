<?php
include_once('../../partials/connectBDD.php');
$id_user = $_POST['id'];
$date_debX = $_POST['date_debX'];
$date_finX = $_POST['date_finX'];
$poste = $_POST['poste'];
$type_poste = $_POST['type_poste'];
$entreprise = $_POST['entreprise'];

if (is_null($date_finX) or empty($date_finX)) {

    $stmt = $db->prepare("INSERT INTO parcousprofessionnel (id_user, date_debut,post_occupe,type_emploi,entreprise ) VALUES (:id_user, :date_debX, :poste,:type_poste,:entreprise)");

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':date_debX', $date_debX);
    $stmt->bindParam(':poste', $poste);
    $stmt->bindParam(':type_poste', $type_poste);
    $stmt->bindParam(':entreprise', $entreprise);


    if ($stmt->execute()) {
        echo "<h2 class='text-center text-success mt-5'> Experience ajoutée</h2>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</h2>";
    }

}
else{

    $stmt = $db->prepare("INSERT INTO parcousprofessionnel (id_user, date_debut, date_fin,post_occupe,type_emploi,entreprise ) VALUES (:id_user, :date_debX ,:date_finX,:poste,:type_poste,:entreprise)");

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':date_debX', $date_debX);
    $stmt->bindParam(':date_finX', $date_finX);
    $stmt->bindParam(':poste', $poste);
    $stmt->bindParam(':type_poste', $type_poste);
    $stmt->bindParam(':entreprise', $entreprise);


    if ($stmt->execute()) {
        echo "<h2 class='text-center text-success mt-5'> Experience ajoutée</h2>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</h2>";
    }
}
