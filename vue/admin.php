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
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link rel="stylesheet" href="../styles/designY.css">
    <style>
        /* .entete {
            background: rgba(82, 17, 17, 0.582)  !important;
        } */
    </style>
</head>

<body>
    <?php
    include_once('../partials/header.php')
    ?>

    <div class="mx-5">
        <h3 class="text-center mt-2" style=" color:tomato"> Rôle Admin <i class="fas fa-user-lock" style="font-size:25px; color:tomato"></i></h3>
        <p class="text-center"> Sur cette page vous pouvez effectuer des opérations d'administration </p>
        <div class="d-flex">
            <div class="  d-flex flex-column justify-content-start  side_bar    rounded">
                <h3 class="text-muted text-center  rounded mt-1  ">gérer<i class="fas fa-toolbox ml-1" style="font-size:35px; "></i> </h3>
                <!-- <div class="d-flex flex-column justify-content-center align-items-center  w-100 rounded border"> -->
                <span class="p-1  admin-items mt-2 item_active admin_item_user " type="button"> <i class="fas fa-users-cog mr-2" style="font-size:25px; "></i>UTULISATEURS</span>
                <span class="p-1    admin-items mt-1 mb-1 admin_item_event " type="button"><i class="fas fa-calendar-times mr-2" style="font-size:25px; "></i> EVENEMENTS</span>
                <span class="p-1   admin-items admin_item_post" type="button"><i class="fas fa-tools mr-2" style="font-size:25px; "></i> POSTS</span>
                <!-- </div> -->
            </div>

            <div class="w-100  content_user_space_admin togglerALL ">
                <div class="d-flex  w-100 ">
                    <h3 class="text-center ml-5">Géstion des utilisateur</h3>
                    <span style="font-size:22px; " class="ml-auto bg-success rounded p-1 text-light mb-1  z_new_user" type="button" data-toggle="modal" data-target="#modal_new_memeber">New Member <i class="fas fa-user-plus"></i></span>
                </div>
                <input type="search" placeholder="rechercher" class=" form-control w-50 text-center mb-2 shadow-lg border boder-dark  mx-auto rounded-top h1  " id="chercheAdminUser" />
                <table class="w-100 table-striped table-hover table-bordered ml-2  p-0">
                    <thead class="backgroundSecondPlan text-light text-center  ">
                        <tr class="p-5 text-center">
                            <th class="p-3">Profil</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Prenom</th>
                            <th class="p-3">Mail</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Report <i class='fas fa-flag-checkered ml-1' style=' font-size:30px'></i></th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">

                        <?php
                        $stmt = $db->prepare("SELECT * FROM `utilisateur`   ORDER BY Nom ASC, Prenom ASC");
                        $stmt->execute();
                        $users_list = $stmt->fetchAll();
                        foreach ($users_list as $row => $colonne) {

                            $id_user = $colonne["id"];
                            $nom = $colonne["Nom"];
                            $prenom = $colonne["Prenom"];
                            $mail = $colonne["Mail"];
                            $profil = $colonne["Photo"];
                            $role = $colonne["Typee"];
                            $password = $colonne["Mdp"];
                            $login = $colonne["Loginn"];
                            // ----compter le nombre de report d'un utilisateur---
                            $sql3 = "SELECT * FROM `report_user` WHERE `id_signaler` = $id_user    ";
                            $result3 = $db->query($sql3);
                            $nomreReport = $result3->rowCount();


                            if (is_null($profil) or empty($profil)) {
                                $profil = "../images/medias_users/profil_par_defaut.jpg";
                            }
                            if ($nomreReport == 0) {
                                $nomreReportP = "<span class='text-muted'>auncun </span>";
                            } else   if ($nomreReport > 0 && $nomreReport <= 5) {
                                $nomreReportP = "<span class='text-warning'><i class='fas fa-flag-checkered mr-1' style=' font-size:20px'></i> $nomreReport  </i></span>";
                            } else {
                                $nomreReportP = "<span class='text-danger'><i class='fas fa-flag-checkered mr-1' style=' font-size:20px'></i>$nomreReport </span>";
                            }
                        ?>
                            <tr class=" p-0 text-center">
                                <td><img class=" img_fromUser " src="<?= $profil; ?>" alt="<?= $nom; ?>" /></td>
                                <td><?= $nom ?></td>
                                <td><?= $prenom ?></td>
                                <td><?= $mail ?></td>
                                <td><?= $role ?></td>
                                <td><?= $nomreReportP ?></td>

                                <td class="d-flex justify-content-center align-items-center pt-2 flex-row">
                                    <i class=" mr-3 fas fa-user-edit btn_edit_user" style="font-size:30px; " type="button" data-toggle="modal" data-target="#staticBackdrop_Z"></i>
                                    <i class="fas fa-trash-alt btn_delete_user" style="font-size:30px; " type="button" data-toggle="modal" data-target="#staticBackdrop_D"></i>


                                </td>
                                <input type="hidden" value="<?= $id_user; ?>" class="z_id_user" />
                                <input type="hidden" value="<?= $nom; ?>" class="z_nom" />
                                <input type="hidden" value="<?= $prenom; ?>" class="z_prenom" />
                                <input type="hidden" value="<?= $mail; ?>" class="z_mail" />
                                <input type="hidden" value="<?= $role; ?>" class="z_role" />
                                <input type="hidden" value="<?= $password; ?>" class="z_psw" />
                                <input type="hidden" value="<?= $login; ?>" class="z_login" />

                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>

            <div class="w-100  content_events_space_admin  togglerALL hideurClass">

                <h3 class="text-center ml-5">Géstion des evenements</h3>
                <input type="search" placeholder="rechercher" class=" form-control w-50 text-center mb-2 shadow-lg border boder-dark  mx-auto rounded-top h1  " id="chercheAdminEve" />
                <table class="w-100 table-striped table-hover table-bordered ml-2  p-0">
                    <thead class="backgroundSecondPlan text-light text-center  ">
                        <tr class="p-5 text-center">
                            <th class="p-3">ID</th>
                            <th class="p-3">IMAGE</th>
                            <th class="p-3">TITRE</th>
                            <th class="p-3">SOUS TITRE</th>
                            <th class="p-3">DATE</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableEve">

                        <?php
                        $stmt = $db->prepare("SELECT * FROM `evenements`   ORDER BY dates ASC");
                        $stmt->execute();
                        $users_list = $stmt->fetchAll();
                        foreach ($users_list as $row => $colonne) {

                            $id = $colonne["id"];
                            $titre = $colonne["titre"];
                            $sub_titre = $colonne["sub_titre"];
                            $descriptions = $colonne["descriptions"];
                            $image_path = $colonne["image_path"];
                            $dates = $colonne["dates"];

                        ?>
                            <tr class=" p-0 text-center">
                                <td><?= $id ?></td>
                                <td><img src="<?= $image_path ?>" class="img-fluid rounded" alt="<?= $titre ?> " style="width:100px" /> </td>
                                <td><?= $titre ?></td>
                                <td><?= $sub_titre ?></td>
                                <td><?= $dates ?></td>
                                <td class="d-flex justify-content-center align-items-center pt-2 flex-row">
                                    <i class=" mr-3 fas fa-calendar-minus btn_edit_ev update_btn_all" style="font-size:30px; " type="button" data-toggle="modal" data-target="#static_update_event"></i>
                                    <i class="fas fa-trash-alt btn_delete_ev delele_btn_all" style="font-size:30px; " type="button" data-toggle="modal" data-target="#deleteEVenemt_modal"></i>
                                </td>
                                <input type="hidden" value="<?= $id; ?>" class="z_id_ev" />
                                <input type="hidden" value="<?= $titre; ?>" class="z_titre_ev" />
                                <input type="hidden" value="<?= $sub_titre; ?>" class="z_sub_titre_ev" />
                                <input type="hidden" value="<?= $descriptions; ?>" class="z_descriptions_ev" />
                                <input type="hidden" value="<?= $image_path; ?>" class="z_image_path_ev" />
                                <input type="hidden" value="<?= $dates; ?>" class="z_dates_ev" />


                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>

            <div class="w-100  content_posts_space_admin  togglerALL hideurClass ">

                <h3 class="text-center ml-5">Géstion des articles</h3>
                <input type="search" placeholder="rechercher" class=" form-control w-50 text-center mb-2 shadow-lg border boder-dark  mx-auto rounded-top h1  " id="chercheAdminPost" />
                <table class="w-100 table-striped table-hover table-bordered ml-2  p-0">
                    <thead class="backgroundSecondPlan text-light text-center  ">
                        <tr class="p-5 text-center">
                            <th class="p-3">IMAGE</th>
                            <th class="p-3">TITRE</th>
                            <th class="p-3">POST</th>
                            <th class="p-3">REPORT <i class='fas fa-flag-checkered ml-1' style=' font-size:30px'></i></th>
                            <th class="p-3">DELETE</th>
                        </tr>
                    </thead>
                    <tbody id="tablePost">

                        <?php
                        $stmt = $db->prepare("SELECT * FROM `article`   ORDER BY date DESC");
                        $stmt->execute();
                        $users_list = $stmt->fetchAll();
                        foreach ($users_list as $row => $colonne) {

                            $id = $colonne["id"];
                            $titre = $colonne["titre"];
                            $media = $colonne["media"];
                            $post = $colonne["texts"];
                            if (is_null($media) or empty($media)) {
                                $image = "<span class='text-muted'> sans image </span>";
                            } else {
                                $image = "<img src='$media'  alt='non disponible'  style='width:100px' /> ";
                            }
                            if (is_null($titre) or empty($titre)) {
                                $title = "<span class='text-muted'> sans titre </span>";
                            } else {
                                $title = $titre;
                            }
                            if (is_null($post) or empty($post)) {
                                $detail_post = "<span class='text-muted'>sans text  </span>";
                            } else {
                                if (strlen($post) > 200) {

                                    $text_reduit = substr($post, 0, 200);
                                    $detail_post = $text_reduit . "...";
                                } else {
                                    $detail_post = $post;
                                }
                            }
                            // ----compter le nombre de report d'un post---
                            $sql3 = "SELECT * FROM `report_post` WHERE `id_post` = $id    ";
                            $result3 = $db->query($sql3);
                            $nomreReport = $result3->rowCount();
                        
                            if ($nomreReport == 0) {
                                $nomreReportP = "<span class='text-muted'>auncun </span>";
                            } else   if ($nomreReport > 0 && $nomreReport <= 2) {
                                $nomreReportP = "<span class='text-warning'><i class='fas fa-flag-checkered mr-1' style=' font-size:20px'></i> $nomreReport  </i></span>";
                            } else {
                                $nomreReportP = "<span class='text-danger'><i class='fas fa-flag-checkered mr-1' style=' font-size:20px'></i>$nomreReport </span>";
                            }

                        ?>
                            <tr class=" p-0 text-center">
                                <td><?= $image; ?></td>
                                <td><?= $title; ?></td>
                                <td><?= $detail_post; ?></td>
                                <td><?= $nomreReportP ?></td>

                                <td class=" pt-2 ">
                                    <i class="fas fa-trash-alt btn_delete_post delele_btn_all" style="font-size:30px; " type="button" data-toggle="modal" data-target="#deletePOST_modal"></i>
                                </td>
                                <input type="hidden" value="<?= $id; ?>" class="z_id_post" />
                                <input type="hidden" value="<?= $media; ?>" class="z_media_post" />





                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>


        </div>
    </div>




    <!-- ************************************** -->
    <!-- les modales Admin -->
    <!-- *************************************** -->


    <!-- Modal UPDATE USERS INFOS -->
    <div class="modal fade" id="staticBackdrop_Z" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 50%;" role="document">
            <div class="modal-content rounded shadow-lg">

                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title" id="staticBackdropLabel">Update User infos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                    </button>
                </div>
                <div class=" d-flex justify-content-center align-items-center w-100"></div>
                <div class="modal-body zone_infos">

                    <form id="z_form_user_update" method="POST">
                        <input type="hidden" value="" class="z_f_id_user" name="z_f_id_user">
                        <div class="form-group">
                            <label>Nom <b class="text-muted"></b></label>
                            <input type="text" name="z_f_nom_user" value="" id="" class=" text-center form-control form-control-sm z_f_nom_user " placeholder="">
                            <label>Prenom <b class="text-muted"></b></label>
                            <input type="text" name="z_f_prenom_user" id="" class=" text-center form-control form-control-sm z_f_prenom_user" placeholder="">
                            <label>Mail <b class="text-muted"></b></label>
                            <input type="text" name="z_f_mail_user" id="" class=" text-center form-control form-control-sm z_f_mail_user " placeholder="">
                            <label>Login <b class="text-muted"></b></label>
                            <input type="text" name="z_f_login_user" id="" class=" text-center form-control form-control-sm z_f_login_user " placeholder="">

                            <label>Password <b class="text-muted"></b></label>
                            <input type="text" name="z_f_psw_user" id="" class=" text-center form-control form-control-sm z_f_psw_user " placeholder="">


                        </div>

                        <div class="form-group">
                            <label class="mt-3 text-warning">Rôle de l'utilisateur : <b class="text-muted "></b></label>
                            <select id="pet-select" name="z_f_role_user" class="z_f_role_user">
                                <option value="standard">Standard</option>
                                <option value="admin" class="text-danger">Admin</option>
                            </select>
                        </div>

                        <div class="form-group d-flex mx-3">
                            <input type="submit" value="Update" class="btn btn-outline-success btn-sm rounded ml-auto" />
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <!-- DELETE USER  -->
    <div class="modal fade" id="staticBackdrop_D" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 50%;" role="document">
            <div class="modal-content rounded shadow-lg mt-5">

                <div class="modal-header bg-danger rounded-top">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">DELETE USER</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                    </button>
                </div>
                <div class=" d-flex justify-content-center align-items-center w-50"></div>
                <div class="modal-body zone_infos">
                    <div class=" space_response">
                        <h4> <i class="fas fa-exclamation-triangle mr-4" style="color: rgb(255, 208, 0); font-size:30px"></i>Attention</h4>
                        <strong class="text-warning text-center">Cette action est irreverssible, souhaitez-vous supprimer définitivement cet utlisateur:</strong>
                        <div class="d-flex w-100 align-items-center  mt-5">
                            <button class="btn btn-outline-primary annulerBTN_Z btn-sm rounded ml-4" data-dismiss="modal" aria-label="Close">ANNULER</button>
                            <button class="btn btn-outline-danger  btn-sm rounded ml-auto  supp_user_by_admin  mr-4">SUPPRIMER</button>
                            <input type="hidden" value="" class="User_del_id" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Update evenement -->

    <div class="modal fade   " id="static_update_event" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 60%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title" id="staticBackdropLabel2">Mise à jour d'évenement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">
                    <form method="POST" enctype="multipart/form-data" id="form_events_update">
                        <div class="form-group ">
                            <label>Titre <b class="text-muted">(*)</b></label>
                            <input type="text" class="form-control form-control-sm title_eve rounded titre_eve_update " placeholder="Titre" name="titre_eve_update" id="titre_eve_update" onkeyup="this.value=this.value.toUpperCase()" required>

                        </div>
                        <div class="form-group mb-3">
                            <label>Sous Titre <b class="text-muted">(*)</b></label>

                            <textarea class="form-control rounded sous_titre_eve_update" name="sous_titre_eve_update" rows="2" placeholder="Ecivez un petit resumé de l'évenement..." required onkeyup="this.value=this.value.toUpperCase()" id="sous_titre_eve_update" maxlength="430"></textarea><br>

                        </div>
                        <div class="form-group">
                            <label> Date de l'évenement <b class="text-muted">(*)</b> </label>
                            <input type="date" class="form-control form-control-sm date_Events rounded date_eve_update" name="date_eve_update" id="date_eve_update" required>
                        </div>
                        <div class="form-group">
                            <label>Description <b class="text-muted">(*)</b></label>
                            <textarea class="form-control rounded desc_eve_update" name="desc_eve_update" rows="5" id="desc_eve_update" placeholder="Décrivez l'événement.." required></textarea>
                        </div>

                        <input type="hidden" class="id_eve_update" name="id_eve_update" id="id_eve_update">


                        <div class="mt-1 border-top mb-2"></div>
                        <div class="form-group d-flex mx-3 ">
                            <button class="btn btn-outline-dark btn-sm rounded" data-dismiss="modal">ANNULER</button>
                            <input type="submit" value="Publier" class="btn btn-outline-success btn-sm rounded ml-auto btn-publie-post " />
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- DELETE EVENEMENT  -->
    <div class="modal fade" id="deleteEVenemt_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 50%;" role="document">
            <div class="modal-content rounded shadow-lg mt-5">

                <div class="modal-header bg-danger rounded-top">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">SUPPRéSSION D'éVéNEMENT</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                    </button>
                </div>
                <div class=" d-flex justify-content-center align-items-center w-50"></div>
                <div class="modal-body zone_infos">
                    <div class=" space_response">
                        <h4> <i class="fas fa-exclamation-triangle mr-4" style="color: rgb(255, 208, 0); font-size:30px"></i>Attention</h4>
                        <strong class="text-warning text-center">Cette action est irreverssible, souhaitez-vous supprimer définitivement cet événement:</strong>
                        <div class="d-flex w-100 align-items-center  mt-5">
                            <button class="btn btn-outline-primary annulerBTN_Z btn-sm rounded ml-4" data-dismiss="modal" aria-label="Close">ANNULER</button>
                            <button class="btn btn-outline-danger  btn-sm rounded ml-auto  supp_eve_by_admin  mr-4">SUPPRIMER</button>
                            <input type="hidden" value="" class="eve_del_id" />
                            <input type="hidden" value="" class="eve_del_media" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>



    <!-- DELETE POST  -->
    <div class="modal fade" id="deletePOST_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 50%;" role="document">
            <div class="modal-content rounded shadow-lg mt-5">

                <div class="modal-header bg-danger rounded-top">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">SUPPRéSSION De POST</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                    </button>
                </div>
                <div class=" d-flex justify-content-center align-items-center w-50"></div>
                <div class="modal-body zone_infos">
                    <div class=" space_response">
                        <h4> <i class="fas fa-exclamation-triangle mr-4" style="color: rgb(255, 208, 0); font-size:30px"></i>Attention</h4>
                        <strong class="text-warning text-center">Cette action est irreverssible, souhaitez-vous supprimer définitivement ce post:</strong>
                        <div class="d-flex w-100 align-items-center  mt-5">
                            <button class="btn btn-outline-primary annulerBTN_Z btn-sm rounded ml-4" data-dismiss="modal" aria-label="Close">ANNULER</button>
                            <button class="btn btn-outline-danger  btn-sm rounded ml-auto  supp_post_by_admin  mr-4">SUPPRIMER</button>
                            <input type="hidden" value="" class="post_del_id" />
                            <input type="hidden" value="" class="post_del_media" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- creation de nouveaux membre  -->

    <div class="modal fade   " id="modal_new_memeber" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog  " style="max-width: 60%;" role="document">
            <div class="modal-content rounded  shadow-lg">
                <div class="modal-header backgroundSecondPlan rounded-top">
                    <h5 class="modal-title text-center" id="staticBackdropLabel2">Ajout de nouveaux membres</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body space_response_eve_admin">

                    <form class="rounded  w-100 " id="add_member_form">
                        <div class="zoneAlerte"></div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col ">
                                <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                            </div>
                            <div class="col ">
                                <input type="text" class="form-control prenomW" placeholder="Prenom" name="prenom" required>
                            </div>
                        </div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col ">
                                <input type="email" class="form-control mailW" placeholder="Mail" name="mail" required>
                            </div>
                            <div class="col ">
                                <input type="number" class="form-control" placeholder=" Annee de promotion" name="annee" required>
                            </div>

                        </div>
                        <div class="form-row w-100 mt-3 ">
                            <div class="col  d-flex align-items-center">
                                <input type="text" class="form-control mr-1 loginW" placeholder="Login" name="login" required>
                                <i class="fas fa-redo _btn_all generate" style="font-size:25px; color:thistle" type="button"></i>
                            </div>
                            <div class="col d-flex align-items-center">
                                <input type="text" class="form-control mr-1 passwordW " placeholder="Password" name="mdp" required>
                                <i class="fas fa-redo _btn_all generate" style="font-size:25px; color:thistle" type="button"></i>

                            </div>


                        </div>
                        <div class="form-row w-50 mx-auto mt-3 ">
                            <div class="col d-flex  justify-content-center align-items-center">
                                <label class="text-muted mr-2 "> Role: </label>
                                <select class="form-control " name="type">
                                    <option value="standard">Standard</option>
                                    <option value="admin" class="text-warning">Admin</option>
                                </select>
                            </div>
                        </div>


                </div>

                <div class="w-100  border border-top mt-3 shadow bg-dark">
                    <div class="form-group  w-50  pt-3 d-flex mx-auto  ">
                        <input type="reset" class="btn btn-warning  Mbouton btn-sm " value="Reprendre">
                        <input type="submit" class="btn btn-outline-success  btn-sm ml-auto" value="Sauvegarder">

                    </div>
                </div>


            </div>



            </form>

        </div>

    </div>
    </div>
    </div>













    <?php
    include_once("../partials/footer.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <script src="../script/jQueryScript.js"></script>
    <!-- -----cdn AOS--- -->
    <script>
        $("#chercheAdminUser").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#chercheAdminPost").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tablePost tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#chercheAdminEve").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableEve tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>

</body>

</html>