<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logos/small_log.png">

    <title>GreatAlumni</title>
    <!-- -------cdn css & js AOS--- -->



    <!-- -----cdn jQuery----  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <!-- -----cdn fontawsone----  -->
    <script src="https://kit.fontawesome.com/94935e316c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/designY.css">
</head>
<?php

include_once('../partials/header.php');


$id_feedback = $_GET['id_feedback'];
// $id_feedback = 2;
$sql2 = "SELECT * FROM `partages` WHERE `id` = $id_feedback  LIMIT 1 ";
$result2 = $db->query($sql2);
$ligne = $result2->fetch();
$id_user = $ligne['id_user'];
$titre = $ligne['titre'];
$text = $ligne['text'];


$sql3 = "SELECT * FROM `utilisateur` WHERE `id` = $id_user  LIMIT 1 ";
$result3 = $db->query($sql3);
$ligne = $result3->fetch();
$nom = $ligne["Nom"];
$prenom = $ligne["Prenom"];
$Annee_promotion = $ligne["Annee_promotion"];
$profil = $ligne["Photo"];
if (is_null($profil) or empty($profil)) {
    $profil = "../images/medias_users/profil_par_defaut.jpg";
}
?>
<div class="container ">
    <div class="d-flex justify-content-start  align-items-center mx-auto  mt-5 mb-5 w-75">
        <div class="profil_content_P mr-3">
            <img src="<?= $profil; ?>" class="img-fluid imgfeedback_profil" alt="<?= $nom . " " . $prenom ?>">
        </div>
        <div>
            <h5 class="nomPre_feedBack"><?= $nom . " " . $prenom ?></h5>
            <h6>Année de promotion: <?= $Annee_promotion ?></h6>
        </div>
    </div>
    <div>
        <h4 class="feedBack_titre"><?= $titre ?></h4>
        <p class="content_feedBack_text"><?= $text ?></p>
    </div>
</div>






<?php
include_once('../partials/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>

<script src="../Controller/jQueryScript.js"></script>
<!-- -----cdn AOS--- -->

</body>

</html>