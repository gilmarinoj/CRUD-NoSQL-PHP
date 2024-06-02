<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo base_url('api/editar_categorias'); ?>"  method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required value="<?php echo $categoriaId['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required value="<?php echo $categoriaId['description']; ?>">
                    </div>
                    <div>
                    <a href="<?php echo base_url('categorias') ?>" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary float-end">Actualizar</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $categoriaId['_id']; ?>">
            </form>
        </div>
    </div>
</div>