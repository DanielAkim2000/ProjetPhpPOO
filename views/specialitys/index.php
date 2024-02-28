<h1 class="text-center mb-4" >Administration des spécialités</h1>

<table class="table w-75 m-auto mb-4 text-center table-hover shadow-lg table-bordered rounded-table table-rounded">
    <thead>
        <tr>
            <th scope="col">#</th scope="col">
            <th scope="col">Nom de specialité</th scope="col">
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($params['specialitys'] as $speciality) : ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($speciality->getId()) ?></th>
            <td><?= htmlspecialchars($speciality->getNameOfSpeciality()) ?></td>
            <td class="w-10 m-auto">
                <a href="/ECF/Specialitys/Edit/<?= $speciality->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Specialitys/Delete/<?= $speciality->getId() ?>/<?= $_SESSION['token'] ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Specialitys/Create" class="btn btn-success w-25 m-auto d-block">Créer une nouvelle spécialité</a> 
<?php include(VIEWS. 'pagination.php') ?>