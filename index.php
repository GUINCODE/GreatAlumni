<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" sizes="16x16" href="./images/logos/small_log.png">

    <title>GreatAlumni</title>
    <!-- -------cdn css & js AOS--- -->
    <!-- -----cdn jQuery----  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <!-- -----cdn fontawsone----  -->
    <script src="https://kit.fontawesome.com/94935e316c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/designY.css">
</head>

<body>
    <div class="loginPageBody">


        <div class="container d-flex  contien_login_page">
            <div class="section_wellcom mr-4 ">
                <img src="./images/logos/logo3.png" alt="..." class="img-fluid mb-2 ml-5" style=" width: 30rem;" /><br />
                <span style=" font-size:30px;"> Plateforme d'echange et de partage des etudiants actuels et anciens de <strong>GREATCOM+ </strong></span>
            </div>
            <div class=" section_connexion boxeShadower rounded d-flex flex-column">
                <form method="post">
                    <div class="form-group   d-flex flex-column ">
                        <input type="text" placeholder="login or e-mail" class="form-control champsEmail rounded" name="email" />
                        <small class="text-danger email_vide  hideurClass">champs vide *</small>
                        <input type="password" placeholder="password" class="form-control mt-3 champsPsw rounded" name="psw" />
                        <small class="text-danger psw_vide hideurClass">champs vide *</small>
                    </div>

                    <button class="loginUser btn btn-outline-success btn-sm  py-2  Mbouton rounded d-flex justify-content-center align-items-center" style="font-size:15px"><i class="fas fa-spinner mr-2 smoll_fresh hideurClass" style="font-size:20px"></i>login </button>
                </form>
                <div class="infosErreur"></div>
                <div class=" border-top mt-5 ">
                    <span type="button" class="mt-3  boxeShadower text-dark p-1  bg-light rounded Mbouton d-flex justify-content-center align-items-center"><img src="./images/logos/google2.png" class="img-fluid mr-2" style="width:30px" /></i>Login with google</span>
                </div>



            </div>



        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <!-- <script src="./script/script.js"></script> -->
    <script src="./Controller/jQueryScript.js"></script>
    <!-- <script>
       
    </script> -->

</body>

</html>