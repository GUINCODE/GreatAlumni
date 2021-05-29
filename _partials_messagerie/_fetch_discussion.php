<?php
include_once("../connectBDD.php");


   $id_connecter=$_POST['id_connecter'] ;
  $id_interLocutaire=$_POST['id_interLocutaire'] ;
//    $id_connecter=1 ;
//   $id_interLocutaire=2 ;
      


   $stmt = $db->prepare("SELECT * FROM `messagerie` WHERE (`id_destinataire` = :id_connecter  AND `id_expeditaire`=:id_interLocutaire) OR  (`id_destinataire` = :id_interLocutaire AND  `id_expeditaire`=:id_connecter)         ORDER BY `dates` ASC");
                        $stmt->bindParam(':id_connecter', $id_connecter);
                        $stmt->bindParam(':id_interLocutaire', $id_interLocutaire);
                        $stmt->execute();
                        $fil_echange = $stmt->fetchAll();
                        if($fil_echange){
                            foreach ($fil_echange as $row => $ligne) {
                                $message = $ligne['texts'];
                                $id_expeditaire = $ligne['id_expeditaire'];
                                $id_destinataire = $ligne['id_destinataire'];

                                if ($id_connecter == $id_expeditaire) {
                                    echo '<li class="  sms_envoyer ml-auto mr-1 p-2 mt-1 rounded text-wrap ">' . $message . '</li>';
                                } else {
                                    echo '<li class="sms_recus   bg-secondary border p-2 mt-1 rounded text-wrap ">' . $message . '</li>';
                                }
                            }
                        } else{ 
                            echo "<h3 class='text-muted text-center mt-5 debutConversassion'>c'est le début de votre conversation</h3>";
                            echo "<img src='./images/medias_users/salutRobo.gif' alt='salutation' style='width:260px; margin-left:30%' />";
                        }

                      