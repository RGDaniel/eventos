 <?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>
<div class="container container-info">
    <div class="row div-header">
        <h1 class="col-md-12 h1-text">
            Listado de Cupones
            <small>Control de becas ó cupones</small>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Listado de cupones para <?php echo $nombre_cupones_gpo ?></h3> 
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?php if ($tabla->num_rows() > 0){ 
                 foreach ($tabla->result() as $row) {
                        echo $row->cupon.'<br/>';
                    }
                }
            ?>
        </div>
    </div>
</div>
    
<?php

/* End of file cupon_listado.php */

/* Location: /application/views/administracion/ajax/cupon_listado.php */ 