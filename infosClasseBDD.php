<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  echo ("<h3 class='text-center'> Informations de la classe : </h3> ");

  // Affichage du formulaire pré-rempli
  
  echo('
    <div class="d-flex flex-row justify-content-center">
      <form id="formModif" class="col-md-6 m-3 p-3 border border-secondary">

        <div class="form-group row p-2">
          <label for="nom_classe" class="col-4 col-form-label text-center"> Nouveau nom : </label>
          <input type="text" class="col-8 form-control rounded-0" name="nom_classe" id="nom_classe" maxlength="10" value="' . $_GET['classe'] .'" required>
        </div>


        <div class="col-10-sm d-flex flex-row justify-content-around">
          <button type="submit" onclick="javascript:sendInfosClasse(event)"
          class="btn btn-dark btn-outline-info text-light rounded-0 mx-3"> Modifier </button>
        </div>
      </form>
    </div>');

?>