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
        include_once("../partials/header.php");

        ?>
        <div class="container">
            <h2 class="text-center mb-5">FORUM D'ECHANGE ET DE PARTAGE</h2>
            <input type="hidden" value="<?= $id_user_conecter; ?>" class="id_user_log" />
            <span class=" mb-3 btn btn-sm Mbouton d-flex btn_creer_sujet justify-content-center align-items-center mx-auto rounded "><i class="fas fa-file-alt mr-2" style="font-size:25px"></i>Creer un sujet</span>
            <div class="w-100 border les_sujet  ">
                <span class="text-muted bg-lignt p-3"> les sujets déja abordés</span>
                <?php
                //sujet forum
                $stmt = $db->prepare("SELECT * FROM `sujet_forum`  order by date_creation DESC ");
                $stmt->execute();
                $sujets = $stmt->fetchAll();

                foreach ($sujets as $row => $colonne) {
                    $id_sujet = $colonne["id"];
                    $titre = $colonne["titre"];
                    $categorie = $colonne["categorie"];
                    $id_auteur = $colonne["id_auteur"];

                    $stmt2 = $db->prepare("SELECT DISTINCT `id_repondeur` FROM `reponse_sujet`  WHERE `id_sujet`=:id_sujet");
                    $stmt2->bindParam(":id_sujet", $id_sujet);
                    $stmt2->execute();
                    $countaction = $stmt2->rowCount();
                ?>
                    <div class=" d-flex justify-content-center align-items-center shadow border rounded py-2 my-2">
                        <div class="d-flex justify-content-center alignt-items-center flex-column ml-4 text-wrap">
                            <span class="h5"><?= $titre ?> </span>
                            <span class=""> <span class="text-muted">Categorie:</span> <?= $categorie ?></span>
                            <span> <span class="text-muted">Nombre de participant: </span> <?= $countaction ?></span>
                        </div>
                        <input type="hidden" value="<?= $id_sujet ?>" class="id_sujet" />
                        <input type="hidden" value="<?= $titre ?>" class="titre_sujet" />
                        <input type="hidden" value="<?= $categorie ?>" class="categorie_sujet" />
                        <span class="btn btn-sm Mbouton  ml-auto  mr-5 rounded acceder_sujet lireSujet">acceder</span>
                    </div>

                <?php
                }

                ?>



            </div>
            <div class="discussion hideurClass">
                <span class="btn retour_btn_forum Mbouton rounded my-3 d-flex  justify-content-center align-items-center"><i class="fas fa-chevron-left" style="font-size:25px"></i>Retour</span>
                <div class="d-flex justify-content-center alignt-items-center mt-4 ">

                    <div class="d-flex justify-content-center alignt-items-center flex-column  bg-secondary p-2 w-75">
                        <p class="h5 border-bottom py-2 text-wrap rounded titre_sujet_selected"> SUJET</p>
                        <input type="hidden" value="" class="id_sujet_selected" />
                        <span class="text-muted">Categorie <span class="categorie_sujet_selected text-dark">[ici categorie du sujet]</span></span>

                    </div>
                </div>
                <small class=" my-3 text-muted d-flex justify-content-center">les intervations sur ce sujet</small>
                <ul class="mt-2 d-flex flex-column justify-conter-center align-items-center" id="les_reactionForum">
                </ul>
            </div>






        </div>





        <?php
        include_once("../partials/footer.php");
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
        <script src="../script/script.js"></script>
        <script src="../script/jQueryScript.js"></script>
        <script>
            // acceder au zone echange forum et son retour
            $(".acceder_sujet").click(function(e) {
                e.preventDefault();
                $(this).parents(".les_sujet").toggleClass("hideurClass");
                $(".discussion").toggleClass("hideurClass");
            });
            $(".retour_btn_forum").click(function(e) {
                e.preventDefault();
                $(".les_sujet").toggleClass("hideurClass");
                $(".discussion").toggleClass("hideurClass");
            });

            // load discussion sur un sujet specifique
            $(".lireSujet").click(function(e) {
                e.preventDefault();
                let id_sujet = $(this).siblings(".id_sujet").val();
                let titre_sujet = $(this).siblings(".titre_sujet").val();
                let categorie_sujet = $(this).siblings(".categorie_sujet").val();

                $(".titre_sujet_selected").text(titre_sujet);
                $(".categorie_sujet_selected").text(categorie_sujet);
                $(".id_sujet_selected").val(id_sujet);
                let id_user_connecter = $(".id_user_log").val();

                $.ajax({
                        type: "POST",
                        url: "../_partials_forum/_load_rep_sujet.php",
                        data: {
                            id_sujet: id_sujet,
                            id_user_connecter: id_user_connecter,
                        },
                    })
                    .done(function(response) {
                        $("#les_reactionForum").html(response);
                    })
                    .fail(function() {
                        console.log("error");
                    });
            });
        </script>


    </body>

    </html>