<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>

<table class="table table-striped">
    <thead>
        <tr>
            <th width="40px">#</th>
            <th width="120px">Nombre del Grupo</th>
            <th width="80px">Acción</th>
        </tr>
    </thead>
    <tbody>
        <tr class="fila" id="nuevo">
            <td class="cel3">Nuevo</td>
            <td class="cel3">
                <input class="form-control" type="text" name="gpo_cupon" id="gpo_cupon" placeholder="Nombre del Grupo Cupon" value="" />
            </td>
            <td class="cel3">
                <a class="btn btn-default" id="agregar" href="#">Agregar</a>
            </td>
        </tr>
    <?php if ($tabla->num_rows() > 0){ 
         foreach ($tabla->result() as $row) {
                $contar += 1;
                $data['id'] = $row->id_cupones_gpo;
                $data['nombre'] = $row->nombre_cupones_gpo;
                $data['contar'] = $contar;
                $this->load->view('administracion/ajax/cupones_fila', $data);
            }
        }
    ?>
    </tbody>
</table>	
<?php

/* End of file cupones_tabla.php */

/* Location: /application/views/administracion/ajax/cupones_tabla.php */ 