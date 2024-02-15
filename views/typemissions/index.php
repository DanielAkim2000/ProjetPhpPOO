<h1 class="text-center"><a href="Typemissions/Create" class="btn btn-success">Créer un type de mission</a> Adminisatration des types de missions</h1>

<table class="table w-75 text-center m-auto">
    <thead>
        <tr>
            <th scope="col">#</th scope="col">
            <th scope="col">Nom du type</th scope="col">
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($params['typemissions'] as $type) : ?>
        <tr>
            <td><?= $type->getId() ?></td>
            <td><?= $type->getNameType() ?></td>
            <td>
                <a href="/ECF/Typemissions/Edit/<?= $type->getId() ?>" class="btn btn-warning">Modifier</a>
                <form action="/ECF/Typemissions/Delete/<?= $type->getId() ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>