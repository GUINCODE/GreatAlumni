<?php
include_once("../connectBDD.php");
$id_user_conecter = 8;
?>
<input type="hidden" value="<?= $id_user_conecter; ?>" class="user_log_identifiant" />
<div class="container  w-100  d-flex  entete rounded">

    <ul class="d-flex  w-100 p-2 " id="mainNav">
        <img src="../images/logos/small_log.png" alt="..." class="img-fluid smal_logo" style="max-width:230px" />
        <li class="messageBtn">
            <button class="btn-head rounded" id="btn_notif_message">
                <i class="fas fa-sms" style="font-size: 2em"></i>
                <span class="butto_badge notif_msg text-fluid " id="notif_sms"></span>
                <span>Messagerie</span>
            </button>
            <ul class="list_notification shadow  rounded fermet1" id="subMessagerie">

            </ul>
        </li>
        <li class="btn_evenement">
            <button class="btn-head rounded" id="btn_notif_evenement">
                <i class="fas fa-calendar-check" style="font-size: 2em"></i>
                <span class="butto_badge notif_evene text-fluid" id="notif_eve"></span>
                <span>Evenement</span>
            </button>
            <ul class="list_notification shadow rounded fermet2" id="subEvenement">

            </ul>
        </li>
        <li> <button class="btn-head rounded" id="btn_notif_autre">
                <i class="fas fa-bell" style="font-size: 2em"></i>
                <span class="butto_badge notif_autre text-fluid" id="notif_autre"></span>
                <span>Notifications</span>
            </button>
            <ul class="list_notification shadow rounded fermet3" id="subAutre">

            </ul>
        </li>
        <div class="btn_user_profil my-auto ml-auto  d-flex justify-content-center align-items-center mr-5" type="button">
            <img src="../images/medias_users/userLogin.png" class=" img-fluid profil-post" alt="...">
            <i class="fas fa-arrow-circle-down"></i>
        </div>
    </ul>



</div>
<ul class="sub_btn_profi rounded">
    <li type="button" class="addArticle" data-toggle="modal" data-target="#staticBackdrop"><i class="far fa-edit mr-1"></i>Nouvel article </li>
    <li type="button" class="addEvenement" data-toggle="modal" data-target="#staticBackdrop2"><i class="far fa-calendar-plus mr-1"></i>Nouvel evenement</li>
    <li type="button"><i class="far fa-comments mr-1"></i> Acceder au forum</li>
    <li type="button"><a href="ma_messagerie.php"><i class="fas fa-sms mr-1"></i>Ma messagerie</a></li>
    <li type="button" class="addFeedback" data-toggle="modal" data-target="#staticBackdrop3"><i class="fas fa-hands-helping mr-1"></i>Partagez & Aidez</li>
    <li type="button"><i class="fas fa-user mr-1"></i>Mon profil</li>
    <li type="button" class="logOut text-danger"><i class="fas fa-sign-out-alt mr-1 "></i>Se deconnecter</li>
</ul>

<!-- Modal ADD POST -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;" role="document">
        <div class="modal-content rounded shadow-lg">

            <div class="modal-header">
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
            <div class="modal-header">
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
            <div class="modal-header">
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