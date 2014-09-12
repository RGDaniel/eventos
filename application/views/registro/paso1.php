<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');$this->load->view('registro/navegacion');?><div class="container container-info">    <div class="row div-header">        <h1 class="col-md-12 h1-text">            CONFIGURA TU INSCRIPCIÓN            <small>Te invitamos a inscribirte.</small>        </h1>    </div>    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>        <div class="row">        <?php if($evento->registro_nuevo === TRUE): ?>        <div class="col-md-6">            <div class="panel panel-default">                <div class="panel-heading">                    <h3 class="panel-title">Nuevo registro</h3>                </div>                    <?php                    echo form_open('', array('class' => 'panel-body form-horizontal','name' => 'form_tipo', 'id' => 'form_tipo'));                    ?>                    <div class="row row-in-panel">                        <div class="col-md-4">                            <label class="control-label" for="tipo" >Usted asiste como:</label>                        </div>                        <div class="col-md-8">                            <select class="form-control" name="tipo">                                <?php foreach ($selec_tipo->result() as $row): ?>                                    <option value="<?php echo $row->id_tipo; ?>" <?php echo set_select('tipo', $row->id_tipo, ($row->id_tipo === '2')); ?> ><?php echo $row->nombre_tipo; ?></option>                                <?php endforeach; ?>                            </select>                            <input type="hidden" name='form_tipo' value='1'/>                        </div>                    </div>                    <button class="col-md-4 col-md-offset-4 btn btn-default btn-sm" type="submit">Nuevo registro</button>                </form>            </div>                    </div>        <?php endif; ?>        <?php if($evento->registro_codigo === TRUE): ?>        <div class="col-md-6">            <div class="panel panel-default">                <div class="panel-heading">                    <h3 class="panel-title">Registro con código de beca o descuento</h3>                </div>                <?php                echo form_open('', array('class' => 'panel-body form-horizontal'));                ?>                    <div class="row row-in-panel">                        <div class="col-md-4">                            <label class="control-label" for="cupon" >Código:</label>                        </div>                        <div class="col-md-8">                            <input class="form-control" placeholder="Código de beca o descuento" type="text" name="cupon" id="cupon" value="<?php echo set_value('cupon'); ?>" />                            <input type="hidden" name='form_cupon' value='1'/>                        </div>                    </div>                    <button class="col-md-4 col-md-offset-2 btn btn-default btn-sm" type="submit" >Siguiente</button>                                    </form>            </div>                </div>        <?php endif; ?>    </div></div> <?php/* End of file paso1.php *//* Location: /application/views/registro/paso1.php */ 