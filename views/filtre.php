<div class="w-25 m-auto mb-4">
    <label class="form-label" for="filtre">Filtrer:</label>
    <select id="filtre" name="filtre" class="form-select">
        <?php if(isset($params['dataForFiltre'])) : ?>
            <?php foreach($params['dataForFiltre'] as $data) :?>
                <option value="<?= $data->getId() ?>"><?= $data->getNameForFiltre() ?></option>
            <?php endforeach ?>
        <?php endif ?>
    </select>
</div>