$(document).ready(function () {

  $("#choixEleve").change(function () {

    if ($('#choixEleve').val() == "-- Choisir un élève --") {
      $('#divModif').html('');
    } else {
      let eleve = $("#choixEleve").val().split(" "); // 'Celibert Ewen (6ème)' -> [Celibert] [Ewen] [(6ème)]

      let nom = eleve[0]; // 'Celibert'
      let prenom = eleve[1]; // 'Ewen'
      let classe = eleve[2].replace('(', '').replace(')', ''); // '(6ème)' -> '6ème'

      $.ajax({
        url: 'infosEleveBDD.php',
        method: 'GET',
        data: "nom=" + nom + "&prenom=" + prenom + "&classe=" + classe,
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

function sendInfosEleve(e) {

  e.preventDefault();
  let infosForm = $('#formModif').serialize();

  if ($("#nom").val().replaceAll(' ', '') != "" && $("#prenom").val().replaceAll(' ', '') != "" && 
    $("#age").val().replaceAll(' ', '') != "" && $("#genre").val().replaceAll(' ', '') != "" && 
    $("#choixClasse").val().replaceAll(' ', '') != "" && $("#adresse").val().replaceAll(' ', '') != "") {

    let eleve = $("#choixEleve").val().split(" "); // 'Celibert Ewen (6ème)' -> [Celibert] [Ewen] [(6ème)]
    infosForm += "&nomDebut=" + eleve[0] + "&prenomDebut=" + eleve[1] + "&classeDebut=" + eleve[2].replace('(', '').replace(')', '');

    $.ajax({
      url: 'modifEleveBDD.php',
      method: 'POST',
      data: infosForm,
      dataType: 'html',

      success: function (echo, statut) {
        let strModal = "<p> " + echo + "</p>";
        $('#modal-body').html(strModal);

        let modalFooter = '<button type="button" class="btn btn-primary" data-dismiss="modal">Ok !</button>';
        $('#modal-footer').html(modalFooter);

        $('#modalData').modal('show');

        $('#modalData').on('hide.bs.modal', function () {
          $("#choixEleve").prop('selectedIndex',0);
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


function supprimerEleve(e) {

  e.preventDefault();

  let strModal = "Voulez-vous confirmer le retrait de cet élève ?";
  $('#modal-body').html(strModal);

  let modalFooter = '<button type="button" class="btn btn-danger" data-dismiss="modal" id="modalCancel">Annuler</button>';
  modalFooter += '<button type="button" class="btn btn-success" id="modalValid">Confirmer</button>' // Bouton sans 'data-dismiss'
  $('#modal-footer').html(modalFooter);

  $('#modalData').modal('show');
  // Le premier message doit avoir "backdrop: 'static'" pour que le deuxième l'ait aussi

  $('#modalValid').click(function () {

    // Le formulaire n'est pas nécessaire
    let eleve = $("#choixEleve").val().split(" "); // 'Celibert Ewen (6ème)' -> [Celibert] [Ewen] [(6ème)]
    let infosForm = "nom=" + eleve[0] + "&prenom=" + eleve[1] + "&classe=" + eleve[2].replace('(', '').replace(')', '');

    $.ajax({
      url: 'supprimerEleveBDD.php',
      method: 'POST',
      data: infosForm,
      dataType: 'html',

      success: function (echo, statut) {
        $('#modalData').modal('hide'); 
        $('#modalData').on('hidden.bs.modal', function () { // Attend que l'animation se termine avant d'afficher le deuxième message

          let strModal = "<p> " + echo + " </p>";
          $('#modal-body').html(strModal);

          let modalFooter = '<button type="button" class="btn btn-primary" data-dismiss="modal" id="modalOk">Ok !</button>';
          $('#modal-footer').html(modalFooter);

          $('#modalData').modal('show');

          $('#modalData').on('hide.bs.modal', function () { // Dès que l'utilisateur quitte, avant la fin de l'animation
            $('#modalData').prop('id', ''); // Enlève l'ID pour que le message ne soit pas montré plusieurs fois
            $("#choixEleve").prop('selectedIndex',0);
            location.reload();
          });

        });

      },
    });

  });

}