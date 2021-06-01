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
            <div class="w-100  content_user_space">
                <div class="d-flex  w-100 ">
                    <h3 class="text-center ml-5">Géstion des utilisateur</h3>
                    <span style="font-size:22px; " class="ml-auto bg-success rounded p-1 text-light mb-1  z_new_user" type="button">New User <i class="fas fa-user-plus"></i></span>
                </div>
                <table class="w-100 table-striped table-hover table-bordered ml-2  p-0">
                    <thead class="backgroundSecondPlan text-light text-center  ">
                        <tr class="p-5 text-center">
                            <th class="p-3">Profil</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Prenom</th>
                            <th class="p-3">Mail</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

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
                            $role = $colonne["Type"];
                            $password = $colonne["Mdp"];
                            $login = $colonne["Login"];
                            if (is_null($profil) or empty($profil)) {
                                $profil = "../images/medias_users/profil_par_defaut.jpg";
                            }
                        ?>
                            <tr class=" p-0 text-center">
                                <th><img class=" img_fromUser mr-1" src="<?= $profil; ?>" alt="<?= $nom; ?>" /></th>
                                <td><?= $nom ?></td>
                                <td><?= $prenom ?></td>
                                <td><?= $mail ?></td>
                                <td><?= $role ?></td>
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

        </div>
    </div>





    <!-- les modales Admin -->
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
                            <input type="text" name="z_f_nom_user" value="" id="" class="form-control form-control-sm z_f_nom_user " placeholder="">
                            <label>Prenom <b class="text-muted"></b></label>
                            <input type="text" name="z_f_prenom_user" id="" class="form-control form-control-sm z_f_prenom_user" placeholder="">
                            <label>Mail <b class="text-muted"></b></label>
                            <input type="text" name="z_f_mail_user" id="" class="form-control form-control-sm z_f_mail_user " placeholder="">
                            <label>Password <b class="text-muted"></b></label>
                            <input type="text" name="z_f_psw_user" id="" class="form-control form-control-sm z_f_psw_user " placeholder="">
                            <label>Login <b class="text-muted"></b></label>
                            <input type="text" name="z_f_login_user" id="" class="form-control form-control-sm z_f_login_user " placeholder="">


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
                        <h4> <i class="fas fa-exclamation-triangle mr-4" style="color:red; font-size:30px"></i>Attention</h4>
                        <strong class="text-warning text-center">Cette action est irreverssible, souhaitez-vous supprimer définitivement cet utlisateur:</strong>
                        <div class="d-flex w-100 align-items-center  mt-5">
                            <button class="btn btn-outline-primary btn-sm rounded ml-4" data-dismiss="modal" aria-label="Close">ANNULER</button>
                            <button class="btn btn-outline-danger  btn-sm rounded ml-auto  supp_user_by_admin  mr-4">SUPPRIMER</button>
                            <input type="hidden" value="" class="User_del_id" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
























    <?php
    include_once("../partials/footer.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="../script/script.js"></script>
    <script src="../script/jQueryScript.js"></script>
    <!-- -----cdn AOS--- -->
    <script>
     
    </script>

</body>

</html>