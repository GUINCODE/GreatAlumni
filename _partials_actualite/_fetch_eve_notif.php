<?php
include_once('../partials/connectBDD.php');
$id = $_POST['id_user'];
// $id = 1;

$sql = "SELECT * FROM `notifications` WHERE `type` = 'evenement' AND `id_user` =  '$id' AND `vue` = 'non'   ";
$result = $db->query($sql);
$rowCount = $result->rowCount();
if ($rowCount > 0) {
    echo $rowCount;
}
$db = null;