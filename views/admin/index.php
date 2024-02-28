<h1 class="text-center mb-4">Administration des administrateurs</h1>


<table id="table" class="table table-responsive w-75 m-auto text-center table-hover shadow-lg table-bordered mb-4 rounded-table table-rounded">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Email</th>
        <th scope="col">Date de création</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($params['admins'] as $admin): ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($admin->getId()) ?></th>
            <td><?= htmlspecialchars($admin->getHumain()->getFirstname()) ?></td>
            <td><?= htmlspecialchars($admin->getHumain()->getLastname()) ?></td>
            <td><?= htmlspecialchars($admin->getEmail()) ?></td>
            <td><?= htmlspecialchars($admin->getDateDeCreation()) ?></td>
            <td class="w-10">
                <a href="/ECF/Admin/Edit/<?= $admin->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Admin/Delete/<?= $admin->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Admin/Create" class="btn btn-success d-block w-25 m-auto">Créer un nouvel admin</a>

<?php include(VIEWS. 'pagination.php') ?>