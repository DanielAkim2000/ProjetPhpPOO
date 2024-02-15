<h1 class="text-center"><?= (isset($params['typeplanque']))? "Modifications des données du type de planque numéro {$params['typeplanque']->getId()}" : "Création d'un nouveau type de planque" ?></h1>

<form class="w-75 m-auto" action="<?= (isset($params['typeplanque']))? "/ECF/Typeplanques/Edit/{$params['typeplanque']->getId()}" : "/ECF/Typeplanques/Create" ?>" method="post">
    <div class="form-group mb-2">
        <label class="form-label" for="description">Type de planque</label>
        <input type="text" name="description" class="form-control" value="<?= (isset($params['typeplanque']))? "{$params['typeplanque']->getNameType()}" : "" ?>">
    </div>
    <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
</form>