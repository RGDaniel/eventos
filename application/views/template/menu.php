<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');if( isset($documents) ) : ?>    <nav class="container navbar navbar-default" role="navigation">  <div class="container-fluid">    <!-- Brand and toggle get grouped for better mobile display -->    <div class="navbar-header">      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">        <span class="sr-only">Menú</span>        <span class="icon-bar"></span>        <span class="icon-bar"></span>        <span class="icon-bar"></span>      </button>      <a class="navbar-brand" href="<?php echo site_url('registro')?>">Inicio</a>    </div>    <!-- Collect the nav links, forms, and other content for toggling -->    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      <ul class="nav navbar-nav">        <li class="<?php if(isset($part)){echo $part;} ?>"><a href="<?php echo site_url('administracion') ?>">Participantes</a></li><?php /*        <li class="<?php if(isset($pres)){echo $pres;} ?>"><a href="<?php echo site_url('administracion/presparticipantes') ?>">Pres participantes</a></li> */?>        <li class="<?php if(isset($asis)){echo $asis;} ?>"><a href="<?php echo site_url('administracion/asistencia') ?>">Asistencia</a></li>                <?php if ($evento->multi_conferencia === '1'): ?>        <li class="<?php if(isset($conf)){echo $conf;} ?>"><a href="<?php echo site_url('administracion/conferencias') ?>">Conferencias</a></li>        <?php endif; ?>                <li class="<?php if(isset($cupo)){echo $cupo;} ?>"><a href="<?php echo site_url('administracion/cupones') ?>">Cupones</a></li>        <li class="<?php if(isset($repo)){echo $repo;} ?>"><a href="<?php echo site_url('reportes') ?>">Reportes</a></li>        <?php /* if(in_array("8", $permisos, true) OR $idUs === 1): ?><li class=""><a href="<?php echo site_url('administracion/reportes') ?>">Reportes</a></li><?php endif; ?>        <?php if(in_array("8", $permisos, true) OR $idUs === 1): ?><li class=""><a href="<?php echo site_url('administracion/reportes') ?>">Reportes</a></li><?php endif; */ ?>                <?php /* if(array_intersect( array ( 1 , 2 ) , $documents->permissions ) ): */?>        <li class="dropdown">          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Panel de Control <b class="caret"></b></a>          <ul class="dropdown-menu">            <li><a href="#<?php //echo site_url('users/myprofile'); ?>">Evento</a></li>            <li><a href="#<?php //echo site_url('users/myprofile'); ?>">Precios</a></li>            <li class="divider"></li>            <li><a href="#<?php // echo site_url('users/manage_users'); ?>">Admi de Usuarios</a></li>          </ul>        </li>        <?php /* endif; */?>      </ul>      <ul class="nav navbar-nav navbar-right">        <li><a href="<?php echo site_url('users/logout')?>">Salir</a></li>      </ul>    </div><!-- /.navbar-collapse -->  </div><!-- /.container-fluid --></nav><?php endif;/* End of file menu.php *//* Location: /application/views/template/menu.php */ 