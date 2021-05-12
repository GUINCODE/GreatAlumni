<?php
include_once('../connectBDD.php');
$id = $_POST['id_user'];
// $id = 1;

$sql = "SELECT * FROM `notifications` WHERE `type` = 'message' AND `id_user` =  '$id' AND `vue` = 'non'   ";
$result = $db->query($sql);
$rowCount = $result->rowCount();
if ($rowCount > 0) {
    echo $rowCount;
} else {
    echo '';
}

$db = null;