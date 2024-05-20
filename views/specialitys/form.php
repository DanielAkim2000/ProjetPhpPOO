<h1 class="text-center mb-4"><?php echo isset($params['speciality'])?'Modifications des données de la spécialité numéro '.$params['speciality']->getId() : 'Créer une nouvelle spécialité'; ?></h1>

<form id="formulaire" class="w-style m-auto" action="<?= (isset($params['speciality']))? "/ECF/Specialitys/Edit/{$params['speciality']->getId()}/{$_SESSION['token']}" : "/ECF/Specialitys/Create/{$_SESSION['token']}" ?>" method="post">
    <div class="form-group mb-2">
        <label class="form-label" for="nameofspeciality">Nom de la spécialité:</label>
        <input type="text" class="form-control" name="nameofspeciality" value="<?= (isset($params['speciality']))? $params['speciality']->getNameOfSpeciality() : "" ?>">
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['nameofspeciality'])) : ?>
                <?php foreach($_SESSION['errors']['nameofspeciality'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>
