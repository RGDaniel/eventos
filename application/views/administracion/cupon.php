 <?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>
<div class="container container-info">
    <div class="row div-header">
        <h1 class="col-md-12 h1-text">
            Cupon
            <small>Control de becas ó cupones</small>
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registro por Correo electrónico</h3>
        </div>
        <?php
            echo form_open('', array('name' => 'form', 'id' => 'form'));
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5 form-inline">
                    <input type="radio" name="tipo" id="unitario" value="unitario" checked="checked"/>
                    <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Codigo Aleatorio" value="" />
                    <button class="btn btn-default btn-sm" id="aleatorio">Aleatorio</button>
                </div>
                <div class="col-md-5 form-inline">
                    <input type="radio" name="tipo" id="serie" value="serie"/>
                    <input class="form-control" type="number" name="numero" id="numero" placeholder="Numero de Codigos" value="" disabled="disabled"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-inline">
                    <label class="control-label" for="repeticiones" >Repeticiones</label>
                    <input class="form-control" type="number" name="repeticiones" id="repeticiones" placeholder="Repeticiones" value="<?php echo set_value('repeticiones', 1); ?>" />
                </div>
                <div class="col-md-4 form-inline">
                    <label class="control-label" for="repeticiones" >Precio</label>
                    <input class="form-control" type="number" name="precio" id="precio" placeholder="Precio" value="<?php echo set_value('precio', 0); ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-inline">
                    <button class="form-control btn btn-default btn-sm" id="generar" >Generar</button>
                </div>
                <div class="col-md-4 form-inline">
                    <a class="form-control btn btn-default btn-sm" href="<?php echo site_url('administracion/cupon_listado/'.$grupo) ?>" >Listado </a>
                </div>
            </div>
        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12" id="tabla">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th width="40px">#</th>
                    <th width="120px">Cupon</th>
                    <th width="120px">Precio</th>
                    <th width="120px">Repetición</th>
                    <th width="80px">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($tabla->num_rows() > 0){ 
                 foreach ($tabla->result() as $row) {
                        $contar += 1;
                        $data['contar'] = $contar;
                        $data['id'] = $row->id_cupon;
                        $data['nombre'] = $row->cupon;
                        $data['precio'] = $row->precio_cupon;
                        $data['repeticion'] = $row->repeticiones;
                        $this->load->view('administracion/ajax/cupon_fila', $data);
                    }
                }
            ?>
            </tbody>
        </table>	
        </div>
    </div>
</div>
    
<?php

/* End of file cupones.php */

/* Location: /application/views/administracion/cupon.php */ 