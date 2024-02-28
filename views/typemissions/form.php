<h1 class="text-center mb-4"><?= (isset($params['typemission']))? "Modifications des données du type de mission numéro {$params['typemission']->getId()}" : "Création d'un nouveau type de mission" ?></h1>

<form id="formulaire" class="w-25 m-auto" action="<?= (isset($params['typemission']))? "/ECF/Typemissions/Edit/{$params['typemission']->getId()}/{$_SESSION['token']}" : "/ECF/Typemissions/Create/{$_SESSION['token']}" ?>" method="post">
    <div class="form-group mb-2">
        <label class="form-label" for="description">Type de mission:</label>
        <input type="text" name="description" class="form-control" value="<?= (isset($params['typemission']))? "{$params['typemission']->getNameType()}" : "" ?>">
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