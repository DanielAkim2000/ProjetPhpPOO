<h1 class="text-center"><a class="btn btn-success" href="Missions/Create">Créer une nouvelle mission</a> Administration des missions</h1>

<table class="table w-75 m-auto text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Code</th>
            <th scope="col">Pays</th>
            <th scope="col">Type de la mission</th>
            <th scope="col">Statut de la mission</th>
            <th scope="col">Specialités requises</th>
            <th scope="col">Date de debut</th>
            <th scope="col">Date de fin</th>
            <th scope="col">Agents</th>
            <th scope="col">Contacts</th>
            <th scope="col">Cibles</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($params['missions'] as $mission): ?>
        <tr>
            <td><?= $mission->mission_id ?></td>
            <td><?= $mission->getTitre() ?></td>
            <td><?= $mission->getDescription() ?></td>
            <td><?= $mission->getCodeName() ?></td>
            <td><?= $mission->getPays()->getName() ?></td>
            <td><?= $mission->getType()->getNameType() ?></td>
            <td><?= $mission->getStatut()->getNameStatut() ?></td>
            <td><?= $mission->getSpeciality()->getNameOfSpeciality() ?></td>
            <td><?= $mission->getStartdate() ?></td>
            <td><?= $mission->getEnddate() ?></td>
            <td>
                <?php 
                    $agents = array_map(
                        function($agent) {
                            return $agent->getHumainKgbInfo()->getHumain()->getFirstname();
                        },
                        $mission->getAgents()
                    );
                    echo implode(', ', $agents);
                ?>
            </td>
            <td>
                <?php 
                    $contacts = array_map(
                        function($contact) 
                        {
                            return $contact->getHumainKgbInfo()->getHumain()->getFirstname();
                        },
                        $mission->getContacts()
                    );
                    echo implode(', ', $contacts);
                ?>
            </td>
            <td>
                <?php 
                    $cibles =  array_map(
                        function($cible)
                        {
                            return $cible->getHumainKgbInfo()->getHumain()->getFirstname();
                        },
                        $mission->getCibles()
                    );
                    echo implode(', ', $cibles)
                ?>
            </td>
            <td>
                <a href="Missions/Edit/<?= $mission->mission_id ?>" class="btn btn-warning w-100">Modifier</a>
                <form action="Missions/Delete/<?= $mission->mission_id ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger mt-2 w-100">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>