<h1 class="text-center mb-4"><?php echo isset($params['contact'])?'Modifications des données du contact numéro '.$params['contact']->getId() : 'Créer un nouveau contact'; ?></h1>

<form id="formulaire" action="<?= isset($params['contact'])? "/ECF/Contacts/Edit/{$params['contact']->getId()}/{$_SESSION['token']}" : "/ECF/Contacts/Create/{$_SESSION['token']}" ?>" class="w-style m-auto" method="POST">
    <div class="form-group mb-2">
        <label class="form-label" for="codename">Nom de code:</label>
        <input name="codename" type="text" class="form-control" value="<?= isset($params['contact'])? $params['contact']->getCodeName() : ''?>">
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
        <input name="firstname" type="text" class="form-control" value="<?= isset($params['contact'])? $params['contact']->getHumain()->getFirstname(): '' ?>">
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
        <input name="lastname" type="text" class="form-control" value="<?= isset($params['contact'])? $params['contact']->getHumain()->getLastname(): ''?>">
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
                    <option value=<?= $pays->getId() ?>
                    <?php if(isset($params['contact'])) : ?>
                        <?= ($pays->pays_id === $params['contact']->getNationality()->getId())? 'selected' : '' ?>
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
        <input name="birthday" type="date" class="form-control" value=<?= isset($params['contact'])? $params['contact']->getHumainKgbInfo()->getBirthday() : ''?>>
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