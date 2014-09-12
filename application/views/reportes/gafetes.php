 <?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>
<div class="container container-info">
    <div class="row div-header">
        <h1 class="col-md-12 h1-text">
            Gafetes
            <small>Imprimir por Lotes</small>
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registro por Correo electrónico</h3>
        </div>
        <?php
            echo form_open('reportes/gafetes_lote', array('name' => 'form', 'id' => 'form'));
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 form-inline">
                    <label class="control-label" for="inicio" >Inicio</label>
                    <input class="form-control" type="number" name="inicio" id="inicio" placeholder="Inicio" value="" />
                </div>
                <div class="col-md-4 form-inline">
                    <label class="control-label" for="lote" >Lote</label>
                    <input class="form-control" type="number" name="lote" id="lote" placeholder="Lote" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-inline">
                    <button class="form-control btn btn-default btn-sm" id="a_lote" >Generar</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
    
<?php

/* End of file cupones.php */

/* Location: /application/views/administracion/cupon.php */ 