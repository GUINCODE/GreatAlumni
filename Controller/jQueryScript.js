$(document).ready(function () {
 

  $("#btn_edit_comment").click(function () {
    $("#bloc_Parent_commentaire").toggleClass("hideurClass");
  });

  $(".unlike_btn").click(function () {
    let zoneStar = $(this)
      .parents(".card")
      .children(".reactionAuthers")
      .find(".place_number_like");

    let identifiant_user = $(this)
      .parents(".btn_Like")
      .siblings(".id_user_log")
      .val();
    let identifiant_article = $(this)
      .parents(".btn_Like")
      .siblings(".id_article")
      .val();

    $(this).parents("span").siblings("span").toggleClass("hideur");
    $(this).parents("span").toggleClass("hideur");
    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_unLike.php",
      data: {
        identifiant_user: identifiant_user,
        identifiant_article: identifiant_article,
      },
    })
      .done(function (response) {
        zoneStar.html(response);
        console.log("dis liker");
        console.log("id user: " + identifiant_user);
        console.log("id article: " + identifiant_article);
      })
      .fail(function () {
        console.log("error _unLike");
      });
  });
  //  scrpt like btn

  $(".like_btn").click(function () {
    let zoneStar = $(this)
      .parents(".card")
      .children(".reactionAuthers")
      .find(".place_number_like");

    let identifiant_user = $(this)
      .parents(".btn_Like")
      .siblings(".id_user_log")
      .val();
    let identifiant_article = $(this)
      .parents(".btn_Like")
      .siblings(".id_article")
      .val();

    $(this).parents("span").siblings("span").toggleClass("hideur");
    $(this).parents("span").toggleClass("hideur");
    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_like.php",
      data: {
        identifiant_user: identifiant_user,
        identifiant_article: identifiant_article,
      },
    })
      .done(function (response) {
        zoneStar.html(response);
      })
      .fail(function () {
        console.log("error _like");
      });
  });

  $(".sendComment").click(function () {
    let id_article = $(this).siblings(".id_article").val();
    let id_user = $(this).siblings(".id_user_log").val();
    let commentaireUser = $(this).siblings(".comentaireInput").val();
    $(this).siblings(".comentaireInput").val("");

    if (commentaireUser == "") {
      console.log("commentaire vide");
    } else {
      let zone_comm = $(this)
        .parents(".bloc_Parent_commentaire")
        .siblings(".reactionAuthers")
        .find(".nombreOfcommentaire");
      let textCommentaire = $(this)
        .parents(".bloc_Parent_commentaire")
        .siblings(".reactionAuthers")
        .find(".showcommentaire");
      textCommentaire.removeClass("hideurClass");
      ////ici la requete ajax
      $.ajax({
        type: "POST",
        url: "../Models/Model_actualite/_enreg_commentaire.php",
        data: {
          identifiant_user: id_user,
          identifiant_article: id_article,
          commentaire: commentaireUser,
        },
      })
        .done(function (response) {
          zone_comm.html(response);
        })
        .fail(function () {
          console.log("error _enreg_commentaire");
        });
      //fin requete ajax
    }
  });
  $(".commenter").click(function () {
    let boiteCommentaire = $(this)
      .parent()
      .siblings(".bloc_Parent_commentaire");
    boiteCommentaire.toggleClass("hideurClass");
    $(this).children().toggleClass("togleIconCommente");
  });
  $(".btn_user_profil").click(function () {
    let subMenuser = $(this).parents(".container").siblings(".sub_btn_profi");
    subMenuser.stop().slideToggle();
  });
  $(".addArticle").click(function () {
    $(".form_new_article").toggleClass("hideurClass");
    $(".form_new_evenement").addClass("hideurClass");
    $(this).parents(".sub_btn_profi").slideToggle();
  });
  $(".addEvenement").click(function () {
    $(".form_new_evenement").toggleClass("hideurClass");
    $(".form_new_article").addClass("hideurClass");
    $(this).parents(".sub_btn_profi").slideToggle();
  });
  $(".addFeedback").click(function () {
    $(this).parents(".sub_btn_profi").slideToggle();
  });
  // les requets via les modals
  $("#form_article").on("submit", function (event) {
    event.preventDefault();
    let zone_infos = $(".zone_infos");
    let donnees = new FormData(this);
    $("#titrePost").val("");
    $("#mediass").val("");
    $("#postst").val("");

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_creer_post.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
      })
      .fail(function () {
        console.log("error _creer_post");
      });
  });

  $("#form_events").on("submit", function (event) {
    event.preventDefault();

    let zone_infos_eve = $(".zone_infos_eve");
    let donnees = new FormData(this);
    $("#titre_eve").val("");
    $("#sous_titre_eve").val("");
    $("#date_eve").val("");
    $("#desc_eve").val("");
    $("#desc_eve").val("");
    $("#medias_eve").val("");

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_creer_evenement.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos_eve.html(response);
      })
      .fail(function () {
        console.log("error _creer_evenement");
      });
  });
  $("#form_events2").on("submit", function (event) {
    event.preventDefault();

    let zone_infos_eve2 = $(".zone_infos_eve2");
    let donnees = new FormData(this);
    $("#titre_eve2").val("");
    $("#sous_titre_eve2").val("");
    console.log("detecter");

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_creer_feedback.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos_eve2.html(response);
      })
      .fail(function () {
        console.log("error _creer_feedback");
      });
  });

  $(".showcommentaire").click(function (e) {
    let id_article = $(this)
      .parents(".reactionAuthers")
      .siblings(".reagir")
      .children(".id_article")
      .val();
    let les_commentaires = $(this)
      .parents(".reactionAuthers")
      .siblings(".les_commentaires");

    les_commentaires.toggleClass("hideurClass");
    $(this).toggleClass("togleIconCommente");

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_fetch_commentaire.php",
      data: {
        id_article: id_article,
      },
    })
      .done(function (response) {
        les_commentaires.html(response);
      })
      .fail(function () {
        console.log("error _fetch_commentaire");
      });
  });

  // messagerie events

  /// events sur l'affichage des items des autres utilisateurs
  $(".all_user").click(function (e) {
    $(this).toggleClass("noirSurBlan");
    $(".list_users_All").toggleClass("hideurClass");
    $(".fa-eye-slash").toggleClass("hideurClass");
    $(".fa-eye").toggleClass("hideurClass");
    $(".masquer").toggleClass("hideurClass");
    $(".afficher").toggleClass("hideurClass");
  });

  //liste des messages recus events click
  $(".bloc_sms_from").click(function (e) {
    $(this).removeClass("textBol");
    let id_userConnecter = $(this).find(".id_Connecter").val();
    let id_expeditaire = $(this).find(".id_Expeditaire").val();
    let profil = $(this).find("img").attr("src");
    let userInfos = $(this).find(".namOfUserTo").val();
    rempli_zone_echange(id_expeditaire, userInfos, profil);
    $(".refresh_message").removeClass("hideurClass");

    $.ajax({
      type: "POST",
      url: "../Models/Model_messagerie/_update_statut_sms.php",
      data: {
        id_userConnecter: id_userConnecter,
        id_expeditaire: id_expeditaire,
      },
    })
      .done(function (response) {
        console.log(response);
      })
      .fail(function () {
        console.log("error _update_statut_sms");
      });
    load_discussion(id_userConnecter, id_expeditaire);
    $("html,body,.fil_sms_echange").animate(
      {
        scrollTop: "1000000000",
      },
      100
    );
  });
  // event click sur un utlisateur X
  $(".autherUser").click(function (e) {
    //  console.log($(this).children(".name_user").text().toLowerCase());

    $(this).removeClass("textBol");
    let user_dest = $(this).find(".id_autre_user").val();
    let userLog = $(this).find(".identifant_userConnecter").val();
    let profil = $(this).find("img").attr("src");
    let infos_user_select = $(this).find(".name_user").text();
    // affiche le boutton actualiser
    $(".refresh_message").removeClass("hideurClass");
    rempli_zone_echange(user_dest, infos_user_select, profil);

    load_discussion(userLog, user_dest);
    $(".list_users_All").toggleClass("hideurClass");
    $(".fa-eye-slash").toggleClass("hideurClass");
    $(".fa-eye").toggleClass("hideurClass");
    $(".masquer").toggleClass("hideurClass");
    $(".afficher").toggleClass("hideurClass");

    $("html,body,.fil_sms_echange").animate(
      {
        scrollTop: "1000000000",
      },
      100
    );
  });
  //raffraichir le fil de discussion
  $(".refresh_message").click(function (e) {
    let id_user_select = $(".id_user_select").val();
    let userLogin = $(".user_log_identifiant").val();
    load_discussion(userLogin, id_user_select);
    $(".refres_txt").toggleClass("hideurClass");
    $(this).toggleClass("hideurClass");

    setTimeout(() => {
      $(".refres_txt").toggleClass("hideurClass");
      $(this).toggleClass("hideurClass");
    }, 7000);

    $("html,body,.fil_sms_echange").animate(
      {
        scrollTop: "1000000000",
      },
      100
    );
  });
  // methode pour remplir la zone d'echange

  function rempli_zone_echange(user_dest, infos_user_select, profil) {
    ///on rempli le to: User infos
    $(".id_user_select").val(user_dest);
    $(".infos_user_select").text(infos_user_select);
    $(".profil_user_select").attr("src", profil);
  }

  function load_discussion(id_connecter, id_interLocutaire) {
    let fil_sms_echange = $(".fil_sms_echange");
    $.ajax({
      type: "POST",
      url: "../Models/Model_messagerie/_fetch_discussion.php",
      data: {
        id_connecter: id_connecter,
        id_interLocutaire: id_interLocutaire,
      },
    })
      .done(function (response) {
        fil_sms_echange.html(response);
      })
      .fail(function () {
        console.log("error _fetch_discussion");
      });
  }

  //// envoyer un message a un utilisateur
  $(".btn_envoyer_message").click(function (e) {
    let valeurSaisi = $(".message_rep").val();
    let id_userConnecter = $(".user_log_identifiant").val();
    let id_destinataire = $(".id_user_select").val();
    if (!id_destinataire) {
      alert(
        "aucun destinataire selectionner !!!\nselectionnez-en un pour l'envoyer un message"
      );
    } else {
      if (
        !valeurSaisi ||
        valeurSaisi == " " ||
        valeurSaisi == "  " ||
        valeurSaisi == "   " ||
        valeurSaisi == "    " ||
        valeurSaisi == "     " ||
        valeurSaisi == "      " ||
        valeurSaisi == "       " ||
        valeurSaisi == "        " ||
        valeurSaisi == "         " ||
        valeurSaisi == "          " ||
        valeurSaisi == "           " ||
        valeurSaisi == "           "
      ) {
        alert("message vide");
      } else {
        $(".debutConversassion").addClass("hideurClass");
        $(".fil_sms_echange").append(
          '<li class="backgroundSecondPlan  sms_envoyer ml-auto mr-1 p-2 mt-4 rounded text-wrap ">' +
            valeurSaisi +
            "</a></li>"
        );

        $(".message_rep").val("");
        //requete d'insertion de message
        $.ajax({
          type: "POST",
          url: "../Models/Model_messagerie/_envoi_message.php",
          data: {
            id_userConnecter: id_userConnecter,
            id_destinataire: id_destinataire,
            message: valeurSaisi,
          },
        })
          .done(function (response) {
            console.log(response);
          })
          .fail(function () {
            console.log("error _envoi_message");
          });
      }
    }
    $("html,body,.fil_sms_echange").animate(
      {
        scrollTop: "1000000000",
      },
      100
    );
  });

  // les requte depuis la page admin

  //edit user
  $(".btn_edit_user").click(function (e) {
    let id_user = $(this).parents().siblings(".z_id_user").val();
    let nom_user = $(this).parents().siblings(".z_nom").val();
    let prenom_user = $(this).parents().siblings(".z_prenom").val();
    let mail_user = $(this).parents().siblings(".z_mail").val();
    let role_user = $(this).parents().siblings(".z_role").val();
    let z_psw = $(this).parents().siblings(".z_psw").val();
    let z_login = $(this).parents().siblings(".z_login").val();

    //remplissage du formulaire de mise a jour
    $(".z_f_id_user").val(id_user);
    $(".z_f_nom_user").val(nom_user);
    $(".z_f_prenom_user").val(prenom_user);
    $(".z_f_mail_user").val(mail_user);
    $(".z_f_role_user").val(role_user);
    $(".z_f_psw_user").val(z_psw);
    $(".z_f_login_user").val(z_login);
  });

  ////envoi du formulaire de mise a jour user from admin

  $("#z_form_user_update").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".zone_infos");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_admin/_update_user.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        console.log("error _update_user");
      });
  });

  //delete user by admin

  //on recupere l'id du user a deleter
  $(".btn_delete_user").click(function (e) {
    let id_user = $(this).parents().siblings(".z_id_user").val();
    $(".User_del_id").val(id_user);
  });

  $(".supp_user_by_admin").click(function (e) {
    e.preventDefault();
    let id_user = $(this).siblings(".User_del_id").val();
    let space_response = $(".space_response");
    $.ajax({
      type: "POST",
      url: "../Models/Model_admin/_delete_user.php",
      data: {
        id_user: id_user,
      },
    })
      .done(function (response) {
        space_response.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        console.log("error _delete_user");
      });
  });

  // update events by admin
  $(".btn_edit_ev").click(function (e) {
    e.preventDefault();
    //on recuper les infos de l'evenement pour remplir le champs du formulaire update d'evenement

    let id_eve = $(this).parents().siblings(".z_id_ev").val();
    let titre_eve = $(this).parents().siblings(".z_titre_ev").val();
    let sub_titre_eve = $(this).parents().siblings(".z_sub_titre_ev").val();
    let desc_eve = $(this).parents().siblings(".z_descriptions_ev").val();
    let image_eve = $(this).parents().siblings(".z_image_path_ev").val();
    let date_eve = $(this).parents().siblings(".z_dates_ev").val();
    //remplissage du formulaire de mise a jour

    $(".id_eve_update").val(id_eve);
    $(".titre_eve_update").val(titre_eve);
    $(".sous_titre_eve_update").val(sub_titre_eve);
    $(".date_eve_update").val(date_eve);
    $(".desc_eve_update").val(desc_eve);
    //  $(".medias_eve_update").val(image_eve);
  });
  $("#form_events_update").submit(function (e) {
    e.preventDefault();
    let zone_infos_ev = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_admin/_update_eve.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos_ev.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        console.log("error _update_eve");
      });
  });
  //  suppression d'evenement par admin
  //on recupere l'id du user a deleter
  $(".btn_delete_ev").click(function (e) {
    let z_id_ev = $(this).parents().siblings(".z_id_ev").val();
    let z_image_path_ev = $(this).parents().siblings(".z_image_path_ev").val();
    //on rempli les deux champs pour supprimer l'evenement et l'image associer
    $(".eve_del_id").val(z_id_ev);
    $(".eve_del_media").val(z_image_path_ev);
  });
  // validation de suppression par admin
  $(".supp_eve_by_admin").click(function (e) {
    e.preventDefault();

    let id_evenement = $(this).siblings(".eve_del_id").val();
    let media_eve = $(this).siblings(".eve_del_media").val();
    let space_response = $(".space_response");
    $.ajax({
      type: "POST",
      url: "../Models/Model_admin/_delete_eve.php",
      data: {
        id_evenement: id_evenement,
        media_eve: media_eve,
      },
    })
      .done(function (response) {
        space_response.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        console.log("error _delete_eve");
      });
  });

  //suppression de post
  $(".btn_delete_post").click(function (e) {
    let z_id_post = $(this).parents().siblings(".z_id_post").val();
    let z_image_path_post = $(this).parents().siblings(".z_media_post").val();

    //on rempli les deux champs pour supprimer l'evenement et l'image associer
    $(".post_del_id").val(z_id_post);
    $(".post_del_media").val(z_image_path_post);
  });
  //validation de la suppression du post
  $(".supp_post_by_admin").click(function (e) {
    e.preventDefault();
    let id_post = $(".post_del_id").val();
    let mediaPost = $(".post_del_media").val();

    let space_response = $(".space_response");
    $.ajax({
      type: "POST",
      url: "../Models/Model_admin/_delete_post.php",
      data: {
        id_post: id_post,
        mediaPost: mediaPost,
      },
    })
      .done(function (response) {
        space_response.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        console.log("error _delete_post");
      });
  });

  // changement de l'tem-active
  $(".admin-items").click(function (e) {
    $(".admin-items").removeClass("item_active");
    $(this).addClass("item_active");
  });

  //changement du content gestion
  $(".admin_item_user").click(function (e) {
    $(".togglerALL").addClass("hideurClass");
    $(".content_user_space_admin").removeClass("hideurClass");
  });
  $(".admin_item_event").click(function (e) {
    $(".togglerALL").addClass("hideurClass");
    $(".content_events_space_admin").removeClass("hideurClass");
  });
  $(".admin_item_post").click(function (e) {
    $(".togglerALL").addClass("hideurClass");
    $(".content_posts_space_admin").removeClass("hideurClass");
  });

  // Ajout de nouveau membre par admin

  $("input").focus(function (e) {
    $(this).removeClass("text-danger border-danger");
  });

  $("#add_member_form").submit(function (e) {
    e.preventDefault();
    let log = $(".loginW").val();
    let password = $(".passwordW").val();
    let prenom = $(".prenomW").val();
    let mail = $(".mailW").val();

    let zoneAlerte = $(".zoneAlerte");
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);
    $(".mailW").focus(function (e) {});
    $.ajax({
      type: "POST",
      url: "../Models/Model_admin/_add_new_member.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        if (response == "existe") {
          $(".mailW").addClass(" is-invalid text-danger border-danger ");
          zoneAlerte.html(
            "<span class='text-center text-danger mt-5'> Cet adresse mail est associer a un autre compte </span>"
          );
        } else {
          sendEmail(log, password, prenom, mail);
          zone_infos.html(response);
          setTimeout(() => {
            location.reload();
          }, 2000);
        }
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error add_member_form");
      });
  });
  $(".mailW").keyup(function (e) {
    let zoneAlerte = $(".zoneAlerte");
    $(this).removeClass("is-invalid text-danger border-danger");
    zoneAlerte.html("");
  });

  /***  Generation de login et de mot de passe*/
  function generate(l) {
    if (typeof l === "undefined") {
      var l = 10;
    }
    /* c : chaîne de caractères alphanumérique */
    var c = "abcdefghijknopqrstuvwxyzACDEFGHJKLMNPQRSTUVWXYZ12345679",
      n = c.length,
      /* p : chaîne de caractères spéciaux */
      p = "!@#$+-*&_",
      o = p.length,
      r = "",
      n = c.length,
      /* s : determine la position du caractère spécial dans le mdp */
      s = Math.floor(Math.random() * (p.length - 1));

    for (var i = 0; i < l; ++i) {
      if (s == i) {
        /* on insère à la position donnée un caractère spécial aléatoire */
        r += p.charAt(Math.floor(Math.random() * o));
      } else {
        /* on insère un caractère alphanumérique aléatoire */
        r += c.charAt(Math.floor(Math.random() * n));
      }
    }
    return r;
  }

  /* évènement click sur un element de class "generate" > appelle la fonction generate() */

  $(".generate").click(function (e) {
    e.preventDefault();
    $(this).parent().children("input").val(generate()).attr("type", "text");
  });

  /*  requete d'envoi de mail de aux memebre pour la confirmation de creation de compte*/
  //fonction d'envoi de mail
  function sendEmail(login, password, prenom, mail) {
    Email.send({
      Host: "smtp.gmail.com",
      Username: "greacomplus@gmail.com",
      Password: "greatcomplus@2021",
      To: ` ${mail}`,
      From: "greacomplus@gmail.com",
      Subject: "Confirmation de creation de compte GREATALUMNI",
      Body: ` Bonjour <b>${prenom}</b>, vous trouverez ci-dessous vos informations de connexion  !!<br/>
    <span style="color:Indigo">Login:</span> ${login} <br/> 
    <span style="color:Indigo">Password: </span> ${password} <br/> <br/>
    Pour se Connecter cliquez sur: http://localhost/GreatAlumni/ <br/>
    <h1 style="color:DarkGoldenRod"> Attention :</h1>
Vous êtes le seul destinataire de ce message, alors pour <span style="color:red"> la sécurité de votre compte</span>, 
  Veuillez à ne pas communiquer vos identifications de connexion à un tiers.
<br/>  <br/> 
   <b>Ce courriel a été envoyé automatiquement, merci de ne pas y répondre. !!!</b>  <br/><br/> 
    Si vous avez des problèmes de connexion veuillez contacter l'administrateur:
    <br/> <br/><strong>tel: 06 05 60 21 30</strong><br/><b>e-mail: admin@greatalumni.com</b>
    <br/> <br/> <br/>
   <span style=" font-size:80px; color:Navy; font-family: Georgia, serif; text-shadow: 1px 1px 2px yellow; margin-left:110px"> 
     GREATCOM+
  </span> 
  <br/><span style="color:white; background:black; font-size:15px; margin-left:190px; padding-top:10px; padding-bottom:10px">ENSITECH - ALUMNI - PLATEFORM</span>`,
    }).then((message) => console.log("mail sent successfully"));
  }

  // Connexion de l'utlisateur
  $(".loginUser").click(function (e) {
    e.preventDefault();
    // // alert("detecter")
    $(".champsEmail").focus(function (e) {
      $(".email_vide").addClass("hideurClass");
      $(".infosErreur").html("");
      $(this).removeClass("is-invalid border border-danger");
    });
    $(".champsPsw").focus(function (e) {
      $(".psw_vide").addClass("hideurClass");
      $(".infosErreur").html("");
      $(this).removeClass("is-invalid border border-danger");
    });

    let email = $(".champsEmail").val();
    let psw = $(".champsPsw").val();

    if (email == "") {
      $(".email_vide").removeClass("hideurClass");
      $(".champsEmail").addClass("is-invalid border border-danger");
    } else if (psw == "") {
      $(".psw_vide").removeClass("hideurClass");
      $(".champsPsw").addClass("is-invalid border border-danger");
    }
    if (email != "" && psw != "") {
      $.ajax({
        type: "POST",
        url: "./Models/_loginUser.php",
        data: {
          email: email,
          psw: psw,
        },
      })
        .done(function (response) {
          if (response == 0) {
            $(".infosErreur").html(
              "<br><span class='text-danger'> Login ou Mot de passe incorect</span>"
            );
            $(".champsPsw").addClass("border border-danger text-danger");
            $(".champsEmail").addClass("border border-danger text-danger");
          } else {
            $(".fa-spinner").removeClass("hideurClass");
             location.replace("http://localhost/GreatAlumni/View/actualite.php");
          }
        })
        .fail(function () {
          console.log("error login");
        });
    }
  });

  //tri dans annuaire
  $("#tri_By").change(function (e) {
    e.preventDefault();
    let choix = $(this).val();
    if (choix == "nom") {
      $(".annuaire_conten").load("../Models/Model_annuaire/_tri_by_nom.php");
    } else if (choix == "prenom") {
      $(".annuaire_conten").load("../Models/Model_annuaire/_tri_by_prenom.php");
    } else if (choix == "promotion") {
      $(".annuaire_conten").load("../Models/Model_annuaire/_tri_by_promotion.php");
    } else {
      $(".annuaire_conten").load("../Models/Model_annuaire/_aucun_tri.php");
    }
  });
  ////

  // chercher un membre
  $("#myInput").keyup(function () {
    // Retrieve the input field text and reset the count to zero
    var filter = $(this).val(),
      count = 0;

    // Loop through the comment list
    $("#annuaire_conten div").each(function () {
      // If the list item does not contain the text phrase fade it out
      if ($(this).text().search(new RegExp(filter, "i")) < 0) {
        $(this).hide(); // MY CHANGE

        // Show the list item if the phrase matches and increase the count by 1
      } else {
        $(this).show(); // MY CHANGE
        count++;
      }
    });
  });

  // ////

  //  filtrer par campus
  $("#show_by_campus").change(function (e) {
    // Retrieve the input field text and reset the count to zero
    let filter = $(this).val();
    if (filter == "all_campus") {
      $(".annuaire_conten").load("../Models/Model_annuaire/_aucun_tri.php");
    } else {
      count = 0;

      // Loop through the comment list
      $("#annuaire_conten div").each(function () {
        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
          $(this).hide(); // MY CHANGE

          // Show the list item if the phrase matches and increase the count by 1
        } else {
          $(this).show(); // MY CHANGE
          count++;
        }
      });
      console.log(filter);
    }
  });

  // report user and post

  $(".dot_report").click(function (e) {
    let reportBlock = $(this).siblings(".reportBlock");
    reportBlock.toggleClass("hideurClass");
  });
  $(".reportPost").click(function (e) {
    let id_article = $(this).siblings(".id_article").val();
    let id_auteur_post = $(this).siblings(".id_auteur_post").val();
    let id_signaleur = $(".id_user_log").val();

    let BoxpostSignaler = $(this).siblings(".postSignaler");
    let enCours1 = $(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_report_post.php",
      data: {
        id_article: id_article,
        id_auteur_post: id_auteur_post,
        id_signaleur: id_signaleur,
      },
    })
      .done(function (response) {
        if (response === "ok") {
          BoxpostSignaler.removeClass("hideurClass");
          enCours1.addClass("hideurClass");
        } else {
          console.log(response);
        }
      })
      .fail(function () {
        console.log("error _report_post");
      });
  });
  $(".reportUser").click(function (e) {
    let id_auteur_post = $(this).siblings(".id_auteur_post").val();
    let id_signaleur = $(".id_user_log").val();
    let userSignaler = $(this).siblings(".userSignaler");
    let enCours = $(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_report_user.php",
      data: {
        id_auteur_post: id_auteur_post,
        id_signaleur: id_signaleur,
      },
    })
      .done(function (response) {
        if (response === "ok") {
          userSignaler.removeClass("hideurClass");
          enCours.addClass("hideurClass");
        } else {
          console.log(response);
        }
      })
      .fail(function () {
        console.log("error _report_user");
      });
  });
  // page profil user connecter
  $(".btn_formation_user").click(function (e) {
    $(".boutonAllBlue").removeClass("item_active_Profil");
    $(this).addClass("item_active_Profil");
    $(".communeClass").addClass("hideurClass");
    $(".MesFormations").removeClass("hideurClass");
  });
  $(".btn_experience_user").click(function (e) {
    $(".boutonAllBlue").removeClass("item_active_Profil");
    $(this).addClass("item_active_Profil");
    $(".communeClass").addClass("hideurClass");
    $(".MesExperiences").removeClass("hideurClass");
  });
  $(".btn_hobbie_user").click(function (e) {
    $(".boutonAllBlue").removeClass("item_active_Profil");
    $(this).addClass("item_active_Profil");
    $(".communeClass").addClass("hideurClass");
    $(".MesHobbies").removeClass("hideurClass");
  });

  $("#btn_mofier_user_infos").click(function (e) {
    e.preventDefault();
    let nom = $("#nom").val();
    let prenom = $("#prenom").val();
    let campus = $("#campus").val();
    let profession = $("#profession").val();
    let departement = $("#departement").val();
    let mail = $("#mail").val();
    let promotion = $("#promotion").val();
    let password = $("#password").val();
    let login = $("#login").val();

    $(".nomUser").val(nom);
    $(".prenomUser").val(prenom);
    $(".mailUser").val(mail);
    $(".promotionUser").val(promotion);
    $(".loginW").val(login);
    $(".passwordW").val(password);
    $(".campus").val(campus);
    $(".departement").val(departement);
    $(".professionUser").val(profession);
  });

  //validation de la mise a jour des infos de l'utlisateur connecter
  $("#updateUserLogin_formulaire").submit(function (e) {
    e.preventDefault();
    let zoneAlerte = $(".zoneAlerte");
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_update_user_connecter.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        if (response == "existe") {
          $(".mailW").addClass(" is-invalid text-danger border-danger ");
          zone_infos.html(
            "<span class='text-center text-danger mt-5'> Cet adresse mail est associer a un autre compte </span>"
          );
        } else {
          zone_infos.html(response);
          setTimeout(() => {
            location.reload();
          }, 2000);
        }
      })
      .fail(function () {
        // setTimeout(() => {
        //   location.reload();
        // }, 2000);
        console.log("error _update_user_connecter");
      });
  });
  $(".update_citation").click(function (e) {
    e.preventDefault();

    let citation = $("#citation").val();
    $("#myCitation").val(citation);
  });
  // validation de la mise a jour de la citation
  $("#update_citation_user").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_update_user_citation.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _update_user_citation");
      });
  });
  // update profil user
  $("#update_profil_user").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_update_image_profil.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _update_image_profil");
      });
  });

  // user connecter ajoute une nouvelle formation
  $("#add_new_formation").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_add_new_formation.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _add_new_formation");
      });
  });

  // sppression de formation de user
  $(".btn_delete_formation").click(function (e) {
    e.preventDefault();
    let id_formation = $(this).siblings(".id_formation").val();
    $(".formation_id_del").val(id_formation);
    //  alert(id_formation);
  });
  //validation de la suppression de formation
  $(".valid_sup_formation").click(function (e) {
    let id_formationz = $(".formation_id_del").val();
    // alert(id_formationz);
    let space_response = $(".space_response");
    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_delete_formation.php",
      data: {
        id_formationz: id_formationz,
      },
    })
      .done(function (response) {
        space_response.html(response);
        setTimeout(() => {
          location.reload();
        }, 900);
      })
      .fail(function () {
        console.log("error _delete_formation");
      });
  });

  // update formation user
  $(".btn_update_formation").click(function (e) {
    e.preventDefault();

    let id_formation = $(this).siblings(".id_formation").val();
    let annee_formation = $(this).siblings(".annee_formation").val();
    let name_formation = $(this).siblings(".name_formation").val();
    let ecole_formation = $(this).siblings(".ecole_formation").val();

    $(".idF").val(id_formation);
    $(".anneeF").val(annee_formation);
    $(".nomF").val(name_formation);
    $(".ecoleF").val(ecole_formation);
  });
  $("#update_formation").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_update_formation.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 400);
      })
      .fail(function () {
        // setTimeout(() => {
        //   location.reload();
        // }, 7000);
        console.log("error _update_formation");
      });
  });

  // user connecter ajoute une nouvelle experience
  $("#add_new_experience").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_add_new_experience.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _add_new_experience");
      });
  });
  // mise a jour d'une experience de l'utilisateur
  $(".btn_update_experience").click(function (e) {
    let id_experience = $(this).siblings(".id_experience").val();
    let date_debut = $(this).siblings(".date_debut").val();
    let date_fin = $(this).siblings(".date_fin").val();
    let post_occupe = $(this).siblings(".post_occupe").val();
    let type_emploi = $(this).siblings(".type_emploi").val();
    let entreprise = $(this).siblings(".entrepriseXZ").val();
    if (date_fin === "En cours...") {
      date_fin = "";
    }
    $(".id_experience").val(id_experience);
    $(".date_debX").val(date_debut);
    $(".date_finX").val(date_fin);
    $(".poste").val(post_occupe);
    $(".type_poste").val(type_emploi);
    $(".entrepriseYZ").val(entreprise);
  });
  //soumition du formulaire update
  $("#add_update_experience").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_update_experience.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _update_experience");
      });
  });

  // suppression d'experinece du user
  $(".btn_delete_experience").click(function (e) {
    e.preventDefault();
    let id_experience = $(this).siblings(".id_experience").val();
    $(".experience_id_del").val(id_experience);
  });
  // validation de la suppression de l'experience
  $(".valid_sup_experience").click(function (e) {
    let id_experience_z = $(".experience_id_del").val();
    // alert(id_formationz);
    let space_response = $(".space_response");
    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_delete_experience.php",
      data: {
        id_experience_z: id_experience_z,
      },
    })
      .done(function (response) {
        space_response.html(response);
        setTimeout(() => {
          location.reload();
        }, 900);
      })
      .fail(function () {
        console.log("error _delete_experience");
      });
  });

  // ajout de new hobbie
  $("#add_new_hobbie").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_add_new_hobbie.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _add_new_hobbie");
      });
  });

  // mise a jour de hobbie
  $(".btn_update_hobbie").click(function (e) {
    e.preventDefault();
    let id_hobbie = $(this).siblings(".id_hobbbie").val();
    let name_hobbie = $(this).siblings(".nom_du_hobbie").val();
    $(".id_Hobbie_pw").val(id_hobbie);
    $(".hobbie_nameT").val(name_hobbie);
  });

  // soummission du formulaire mise a jour hobbie
  $("#update_hobbie").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_update_hobbie.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _update_hobbie");
      });
  });

  // suppression de hobbie
  $(".btn_delete_hobbie").click(function (e) {
    e.preventDefault();
    let id_hobbie_a_deleter = $(this).siblings(".id_hobbbie").val();
    $(".hobie_id_del").val(id_hobbie_a_deleter);
  });

  // validation de la suppression de  hobbie
  $(".valid_sup_hobbie").click(function (e) {
    let hobie_id_del = $(".hobie_id_del").val();
    // alert(id_formationz);
    let space_response = $(".space_response");
    $.ajax({
      type: "POST",
      url: "../Models/Model_profil/_delete_hobbie.php",
      data: {
        hobie_id_del: hobie_id_del,
      },
    })
      .done(function (response) {
        space_response.html(response);
        setTimeout(() => {
          location.reload();
        }, 900);
      })
      .fail(function () {
        console.log("error _delete_hobbie");
      });
  });

  // acceder au zone echange forum et son retour
  $(".acceder_sujet").click(function (e) {
    e.preventDefault();
    $(this).parents(".les_sujet").toggleClass("hideurClass");
    $(".discussion").toggleClass("hideurClass");
    setTimeout(() => {
      $("html,body, .discussion").animate(
        {
          scrollTop: "1000000000",
        },
        100
      );
    }, 300);
  });
  $(".retour_btn_forum").click(function (e) {
    e.preventDefault();
    $(".les_sujet").toggleClass("hideurClass");
    $(".discussion").toggleClass("hideurClass");
  });

  // load discussion sur un sujet specifique
  $(".lireSujet").click(function (e) {
    e.preventDefault();
    let id_sujet = $(this).siblings(".id_sujet").val();
    let titre_sujet = $(this).siblings(".titre_sujet").val();
    let categorie_sujet = $(this).siblings(".categorie_sujet").val();

    $(".titre_sujet_selected").text(titre_sujet);
    $(".categorie_sujet_selected").text(categorie_sujet);
    $(".id_sujet_selected").val(id_sujet);
    let id_user_connecter = $(".id_user_log").val();

    $.ajax({
      type: "POST",
      url: "../Models/Model_forum/_load_rep_sujet.php",
      data: {
        id_sujet: id_sujet,
        id_user_connecter: id_user_connecter,
      },
    })
      .done(function (response) {
        $("#les_reactionForum").html(response);
      })
      .fail(function () {
        console.log("error _load_rep_sujet");
      });
  });

  // envoi reponse utilisateur sur un sujet
  $("#btn_repondre_sujet").click(function (e) {
    e.preventDefault();
    let idSujete = $(".id_sujet_selected").val();
    let id_user_connecter = $(".id_user_log").val();
    let champReponseSujet = $("#champSaisie_reponse").val();
    if (champReponseSujet == "") {
      alert("champs vide");
    } else {
      // alert(id_user_connecter)
      $.ajax({
        type: "POST",
        url: "../Models/Model_forum/_repondre_sujet.php",
        data: {
          idSujete: idSujete,
          id_user_connecter: id_user_connecter,
          champReponseSujet: champReponseSujet,
        },
      })
        .done(function (response) {
          $("#champSaisie_reponse").val("");
          $("#text_info_si_aucune_intervation").addClass("hideurClass");
          $("#les_reactionForum").append(
            '<li class="p-3  mt-1 border rounded  mr-auto ml-5 text-center myReactioSujet ">' +
              '<div class="d-flex  ">' +
              '<p class="text-wrap p-2 w-100 shadow  "> ' +
              champReponseSujet +
              "</p>" +
              '<span class="text-muted ml-2 mt-5 bg-light p-1 rounded d-flex justify-content-center align-items-center ">' +
              "Vous" +
              '<i class="fas fa-check ml-2"></i><i class="fas fa-check "></i>' +
              "</span>" +
              "</div>" +
              "</li>"
          );
        })
        .fail(function () {
          console.log("error _repondre_sujet");
        });
      $("html,body, .discussion").animate(
        {
          scrollTop: "1000000000",
        },
        100
      );
    }
  });

  // creer un sujet sur le forum
  $("#creer_sujet_formulaire").submit(function (e) {
    e.preventDefault();
    let zone_infos = $(".space_response_eve_admin");
    let donnees = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../Models/Model_forum/_creer_sujet_forum.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
        setTimeout(() => {
          location.reload();
        }, 2000);
      })
      .fail(function () {
        setTimeout(() => {
          location.reload();
        }, 2000);
        console.log("error _creer_sujet_forum");
      });
  });

  //  les notifications
  var id_user_connecter = $(".user_log_identifiant").val();
  // recuperation de nombre message non lu
  setInterval(() => {
   
      if($('.spaceNbreMessage').text()==""){
        $('.spaceNbreMessage').addClass("hideurClass")
      }
      if ($(".spaceNbreMessage").text() != "") {
        $(".spaceNbreMessage").removeClass("hideurClass");
      }
        if ($(".spaceNbreEVE").text() == "") {
          $(".spaceNbreEVE").addClass("hideurClass");
        }
        if ($(".spaceNbreEVE").text() != "") {
          $(".spaceNbreEVE").removeClass("hideurClass");
        }
         if ($(".spaceNbreAUTRE").text() == "") {
           $(".spaceNbreAUTRE").addClass("hideurClass");
         }
         if ($(".spaceNbreAUTRE").text() != "") {
           $(".spaceNbreAUTRE").removeClass("hideurClass");
         }

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_fetch_msg_notif.php",
      data: {
        id_user_connecter: id_user_connecter,
      },
    })
      .done(function (response) {
        $(".nbrMessage").text(response);
        //  alert("fdfdf")
      })
      .fail(function () {
        console.log("erreur recuperation message notif");
      });

    // recuperation de nombre evenement
    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_fetch_eve_notif.php",
      data: {
        id_user_connecter: id_user_connecter,
      },
    })
      .done(function (response) {
        $(".nbrEvenement").text(response);
        //  alert("fdfdf")
      })
      .fail(function () {
        console.log("erreur de recuperation nombre evenement");
      });

    // recuperation de nombre sujet creer
    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_fetch_autre_notif.php",
      data: {
        id_user_connecter: id_user_connecter,
      },
    })
      .done(function (response) {
        $(".nbrSujet").text(response);
        //  alert("fdfdf")
      })
      .fail(function () {
        console.log("erreur de recuperation nmbr sujet");
      });
  }, 200);

  // rendre le message lu une fois cliquer
  $(".notifSMS").click(function (e) {
    e.preventDefault();
    location.replace("http://localhost/GreatAlumni/View/ma_messagerie.php");

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_update_statut_message.php",
      data: {
        id_user_connecter: id_user_connecter,
      },
    })
      .done(function (response) {
        console.log("");
      })
      .fail(function () {
        console.log("imposiible de lire sms");
      });
  });

  // rendre le message lu une fois cliquer
  $(".notifEVE").click(function (e) {
    e.preventDefault();
    location.replace("http://localhost/GreatAlumni/View/all_evenement.php");

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_update_statut_evenement.php",
      data: {
        id_user_connecter: id_user_connecter,
      },
    })
      .done(function (response) {
        console.log("");
      })
      .fail(function () {
        console.log("erreur lecture evenement vu");
      });
  });
  
  // rendre le message lu une fois cliquer
  $(".notifAUtre").click(function (e) {
    e.preventDefault();
    location.replace("http://localhost/GreatAlumni/View/forum.php");

    $.ajax({
      type: "POST",
      url: "../Models/Model_actualite/_update_statut_autre.php",
      data: {
        id_user_connecter: id_user_connecter,
      },
    })
      .done(function (response) {
        console.log("");
      })
      .fail(function () {
        console.log("error _update_statut_autre");
      });
  });

  // rechercher un utilisateur dans la messagerie
      $("#myInputMessagerie").keyup(function () {
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(),
          count = 0;

        // Loop through the comment list
        $("#contentUserBox div").each(function () {
          // If the list item does not contain the text phrase fade it out
          if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).hide(); // MY CHANGE

            // Show the list item if the phrase matches and increase the count by 1
          } else {
            $(this).show(); // MY CHANGE
            count++;
          }
        });
      });

});
