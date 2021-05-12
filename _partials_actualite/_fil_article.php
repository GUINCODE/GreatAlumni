<?php
include_once("./connectBDD.php");


$sql = "SELECT * FROM article ORDER BY `date`  DESC  ";
$verif = $db->query($sql);
$test = $verif->fetch();
if (!$test) {
} else {
    $result = $db->query($sql);
    while ($row = $result->fetch()) {
        $id_article = $row["id"];
        $titre = $row["titre"];
        $text = $row["text"];
        $media = $row["media"];
        $nombre_like = $row["nombre_like"];
        $date = $row["date"];
        $id_user = $row["id_user"];

        $sql2 = "SELECT * FROM `utilisateur` WHERE `id` = $id_user  LIMIT 1 ";
        $result2 = $db->query($sql2);
        $ligne = $result2->fetch();
        $nom = $ligne["Nom"];
        $prenom = $ligne["Prenom"];
        $profil = $ligne["Photo"];
        if (is_null($profil) or empty($profil)) {
            $profil = "./images/medias_users/profil_par_defaut.jpg";
        }

        $requet = "SELECT * FROM `commentaire` WHERE `id_article` = ' $id_article' ORDER BY `date` DESC  ";
        $resultat = $db->query($requet);
        $nbrCommente = $resultat->rowCount();

?>

<!-- ----articles----- -->
<div class="card  mx-auto mb-3 rounded">
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
        <input type=hidden id="idArticle" value=<?php echo $id_article; ?> />
        <div class="ml-2" id="place_number_like"> </div>
        <?php
                $toggle_comentaire = "";
                if ($nbrCommente > 0) {
                    $toggle_comentaire = "$nbrCommente commentaires";
                } else {
                    $toggle_comentaire = "";
                }
                ?> <div class="commentaires ml-3 ">
            <a href="#"><?php echo " $toggle_comentaire"; ?> </a>
        </div>
    </div>

    <div class="reagir border-top border-bottom border-munted">
        <span type="button" class="likeIcon "><i class="far fa-star faIconsBnt"></i></span>
        <span type="button" class="likeIcon " style="display: none;"><i class="fas fa-star faIconsBnt"></i></span>

        <span class="commenter"><i class="fas fa-pencil-alt faIconsBnt" type="button" id="btn_edit_comment"></i></span>
        <span class="PartageIcon" type="button"><i class="fas fa-share faIconsBnt"></i></span>
    </div>

    <div class="d-flex w-75 mx-auto bg-light shadow my-1  bloc_Parent_commentaire hideurClass "
        id="bloc_Parent_commentaire">
        <div class=" figure-fluid">
            <img src="./images/medias_users/profil_par_defaut.jpg" alt="user profil "
                class="profil-commente img-fluid " />
        </div>
        <div class=" input-group w-100 ">
            <input class="flex-grow-1 border-0 comentaireInput ml-2" type="text"
                placeholder="Ecrivez votre commentaire..." autofocus />
            <div class="input-group-apend  d-flex justify-content-center align-items-center">
                <i class="far fa-paper-plane mr-2 faIconsBnt" type="button"></i>
            </div>
        </div>

    </div>
</div>


<!-- ----end article--- -->
<?php
    }
}


?>