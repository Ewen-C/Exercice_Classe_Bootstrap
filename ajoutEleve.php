<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Élèves : Ajout</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>

  <script src="ajoutEleve.js" defer></script>
</head>

<body class="text-white bg-dark">

  <header class="container p-3 my-3 text-center border border-primary">
    <h1> Ajout d'un élève </h1>
    <h2> <u class="text-primary"> <a href="affichageEleves.php">Retour</a> </u> </h2>
  </header>

  <section class="container p-3 my-3 border border-primary">

    <?php

    try {
      $bdd = new PDO('mysql:host=localhost; dbname=gestion_classe; charset=utf8', 'root', '');
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

    ?>

    <h3 class="text-center"> Veuillez entrer les informations du nouvel élève : </h3>

    <div class="d-flex flex-row justify-content-center">
      <form class="col-md-6 m-3 p-3 border border-secondary">

        <div class="form-group row p-2">
          <label for="nom" class="col-4 col-form-label text-center"> Nom : </label>
          <input type="text" class="col-8 form-control rounded-0" name="nom" id="nom" maxlength="20" required>
        </div>

        <div class="form-group row p-2">
          <label for="prenom" class="col-4 col-form-label text-center"> Prenom : </label>
          <input type="text" class="col-8 form-control rounded-0" name="prenom" id="prenom" maxlength="20" required>
        </div>

        <div class="form-group row p-2">
          <label for="age" class="col-4 col-form-label text-center"> Âge : </label>
          <input type="number" class="col-8 form-control rounded-0" name="age" id="age" min="0" max="99" required>
        </div>

        <div class="form-group row p-2">
          <label for="genre" class="col-4 col-form-label text-center"> Genre : </label>
          <select class="col-8 form-control rounded-0" name="genre" id="genre" required>
            <option value="M"> M </option>
            <option value="F"> F </option>
          </select>
        </div>

        <div class="form-group row p-2">
          <label for="classe" class="col-4 col-form-label text-center"> Classe : </label>
          <select class="col-8 form-control rounded-0" name="classe" id="classe" required>

            <?php
            $reponse = $bdd->query('SELECT * FROM `classe`');
            while ($donnees = $reponse->fetch()) {
              echo ('<option> ' . $donnees['nom_classe'] . ' </option>');
            }
            ?>

          </select>
        </div>

        <div class="form-group row p-2">
          <label for="adresse" class="col-4 col-form-label text-center"> Adresse : </label>
          <input type="text" class="col-8 form-control rounded-0" name="adresse" id="adresse" maxlength="50" required>
        </div>

        <div class="text-center">
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