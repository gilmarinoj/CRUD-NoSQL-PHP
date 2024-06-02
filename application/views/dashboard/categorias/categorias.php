<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <h1>Categorias</h1>
        </div>
    <div class="col-12 col-md-6">
        <div class="float-end">
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($categorias) && count($categorias) > 0) {  ?>
                        <?php foreach ($categorias as $categoria) { ?>
                            <tr>
                                <th scope="row"><?php echo $categoria['id']; ?></th>
                                <td><?php echo $categoria['name']; ?></td>
                                <td><?php echo $categoria['description']; ?></td>
                                <td>
                                    <form action="<?php echo base_url('api/eliminar_categorias'); ?>" method="post" class="d-inline" id="eliminarcategoria"> 
                                        <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
                                        <button type="submit" class="btn btn-secondary btn-sm btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    <a href="<?php echo base_url('categorias/edit/'.$categoria['id']); ?>" class="btn btn-secondary btn-sm btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
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
            <form action="<?php echo base_url('api/agregar_categorias'); ?>" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
            </form>
        </div>
    </div>
</div>