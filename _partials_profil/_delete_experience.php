   <?php
    include_once('../partials/connectBDD.php');
    $id_experience_z = $_POST['id_experience_z'];




    $stmt = $db->prepare("DELETE FROM `parcousprofessionnel`  WHERE  id=:id_experience_z");
    $stmt->bindParam(':id_experience_z', $id_experience_z);
    if ($stmt->execute()) {
        
        echo "<h5 class='text-center text-success mt-5'> Formation supprimée</h5>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2> <span text-warning>réessayer plutard</span> ";
    }
