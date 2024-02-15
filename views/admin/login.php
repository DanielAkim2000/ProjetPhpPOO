<!-- Afficher les erreurs -->
<?php if(isset($_SESSION['errors'])) : ?>
    <?php foreach($_SESSION['errors'] as $errorsArray) : ?>
      <?php foreach($errorsArray as $errors) : ?>
        <div class="alert alert-danger w-25 mt-2 mr-auto ml-auto">
          <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    <?php endforeach ?>    
<?php endif ?>

<!-- Detruire la session au rechargement de la page -->
<?php session_destroy(); ?>

<form action="/ECF/Login" class="w-25 m-auto"  method="POST">
  <div class="form-group">
    <label for="email">Adresse mail:</label>
    <input type="email" name="email" class="form-control" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="password">Mot de passe:</label>
    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>