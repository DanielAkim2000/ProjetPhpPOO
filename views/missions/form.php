<h1 class="text-center"><?= isset($params['mission'])? "Modifications de la mission numéro {$params['mission']->getId()}" : "Création d'une nouvelle mission" ?> </h1>

<form action=<?= isset($params['mission'])? "/ECF/Missions/Edit/{$params['mission']->getId()}" : "/ECF/Missions/Create" ?> class="w-50 m-auto" method="post">
    <div class="form-group mb-2">
        <label class="form-label"  for="titre">Titre:</label>
        <input name="titre" type="text" class="form-control" value="<?= isset($params['mission'])? $params['mission']->getTitre() : "" ?>">
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="description">Description:</label>
        <textarea name="description" id="description" class="form-control" cols="30" rows="10"><?= isset($params['mission'])?  $params['mission']->getDescription() : "" ?></textarea>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="codename">Code:</label>
        <input name="codename" id="codename"  type="text" value="<?= isset($params['mission'])?  $params['mission']->getCodeName() : "" ?>" class="form-control">
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="startdate">Date de début de la mission:</label>
        <input type="date" name="startdate" value="<?= isset($params['mission'])?  $params['mission']->getEndDate() : "" ?>" class="form-control">
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="enddate">Date de fin de la mission:</label>
        <input type="date" name="enddate" value="<?= isset($params['mission'])?  $params['mission']->getStartDate(): "" ?>" class="form-control">
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="pays_id">Pays de la mission:</label>
        <select name="pays_id" class="form-select" id="pays_id">
            <?php foreach($params['pays'] as $pays) : ?>
                <option <?php  
                if(isset($params['mission'])){
                    if($params['mission']->getPays()->getId() === $pays->getId()){
                        echo("selected");
                    }
                } ?>
                value="<?= $pays->getId() ?>"><?= $pays->getName() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="type_id">Type de mission:</label>
        <select name="type_id" class="form-select" id="pays_id">
            <?php foreach($params['typemissions'] as $typemission) : ?>
                <option <?php  
                if(isset($params['mission'])){
                    if($params['mission']->getType()->getId() === $typemission->getId()){
                        echo("selected");
                    }
                } ?>
                value="<?= $typemission->getId() ?>" ><?= $typemission->getNameType() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="statut_id">Statut de la mission:</label>
        <select name="statut_id" class="form-select" id="statut_id">
            <?php foreach($params['statuts'] as $statut) : ?>
                <option <?php  
                if(isset($params['mission'])){
                    if($params['mission']->getStatut()->getId() === $statut->getId()){
                        echo("selected");
                    }
                } ?>
                value="<?= $statut->getId() ?>"><?= $statut->getNameStatut() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="speciality_id">Spécialité de la mission:</label>
        <select name="speciality_id" class="form-select" id="speciality_id">
            <?php foreach($params['specialitys'] as $speciality) : ?>
                <option <?php  
                if(isset($params['mission'])){
                    if($params['mission']->getSpeciality()->getId() === $speciality->getId()){
                        echo("selected");
                    }
                } ?>
                value="<?= $speciality->getId() ?>"><?= $speciality->getNameofSpeciality() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="agent_id">Agents sur cette mission:</label>
        <select multiple name="agent_id[]" class="form-select form-control">
            <?php foreach($params['agents'] as $agent) : ?>
                <option value="<?= $agent->getId() ?>"
                <?php if(isset($params['mission'])) : ?>
                <?php foreach($params['mission']->getAgents() as $agentMission)
                    {
                        echo (($agentMission->getId() === $agent->getId())?  "selected" : "" );
                    }
                ?>
                <?php endif ?>
                >
                <?= $agent->getHumainKgbInfo()->getHumain()->getFirstname()." ".$agent->getHumainKgbInfo()->getHumain()->getLastname() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="contact_id">Contacts disponible pour cette mission:</label>
        <select multiple name="contact_id[]" class="form-select form-control">
            <?php foreach($params['contacts'] as $contact) : ?>
                <option value="<?= $contact->getId() ?>"
                <?php if(isset($params['mission'])) : ?>
                <?php foreach($params['mission']->getContacts() as $contactMission)
                    {
                        echo (($contactMission->getId() === $contact->getId())?  "selected" : "" );
                    }
                ?>
                <?php endif ?>
                >
                <?= $contact->getHumainKgbInfo()->getHumain()->getFirstname()." ".$contact->getHumainKgbInfo()->getHumain()->getLastname() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="cible_id">Cibles de cette mission:</label>
        <select multiple name="cible_id[]" class="form-select form-control">
            <?php foreach($params['cibles'] as $cible) : ?>
                <option value="<?= $cible->getId() ?>"
                <?php if(isset($params['mission'])) : ?>
                <?php foreach($params['mission']->getCibles() as $cibleMission)
                    {
                        echo (($cibleMission->getId() === $cible->getId())?  "selected" : "" );
                    }
                ?>
                <?php endif ?>
                >
                <?= $cible->getHumainKgbInfo()->getHumain()->getFirstname()." ".$cible->getHumainKgbInfo()->getHumain()->getLastname() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label"  for="planque_id">Planques pour cette mission:</label>
        <select multiple name="planque_id[]" class="form-select form-control">
            <?php foreach($params['planques'] as $planque) : ?>
                <option value="<?= $planque->getId() ?>"
                <?php if(isset($params['mission'])) : ?>
                <?php foreach($params['mission']->getPlanques() as $planqueMission)
                    {
                        echo (($planqueMission->getId() === $planque->getId())?  "selected" : "" );
                    }
                ?>
                <?php endif ?>
                >
                <?= $planque->getType()->getNameType()." ".$planque->getPays()->getName() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
</form>