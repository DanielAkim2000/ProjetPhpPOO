<h1 class="text-center"><?= (isset($params['typemission']))? "Modifications des données du type de mission numéro {$params['typemission']->getId()}" : "Création d'un nouveau type de mission" ?></h1>

<form class="w-75 m-auto" action="<?= (isset($params['typemission']))? "/ECF/Typemissions/Edit/{$params['typemission']->getId()}" : "/ECF/Typemissions/Create" ?>" method="post">
    <div class="form-group mb-2">
        <label class="form-label" for="description">Type de mission</label>
        <input type="text" name="description" class="form-control" value="<?= (isset($params['typemission']))? "{$params['typemission']->getNameType()}" : "" ?>">
    </div>
    <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
</form>