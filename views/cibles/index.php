<h1 class="text-center mb-4">Administration des cibles</h1>

<?php include(VIEWS.'filtre.php') ?>

<table id="table" class="table table-responsive w-75 m-auto mb-4 text-center table-hover shadow-lg table-bordered rounded-table table-rounded">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Birthday</th>
            <th scope="col">Nationalty</th>
            <th scope="col">Nom de code</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($params['cibles'] as $cible): ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($cible->getId()) ?></th>
            <td><?= htmlspecialchars($cible->getHumainKgbInfo()->getHumain()->getFirstname()) ?></td>
            <td><?= htmlspecialchars($cible->getHumainKgbInfo()->getHumain()->getLastname()) ?></td>
            <td><?= htmlspecialchars($cible->getHumainKgbInfo()->getBirthday()) ?></td>
            <td><?= htmlspecialchars($cible->getHumainKgbInfo()->getNationality()->getName()) ?></td>
            <td><?= htmlspecialchars($cible->getCodeName()) ?></td>
            <td class="w-10">
                <a href="/ECF/Cibles/Edit/<?= $cible->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Cibles/Delete/<?= $cible->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Cibles/Create" class="btn btn-success d-block w-25 mt-4 m-auto">Créer une nouvelle cible</a>
<?php include(VIEWS. 'pagination.php') ?>