function AjaxSendData(fichier, data) {
  var xmlhttp;

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("TabDataBody").innerHTML = xmlhttp.responseText;
    }
  };

  xmlhttp.open("POST", fichier, true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send(data);
}

function Save() {
  var IdAG = document.getElementById("IdAG").value;
  var designation = document.getElementById("Designation").value;
  var DateReportAG = document.getElementById("DateReportAG").value;

  var fichier = "GestionAGAjaxSet.asp";
  var data =
    "IdAG=" +
    IdAG +
    "&designation=" +
    designation +
    "&DateReportAG=" +
    DateReportAG;
  data = encodeURI(data);
  AjaxSendData(fichier, data);
}

function remplirPageVoitures() {
  var xmlhttp;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("row_cars").innerHTML = xmlhttp.responseText;
    }
  };
  var marque = document.getElementById("filter_marque").value;
  var prix = document.getElementById("filter_prix").value;
  var couleur = document.getElementById("filter_couleur").value;

  var cible0 =
    "getVoitures.php?marque=" +
    marque +
    "&prix=" +
    prix +
    "&couleur=" +
    couleur;
  xmlhttp.open("GET", cible0, true);
  xmlhttp.send();
}
