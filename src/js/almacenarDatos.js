$(document).ready(function () {
    $('#form').submit(function (e) { 
        e.preventDefault();
        var data = $('#form').serialize();
        $.ajax({
            type: "POST",
            url: "src/php/almacenarDatos.php",
            data: data,
            dataType: "json",
            success: function (response) {
                $('#respuesta').html('<div class="'+response.alerta+'" role="alert">'+response.mensaje+'</div>');
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                console.log("Status:", status);
                console.log("Response:", xhr.responseText);
            }
        });
    });
    
});