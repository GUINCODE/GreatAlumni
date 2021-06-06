<?php
include_once('../partials/connectBDD.php');


$sql = "SELECT * FROM article ORDER BY `date`  DESC  ";
$verif = $db->query($sql);
$test = $verif->fetch();
if (!$test) {
} else {
    $result = $db->query($sql);
    while ($row = $result->fetch()) {
        $id_article = $row["id"];
        $titre = $row["titre"];
        $text = $row["texts"];
        $media = $row["media"];
        $date = $row["date"];
        $id_user = $row["id_user"];
        //   -----user infos-----
        $sql2 = "SELECT * FROM `utilisateur` WHERE `id` = $id_user  LIMIT 1 ";
        $result2 = $db->query($sql2);
        $ligne = $result2->fetch();
        $nom = $ligne["Nom"];
        $prenom = $ligne["Prenom"];
        $profil = $ligne["Photo"];
        if (is_null($profil) or empty($profil)) {
            $profil = "../images/medias_users/profil_par_defaut.jpg";
        }
        // ----les likes---
        $sql3 = "SELECT * FROM `article_votes` WHERE `id_article` = $id_article    ";
        $result3 = $db->query($sql3);
        $nomreLike = $result3->rowCount();
        if ($nomreLike > 0) {
            $like =  "<i class='fas fa-star liker'></i> " . $nomreLike;
        } else {
            $like = '';
        }


        //  ----les commentaire----
        $sql4 = "SELECT * FROM `commentaire` WHERE `id_article` = $id_article  ";
        $result4 = $db->query($sql4);
        $nombreCommentaire = $result4->rowCount();
        if ($nombreCommentaire > 0) {
            $commentaire =  $nombreCommentaire;
            $texCommentaire = '<span type="button" class="showcommentaire"> commentaires </span>';
        } else {
            $commentaire = '';
            $texCommentaire = '<span type="button" class="showcommentaire hideurClass  "> commentaires </span>';
        }
        // ----Liker ou pas ?---
        $sql5 = "SELECT * FROM `article_votes` WHERE `id_article` = $id_article  AND `id_user`=$id_user_conecter";
        $result5 = $db->query($sql5);
        $likeP = $result5->rowCount();
        if ($likeP > 0) {
            $likeTest = " <span type='button'><i class='fas fa-star faIconsBnt liker unlike_btn'></i></span>
                                <span type='button' class='hideur'><i class='far fa-star faIconsBnt like_btn'></i></span>
            ";
        } else {
            $likeTest = " <span type='button'><i class='far fa-star faIconsBnt like_btn'></i></span>
                                 <span  type='button' class='hideur'><i class='fas fa-star faIconsBnt liker unlike_btn'></i></span>
                                ";
        }

?>

        <!-- ----articles----- -->
        <div class="card  mx-auto mb-3 rounded  boxeShadower ">
            <div class="header entete_article rounded-top d-flex justify-content-start align-items-center">
                <img src=" <?php echo "$profil"; ?>  " class=" img-fluid profil-post" alt="...">
                <a href="#">
                    <h6 class="name-posted ml-2  text-light"><?php echo " $nom  $prenom "; ?></h6>
                </a>
            </div>
            <div class="card-body">
                <h6 class="titre_article"><?php echo " $titre "; ?></h6>
                <p class="card-text"> <?php echo " $text "; ?></p>
                <!-- <a href="#" class="btn btn-outline-primary  rounded">Lire tout</a> -->
            </div>
            <?php
            if (is_null($media) or empty($media)) {
                echo "";
            } else {
            ?>
                <img src="<?php echo " $media"; ?>" class="card-img-top img-fluid  imagePoster mx-auto rounded " alt="...">

            <?php
            }
            ?>

            <div class="reactionAuthers border-top border-munted">


                <div class="ml-2 place_number_like"> <?php echo $like; ?>

                </div>
                <div class="commentaires  d-flex flex-row ml-3 ">
                    <span class="nombreOfcommentaire mr-2"><?php echo $commentaire; ?></span>
                    <?= $texCommentaire; ?>
                </div>
            </div>
            <div class="les_commentaires ml-3 mt-2 hideurClass" data-aos="fade-down"></div>
            <div class="reagir border-top border-bottom border-munted">
                <input type="hidden" value="<?= $id_user_conecter; ?>" class="id_user_log" />
                <input type="hidden" value="<?= $id_article; ?>" class="id_article" />
                <!-- ici bouton for like -->
                <div class="btn_Like">
                    <?= $likeTest; ?>
                </div>
                <!-- <span type="button" class="likeIcon " style="display: none;"><i class="fas fa-star faIconsBnt"></i></span> -->


                <span class="commenter" type="button"><i class="fas fa-pen faIconsBnt"></i></span>

                <span class="PartageIcon" type="button"><i class="fas fa-share faIconsBnt"></i></span>
            </div>

            <div class="d-flex w-75 mx-auto bg-light  my-1  bloc_Parent_commentaire  hideurClass">

                <div class=" figure-fluid">
                    <?= $profil_user_connect; ?>
                    <!-- <img src="../images/medias_users/userLogin.png" alt="user profil " class="profil-commente img-fluid " /> -->
                </div>

                <div class=" input-group w-100  ">
                    <input type="hidden" value="<?= $id_user_conecter; ?>" class="id_user_log" />
                    <input type="hidden" value="<?= $id_article; ?>" class="id_article" />
                    <input class="flex-grow-1 border-0  ml-2  comentaireInput" type="text" required placeholder="Ecrivez votre commentaire..." />
                    <div class="input-group-apend  d-flex justify-content-center align-items-center sendComment" type="button">
                        <i class="far fa-paper-plane mr-2 faIconsBnt "></i>
                    </div>
                </div>


            </div>
        </div>

        <!-- ----end article--- -->
<?php

    }
}


?>