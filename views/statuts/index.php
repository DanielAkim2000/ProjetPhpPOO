<h1 class="text-center mb-4" >Administration des statuts</h1>

<table class="table w-75 m-auto mb-4 text-center table-hover shadow-lg table-bordered rounded-table table-rounded">
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
            <th scope="row"><?= htmlspecialchars($statut->getId()) ?></th>
            <td><?= htmlspecialchars($statut->getNameStatut()) ?></td>
            <td class="w-10">
                <a href="/ECF/Statuts/Edit/<?= $statut->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" class="supp" action="/ECF/Statuts/Delete/<?= $statut->getId() ?>/<?= $_SESSION['token'] ?>"  method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Statuts/Create" class="btn btn-success m-auto w-25 d-block">Créer un nouveau statut</a> 
<?php include(VIEWS. 'pagination.php') ?>