<?php if (!defined('BASEPATH')) exit('No direct script access allowed');/** * * Start *  * Call all statics pages * */class Registro extends MY_Controller {        /**     * Mensajes de errores      *      * @var string conteine mensaje para ser enviados como errores     * @var private     */     private $mensaje;        /**     * Array que conteine todod los datos del preregistro para transportarlos     * entre funciones     *      * @var array Conteine array con todod los cmapos del preregistro     * @var private     */     private $pre_registro_info = NULL;     /**     * Almacena el precio     *      * @var decimal a dos dijitos     * @var private     */     private $precio = NULL;         /**     * Array que conteine todod los datos del preregistro para transportarlos     * entre funciones     *      * @var boleana     * @var private     */     private $modo_editar = FALSE;        /**     * Class constructor     */    function __construct() {        parent::__construct();        // Force encrypted connection        $this->police->force_ssl();        $this->load->helper('cookie');        //Este modelo sera constantemente usado        $this->load->model('Registro_model');        $this->load->library('form_validation');        //Datos generales de la cooki        $this->datos_seccion = unserialize($this->input->cookie('info'));                //la variable evento se carga con todo la configuracion        $this->evento = $data['evento'] = $this->Registro_model->configura_evento();        $this->load->vars($data);    }        //--------------------------------------------------------------------------    /**     * Aviso de Privacidad     */    function aviso() {        $data['main_content'] = 'registro/aviso';        $this->load->view(config_item('template') . 'main', $data);    }        //-------------------------------------------------------------------------        /**     * Zona Publica     * Bienvenidoa y acuerdo de terminos y condiciones     */    function index() {//        //Genera Contraseñas        //$this->load->library('PasswordHash');        //echo $this->passwordhash->HashPassword('Cpnlac2014');        //Reglas de validdacion        delete_cookie("info");        $this->form_validation->set_rules('terminos_form', 'Terminos', 'required');        $this->form_validation->set_rules('terminosbox', 'Terminos', 'callback__acept_term');        if ($this->form_validation->run() == FALSE ) {                    $data['main_content'] = 'registro/inicio';            $this->load->view(config_item('template') . 'main', $data);        } else {            $prosedimiento = array();            $prosedimiento['terminos'] = TRUE;            $this->input->set_cookie('info', serialize($prosedimiento), 0);            redirect('registro/'.$this->_paso_siguiente('terminos'));        }    }        //--------------------------------------------------------------------------    /**     *  Validacion de fomulario personalisada para terminos     */    function _acept_term($campo){            if ($campo === '1'){                 return TRUE;            }            $this->form_validation->set_message('_acept_term', 'Acepte los términos para continuar');            return FALSE;    }        //--------------------------------------------------------------------------        /**     * Zona Publica     * Incio de Regsitro selecion de tipo     */    function paso1() {        $prosedimiento = $this->_validar_secuencia('paso1');        if($this->input->post('form_cupon') === '1'){            $tipo = '1';        }elseif ($this->input->post('form_tipo') === '1') {            $tipo = $this->input->post('tipo');        }else{            $tipo = FALSE;        }                //Inicamos reglas        $this->form_validation->set_rules('tipo', 'Tipo', '');                //logica de cachado de cosigo se existe seta validacion en true        if ($tipo === '1') {            $this->form_validation->set_rules('cupon', 'Cupón', 'callback__revisa_codigo');        }                //Se corre la validacion del Formulario        if ($this->form_validation->run() == FALSE ) {                      $data['selec_tipo'] = $this->Registro_model->tipo_participantes(FALSE, 0);            $data['main_content'] = 'registro/paso1';            $this->load->view(config_item('template') . 'main', $data);                } else {            $prosedimiento['datos_paso1']['precio'] = $this->_precio();            $prosedimiento['datos_paso1']['codigo_usado'] = $this->input->post('cupon');            $prosedimiento['datos_paso1']['id_tipo'] = $tipo;            $prosedimiento['datos_paso2'] = $this->pre_registro_info;             $prosedimiento['paso1'] = TRUE;            $this->input->set_cookie('info', serialize($prosedimiento), 0);            $this->_paso_siguiente('paso1');        }    }    //--------------------------------------------------------------------------        /**     * Funcion privada     * Revisa que el codigo este disponible y no se duploque     */    public function _revisa_codigo($cupon) {        if($this->_validacion_general(FALSE, $cupon)){            return TRUE;        }        $this->form_validation->set_message('_revisa_codigo', 'El Correo y Clave son inválidos o ya fueron usados');        return FALSE;    }    //--------------------------------------------------------------------------    /**     * Zona Publica     * Captura de datos del fromylario     */    function paso2($edicion = FALSE) {        $prosedimiento = $this->_validar_secuencia('paso2');        $this->modo_editar = $edicion;                //Reglas de validacion de los campos        $campos = $this->Registro_model->campos();        if ($campos->num_rows() > 0) {            foreach ($campos->result() as $row) {                $reglas = 'trim';                //Regla de requerido                if ($row->visible === '1' && $row->requerido === '1') {                    $reglas = '|required';                }                //Otras Reglas                switch ($row->nombre) {                    case 'correo': $reglas .= '|valid_email'; break;                    default: break;                }                $this->form_validation->set_rules($row->nombre, $row->etiqueta, $reglas);            }        }        if ($this->form_validation->run() == FALSE) {            //Comprueba que el id_tipo existe            $id_tipo = $prosedimiento['datos_paso1']['id_tipo'];            $codigo = $prosedimiento['datos_paso1']['codigo_usado'];            $this->_validacion_general($id_tipo, $codigo);            //Se entra en modo edicion            $a = FALSE;            if($this->modo_editar){                $data['texto_boton'] = 'Editar';            }else{                if(!$this->input->post() && $this->_precio() != 0 && $this->evento->cobro === '1'){                    $a = TRUE;                }                $data['texto_boton'] = 'Siguiente';            }                        $arr = array ("a"=>$a);            $data['campos'] = $this->_campos($campos);            $data['valores'] = $prosedimiento['datos_paso2'];                        $prosedimiento['datos_paso1']['precio'] = $this->_precio();            $this->input->set_cookie('info', serialize($prosedimiento), 0);            $data['precio'] = $this->_precio();                        $data['selec_anfitriones'] = $this->Registro_model->anfitriones(FALSE, '0');            $data['selec_estados'] = $this->Registro_model->estados();            $data['selec_paises'] = $this->Registro_model->paises();            $data['js_datos'] = json_encode($arr);             $data['jscript'] = array ('js/paso2.js');            $data['main_content'] = 'registro/paso2';            $this->load->view(config_item('template') . 'main', $data);        } else {            $prosedimiento['datos_paso2'] = $this->input->post(NULL, TRUE);            $prosedimiento['paso2'] = TRUE;            $this->input->set_cookie('info', serialize($prosedimiento), 0);            $this->_paso_siguiente('paso2');        }    }    //--------------------------------------------------------------------------        /**     * Zona Publica     * seleccionar conferencias     */    function paso2a($edicion = FALSE) {        $prosedimiento = $this->_validar_secuencia('paso2a');        $this->modo_editar = $edicion;        $conferencias_query = $this->Registro_model->conferencias();        $salones = $this->_titulos($conferencias_query->result_array(), 'nombre_salon');        $horarios = $this->_titulos($conferencias_query->result_array(), 'hora_inicio');         foreach ($horarios as $key_horarios => $value_horarios) {            $this->form_validation->set_rules('id'.$key_horarios, 'Conferencia', 'required');         }                if ($this->form_validation->run() == FALSE) {                            if($edicion){                $data['texto_boton'] = 'Editar';            }else{                $data['texto_boton'] = 'Siguiente';            }                        $data['capacidad'] =  $this->Registro_model->conferencias_inscritos();            $data['salones'] = $salones;            if(isset($prosedimiento['datos_paso2a'])){                $var = $prosedimiento['datos_paso2a'];            } else {                $var = array();            }            $data['valores'] = $var;            $data['horarios'] = $horarios;            $data['todo'] = $conferencias_query->result_array();            $data['main_content'] = 'registro/paso2a';            $this->load->view(config_item('template') . 'main', $data);        }else{                        $prosedimiento['datos_paso2a'] = $this->input->post(NULL, TRUE);            $prosedimiento['paso2a'] = TRUE;            $this->input->set_cookie('info', serialize($prosedimiento), 0);            $this->_paso_siguiente('paso2a');        }    }    //--------------------------------------------------------------------------        /**     * Zona Publica     * seleccionar la forma de pago y Datos de Facturacion     */    function paso3($edicion = FALSE) {        $prosedimiento = $this->_validar_secuencia('paso3');        $check_factura = FALSE;        $this->modo_editar = $edicion;                $this->form_validation->set_rules('pago', 'Tipo', '');        $this->form_validation->set_rules('factura', 'Cupon', '');        //Si es Con factura        if ($this->input->post('factura') === '1') {            $check_factura = TRUE;            $this->form_validation->set_rules('razon_social', 'Razon social', 'required');            $this->form_validation->set_rules('direccion', 'Dirección', '');            $this->form_validation->set_rules('colonia', 'Colonia', '');            $this->form_validation->set_rules('ciudad', 'Ciudad', '');            $this->form_validation->set_rules('id_estado', 'Estado', '');            $this->form_validation->set_rules('codigo_postal', 'C. Postal', '');            $this->form_validation->set_rules('rfc', 'Rfc', 'required|callback__valida_rfc');        }        if ($this->form_validation->run() == FALSE) {                        if(isset($prosedimiento['datos_paso3']) && $edicion){                $datos = $prosedimiento['datos_paso3'];                $data['texto_boton'] = 'Editar';                if($prosedimiento['datos_paso3']['factura'] === '1'){                    $check_factura = TRUE;                }            } else {                $data['texto_boton'] = 'Siguiente';                $datos = NULL;//                //Valores por defecto//                $prosedimiento['datos_paso3']['factura'] = '0';//                $prosedimiento['datos_paso3']['pago'] = '0';//                $prosedimiento['datos_paso3']['razon_social'] = '';//                $prosedimiento['datos_paso3']['direccion'] = '';//                $prosedimiento['datos_paso3']['colonia'] = '';//                $prosedimiento['datos_paso3']['ciudad'] = '';//                $prosedimiento['datos_paso3']['id_estado'] = '';//                $prosedimiento['datos_paso3']['codigo_postal'] = '';//                $prosedimiento['datos_paso3']['rfc'] = '';            }            $paso2 = $prosedimiento['datos_paso2'];            $a = isset($paso2['empresa']) ? $paso2['empresa'] : '';            $b = isset($paso2['direccion']) ? $paso2['direccion'] : '';            $c = isset($paso2['colonia']) ? $paso2['colonia'] : '';            $d = isset($paso2['ciudad']) ? $paso2['ciudad'] : '';            $e = isset($paso2['id_estado']) ? $paso2['id_estado'] : '';            $f = isset($paso2['codigo_postal']) ? $paso2['codigo_postal'] : '';            $g = $check_factura;                        $arr = array ("a"=>$a,"b"=>$b,"c"=>$c,"d"=>$d,"e"=>$e,"f"=>$f,"g"=>$g);                        $data['js_datos'] = json_encode($arr);                     $data['valores'] = $datos;            $data['selec_estados'] = $this->Registro_model->estados();                    $data['jscript'] = array('js/paso3.js');            $data['main_content'] = 'registro/paso3';            $this->load->view(config_item('template') . 'main', $data);        } else {            $prosedimiento['datos_paso3'] = $this->input->post(NULL, TRUE);            $prosedimiento['paso3'] = TRUE;                        $this->input->set_cookie('info', serialize($prosedimiento), 0);            $this->_paso_siguiente('paso3');        }    }    //--------------------------------------------------------------------------    /**     * Valida RFC     */    function _valida_rfc($rfc) {        $exp = '/^[a-zA-Z]{3,4}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[a-zA-Z0-9]{3}$/D';        if (preg_match($exp, $rfc)){             return TRUE;        }        $this->form_validation->set_message('_valida_rfc', 'RFC invalido');        return FALSE;    }        //--------------------------------------------------------------------------        /**     * Zona Publica     * Resumen de todo     */    function paso4() {        $prosedimiento = $this->_validar_secuencia('paso4');                //Campos de datos generales        $campos = $this->Registro_model->campos();        $data['campos'] = $campos = $this->_campos($campos);        $data['datos_paso2'] = $prosedimiento['datos_paso2'];                if($campos->id_anfitrion->visible === '1'){            $data['anfitrion'] = $this->Registro_model->anfitriones($prosedimiento['datos_paso2']['id_anfitrion'])->row()->nombre_anfitrion;        }        if($campos->id_pais->visible === '1'){            $data['pais'] = $this->Registro_model->paises($prosedimiento['datos_paso2']['id_pais'])->row()->nombre_pais;        }        if($campos->id_estado->visible === '1'){            $data['estado'] = $this->Registro_model->estados($prosedimiento['datos_paso2']['id_estado'])->row()->nombre_estado;        }                //Campos de conferencias        $data['multi'] = FALSE;        if($this->evento->multi_conferencia === '1'){            $data['multi'] = TRUE;            $data['datos_paso2a'] = $prosedimiento['datos_paso2a'];            $data['conferencias'] = $conferencias_query = $this->Registro_model->conferencias();        }        //Campos de datos de facturacion        $data['cobro'] = FALSE;        if($this->_precio() != 0 && $this->evento->cobro === '1'){                        $arr_pago = array('Deposito','DineroMail');            $arr_fact = array('No','Si');            $data['factura'] = $arr_fact[$prosedimiento['datos_paso3']['factura']];            $data['pago'] = $arr_pago[$prosedimiento['datos_paso3']['pago']];            $data['precio'] = $this->_precio();            $data['cobro'] = TRUE;            $data['datos_paso3'] = $prosedimiento['datos_paso3'];            $data['estado_factura'] = $this->Registro_model->estados($prosedimiento['datos_paso3']['id_estado'])->row()->nombre_estado;        }                 //Prepara para el envio        $prosedimiento['paso4'] = TRUE;        $data['jscript'] = array('js/paso4.js');        $this->input->set_cookie('info', serialize($prosedimiento), 0);        $data['main_content'] = 'registro/paso4';        $this->load->view(config_item('template') . 'main', $data);    }    //--------------------------------------------------------------------------    /**     * Zona Publica     * Resumen de todo     */    function procesar() {        $prosedimiento = $this->_validar_secuencia('procesar');                //validar nuemvenete codigo y precio desde la base de datos        $id_tipo = $prosedimiento['datos_paso1']['id_tipo'];        $codigo = $prosedimiento['datos_paso1']['codigo_usado'];        $this->_validacion_general($id_tipo, $codigo);                //id Eststus pagado        if($this->_precio() != 0 && $this->evento->cobro === '1'){            $prosedimiento['datos_paso2']['id_estatus'] = 1;            //pago con pago en linea            if($prosedimiento['datos_paso3']['pago'] === '1'){                $prosedimiento['datos_paso2']['id_estatus'] = 5;            }        } else {            $prosedimiento['datos_paso2']['id_estatus'] = 3;        }                $codigo_refe = $this->Registro_model->guarda_participante($prosedimiento, $id_tipo, $this->precio, $this->evento);                if($codigo_refe === FALSE){            $data['main_content'] = 'static/error_404';            $this->load->view(config_item('template') . 'main', $data);        }else{            $prosedimiento['procesar'] = TRUE;            $this->input->set_cookie('info', serialize($prosedimiento), 0);                        $query = $this->Registro_model->mensajes();            $paso2 = $prosedimiento['datos_paso2'];            $correo = $paso2['correo'];            $nombre = isset($paso2['nombre']) ? $paso2['nombre'] : $correo;            $ape_pa = isset($paso2['apellido_pa']) ? $paso2['apellido_pa'] : '';            $ape_ma = isset($paso2['apellido_ma']) ? $paso2['apellido_ma'] : '';            $nombre_completo = $nombre.' '.$ape_pa.' '.$ape_ma;                        $error = TRUE;            $mensaje = FALSE;            $precio_cero = FALSE;            $confe_selec = FALSE;            $data['multi'] = FALSE;            $pago_terceros = FALSE;                        if($this->evento->multi_conferencia === '1'){                $data['multi'] = TRUE;                $confe_selec = $prosedimiento['datos_paso2a'];                $data['conferencias'] = $this->Registro_model->conferencias();            }            if($this->_precio() != 0 && $this->evento->cobro === '1'){                if($prosedimiento['datos_paso3']['pago'] === '1'){                                        $this->_pago_terceros('Referencia '.$codigo_refe, $this->_precio(), $codigo_refe);                    return;                }                //Pago                $row = $query->row_array(2); //El mensaje de prepago es el numero 3 inica desde 0                $busque = array("/{pago}/","/{referencia}/");                $rempla = array($this->_precio(), $codigo_refe);                $mensaje = nl2br( preg_replace($busque,$rempla,$row['texto_mensaje']));                        } else {                $precio_cero = true;                $this->load->library('barcode');                $codigo_imagen = $this->barcode->genera_codigo( $codigo_refe ); //Imagen del Codigo de barras                                $row = $query->row_array(1); //El mensaje de confirmacion es numero 2                $mensaje = nl2br($row['texto_mensaje']);                                $data['imagen'] = $codigo_imagen;            }                        $enviado = $this->_enviar_correo($correo, $nombre_completo, $codigo_refe, $mensaje, $precio_cero, $confe_selec);//            //Enviar correo//            if($enviado)//            {//                $enviado ='Correo enviado Correctamente';//            }else{//                $enviado ='Correo no enviado reintentar mas tarde';//            }            delete_cookie("info");            $data['mensaje'] = $mensaje;            $data['nombre'] = $nombre_completo;            $data['precio_cero'] = $precio_cero;            $data['confe_selec'] = $confe_selec;            $data['codigo_refe'] = $codigo_refe;            $data['main_content'] = 'registro/satisfactorio';            $this->load->view(config_item('template') . 'main', $data);        }    }    //--------------------------------------------------------------------------        /**     * Pago porsesa cundo se envia a pagar     */    private function _pago_terceros($name_item, $precio_item, $code_item) {                $this->load->library('Dineromail');        $this->dineromail->add_item($name_item, $precio_item, $code_item);                $this->dineromail->set_ok_url(site_url('registro/respuesta/'.'ok|'.$code_item));        $this->dineromail->set_pending_url(site_url('registro/respuesta/'.'pending|'.$code_item));        $this->dineromail->set_error_url(site_url('registro/respuesta/'.'error|'.$code_item));                $data['form'] = $this->dineromail->get_form();        $data['precio'] = $precio_item;        $data['main_content'] = 'registro/pago_terceros';        $this->load->view(config_item('template') . 'main', $data);        // termina enviando a la pagina del tercero en espera de respuesta    }        function respuesta($codigo_encrypt) {        $prosedimiento = $this->_validar_secuencia('respuesta');                $codigo_array = explode("|",  urldecode($codigo_encrypt));        $tipo = $codigo_array[0];        $codigo = $codigo_array[1];        switch ($tipo) {            case 'ok': $this->_pago_terceros_pending($prosedimiento, $codigo);                break;            case 'pending': $this->_pago_terceros_pending($prosedimiento, $codigo);                break;            case 'error': $this->_pago_terceros_error($codigo);                break;        }    }        private function _pago_terceros_error ($codigo){        delete_cookie("info");        $this->Registro_model->participantes_eliminar(FALSE,$codigo);        redirect('registro/index');    }        private function _pago_terceros_pending ($prosedimiento, $codigo){        $mensajes = $this->Registro_model->mensajes();        $datos = $prosedimiento['datos_paso2'];        $correo = $datos['correo'];        $nombre = isset($datos['nombre']) ? $datos['nombre'] : $correo;        $ape_pa = isset($datos['apellido_pa']) ? $datos['apellido_pa'] : '';        $ape_ma = isset($datos['apellido_ma']) ? $datos['apellido_ma'] : '';        $nombre_completo = $nombre.' '.$ape_pa.' '.$ape_ma;        $precio_cero = FALSE;        $confe_selec = FALSE;        ////Informaren pantalla 3        ////Eneviar correo de espera de dats 3                //Preparar mensaje        $fila = $mensajes->row_array(3); //El mensaje de prepago es el numero 3 inica desde 0        $mensaje = nl2br($fila['texto_mensaje']);                delete_cookie("info");        $data['multi'] = FALSE;        $data['mensaje'] = $mensaje;        $data['nombre'] = $nombre_completo;        $data['precio_cero'] = $precio_cero;        $data['confe_selec'] = $confe_selec;        $data['codigo_refe'] = $codigo;        $data['main_content'] = 'registro/satisfactorio';        $this->load->view(config_item('template') . 'main', $data);    }            //--------------------------------------------------------------------------        /**     * Mandar Correo con info     */    function _enviar_correo($correo, $nombre_completo, $codigo_refe, $mensaje_correo, $precio_cero, $confe_selec){                //Procesar para una referencia        $to = $correo;        $subject = 'Confirmación '.$this->evento->nombre_evento;        $bound_text = "Correo";        $bound = "--" . $bound_text . "\r\n";        $bound_last = "--" . $bound_text . "--\r\n";        $headers = "From: eventus@visoconstrucciones.com\r\n";        $headers .="MIME-Version: 1.0\r\n"                . "Content-Type: multipart/mixed; boundary=\"$bound_text\"";        $message = "Si puede ver esto es que tú cliente de correos no acepta los tipos MIME!\r\n"                . $bound;        $message .="Content-Type: text/html; charset=\"utf-8\"\r\n"                . "Content-Transfer-Encoding: 7bit\r\n\r\n"                . "<div align=\"center\"><img src=\"cid:imagen\"> </div>";        if($precio_cero){            $this->load->library('barcode');            $ing_correo = $this->barcode->genera_imagen( $codigo_refe );             $message .= "<div align=\"center\">" . $codigo_refe . "</div>";        }else{            $ing_correo = base64_encode( file_get_contents('img/correo_deuda.jpg') );        }                $message .= "<div align=\"center\"><b>" . $nombre_completo . "</b></div>"                ."<div align=\"center\"><b>" . $mensaje_correo . "</b></div>";                if($this->evento->multi_conferencia === '1'){            $message .="<div align=\"center\"><b>Tus talleres seleccionados son:</b></div>";            $conferencias_query = $this->Registro_model->conferencias();            foreach ($conferencias_query->result_array() as $value) {                foreach ($confe_selec as $value_id) {                    if ($value['id_conferencia'] === $value_id) {                        $message .= '<p align="center">' . $value['nombre_confe'] . ' - ' . $value['hora_inicio'] . ' en ' . $value['nombre_salon'] . '</p>';                    }                }            }        }        $message .=" \r\n";        $message .= $bound;        $message .="Content-Type: image/gif; name=\"imagen.jpg\"\r\n"                . "Content-Transfer-Encoding: base64\r\n"                . "Content-disposition: attachment; file=\"imagen.jpg\"\r\n"                . "Content-ID: <imagen>\r\n"                . "\r\n"                . chunk_split($ing_correo)                . $bound_last;        return mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);    }    //--------------------------------------------------------------------------        /**     * Validador Genaral genera tres respuestas     *      */    function _validacion_general($id_tipo = FALSE, $cupon = FALSE) {                //Valida si un cupon es existe  y si existe y es de un prepregistro         //llena la valiable global        if($cupon){            if($this->_valida_preregsitro($cupon) || $this->_valida_cupon($cupon)){                return TRUE;            }        }        if($id_tipo){            if($this->_valida_tipo($id_tipo)){                return TRUE;            }else{                redirect('registro/index/error');                exit();            }        }        return FALSE;    }    //--------------------------------------------------------------------------        /**     * Valida preregsitro     *      */    function _valida_preregsitro($cupon) {        $usados = $this->Registro_model->cupon_usados($cupon);        $query = $this->Registro_model->pre_registro($cupon, 0);        if($usados === 0 && $query->num_rows() == 1){            $row = $query->row();            $prosedimiento = array(                'nombre' => $row->nombre,                'apellido_pa' =>$row->apellido_pat,                'apellido_ma' => $row->apellido_mat,                'cargo' => $row->cargo,                'empresa' => $row->empresa,                'direccion' => $row->direccion,                'colonia' => $row->colonia,                'ciudad' => $row->ciudad,                'id_estado' => $row->id_estado,                'otro_estado' => $row->estado_otro,                'codigo_postal' => $row->codigo_postal,                'id_pais' => $row->id_pais,                'telefono_lada' => $row->telefono_lada,                'telefono' => $row->telefono,                'telefono2' => $row->telefono_otro,                'fax' => $row->fax,                'correo' => $row->email,                'id_anfitrion' => $row->id_anfitrion,                'reconocimiento' => $row->nombre_reco,                'usado' => $row->usado            );            $this->pre_registro_info = $prosedimiento;            $this->precio = (float) $row->precio_personal;            return TRUE;        }        return FALSE;    }    //--------------------------------------------------------------------------        /**     * Valida preregsitro     *      */    function _valida_cupon($cupon) {        $cupon_info = $this->Registro_model->cupon_info($cupon);        $usados = $this->Registro_model->cupon_usados($cupon);        if($cupon_info->row('repeticiones') > $usados){            $this->pre_registro_info = NULL;            $this->precio = (float) $cupon_info->row('precio_cupon');            return TRUE;        }        return FALSE;    }    //--------------------------------------------------------------------------        /**     * Valida preregsitro     *      */    function _valida_tipo($id_tipo) {        $tipo = $this->Registro_model->tipo_participantes($id_tipo);        if ($tipo->num_rows() > 0){            $this->pre_registro_info = NULL;            $this->precio = (float) $tipo->row('precio');            return TRUE;        }        return FALSE;    }    //--------------------------------------------------------------------------        /**     * Determina el precio en decimal dependiendo independientemente de donde      * proviene     *      */    function _precio() {        if ($this->precio) {            return $this->precio;        }        if (            isset($this->datos_seccion['datos_paso1'])             && isset($this->datos_seccion['datos_paso1']['precio'])            ){            return (float) $this->datos_seccion['datos_paso1']['precio'];        }        return FALSE;    }    //--------------------------------------------------------------------------            /**     * Obteine valore sunicos de un array para procesarlos como titulos     *      */    function _campos($objeto) {        $campos = new stdClass();        if ($objeto->num_rows() > 0) {            foreach ($objeto->result() as $row) {                $campos_par = new stdClass();                $campos_par->etiqueta = $row->etiqueta;                $campos_par->visible = $row->visible;                $campos_par->requerido = $row->requerido;                $nombre = $row->nombre;                $campos->$nombre = $campos_par;            }        }        return $campos;    }    //--------------------------------------------------------------------------        /**     * Obteine valore sunicos de un array para procesarlos como titulos     *      */    function _titulos($array, $etiqueta) {        $titulos = array();        foreach ($array as $key => $value) {            $titulos[] = $value[$etiqueta];        }        return array_unique($titulos);            }    //--------------------------------------------------------------------------    /**     * Esta funcion te regresa al paso inicial con mensaje de advertencia     * en el caso que quieras brincar pasos manual mente     *      */    function _validar_secuencia($paso_actual = FALSE) {        $secuencia = $this->_pasos();                $indice = array_search($paso_actual, $secuencia, TRUE);                $prosedimiento = $this->datos_seccion;        if ($prosedimiento[$secuencia[$indice-1]] === TRUE) {            return $prosedimiento;        }        redirect('registro/index/error');    }        //--------------------------------------------------------------------------    /**     * Esta funcion te regresa al paso inicial con mensaje de advertencia     * en el caso que quieras brincar pasos manual mente     *      */    function _paso_siguiente($paso_actual = FALSE) {        if($this->modo_editar){            redirect('registro/paso4');            exit();        }                $secuencia = $this->_pasos();                $indice = array_search($paso_actual, $secuencia, TRUE);                redirect('registro/'.$secuencia[$indice+1]);    }        //--------------------------------------------------------------------------    /**     * Determina todos los paso del sistema     *      */    function _pasos() {        $pago = FALSE;        if($this->_precio() != 0 && $this->evento->cobro === '1'){            $pago = TRUE;        }                $secuencia = array();        $secuencia[] = 'terminos';        $secuencia[] = 'paso1';        $secuencia[] = 'paso2';        if($this->evento->multi_conferencia === '1'){            $secuencia[] = 'paso2a';        }        if($pago){            $secuencia[] = 'paso3';        }        $secuencia[] = 'paso4';        $secuencia[] = 'procesar';        if($pago){            //ademas tene que se pagado con tercero            $secuencia[] = 'respuesta';        }        return $secuencia;    }        //--------------------------------------------------------------------------    /**     * Display a custom error page     * Falta que lege a ceor  no pinte      * ponerlr los datos nuevos     * ajusctar correo     *      * @return A Error 404 Page     *      */    function error() {        delete_cookie("info");                $data['main_content'] = 'static/error_404';        $this->load->view(config_item('template') . 'main', $data);    }    //--------------------------------------------------------------------------}/* End of file start.php *//* Location: ./application/controllers/start.php */