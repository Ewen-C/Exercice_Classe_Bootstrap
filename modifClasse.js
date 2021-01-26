$(document).ready(function () {

  $("#choixClasse").change(function () {

    if ($('#choixClasse').val() == "-- Choisir une classe --") {
      $('#divModif').html('');
    } else {
      let classe = $("#choixClasse").val();

      $.ajax({
        url: 'infosClasseBDD.php',
        method: 'GET',
        data: "classe=" + classe,
        dataType: 'html',

        success: function (echo, statut) {
          $('#divModif').html(echo);
        }

      });
    }

  });
});


// Fonction séparée car le formulaire se charge avec le code PHP et pas au chargement de la page
// Donc le formulaire ne peut pas recevoir l'évènement au moment de $(document).ready()
// Le formulaire est ciblé avec '#formModif', 'this' ne fonctionne pas

function sendInfosClasse(e) {
  e.preventDefault();
  var infosForm = $('#formModif').serialize();

  if ($("#nom_classe").val().replaceAll(' ', '') != "") {

    infosForm += "&nom_classe_Debut=" + $("#choixClasse").val();

    $.ajax({
      url: 'modifClasseBDD.php',
      method: 'POST',
      data: infosForm,
      dataType: 'html',

      success: function (echo, statut) {
        let strModal = "<p> " + echo + " </p>";
        $('#modal-body').html(strModal);

        let modalFooter = '<button type="button" class="btn btn-primary" data-dismiss="modal">Ok !</button>';
        $('#modal-footer').html(modalFooter);

        $('#modalData').modal('show');

        $('#modalData').on('hide.bs.modal', function () {
          $("#choixClasse").prop('selectedIndex',0);
          location.reload();
        });
        
      },
    });

  } else {
    let strModal = "Les champs ne sont tous pas remplis.";
    $('#modal-body').html(strModal);

    let modalFooter = '<button type="button" class="btn btn-primary" data-dismiss="modal">Ok !</button>';
    $('#modal-footer').html(modalFooter);

    $('#modalData').modal('show');
  }
};