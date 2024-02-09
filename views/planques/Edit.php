<h1 class="text-center">Modifications des données de la planque numéro <?= $params['planque']->planque_id ?></h1>

<form action="/ECF/Planques/Edit/<?= $params['planque']->planque_id ?>" class="w-50 m-auto"  method="POST">
    <div class="form-group">
        <label for="code">Code de la planque:</label>
        <input type="text" class="form-control" name="code" value=<?= $params['planque']->getCode()?>>
        <label for=""></label>
    </div>
    <div class="form-group">
        <label for="typeplanque_id">Type de planque:</label>
        <select name="typeplanque_id"  class="form-control">
            <?php foreach($params['typeplanques'] as $type) : ?>
                <option value="<?= $type->type_id ?>"
                <?= ($type->type_id === $params['planque']->getType()->type_id) ? 'selected' : ''; ?>
                ><?= $type->getNameType() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="pays_id">Pays:</label>
        <select name="pays_id" class="form-control">
            <?php foreach($params['pays'] as $pays) : ?>
                <option value=<?= $pays->pays_id ?>
                <?= ($pays->pays_id === $params['planque']->getPays()->pays_id)? 'selected' : '' ?>
                ><?= $pays->getName() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
