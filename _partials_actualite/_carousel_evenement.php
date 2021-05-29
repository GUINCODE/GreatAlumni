<?php


$sql = "SELECT * FROM `evenements` ORDER BY dates DESC ";
$result = $db->query($sql);

$check = $result->fetch();
if (!$check) {
?>
    <div class="bg-info p-2  text-center rounded">
        <h6>Aucun prochain évenement planifié</h6>
        <p>les prochains évenements publiés apparaitrons ici</p>
    </div>

<?php

} else {

?>

    <div id="demo" class="carousel slide " data-ride="carousel">



        <!-- The slideshow -->
        <div class="carousel-inner rounded boxeShadower">
            <?php
            $i = 0;
            while ($row = $result->fetch()) {
                $actives = '';
                if ($i == 0) {
                    $actives = 'active';
                }
            ?>
                <div class="carousel-item <?= $actives; ?> ">

                    <div class="card text-center">
                        <h6 class="card-title"><?= $row['titre']; ?></h6>
                        <figure class="figure">
                            <img src="<?= $row['image_path']; ?>" class="card-img-top" alt="<?= $row['image_path']; ?>">
                            <figcaption class="figure-caption  text-center"><?= $row['dates']; ?></figcaption>
                        </figure>
                        <div class="card-body">
                            <p class="card-text">
                                <?= $row['sub_titre']; ?>

                            </p>
                            <a href="lire_un_evenement.php?id_evenement=<?= $row['id'];  ?>" class="btn btn-outline-primary  btn-sm rounded Mbouton">Lire</a>

                        </div>
                    </div>

                </div>
            <?php
                $i++;
            }
            ?>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>

    </div>
<?php
}


?>