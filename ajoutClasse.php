<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Classes : Ajout</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>
  
  <script src="ajoutClasse.js" defer></script>
</head>

<body class="text-white bg-dark">

  <header class="container p-3 my-3 text-center border border-primary">
    <h1> Ajout d'une classe </h1>
    <h2> <u class="text-primary"> <a href="affichageClasses.php">Retour</a> </u> </h2>
  </header>

  <section class="container p-3 my-3 border border-primary">

    <?php

    try {
      $bdd = new PDO('mysql:host=localhost; dbname=gestion_classe; charset=utf8', 'root', '');
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

    ?>

    <h3 class="text-center"> Veuillez entrer les informations de la nouvelle classe : </h3>

    <div class="d-flex flex-row justify-content-center">
      <form class="col-md-6 m-3 p-3 border border-secondary">

        <div class="form-group row p-2">
          <label for="nom_classe" class="col-3 col-form-label text-center"> Nom : </label>
          <input type="text" class="col-9 form-control rounded-0" name="nom_classe" id="nom_classe" maxlength="10" required>
        </div>


        <div class="text-center">
          <p> Le nombre d'élèves s'initialise à 0 </p>
          <button type="submit" class="btn btn-dark btn-outline-info text-light rounded-0"> Envoyer </button>
        </div>

      </form>
    </div>

  </section>

  <footer class="container p-3 my-3 text-center border border-primary">
    <p> Pages conçues par Ewen Celibert </p>
    <p> Exercice de développement donné par VLIS </p>
  </footer>

  <div class="modal fade text-dark" id="modalData">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body" id="modal-body"> </div>

        <div class="modal-footer d-flex justify-content-around">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="modalCancel">Ok !</button>
        </div>

      </div>
    </div>
  </div>

</body>

</html>