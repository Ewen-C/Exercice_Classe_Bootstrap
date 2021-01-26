// Ajax POST en jQuery :

$(document).ready(function () {
  $("form").submit(function (e) {
    e.preventDefault();
    var infosForm = $(this).serialize();

    if ($("#nom_classe").val().replaceAll(' ', '') != "") {

      $.ajax({
        url: 'ajoutClasseBDD.php',
        method: 'POST',
        data: infosForm,
        dataType: 'html',

        success: function (echo, statut) {
          let strModal = "<p> " + echo + " </p>";
          $('#modal-body').html(strModal);
          $('#modalData').modal('show');
          
          $("form").trigger("reset");
        },
      });

    } else {
      let strModal = "<p> Les champs ne sont pas tous remplis. </p>";
      $('#modal-body').html(strModal);
      $('#modalData').modal('show');
    }
  });
});