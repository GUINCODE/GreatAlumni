<?php
include_once("./connectBDD.php");

$id_user_conecter = 1;
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
            $profil = "./images/medias_users/profil_par_defaut.jpg";
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
            $commentaire =  $nombreCommentaire . " commentaires";
        } else {
            $commentaire = '';
        }
        // ----Liker ou pas ?---
        $sql5 = "SELECT * FROM `article_votes` WHERE `id_article` = $id_article  AND `id_user`=$id_user_conecter";
        $result5 = $db->query($sql5);
        $likeP = $result5->rowCount();
        if ($likeP > 0) {
            $likeTest = " <span class='disabled'><i class='fas fa-star liker disabled'></i></span>";
        } else {
            $likeTest = " <span type='button' class='likeIcon'><i class='far fa-star faIconsBnt' onclick='handleLiker($id_user_conecter,$id_article )'></i></span>";
        }

?>

<!-- ----articles----- -->
<div class="card  mx-auto mb-3 rounded shadow-lg ">
    <div class="header entete_article rounded-top d-flex justify-content-start align-items-center">
        <img src=" <?php echo "$profil"; ?>  " class=" img-fluid profil-post" alt="...">
        <a href="#">
            <h6 class="name-posted ml-2  text-light"><?php echo " $nom  $prenom "; ?></h6>
        </a>
    </div>
    <div class="card-body">
        <h5 class="titre_article"><?php echo " $titre "; ?></h5>
        <p class="card-text"> <?php echo " $text "; ?></p>
        <!-- <a href="#" class="btn btn-outline-primary  rounded">Lire tout</a> -->
    </div>
    <?php
            if (is_null($media) or empty($media)) {
                echo "";
            } else {
            ?>
    <img src="<?php echo " $media"; ?>" class="card-img-top img-fluid " alt="...">

    <?php
            }
            ?>

    <div class="reactionAuthers border-top border-munted">


        <div class="ml-2" id="place_number_like"> <?php echo $like; ?> </div>
        <div class="commentaires ml-3 ">
            <a href="#"><?php echo $commentaire; ?> </a>
        </div>
    </div>

    <div class="reagir border-top border-bottom border-munted">
        <!-- ici bouton for like -->
        <div class="btn_Like">
            <?= $likeTest; ?>
        </div>
        <!-- <span type="button" class="likeIcon " style="display: none;"><i class="fas fa-star faIconsBnt"></i></span> -->


        <span class="commenter" type="button"><i class="far fa-list-alt faIconsBnt"></i></span>
        <span class="PartageIcon" type="button"><i class="fas fa-share faIconsBnt"></i></span>
    </div>

    <div class="d-flex w-75 mx-auto bg-light shadow my-1  bloc_Parent_commentaire " id="bloc_Parent_commentaire">

        <div class=" figure-fluid">
            <img src="./images/medias_users/profil_par_defaut.jpg" alt="user profil "
                class="profil-commente img-fluid " />
        </div>

        <div class=" input-group w-100 ">
            <input class="flex-grow-1 border-0 comentaireInput ml-2 iput" type="text" required
                placeholder="Ecrivez votre commentaire..." />
            <div class="input-group-apend  d-flex justify-content-center align-items-center" type="button"
                onclick="maFunction(<?= $id_user_conecter  ?>,<?= $id_article ?> )">
                <i class="far fa-paper-plane mr-2 faIconsBnt"></i>
            </div>
        </div>


    </div>
</div>

<!-- ----end article--- -->
<?php

    }
}


?>
<script>
let Mcommentaire;
$(".iput").change(function postinput() {
    Mcommentaire = $(this).val();
    return Mcommentaire;
});

function maFunction(idU, idAr) {
    // console.log(idU);
    // console.log(idAr);
    // console.log(Mcommentaire);
    $.ajax({
            type: "POST",
            url: "./_partials_actualite/_enreg_commentaire.php",
            data: {
                id_user: idU,
                id_article: idAr,
                commentaire: Mcommentaire,
            },
        })
        .done(function(response) {
            console.log(response);
            $(".iput").val("");
        })
        .fail(function() {
            console.log("error");
        });
}

function handleLiker(idU, idAr) {
    console.log(idU);
    console.log(idAr);
    $.ajax({
            type: "POST",
            url: "./_partials_actualite/_enreg_commentaire.php",
            data: {
                id_user: idU,
                id_article: idAr,
            },
        })
        .done(function(response) {
            console.log(response);
        })
        .fail(function() {
            console.log("error");
        });
}
</script>