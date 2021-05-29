<?php
include_once('../partials/connectBDD.php');
$id_article = $_POST['id_article'];




$stmt = $db->prepare(" SELECT * FROM `commentaire` WHERE `id_article` = :id_article ORDER BY `date`  DESC");
$stmt->bindParam(':id_article', $id_article);
if ($stmt->execute()) {
    while ($donnes = $stmt->fetch()) {
        $commentaire = $donnes['texts'];
        $id_user = $donnes['id_user'];
        ///recupere l'utilisateur qui a commeter
        $sql2 = "SELECT * FROM `utilisateur` WHERE `id` = $id_user  LIMIT 1 ";
        $result2 = $db->query($sql2);
        $ligne = $result2->fetch();
        $prenom = $ligne["Prenom"];
        $nom = $ligne["Nom"];
        $profil = $ligne["Photo"];
        if (is_null($profil) or empty($profil)) {
            $profil = "../images/medias_users/userLogin.png";
        }
?>
        <div class=" d-flex mb-1  ">
            <img src="<?= $profil ?>" alt="<?= $prenom ?>" class="img-fluid  img_user_commentaeur mr-1" />
            <p class="border commentaireMon w-50 rounded p-2">
                <span class="user_a_Commente  mb-4 "> <?= $prenom.' '. $nom  ?></span><br>
                <?= $commentaire ?>
            </p>
        </div>

<?php
    }
}
