<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="height" align="left" valign="top"><script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>
		    <?php
echo form_open('user/update_password/update', array('class'=>'formoid-metro-cyan','style'=>"background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
 ?>
<?php if(!empty($ferror)){ ?>
    <div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
    <?php } ?>
    
		<form class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;" action="http://uap.dream2development.com/index.php/admin/send_registration_request" method="post">
			<div class="title">
				<h2>Change password</h2>
			</div>
			
			<div class="element-input" >
				<label class="title">Old password</label>
				<input class="small" name="old_pass" type="password" required value="<?php echo set_value('old_pass'); ?>">
    <?php echo form_error('old_pass','<p class="text-error">','</p>') ?>
			</div>

			<div class="element-input" >
				<label class="title">New password</label>
				<input class="small" name="password" type="password" required value="<?php echo set_value('password'); ?>">
    <?php echo form_error('password','<p class="text-error">','</p>') ?>
			</div>
	

			<div class="submit">
				<input type="submit"  value="Done"/>
			</div>

		</form><script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script></td>
	</tr>
</table>