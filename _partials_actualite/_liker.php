<?php
include_once('../connectBDD.php');
$id_user = $_POST['id_user'];
$id_article = $_POST['id_article'];

// $id_user = 1;
// $id_article = 1;
// $commentaire = 'mon commentaire';

$stmt = $db->prepare("INSERT INTO article_votes (id_article, id_user) VALUES (:id_article,:id_user)");
$stmt->bindParam(':id_article', $id_article);
$stmt->bindParam(':id_user', $id_user);
if ($stmt->execute()) {
    echo "user like";
} else {
    echo "erreur to like";
}