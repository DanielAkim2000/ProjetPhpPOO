<h1 class="text-center mb-4">Administration des agents</h1>

<?php include(VIEWS.'filtre.php'); ?>

<table id="table" class="table table-responsive w-75 m-auto text-center table-hover shadow-lg table-bordered mb-4 rounded-table table-rounded">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Birthday</th>
        <th scope="col">Code d'identification</th>
        <th scope="col">Nationalty</th>
        <th scope="col">Speciality</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($params['agents'] as $agent): ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($agent->getId()) ?></th>
            <td><?= htmlspecialchars($agent->getHumainKgbInfo()->getHumain()->getFirstname()) ?></td>
            <td><?= htmlspecialchars($agent->getHumainKgbInfo()->getHumain()->getLastname()) ?></td>
            <td><?= htmlspecialchars($agent->getHumainKgbInfo()->getBirthday()) ?></td>
            <td><?= htmlspecialchars($agent->getCode()) ?></td>
            <td><?= htmlspecialchars($agent->getHumainKgbInfo()->getNationality()->getName()) ?></td>
            <td>
                <?php 
                    $specialities = array_map(
                        function($speciality) {
                            return  htmlspecialchars($speciality->getNameOfSpeciality());
                        },
                        $agent->getSpeciality()
                    );
                    echo implode(', ', $specialities);
                ?>
            </td>
            <td>
                <a href="/ECF/Agents/Edit/<?= $agent->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Agents/Delete/<?= $agent->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Agents/Create" class="btn btn-success d-block w-25 m-auto">Créer un nouvel agent</a>
<?php include(VIEWS. 'pagination.php') ?>
