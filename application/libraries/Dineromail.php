<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *  Dineromail
 *  DM 1.0
 *
 *  Porting : PHP
 *  Version : 1.0.0
 *
 *  Date    : 2014-08-23
 *  Author  : Daniel
 *
 */

class Dineromail {
    
    /**
     * Carrito
     * @var type Array
     */
    private $car = array();
    
    /**
     * El Número de Cuenta asignado por dineromail
     * @var type String 
     */
    private $merchant = '1771170';    
    
    /**
     * Numero del pais 1 mexico
     * @var type String
     */
    private $country_id = '4';
    
    /**
     * Ingresa 1 para pesos, 2 para dolares
     * @var type String
     */
    private $currency = 'mxn';
    
    /**
     * Tipos de pago aseptado
     * @var type String
     */
    private $payment_method_available = 'mx_oxxo;mx_7eleven';
    
    /**
     * Meteodo de pago seleccionado por defecto
     * @var type String
     */
    private $payment_method_1 = 'mx_oxxo';
    
    /**
     * Activar redirecionamiento
     * @var type String
     */
    private $url_redirect_enabled = '1';
    private $ok_url = 'http://www.ok.com';
    private $error_url = 'http://www.exito.com';
    private $pending_url = 'http://www.pending.com';
    
    /**
     * Mi imagen del negocio se reocmiendo el uso de https
     * @var type String
     */
    private $scr_imagen = '';
    
    /**
     * Imagen del boton de pago
     * @var type String
     */
    private $boton_image = 'https://mexico.dineromail.com/imagenes/botones/pagar-medios_c.gif';

    /**
     * El servicio que expone Dineromail para enviar el formulario de pago
     * @var type String
     */
    private $url = 'https://checkout.dineromail.com/CheckOut';

    public function add_item($name, $precio, $code = '', $cantidad = 1) {
        $this->car[] = array('nombre' =>$name,
                            'precio' =>$precio*100,
                            'cantidad' =>$cantidad,
                            'codigo' =>$code
                        );
    }
    
    public function get_form() {
        $form = '<form action="'.$this->url.'" method="post">';
        
        foreach ($this->car as $key => $value) {
            $num = $key+1;
            $form .= $this->input_text('item_name_'.$num,$value['nombre']);
            $form .= $this->input_text('item_ammount_'.$num,$value['precio']);
            $form .= $this->input_text('item_quantity_'.$num,$value['cantidad']);
            $form .= $this->input_text('item_code_'.$num,$value['codigo']);
        }
        
        $form .= $this->input_text('merchant',$this->merchant);
        $form .= $this->input_text('country_id',$this->country_id);
        $form .= $this->input_text('currency',$this->currency);
        
        $form .= $this->input_text('payment_method_available',$this->payment_method_available);
        $form .= $this->input_text('payment_method_1',$this->payment_method_1);
        
        $form .= $this->input_text('url_redirect_enabled',$this->url_redirect_enabled);
        $form .= $this->input_text('ok_url',$this->ok_url);
        $form .= $this->input_text('error_url',$this->error_url);
        $form .= $this->input_text('pending_url',$this->pending_url);
        
        $form .= '<input type="image" src="'.$this->boton_image.'" border="0" name="submit" alt="Pagar con Dineromail">\n' ;
        $form .= '</form>';

        return $form;
    }
    
    private function input_text($name, $value) {
        return '<input type="text" name="'.$name.'" value="'.$value.'">';   
    }
    
    function set_ok_url($url) {
        $this->ok_url = $url;
    }
    
    function set_error_url($url) {
        $this->error_url = $url;
    }
    
    function set_pending_url($url) {
        $this->pending_url = $url;
    }
}