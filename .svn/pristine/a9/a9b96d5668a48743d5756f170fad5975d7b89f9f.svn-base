$(document).ready(function(){

});

function URL(){
    var siteURL2 = $('body').data('siteurl');
    return siteURL2;
}

$('#correo_codigo').on('click', function(event){
    event.preventDefault();
    var me = $(this); 
    var siteURL = URL();
    var datos = $('#datos').data('datos');
    var $form = $('form').serializeArray();
    me.prop( "disabled", true );
    $form.push({'name':'id','value':datos.id});
    $.ajax({
        url: siteURL+'/administracion/participante_correo_pagado',
        data: $form,
        type: 'post',
        success: function(data){
            var data = $.parseJSON(data);
            window.alert(data.mensaje)
            me.prop( "disabled", false );
        }
    });
});

$('#correo_contactar').on('click', function(event){
    event.preventDefault();
    var me = $(this); 
    var siteURL = URL();
    var datos = $('#datos').data('datos');
    var mensaje = $('#mensaje_contactar').val();
    var $form = $('form').serializeArray();
    me.prop( "disabled", true );
    $form.push({'name':'id','value':datos.id});
    $form.push({'name':'mensaje','value':mensaje});
    $.ajax({
        url: siteURL+'/administracion/participante_correo_contactar',
        data: $form,
        type: 'post',
        success: function(data){
            var data = $.parseJSON(data);
            window.alert(data.mensaje)
            me.prop( "disabled", false );
        }
    });
});