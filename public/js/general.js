$(document).ready(function(){
    $(document).on('submit', '#eliminararticulo', function(e){
        if(!confirm('¿Seguro que quieres borrar este artículo?')){
            e.preventDefault();
        }
    });

    $(document).on('submit', '#eliminarcategoria', function(e){
        if(!confirm('¿Seguro que quieres borrar esta categoria?')){
            e.preventDefault();
        }
    });

    $(document).on('submit', '#eliminarautor', function(e){
        if(!confirm('¿Seguro que quieres borrar este autor?')){
            e.preventDefault();
        }
    });

    if($('#contenidodiv').length > 0){
        const quill = new Quill('#contenido', {
            theme: 'snow'
        });
    
        quill.on('text-change', (delta, oldDelta, source) => {
            $("#contenidodiv").val(quill.root.innerHTML);
        });
    }
})


