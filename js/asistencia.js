$(document).ready(function(){

    $('input[name="buscar"]').focus();

    $( 'form' ).submit(function(event) {
        event.preventDefault();
        var $form = $('form').serialize();
        buscar($form);
    });

    $(document).on('click', 'a.gafete', function(event){
        event.preventDefault();
        var $yo = $(this);
        var url = $yo.attr('href');
        window.open(url, "", "height=900,width=340");
        asistencia($yo);
    });

    $(document).on('click', 'a.asistencia', function(event){
        event.preventDefault();
        var $yo = $(this);
        asistencia($yo);
    });

});

function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}

//Funcion que genera la tabla
function buscar($form){
        $.ajax({
            url : URL()+'/administracion/asistencia_tabla',
            data : $form,
            type : 'POST',
            success : function(resultado){
                $('#tabla').html(resultado);
            }
    });
}
function asistencia($yo){
    var $id = $yo.parent().parent().attr('id');
    var $form = $('form').serializeArray();
    $form.push({'name':'id','value':$id});
    $.ajax({
        url : URL()+'/administracion/asistencia_marcar',
        data : $form,
        type : 'POST',
        success: function(resultado) {
            var exito = Number(resultado);
            if (exito === 1) {
                $yo.parent().parent().children('td.asistencia').text('Si');
                $('input[name="buscar"]').focus();
            }
        }
    });
}

