<nav class="navbar navbar-dark navbar-expand-lg border-bottom position-fixed header fixed-top w-100">
    <div class="container-fluid">
        <a class="navbar-brand" href="/ECF">
            <img src="<?= SCRIPTS. 'assets' . DIRECTORY_SEPARATOR . 'kgblogonoir.jpeg' ?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        KGB
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item lien">
                    <a class="nav-link lien" aria-current="page" href="/ECF">Page d'accueil</a>
                </li>
                <?php if(isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link lien" href="/ECF/Agents/1">Agents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lien" href="/ECF/Missions/1">Missions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lien" href="/ECF/Planques/1">Planques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lien" href="/ECF/Cibles/1">Cibles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lien" href="/ECF/Contacts/1">Contacts</a>
                    </li>
                    <?php if(isset($_SESSION['roles'])) : ?>
                        <?php if(in_array("SUPERADMIN",$_SESSION['roles'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link lien" href="/ECF/Admin/1">Admin</a>
                            </li>
                        <?php endif ?>
                    <?php endif ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a> 
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/ECF/Specialitys/1">Specialités</a></li>
                            <li><a class="dropdown-item" href="/ECF/Typemissions/1">Type de missions</a></li>
                            <li><a class="dropdown-item" href="/ECF/Typeplanques/1">Type de planques</a></li>
                            <li><a class="dropdown-item" href="/ECF/Statuts/1">Statuts</a></li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
            <form id="recherche" action="" method="POST" class="d-flex">
                <input name="nom" class="form-control me-2" placeholder="Rechercher">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/ECF/Logout">Se déconnecter</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/ECF/Login">Connexion</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>