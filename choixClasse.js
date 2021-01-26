// Ajax GET en jQuery :

$(document).ready(function () {
  $("#choixClasse").change(function (e) {

    let classe = $("#choixClasse").val().split(" ").shift() // '6ème (_ élèves)'  ->  '6ème'
    $('#selectedClass').html(classe);
    // alert("Classe changée -> '" + classe + "'"); 

    $.ajax({
      url: 'choixClasseBDD.php',
      method: 'GET',
      data: "classe=" + classe,
      dataType: 'html',

      success: function (echo, statut) {
        $('#divEleves').html(echo);
      }
    });

  });
});