<?php
include_once('../partials/connectBDD.php');
$id_user = $_POST['id'];
$hobbie_name = $_POST['hobbie_name'];


$stmt = $db->prepare("INSERT INTO hobbies (id_user, hobbie ) VALUES (:id_user, :hobbie_name)");

    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':hobbie_name', $hobbie_name);

    if ($stmt->execute()) {
        echo "<span class='text-center text-success mt-5'> Hobbie ajouté</span>";
    } else {
        echo "<span class='text-center text-danger mt-5'> Impossible de réaliser l'opération; reessayer plutard</span>";
    }

