<h1 class="text-center mb-4">Administration des contacts</h1>

<?php include(VIEWS.'filtre.php') ?>

<table id="table" class="table table-responsive w-75 m-auto mb-4 text-center table-hover shadow-lg table-bordered rounded-table table-rounded">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Birthday</th>
            <th scope="col">Nationalty</th>
            <th scope="col">Nom de code</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($params['contacts'] as $contact): ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($contact->getId()) ?></th>
            <td><?= htmlspecialchars($contact->getHumainKgbInfo()->getHumain()->getFirstname()) ?></td>
            <td><?= htmlspecialchars($contact->getHumainKgbInfo()->getHumain()->getLastname()) ?></td>
            <td><?= htmlspecialchars($contact->getHumainKgbInfo()->getBirthday()) ?></td>
            <td><?= htmlspecialchars($contact->getHumainKgbInfo()->getNationality()->getName()) ?></td>
            <td><?= htmlspecialchars($contact->getCodeName()) ?></td>
            <td class="w-10">
                <a href="/ECF/Contacts/Edit/<?= $contact->getId() ?>" class="btn btn-warning w-100">Modifier</a>
                <form class="supp" action="/ECF/Contacts/Delete/<?= $contact->getId() ?>/<?= $_SESSION['token'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-100 mt-1" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<a href="/ECF/Contacts/Create" class="btn btn-success d-block w-25 m-auto mt-4">Créer un nouveau contact</a> 
<?php include(VIEWS. 'pagination.php') ?>