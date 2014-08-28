<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>

<tr class="fila" id="<?php echo $id ?>">
    <td class="cel1"><?php echo $contar ?></td>
    <td class="cel2"><?php echo $nombre; ?></td>
    <td class="cel3">
        <a href="<?php echo site_url('administracion/cupon/'.$id) ?>">
        Cupones
        </a>
        <a class="eliminar" id_cupon="<?php echo $id ?>" href="#">
        Eliminar
        </a>
        <a class="modificar" id_cupon="<?php echo $id ?>" href="#">
         Modificar
        </a>
    </td>
</tr>

<?php

/* End of file cupones_fila.php */

/* Location: /application/views/administracion/ajax/cupones_fila.php */ 