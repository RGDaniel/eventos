$(document).ready(function(){
    var datos = $('#datos').data('datos');
 
    if(datos.g){
        $( "#panelfactura" ).show( "normal" );
    }
 
    $( 'input[name="factura"]' ).click(function() {
        var bol = $(this).val();
        if(bol === '1'){
            $( "#panelfactura" ).show( "normal" );
        } else {
            $( "#panelfactura" ).hide( "normal" );
        }
    });
    
    $('#rellenar').click(function(){
        $( "#razon_social" ).val( datos.a );
        $( "#direccion" ).val( datos.b );
        $( "#colonia" ).val( datos.c );
        $( "#ciudad" ).val( datos.d );
        $( '#id_estado option[value="'+datos.e+'"]' ).prop('selected', true)
        $( "#codigo_postal" ).val( datos.f );
    });

});

function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}