<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="height" align="left" valign="top"><script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>
		    <?php
        echo form_open('admin/save_department', array('class' => 'formoid-metro-cyan', 'style' => "background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
    		?>
    		<?php if(!empty($ferror)){
    		?>
    		<div class="alert alert-error">
    			<strong>Ops ! </strong><?php echo $ferror; ?>
    		</div><?php } ?>
		<div class="title">
			<h2>Add Department</h2>
		</div>
		<div class="element-input" >
			<label class="title">Department Name</label>
			<input name="ds_name"  type="text" value="<?php echo set_value('ds_name'); ?>" required/>
			<?php echo form_error('ds_name','<p class="text-error">','</p>') ?>
		</div>
		<div class="element-input" >
			<label class="title">Department type</label>
			<input type="radio" name="ds_type" value="department" checked="Checked"> Department 
			<input type="radio" name="ds_type" value="section"> Section
			<input type="radio" name="ds_type" value="rec_com"> Recommendation committee 
		</div>
		
		</div>
		<div id="formW">
			<table width="195" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left">
					<div class="element-textarea" >
						<label class="title">Location</label>						
						<textarea required class="small" name="ds_loc" cols="10" rows="3" ><?php echo set_value('ds_loc'); ?></textarea>
						<?php echo form_error('ds_loc','<p class="text-error">','</p>') ?></label>
					</div></td>
				</tr>
			</table>
		</div>
		<div class="element-input" >
			<label class="title">Phone</label>
			<input name="ds_phone"  type="text" value="<?php echo set_value('ds_phone'); ?>" required/>
			<?php echo form_error('ds_phone','<p class="text-error">','</p>') ?>
		</div></div>
		<div class="element-input" >
			<label class="title">Email</label>
			<input name="ds_mail"  type="email" value="<?php echo set_value('ds_mail'); ?>" required/>
			<?php echo form_error('ds_mail','<p class="text-error">','</p>') ?>
		</div></div>
		<div class="submit">
			<input type="submit" name="add_dept" value="Submit"/>
		</div></form><script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script></td>
	</tr>
</table>