<?php
include_once('../connectBDD.php');
$id = $_POST['id_user'];
// $id = 1;

$sql = "SELECT * FROM `notifications` WHERE `type` = 'evenement' AND `id_user` =  '$id' AND `vue` = 'non'   ";
$result = $db->query($sql);
$rowCount = $result->rowCount();

if ($rowCount > 0) {

  while ($row = $result->fetch()) {
    $id = $row['id'];
    $message = $row['resume'];
    echo  "<li  class='shadow '><a href=''>" . $message . "</a></li>";
  }
} else {

  echo "<li class='text-munted p-2 text-info shadow '> aucun evenement nouveau !!!</li>";
}
