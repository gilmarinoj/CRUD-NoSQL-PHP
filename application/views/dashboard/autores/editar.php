<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo base_url('api/editar_autores'); ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required value="<?php echo $autorId['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo $autorId['email']; ?>">
                </div>
                <div class="mb-3">
                        <label for="biografia" class="form-label">Biografia</label>
                        <textarea class="form-control" id="biografia" name="biografia" rows="3"></textarea>
                    </div>
                <div>
                    <a href="<?php echo base_url('autores') ?>" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary float-end">Actualizar</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $autorId['_id']; ?>">
            </form>
        </div>
    </div>
</div>