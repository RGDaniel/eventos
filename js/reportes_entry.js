$(document).ready(function(){
    var $form = $('form').serialize();
    
//    var $pagina = $('#pagina').val();
//    var $porPagina = $('#porPagina').val();
//var data = $(this).serializeArray(); // convert form to array
//data.push({name: "NonFormValue", value: NonFormValue});
//alert($form+'&'+$('#pagina').serialize());

    $( 'input' ).change(function() {
        var $form = $('form').serialize();
        buscar($form);
    });

    $( '#a_excel' ).click(function(e) {
        e.preventDefault();
        var $form = $('form').serialize();
        window.location = URL()+'/reportes/excel?'+$form;
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
            url : URL()+'/reportes/entry_table',
            data : $form,
            type : 'POST',
            success : function(resultado){
                $('#tabla').html(resultado);
            }
    });
}