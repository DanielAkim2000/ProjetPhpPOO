<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Birthday</th>
        <th scope="col">Nationalty</th>
        <th scope="col">Speciality</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($params['agents'] as $agent): ?>
        <tr>
            <td><?= $agent->agent_id ?></td>
            <td><?= $agent->getHumain()->getFirstname() ?></td>
            <td><?= $agent->getHumain()->getLastname() ?></td>
            <td><?= $agent->getBirthday() ?></td>
            <td><?= $agent->getNationality() ?></td>
            <?php foreach($agent->getSpeciality() as $speciality): ?>
                <td><?= $speciality->getNameOfSpeciality() ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
