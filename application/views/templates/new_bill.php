<?php
echo form_open_multipart('bill_process/next', array('id'=>'form_1', 'autocomplete'=>'off'));
 ?>
	<table width="100%" cellspacing="0">
		<tr>
			<td colspan="2" align="center">
				<h2>Process New Bill</h2>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Select purchase id</td>
			<td width="80%">
				<input type="hidden" name="initial_step" value="<?php echo  $initial_step ? true : false;?>">
				<select name="purchase_id">
					<?php 
						foreach ($purchase_list as $a) {
							
							?>

							<option value="<?php echo $a['id'] ?>"><?php echo $a['id'];?></option>

							<?php

							if(!count($purchase_list)){
								?>
								<option value="">Empty</option>
								<?php
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Forward to</td>
			<td width="80%">
				<select name="forward_id">
					<?php 
						foreach ($flow_list as $a) {
							
							?>

							<option value="<?php echo $a['user_id'] ?>"><?php echo $a['name']; if(!empty($a['ds_name'])){echo "(".$a['ds_name'].")";}?></option>

							<?php

							if(!count($flow_list)){
								?>
								<option value="">Empty</option>
								<?php
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Comment</td>
			<td width="80%">
				<textarea rows="5" name="comments"></textarea>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Attachments</td>
			<td width="80%">
				<input type="file" name="attachments[]" /><br/>
				<input type="file" name="attachments[]" /><br/>
				<input type="file" name="attachments[]" /><br/>
				<input type="file" name="attachments[]" /><br/>
				<input type="file" name="attachments[]" /><br/>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<?php 
					$action_name = "Forward Bill";
					$action_value = "forward_bill";
				?>
				<button type="submit" name="process_action" value="<?php echo $action_value; ?>"><?php echo $action_name; ?></button>
			</td>
		</tr>
	</table>
</form>
<style type="text/css">
	#form_1{
  padding: 10px;
}

#form_1 > table{
  border:#000 solid 1px;
  border-right: 0;
}



#form_1 td{
	border-bottom: #000 solid 1px;
	border-right: #000 solid 1px;
	padding: 3px;
}

#form_1 input[type=text],
#form_1 textarea{
	width: 100%;
	border:none;
	min-height: 30px;
}

#form_1 select{
	padding: 8px 0;
	width: 100%;
}

#form_1 input{
	max-width: 300px;
}

#form_1 .table_2 td{
	border:none;
} 

#add_more_btn{
	background: #81D3F9;
	color: #000;
	padding: 5px;
	border-radius: 5px;
}
</style>
<script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script>
