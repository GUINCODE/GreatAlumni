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

    <body id="body_forum">
        <?php
        include_once("../partials/header.php");

        ?>
        <div class="container ">
            <h2 class="text-center mb-5">FORUM D'ECHANGES ET DE PARTAGES</h2>
            <input type="hidden" value="<?= $id_user_conecter; ?>" class="id_user_log" />
            <span class=" mb-3 btn btn-sm Mbouton d-flex btn_creer_sujet justify-content-center align-items-center mx-auto rounded  btn_creer_sujet" data-toggle="modal" data-target="#modal_creer_article"><i class="fas fa-file-alt mr-2" style="font-size:25px"></i>Creer un sujet</span>
            <div class="w-100 border les_sujet  ">
                <div class="d-flex  justify-content-center align-items-center mb-5 ">
                    <div class="d-flex w-50  justify-content-center align-items-center border bg-light  rounded p-2 mr-5">
                        <input id="inputchercheSujet" type="search" class="ml-1 form-control bg-light border-0 chercheTopic" placeholder="Chercher un sujet" /> <i class="fas fa-search ml-auto" style="font-size:34px"></i>

                    </div>
                    <div class="ml-5 ">
                        <span>Catégorie: </span>
                        <select id="tri_categorie" class="p-2">
                            <option value="toutes">Toutes</option>
                            <option value="emploi">Emploi</option>
                            <option value="stage">Stage</option>
                            <option value="juridique">Juridique</option>
                            <option value="divers">Divers</option>

                        </select>
                    </div>

                </div>


                <span class="text-muted bg-lignt p-3 h5 mb-2"> les sujets déja abordés</span>
                <div id="All_topic">
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
                        $date_creation = $colonne["date_creation"];

                        if (strlen($titre) > 200) {
                            $text_reduit = substr($titre, 0, 200);
                            $leTitre = $text_reduit . "...";
                        } else {
                            $leTitre = $titre;
                        }

                        // compter le nombre de personne qui ont intervenu sur ce sujet 
                        $stmt2 = $db->prepare("SELECT DISTINCT `id_repondeur` FROM `reponse_sujet`  WHERE `id_sujet`=:id_sujet");
                        $stmt2->bindParam(":id_sujet", $id_sujet);
                        $stmt2->execute();
                        $countaction = $stmt2->rowCount();

                        //recuperer le nom de l'auteur:
                        $stmt = $db->prepare("SELECT * FROM `utilisateur`   WHERE `id`=:id_auteur ");
                        $stmt->bindParam(":id_auteur", $id_auteur);
                        $stmt->execute();
                        $colonne = $stmt->fetch();
                        $nom = $colonne['Nom'];
                        $prenom = $colonne['Prenom'];

                        // compter le nomre d'intervation sur ce sujet
                        $stmt3 = $db->prepare("SELECT  * FROM `reponse_sujet`  WHERE `id_sujet`=:id_sujet");
                        $stmt3->bindParam(":id_sujet", $id_sujet);
                        $stmt3->execute();
                        $nombreReaction = $stmt3->rowCount();

                        // verifier si l'utilisateur connecter a participer ou non
                        $stmt4 = $db->prepare("SELECT  * FROM `reponse_sujet`  WHERE `id_sujet`=:id_sujet AND `id_repondeur`=:id_repondeur");
                        $stmt4->bindParam(":id_sujet", $id_sujet);
                        $stmt4->bindParam(":id_repondeur", $id_user_conecter);
                        $stmt4->execute();
                        $partcipationUser = $stmt4->rowCount();
                        if ($partcipationUser > 0) {
                            $infos_participation = '<span class=" mt-1 mb-1 text-success" > <i class="fas fa-circle mr-1" ></i>Vous avez participé    </span>';
                        } else {
                            $infos_participation = '<span class=" mt-1 mb-1 text-warning" > <i class="fas fa-circle mr-1" ></i>Vous n\'avez  pas participé encore   </span>';
                        }


                    ?>
                        <!-- un sujet -->
                        <div class=" d-flex justify-content-center align-items-center shadow border rounded py-2 my-2 " id="topic">
                            <div class="d-flex justify-content-center alignt-items-center flex-column ml-4 text-wrap">
                                <span class="h5 border border-bottom p-2 leSujet"><?= $leTitre ?> </span>
                                <span class="categorieX"> <span class="text-muted">Categorie:</span> <span style="font-weight: bold; color:#071035 " class="h4"><?= $categorie ?></span></span>
                                <span class=""> <span class="text-muted">date de création:</span> <?= $date_creation ?></span>
                                <span class=""> <span class="text-muted">Auteur :</span> <a href="profli_consulter.php?id_user_consulter=<?= $id_auteur ?>"> <?= $nom . " " . $prenom ?> </a></span>
                                <span> <span class="text-muted">Nombre de participant(s): </span> <?= $countaction ?></span>
                                <span> <span class="text-muted">Nombre de réaction(s): </span> <?= $nombreReaction ?></span>
                                <?= $infos_participation  ?>
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
                <!-- champs input pour reagir a sujet donné  -->
                <div class="w-75 d-flex justify-conter-center align-items-center mx-auto mt-3 shadow p-2 rounded">
                    <textarea autofocus placeholder="Dites quelques choses..." cols="5" rows="2" class="rounded form-control textareaRepSujet" id="champSaisie_reponse"></textarea>
                    <span type="button" class="ml-1 btbt d-flex justify-conter-center align-items-center " style="font-size:30px" id="btn_repondre_sujet">
                        <img src="../images/ressourcesLogo/sendMessageIcn.png" alt="..." class="img-fluid linkImageH" style="width:65px" />
                        </send>
                </div>
            </div>






        </div>


        <!-- Creation de  nouveaux Sujet  -->
        <div class="modal fade   " id="modal_creer_article" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
            <div class="modal-dialog  " style="max-width: 50%;" role="document">
                <div class="modal-content rounded  shadow-lg">
                    <div class="modal-header backgroundSecondPlan rounded-top">
                        <h5 class="modal-title text-center" id="staticBackdropLabel2">Creation de Sujet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body space_response_eve_admin">


                        <form class="rounded  w-100 " enctype="multipart/form-data" id="creer_sujet_formulaire">
                            <div class="form-row w-100 mt-3 ">
                                <input type="hidden" value="<?= $id_user_conecter ?>" name="id" />
                                <div class="col ">
                                    <textarea rows="3" name="sujet" cols="4" class="form-control" placeholder="saisir le sujet ici ...." required></textarea>
                                </div>


                            </div>
                            <div class="form-row w-50 d-flex justify-content-center align-items-center  mt-3 ">
                                <label> Catégorie</label>
                                <div class="col">
                                    <select id="categorie" name="categorie" class="form-control">
                                        <option value="emploi">Emploi</option>
                                        <option value="stage">Stage</option>
                                        <option value="juridique">Juridique </option>
                                        <option value="divers" selected>Divers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-100  border border-top mt-3 shadow bg-dark">
                                <div class="form-group  w-50  pt-3 d-flex mx-auto  ">
                                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-info rounded"> Annuler
                                    </button>
                                    <input type="submit" class="btn btn-outline-success  btn-sm ml-auto rounded" value="Valider">

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div> <!--  fin modal Ajout formation -->


        <?php
        include_once("../partials/footer.php");
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>

        <script src="../Controller/jQueryScript.js"></script>
        <script>
            $("#inputchercheSujet").keyup(function() {
                // Retrieve the input field text and reset the count to zero
                var filter = $(this).val(),
                    count = 0;
                // Loop through the comment list
                $("#All_topic div").each(function() {
                    // If the list item does not contain the text phrase fade it out
                    if ($(this).find(".leSujet").text().search(new RegExp(filter, "i")) < 0) {
                        // $(this).hide(); // MY CHANGE
                        $(this).addClass("hideurClass")

                        // Show the list item if the phrase matches and increase the count by 1
                    } else {
                        $(this).removeClass("hideurClass")
                        count++;
                    }
                });
            });

            // trier les sujets par categorie 
            $("#tri_categorie").change(function(e) {
                e.preventDefault();
                let choixCategorie = $(this).val();
                if (choixCategorie == "toutes") {
                    $("#All_topic div").removeClass("hideurClass")
                } else {
                    $("#All_topic div").each(function() {
                        // If the list item does not contain the text phrase fade it out
                        if ($(this).find(".categorieX").text().search(new RegExp(choixCategorie, "i")) < 0) {

                            $(this).addClass("hideurClass")

                            // Show the list item if the phrase matches and increase the count by 1
                        } else {
                            $(this).removeClass("hideurClass")

                        }
                    });
                }


            });
        </script>


    </body>

    </html>