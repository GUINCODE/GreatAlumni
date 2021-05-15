window.addEventListener("load", function () {
  function notif_sms() {
    var xhttp = new XMLHttpRequest();
    var notifContent = document.getElementById("notif_sms").textContent;
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          document.getElementById("notif_sms").style.display = "none";
        } else {
          document.getElementById("notif_sms").style.display = "flex";
        }
        if (notifContent !== this.responseText) {
          document.getElementById("notif_sms").innerHTML = this.responseText;
        }
      }
    };
    xhttp.open("POST", "./_partials_actualite/_fetch_msg_notif.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id_user=1");
  }
  function notif_evenement() {
    var xhttp = new XMLHttpRequest();
    var notifContent = document.getElementById("notif_eve").textContent;

    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          document.getElementById("notif_eve").style.display = "none";
        } else {
          document.getElementById("notif_eve").style.display = "flex";
        }
        if (notifContent !== this.responseText) {
          document.getElementById("notif_eve").innerHTML = this.responseText;
        }
      }
    };
    xhttp.open("POST", "./_partials_actualite/_fetch_eve_notif.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(" id_user=1");
  }
  function notif_autre() {
    var xhttp = new XMLHttpRequest();
    var notifContent = document.getElementById("notif_autre").textContent;

    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          document.getElementById("notif_autre").style.display = "none";
        } else {
          document.getElementById("notif_autre").style.display = "flex";
        }
        if (notifContent !== this.responseText) {
          document.getElementById("notif_autre").innerHTML = this.responseText;
        }
      }
    };
    xhttp.open("POST", "./_partials_actualite/_fetch_autre_notif.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(" id_user=1");
  }

  setInterval(function () {
    notif_sms();
    notif_evenement();
    notif_autre();
  }, 1000);
  // var btnCommentaire = document.getElementById("btn_edit_comment");
  // btnCommentaire.addEventListener("click", function () {
  // var boiteCommentaire = document.getElementById("bloc_Parent_commentaire");
  // boiteCommentaire.classList.toggle("hideurClass");
  // });
  var x, i;
  x = document.querySelectorAll(".btn_edit_comment");
  var element = document.querySelectorAll(".bloc_Parent_commentaire");

  for (i = 0; i < x.length; i++) {
    x[i].addEventListener("click", function () {
      var j;
      for (j = 0; j < element.length; j++) {
        element[j].classList.toggle("hideurClass");
        console.log("addclass");
      }
    });
  }
});
