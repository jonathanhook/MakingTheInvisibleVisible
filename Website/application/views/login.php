<div class="jumbotron">
  <h1>Login</h1>
  <p class="lead">Please enter your username and password to login.</p>

  <div>
    <div class="row login_container">

      <?php if(validation_errors() || isset($login_failed)): ?>
        <?php if(isset($login_failed)): ?>
          <p class="login_error">Login details are incorrect, ensure you have entered them correctly.</p>
        <?php endif;?>
      <?php endif; ?>

      <?php if($this->session->flashdata('logged_out')): ?>
        You've been logged out
      <?php endif; ?>

      <?php echo form_open("login", array('class' => 'form-horizontal'));?>

      <div class="control-group <?php echo (form_error('identity')) ? 'error' : '';?>">
        <label class="control-label" for="identity">Username</label>
        <div class="controls">
          <input class="login_input" type="text" id="identity" name="identity" placeholder="Enter username or email" value="<?php echo set_value('identity'); ?>">
        </div>
      </div>

      <div class="control-group <?php echo (form_error('password')) ? 'error' : '';?>">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
          <input class="login_input" type="password" id="password" name="password" placeholder="Enter password" value="<?php echo set_value('password');?>">
        </div>
      </div>

      <div class="control-group login_checkbox">
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
      
      <?php echo form_close(); ?>

    </div>
  </div>
</div>
