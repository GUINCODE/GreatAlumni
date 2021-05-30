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
    include_once('../partials/header.php')
    ?>



    <h3 class="text-center liker mt-2">GREATALUMNI MESSAGERIE Privée</h3>
    <div class="container container_messagerier   rounded  d-flex flex-row ">
        <div class="w-25 d-flex flex-column  py-3">
            <span class="text-muted text-center badge-secondary rounded">Messages réçus </span>
            <div class="les_sms_recus  shadow-lg p-2 rounded  d-flex flex-column mt-2">
                <?php

                $stmt = $db->prepare("SELECT   *  FROM `messagerie` WHERE `id_destinataire` = :id_utlisateur_connecter   GROUP BY id_expeditaire  ORDER BY dates ASC ");
                $stmt->bindParam(':id_utlisateur_connecter', $id_user_conecter);
                $stmt->execute();
                $liste_sms_recus = $stmt->fetchAll();
                foreach ($liste_sms_recus as $row => $sms) {
                    $id_expeditaire = $sms['id_expeditaire'];


                    $stmt2 = $db->prepare("SELECT   *  FROM `messagerie` WHERE `id_destinataire` = :id_utlisateur_connecter  AND `id_expeditaire`=:id_expeditaire   ORDER BY dates DESC  LIMIT 1");
                    $stmt2->bindParam(':id_utlisateur_connecter', $id_user_conecter);
                    $stmt2->bindParam(':id_expeditaire', $id_expeditaire);
                    $stmt2->execute();

                    $donnes = $stmt2->fetch();
                    $smsX = $donnes['texts'];
                    $statutX = $donnes['statut'];
                    $id_expeditaireX = $donnes['id_expeditaire'];

                    // verifier si le message depasse 7 caractere, si oui on retir le reste et on affiches seuelement 7 caractere

                    if (strlen($smsX) > 10) {
                        $text_reduit = substr($smsX, 0, 10);
                        $message_recu = $text_reduit . "...";
                    } else {
                        $message_recu = $smsX;
                    }
                    //////
                    //requete pour recuperer les information de l'expeditaire
                    $sql2 = "SELECT * FROM `utilisateur` WHERE `id` = $id_expeditaireX ";
                    $result2 = $db->query($sql2);
                    $ligne = $result2->fetch();
                    $idExpeditaire = $ligne['id'];
                    $nom = $ligne["Nom"];
                    $prenom = $ligne["Prenom"];
                    $profil = $ligne["Photo"];
                    if (is_null($profil) or empty($profil)) {
                        $profil = "../images/medias_users/profil_par_defaut.jpg";
                    }
                    // on verifie le message est deja lus ou pas
                    if ($statutX == "lus") {
                ?>
                        <div class=" d-flex bloc_sms_from  rounded mt-1 " type="button">
                            <input type="hidden" value="<?= $idExpeditaire; ?>" class="id_Expeditaire" />
                            <input type="hidden" value="<?= $id_user_conecter; ?>" class="id_Connecter" />
                            <input type="hidden" value="<?= $prenom . " " . $nom ?>" class="namOfUserTo" />
                            <img class=" img_fromUser" src="<?= $profil;  ?>" alt="<?= $prenom;  ?>" />
                            <div class="d-flex flex-column ml-2">
                                <span class="namFromsms text-fluid"><?= $prenom . " " . $nom ?></span>
                                <span class="smsFrom text-fluid"><?= $message_recu; ?> </span>
                            </div>
                        </div>

                    <?php  } else {
                    ?>
                        <div class=" d-flex bloc_sms_from  rounded mt-1 textBol " type="button">
                            <input type="hidden" value="<?= $idExpeditaire; ?>" class="id_Expeditaire" />
                            <input type="hidden" value="<?= $id_user_conecter; ?>" class="id_Connecter" />
                            <img class=" img_fromUser" src="<?= $profil;  ?>" alt="<?= $prenom;  ?>" />
                            <div class="d-flex flex-column ml-2">
                                <span class="namFromsms "><?= $prenom . " " . $nom; ?></span>
                                <span class="smsFrom"><?= $message_recu; ?> </span>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="zone_echange  py-3 ml-4 w-100 ">
            <div class="authers_users  rounded">
                <span class=" badge-secondary rounded p-2 all_user w-100 d-flex justify-content-center align-items-center" type="button">
                    <i class="fas fa-eye mr-2" style="font-size: 22px;"></i>
                    <i class="fas fa-eye-slash mr-2 hideurClass" style="font-size: 22px;"></i>
                    <span class="afficher">Afficher les utilisateurs </span> 
                    <span class="masquer hideurClass">Masquer les utilisateurs </i></span>

                </span>
                <div class="list_users_All  hideurClass d-flex flex-column justify-content-center align-items-center  px-2 pt-5 pb-3">
                    <input type="search" placeholder="rechercher" class="searcheUser" id="myInput" />
                    <div class="d-flex flex-column justify-content-center align-items-center  px-2 pt-1 pb-3 " id="card">
                        <?php

                        $stmt = $db->prepare("SELECT * FROM `utilisateur` WHERE `id` != :id_utlisateur_connecter  ORDER BY `Prenom` ASC");
                        $stmt->bindParam(':id_utlisateur_connecter', $id_user_conecter);
                        $stmt->execute();
                        $users_list = $stmt->fetchAll();
                        foreach ($users_list as $row => $colonne) {

                            $id_authe_user = $colonne['id'];
                            $nom = $colonne['Nom'];
                            $prenom = $colonne['Prenom'];
                            $profil = $colonne["Photo"];
                            if (is_null($profil) or empty($profil)) {
                                $profil = "../images/medias_users/profil_par_defaut.jpg";
                            }

                        ?>
                            <div class=" autherUser d-flex justify-content-start align-items-center p-1  rounded mt-1 media " type="button">
                                <input type="hidden" value="<?= $id_authe_user; ?>" class="id_autre_user" />
                                <input type="hidden" value="<?= $id_user_conecter; ?>" class="identifant_userConnecter" />
                                <img class=" img_fromUser mr-1" src="<?= $profil; ?>" alt="<?= $nom; ?>" />
                                <span class=" text-light name_user">
                                    <?= $prenom . " " . $nom; ?>
                                </span>
                            </div>

                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>

            <div class="header_echange_sms d-flex flex-row p-1  w-100  justify-content-start align-items-center">
                <h5 class="ml-3 text-light">Avec : </h5>
                <div class="infos_destinataire ml-3 d-flex align-items-center">
                    <input type="hidden" value="" class="id_user_select">
                    <img class="img_fromUser profil_user_select" src="../images/medias_users/neutreUser2.png" alt="..." style="color:grey" />
                    <span class=" text-capitalize text-light infos_user_select ml-2 mr-5"> <span class="text-muted"> aucun utilisateur selectionner</span> </span>
                    <i class="fas fa-sync ml-3 faIconsBnt refresh_message hideurClass" type="button" style="font-size:25px"></i>
                    <span class="refres_txt ml-3 hideurClass text-info" style="font-size:15px"> <i class="fas fa-sync mr-1 smoll_fresh"></i>mise à jour message...</span>
                </div>

            </div>
            <ul class=" fil_sms_echange mt-0 d-flex flex-column justify-contenter-start p-2 ">
                <h4 class=" text-muted text-center mt-1">Vos conversations s'afficherons ici 😎😎</h4>
                <b class="text-muted text-center mb-1">séléctionnez un utilisateur pour échanger avec lui</b>
                <img src="../images/logos/small_log.png" alt="..." class="img-fluid smal_logo" style="margin-left:40%;max-width:200px; max-height:200px;" />

                <!-- <img src="./images/medias_users/chaLive2.gif" alt="..." style="width:300px;margin-left:30%" /> -->
            </ul>

            <div class="form-group w-75 d-flex flex-row justify-content-center align-items-center    mx-auto">
                <textarea class="form-control rounded message_rep" name="" autofocus rows="1" id="" placeholder="votre message.." required></textarea>
                <span type="button" class="btn_envoyer_message  "> <i class="far fa-paper-plane  faIconsBnt btn_env_sms "></i></span>

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
    <script>

    </script>
    <!-- -----cdn AOS--- -->

</body>

</html>