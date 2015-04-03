<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="height" align="left" valign="top"><script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>
		    <?php
echo form_open('admin/create_user', array('class'=>'formoid-metro-cyan','style'=>"background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
 ?>
<?php if(!empty($ferror)){ ?>
    <div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
    <?php } ?>
    
		<form class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;" action="http://uap.dream2development.com/index.php/admin/send_registration_request" method="post">
			<div class="title">
				<h2>Add User</h2>
			</div>
			<div class="element-input" >
				<label class="title">Email</label>
				<input class="small" name="usermail" type="email" required value="<?php echo set_value('usermail'); ?>">
    <?php echo form_error('usermail','<p class="text-error">','</p>') ?>
			</div>

			<div  class="element-select" >
				<label class="title">Role</label>
				<div class="small">
					<span>
						<?php echo form_dropdown('role', $options); ?> <i></i></span>
				</div>
			</div>
			<div class="element-input" >
				<label class="title">Password</label>
				<input class="small" name="password" type="text" readonly value="<?php echo round(microtime(1)*1000); ?>">
				<p>Remember the password. Give this password to the user you created. </p>
			</div>


			<div class="submit">
				<input type="submit"  value="Create"/>
			</div>

		</form><script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script></td>
	</tr>
</table>