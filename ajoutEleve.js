// Ajax POST en jQuery :

$(document).ready(function () {
  $("form").submit(function (e) {
    e.preventDefault();
    var infosForm = $(this).serialize();

    if ( $("#nom").val().replaceAll(' ', '') != "" && $("#prenom").val().replaceAll(' ', '') != "" && 
      $("#age").val().replaceAll(' ', '') != "" && $("#genre").val().replaceAll(' ', '') != "" && 
      $("#classe").val().replaceAll(' ', '') != "" && $("#adresse").val().replaceAll(' ', '') != "" ) {

      console.log(infosForm);

      $.ajax({
        url: 'ajoutEleveBDD.php',
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