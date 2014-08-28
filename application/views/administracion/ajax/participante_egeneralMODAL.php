<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>





              <button type="button" class="btn" data-toggle="modal" data-target="#editModal" data-remote="<?php echo site_url('administracion/participante_egeneral/'.$row->id_participante) ?>">
                        Editar G
                    </button>






  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">

<div class="container">
            <div class="row">
                <label for="direccion" class="col-md-3 control-label"> Clave de agente:</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value('direccion', $datos->row()->direccion); ?>" />
                    <?php echo form_error('direccion', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>           
            <div class="form-group">
                <label class="col-md-3 control-label" for="nombre" ><span class="glyphicon glyphicon-star"></span> Nombre:</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo set_value('nombre', $datos->row()->nombre); ?>" />
                    <?php echo form_error('nombre', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="apellido_pa" ><span class="glyphicon glyphicon-star"></span> Apellidos:</label>
                <div class="col-md-3">
                    <input class="col-md-4 form-control" type="text" name="apellido_pa" id="apellido_pa" placeholder="Apellido Paterno" value="<?php echo set_value('apellido_pa', $datos->row()->apellido_pat); ?>" />
                    <?php echo form_error('apellido_pa', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

                <?php /*
                <div class="col-md-3">
                    <input class="col-md-4 form-control" type="text" name="apellido_ma" id="apellido_ma" placeholder="Apellido Materno" value="<?php echo set_value('apellido_ma', $valores['apellido_ma']); ?>" />
                    <?php echo form_error('apellido_ma', '<div class="bg-danger">', '</div>'); ?>
                </div> 
            </div>
            <div class="form-group">
                <label for="cargo" class="col-md-3 control-label"><span class="glyphicon glyphicon-star"></span> Director:</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="cargo" id="cargo" value="<?php echo set_value('cargo', $valores['cargo']); ?>" />
                    <?php echo form_error('apellido_ma', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>
                 */?>

            <div class="form-group">
                <label for="empresa" class="col-md-3 control-label"> Promotoría / Empresa:</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="empresa" id="empresa" value="<?php echo set_value('empresa', $datos->row()->empresa); ?>" />
                    <?php echo form_error('empresa', '<div class="bg-danger">', '</div>'); ?>
                </div>
                <div class="col-md-4 control-label-x">
                    <span>Si eres agente independiente dejar vacío.</span>
                </div>
            </div>

            <div class="form-group">
                <label for="anfitrion" class="col-md-3 control-label"><span class="glyphicon glyphicon-star"></span> Invitado por:</label>
                <div class="col-md-4">
                    <select class="form-control" name="id_anfitrion">
                        <option value="" <?php echo set_select('id_anfitrion', '', TRUE); ?>>Seleccione uno</option>
                        <?php foreach ($selec_anfitriones->result() as $row): ?>
                            <option value="<?php echo $row->id_anfitrion; ?>" <?php echo set_select('id_anfitrion', $row->id_anfitrion, ( $row->id_anfitrion === $datos->row()->id_anfitrion)); ?> ><?php echo $row->nombre_anfitrion; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_anfitrion', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <?php 
            /*
            <div class="form-group">
                <label for="direccion" class="col-md-3 control-label"> Clave de agente:</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value('direccion', $valores['direccion']); ?>" />
                    <?php echo form_error('direccion', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="colonia" class="col-md-2 control-label">Colonia:</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" name="colonia" id="colonia" value="<?php echo set_value('colonia', $valores['colonia']); ?>" />
                    <?php echo form_error('colonia', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="ciudad" class="col-md-2 control-label">Ciudad:</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" name="ciudad" id="ciudad" value="<?php echo set_value('ciudad', $valores['ciudad']); ?>" />
                    <?php echo form_error('ciudad', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="pais">País:</label>
                <div class="col-md-4">
                    <select class="form-control" name="pais">
                        <option value="" <?php echo set_select('pais', '', TRUE); ?>></option>
                        <?php foreach ($selec_paises->result() as $row): ?>
                            <option value="<?php echo $row->id_pais; ?>" <?php echo set_select('pais', $row->id_pais, ($row->id_pais === '148')); ?> ><?php echo $row->nombre_pais; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('pais', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="estado" class="col-md-2 control-label">Estado:</label>
                <div class="col-md-4">
                    <select class="form-control" name="estado">
                        <option value="" <?php echo set_select('estado', '', TRUE); ?>></option>
                        <?php foreach ($selec_estados->result() as $row): ?>
                            <option value="<?php echo $row->id_estado; ?>" <?php echo set_select('estado', $row->id_estado, ($row->id_estado === '19')); ?> ><?php echo $row->nombre_estado; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('estado', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="otro_estado" class="col-md-2 control-label">Otro Estado:</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="otro_estado" id="otro_estado" value="<?php echo set_value('otro_estado', $valores['otro_estado']); ?>" />
                    <?php echo form_error('otro_estado', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="codigo_postal" class="col-md-2 control-label">Código Postal:</label>
                <div class="col-md-2">
                    <input class="form-control" type="text" name="codigo_postal" id="codigo_postal" value="<?php echo set_value('codigo_postal', $valores['codigo_postal']); ?>" />
                    <?php echo form_error('codigo_postal', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>
              */?>

            <div class="form-group">
                <label for="telefono_lada" class="col-md-3 control-label"><span class="glyphicon glyphicon-star"></span> Teléfono con lada:</label>
                <?php /*
                <div class="col-md-2">
                    <input class="form-control" placeholder="LADA" type="text" name="telefono_lada" id="telefono_lada" value="<?php echo set_value('telefono_lada', $valores['telefono_lada']); ?>" />
                    <?php echo form_error('telefono_lada', '<div class="bg-danger">', '</div>'); ?>
                </div>
                */?>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo set_value('telefono', $datos->row()->telefono); ?>" />
                    <?php echo form_error('telefono', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>
            
            <?php /*
            <div class="form-group">
                <label for="telefono2" class="col-md-2 control-label">Teléfono 2:</label>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="telefono2" id="telefono2" value="<?php echo set_value('telefono2', $valores['telefono2']); ?>" />
                    <?php echo form_error('telefono2', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="fax" class="col-md-2 control-label">Fax:</label>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="fax" id="fax" value="<?php echo set_value('fax', $valores['fax']); ?>" />
                    <?php echo form_error('fax', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>
              */?>

            <div class="form-group">
                <label for="correo" class="col-md-3 control-label"><span class="glyphicon glyphicon-star"></span> Corre electrónico:</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="correo" id="correo" value="<?php echo set_value('correo', $datos->row()->correo); ?>" />
                    <?php echo form_error('correo', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>
            
            <?php /*
            <div class="form-group bg-warning">
                <label for="reconocimiento" class="col-md-2 control-label">Nombre a poner en el reconocimiento:</label>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="reconocimiento" id="reconocimiento" value="<?php echo set_value('reconocimiento', $valores['reconocimiento']); ?>" />
                    <?php echo form_error('reconocimiento', '<div class="bg-danger">', '</div>'); ?>
                </div>
            </div>
              */?>
            <button class="col-md-4 col-md-offset-4 btn btn-default btn-sm" type="submit">Guardar</button>

            <p>
                
                
                
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                wefwefwefewfwefwefewfw
                
                
                
                
                
            </p>
            
    </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>


<?php

/* End of file participante_egeneral.php */

/* Location: /application/views/administracion/ajax/participante_egeneral.php */ 