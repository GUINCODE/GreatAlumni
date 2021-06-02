   <?php
    include_once('../partials/connectBDD.php');
    $id_post = $_POST['id_post'];
    $mediaPost = $_POST['mediaPost'];



    $stmt = $db->prepare("DELETE FROM article  WHERE  id=:id_post");
    $stmt->bindParam(':id_post', $id_post);
    if ($stmt->execute()) {
        @unlink($mediaPost);
        echo "<h2 class='text-center text-success mt-5'> Post supprimer</h2>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2> <span text-warning>réessayer plutard</span> ";
    }
