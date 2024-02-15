<h1 class="text-center"><?php echo isset($params['contact'])?'Modifications des données du contact numéro '.$params['contact']->getId() : 'Créer un nouveau contact'; ?></h1>

<form action="<?= isset($params['contact'])? "/ECF/Contacts/Edit/{$params['contact']->getId()}" : "/ECF/Contacts/Create" ?>" class="w-50 m-auto" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="codename">Nom de code:</label>
        <input name="codename" type="text" class="form-control" value="<?= isset($params['contact'])? $params['contact']->getCodeName() : ''?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="firstname">Prénom:</label>
        <input name="firstname" type="text" class="form-control" value="<?= isset($params['contact'])? $params['contact']->getHumain()->getFirstname(): '' ?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="lastname">Nom:</label>
        <input name="lastname" type="text" class="form-control" value="<?= isset($params['contact'])? $params['contact']->getHumain()->getLastname(): ''?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="nationality_id">Nationnalité:</label>
        <select name="nationality_id" class="form-control">
                <?php foreach($params['pays'] as $pays) : ?>
                    <option value=<?= $pays->getId() ?>
                    <?php if(isset($params['contact'])) : ?>
                        <?= ($pays->pays_id === $params['contact']->getNationality()->getId())? 'selected' : '' ?>
                    <?php endif ?>
                    ><?= $pays->getName() ?></option>
                <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="birthday">Date de naissance:</label>
        <input name="birthday" type="date" class="form-control" value=<?= isset($params['contact'])? $params['contact']->getHumainKgbInfo()->getBirthday() : ''?>>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>