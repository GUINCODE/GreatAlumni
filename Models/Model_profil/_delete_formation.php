   <?php
    include_once('../../partials/connectBDD.php');
    $id_formationz = $_POST['id_formationz'];




    $stmt = $db->prepare("DELETE FROM `cursusscolaire`  WHERE  id=:id_formationz");
    $stmt->bindParam(':id_formationz', $id_formationz);
    if ($stmt->execute()) {
        
        echo "<h2 class='text-center text-success mt-5'> Formation supprimée</h2>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2> <span text-warning>réessayer plutard</span> ";
    }
