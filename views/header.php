<nav class="navbar navbar-dark bg-dark navbar-expand-lg bg-body-tertiary border-bottom position-fixed  fixed-top w-100">
    <div class="container-fluid">
        <a class="navbar-brand" href="/ECF">KGB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item lien">
                    <a class="nav-link lien" aria-current="page" href="/ECF">Page d'accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lien" href="/ECF/Agents">Agents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lien" href="/ECF/Missions">Missions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lien" href="/ECF/Planques">Planques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lien" href="/ECF/Cibles">Cibles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link lien" href="/ECF/Contacts">Contacts</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a> 
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/ECF/Specialitys">Specialités</a></li>
                        <li><a class="dropdown-item" href="/ECF/Typemissions">Type de missions</a></li>
                        <li><a class="dropdown-item" href="/ECF/Typeplanques">Type de planques</a></li>
                        <li><a class="dropdown-item" href="/ECF/Statuts">Statuts</a></li>
                    </ul>
                </li>
            </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
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