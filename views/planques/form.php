<h1 class="text-center mb-4"><?php echo isset($params['planque'])?'Modifications des données de la planque numéro '.$params['planque']->getId() : 'Créer une nouvel planque'; ?></h1>

<form id="formulaire" action="<?= isset($params['planque'])? "/ECF/Planques/Edit/{$params['planque']->getId()}/{$_SESSION['token']}" : "/ECF/Planques/Create/{$_SESSION['token']}" ?>" class="w-style m-auto" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="code">Code de la planque:</label>
        <input type="text" class="form-control" name="code" value=<?= isset($params['planque'])? $params['planque']->getCode() : '' ?>>
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="typeplanque_id">Type de planque:</label>
        <select name="typeplanque_id"  class="form-select">
            <?php foreach($params['typeplanques'] as $type) : ?>
                <option value="<?= $type->type_id ?>"
                <?php if(isset($params['planque'])) : ?>
                    <?= ($type->type_id === $params['planque']->getType()->type_id) ? 'selected' : ''; ?>
                <?php endif ?>
                ><?= $type->getNameType() ?></option>
            <?php endforeach ?>
        </select>
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['typeplanque_id'])) : ?>
                <?php foreach($_SESSION['errors']['typeplanque_id'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="pays_id">Pays:</label>
        <select name="pays_id" class="form-select">
            <?php foreach($params['pays'] as $pays) : ?>
                <option value=<?= $pays->pays_id ?>
                <?php if(isset($params['planque'])) : ?>
                    <?= ($pays->pays_id === $params['planque']->getPays()->pays_id)? 'selected' : '' ?>
                <?php endif ?>
                ><?= $pays->getName() ?></option>
            <?php endforeach ?>
        </select>
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['pays_id'])) : ?>
                <?php foreach($_SESSION['errors']['pays_id'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>