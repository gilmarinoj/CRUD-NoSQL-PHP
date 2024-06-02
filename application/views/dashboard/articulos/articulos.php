<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <h1>Articulos</h1>
        </div>
        <div class="col-12 col-md-6">
            <div class="float-end d-flex ">
                <form type="get" class="me-2" action="<?php echo base_url('articulos'); ?>">
                    <input value="<?php echo ($this->input->get('search')) ? $this->input->get('search') : ''; ?>" type="text" class="form-control" name="search" id="search" placeholder="Buscar">
                </form>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAgregar">Agregar</button>
            </div>
        </div>
        <?php if ($this->session->flashdata('msg_formulario')) { ?>
            <div class="col-12">
                <?php echo $this->session->flashdata('msg_formulario'); ?>
            </div>
        <?php } ?>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Fecha Publicacion</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($articulos) && count($articulos) > 0) {  ?>
                            <?php foreach ($articulos as $articulo) { ?>
                                <tr>
                                    <th scope="row"><?php echo $articulo['id']; ?></th>
                                    <td><?php echo $articulo['title']; ?></td>
                                    <td><?php echo $articulo['date_publication']; ?></td>
                                    <td><?php echo $articulo['authorname']; ?></td>
                                    <td><?php echo $articulo['categoryname']; ?></td>
                                    <td>
                                        <form action="<?php echo base_url('api/eliminar_articulos'); ?>" method="post" class="d-inline" id="eliminararticulo">
                                            <input type="hidden" name="id" value="<?php echo $articulo['id']; ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        <a href="<?php echo base_url('articulos/edit/' . $articulo['id']); ?>" class="btn btn-secondary btn-sm btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="<?php echo base_url('articulos/view/' . $articulo['id']); ?>" class="btn btn-secondary btn-sm btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('api/agregar_articulos'); ?>" method="post" id="formularioarticulo">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Articulo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_publicacion" class="form-label">Fecha de Publicacion</label>
                        <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" placeholder="Fecha de Publicacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <div id="contenido"></div>
                    </div>
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoria</label>
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            <?php if ($categorias) {  ?>
                                <?php foreach ($categorias as $categoria) { ?>
                                    <option value="<?php echo $categoria['_id'] ?>"><?php echo $categoria['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="autor_id" class="form-label">Autor</label>
                        <select class="form-select" id="autor_id" name="autor_id" required>
                            <?php if ($autores) {  ?>
                                <?php foreach ($autores as $autor) { ?>
                                    <option value="<?php echo $autor['_id'] ?>"><?php echo $autor['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
                <input type="hidden" name="contenido" id="contenidodiv">
            </form>
        </div>
    </div>
</div>