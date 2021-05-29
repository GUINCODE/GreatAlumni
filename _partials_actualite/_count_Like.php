<?php
include_once('../partials/connectBDD.php');
$id_article = $_POST['id_article'];


$sql = "SELECT * FROM `article_votes` WHERE id_article = '$id_article'    ";
$result = $db->query($sql);
if ($result) {
    $rowCount = $result->rowCount();

    if ($rowCount > 0) {
        echo "<i class='fas fa-star'></i> " . $rowCount;
    } else {
        echo '';
    }
}