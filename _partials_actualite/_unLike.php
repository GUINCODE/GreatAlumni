<?php
include_once('../partials/connectBDD.php');
$id_user = $_POST['identifiant_user'];
$id_article = $_POST['identifiant_article'];

$stmt = $db->prepare("DELETE FROM article_votes  WHERE id_article = (:id_article) AND id_user=(:id_user)");
$stmt->bindParam(':id_article', $id_article);
$stmt->bindParam(':id_user', $id_user);
if ($stmt->execute()) {
    $sql = "SELECT * FROM `article_votes` WHERE id_article = '$id_article'    ";
    $result = $db->query($sql);
    if ($result) {
        $rowCount = $result->rowCount();

        if ($rowCount > 0) {
            echo "<i class='fas fa-star liker'></i> " . $rowCount;
        } else {
            echo '';
        }
    }
} else {
    echo "erreur to like";
}