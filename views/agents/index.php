<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Birthday</th>
        <th scope="col">Nationalty</th>
        <th scope="col">Speciality</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($params['agents'] as $agent): ?>
        <tr>
            <td><?= $agent->agent_id ?></td>
            <td><?= $agent->getHumainKgbInfo()->getHumain()->getFirstname() ?></td>
            <td><?= $agent->getHumainKgbInfo()->getHumain()->getLastname() ?></td>
            <td><?= $agent->getHumainKgbInfo()->getBirthday() ?></td>
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
                <a href="#" class="btn btn-warning">Modifier</a>
                <form action="Agents/Delete/<?= $agent->agent_id ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
