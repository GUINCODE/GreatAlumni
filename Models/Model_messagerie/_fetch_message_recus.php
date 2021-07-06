                <?php
                include_once('../../partials/connectBDD.php');
                $id_user_Connecter = $_POST['id_user_Connecter'];
                // $id_user_Connecter = 8;


                $stmt = $db->prepare("SELECT * FROM `messagerie` WHERE `id_destinataire` = :id_user_Connecter ");
                $stmt->bindParam(':id_user_Connecter', $id_user_Connecter);
                $stmt->execute();
                $liste_sms_recus = $stmt->fetchAll();
                if ($liste_sms_recus) {
                    foreach ($liste_sms_recus as $row => $sms) {
                        $id = $sms['id'];
                        $id_expeditaire = $sms['id_expeditaire'];
                        $message = $sms['texts'];
                        $statut  = $sms["statut"];
                        // verifier si le message depasse 7 caractere, si oui on retir le reste et on affiches seuelement 7 caractere

                        if (strlen($message) > 10) {
                            $text_reduit = substr($message, 0, 10);
                            $message_recu = $text_reduit . "...";
                        } else {
                            $message_recu = $message;
                        }


                        //requete pour recuperer les information de l'expeditaire
                        $sql2 = "SELECT * FROM `utilisateur` WHERE `id` = $id_expeditaire ";
                        $result2 = $db->query($sql2);
                        $ligne = $result2->fetch();
                        $idExpeditaire = $ligne['id'];
                        $nom = $ligne["Nom"];
                        $prenom = $ligne["Prenom"];
                        $profil = $ligne["Photo"];
                        if (is_null($profil) or empty($profil)) {
                            $profil = "./images/medias_users/profil_par_defaut.jpg";
                        }
                        // on verifie le message est deja lus ou pas
                        if ($statut == "lus") {
                ?>
                            <div class=" d-flex bloc_sms_from  rounded mt-1 " type="button">
                                <input type="hidden" value="<?= $idExpeditaire; ?>" class="id_Expeditaire" />
                                <input type="hidden" value="<?= $id_user_Connecter; ?>" class="id_Connecter" />
                                <img class=" img_fromUser" src="<?= $profil;  ?>" alt="<?= $prenom;  ?>" />
                                <div class="d-flex flex-column ml-2">
                                    <span class="namFromsms"><?= $prenom . " " . $nom ?></span>
                                    <span class="smsFrom"><?= $message_recu; ?> </span>
                                </div>
                            </div>

                        <?php  } else {
                        ?>
                            <div class=" d-flex bloc_sms_from  rounded mt-1 textBol " type="button">
                                <input type="hidden" value="<?= $idExpeditaire; ?>" class="id_Expeditaire" />
                                <input type="hidden" value="<?= $id_user_Connecter; ?>" class="id_Connecter" />
                                <img class=" img_fromUser" src="<?= $profil;  ?>" alt="<?= $prenom;  ?>" />
                                <div class="d-flex flex-column ml-2">
                                    <span class="namFromsms "><?= $prenom . " " . $nom; ?></span>
                                    <span class="smsFrom"><?= $message_recu; ?> </span>
                                </div>
                            </div>

                <?php
                        }
                    }
                } else {
                    echo '<span class="text-muted text-center">la boite de récéption est vide</span>';
                }


                ?>