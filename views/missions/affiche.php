<div id="table" class="d-flex flex-row justify-content-around align-items-basline flex-wrap w-100">
    <?php foreach($params['missions'] as $mission) : ?>
        <a href="/ECF/Missions/Show/<?= $mission->getId() ?>" class="text-decoration-none text-black m-3 w-20 p-3 border border-2 shadow rounded">
            <div class="">
                <h4 class="p-3 rounded text-center bg-black text-white"><?= $mission->getTitre() ?></h4>
                <label class="fst-italic fw-bold mt-2 mb-2">Description:</label>
                <p><?= $mission->getDescription() ?></p>
                <label class="fst-italic fw-bold mt-2 mb-2">Specilité pour cette mission:</label>
                <p><?= $mission->getSpeciality()->getNameOfSpeciality() ?></p>
                <label class="fst-italic fw-bold mt-2 mb-2">Pays:</label>
                <p><?= $mission->getPays()->getName() ?></p>
            </div>
        </a>
    <?php endforeach ?>
</div>