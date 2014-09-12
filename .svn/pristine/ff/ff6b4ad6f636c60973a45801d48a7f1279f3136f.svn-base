$(document).ready(function(){
    var $form = $('form').serialize();

    $( 'select' ).change(function() {
        var $form = $('form').serialize();
        buscar($form);
    });

    buscar($form);
});

function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}

//Funcion que genera la tabla
function buscar($form){
        $.ajax({
            url : URL()+'/administracion/cupones_tabla',
            data : $form,
            type : 'POST',
            success : function(resultado){
                $('#tabla').html(resultado);
            }
    });
}

//funciones de CRUD
$('#tabla').on('click', '#agregar', function(event){
    event.preventDefault();
    var siteURL = URL();
    var fila = $(this).parent().parent();
    var nombre = fila.children('td').children('input[name="gpo_cupon"]');
    var nombreValue = nombre.val();
    var $form = $('form').serialize();
    
    if (nombreValue !== ""){
        $.ajax({
            url: siteURL+'/administracion/cupones_gpos/id/'+nombreValue,
            data: $form,
            type: 'post',
            success: function(data){
                //JSON.parse(data);
                debugger;
                var data = $.parseJSON(data);
                var fila;
                $( "#nuevo" ).after( data.html );
            }
        });
}
});
$('#tabla').on('click', '.eliminar', function(event){
    event.preventDefault();
    var siteURL = URL();
    var fila = $(this).parent().parent();
    var nombre = fila.children('td').children('input[name="gpo_cupon"]');
    var id = $(this).attr( "id_cupon" );
    var nombreValue = nombre.val();
    var $form = $('form').serialize();
    $.ajax({
        url: siteURL+'/administracion/cupones_gpos/'+id,
        data: $form,
        type: 'delete',
        success: function(data){
            var data = $.parseJSON(data);
            if(data.estatus === true){
                fila.remove();
            }
        }
    });
    
});
$('#tabla').on('click', '.modificar', function(event){
    event.preventDefault();
    var siteURL = URL();
    var fila = $(this).parent().parent();
    var nombre = fila.children('td.cel2').text();
    
    var input = '<input class="form-control"'+
                'type="text"'+
                'placeholder="Nombre del Grupo Cupon"'+
                'value="'+nombre+'" />';
    
    fila.children('td.cel2').html(input);
    fila.children('td.cel3').children('a.modificar').text('Guardar');
    fila.children('td.cel3').children('a.modificar').removeClass( "modificar" ).addClass( "guardar" );;
});
$('#tabla').on('click', '.guardar', function(event){
    event.preventDefault();
    var siteURL = URL();
    var fila = $(this).parent().parent();
    var id = $(this).attr( "id_cupon" );
    var nombre = fila.children('td.cel2').children('input').val();
    var $form = $('form').serialize();
    $.ajax({
        url: siteURL+'/administracion/cupones_gpos/'+id+'/'+nombre,
        data: $form,
        type: 'put',
        success: function(data){
            debugger;
            var data = $.parseJSON(data);
            if(data.estatus === true){
                fila.children('td.cel2').html(nombre);
                fila.children('td.cel3').children('a.guardar').text('Modificar');
                fila.children('td.cel3').children('a.guardar').removeClass( "guardar" ).addClass( "modificar" );
            }
        }
    });
});

