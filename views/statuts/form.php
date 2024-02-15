<h1 class="text-center"><?= (isset($params['statut']))? "Modifications des données du statut numéro {$params['statut']->getId()}" : "Créer un nouveau statut" ?></h1>

<form class="w-75 m-auto" action="<?= (isset($params['statut']))? "/ECF/Statuts/Edit/{$params['statut']->getId()}" : "/ECF/Statuts/Create" ?>" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="statut">Nom du statut</label>
        <input type="text" name="statut" class="form-control" value="<?= (isset($params['statut']))? "{$params['statut']->getNameStatut()}" : "" ?>">
    </div>
    <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
</form>