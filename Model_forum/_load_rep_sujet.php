<?php
include_once('../partials/connectBDD.php');
$id_sujet = $_POST['id_sujet'];
$id_user_connecter = $_POST['id_user_connecter'];


$stmt2 = $db->prepare("SELECT * FROM `reponse_sujet`   WHERE `id_sujet`=:id_sujet  ORDER BY date_rep ASC");
$stmt2->bindParam(":id_sujet", $id_sujet);
$stmt2->execute();
$reponses = $stmt2->fetchAll();
if ($reponses) {
    foreach ($reponses as $row => $colonne) {
        $reponse = $colonne["reponse"];
        $id_repondeur = $colonne["id_repondeur"];

        $stmt = $db->prepare("SELECT * FROM `utilisateur`   WHERE `id`=:id_repondeur ");
        $stmt->bindParam(":id_repondeur", $id_repondeur);
        $stmt->execute();
        $colonne = $stmt->fetch();
        $id = $colonne['id'];
        $nom = $colonne['Nom'];
        $prenom = $colonne['Prenom'];
        $profil = $colonne["Photo"];
        if (is_null($profil) or empty($profil)) {
            $profil = "../images/medias_users/profil_par_defaut.jpg";
        }

        if ($id_repondeur != $id_user_connecter) {
?>
            <li class="p-3 mt-1 reagitSujetF border rounded  mr-auto">
                <div class="d-flex flex-column">
                    <div class="d-flex  align-items-center">
                        <div class="user_profil_reagi">
                            <img src="<?= $profil  ?>" alt="..." class="img-fluid circle-rounded user_profil_reagi" />
                        </div>
                        <span class="ml-2 font-weight-bold"><?= $prenom . " " . $nom ?> </span>
                    </div>
                    <p class="text-wrap p-2 w-100 shadow">
                        <?= $reponse ?>
                    </p>

                </div>
            </li>
        <?php
        } else {
        ?>
            <li class="p-3  mt-1 border rounded  mr-auto ml-5 text-center myReactioSujet ">
                <div class="d-flex  ">
                    <p class="text-wrap p-2 w-100 shadow  ">
                        <?= $reponse ?>
                    </p>
                    <span class="text-muted ml-2 mt-5 bg-light p-1 rounded d-flex justify-content-center align-items-center "> Vous <i class="fas fa-check ml-2"></i><i class="fas fa-check "></i> </span>
                </div>
            </li>
    <?php
        }
    }
} else {
    ?>
    <small class=" my-3 text-muted d-flex justify-content-center" id="text_info_si_aucune_intervation">aucunne intervation sur ce sujet</small>

<?php
}


?>