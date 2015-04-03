<?php
echo form_open('admin/user_search', array('class' => 'form-inline'));
?>
<input type="text" class="input-small" placeholder="Name" name="user_name" value="<?php echo set_value('user_name'); ?>">
<input type="text" class="input-small" placeholder="Email" name="user_email" value="<?php echo set_value('user_email'); ?>">
<?php
array_unshift($role_options, array('' => 'Role'));
echo form_dropdown('role', $role_options);
?>
<?php
array_unshift($dept_options, array('' => 'Department'));
echo form_dropdown('dept', $dept_options);
?>
<button type="submit" class="btn">
	Search
</button>
</form>