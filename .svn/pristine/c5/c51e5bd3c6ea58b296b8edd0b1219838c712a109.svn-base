<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container container-info">
    <div class="row div-header">
        <h1 class="col-md-12 h1-text">
            ACCESO
            <small>AL PANEL DE CONTROL</small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Acceso al Panel de Control</h3>
                </div>
                <?php
                if (!isset($on_hold_mesg)) :
                    echo form_open('', array('class' => 'panel-body form-horizontal'));
                    ?>
                    <div class="row row-in-panel">
                        <div class="col-md-3">
                            <label class="control-label" for="login_string" >Usuario o correo:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="login_string" id="login_string" class="form-control" autocomplete="off" maxlength="<?php echo MAX_CHARS_4_NAME; ?>" />
                        </div>
                    </div>
                    <div class="row row-in-panel">
                        <div class="col-md-3">
                            <label class="control-label" for="login_pass" >Contraseña :</label>
                        </div>
                        <div class="col-md-7">
                            <input type="password" name="login_pass" id="login_pass" class="form-control password" autocomplete="off" maxlength="<?php echo MAX_CHARS_4_PASSWORD; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <input class="col-md-4 col-md-offset-4 btn btn-default btn-sm" type="submit" name="submit" value="Login" id="submit_button"  />                
                    </div>
                    <div class="row">
                        <?php if (config_item('allow_show_passwords')) : ?>
                            <div class="form-row">
                                <label for="show-password" class="form_label">Show Passwords</label>
                                <input type="checkbox" id="show-password" />
                            </div>
                        <?php endif; ?>
                        <?php if (config_item('allow_remember_me')): ?>
                            <div class="form-row">
                                <label for="remember_me" class="form_label">Remember Me</label>
                                <input type="checkbox" id="remember_me" name="remember_me" value="yes" />
                            </div>
                        <?php endif; ?>
                        <?php if (config_item('allow_recovery_passwords')): ?>
                            <div class="form-row">
                                    <a href="">Can't access your account?</a>
                            </div>
                       <?php endif; ?>
                    </div>
                    <?php if (isset($login_error_mesg)){
                        echo '
                        <div class="row alert alert-danger">
                            <p class="feedback_header">
                                Login Error: Invalid Username, Email Address, or Password.
                            </p>
                            <p style="margin:.4em 0 0 0;">
                                Username, email address and password are all case sensitive.
                            </p>
                        </div>';
                    }
                    if (isset($special_permission)) {
                        echo '
                        <div class="row alert alert-danger">
                            <p class="feedback_header">
                                Neseitas ingresar como administrado par tener acceso
                            </p>
                        </div>';
                    }
                    if (isset($banned)) {
                        echo '
                        <div class="row alert alert-danger">
                            <p class="feedback_header">
                                Este usuario ha sido banneado
                            </p>
                        </div>';
                    }
                    if (isset($inactivity)) {
                        echo '
                        <div c
                        ';
                    }
                    if (isset($login_multi)) {
                        echo '
                        <div class="row alert alert-danger">
                            <p class="feedback_header">
                                Otro usuario est ausando esta contraseña
                            </p>
                        </div>';
                    }
                    ?>
                    </form>
                    <?php else: ?>
                    <div class="row alert alert-danger">
                        <p class="feedback_header">
                            Excessive Login Attempts
                        </p>
                        <p style="margin:.4em 0 0 0;">
                            You have exceeded the maximum number of failed login<br />
                            attempts that the <?php echo WEBSITE_NAME; ?> website will allow.
                        <p>
                        <p style="margin:.4em 0 0 0;">
                            Your access to login and account recovery has been blocked for <?php echo ( (int) config_item('seconds_on_hold') / 60 ); ?> minutes.
                        </p>
                        <p style="margin:.4em 0 0 0;">
                            Please use the <?php echo 'Account Recovery' . ' after ' . ( (int) config_item('seconds_on_hold') / 60 ); ?> minutes has passed,<br />
                            or Contact <?php echo WEBSITE_NAME; ?>  if you require assistance gaining access to your account.
                        </p>
                    </div>
                    <?php endif; ?>
            </div>        
        </div>
    </div>
</div> 

<?php

/* End of file login_form.php */
/* Location: /application/views/police/login_form.php */ 