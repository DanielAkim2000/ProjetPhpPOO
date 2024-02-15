<h1 class="text-center"><a href="Typeplanques/Create" class="btn btn-success">Créer un type de planque</a> Adminisatration des types de planques</h1>

<table class="table w-50 m-auto text-center">
    <thead>
        <tr>
            <th scope="col">#</th scope="col">
            <th scope="col">Nom du type</th scope="col">
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($params['typeplanques'] as $type) : ?>
        <tr>
            <td><?= $type->getId() ?></td>
            <td><?= $type->getNameType() ?></td>
            <td>
                <a href="/ECF/Typeplanques/Edit/<?= $type->getId() ?>" class="btn btn-warning">Modifier</a>
                <form action="/ECF/Typeplanques/Delete/<?= $type->getId() ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>