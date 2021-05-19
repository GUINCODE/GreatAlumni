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
        console.log("liked");
        console.log("id user: " + identifiant_user);
        console.log("id article: " + identifiant_article);
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
        .children(".commentaires");

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
});
