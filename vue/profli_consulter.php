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
    include_once('../partials/header.php');
    $id_user_consulter = $_GET['id_user_consulter'];
    // echo $id_user_consulter;

    $stmt = $db->prepare("SELECT * FROM `utilisateur` where `id`= :id_utlisateur ");
    $stmt->bindParam(':id_utlisateur', $id_user_consulter);
    $stmt->execute();
    $colonne = $stmt->fetch();

    $nom = $colonne['Nom'];
    $prenom = $colonne['Prenom'];
    $promotion = $colonne['Annee_promotion'];
    $campus = $colonne['campus'];
    $profession = $colonne['profession'];
    $citation = $colonne['Zone_de_texte'];
    $departement = $colonne['Departement'];
    $profil = $colonne["Photo"];
    if (is_null($profil) or empty($profil)) {
        $profil = "../images/medias_users/profil_par_defaut.jpg";
    }



    ?>
    <div class="container ">
        <div class="d-flex flex-column justify-content-center align-items-center mx-auto">
            <div class="colsult_user_profil"><img src="<?= $profil  ?>" alt="..." class="img-fluid rounded-circle image_user_consulter" /></div>
            <span class="h5 mt-3"><?= $nom . " " . $prenom ?></span>
        </div>
        <cite class="shadow h3 mt-3 mb-3 rounded  d-flex  justify-content-center align-items-center  mx-auto text-center text-success border  text-fluid">
            '' <?= $citation  ?> "</cite>
        <div class="d-flex  justify-content-center align-items-center mx-auto p-3 border w-75 ">
            <span class="mr-auto "> Campus: <b><?= $campus ?></b></span>
            <span class=" mx-5 "> Promotion: <b><?= $promotion ?></b></span>
            <span class="ml-auto "> Departement: <b><?= $departement ?></b></span>

        </div>
        <p class="text-center w-100 p-3">Profession : <strong class="textColorBlue"><?= $profession ?></strong></p>
        <div class=" d-flex justify-content-center align-items-center  mx-auto text-center">
            <div class="mr-5 d-flex flex-column justify-content-center align-items-center  my-auto text-center">
                <h4 class="textColorBlue "> <i class="fas fa-graduation-cap"></i>Cursus scolaire</h4>
                <?php
                //cursus scolaire
                $stmt = $db->prepare("SELECT * FROM `cursusscolaire` where `id_user`= :id_utlisateur ");
                $stmt->bindParam(':id_utlisateur', $id_user_consulter);
                $stmt->execute();
                $cursus = $stmt->fetchAll();
                if ($cursus) {
                    foreach ($cursus as $row => $colonne) {
                        $annee = $colonne['annee'];
                        $formation = $colonne['formation'];
                        $etablissement = $colonne['etablissement'];
                ?>
                        <span class="h5 mt-2 p-2 border"><?= "Annee: " . $annee . ", Formation:  " . $formation . ", Etablissement: " . $etablissement   ?></span>
                <?php
                    }
                } else {
                    echo "<span class='text-muted text-center'> Aucunne formation ajoutée</span>";
                }

                ?>

            </div>
            <div class=" ml-5 d-flex flex-column justify-content-center align-items-center  my-auto text-center">
                <h4 class="textColorBlue "><i class="fas fa-briefcase"></i> Experiences Professionnelles</h4>
                <?php
                //experienece professionnelles
                $stmt = $db->prepare("SELECT * FROM `parcousprofessionnel` where `id_user`= :id_utlisateur ");
                $stmt->bindParam(':id_utlisateur', $id_user_consulter);
                $stmt->execute();
                $experience = $stmt->fetchAll();
                if ($experience) {
                    foreach ($experience as $row => $colonne) {
                        $date_debut = $colonne['date_debut'];
                        $date_fin = $colonne['date_fin'];
                        $post_occupe = $colonne['post_occupe'];
                        $type_emploi = $colonne['type_emploi'];
                        $entreprise = $colonne['entreprise'];
                        if (is_null($date_fin) or empty($date_fin)) {
                            $date_fin = "En cours...";
                        }

                ?>
                        <b class="text-fluid h5 mb-3 p-2 border"><?= "DEBUT: " . $date_debut . "    -  FIN:  " . $date_fin . " <br/>Poste : " . $post_occupe . "<br/> Type d'emploi : " . $type_emploi . ",  <br/>Entreprise: " . $entreprise   ?></b>
                <?php
                    }
                } else {
                    echo "<span class='text-muted text-center'> Aucunne experienece professionnelle ajoutée</span>";
                }

                ?>
            </div>

        </div>
        <h5 class="text-center text-fluid mt-5 mb-3 textColorBlue "><i class="fas fa-gamepad" style="font-size:25px; color:#13204d"></i> Hobbies</h5>
        <div class="d-flex   justify-content-center align-items-center  my-auto w-100">
            <?php
            //hobbieses
            $stmt = $db->prepare("SELECT * FROM `hobbies` where `id_user`= :id_utlisateur ");
            $stmt->bindParam(':id_utlisateur', $id_user_consulter);
            $stmt->execute();
            $hobbies = $stmt->fetchAll();
            if ($hobbies) {
                foreach ($hobbies as $row => $colonne) {
                    $hobbie = $colonne['hobbie'];

            ?>
                    <span class="h5 mx-4 border "><?= $hobbie ?></span>
            <?php
                }
            } else {
                echo "<span class='text-muted text-center '> Aucun Hobbie ajouté</span>";
            }

            ?>
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