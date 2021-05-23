<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>GreatAlumni</title>

    <!-- -----cdn jQuery----  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css"
        integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <!-- -----cdn fontawsone----  -->
    <script src="https://kit.fontawesome.com/94935e316c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/style.css">
</head>
<?php
include_once('./header.php');
include_once('./connectBDD.php');

$id_evenement = $_GET['id_evenement'];
// $id_evenement = 10;
$sql2 = "SELECT * FROM `evenements` WHERE `id` = $id_evenement  LIMIT 1 ";
$result2 = $db->query($sql2);
$ligne = $result2->fetch();
$titre = $ligne['titre'];
$description = $ligne['descriptions'];
$sub_titre = $ligne['sub_titre'];
$image_path = $ligne['image_path'];
$date = $ligne['dates'];
?>
<div class="d-flex flex-column justify-content-center align-items-center my-3">
    <h1 class="text-info titreEVENEMENT"><?= $titre; ?></h1>

    <p class="sous_titre_evenement text-center"><?= $sub_titre; ?></p>

    <figure class="figure mediaBloc">
        <img src="<?= $image_path; ?>" class="img-fluid" alt="<?= $titre; ?>">
        <figcaption class="figure-caption  ">Date: <?= $date; ?></figcaption>
    </figure>

    <p class="details_evenement mb-3 detailsEvene text-center"><?= $description; ?></p>

</div>
<h4 class="text-muted text-center border w-25 mx-auto"> Les futurs evenements</h4>

<?php
$Today = date('Y-m-d');

$sql3 = "SELECT * FROM `evenements`  ORDER BY `dates`  ASC ";
$result3 = $db->query($sql3);

while ($ligne = $result3->fetch()) {
    $id = $ligne['id'];
    $titre = $ligne['titre'];
    $description = $ligne['descriptions'];
    $sub_titre = $ligne['sub_titre'];
    $image_path = $ligne['image_path'];
    $date = $ligne['dates'];
    if ($Today <= $date) {

?>
<div class="singleEvene border mx-5 my-2 shadow rounded">
    <div class="d-flex flex-row  justify-content-start align-items-center">
        <img src="<?= $image_path; ?>" class="img-fluid imageDE_eve mr-2 rounded" alt="">
        <div class="">
            <h4><?= $titre; ?></h4>
            <p> <?= $sub_titre; ?></p>
            <smal class="text-muted mr-3"><?= $date; ?></smal>
            <a href="lire_un_evenement.php?id_evenement=<?= $id; ?>" type="button"
                class="btn btn-outline-primary  btn-sm rounded">Lire</a>
        </div>

    </div>
</div>
<?php
    } else {
        echo "";
    }
}
?>
<h4 class="text-muted text-center border w-25 mx-auto my-3"> Les evenements anterieurs</h4>
<?php

$sql3 = "SELECT * FROM `evenements`  ORDER BY `dates`  DESC ";
$result3 = $db->query($sql3);
while ($ligne = $result3->fetch()) {
    $id = $ligne['id'];
    $titre = $ligne['titre'];
    $description = $ligne['descriptions'];
    $sub_titre = $ligne['sub_titre'];
    $image_path = $ligne['image_path'];
    $date = $ligne['dates'];
    if ($Today > $date) {

?>
<div class="singleEvene border mx-5 my-2 shadow rounded">
    <div class="d-flex flex-row  justify-content-start align-items-center">
        <img src="<?= $image_path; ?>" class="img-fluid imageDE_eve mr-2 rounded" alt="">
        <div class="">
            <h4><?= $titre; ?></h4>
            <p> <?= $sub_titre; ?></p>
            <smal class="text-muted mr-3"><?= $date; ?></smal>
            <a href="lire_un_evenement.php?id_evenement=<?= $id; ?>" type="button"
                class="btn btn-outline-primary  btn-sm rounded">Lire</a>
        </div>

    </div>
</div>
<?php
    } else {
        echo "";
    }
}
?>



















<?php
include_once('footer.php');
?>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
<script src="./script/script.js"></script>
<script src="./script/jQueryScript.js"></script>