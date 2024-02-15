<h1 class="text-center"><?php echo isset($params['speciality'])?'Modifications des données de la spécialité numéro '.$params['speciality']->getId() : 'Créer une nouvelle spécialité'; ?></h1>

<form class="w-75 m-auto" action="<?= (isset($params['speciality']))? "/ECF/Specialitys/Edit/{$params['speciality']->getId()}" : "/ECF/Specialitys/Create" ?>" method="post">
    <div class="form-group mb-2">
        <label class="form-label" for="nameofspeciality">Nom de la spécialité</label>
        <input type="text" class="form-control" name="nameofspeciality" value="<?= (isset($params['speciality']))? $params['speciality']->getNameOfSpeciality() : "" ?>">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>
