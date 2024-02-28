<h1 class="text-center mb-4">Administration des planques</h1>

<?php include(VIEWS.'filtre.php') ?>

<table id="table" class="table table-responsive w-75 m-auto text-center table-hover mb-4 shadow-lg table-bordered rounded-table table-rounded">
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
            <td class="w-10">
                <a href="/ECF/Planques/Edit/<?= $planque->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Planques/Delete/<?= $planque->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Planques/Create" class="btn btn-success d-block w-25 m-auto">Créer une nouvelle planque</a> 
<?php include(VIEWS. 'pagination.php') ?>