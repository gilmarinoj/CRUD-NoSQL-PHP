<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center"><?php echo $articuloId['title']; ?></h1>
            <hr>
        </div>

        <div class="col-md-12">
            <?php echo html_entity_decode($articuloId['content']);  ?>
        </div>
    </div>
</div>