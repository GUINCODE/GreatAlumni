$(document).ready(function () {
  function loadSMS() {
    $.ajax({
      type: "POST",
      url: "../_partials_actualite/_load_msg.php",
      data: { id_user: 1 },
    })
      .done(function (response) {
        $("#subMessagerie").html(response);
      })
      .fail(function () {
        console.log("error");
      });
  }
  function loadEVE() {
    $.ajax({
      type: "POST",
      url: "../_partials_actualite/_load_evenement.php",
      data: { id_user: 1 },
    })
      .done(function (response) {
        $("#subEvenement").html(response);
      })
      .fail(function () {
        console.log("error");
      });
  }
  function loadAutre() {
    $.ajax({
      type: "POST",
      url: "../_partials_actualite/_load_autre.php",
      data: { id_user: 1 },
    })
      .done(function (response) {
        $("#subAutre").html(response);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $("#btn_notif_message").click(function () {
    $(".fermet3").hide();
    $(".fermet2").hide();
    $("#subMessagerie").stop(true, true).slideToggle(200, loadSMS);
  });
  $("#btn_notif_evenement").click(function () {
    $(".fermet1").hide();
    $(".fermet3").hide();
    $("#subEvenement").stop(true, true).slideToggle(200, loadEVE);
  });
  $("#btn_notif_autre").click(function () {
    $(".fermet1").hide();
    $(".fermet2").hide();
    $("#subAutre").stop(true, true).slideToggle(200, loadAutre);
  });

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
      url: "../_partials_actualite/_unLike.php",
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
        console.log("error");
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
      url: "../_partials_actualite/_like.php",
      data: {
        identifiant_user: identifiant_user,
        identifiant_article: identifiant_article,
      },
    })
      .done(function (response) {
        zoneStar.html(response);
      })
      .fail(function () {
        console.log("error");
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
        url: "../_partials_actualite/_enreg_commentaire.php",
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
          console.log("error");
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
      url: "../_partials_actualite/_creer_post.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos.html(response);
      })
      .fail(function () {
        console.log("error");
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
      url: "../_partials_actualite/_creer_evenement.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos_eve.html(response);
      })
      .fail(function () {
        console.log("error");
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
      url: "../_partials_actualite/_creer_feedback.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        zone_infos_eve2.html(response);
      })
      .fail(function () {
        console.log("error");
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
      url: "../_partials_actualite/_fetch_commentaire.php",
      data: {
        id_article: id_article,
      },
    })
      .done(function (response) {
        les_commentaires.html(response);
      })
      .fail(function () {
        console.log("error");
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
      url: "../_partials_messagerie/_update_statut_sms.php",
      data: {
        id_userConnecter: id_userConnecter,
        id_expeditaire: id_expeditaire,
      },
    })
      .done(function (response) {
        console.log(response);
      })
      .fail(function () {
        console.log("error");
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
      url: "../_partials_messagerie/_fetch_discussion.php",
      data: {
        id_connecter: id_connecter,
        id_interLocutaire: id_interLocutaire,
      },
    })
      .done(function (response) {
        fil_sms_echange.html(response);
      })
      .fail(function () {
        console.log("error");
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
          url: "../_partials_messagerie/_envoi_message.php",
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
            console.log("error");
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
      url: "../_partials_admin/_update_user.php",
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
        console.log("error");
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
      url: "../_partials_admin/_delete_user.php",
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
        console.log("error");
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
      url: "../_partials_admin/_update_eve.php",
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
        console.log("error");
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
      url: "../_partials_admin/_delete_eve.php",
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
        console.log("error");
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
      url: "../_partials_admin/_delete_post.php",
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
        console.log("error");
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
    $(".mailW").focus(function (e) {
   
    });
    $.ajax({
      type: "POST",
      url: "../_partials_admin/_add_new_member.php",
      data: donnees,
      processData: false,
      contentType: false,
    })
      .done(function (response) {
        if (response == "existe") {
          $(".mailW").addClass("text-danger border-danger");
          zoneAlerte.html("<span class='text-center text-danger mt-5'> Cet addresse mail est associer a un autre compte </span>" );
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
        console.log("error");
      });
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

$('.generate').click(function (e) { 
  e.preventDefault();
  $(this).parent().children("input").val(generate()).attr("type", "text");
});

 /*  requete d'envoi de mail de aux memebre pour la confirmation de creation de compte*/
   //fonction d'envoi de mail
  function sendEmail(login, password, prenom,mail) {
    Email.send({
      Host: "smtp.gmail.com",
      Username: "greacomplus@gmail.com",
      Password: "greatcomplus@2021",
      To: ` ${mail}`,
      From: "greacomplus@gmail.com",
      Subject: "Confirmation de creation de compte GREATALUMNI",
      Body: ` Bonjour <b>${prenom}</b>, vous trouverez ci-dessous vos information de connexion  !!<br/>
    <span style="color:Indigo">Login:</span> ${login} <br/> 
    <span style="color:Indigo">Password: </span> ${password} <br/> <br/>
    Pour se Connecter cliquez sur: http://localhost/GreatAlumni_V3/ <br/>
    <h1 style="color:DarkGoldenRod"> Attention :</h1>
    Vous etes le seul destinataire de ce message, alors pour<span style="color:red"> la securierié de votre compte</span> 
    Veuillez à ne pas communiquez vos identifications de connexion à un tiers.
<br/>  <br/> 
   <b>Ce ci est un message automatique merci de ne pas repondre !!!</b>  <br/><br/> 
    Si vous avez de probleme de connexion veuillez contacter l'administrateur:
    <br/> <br/><strong>tel: 06 05 60 21 30</strong><br/><b>e-mail: admin@greatalumni.com</b>
    <br/> <br/> <br/>
   <span style=" font-size:80px; color:Navy; font-family: Georgia, serif; text-shadow: 1px 1px 2px yellow; margin-left:110px"> 
     GREATCOM+
  </span> 
  <br/><span style="color:white; background:black; font-size:15px; margin-left:190px; padding-top:10px; padding-bottom:10px">ENSITECH - ALUMNI - PLATEFORME </span>`,
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
              url: "./partials/_loginUser.php",
              data: {
                email: email,
                psw: psw,
              },
            })
              .done(function (response) {
             if(response==0){
               $(".infosErreur").html( "<br><span class='text-danger'> Login ou Mot de passe incorect</span>"  );
                $(".champsPsw").addClass("border border-danger text-danger");
                  $(".champsEmail").addClass("border border-danger text-danger");
            
             } else{
             
               $(".fa-spinner").removeClass("hideurClass");
               setTimeout(() => {
                  location.replace(
                    "http://localhost/GreatAlumni_V3/vue/actualite.php"
                  );
               }, 1500);


             }

               
              })
              .fail(function () {
                console.log("error");
              });

         
          }
        });

});
