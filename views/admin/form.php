<h1 class="text-center mb-4"><?php echo isset($params['admin'])?'Modifications des données de l\'admin numéro '.$params['admin']->getId() : 'Créer un nouvel admin'; ?></h1>

<form id="formulaire" action="<?= isset($params['admin'])? "/ECF/Admin/Edit/{$params['admin']->getId()}/{$_SESSION['token']}" : "/ECF/Admin/Create/{$_SESSION['token']}" ?>" class="w-style m-auto" method="POST">
    <div class="form-group mb-2">
        <label class="form-label"  for="firstname">Prénom:</label>
        <input name="firstname" type="text" class="form-control" value="<?= isset($params['admin'])? $params['admin']->getHumain()->getFirstname(): '' ?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="lastname">Nom:</label>
        <input name="lastname" type="text" class="form-control" value="<?= isset($params['admin'])? $params['admin']->getHumain()->getLastname(): ''?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label" for="email">Email:</label>
        <input name="email" type="email" class="form-control" placeholder="Exemple@exemple.com" value=<?= isset($params['admin'])? $params['admin']->getEmail() : ''?>>
    </div>
    <?php if(isset($params['admin'])) : ?>
        <div class="form-group mb-2">
            <label class="form-label" for="datedecreation">Date de création:</label>
            <input disabled name="datedecreation" type="date" class="form-control" value=<?= isset($params['admin'])? $params['admin']->getDateDeCreation() : ''?>>
        </div>
    <?php endif ?>
    <?php if(!isset($params['admin'])) : ?>
        <div class="form-group mb-2">
        <label class="form-label" for="password">Mot de passe:</label>
            <input name="password" type="password" class="form-control" value=<?= isset($params['admin'])? $params['admin']->getDateDeCreation() : ''?>>
        </div>
    <?php endif ?>
    <div class="form-group mb-2">
        <label class="form-label"  for="speciality_id">Roles:</label>
        <select multiple name="roles_id[]" class="form-select">
            <?php foreach($params['roles'] as $role) : ?>
                <option value="<?= $role->getId() ?>"
                <?php if(isset($params['admin'])) : ?>
                <?php foreach($params['admin']->getRoles() as $roleAdmin)
                    {
                        echo (($role->getId() === $roleAdmin->getId())? 'selected' : '');
                    } 
                ?>
                <?php endif ?>
                >
                <?= $role->getName() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" id="formulaire" class="btn btn-primary mt-2">Enregistrer</button>
</form>