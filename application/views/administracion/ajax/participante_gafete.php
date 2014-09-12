<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?php echo WEBSITE_NAME; ?></title>
    <style>
        @page{
           margin: 0 0 0 0;
           size: 4in 2in;  /* width height */
        }

        .contenido {
            height: 160px;
            width:  340px;
			/*border: solid 1px;*/
        }
        .fila {
            height: auto;
            width:  auto;
        }
        .centro {
            text-align: center;
        }
        .rotar {
            margin-right: 30px;
            /* Safari */
            -webkit-transform: rotate(-180deg);
            /* Firefox */
            -moz-transform: rotate(-180deg);
            /* IE */
            -ms-transform: rotate(-180deg);
            /* Opera */
            -o-transform: rotate(-180deg);
            /* Internet Explorer */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        }
        .espacio1{
            height:  0px;
        }
        .espacio2{
            height:  5px;
        }
        .espacio3{
            height:  0px;
        }
        .nombre
        {
            text-shadow:1px 1px 1px rgba(115,115,115,1);
            font-weight:bold;
            color:#000000;
            letter-spacing:0pt;
            word-spacing:0pt;
            font-size:36px;
            text-align:center;
            font-family:helvetica, sans-serif;
            line-height:1;
            margin: 5px 0 0 0;
        }
        .apellidos
        {
            text-shadow:1px 1px 1px rgba(115,115,115,1);
            font-weight:bold;
            color:#000000;
            letter-spacing:0pt;
            word-spacing:0pt;
            font-size:20px;
            text-align:center;
            font-family:helvetica, sans-serif;
            line-height:1;
            margin: 5px 0 5px 0;
        }
		.empresa
        {
            text-shadow:1px 1px 1px rgba(115,115,115,1);
            font-weight:bold;
            color:#000000;
            letter-spacing:0pt;
            word-spacing:0pt;
            font-size:23px;
            text-align:center;
            font-family:helvetica, sans-serif;
            line-height:1;
            margin: 20px 0 0 0;
        }
		.contenedor1{
			margin: 20px 0 0 0;
		}
		.table
        {
            text-shadow:1px 1px 1px rgba(115,115,115,1);
            font-weight:bold;
            color:#000000;
            letter-spacing:0pt;
            word-spacing:0pt;
            font-size:15px;
            text-align: right;
            font-family:helvetica, sans-serif;
            line-height:1;
            margin: 0;
			right: 15px;
			position: absolute;

        }
        .codigo
        {
            /*text-shadow:1px 1px 1px rgba(115,115,115,1);*/
            font-weight:bold;
            color:#000000;
            letter-spacing:0pt;
            word-spacing:0pt;
            font-size:12px;
            text-align:center;
            font-family:helvetica, sans-serif;
            line-height:1;
            margin-top: 0px;
            margin-right: auto;
            margin-left: 5px;
            margin-bottom: 0;
		}
        .parrafos
        {
            font-weight:normal;
            color:#000000;
            letter-spacing:-1pt;
            word-spacing:-1pt;
            font-size:10px;
            text-align:left;
            font-family:verdana, sans-serif;
            line-height:1;
            margin-top: 5;
            margin-right: 0;
            margin-left: 55px;
            margin-bottom: 0; 
        }
    </style>
</head>
<body>
    <div class="contenido">
        <div class="espacio1"></div>
        <div class="fila titulos">
                <p class="nombre"><?php echo $datos->row()->nombre ?></p>
                <p class="apellidos"><?php echo trim($datos->row()->apellido_pat.' '.$datos->row()->apellido_mat); ?></p>
				<p class="empresa"><?php echo $datos->row()->empresa ?></p>
				<div class="contenedor1">
					<span class="codigo"><?php echo $id_code; ?>
					</span> <span class="table"><?php echo 'Table: '.$datos->row()->direccion ?></span>
				</div>
 				
		</div>
        <div class="espacio2"></div>
		<?php /*
        <div class="fila centro">

            <img class="" src="data:image/jpg;base64,<?php echo $codigo ?>"/>
            <p class="codigo"><?php echo $id_code; ?></p>

        </div>
        <div class="espacio3"></div>
		*/ ?>
        <?php /* if ($multi) : ?>
        <div class="fila rotar">
        <?php if ($conferencias->num_rows() > 0) : ?>
            <?php foreach ($conferencias->result() as $row) : ?>
                <p class="parrafos"><?php echo $row->nombre_confe.'<br/>'.$row->nombre_salon; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <?php endif; */?>
    </div>
</body>
</html>
<?php

/* End of file participante_gafete.php */

/* Location: /application/views/administracion/ajax/participante_gafete.php */ 