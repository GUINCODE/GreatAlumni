<?php
include_once('../partials/connectBDD.php');

$stmt = $db->prepare("SELECT * FROM `utilisateur`  ORDER BY Prenom ASC ");
// $stmt->bindParam(':id_utlisateur_connecter', $id_user_conecter);
$stmt->execute();
$users_list = $stmt->fetchAll();
foreach ($users_list as $row => $colonne) {

    $id_authe_user = $colonne['id'];
    $nom = $colonne['Nom'];
    $prenom = $colonne['Prenom'];
    $promotion = $colonne['Annee_promotion'];
    $campus = $colonne['campus'];
    $profession = $colonne['profession'];
    $profil = $colonne["Photo"];
    if (is_null($profil) or empty($profil)) {
        $profil = "../images/medias_users/profil_par_defaut.jpg";
    }
?>
    <!-- member -->
    <div class="col-12 col-md-6 col-lg-4 col-xl-3  border shadow-lg pb-1 rounded memberAnnuaire">
        <div class="w-100 d-flex justify-content-center align-items-center">
            <img src='<?= $profil ?>' class=' img-fluid UserProfil_qrs' alt='...'>
        </div>
        <span class="w-100 d-flex justify-content-center align-items-center mt-1 mb-2">
            <strong><?= $nom . " " . $prenom ?></strong>
        </span>

        <p class="text-fluid d-flex flex-column">
            <span>Campus: <strong><?= $campus ?></strong></span>
            <span>Promotion: <strong><?= $promotion ?></strong></span>
            <span>Profession: <strong><?= $profession ?></strong></span>
        </p>
        <a href="profli_consulter.php?id_user_consulter=<?= $id_authe_user ?>" class="btn btn-outline-info btn-sm btn-sm  d-flex w-50 justify-content-center align-items-center mx-auto shadow rounded Mbouton "> voir le profil</a>

    </div>


<?php
}
?>