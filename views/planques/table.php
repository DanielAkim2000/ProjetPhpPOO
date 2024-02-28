<table id="table" class="table w-75 m-auto text-center table-hover mb-4 shadow-lg table-bordered rounded-table table-rounded">
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
            <th scope="row"><?= htmlspecialchars($planque->getId()) ?></th>
            <td><?= htmlspecialchars($planque->getCode()) ?></td>
            <td><?= htmlspecialchars($planque->getType()->getNameType()) ?></td>
            <td><?= htmlspecialchars($planque->getPays()->getName()) ?></td>
            <td class="">
                <a href="/ECF/Planques/Edit/<?= $planque->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form action="/ECF/Planques/Delete/<?= $planque->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>