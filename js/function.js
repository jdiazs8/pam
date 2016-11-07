$(function() {
    $.post('modulos/especies.php').done(function(respuesta) {
        $('#especies').html(respuesta);
    });

    $('#especies').change(function() {
        var la_especie = $(this).val();

        $.post('modulos/razas.php', {especie: la_especie}).done(function(respuesta) {
            $('#razas').html(respuesta);
        });
    });
})
