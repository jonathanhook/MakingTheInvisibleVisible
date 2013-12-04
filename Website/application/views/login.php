<div class="jumbotron">
  <h1>Login</h1>
  <p class="lead">Please enter your username and password to login.</p>

  <div>
    <div class="row" style="text-align:left; margin:auto; width:50%">

        <?php if(validation_errors() || isset($login_failed)): ?>
          <?php if(isset($login_failed)): ?>
            <p style="color: red;">Login details are incorrect, ensure you have entered them correctly.</p>
          <?php endif;?>
        <?php endif; ?>

        <?php if($this->session->flashdata('logged_out')): ?>
          You've been logged out
        <?php endif; ?>
        <?php //echo validation_errors(); ?>
        <?php echo form_open("login", array('class' => 'form-horizontal'));?>
        <!--<fieldset>-->
          <div class="control-group <?php echo (form_error('identity')) ? 'error' : '';?>">
            <label class="control-label" for="identity">Username</label>
            <div class="controls">
              <input style="width:100%" type="text" id="identity" name="identity" placeholder="Enter username or email" value="<?php echo set_value('identity'); ?>">
            </div>
          </div>

          <div class="control-group <?php echo (form_error('password')) ? 'error' : '';?>">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
              <input style="width:100%" type="password" id="password" name="password" placeholder="Enter password" value="<?php echo set_value('password');?>">
            </div>
          </div>

          <div class="control-group" style="line-height:22px; padding: 15px 15px 15px 0px;">
            <div class="controls">
              <label class="checkbox">
                <input type="checkbox" name="remember">
                <span>Remember</span>
              </label>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn btn-success">Login</button>
            </div>
          </div>
        <!--</fieldset>-->
        <?php echo form_close(); ?>
    </div>
  </div>
</div>
