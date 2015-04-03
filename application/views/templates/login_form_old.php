<?php echo form_open('user/login',array('class'=>'form-signup well')) ?>
	<h2 class="form-signin-heading">Login</h2>
	<?php if(!empty($ferror)){ ?>
	<div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
	<?php } ?>    
	<label>User name
	<input type="text" class="input-block-level" name="username" value="<?php echo set_value('username'); ?>">
    <?php echo form_error('username','<p class="text-error">','</p>') ?></label>	    
	<label>Password
	<input type="password" class="input-block-level" name="password" value="<?php echo set_value('password'); ?>">
    <?php echo form_error('password','<p class="text-error">','</p>') ?>
    </label>        
    <button type="submit" class="btn btn-primary">
		Sign in
	</button>
</form>