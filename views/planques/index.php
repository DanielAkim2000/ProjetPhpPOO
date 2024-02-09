<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Code de la planque</th>
        <th scope="col">Type de planque</th>
        <th scope="col">Pays de la planque</th>     
        <th scope="col">Actions</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach($params['planques'] as $planque): ?>
        <tr>
            <td><?= $planque->planque_id ?></td>
            <td><?= $planque->getCode() ?></td>
            <td><?= $planque->getType()->getNameType() ?></td>
            <td><?= $planque->getPays()->getName() ?></td>
            <td>
                <a href="Planques/Edit/<?= $planque->planque_id ?>" class="btn btn-warning">Modifier</a>
                <form action="Planques/Delete/<?= $planque->planque_id ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
