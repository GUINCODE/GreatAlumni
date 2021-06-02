    
      <?php
        include_once('../partials/connectBDD.php');
        $id_evenement = $_POST['id_evenement'];
        $media_eve = $_POST['media_eve'];



        $stmt = $db->prepare("DELETE FROM evenements  WHERE  id=:id_evenement");
        $stmt->bindParam(':id_evenement', $id_evenement);
        if ($stmt->execute()) {
            @unlink($media_eve);
            echo "<h2 class='text-center text-success mt-5'> Evenement supprimer</h2>";
        } else {
            echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2> <span text-warning>réessayer plutard</span> ";
        }
