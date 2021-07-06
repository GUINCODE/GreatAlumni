    <?php
    include_once('../../partials/connectBDD.php');
   $id_userConnecter= $_POST['id_userConnecter'];
     $id_expeditaire=$_POST['id_expeditaire'];
    

    $stmt = $db->prepare("UPDATE `messagerie` SET `statut` = 'lus' WHERE `id_expeditaire` = :id_expeditaire AND `id_destinataire`=:id_userConnecter ");
    $stmt->bindParam(':id_userConnecter', $id_userConnecter);
    $stmt->bindParam(':id_expeditaire', $id_expeditaire);
    if($stmt->execute()){
  echo"message lus";
    }else{
        echo "Impossible de lire le message";
    }
