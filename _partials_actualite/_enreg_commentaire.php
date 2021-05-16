<?php
include_once('../connectBDD.php');
$id_user = $_POST['id_user'];
$id_article = $_POST['id_article'];
$rec_commentaire = $_POST['commentaire'];
// $id_user = 1;
// $id_article = 1;
// $commentaire = 'mon commentaire';

$stmt = $db->prepare("INSERT INTO commentaire (texts, id_article, id_user) VALUES (:body, :id_article,:id_user)");
$stmt->bindParam(':body', $rec_commentaire);
$stmt->bindParam(':id_article', $id_article);
$stmt->bindParam(':id_user', $id_user);
if ($stmt->execute()) {
    echo "commentaire ajouter avec succes";
} else {
    echo "erreur d'ajout commentaire";
}

// $result = $db->query($sql);
// $rowCount = $result->rowCount();

// if ($rowCount > 0) {
//     echo "trouver";
// } else {
//     echo "non trouver";
// }