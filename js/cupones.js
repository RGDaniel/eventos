$(document).ready(function(){
    var $form = $('form').serialize();
    
//    var $pagina = $('#pagina').val();
//    var $porPagina = $('#porPagina').val();
//var data = $(this).serializeArray(); // convert form to array
//data.push({name: "NonFormValue", value: NonFormValue});
//alert($form+'&'+$('#pagina').serialize());

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

//Funcion del paginador
//$(function() {
//
////    var paginas = $("#paginas").val();
////    var $update = $('#pagina');
////    var $busca = $('#buscar').val();
////    var $porPagina = $('#porPagina').val();
//
//    $("#slider").pagination( {
//        total : paginas,
//        onChange : function( value ) {
//            $update.val(value);
//            buscar($busca,value,$porPagina);
//            $("html, body").animate({ scrollTop: 0 }, "slow");
//        }
//    } );
//});

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