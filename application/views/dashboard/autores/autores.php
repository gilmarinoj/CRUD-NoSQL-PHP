<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <h1>Autores</h1>
        </div>
        <div class="col-12 col-md-6">
            <div class="float-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAgregar">Agregar</button>
            </div>
        </div>
        <?php if($this->session->flashdata('msg_formulario')) { ?>
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
                            <th scope="col">Email</th>
                            <th scope="col">Biografia</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($autores) && count($autores) > 0) {  ?>
                            <?php foreach ($autores as $autor) { ?>
                                <tr>
                                    <th scope="row"><?php echo $autor['id']; ?></th>
                                    <td><?php echo $autor['name']; ?></td>
                                    <td><?php echo $autor['email']; ?></td>
                                    <td></td>
                                    <td>
                                    <form action="<?php echo base_url('api/eliminar_autores'); ?>" method="post" class="d-inline" id="eliminarautor"> 
                                        <input type="hidden" name="id" value="<?php echo $autor['id']; ?>">
                                        <button type="submit" class="btn btn-secondary btn-sm btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    <a href="<?php echo base_url('autores/edit/'.$autor['id']); ?>" class="btn btn-secondary btn-sm btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
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
            <form action="<?php echo base_url('api/agregar_autores'); ?>" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Autor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="biografia" class="form-label">Biografia</label>
                        <textarea class="form-control" id="biografia" name="biografia" rows="3"></textarea>
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