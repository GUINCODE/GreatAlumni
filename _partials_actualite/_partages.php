<?php
include_once("./connectBDD.php");

?>


<div class="mt-5 mr-1 ">
    <a href="#" class="btn btn-outline-info rounded mb-4 boxeShadower ">Voirs tous les retours d'experiences</a>
    <?php
    $sql = "SELECT * FROM partages  LIMIT 2";
    $verif = $db->query($sql);
    $test = $verif->fetch();
    if (!$test) {
    } else {
        $result = $db->query($sql);
        while ($row = $result->fetch()) {
            $id = $row["id"];
            $id_user = $row["id_user"];
            $titre = $row["titre"];
            $text = $row["text"];
            $date = $row["date"];

            $sql2 = "SELECT * FROM `utilisateur` WHERE `id` = $id_user  LIMIT 1 ";
            $result2 = $db->query($sql2);
            $ligne = $result2->fetch();
            $nom = $ligne["Nom"];
            $prenom = $ligne["Prenom"];
    ?>
    <div class="card mb-5 rounded boxeShadower">
        <div class="card-header">
            Partage d'experience
        </div>
        <div class="card-body">
            <h5 class="card-title titreT"> <span class="text-fluid "><?php echo "$nom  $prenom"; ?></span> fait un
                retour
                d'experience
            </h5>
            <p class="card-text text-fluid"><?= $titre  ?></p>
            <a href="#" class="btn btn-outline-primary rounded btn-sm">consulter</a>
        </div>
    </div>
    <?php
        }
    }


    ?>

    <a href="#" class="btn btn-outline-info rounded  boxeShadower">Voirs tous les retours d'experiences</a>

</div>