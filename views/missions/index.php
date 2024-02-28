<h1 class="text-center mb-4">Administration des missions</h1>

<?php include(VIEWS.'filtre.php'); ?>

<table id="table" class="table table-responsive w-75 m-auto mb-4 text-center table-hover shadow-lg table-bordered rounded-table table-rounded">
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
            <th scope="row"><?= htmlspecialchars($mission->getId()) ?></th>
            <td><?= htmlspecialchars($mission->getTitre()) ?></td>
            <td class="truncate-text"><?= htmlspecialchars($mission->getDescription()) ?></td>
            <td><?= htmlspecialchars($mission->getCodeName()) ?></td>
            <td><?= htmlspecialchars($mission->getPays()->getName()) ?></td>
            <td><?= htmlspecialchars($mission->getType()->getNameType()) ?></td>
            <td><?= htmlspecialchars($mission->getStatut()->getNameStatut()) ?></td>
            <td><?= htmlspecialchars($mission->getSpeciality()->getNameOfSpeciality()) ?></td>
            <td><?= htmlspecialchars($mission->getStartdate()) ?></td>
            <td><?= htmlspecialchars($mission->getEnddate()) ?></td>
            <td>
                <?php 
                    $agents = array_map(
                        function($agent) {
                            return htmlspecialchars($agent->getHumainKgbInfo()->getHumain()->getFirstname());
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
                            return htmlspecialchars($contact->getHumainKgbInfo()->getHumain()->getFirstname());
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
                            return htmlspecialchars($cible->getHumainKgbInfo()->getHumain()->getFirstname());
                        },
                        $mission->getCibles()
                    );
                    echo implode(', ', $cibles)
                ?>
            </td>
            <td>
                <a href="/ECF/Missions/Edit/<?= $mission->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Missions/Delete/<?= $mission->getId() ?>/<?= $_SESSION['token'] ?>" class="d-inline" method="POST">
                    <button type="submit" class="btn btn-danger mt-1 w-100">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<a class="btn btn-success d-block w-25 m-auto mt-4" href="/ECF/Missions/Create">Créer une nouvelle mission</a>
<?php include(VIEWS. 'pagination.php') ?>