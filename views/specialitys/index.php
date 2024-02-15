<h1 class="text-center" ><a href="Specialitys/Create" class="btn btn-success">Créer une nouvelle spécialité</a> Administration des spécialités</h1>

<table class="table w-75 m-auto text-center">
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
            <td><?= $speciality->getId() ?></td>
            <td><?= $speciality->getNameOfSpeciality() ?></td>
            <td>
                <a href="Specialitys/Edit/<?= $speciality->getId() ?>" class="btn btn-warning">Modifier</a>
                <form action="Specialitys/Delete/<?= $speciality->getId() ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>