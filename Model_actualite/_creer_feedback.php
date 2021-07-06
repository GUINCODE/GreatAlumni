<?php
include_once('../partials/connectBDD.php');
$id_user = $_POST['id_userlogin_eve2'];
$titre_feedback = $_POST['titre_eve2'];
$desc_feedback = $_POST['sous_titre_eve2'];


$stmt = $db->prepare("INSERT INTO partages (id_user, titre, text ) VALUES (:id_user, :titre_feedback ,:desc_feedback)");
$stmt->bindParam(':id_user', $id_user);
$stmt->bindParam(':titre_feedback', $titre_feedback);
$stmt->bindParam(':desc_feedback', $desc_feedback);


if ($stmt->execute()) {
?>
<div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
    <strong>Partage d'experience effecué !!! Vous pouvez partatager une autre</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
} else {
?>
<div class="alert alert-warning  alert-dismissible fade show w-75 mx-auto" role="alert">
    Impossible de publié le post.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
}