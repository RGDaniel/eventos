<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');?>

<div class="container container-info">
    <div class="row div-header">
        <h1 class="col-md-12 h1-text">
            Conferencias
        </h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th width="80px">Horario</th>
                <?php $cont = 1; foreach ($salones as $value_salones) : ?>
                    <th><?php echo 'TALLER '.$cont++ ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
             <?php 
             foreach ($horarios as $key_horarios => $value_horarios) : ?>
            <tr>
                <th><?php
                        $phpdate = strtotime( $value_horarios );
                        $mysqldate = date( 'H:i A', $phpdate );
                        echo $mysqldate
                        ?>
                </th>
                <?php
                $pinte = FALSE;
                foreach ($salones as $value_salones) {
                    foreach ($todo as $key => $value_todo) {
                        $id_conf = $value_todo['id_conferencia'];
                        if($value_todo['hora_inicio'] === $value_horarios && $value_todo['nombre_salon'] === $value_salones):
                            $capa = $value_todo['capacidad'];
                            foreach ($capacidad->result() as $row) {
                                if( $id_conf == $row->id_conferencia){
                                    $capa =  $row->capacidad ;
                                    $asis =  $row->asistencia ;
                                    $insc =  $row->inscritos ;
                                }
                            }?>
                            <td>
                                <?php echo $value_todo['nombre_confe']; ?> 
                                <small class="text-grid"><?php echo $value_todo['conferencista']; ?></small><br/>
                                <small>Capacidad <?php echo $capa; ?></small><br/>
                                <small>Inscritos <?php echo $insc; ?></small><br/>
                                <small>Asistencia <?php echo $asis; ?></small>
                            </td>
                    <?php 
                        $pinte = TRUE;
                        endif;
                     } 
                    if(!$pinte){
                        echo '<td></td>';
                    }     
                }
                ?>
            </tr>
             <?php endforeach; ?>
        </tbody>
    </table>	
    
</div> 

<?php



/* End of file conferencias.php */

/* Location: /application/views/administracion/conferencias.php */ 