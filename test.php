<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>test</title>
</head>

<body>
    <?php
    include_once("./connectBDD.php");
    $sql = "SELECT * FROM article ORDER BY `date`  DESC  ";
    $result = $db->query($sql);
    while ($row = $result->fetch()) {
        $id_article = $row["id"];
        $titre = $row["titre"];
        $text = $row["text"];
    ?>
    <div style="width:400px; margin-left:auto; margin-right:auto">
        <h1>titre: <?= $titre; ?></h1>
        <b>Contenu: <?= $text; ?></b>
        <button class="boutonLike">Like</button>
    </div> <br /><br /><br />


    <?php

    } ?>

    <script>
    var x, i;
    x = document.querySelectorAll(".boutonLike");
    for (i = 0; i < x.length; i++) {
        x[i].addEventListener("click", function() {
            alert("commentéeeeeee!!!");
        });
    }
    </script>

</body>

</html>