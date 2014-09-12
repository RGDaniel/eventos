<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>

<style  type="text/css">

    .centro {
        text-align: center;
    }

    .titulos{
        font-family: helvetica;
	font-size:16px;
        margin: 0px auto 0px auto;
        padding: 0px auto 0px auto;
        font-weight:bold;
        text-align: center;
        display: block;
    }
    .parrafos{
        font-family: arial;
	font-size:8px;
        text-align: left;
        font-weight: bold;
        margin: 0px auto 0px auto;
        padding: 0px auto 0px auto;
    }   

    
</style>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm"> 
    <table class="cuerpo" border="0" style="page-break-after:avoid">
        <tr>
            <td style="height: 55px;">&nbsp;</td>
        </tr>
        <tr>
            <td class="centro" style="width: auto; height: 40px;"><img class="" src="data:image/jpg;base64,<?php echo $codigo ?>"/></td>
        </tr>
        <tr>
            <td class="centro" style="height: auto; vertical-align:middle"><?php echo $datos->row()->nombre.' '.$datos->row()->apellido_pat; ?></td>
        </tr>
        <tr>
            <td style="height: 330px; vertical-align:middle"></td>
        </tr>
                <tr>
                    <td class="parrafos" style="height: 10px;">
        <?php if ($conferencias->num_rows() > 0) : ?>
            <?php foreach ($conferencias->result() as $row) : ?>
                        <div style="rotate: 180;"><?php echo $row->nombre_confe.', Salón '.$row->nombre_salon; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
                    </td>
                </tr>
    </table>
</page>

<?php

/* End of file participante_gafete.php */

/* Location: /application/views/administracion/pdf/participante_gafete.php */ 