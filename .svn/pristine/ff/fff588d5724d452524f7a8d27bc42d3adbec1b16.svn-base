<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

$this->load->view('registro/navegacion');
?>
<div class="container">
    <div class="row div-header">
        <h1 class="col-md-12 h1-text">
            SISTEMA
            <small>CONFIGURACIÓN DE DATOS DEL SISTEMA</small>
        </h1>
    </div> 
    <div class="row">
        <p class="col-md-12">
        </p>
    </div> 

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Correo</h3>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <label class="col-md-12">Correo de comunicación con el participante :</label>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <textarea class="form-control" rows="7" id="mensaje_contactar"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="control-label btn btn-default btn-sm" id="correo_contactar">Enviar</button>
                </div>
            </div>
        </div>
    </div>            

    <?php
    echo form_open('', array('name' => 'form', 'id' => 'form'));
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Datos Sistema</h3>
        </div>
        <div class="panel-body form-horizontal">
            <div class="form-group">
                <label class="col-md-2 control-label" for="id_tipo">Estatus:</label>
                <div class="col-md-4">
                    <select class="form-control" name="id_esta" id="id_esta">
                        <?php foreach ($estatus->result() as $row): ?>
                            <option value="<?php echo $row->id_estatus; ?>" <?php echo set_select('id_esta', $row->id_estatus , ( $row->id_estatus === $estatus_par)); ?> ><?php echo $row->nombre_estatus; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <button class="control-label btn btn-default btn-sm" id="correo_codigo">Enviar Codigo de Barras</button>
                </div>
            </div>
        </div>
    </div>            
    <button class="col-md-4 col-md-offset-4 btn btn-default btn-sm" type="submit">Editar</button>
    </form>
    
</div>
<div id="datos" style="display: none" data-datos='<?php echo $js_datos ?>'> </div>

<?php

/* End of file participante_sistema.php */

/* Location: /application/views/administracion/ajax/participante_sistema.php */ 