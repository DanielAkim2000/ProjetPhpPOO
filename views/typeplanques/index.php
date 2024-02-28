<h1 class="text-center mb-4">Adminisatration des types de planques</h1>

<table class="table w-75 m-auto mb-4 text-center table-hover shadow-lg table-bordered rounded-table table-rounded">
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
            <th scope="row"><?= htmlspecialchars($type->getId()) ?></th>
            <td><?= htmlspecialchars($type->getNameType()) ?></td>
            <td class="w-10">
                <a href="/ECF/Typeplanques/Edit/<?= $type->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Typeplanques/Delete/<?= $type->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Typeplanques/Create" class="btn btn-success m-auto w-25 d-block">Créer un type de planque</a> 
<?php include(VIEWS. 'pagination.php') ?>