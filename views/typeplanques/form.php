<h1 class="text-center mb-4"><?= (isset($params['typeplanque']))? "Modifications des données du type de planque numéro {$params['typeplanque']->getId()}" : "Création d'un nouveau type de planque" ?></h1>

<form id="formulaire" class="w-style m-auto" action="<?= (isset($params['typeplanque']))? "/ECF/Typeplanques/Edit/{$params['typeplanque']->getId()}/{$_SESSION['token']}" : "/ECF/Typeplanques/Create/{$_SESSION['token']}" ?>" method="post">
    <div class="form-group mb-2">
        <label class="form-label" for="description">Type de planque:</label>
        <input type="text" name="description" class="form-control" value="<?= (isset($params['typeplanque']))? "{$params['typeplanque']->getNameType()}" : "" ?>">
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['description'])) : ?>
                <?php foreach($_SESSION['errors']['description'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
</form>