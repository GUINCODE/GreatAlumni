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

    ?>
    <h2 class="text-center ">Annuaire des anciens </h2>
    <div class="container d-flex justify-content-center align-items-center ml-auto">
        <div class="  ml-5 d-flex justify-content-center align-items-center mb-2 w-100 ml-auto pl-5 ">
            <input type="search" placeholder="saisir le nom, le prenom, la promotion, le campus, la profession..." class="ml-5 form-control  text-center  shadow-lg border-bottom boder-dark  rounded  bg-light " id="myInput">
            <i class="fas fa-search w-25" style="font-size:27px"></i>
        </div>
    </div>

    <div class="ml-5 mt-3 d-flex justify-content-center align-items-center">
        <div class="mr-5" id="tri1">
            <label for="cars">Trier par: </label>

            <select id="tri_By">
                <option value="aucun">aucun</option>
                <option value="nom">Nom</option>
                <option value="prenom">Prenom</option>
                <option value="promotion">Promotion</option>

            </select>
            <span class="text-warning">ASC</span>
        </div>
        <div class="ml-5" id="tri1">
            <label for="cars">Afficher par campus: </label>

            <select name="" id="show_by_campus">
                <option value="all_campus">All</option>
                <option value="campus1">Campus 1</option>
                <option value="campus2">Campus 2</option>
                <option value="campus3">Campus 3</option>

            </select>

        </div>

    </div>
    <div class="row annuaire_conten mx-5 my-3 overflow-auto h-100" id="annuaire_conten">
        <?php
        $stmt = $db->prepare("SELECT * FROM `utilisateur` ");
        $stmt->bindParam(':id_utlisateur_connecter', $id_user_conecter);
        $stmt->execute();
        $users_list = $stmt->fetchAll();
        foreach ($users_list as $row => $colonne) {

            $id_authe_user = $colonne['id'];
            $nom = $colonne['Nom'];
            $prenom = $colonne['Prenom'];
            $promotion = $colonne['Annee_promotion'];
            $campus = $colonne['campus'];
            $profession = $colonne['profession'];
            $profil = $colonne["Photo"];
            if (is_null($profil) or empty($profil)) {
                $profil = "../images/medias_users/profil_par_defaut.jpg";
            }
        ?>
            <!-- member -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3  border shadow-lg pb-1 rounded memberAnnuaire">
                <div class="w-100 d-flex justify-content-center align-items-center">
                    <img src='<?= $profil ?>' class=' img-fluid UserProfil_qrs' alt='...'>
                </div>
                <span class="w-100 d-flex justify-content-center align-items-center mt-1 mb-2">
                    <strong><?= $nom . " " . $prenom ?></strong>
                </span>

                <p class="text-fluid d-flex flex-column">
                    <span>Campus: <strong><?= $campus ?></strong></span>
                    <span>Promotion: <strong><?= $promotion ?></strong></span>
                    <span>Profession: <strong><?= $profession ?></strong></span>
                </p>
                <a href="profli_consulter.php?id_user_consulter=<?= $id_authe_user ?>" class="btn btn-outline-info btn-sm btn-sm  d-flex w-50 justify-content-center align-items-center mx-auto shadow rounded Mbouton "> voir le profil</a>

            </div>


        <?php
        }
        ?>


    </div>






    <?php
    include_once('../partials/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="../script/script.js"></script>
    <script src="../script/jQueryScript.js"></script>
    <script>


    </script>


</body>

</html>