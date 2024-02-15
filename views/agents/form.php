<h1 class="text-center"><?php echo isset($params['agent'])?'Modifications des données de l\'agent numéro '.$params['agent']->getId() : 'Créer un nouvel agent'; ?></h1>

<form action="<?= isset($params['agent'])? "/ECF/Agents/Edit/{$params['agent']->getId()}" : "/ECF/Agents/Create" ?>" class="w-50 m-auto" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="codeofidentification">Code:</label>
        <input name="codeofidentification" type="text" class="form-control" value=<?= isset($params['agent'])? $params['agent']->getCode(): '' ?>>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="firstname">Prénom:</label>
        <input name="firstname" type="text" class="form-control" value="<?= isset($params['agent'])? $params['agent']->getHumain()->getFirstname(): '' ?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="lastname">Nom:</label>
        <input name="lastname" type="text" class="form-control" value="<?= isset($params['agent'])? $params['agent']->getHumain()->getLastname(): ''?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="nationality_id">Nationnalité:</label>
        <select name="nationality_id" class="form-select">
                <?php foreach($params['pays'] as $pays) : ?>
                    <option value=<?= $pays->pays_id ?>
                    <?php if(isset($params['agent'])) : ?>
                        <?= ($pays->pays_id === $params['agent']->getNationality()->pays_id)? 'selected' : '' ?>
                    <?php endif ?>
                    ><?= $pays->getName() ?></option>
                <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="birthday">Date de naissance:</label>
        <input name="birthday" type="date" class="form-control" value=<?= isset($params['agent'])? $params['agent']->getHumainKgbInfo()->getBirthday() : ''?>>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="speciality_id">Spécialités:</label>
        <select multiple name="speciality_id[]" class="form-select">
            <?php foreach($params['specialitys'] as $specialities) : ?>
                <option value="<?= $specialities->speciality_id ?>"
                <?php if(isset($params['agent'])) : ?>
                <?php foreach($params['agent']->getSpeciality() as $specialitys)
                    {
                        echo (($specialitys->speciality_id === $specialities->speciality_id )? 'selected' : '');
                    } 
                ?>
                <?php endif ?>
                >
                <?= $specialities->getNameOfSpeciality() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="mission_id">Missions:</label>
        <select multiple name="mission_id[]"  class="form-select">
            <?php foreach($params['missions'] as $mission) : ?>
                <option value="<?= $mission->mission_id ?>"
                <?php if(isset($params['agent'])) : ?>
                <?php foreach($params['agent']->getMissions() as $miss)
                    {
                        echo (($miss->mission_id === $mission->mission_id)? 'selected' : '');
                    }
                ?>
                <?php endif ?>
                >
                <?= $mission->getTitre() ?></option>
                <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>