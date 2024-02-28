<!-- Detruire la session au rechargement de la page -->
<?php session_destroy(); ?>
<!-- -->
<form action="/ECF/Login" class="w-style m-auto mt-4 border bg-white p-4 shadow rounded"  method="POST">
  <div class="w-75 m-auto">
    <img src="<?= SCRIPTS . 'assets'. DIRECTORY_SEPARATOR . 'kgblogo.jpeg'?>" class="w-100">
  </div>
  <div class="form-group mb-2">
    <label class="form-label" for="email">Adresse mail:</label>
    <input type="email" name="email" class="form-control" placeholder="Email">
    <?php if(isset($_SESSION['errors'])): ?>
      <?php if(isset($_SESSION['errors']['email'])) : ?>
        <?php foreach($_SESSION['errors']['email'] as $errors) : ?>
          <div class="text-danger">
            .<?= $errors ?>
          </div>
        <?php endforeach ?>
      <?php endif ?>
    <?php endif ?>
  </div>
  <div class="form-group mb-2">
    <label class="form-label" for="password">Mot de passe:</label>
    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
    <div class="invalid-feedback">
      <?= $_SESSION['errors']['password'] ?>
    </div>
    <?php if(isset($_SESSION['errors'])): ?>
      <?php if(isset($_SESSION['errors']['password'])) : ?>
        <?php foreach($_SESSION['errors']['password'] as $errors) : ?>
          <div class="text-danger">
            .<?= $errors ?>
          </div>
        <?php endforeach ?>
      <?php endif ?>
    <?php endif ?>
  </div>
  <button type="submit" class="btn btn-primary mt-2">Connexion</button>
</form>