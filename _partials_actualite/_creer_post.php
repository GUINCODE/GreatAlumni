<?php
include_once('../connectBDD.php');
$id_user = $_POST['id_userlogin_post'];
$titre_post = $_POST['titre_post'];
$media = $_FILES['media_post']['tmp_name'];
$post = $_POST['post'];
if ($media == "" && $post == "") {
?>
<div class="alert alert-danger  alert-dismissible fade show w-75 mx-auto" role="alert">
    les champs <strong> Image </strong> et <strong> Post </strong>, me peuvent pas etre vides tous les deux.
    merci de renseigner les deux, ou l'un d'eux !!!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
} else if ($media == "" && $post != "") {
    $stmt = $db->prepare("INSERT INTO article (titre, texts, id_user) VALUES (:titreR, :postR ,:id_userR)");
    $stmt->bindParam(':titreR', $titre_post);
    $stmt->bindParam(':postR', $post);
    $stmt->bindParam(':id_userR', $id_user);
    if ($stmt->execute()) {
    ?>
<div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
    <strong>Post publié avec succèss !!! Vous pouvez publier un autre</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
    } else {
    ?>
<div class="alert alert-warning  alert-dismissible fade show w-75 mx-auto" role="alert">
    Impossible de publié le post.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
    }
} else {

    if (is_uploaded_file($_FILES['media_post']['tmp_name'])) {
        $date = date('d_m_y_h_i_s_');
        $dossier = '../images/medias_article/';
        $dossier2 = './images/medias_article/';
        $fichier = basename($_FILES['media_post']['name']);
        $taille_maxi = 1000000;
        $taille = filesize($_FILES['media_post']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['media_post']['name'], '.');
        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = '<p style="color:red">Vous devez uploader un fichier de type png, gif, jpg, ou jpeg</p>';
        }
        if ($taille > $taille_maxi) {
            $erreur = 'Le fichier est trop gros...';
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
            // $sql = "INSERT INTO `photos` (`chemin`) VALUES ('$path') ";
            // $resul =  $db->query($sql);
            // if ($resul) {
            if (move_uploaded_file($_FILES['media_post']['tmp_name'], $path)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                $pathComplete = $dossier2 . $newName;

                $stmt = $db->prepare("INSERT INTO article (titre, texts, media, id_user) VALUES (:titreR, :postR , :mediaR,:id_userR)");
                $stmt->bindParam(':titreR', $titre_post);
                $stmt->bindParam(':postR', $post);
                $stmt->bindParam(':mediaR', $pathComplete);
                $stmt->bindParam(':id_userR', $id_user);
                if ($stmt->execute()) {
        ?>
<div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
    <strong>Post publié avec succèss !!! Vous pouvez publier un autre</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
                } else {
                ?>
<div class="alert alert-warning  alert-dismissible fade show w-75 mx-auto" role="alert">
    Impossible de publié le post.
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
    Impossible de publié le post.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
            }
            // } else {
            //     echo "impossible d'inserer le chemin de l'image dans la data base";
            // }
        } else {

            echo $erreur;
        }
    } else {
        ?>
<div class="alert alert-warning  alert-dismissible fade show w-75 mx-auto" role="alert">
    Impossible de publié le post . Assurez-vous de renseigner les données valide
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
    }
}

















///////////////////////////

// $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
// $path = 'uploads/'; // upload directory

// $img = $_FILES['media_post']['name'];
// $tmp = $_FILES['media_post']['tmp_name'];
// // get uploaded file's extension
// $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// // can upload same image using rand function
// $final_image = rand(1000, 1000000) . $img;
// // check's valid format
// if (in_array($ext, $valid_extensions)) {
//     $path = $path . strtolower($final_image);
//     if (move_uploaded_file($tmp, $path)) {
//         // echo "<img src='$path' />";
//         // $name = $_POST['name'];
//         // $email = $_POST['email'];
//         echo 'yess image';
//         //insert form data in the database
//         // $insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('" . $name . "','" . $email . "','" . $path . "')");
//         //echo $insert?'ok':'err';
//     }
// } else {
//     echo 'invalid fichier';
// }