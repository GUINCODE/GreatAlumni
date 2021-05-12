$(document).ready(function () {
  // $("#mainNav  li:has(ul)").hover(function () {
  //   $("ul", this).stop(true, true).slideToggle();
  // });

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
});
