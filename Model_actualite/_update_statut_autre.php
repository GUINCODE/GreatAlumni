<?php
include_once('../partials/connectBDD.php');
$id_user = $_POST['id_user_connecter'];
$vue="oui";
$type="autre";

$stmt = $db->prepare("UPDATE `notifications` SET `vue` = :vue  WHERE  `id_user` = :id_user  AND `type`=:type");

$stmt->bindParam(':id_user', $id_user);
$stmt->bindParam(':vue', $vue);
$stmt->bindParam(':type', $type);
$stmt->execute();