<h1>Liste des pays</h1>

<?php foreach($params['pays'] as $pays) : ?>
    <div class="card">
        <div class="card-body mb-2 text-center">
            <h3><?= $pays->getName(); ?></h3>
        </div>
        <?= $pays->getButton() ?>
    </div>
<?php endforeach ?>