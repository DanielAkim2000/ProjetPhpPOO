<h1 class="text-center mb-4"><?php echo isset($params['cible'])?'Modifications des données de la cible numéro '.$params['cible']->getId() : 'Créer une nouvelle cible'; ?></h1>

<form id="formulaire" action="<?= isset($params['cible'])? "/ECF/Cibles/Edit/{$params['cible']->getId()}/{$_SESSION['token']}" : "/ECF/Cibles/Create/{$_SESSION['token']}" ?>" class="w-25 m-auto" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="codename">Nom de code:</label>
        <input name="codename" type="text" class="form-control" value="<?= isset($params['cible'])? $params['cible']->getCodeName() : ''?>">
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['codename'])) : ?>
                <?php foreach($_SESSION['errors']['codename'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="firstname">Prénom:</label>
        <input name="firstname" type="text" class="form-control" value="<?= isset($params['cible'])? $params['cible']->getHumain()->getFirstname(): '' ?>">
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['firstname'])) : ?>
                <?php foreach($_SESSION['errors']['firstname'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="lastname">Nom:</label>
        <input name="lastname" type="text" class="form-control" value="<?= isset($params['cible'])? $params['cible']->getHumain()->getLastname(): ''?>">
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['lastname'])) : ?>
                <?php foreach($_SESSION['errors']['lastname'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
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
        <?php if(isset($_SESSION['errors'])): ?>
            <?php if(isset($_SESSION['errors']['nationality_id'])) : ?>
                <?php foreach($_SESSION['errors']['nationality_id'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="birthday">Date de naissance:</label>
        <input name="birthday" type="date" class="form-control" value=<?= isset($params['cible'])? $params['cible']->getHumainKgbInfo()->getBirthday() : ''?>>
        <?php if(isset($_SESSION['birthday'])): ?>
            <?php if(isset($_SESSION['errors']['birthday'])) : ?>
                <?php foreach($_SESSION['errors']['birthday'] as $errors) : ?>
                <div class="text-danger">
                    .<?= $errors ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>