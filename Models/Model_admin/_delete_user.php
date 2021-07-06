<?php
include_once('../../partials/connectBDD.php');
$id_user = $_POST['id_user'];


$stmt = $db->prepare("DELETE FROM utilisateur  WHERE  id=(:id_user)");
$stmt->bindParam(':id_user', $id_user);
if ($stmt->execute()) {
    echo "<h2 class='text-center text-success mt-5'> User deleted</h2>";
} else {
    echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2> <span text-warning>réessqyer plutard</span> ";
}