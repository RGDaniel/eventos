<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

$this->load->view('registro/navegacion');
?>
<div class="container">
    <div class="row div-header">
        <h1 class="col-md-12 h1-text">
            PAGO MEDIANTE DINEROMAIL
        </h1>
    </div> 
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pago Seguro mediantes DineroMail</h3>
        </div>
        <div class="panel-body form-horizontal">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $form ?>
                </div>
            </div>
        </div>
    </div>   

    
</div>
<div id="datos" style="display: none" data-datos='<?php echo $js_datos ?>'> </div>

<?php

/* End of file pago.php */

/* Location: /application/views/registro/pago.php */ 