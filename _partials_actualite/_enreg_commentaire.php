<?php
include_once('../partials/connectBDD.php');
$id_user = $_POST['identifiant_user'];
$id_article = $_POST['identifiant_article'];
$rec_commentaire = $_POST['commentaire'];



$stmt = $db->prepare("INSERT INTO commentaire (texts, id_article, id_user) VALUES (:body, :id_article,:id_user)");
$stmt->bindParam(':body', $rec_commentaire);
$stmt->bindParam(':id_article', $id_article);
$stmt->bindParam(':id_user', $id_user);
if ($stmt->execute()) {
    $sql4 = "SELECT * FROM `commentaire` WHERE `id_article` = $id_article  ";
    $result4 = $db->query($sql4);
    $nombreCommentaire = $result4->rowCount();
    if ($nombreCommentaire > 0) {
?>
   <?php echo $nombreCommentaire ; ?> 

    <?php
    } else {
        echo '';
    }
} else {
    echo "erreur d'ajout commentaire";
}

// $result = $db->query($sql);
// $rowCount = $result->rowCount();

// if ($rowCount > 0) {
// echo "trouver";
// } else {
// echo "non trouver";
// }