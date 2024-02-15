<h1 class="text-center" ><a href="Statuts/Create" class="btn btn-success">Créer un nouveau statut</a> Administration des statuts</h1>

<table class="table w-75 m-auto text-center">
    <thead>
        <tr>
            <th scope="col">#</th scope="col">
            <th scope="col">Nom du statut</th scope="col">
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($params['statuts'] as $statut) : ?>
        <tr>
            <td><?= $statut->getId() ?></td>
            <td><?= $statut->getNameStatut() ?></td>
            <td>
                <a href="Statuts/Edit/<?= $statut->getId() ?>" class="btn btn-warning">Modifier</a>
                <form action="Statuts/Delete/<?= $statut->getId() ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>