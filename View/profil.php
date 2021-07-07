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
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="">
    <?php
    include_once('../partials/header.php');
    ?>
    <div class="container ">
        <div class="  d-flex justify-content-start align-items-center mt-2">
            <div class=" flex-column">
                <div class="contien_img_profil  mr-5">
                    <img src="<?= $profil_user_connect ?>" alt="profil user" class="img-fluid  imgProfilUIser" />
                </div>
                <span class=" btn p-1 rounded btn-sm Mbouton mt-1" data-toggle="modal" data-target="#modal_update_profil">
                    <i class="fas fa-pencil-alt mr-1"></i> changer ma photo</span>

            </div>

            <div class="data_infos_user  d-flex flex-column  ml-5">
                <?php
                $stmt = $db->prepare("SELECT * FROM `utilisateur` where `id`= :id_utlisateur ");
                $stmt->bindParam(':id_utlisateur', $id_user_conecter);
                $stmt->execute();
                $colonne = $stmt->fetch();

                $nom = $colonne['Nom'];
                $prenom = $colonne['Prenom'];
                $promotion = $colonne['Annee_promotion'];
                $campus = $colonne['campus'];
                $profession = $colonne['profession'];
                $citation = $colonne['Zone_de_texte'];
                $departement = $colonne['Departement'];
                $mail = $colonne['Mail'];
                $login = $colonne['Loginn'];
                $password = $colonne['Mdp'];

                ?>
                <input type="hidden" value="<?= $id_user_conecter ?>" id="id_user_conecter" />
                <input type="hidden" value="<?= $nom ?>" id="nom" />
                <input type="hidden" value="<?= $prenom ?>" id="prenom" />
                <input type="hidden" value="<?= $campus ?>" id="campus" />
                <input type="hidden" value="<?= $profession ?>" id="profession" />
                <input type="hidden" value="<?= $citation ?>" id="citation" />
                <input type="hidden" value="<?= $departement ?>" id="departement" />
                <input type="hidden" value="<?= $mail ?>" id="mail" />
                <input type="hidden" value="<?= $promotion ?>" id="promotion" />
                <input type="hidden" value="<?= $profil_user_connect ?>" id="profil" />
                <input type="hidden" value="<?= $login ?>" id="login" />
                <input type="hidden" value="<?= $password ?>" id="password" />

                <span class="h4 text-fluid"><i class="text-muted">Nom:</i> <?= $nom ?></span>
                <span class="h4 text-fluid"><i class="text-muted">Prénom: </i><?= $prenom ?></span>
                <span class="h4 text-fluid"><i class="text-muted">Proféssion:</i> <?= $profession ?></span>
                <span class="h4 text-fluid"><i class="text-muted"> Campus: </i><?= $campus ?></span>
                <span class="h4 text-fluid"><i class="text-muted"> Année promotion:</i> <?= $promotion ?></span>
                <span class="h4 text-fluid"><i class="text-muted"> Département:</i> <?= $departement ?></span>
                <span class="h4 text-fluid"><i class="text-muted"> E-mail:</i> <?= $mail ?></span>
            </div>
            <span class="ml-auto mr-5 btn p-1 rounded Mbouton " id="btn_mofier_user_infos" data-toggle="modal" data-target="#modal_new_memeber"><i class="fas fa-pencil-alt mr-1"> </i>Modifier mes infos</span>

        </div>
        <div class="container ">
            <p class="text-center text-fluid mt-3 mx-5 mb-5 p-1 shadow rounded macitation">
                " <?= $citation ?> " <br>
                <span class="btn btn-sm  Mbouton mt-2 rounded update_citation" data-toggle="modal" data-target="#modal_update_citation">Modifier <i class="fas fa-pencil-alt ml-1"> </i></span>
            </p>
            <div class="d-flex justify-content-center align-items-center ">
                <span class="h4 mr-3  boutonAllBlue btn btn-outline btn-sm item_active_Profil  btn_formation_user"> <i class="fas fa-graduation-cap mr-2"></i>FORMATIONS</span>
                <span class="h4 mx-5  boutonAllBlue btn btn-outline btn-sm btn_experience_user "><i class="fas fa-briefcase mr-2"></i>EXPERIENCES</span>
                <span class="h4 ml-3 boutonAllBlue btn btn-outline btn-sm btn_hobbie_user"><i class="fas fa-gamepad mr-2"></i>HOBBIES</span>
            </div>
            <div class="container">
                <!-- mon cursus scolaire -->
                <div class="MesFormations  communeClass d-flex flex-column justify-content-center align-items-center pt-2  ">
                    <div>
                        <span class="text-muted h2 mr-5"> Mes Formations scolaires</span>
                        <span class="Mbouton p-2 rounded-circle ajoutTruc" data-toggle="modal" data-target="#modal_add_formation"> <i class="fas fa-plus"></i></span>
                    </div>
                    <div class=" d-flex w-75 mx-auto border mt-3 p-2 flex-column ">
                        <?php
                        //cursus scolaire
                        $stmt = $db->prepare("SELECT * FROM `cursusscolaire` where `id_user`= :id_utlisateur ORDER BY annee DESC ");
                        $stmt->bindParam(':id_utlisateur', $id_user_conecter);
                        $stmt->execute();
                        $cursus = $stmt->fetchAll();
                        if ($cursus) {
                            foreach ($cursus as $row => $colonne) {

                                $id = $colonne['id'];
                                $annee = $colonne['annee'];
                                $formation = $colonne['formation'];
                                $etablissement = $colonne['etablissement'];
                        ?>
                                <div class=" d-flex justify-content-center align-items-center my-2 border">
                                    <div class=" d-flex flex-column  mb-2 w-50 ">
                                        <b class="h5"><?= $etablissement ?></b>
                                        <span><?= $formation ?></span>
                                        <span><?= $annee ?> </span>
                                    </div>
                                    <div class="d-flex  justify-content-center align-items-center ml-auto mr-5">
                                        <span class="btn btn-outline-info btn-sm mr-2 rounded Mbouton btn_update_formation" data-toggle="modal" data-target="#modal_update_formation"> <i class="fas fa-pencil-alt"> </i> Modifier </span>
                                        <span class="btn btn-outline-danger btn-sm rounded btn_delete_formation" data-toggle="modal" data-target="#delete_formation_modal"><i class="far fa-trash-alt"></i> Supprimer </span>
                                        <input type="hidden" value="<?= $id ?>" class="id_formation" />
                                        <input type="hidden" value="<?= $annee ?>" class="annee_formation" />
                                        <input type="hidden" value="<?= $formation ?>" class="name_formation" />
                                        <input type="hidden" value="<?= $etablissement ?>" class="ecole_formation" />
                                    </div>
                                </div>
                            <?php

                            }
                        } else {
                            ?>
                            <span class="text-muted h4 text-center"> aucune formtion ajoutée</span>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <!-- mes experiences professionnelles -->
                <div class="MesExperiences communeClass d-flex flex-column justify-content-center align-items-center pt-2 hideurClass ">
                    <div>
                        <span class="text-muted h2 mr-5"> Mes expériences professionnelles</span>
                        <span class="Mbouton p-2 rounded-circle ajoutTruc" data-toggle="modal" data-target="#modal_add_experience"> <i class="fas fa-plus"></i></span>
                    </div>
                    <div class=" d-flex w-75 flex-column justify-content-center align-items-center mx-auto border mt-3 p-2">
                        <?php
                        //experienece professionnelles
                        $stmt = $db->prepare("SELECT * FROM `parcousprofessionnel` where `id_user`= :id_utlisateur  ORDER BY  date_debut DESC");
                        $stmt->bindParam(':id_utlisateur', $id_user_conecter);
                        $stmt->execute();
                        $experience = $stmt->fetchAll();
                        if ($experience) {
                            foreach ($experience as $row => $colonne) {
                                $id = $colonne['id'];
                                $date_debut = $colonne['date_debut'];
                                $date_fin = $colonne['date_fin'];
                                $post_occupe = $colonne['post_occupe'];
                                $type_emploi = $colonne['type_emploi'];
                                $entreprise = $colonne['entreprise'];
                                if (is_null($date_fin) or empty($date_fin)) {
                                    $date_fin = "En cours...";
                                }

                        ?>
                                <div class=" w-100 d-flex  my-2 border">

                                    <div class=" d-flex flex-column  mb-2 ">
                                        <b class="h5"><?= $entreprise ?></b>
                                        <span><?= $post_occupe ?></span>
                                        <span> <?= $type_emploi ?></span>
                                        <span><?= $date_debut ?> - <?= $date_fin ?></span>
                                    </div>
                                    <div class="d-flex  justify-content-center align-items-center ml-auto ">
                                        <input type="hidden" value="" />
                                        <span class="btn btn-outline-info btn-sm mr-2 rounded Mbouton btn_update_experience" data-toggle="modal" data-target="#modal_update_experience"> <i class="fas fa-pencil-alt"> </i> Modifier </span>
                                        <span class="btn btn-outline-danger btn-sm rounded btn_delete_experience" data-toggle="modal" data-target="#delete_experience_modal"><i class="far fa-trash-alt"></i> Supprimer </span>
                                        <input type="hidden" value="<?= $id ?>" class="id_experience" />
                                        <input type="hidden" value="<?= $date_debut ?>" class="date_debut" />
                                        <input type="hidden" value="<?= $date_fin ?>" class="date_fin" />
                                        <input type="hidden" value="<?= $post_occupe ?>" class="post_occupe" />
                                        <input type="hidden" value="<?= $type_emploi ?>" class="type_emploi" />
                                        <input type="hidden" value="<?= $entreprise ?>" class="entrepriseXZ" />
                                    </div>

                                </div>
                        <?php
                            }
                        } else {
                            echo "<span class='text-muted text-center'> Aucunne experienece professionnelle ajoutée</span>";
                        }

                        ?>

                    </div>

                </div>
                <!-- mes hobbies -->
                <div class="MesHobbies communeClass d-flex flex-column justify-content-center align-items-center pt-2 hideurClass  ">
                    <div>
                        <span class="text-muted h2 mr-5"> Mes Hobbies</span>
                        <span class="Mbouton p-2 rounded-circle ajoutTruc " data-toggle="modal" data-target="#modal_new_hobbie"> <i class="fas fa-plus"></i></span>
                    </div>
                    <div class="d-flex w-75 mx-auto border mt-3 p-2 ">
                        <div class="d-flex flex-column  mb-2 w-50 mx-auto ">
                            <?php
                            //hobbieses
                            $stmt = $db->prepare("SELECT * FROM `hobbies` where `id_user`= :id_utlisateur ");
                            $stmt->bindParam(':id_utlisateur', $id_user_conecter);
                            $stmt->execute();
                            $hobbies = $stmt->fetchAll();
                            if ($hobbies) {
                                foreach ($hobbies as $row => $colonne) {
                                    $id_hobbieReq = $colonne['id'];
                                    $hobbie = $colonne['hobbie'];


                            ?>
                                    <div class="w-100  my-2">
                                        <input type="hidden" value="" />
                                        <span class=" mr-5"><?= $hobbie ?></span>
                                        <span class=" ml-5">
                                            <i class="fas fa-pencil-alt mr-4 btn_update_hobbie " type="button" data-toggle="modal" data-target="#modal_update_hobbie"></i>
                                            <input type="hidden" value="<?= $id_hobbieReq ?>" class="id_hobbbie" />
                                            <input type="hidden" value="<?= $hobbie ?>" class="nom_du_hobbie" />
                                            <i class="far fa-trash-alt text-danger btn_delete_hobbie" type="button" data-toggle="modal" data-target="#modal_delete_hobbie"></i></span>


                                    </div>
                            <?php
                                }
                            } else {
                                echo "<span class='text-muted text-center '> Aucun Hobbie ajouté</span>";
                            }

                            ?>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- les modales pour modifier les informations des utilisateurs  -->

    <!-- Modification des informations du user connecter -->
    <div class="modal fade   " id="modal_new_memeber" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 75%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Modification de mes informations</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">

                    <form class="rounded  w-100 " id="updateUserLogin_formulaire">

                        <div class="zoneAlerte"></div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col ">
                                <input type="hidden" value="<?= $id_user_conecter ?>" name="id" />
                                <input type="text" class="form-control nomUser" placeholder="Nom" name="nom" required>
                            </div>
                            <div class="col ">
                                <input type="text" class="form-control prenomUser" placeholder="Prenom" name="prenom" required>
                            </div>
                        </div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col ">
                                <input type="email" class="form-control mailUser" placeholder="Mail" name="mail" required>
                            </div>
                            <div class="col ">
                                <input type="number" class="form-control promotionUser" placeholder=" Annee de promotion" name="annee" required>
                            </div>

                        </div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col  d-flex align-items-center">
                                <input type="text" class="form-control mr-1 loginW" id="login" placeholder="Login" name="login" required>
                                <!-- <i class="fas fa-redo _btn_all generate" style="font-size:25px; color:thistle" type="button"></i> -->
                            </div>
                            <div class="col d-flex align-items-center">
                           
                                <input type="text" class="form-control mr-1 passwordW " id="password" placeholder="Nouveau mot de passe" name="mdp">
                                <i class="fas fa-redo _btn_all generate" style="font-size:25px; color:thistle" type="button"></i>

                            </div>


                        </div>
                        <div class="form-row mt-3 ">
                            <div class="col d-flex  justify-content-center align-items-center">
                                <label class="text-muted mr-2 "> Campus: </label>
                                <select class="form-control campus " name="campus" id="campus" required>
                                    <option value="campus1">Campus 1</option>
                                    <option value="campus2">Campus 2</option>
                                    <option value="campus3">Campus 3</option>
                                </select>
                            </div>
                            <div class="col ">
                                <input type="number" class="form-control departement" placeholder="departement" name="departement" required>
                            </div>

                        </div>
                        <div class="form-row mt-3 ">
                            <div class="col ">
                                <input type="text" class="form-control professionUser" placeholder=" Profession ?     ex: developpeur web chez guisoft ou Etudiant" name="profession" required>
                            </div>
                        </div>


                </div>

                <div class="w-100  border border-top mt-3 shadow bg-dark">
                    <div class="form-group  w-50  pt-3 d-flex mx-auto  ">
                        <input type="reset" class="btn btn-warning  Mbouton btn-sm " value="Reprendre">
                        <input type="submit" class="btn btn-outline-success  btn-sm ml-auto" value="Valider">

                    </div>
                </div>


            </div>



            </form>

        </div>

    </div> <!--  fin modal update user infos -->

    <!-- Modification de citation  -->
    <div class="modal fade   " id="modal_update_citation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 60%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Modifications de ma citation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">

                    <form class="rounded  w-100 " id="update_citation_user">

                        <div class="zoneAlerte"></div>
                        <div class="form-row w-100 mt-3 ">
                            <input type="hidden" value="<?= $id_user_conecter ?>" name="id" />
                            <textarea name="citation" rows="5" cols="105" placeholder="votre citation ou une phrase qui defini votre principe de vie" id="myCitation"></textarea>
                        </div>
                </div>

                <div class="w-100  border border-top mt-3 shadow bg-dark">
                    <div class="form-group  w-50  pt-3 d-flex mx-auto  ">
                        <input type="reset" class="btn btn-warning  Mbouton btn-sm " value="Reprendre">
                        <input type="submit" class="btn btn-outline-success  btn-sm ml-auto" value="Valider">

                    </div>
                </div>
            </div>
            </form>
        </div>
    </div> <!--  fin modal update citation user -->

    <!-- Modifier la photo de profil de l'utilisateur  -->
    <div class="modal fade   " id="modal_update_profil" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 70%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Modification de la photo de profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">


                    <form class="rounded  w-100 " enctype="multipart/form-data" id="update_profil_user">
                        <div class="form-row w-100 mt-1 d-flex justify-content-center align-items-center ">
                            <span class="h5 text-muted mr-3 ml-5"><span class="text-infos">ratio</span> image <strong>recommandée: </strong>
                                <span class="h3 text-info mr-1">1:1</span> <i class="fas fa-arrow-right flex_recommanded_img ml-3" style="font-size:25px"></i>
                            </span>
                            <img src="../images/recommanderImage.jpg" alt="..." style="width:450px">

                        </div>


                        <div class="form-row w-100 mt-1 ">
                            <input type="hidden" value="<?= $id_user_conecter ?>" name="id" />
                            <label> Ajouter une nouvelle photo de profil <br> <small class="text-muted"> type d'image prise en charge: (png, gif, jpg,
                                    ou
                                    jpeg) </small>
                            </label>
                            <input type="file" name="media_post" accept=".jpg, .png, .gif" class="form-control form-control-sm  rounded" required>
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
    </div> <!--  fin modal Modifier la photo de profil de l'utilisateur-->

    <!-- gestion cursus -->
    <!-- Ajout d'une nounelle formation  -->
    <div class="modal fade   " id="modal_add_formation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 50%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Ajout d'une formation scolaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">


                    <form class="rounded  w-100 " enctype="multipart/form-data" id="add_new_formation">
                        <div class="form-row w-100 mt-3 ">
                            <input type="hidden" value="<?= $id_user_conecter ?>" name="id" />
                            <div class="col-4 ">
                                <input type="number" class="form-control " placeholder=" Année scolaire " name="annee" required>
                            </div>

                            <div class="col-8">
                                <input type="text" class="form-control " placeholder=" Ecole" name="ecole" required>
                            </div>
                        </div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col">
                                <input type="text" class="form-control " placeholder=" Nom complet de la formation" name="formation" required>
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


    <!-- suppression de formation de l'utlisateur connecter -->
    <div class="modal fade" id="delete_formation_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 50%;" role="document">
            <div class="modal-content rounded shadow-lg mt-5">

                <div class="modal-header bg-danger rounded-top">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">SUPPRéSSION DE Formation</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                    </button>
                </div>
                <div class=" d-flex justify-content-center align-items-center w-50"></div>
                <div class="modal-body zone_infos">
                    <div class=" space_response">
                        <h4> <i class="fas fa-exclamation-triangle mr-4" style="color: rgb(255, 208, 0); font-size:30px"></i>Attention</h4>
                        <strong class="text-warning text-center">Cette action est irreverssible, souhaitez-vous supprimer définitivement cette formation:</strong>
                        <div class="d-flex w-100 align-items-center  mt-5">
                            <button class="btn btn-outline-primary annulerBTN_Z btn-sm rounded ml-4" data-dismiss="modal" aria-label="Close">ANNULER</button>
                            <button class="btn btn-outline-danger  btn-sm rounded ml-auto  valid_sup_formation  mr-4">SUPPRIMER</button>
                            <input type="hidden" value="" class="formation_id_del" />

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- fin delete formation -->

    <!-- Modification de formation  -->
    <div class="modal fade   " id="modal_update_formation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 50%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Modification de formation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">


                    <form class="rounded  w-100 " enctype="multipart/form-data" id="update_formation">
                        <div class="form-row w-100 mt-3 ">
                            <input type="hidden" value="" name="id" class="idF" />
                            <div class="col-4 ">
                                <input type="number" class="form-control anneeF" placeholder=" Année scolaire " name="annee" required>
                            </div>

                            <div class="col-8">
                                <input type="text" class="form-control ecoleF" placeholder=" Ecole" name="ecole" required>
                            </div>
                        </div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col">
                                <input type="text" class="form-control nomF " placeholder=" Nom complet de la formation" name="formation" required>
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
    </div> <!--  fin modal modification formation -->
    <!-- fin gestion cursus -->

    <!-- experieneces gestion  -->
    <!-- Ajout d'une nounelle experince  -->
    <div class="modal fade   " id="modal_add_experience" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 70%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Ajout d'une experience proféssionnelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">


                    <form class="rounded  w-100 " enctype="multipart/form-data" id="add_new_experience">
                        <div class="form-row w-100 mt-3 ">
                            <input type="hidden" value="<?= $id_user_conecter ?>" name="id" />
                            <div class="col ">
                                <label>Date début</label>
                                <input type="date" class="form-control " placeholder=" Date début " name="date_debX" required>
                            </div>
                            <div class="col">
                                <label>Date Fin</label>
                                <small class="text-muted"> (NB: laisser ce champs vide si cette ectivitée est en cours...)</small>
                                <input type="date" class="form-control " placeholder=" " name="date_finX">
                            </div>
                        </div>
                        <div class="form-row mt-3  ">
                            <div class="col ">
                                <input type="text" class="form-control " placeholder=" Poste occupé " name="poste" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control " placeholder=" Entreprise " name="entreprise" required>
                            </div>
                        </div>
                        <div class="form-row  ">
                            <div class="col mt-3 d-flex">
                                <label>Type d'emploi: </label>
                                <select class="form-control  " name="type_poste" id="" required>
                                    <option value="stage/alternance">STAGE/ALTERNANCE</option>
                                    <option value="cdd">CDD</option>
                                    <option value="cdi">CDI</option>
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
    </div> <!--  fin modal Ajout experience -->


    <!-- suppression de experience de l'utlisateur connecter -->
    <div class="modal fade" id="delete_experience_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 50%;" role="document">
            <div class="modal-content rounded shadow-lg mt-5">

                <div class="modal-header bg-danger rounded-top">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">SUPPRéSSION D'une éxperience</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                    </button>
                </div>
                <div class=" d-flex justify-content-center align-items-center w-50"></div>
                <div class="modal-body zone_infos">
                    <div class=" space_response">
                        <h4> <i class="fas fa-exclamation-triangle mr-4" style="color: rgb(255, 208, 0); font-size:30px"></i>Attention</h4>
                        <strong class="text-warning text-center">Cette action est irreverssible, souhaitez-vous supprimer définitivement cette éxperience:</strong>
                        <div class="d-flex w-100 align-items-center  mt-5">
                            <button class="btn btn-outline-primary annulerBTN_Z btn-sm rounded ml-4" data-dismiss="modal" aria-label="Close">ANNULER</button>
                            <button class="btn btn-outline-danger  btn-sm rounded ml-auto  valid_sup_experience  mr-4">SUPPRIMER</button>
                            <input type="hidden" value="" class="experience_id_del" />

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- fin delete experinece -->

    <!-- Modification de experiences  -->
    <div class="modal fade   " id="modal_update_experience" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 70%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Modification de l'éxperience</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">


                    <form class="rounded  w-100 " enctype="multipart/form-data" id="add_update_experience">
                        <div class="form-row w-100 mt-3 ">

                            <div class="col ">
                                <label>Date début</label>
                                <input type="hidden" value="" class="id_experience" name="id" />
                                <input type="date" class="form-control date_debX" placeholder=" Date début " name="date_debX" required>
                            </div>
                            <div class="col">
                                <label>Date Fin</label>
                                <small class="text-muted"> (NB: laisser ce champs vide si cette ectivitée est en cours...)</small>
                                <input type="date" class="form-control date_finX" placeholder=" " name="date_finX">
                            </div>
                        </div>
                        <div class="form-row mt-3  ">
                            <div class="col ">
                                <input type="text" class="form-control poste" placeholder=" Poste occupé " name="poste" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control entrepriseYZ" placeholder=" Entreprise " name="entreprise" required>
                            </div>
                        </div>
                        <div class="form-row  ">
                            <div class="col mt-3 d-flex">
                                <label>Type d'emploi: </label>
                                <select class="form-control type_poste " name="type_poste" id="" required>
                                    <option value="stage/alternance">STAGE/ALTERNANCE</option>
                                    <option value="cdd">CDD</option>
                                    <option value="cdi">CDI</option>
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
    </div>
    <!-- fin modal modification experience -->

    <!-- gestion hobbies -->
    <!-- Ajout d'une nounelle hobbie  -->
    <div class="modal fade   " id="modal_new_hobbie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 30%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Ajout de hobbie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">


                    <form class="rounded  w-100 " enctype="multipart/form-data" id="add_new_hobbie">
                        <div class="form-row w-100 mt-3 ">
                            <input type="hidden" value="<?= $id_user_conecter ?>" name="id" />
                            <div class="col ">
                                <label>Entrer le nom du hobbie</label>
                                <input type="text" class="form-control " placeholder=" hobbie name " name="hobbie_name" required>
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
    </div> <!--  fin modal Ajout hobbie -->

    <!-- modification hobbie -->
    <div class="modal fade   " id="modal_update_hobbie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 30%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Mise a jour hobbie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">


                    <form class="rounded  w-100 " enctype="multipart/form-data" id="update_hobbie">
                        <div class="form-row w-100 mt-3 ">

                            <input type="hidden" value="" name="id" class="id_Hobbie_pw" />
                            <div class="col ">
                                <label>Modifier le nom du hobbie</label>
                                <input type="text" class="form-control hobbie_nameT " placeholder=" hobbie name " name="hobbie_name" required>
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
    </div> <!-- fin update hobbie  -->

    <!-- suppression de hobbie de l'utlisateur connecter -->
    <div class="modal fade" id="modal_delete_hobbie" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 50%;" role="document">
            <div class="modal-content rounded shadow-lg mt-5">

                <div class="modal-header bg-danger rounded-top">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">SUPPRéSSION De Hobbie</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                    </button>
                </div>
                <div class=" d-flex justify-content-center align-items-center w-50"></div>
                <div class="modal-body zone_infos">
                    <div class=" space_response">
                        <h4> <i class="fas fa-exclamation-triangle mr-4" style="color: rgb(255, 208, 0); font-size:30px"></i>Attention</h4>
                        <strong class="text-warning text-center">Cette action est irreverssible, souhaitez-vous supprimer définitivement ce Hobbie:</strong>
                        <div class="d-flex w-100 align-items-center  mt-5">
                            <button class="btn btn-outline-primary annulerBTN_Z btn-sm rounded ml-4" data-dismiss="modal" aria-label="Close">ANNULER</button>
                            <button class="btn btn-outline-danger  btn-sm rounded ml-auto  valid_sup_hobbie  mr-4">SUPPRIMER</button>
                            <input type="hidden" value="" class="hobie_id_del" />

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- fin delete hobbie -->
    <?php
    include_once("../partials/footer.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <script src="../Controller/jQueryScript.js"></script>
    <script>

    </script>

</body>

</html>