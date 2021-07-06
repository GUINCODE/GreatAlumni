<?php
include_once('../../partials/connectBDD.php');
$id = $_POST['id'];
$media = $_FILES['media_post']['tmp_name'];

if (is_uploaded_file($_FILES['media_post']['tmp_name'])) 
{
    $date = date('d_m_y_h_i_s_');
    $dossier = '../../images/medias_users/';
    $dossier2 = '../images/medias_users/';
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
     
        if (move_uploaded_file($_FILES['media_post']['tmp_name'], $path)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            $pathComplete = $dossier2 . $newName;

            $stmt = $db->prepare("UPDATE `utilisateur` SET `Photo` = :media_path  WHERE  `id` = :id ");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':media_path', $pathComplete);
            if ($stmt->execute()) {
                echo "<h5 class='text-center text-success'> photo de profil changée</h5>";
            }
        }
    }
} 
//impossible d'uploader l'image
 else{
    echo "<h5 class='text-center text-danger'> Impossible de realiser l'action , une erreur s'est produite</h5>";
 }

?>
         


