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

<body>
    <?php
    include_once('../partials/header.php')
    ?>


    <?php
    $sql2 = "SELECT * FROM `partages` ";
    $result2 = $db->query($sql2);
    while ($row = $result2->fetch()) {
        $id_user = $row['id_user'];
        $titre = $row['titre'];
        $idFeedback = $row['id'];

        $sql3 = "SELECT * FROM `utilisateur` WHERE `id` = $id_user  LIMIT 1 ";
        $result3 = $db->query($sql3);
        $ligne = $result3->fetch();

        $id = $ligne['id'];
        $nom = $ligne["Nom"];
        $prenom = $ligne["Prenom"];
        $Annee_promotion = $ligne["Annee_promotion"];
        $profil = $ligne["Photo"];

        if (is_null($profil) or empty($profil)) {
            $profil = "../images/medias_users/profil_par_defaut.jpg";
        }
    ?>
        <div class="container ">
            <div class="d-flex d-75 mx-auto my-2  align-items-center items_feedback rounded shadow-lg">
                <div class="d-flex flex-column justify-content-center align-items-center mr-5">
                    <img src="<?= $profil; ?>" atl="<?= $nom . ' ' . $prenom; ?>" class="profil_partageDeux" />
                    <h4 class="titre_feedBack_profil"><?= $nom . ' ' . $prenom; ?></h4>
                    <span class="text-muted">Année de promotion: <?= $Annee_promotion; ?> </span>
                </div>
                <div>
                    <h4><?= $titre; ?></h4>
                    <a href="lire_partage.php?id_feedback='<?= $idFeedback;  ?>'" type="button" class="btn btn-outline-primary btn-sm rounded">Lire</a>
                </div>
            </div>
        </div>
    <?php
    }


    ?>





    <?php
    include_once('../partials/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <script src="../Controller/jQueryScript.js"></script>
    <!-- -----cdn AOS--- -->

</body>

</html>