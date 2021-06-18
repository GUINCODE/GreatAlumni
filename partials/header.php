<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:../index.php");
    exit();
}
include_once("connectBDD.php");
$id_user_conecter = $_SESSION['id'];
$role_user_conecter = $_SESSION['type_user'];


$stmt = $db->prepare("SELECT * FROM `utilisateur` where `id`= :id_utlisateur ");
$stmt->bindParam(':id_utlisateur', $id_user_conecter);
$stmt->execute();
$colonne = $stmt->fetch();

$name_user_connect = $colonne['Nom'];
$profil_user_connect = $colonne['Photo'];


// echo $role_user_conecter;
if ($role_user_conecter == "admin") {
    $adminASK = "<li type='button' class='text-warning'><a href='admin.php' class='text-warning'><i class='fas fa-users-cog mr-1'></i>ADMIN </a></li>";

    $venementASK = " <li type='button' class='addEvenement' data-toggle='modal' data-target='#staticBackdrop2'><i class='far fa-calendar-plus mr-1'></i>Nouvel evenement</li> ";
} else {
    $adminASK = "";
    $venementASK = "";
}
if ($role_user_conecter == "admin" && (is_null($profil_user_connect) or empty($profil_user_connect))) {
    $profil_user_connect = "../images/medias_users/user_admin_default_profil.png";
} else if ($role_user_conecter != "admin" && (is_null($profil_user_connect) or empty($profil_user_connect))) {
    $profil_user_connect = "../images/medias_users/userLogin.png";
} else {
    //   $profil_user_connect =substr($profil_user_connect, 2);
}



?>
<input type="hidden" value="<?= $id_user_conecter; ?>" class="user_log_identifiant" />
<div class="container  w-100  d-flex  entete backgroundFirstPlan rounded">

    <div class="d-flex  w-100 p-2  justify-content-center align-items-center" id="mainNav">
        <img src="../images/logos/addPOST.png" data-toggle="modal" data-target="#staticBackdrop" type="button" alt="..." class="img-fluid btnPoster  " style="width:40px; height:40px" />
        <div class="w-50 d-flex lesIconDeHeader ">
            <span class=" p-2  rounded notifUser notifSMS " type="button">
                <img src="../images/ressourcesLogo/sms.png" alt="..." class="linkImageH img-fluid" style="width:35px" />
                <span class="text-light bg-danger p-1 rounded-circle nbrMessage spaceNbreMessage"></span>
            </span>
            <span class=" p-2  mx-5 rounded  notifUser notifEVE " type="button">
                <img src="../images/ressourcesLogo/calendrier.png" alt="..." class="img-fluid linkImageH" style="width:35px" />
                <span class="text-light bg-danger p-1 rounded-circle nbrEvenement spaceNbreEVE "></span>
            </span>
            <span class=" p-2  rounded  notifUser notifAUtre " type="button">
                <img src="../images/ressourcesLogo/notificationL.png" alt="..." class="img-fluid linkImageH" style="width:35px" />
                <span class="text-light bg-danger p-1 rounded-circle nbrSujet spaceNbreAUTRE"></span>
            </span>
        </div>

        <div class="btn_user_profil my-auto ml-auto  d-flex  flex-column justify-content-center align-items-center mr-5" type="button">
            <img src=" <?= $profil_user_connect; ?>" class=' img-fluid profil-post' alt='...'>
            <span class="text-light mt-1"> <?= $name_user_connect ?></span>
            <i class="fas fa-arrow-circle-down"></i>
        </div>
    </div>



</div>
<ul class="sub_btn_profi rounded">
    <li type="button" class="addArticle" data-toggle="modal" data-target="#staticBackdrop"><i class="far fa-edit mr-1"></i>Publier un Post </li>
    <?= $venementASK; ?>
    <li type="button"><a href="forum.php"><i class="far fa-comments mr-1"></i> Acceder au forum</a></li>
    <li type="button"><a href="ma_messagerie.php"><i class="fas fa-sms mr-1"></i>Ma messagerie</a></li>
    <li type="button" class="addFeedback" data-toggle="modal" data-target="#staticBackdrop3"> <i class="fas fa-hand-holding-heart mr-1"></i>Partage experiences</li>
    <li type="button"><a href="profil.php"><i class="fas fa-user mr-1"></i>Mon profil</a></li>
    <?php echo $adminASK; ?>

    <li type="button" class="logOut text-danger"><a href="../partials/_logOut_user.php" class="logOut text-danger"><i class="fas fa-sign-out-alt mr-1 "> </i>Se deconnecter </a></li>
</ul>

<!-- Modal ADD POST -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;" role="document">
        <div class="modal-content rounded shadow-lg">

            <div class="modal-header backgroundSecondPlan rounded-top">
                <h5 class="modal-title" id="staticBackdropLabel">Créer un post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                </button>
            </div>
            <div class="zone_infos d-flex justify-content-center align-items-center w-100"></div>
            <div class="modal-body">
                <form id="form_article" method="POST">
                    <input type="hidden" value="<?= $id_user_conecter ?>" class="id_userlogin_post rounded" name="id_userlogin_post">
                    <div class="form-group">
                        <label>Titre du Post <b class="text-muted"></b></label>
                        <input type="text" name="titre_post" id="titrePost" class="form-control form-control-sm titre_post rounded" placeholder="Titre (optiotionel)" onkeyup="this.value=this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label> Ajouter une Image: <br> <small class="text-muted"> type prise en charge: (png, gif, jpg,
                                ou
                                jpeg) </small> </label>
                        <input type="file" id="mediass" name="media_post" accept=".jpg, .png, .gif" class="form-control form-control-sm media_post rounded">
                    </div>
                    <div class="form-group">
                        <label>Votre Post <b class="text-muted"></b></label>
                        <textarea class="form-control post rounded" id="postst" name="post" rows="4" placeholder="Dites quelques choses..."></textarea>
                    </div>
                    <div class="form-group d-flex mx-3">
                        <input type="reset" value="Recommenser" class="btn btn-outline-dark btn-sm rounded" />
                        <input type="submit" value="Publier" class="btn btn-outline-success btn-sm rounded ml-auto" />
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

<!-- Modal ADD EVENEMENT -->
<div class="modal fade   " id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog  " style="max-width: 60%;" role="document">
        <div class="modal-content rounded  shadow-lg">
            <div class="modal-header backgroundSecondPlan rounded-top">
                <h5 class="modal-title" id="staticBackdropLabel2">Ajout d'évenement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="form_events">
                    <input type="hidden" value="<?= $id_user_conecter ?>" class="id_userlogin_eve rounded" name="id_userlogin_eve">
                    <div class="form-group ">
                        <label>Titre <b class="text-muted">(*)</b></label>
                        <input type="text" class="form-control form-control-sm title_eve rounded" placeholder="Titre" name="titre_eve" id="titre_eve" onkeyup="this.value=this.value.toUpperCase()" required>

                    </div>
                    <div class="form-group mb-3">
                        <label>Sous Titre <b class="text-muted">(*)</b></label>

                        <textarea class="form-control rounded" name="sous_titre_eve" rows="2" placeholder="Ecivez un petit resumé de l'évenement..." required onkeyup="this.value=this.value.toUpperCase()" id="sous_titre_eve" maxlength="430"></textarea><br>

                    </div>
                    <div class="form-group">
                        <label> Date de l'évenement <b class="text-muted">(*)</b> </label>
                        <input type="date" class="form-control form-control-sm date_Events rounded" name="date_eve" id="date_eve" required>
                    </div>
                    <div class="form-group">
                        <label>Décrire l'événenent <b class="text-muted">(*)</b></label>
                        <textarea class="form-control rounded" name="desc_eve" rows="5" id="desc_eve" placeholder="Décrivez l'événement.." required></textarea>
                    </div>
                    <div class="form-group">
                        <label> Ajouter une Image <b class="text-muted">(*)</b> </label>
                        <input type="file" name="medias_eve" id="medias_eve" accept=".jpg, .png, .gif" class="form-control form-control-sm rounded" required>
                    </div>

                    <div class="mt-1 border-top mb-2"></div>
                    <div class="form-group d-flex mx-3 ">
                        <input type="reset" value="Recommenser" class="btn btn-outline-dark btn-sm rounded" />
                        <input type="submit" value="Publier" class="btn btn-outline-success btn-sm rounded ml-auto btn-publie-post" />
                    </div>

                </form>
            </div>
            <div class="zone_infos_eve d-flex justify-content-center align-items-center w-100"></div>
        </div>
    </div>
</div>

<!-- Modal ADD FEEDBACK -->
<div class="modal fade   " id="staticBackdrop3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel3" aria-hidden="true">
    <div class="modal-dialog  " style="max-width: 60%;" role="document">
        <div class="modal-content rounded  shadow-lg">
            <div class="modal-header backgroundSecondPlan rounded-top">
                <!-- <h5 class="modal-title" id="staticBackdropLabel3">Partage d'experience</h5> -->
                <div class="w-100">
                    <h5 class="modal-title" id="staticBackdropLabel3">Partagez vos éxperiences </h5>
                    <span class="text-muted">Vous avez participé à des projets d’envergure importante, des projets
                        innovents
                        ?
                        Faites un retour d'experience sur ces projets !!! </span>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="form_events2">
                    <input type="hidden" value="<?= $id_user_conecter ?>" class="id_userlogin_eve rounded" name="id_userlogin_eve2">
                    <div class="form-group ">
                        <label>Titre <b class="text-muted">(*)</b></label>
                        <input type="text" class="form-control form-control-sm title_eve rounded" placeholder="exemple: Mon retour d'experience sur un projet AGIL avec la societe GUINCODE" name="titre_eve2" id="titre_eve2" onkeyup="this.value=this.value.toUpperCase()" required>

                    </div>
                    <div class="form-group mb-3">
                        <label>Détails <b class="text-muted">(*)</b></label>

                        <textarea class="form-control rounded" name="sous_titre_eve2" rows="8" placeholder="Décrivez  l'éxperience dont vous avez vécu dans la realisation de ce projet..." required id="sous_titre_eve2"></textarea><br>

                    </div>



                    <div class="mt-1 border-top mb-2"></div>
                    <div class="form-group d-flex mx-3 ">
                        <input type="reset" value="Recommenser" class="btn btn-outline-dark btn-sm rounded" />
                        <input type="submit" value="Publier" class="btn btn-outline-success btn-sm rounded ml-auto btn-publie-post" />
                    </div>

                </form>
            </div>
            <div class="zone_infos_eve2 d-flex justify-content-center align-items-center w-100"></div>
        </div>
    </div>
</div>


<!-- modal pour repondre a un message  -->
<!-- Ajout d'une nounelle hobbie  -->
<div class="modal fade   " id="modal_rep_message" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog  " style="max-width: 20%;" role="document">
        <div class="modal-content rounded  shadow-lg">
            <div class="modal-header backgroundSecondPlan rounded-top">
                <span class="modal-title text-center" id="staticBackdropLabel2">Message récu</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                </button>
            </div>

            <div class="modal-body space_response_eve_admin">
                <p>le message recu </p>
                <input type="text" value="" placeholder="repondre" />
                <button>send</button>
            </div>

        </div>
    </div>
</div> <!--  fin modal Ajout hobbie -->