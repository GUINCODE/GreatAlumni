   <?php
    include_once('../partials/connectBDD.php');
    $hobie_id_del = $_POST['hobie_id_del'];




    $stmt = $db->prepare("DELETE FROM `hobbies`  WHERE  id=:hobie_id_del");
    $stmt->bindParam(':hobie_id_del', $hobie_id_del);
    if ($stmt->execute()) {
        
        echo "<span class='text-center text-success mt-5'> hobbie supprimé</span>";
    } else {
        echo "<span class='text-center text-danger mt-5'> Impossible de réaliser l'opération</span> <span text-warning>réessayer plutard</span> ";
    }
