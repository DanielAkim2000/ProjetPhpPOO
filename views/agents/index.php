<h1 class="text-center"><a href="Agents/Create" class="btn btn-success">Créer un nouvel agent</a> Administration des agents</h1>

<table class="table w-75 m-auto text-center">
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
            <td><?= $agent->getId() ?></td>
            <td><?= $agent->getHumainKgbInfo()->getHumain()->getFirstname() ?></td>
            <td><?= $agent->getHumainKgbInfo()->getHumain()->getLastname() ?></td>
            <td><?= $agent->getHumainKgbInfo()->getBirthday() ?></td>
            <td><?= $agent->getCode() ?></td>
            <td><?= $agent->getHumainKgbInfo()->getNationality()->getName() ?></td>
            <td>
                <?php 
                    $specialities = array_map(
                        function($speciality) {
                            return $speciality->getNameOfSpeciality();
                        },
                        $agent->getSpeciality()
                    );
                    echo implode(', ', $specialities);
                ?>
            </td>
            <td>
                <a href="Agents/Edit/<?= $agent->agent_id ?>" class="btn btn-warning w-100">Modifier</a>
                <form action="Agents/Delete/<?= $agent->agent_id ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-2" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
