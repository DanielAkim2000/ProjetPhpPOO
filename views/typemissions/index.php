<h1 class="text-center mb-4">Administration des types de missions</h1>

<table class="table w-75 mb-4 text-center m-auto table-hover shadow-lg table-bordered rounded-table table-rounded">
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
            <th scope="row"><?= htmlspecialchars($type->getId()) ?></th>
            <td><?= htmlspecialchars($type->getNameType()) ?></td>
            <td class="w-10">
                <a href="/ECF/Typemissions/Edit/<?= $type->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Typemissions/Delete/<?= $type->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Typemissions/Create" class="btn btn-success d-block w-25 m-auto">Créer un type de mission</a> 
<?php include(VIEWS. 'pagination.php') ?>