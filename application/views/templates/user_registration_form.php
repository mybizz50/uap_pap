<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="height" align="left" valign="top"><script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>
		    <?php
echo form_open('user/complete_registration/complete', array('class'=>'formoid-metro-cyan','style'=>"background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
 ?>
<?php if(!empty($ferror)){ ?>
    <div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
    <?php } ?>
    
		<form class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;" action="http://uap.dream2development.com/index.php/admin/send_registration_request" method="post">
			<div class="title">
				<h2>Complete registration</h2>
			</div>
			<div class="title">
				<h3>Profiel info</h3>
			</div>
			
			<div class="element-input" >
				<label class="title">First name</label>
				<input class="small" name="first_name" type="text" required value="<?php echo set_value('first_name'); ?>">
    <?php echo form_error('first_name','<p class="text-error">','</p>') ?>
			</div>

			<div class="element-input" >
				<label class="title">Last name</label>
				<input class="small" name="last_name" type="text" required value="<?php echo set_value('last_name'); ?>">
    <?php echo form_error('last_name','<p class="text-error">','</p>') ?>
			</div>

			<div  class="element-select" >
				<label class="title">Department</label>
				<div class="small">
					<span>
						<select name="department">
							<?php foreach($dept as $a){
								?>
								<option value="<?php echo $a['id'] ?>"><?php echo $a['ds_name'] ?></option>	
								<?php
								} ?>
							
						</select> <i></i></span>
				</div>
			</div>
			

			<div  class="element-select" >
				<label class="title">Role</label>
				<input class="small" readonly type="text" value="<?php echo $role; ?>">
				</div>
			</div>

			<div class="element-input" >
				<label class="title">Contact number</label>
				<input class="small" name="contact_number" type="text" required value="<?php echo set_value('contact_number'); ?>">
    <?php echo form_error('contact_number','<p class="text-error">','</p>') ?>
			</div>

			<div class="title">
				<h3>Login info</h3>
			</div>
			
			<div class="element-input" >
				<label class="title">Username</label>
				<input class="small" name="user_name" type="text" required value="<?php echo set_value('user_name'); ?>">
    <?php echo form_error('user_name','<p class="text-error">','</p>') ?>
			</div>

			<div class="element-input" >
				<label class="title">Password</label>
				<input class="small" name="password" type="password" required value="<?php echo set_value('password'); ?>">
    <?php echo form_error('password','<p class="text-error">','</p>') ?>
			</div>
	

			<div class="submit">
				<input type="submit"  value="Done"/>
			</div>

		</form><script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script></td>
	</tr>
</table>