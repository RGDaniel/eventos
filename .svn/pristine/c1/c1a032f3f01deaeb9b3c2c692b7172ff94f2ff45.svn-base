<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Libreria unica de Registro

class Resgitro_library {
	
	/**
	 * Class constructor
	 */
	function __construct(){
            $this->CI =& get_instance();
            
            $this->CI->load->model('Registro_model');
            $this->evento = $this->CI->Registro_model->configura_evento();


	}
    
    function enviar_registro($correo, $nombre_completo, $codigo_refe, $mensaje_correo, $precio_cero, $confe_selec){
        //Procesar para una referencia
        $message = "<div align=\"center\"><img src=\"cid:imagen\"> </div>";
        
        if($precio_cero){
            $this->CI->load->library('barcode');
            $ing_correo = $this->CI->barcode->genera_imagen( $codigo_refe ); 
            $message .= "<div align=\"center\">" . $codigo_refe . "</div>";
        }else{
            $ing_correo = base64_encode( file_get_contents('img/correo_deuda.jpg') );
        }
        
        $message .= "<div align=\"center\"><b>" . $nombre_completo . "</b></div>"
                ."<div align=\"center\"><b>" . $mensaje_correo . "</b></div>";
        
        if($this->evento->multi_conferencia === '1'){
            $message .="<div align=\"center\"><b>Tus talleres seleccionados son:</b></div>";
            $conferencias_query = $this->CI->Registro_model->conferencias();
            foreach ($conferencias_query->result_array() as $value) {
                foreach ($confe_selec as $value_id) {
                    if ($value['id_conferencia'] === $value_id) {
                        $message .= '<p align="center">' . $value['nombre_confe'] . ' - ' . $value['hora_inicio'] . ' en ' . $value['nombre_salon'] . '</p>';
                    }
                }
            }
        }

        $message .=" \r\n";
        $message .="--Correo\r\n";
        $message .="Content-Type: image/gif; name=\"imagen.jpg\"\r\n"
                . "Content-Transfer-Encoding: base64\r\n"
                . "Content-disposition: attachment; file=\"imagen.jpg\"\r\n"
                . "Content-ID: <imagen>\r\n"
                . "\r\n"
                . chunk_split($ing_correo)
                . "--Correo--\r\n";

        return $this->evniar_correo($correo, $message);
    }
    
    function enviar_contactar($correo, $nombre_completo, $mensaje_correo){

        $message = "<div align=\"left\"><b>Saludos " . $nombre_completo . "</b></div>"
                ."<div align=\"left\">" . $mensaje_correo . "</div>";
       
        $message .=" \r\n";
        $message .="--Correo\r\n"
                 . "--Correo--\r\n";

        return $this->evniar_correo($correo, $message);
    }
    
    private function evniar_correo($correo, $contenido) {
        $to = $correo;
        $subject = 'Confirmación '.$this->evento->nombre_evento;
        $headers = "From: eventus@visoconstrucciones.com\r\n"
                ."MIME-Version: 1.0\r\n"
                . "Content-Type: multipart/mixed; boundary=\"Correo\"";
        $message = "Si puede ver esto es que tú cliente de correos no acepta los tipos MIME!\r\n"
                . "--Correo\r\n"
                . "Content-Type: text/html; charset=\"utf-8\"\r\n"
                . "Content-Transfer-Encoding: 7bit\r\n\r\n";

        $message .= $contenido;

        return mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
    }
    
}	
// END Resgitro_Utils CLASS

/* End of file Resgitro_Utils.php */

/* Location: ./application/libraries/Resgitro_Utils.php */