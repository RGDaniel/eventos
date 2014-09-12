$(document).ready(function(){
    var $busca = $('#buscar').val();
    var $pagina = $('#pagina').val();
    var $porPagina = $('#porPagina').val();
    
    buscar($busca,$pagina,$porPagina);
});


//Funcion del paginador
$(function() {

    var paginas = $("#paginas").val();
    var $update = $('#pagina');
    var $busca = $('#buscar').val();
    var $porPagina = $('#porPagina').val();

    $("#slider").pagination( {
        total : paginas,
        onChange : function( value ) {
            $update.val(value);
            buscar($busca,value,$porPagina);
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
    } );
});

function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}

//Funcion que genera la tabla
function buscar($busca,$pagina,$porPagina){
    $.ajax({
            url : URL()+'/comensales/comensales_tabla',
            data : {
                    buscar : $busca,
                    pagina : $pagina,
                    porPagina : $porPagina,
                    token : $porPagina
                    },
            type : 'POST',
            success : function(resultado){
                $('#tabla').html(resultado);
            }
    })
}