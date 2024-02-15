<h1 class="text-center"><?php echo isset($params['cible'])?'Modifications des données de la cible numéro '.$params['cible']->getId() : 'Créer une nouvelle cible'; ?></h1>

<form action="<?= isset($params['cible'])? "/ECF/Cibles/Edit/{$params['cible']->getId()}" : "/ECF/Cibles/Create" ?>" class="w-50 m-auto" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="codename">Nom de code:</label>
        <input name="codename" type="text" class="form-control" value="<?= isset($params['cible'])? $params['cible']->getCodeName() : ''?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="firstname">Prénom:</label>
        <input name="firstname" type="text" class="form-control" value="<?= isset($params['cible'])? $params['cible']->getHumain()->getFirstname(): '' ?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="lastname">Nom:</label>
        <input name="lastname" type="text" class="form-control" value="<?= isset($params['cible'])? $params['cible']->getHumain()->getLastname(): ''?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="nationality_id">Nationnalité:</label>
        <select name="nationality_id" class="form-select">
                <?php foreach($params['pays'] as $pays) : ?>
                    <option value=<?= $pays->pays_id ?>
                    <?php if(isset($params['cible'])) : ?>
                        <?= ($pays->pays_id === $params['cible']->getNationality()->pays_id)? 'selected' : '' ?>
                    <?php endif ?>
                    ><?= $pays->getName() ?></option>
                <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="birthday">Date de naissance:</label>
        <input name="birthday" type="date" class="form-control" value=<?= isset($params['cible'])? $params['cible']->getHumainKgbInfo()->getBirthday() : ''?>>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>