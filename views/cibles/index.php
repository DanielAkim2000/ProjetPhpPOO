<h1 class="text-center"><a href="Cibles/Create" class="btn btn-success">Créer une nouvelle cible</a> Administration des cibles</h1>

<table class="table w-75 m-auto text-center">
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
            <td><?= $cible->getId() ?></td>
            <td><?= $cible->getHumainKgbInfo()->getHumain()->getFirstname() ?></td>
            <td><?= $cible->getHumainKgbInfo()->getHumain()->getLastname() ?></td>
            <td><?= $cible->getHumainKgbInfo()->getBirthday() ?></td>
            <td><?= $cible->getHumainKgbInfo()->getNationality()->getName() ?></td>
            <td><?= $cible->getCodeName() ?></td>
            <td>
                <a href="/ECF/Cibles/Edit/<?= $cible->getId() ?>" class="btn btn-warning w-75">Modifier</a>
                <form action="/ECF/Cibles/Delete/<?= $cible->getId() ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-75 mt-2" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

</table>
