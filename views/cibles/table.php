<table class="table w-75 m-auto mb-4 text-center table-hover shadow-lg table-bordered rounded-table table-rounded">
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
            <td><?= $cible->getHumainKgbInfo()->getHumain()->getFirstname() ?></td>
            <td><?= $cible->getHumainKgbInfo()->getHumain()->getLastname() ?></td>
            <td><?= $cible->getHumainKgbInfo()->getBirthday() ?></td>
            <td><?= $cible->getHumainKgbInfo()->getNationality()->getName() ?></td>
            <td><?= $cible->getCodeName() ?></td>
            <td>
                <a href="/ECF/Cibles/Edit/<?= $cible->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form action="/ECF/Cibles/Delete/<?= $cible->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>