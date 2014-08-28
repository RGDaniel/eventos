$(document).ready(function(){

    var dan = $('#datos').data('datos');
    $('input[name="nombre"]').focus();

    if(dan.a){
        $('#aviso').modal('show');
    }

});

function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}