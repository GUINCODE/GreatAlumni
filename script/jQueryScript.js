$(document).ready(function () {
  function loadSMS() {
    $.ajax({
      type: "POST",
      url: "./_partials_actualite/_load_msg.php",
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
      url: "./_partials_actualite/_load_evenement.php",
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
      url: "./_partials_actualite/_load_autre.php",
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
      url: "./_partials_actualite/_unLike.php",
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
      url: "./_partials_actualite/_like.php",
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
        url: "./_partials_actualite/_enreg_commentaire.php",
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
      url: "./_partials_actualite/_creer_post.php",
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
      url: "./_partials_actualite/_creer_evenement.php",
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
      url: "./_partials_actualite/_creer_feedback.php",
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
      url: "./_partials_actualite/_fetch_commentaire.php",
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
      url: "./_partials_messagerie/_update_statut_sms.php",
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
  });
  // event click sur un utlisateur X
  $(".autherUser").click(function (e) {
    $(this).removeClass("textBol");
    let user_dest = $(this).find(".id_autre_user").val();
    let userLog = $(this).find(".identifant_userConnecter").val();
    let profil = $(this).find("img").attr("src");
    let infos_user_select = $(this).find(".name_user").text();
  // affiche le boutton actualiser
  $(".refresh_message").removeClass('hideurClass')
    rempli_zone_echange(user_dest, infos_user_select, profil);
    
    load_discussion(userLog, user_dest);
     $(".list_users_All").toggleClass("hideurClass");
     $(".fa-eye-slash").toggleClass("hideurClass");
     $(".fa-eye").toggleClass("hideurClass");
     $(".masquer").toggleClass("hideurClass");
     $(".afficher").toggleClass("hideurClass");
    
  });
//raffraichir le fil de discussion
$(".refresh_message").click(function (e) {
let id_user_select = $(".id_user_select").val();
let userLogin = $(".user_log_identifiant").val();
load_discussion(userLogin, id_user_select);
$('.refres_txt').toggleClass('hideurClass');
$(this).toggleClass('hideurClass');

setTimeout(() => {
$(".refres_txt").toggleClass("hideurClass");
$(this).toggleClass("hideurClass");
}, 7000);




});
  // methode pour remplir la zone d'echange

  function rempli_zone_echange(user_dest, infos_user_select, profil) {
    //  console.log("id user connecte:  " + userLog);
    //  console.log("id user dsetinateur:  " + user_dest);
    //  console.log("infos user:  " + infos_user_select);
    //  console.log("Profil user:  " + profil);

    ///on rempli le to: User infos
    $(".id_user_select").val(user_dest);
    $(".infos_user_select").text(infos_user_select);
    $(".profil_user_select").attr("src", profil);
  }

  function load_discussion(id_connecter, id_interLocutaire) {
    let fil_sms_echange = $(".fil_sms_echange");
    $.ajax({
      type: "POST",
      url: "./_partials_messagerie/_fetch_discussion.php",
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
      alert("aucun destinataire selectionner");
    } else {
      if (
        !valeurSaisi ||
        valeurSaisi == " " ||
        valeurSaisi == "  " ||
        valeurSaisi == "   " ||
        valeurSaisi == "    " ||
        valeurSaisi == "     " ||
        valeurSaisi == "      "||
        valeurSaisi == "       "||
        valeurSaisi == "        "||
        valeurSaisi == "         "||
        valeurSaisi == "          "||
        valeurSaisi == "           "||
        valeurSaisi == "           "
      ) {
        alert("message vide");
      } else {
        //  console.log("message: " + valeurSaisi);
        //  console.log("id_expeditaire: " + id_userConnecter);
        //  console.log("id_destinataire: " + id_destinataire);
        $(".debutConversassion").addClass("hideurClass");
        $(".fil_sms_echange").append(
          '<li class="bg-success  sms_envoyer ml-auto mr-1 p-2 mt-4 rounded text-wrap ">' +
            valeurSaisi +
            "</a></li>"
        );

        $(".message_rep").val("");
        //requete d'insertion de message
        $.ajax({
          type: "POST",
          url: "./_partials_messagerie/_envoi_message.php",
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
  });

 
});
