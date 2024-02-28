<h1 class="text-center"><?= $params['mission']->getTitre() ?></h1>
<p class="text-center"><?= '('.$params['mission']->getStatut()->getNameStatut().')' ?></p>

<div class="d-flex flex-wrap justify-content-between flex-row w-100 h-100">
    <div class="d-flex flex-column p-2 border m-4 border-2 w-21 shadow rounded">
        <label class="mt-2 mb-2 fs-6 fw-bold fst-italic">Description:</label>
        <p class="">
            <?= $params['mission']->getDescription() ?>
        </p>
    </div>
    <div class="d-flex flex-column p-2 border m-4 border-2 w-21 shadow rounded">
            <label class="mt-2 mb-2 fs-6 fw-bold fst-italic">Specilité pour cette mission:</label>
            <p class=""><?= $params['mission']->getSpeciality()->getNameOfSpeciality() ?></p>
            <label class="mt-2 fs-6 fw-bold">Pays:</label>
            <p class=""><?= $params['mission']->getPays()->getName() ?></p>
            <div>
                <label class="mt-2 mb-2 fs-6 fw-bold fst-italic">Liste des agents sur cette mission:</label>
                <?php foreach($params['mission']->getAgents() as $agent) : ?>
                    <p class="mb-1 "><?= $agent->getHumainKgbInfo()->getHumain()->getFirstname().' '.$agent->getHumainKgbInfo()->getHumain()->getLastname() ?></p>
                <?php endforeach ?>
            </div>
    </div>
    <div class="d-flex flex-column p-2 border m-4 border-2 w-21 shadow rounded">
            <div>
                <label class="mt-2 mb-2 fs-6 fw-bold fst-italic">Liste des cibles pour cette mission:</label>
                <?php foreach($params['mission']->getCibles() as $cible) : ?>
                    <p class="mb-1 "><?= $cible->getHumainKgbInfo()->getHumain()->getFirstname().' '.$cible->getHumainKgbInfo()->getHumain()->getLastname() ?></p>
                <?php endforeach ?>
            </div>
            <div>
                <label class="mt-2 mb-2 fs-6 fw-bold fst-italic">Liste des contacts pour cette mission:</label>
                <?php foreach($params['mission']->getContacts() as $contact) : ?>
                    <p class="mb-1 "><?= $contact->getHumainKgbInfo()->getHumain()->getFirstname().' '.$contact->getHumainKgbInfo()->getHumain()->getLastname() ?></p>
                <?php endforeach ?>
            </div>
            <div>
                <label class="mt-2 mb-2 fs-6 fw-bold fst-italic">Liste des planques pour cette mission:</label>
                <?php foreach($params['mission']->getPlanques() as $planque) : ?>
                    <p class="mb-1 "><?= $planque->getType()->getNameType(). ' ' .$planque->getPays()->getName() ?></p>
                <?php endforeach ?>
            </div>
    </div>
</div>