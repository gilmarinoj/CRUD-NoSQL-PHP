<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'articulos') ? 'active' : ''; ?>" href="<?php echo base_url('articulos'); ?>">Articulos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'categorias') ? 'active' : ''; ?>" href="<?php echo base_url('categorias'); ?>">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'autores') ? 'active' : ''; ?>" href="<?php echo base_url('autores'); ?>">Autores</a>
                </li>
            </ul>
        </div>
    </div>
</nav>