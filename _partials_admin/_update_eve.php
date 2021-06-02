<?php
include_once('../partials/connectBDD.php');

$id=$_POST["id_eve_update"];
$titre=$_POST["titre_eve_update"];
$subTitre=$_POST["sous_titre_eve_update"];
$desc=$_POST["desc_eve_update"];
$date=$_POST["date_eve_update"];

$stmt = $db->prepare("UPDATE `evenements` SET `titre` = :titre, `sub_titre` = :subtilti, `descriptions` = :desc, `dates` = :dates WHERE  `id` = :id ");
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':subtilti', $subTitre);
$stmt->bindParam(':desc', $desc);
$stmt->bindParam(':dates', $date);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo "<h2 class='text-center text-success mt-5'> Mise à jours efféctuée</h2>";
} else {
    echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2>";
}



?>

