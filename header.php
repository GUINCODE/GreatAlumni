<?php
$id_user_conecter = 8;
?>
<div class="container  w-100  d-flex  entete">

    <ul class="d-flex  w-100 p-2 " id="mainNav">
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
        <div class="btn_user_profil my-auto ml-auto  d-flex justify-content-center align-items-center mr-5"
            type="button">
            <img src="./images/medias_users/profil_par_defaut.jpg" class=" img-fluid profil-post" alt="...">
            <i class="fas fa-arrow-circle-down"></i>
        </div>
    </ul>



</div>
<ul class="sub_btn_profi rounded">
    <li type="button" class="addArticle" data-toggle="modal" data-target="#staticBackdrop"><i
            class="far fa-edit mr-1"></i>Nouvel article </li>
    <li type="button" class="addEvenement" data-toggle="modal" data-target="#staticBackdrop2"><i
            class="far fa-calendar-plus mr-1"></i>Nouvel evenement</li>
    <li type="button"><i class="far fa-comments mr-1"></i> Acceder au forum</li>
    <li type="button"><i class="fas fa-sms mr-1"></i>Ma messagerie</li>
    <li type="button"><i class="fas fa-hands-helping mr-1"></i>Partagez & Aidez</li>
    <li type="button"><i class="fas fa-user mr-1"></i>Mon profil</li>
    <li type="button" class="logOut text-danger"><i class="fas fa-sign-out-alt mr-1 "></i>Se deconnecter</li>
</ul>

<!-- Modal ADD POST -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Créer un post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 40px;">&times;</span>
                </button>
            </div>
            <div class="zone_infos d-flex justify-content-center align-items-center w-100"></div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="form_article" method="POST">
                    <input type="hidden" value="<?= $id_user_conecter ?>" class="id_userlogin_post"
                        name="id_userlogin_post">
                    <div class="form-group">
                        <label>Titre du Post <b class="text-muted"></b></label>
                        <input type="text" name="titre_post" id="titrePost"
                            class="form-control form-control-sm titre_post" placeholder="Titre (optiotionel)"
                            onkeyup="this.value=this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label> Ajouter une Image: <br> <small class="text-muted"> type prise en charge: (png, gif, jpg,
                                ou
                                jpeg) </small> </label>
                        <input type="file" id="mediass" name="media_post" accept=".jpg, .png, .gif"
                            class="form-control form-control-sm media_post">
                    </div>
                    <div class="form-group">
                        <label>Votre Post <b class="text-muted"></b></label>
                        <textarea class="form-control post" id="postst" name="post" rows="4"
                            placeholder="Dites quelques choses..."></textarea>
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
<div class="modal fade  " id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog  " style="max-width: 60%;" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel2">Ajout d'évenement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="form_events">
                    <input type="hidden" value="<?= $id_user_conecter ?>" class="id_userlogin_eve"
                        name="id_userlogin_eve">
                    <div class="form-group mb-5">
                        <label>Titre <b class="text-muted">(*)</b></label>
                        <input type="text" class="form-control form-control-sm title_eve" placeholder="Titre"
                            name="titre_eve" id="titre_eve" onkeyup="this.value=this.value.toUpperCase()" required>
                        <label>Sous Titre <b class="text-muted">(*)</b></label>
                        <textarea class="form-control" name="sous_titre_eve" rows="2"
                            placeholder="Ecivez un petit resumé de l'évenement..." required
                            onkeyup="this.value=this.value.toUpperCase()" id="sous_titre_eve"></textarea>
                    </div>
                    <div class="form-group">
                        <label> Date de l'évenement <b class="text-muted">(*)</b> </label>
                        <input type="date" class="form-control form-control-sm date_Events" name="date_eve"
                            id="date_eve" required>
                    </div>
                    <div class="form-group">
                        <label>Décrire l'événenent <b class="text-muted">(*)</b></label>
                        <textarea class="form-control" name="desc_eve" rows="5" id="desc_eve"
                            placeholder="Décrivez l'événement.." required></textarea>
                    </div>
                    <div class="form-group">
                        <label> Ajouter une Image <b class="text-muted">(*)</b> </label>
                        <input type="file" name="medias_eve" id="medias_eve" accept=".jpg, .png, .gif"
                            class="form-control form-control-sm" required>
                    </div>

                    <div class="mt-1 border-top mb-2"></div>
                    <div class="form-group d-flex mx-3 ">
                        <input type="reset" value="Recommenser" class="btn btn-outline-dark btn-sm rounded" />
                        <input type="submit" value="Publier"
                            class="btn btn-outline-success btn-sm rounded ml-auto btn-publie-post" />
                    </div>
                    <div class="content_feedback"></div>
                </form>
            </div>
            <div class="zone_infos_eve d-flex justify-content-center align-items-center w-100"></div>
        </div>
    </div>
</div>