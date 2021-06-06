   <?php
    include_once('../partials/connectBDD.php');
    $z_f_id_user = $_POST['z_f_id_user'];
    $z_f_nom_user = $_POST['z_f_nom_user'];
    $z_f_prenom_user = $_POST['z_f_prenom_user'];
    $z_f_mail_user = $_POST['z_f_mail_user'];
    $z_f_role_user = $_POST['z_f_role_user'];
    $z_f_login_user=$_POST["z_f_login_user"];
    $z_f_psw_user=$_POST["z_f_psw_user"];

    $stmt = $db->prepare("UPDATE `utilisateur` SET `Nom` = :z_f_nom_user,`Prenom` = :z_f_prenom_user, `Mail`=:z_f_mail_user,  `Loginn` = :z_f_login_user,   `Mdp` = :z_f_psw_user, `Typee`=:z_f_role_user  WHERE `id`=:z_f_id_user ");
    $stmt->bindParam(':z_f_id_user', $z_f_id_user);
    $stmt->bindParam(':z_f_nom_user', $z_f_nom_user);
    $stmt->bindParam(':z_f_prenom_user', $z_f_prenom_user);
    $stmt->bindParam(':z_f_mail_user', $z_f_mail_user);
    $stmt->bindParam(':z_f_role_user', $z_f_role_user);
    $stmt->bindParam(':z_f_login_user', $z_f_login_user);
    $stmt->bindParam(':z_f_psw_user', $z_f_psw_user);

    if ($stmt->execute()) {
        echo "<h2 class='text-center text-success mt-5'> Mise à jours efféctuée</h2>";
    } else {
        echo "<h2 class='text-center text-danger mt-5'> Impossible de réaliser l'opération</h2>";
    }


  