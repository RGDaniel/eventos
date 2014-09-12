$(document).ready(function(){
    var $form = $('form').serialize();
    
    $( '#a_gafet' ).click(function(e) {
        e.preventDefault();
        var $form = $('form').serialize();
        window.location = URL()+'/reportes/excel?'+$form;
    });

});

function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}