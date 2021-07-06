<?php
include_once('../../partials/connectBDD.php');
$id_hobie = $_POST['id'];
$hobbie = $_POST['hobbie_name'];




$stmt = $db->prepare("UPDATE `hobbies` SET `hobbie` = :hobbie  WHERE  `id` = :id_hobie ");

$stmt->bindParam(':id_hobie', $id_hobie);
$stmt->bindParam(':hobbie', $hobbie);

if ($stmt->execute()) {
    echo "<span class='text-center text-success mt-5'> Mise à jour éffectuée</span>";
} else {
    echo "<span class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</span>";
}
