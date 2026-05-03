$(function () {
    
    $("#btnGuardar").click(function(event){
        console.log("Entró!");
        let cantidad = parseInt($("#cantidadStock").val());
        let precio = parseFloat($("#precio").val());

        if(cantidad < 0){
            mostrarMensaje("Cantidad debe ser mayor o igual a 0","danger");
            event.preventDefault();
            return;
        }

        if(precio <= 0){
            mostrarMensaje("Precio debe ser mayor a 0","danger");
            event.preventDefault();
            return;
        } 
    });

    //Mostrar mensaje
    function mostrarMensaje(texto, tipo)
    {
        $("#mensaje")
            .html(texto)
            .removeClass()
            .addClass("alert alert-" + tipo)
            .hide()
            .fadeIn();
    }



});
