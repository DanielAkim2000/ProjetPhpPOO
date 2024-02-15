<h1 class="text-center"><a href="Contacts/Create" class="btn btn-success">Créer un nouveau contact</a> Administration des contacts</h1>

<table class="table w-75 m-auto text-center">
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
            <td><?= $contact->getId() ?></td>
            <td><?= $contact->getHumainKgbInfo()->getHumain()->getFirstname() ?></td>
            <td><?= $contact->getHumainKgbInfo()->getHumain()->getLastname() ?></td>
            <td><?= $contact->getHumainKgbInfo()->getBirthday() ?></td>
            <td><?= $contact->getHumainKgbInfo()->getNationality()->getName() ?></td>
            <td><?= $contact->getCodeName() ?></td>
            <td>
                <a href="/ECF/Contacts/Edit/<?= $contact->getId() ?>" class="btn btn-warning w-75">Modifier</a>
                <form action="/ECF/Contacts/Delete/<?= $contact->getId() ?>" method="POST">
                    <button type="submit" class="btn btn-danger w-75 mt-2" >Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

</table>
