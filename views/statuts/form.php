<h1 class="text-center mb-4"><?= (isset($params['statut']))? "Modifications des données du statut numéro {$params['statut']->getId()}" : "Créer un nouveau statut" ?></h1>

<form id="formulaire" class="w-25 m-auto" action="<?= (isset($params['statut']))? "/ECF/Statuts/Edit/{$params['statut']->getId()}/{$_SESSION['token']}" : "/ECF/Statuts/Create/{$_SESSION['token']}" ?>" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="statut">Nom du statut:</label>
        <input type="text" name="statut" class="form-control" value="<?= (isset($params['statut']))? "{$params['statut']->getNameStatut()}" : "" ?>">
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['statut'])) : ?>
                <?php foreach($_SESSION['errors']['statut'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
</form>