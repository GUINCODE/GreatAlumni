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


    <div class="row ">
        <div class="col-3  ">

            <div class="mt-3  ">

                <?php
                include_once('../_partials_actualite/_carousel_evenement.php');
                ?>
            </div>


        </div>
        <div class="col-6 ">
            <!-- -----fil_article--- -->
            <div class="mt-3 ">
                <?php
                include_once('../_partials_actualite/_fil_article.php');
                ?>
            </div>
            <!-- --end fil_article--- -->
        </div>
        <div class="col-3 ">
            <?php
            include_once('../_partials_actualite/_partages.php');
            ?>
        </div>

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