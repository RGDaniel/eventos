<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>

<tr class="fila" id="<?php echo $id ?>">
    <td class="cel1"><?php echo $contar ?></td>
    <td class="cel2"><?php echo $nombre; ?></td>
    <td class="cel2"><?php echo $precio; ?></td>
    <td class="cel2"><?php echo $repeticion; ?></td>
    <td class="cel3">
        <a class="eliminar" id_cupon="<?php echo $id ?>" href="#">
        Eliminar
        </a>
    </td>
</tr>

<?php

/* End of file cupones_fila.php */

/* Location: /application/views/administracion/ajax/cupones_fila.php */ 