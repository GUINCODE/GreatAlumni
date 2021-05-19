<?php
include_once("./connectBDD.php");

$sql = "SELECT * FROM `evenements` ";
$result = $db->query($sql);

$check = $result->fetch();
if (!$check) {
?>
<div class="bg-info p-2  text-center rounded">
    <h6>Aucun prochain évenement planifié</h6>
    <p>les prochains évenements planifiés apparaitrons ici</p>
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
                    <img src="<?= $row['image_path']; ?>" class="card-img-top" alt="...">
                    <figcaption class="figure-caption  text-center"><?= $row['date']; ?></figcaption>
                </figure>
                <div class="card-body">
                    <p class="card-text">
                        <?= $row['description']; ?>

                    </p>
                    <a href="#" class="btn btn-outline-primary  btn-sm rounded">Lire</a>

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