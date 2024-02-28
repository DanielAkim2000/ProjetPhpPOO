<div class="divfooter overflow-x-auto">
  <footer class="d-flex flex-wrap justify-content-between mb-0 mr-0 text-white align-items-center footer py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted p-2">&copy; 2024 KGB</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <img src="<?= SCRIPTS.'assets'.DIRECTORY_SEPARATOR.'kgblogonoir.jpeg' ?>" class="w-25" alt="">
    </a>

    <ul class="nav col-md-4 justify-content-end p-2">
      <li class="nav-item"><a href="/ECF/" class="nav-link px-2 text-muted">Page d'accueil</a></li>
      <?php if(isset($_SESSION['auth'])) : ?>
        <li class="nav-item"><a href="/ECF/Agents" class="nav-link px-2 text-muted">Agents</a></li>
        <li class="nav-item"><a href="/ECF/Cibles" class="nav-link px-2 text-muted">Cibles</a></li>
        <li class="nav-item"><a href="/ECF/Contacts" class="nav-link px-2 text-muted">Contacts</a></li>
        <li class="nav-item"><a href="/ECF/Missions" class="nav-link px-2 text-muted">Missions</a></li>
      <?php endif ?>
    </ul>
  </footer>
</div>