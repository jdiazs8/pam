$(function() {
    $.post('modulos/especies.php').done(function(respuesta) {
        console.log("Ejecuta el javascript");
        $('#especies').html(respuesta);
    });

    $('#especies').change(function() {
        var la_especie = $(this).val();
        console.log("Ejecuta el javascript");
        $.post('modulos/razas.php', {especie: la_especie}).done(function(respuesta) {
            $('#razas').html(respuesta);
        });
    });
})
