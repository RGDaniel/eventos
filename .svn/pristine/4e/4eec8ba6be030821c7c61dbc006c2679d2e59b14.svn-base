$(document).ready(function(){
    
    $( 'input[name="tipo"]' ).click(function() {
        var val = $(this).val();
        if(val === 'unitario'){
            $( "#codigo" ).prop( "disabled", false );
            $( "#aleatorio" ).prop( "disabled", false );
            $( "#numero" ).prop( "disabled", true );
        } else if (val === 'serie'){
            $( "#codigo" ).prop( "disabled", true );
            $( "#aleatorio" ).prop( "disabled", true );
            $( "#numero" ).prop( "disabled", false );
        }
    });

});

$('#tabla').on('click', '.eliminar', function(event){
    event.preventDefault();
    var siteURL = URL();
    var fila = $(this).parent().parent();
    var nombre = fila.children('td').children('input[name="gpo_cupon"]');
    var id = $(this).attr( "id_cupon" );
    var nombreValue = nombre.val();
    var $form = $('form').serialize();
//    $.ajax({
//        url: siteURL+'/administracion/cupones_gpos/'+id,
//        data: $form,
//        type: 'delete',
//        success: function(data){
//            var data = $.parseJSON(data);
//            if(data.estatus === true){
//                fila.remove();
//            }
//        }
//    });
    
});

$('#form').submit(function(event){
//    event.preventDefault();
//    var siteURL = URL();
//    var fila = $(this).parent().parent();
//    var id = $(this).attr( "id_cupon" );
//    var nombreValue = nombre.val();
//    var $form = $('form').serializeArray();
//    me.prop( "disabled", true );
//    $form.push({'name':'id','value':datos.id});
////    $.ajax({
////        url: siteURL+'/administracion/cupones_gpos/'+id,
////        data: $form,
////        type: 'delete',
////        success: function(data){
////            var data = $.parseJSON(data);
////            if(data.estatus === true){
////                fila.remove();
////            }
////        }
////    });
    
});


function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}