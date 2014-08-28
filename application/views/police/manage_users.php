<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>

<div class="grid_12">
	<p>
		<?php var_dump( $documents )?>
	</p>
    <h1>Usuarios</h1>
    <?php 
        echo form_open( '', array( 'action' => '/police/manage_users', 'method' => 'GET' ) ); 
    ?>
        <input name="search" type="text" id="search" class="text" value="<?php echo set_value( FALSE, $search ); ?>" placeholder="Buscar por nombre, curp, codigo">
    </form>
    <input type="text" name="page" id="page" value="1" readonly="readonly">
    <input type="text" name="pages" id="pages" value="<?php echo $pages; ?>" readonly="readonly">
    <input type="text" name="perpage" id="perpage" value="<?php echo $per_page; ?>" readonly="readonly">
    <p>
        <a class='iframe1' title="Nuevo Comensal" href="<?php echo site_url('comensales/comensal_crear') ?>">
            <img class="icono32" alt="Nuevo Comensal" src="<?php echo base_url() ?>css/imagenes/icono_nuevo48.png" width="48" height="48"/>
        </a>
    </p>
    <div id="table">
    </div>
    <div id="slider" class="sp-slider-wrapper">
        <nav>
            <a href="#" class="sp-prev">Previous</a>
            <a href="#" class="sp-next">Next</a>
        </nav>
    </div>
</div> 

<?php

/* End of file manage_users.php */
/* Location: /application/views/police/manage_users.php */ 