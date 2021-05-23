<?php
include_once('../connectBDD.php');

$titre_eve = $_POST['titre_eve'];
$sous_titre = $_POST['sous_titre_eve'];
$date_eve = $_POST['date_eve'];
$desc_eve = $_POST['desc_eve'];
$media = $_FILES['medias_eve']['tmp_name'];

if ($media == "" && $titre_eve == "") {
?>
<div class="alert alert-danger  alert-dismissible fade show w-75 mx-auto" role="alert">
    les champs avec un <strong> (*) </strong> est obligatoire !!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
} else {

    if (is_uploaded_file($_FILES['medias_eve']['tmp_name'])) {
        $date = date('d_m_y_h_i_s_');
        $dossier = '../images/medias_evenement/';
        $dossier2 = './images/medias_evenement/';
        $fichier = basename($_FILES['medias_eve']['name']);
        $taille_maxi = 1000000;
        $taille = filesize($_FILES['medias_eve']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['medias_eve']['name'], '.');
        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = '<p style="color:red">Vous devez uploader un fichier de type png, gif, jpg, ou jpeg</p>';
        }
        if ($taille > $taille_maxi) {
            $erreur = '<p style="color:red">Le fichier est trop gros... </p>';
        }
        if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            //On formate le nom du fichier ici...
            $fichier = strtr(
                $fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
            );
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            $newName = $date . $fichier;
            $path = $dossier . $newName;
            $pathComplete = $dossier2 . $newName;

            if (move_uploaded_file($_FILES['medias_eve']['tmp_name'], $path)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $pathComplete = $dossier2 . $newName;

                $stmt = $db->prepare("INSERT INTO evenements (titre, sub_titre, descriptions, image_path , dates) VALUES (:titre, :sub_titre , :descriptions,:image_path, :dates)");
                $stmt->bindParam(':titre', $titre_eve);
                $stmt->bindParam(':sub_titre', $sous_titre);
                $stmt->bindParam(':descriptions', $desc_eve);
                $stmt->bindParam(':image_path', $pathComplete);
                $stmt->bindParam(':dates', $date_eve);
                if ($stmt->execute()) {
    ?>
<div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
    <strong>Evenement publié avec succèss !!! <br>Vous pouvez publier un autre</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
                } else {
                ?>
<div class="alert alert-warning  alert-dismissible fade show w-75 mx-auto" role="alert">
    Impossible de publié .
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
                }
            } else //Sinon (la fonction renvoie FALSE).
            {
                ?>
<div class="alert alert-warning  alert-dismissible fade show w-75 mx-auto" role="alert">
    Impossible de publié l'evenement.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
            }
        } else {

            echo $erreur;
        }
    } else {
        ?>
<div class="alert alert-warning  alert-dismissible fade show w-75 mx-auto" role="alert">
    Impossible de publié l'evenement. Assurez-vous de renseigner les données valides
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
    }
}