<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>

<table class="table table-striped">
    <thead>
        <tr>
            <th width="40px">#</th>
            <th width="40px">Codigo</th>
            <th width="120px">Nombre</th>
            <th width="80px">Estatus</th>
            <th width="40px">Asistencia</th>
            <th width="80px">Acción</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($tabla->num_rows() > 0) : ?>
        <?php foreach ($tabla->result() as $row) : 
            $contar += 1;
            ?>
            <tr class="fila" id="<?php echo $row->id_participante; ?>">
                <td><?php echo $contar ?></td>
                <td class="cel3"><?php echo $row->codigo_barras; ?></td>
                <td class="cel3"><?php echo $row->nombre.' '.$row->apellido_pat; ?></td>
                <td class="cel3"><?php echo $row->nombre_estatus; ?></td>
                <td class="asistencia"><?php echo ($row->asistencia ? 'Si' : 'No'); ?></td>
                <td class="cel3">
                    <a class="asistencia" href="">
                        Asistencia
                    </a>
                    <a class="gafete" href="<?php echo site_url('administracion/participante_gafete/'.$row->id_participante) ?>">
                        Gafete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>	
<?php

/* End of file tabla_participantes.php */

/* Location: /application/views/administracion/ajax/tabla_participantes.php */ 