<?php
echo form_open_multipart('bill_process/next', array('id'=>'form_1', 'autocomplete'=>'off'));
 ?>
	<table width="100%" cellspacing="0">
		<tr>
			<td colspan="2" align="center">
				<h2>Bill Process</h2>
				<h3><a target="_blank" href="/index.php/purchase/show_details/<?php echo $purchase_id ?>">Purchase ID# <?php echo $purchase_id; ?></a></h3>
				<h4>Purchase history</h4>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				Actions
			</td>
		</tr>
		
		<tr>
			<td colspan="2" align="center">
				<table border="1" cellspacing="1" cellpadding="1" width="100%">
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>From</th>
						<th>To</th>
						<th>Action</th>
						<th>Comments</th>
						<th>Attachments</th>
					</tr>
					
					<?php
						foreach ($flow_history as $id => $flow) {
							?>
					<tr>
						<td><?php echo $id+1 ?></td>
						<td class="utcToLocal"><?php echo $flow['date'] ?></td>
						<td><?php echo $flow['from'] ?></td>
						<td><?php echo $flow['to'] ?></td>
						<td><?php echo $flow['status_type'] ?></td>
						<td><?php echo $flow['message'] ?></pre></td>
						<td>
							<?php 
							$i = 0;
							$atta= $flow['attachments'];
							foreach ($atta as $item) {
								$i++;
								$url = "/uploads/".$item['file_name'];
								$name = array_pop(explode("/", $url));
								echo $i.". <a href='$url' target='_blank' >$name</a><br/>";
							} ?>
							&nbsp;
						</td>
					</tr>		
							
							<?php
						}
					?>
				</table>
			</td>
		</tr>
		<?php if(!$is_readonly){
			?>

		<tr>
			<td colspan="2" align="center">
				<h2>Your actions</h2>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Purchase id</td>
			<td width="80%">
				<input type="hidden" name="initial_step" value="<?php echo  $initial_step ? true : false;?>">
				<input type="hidden" name="purchase_id" value="<?php echo  $purchase_id;?>">
				<input type="hidden" name="current_flow" value="<?php echo  $current_flow;?>">
				
				<?php echo $purchase_id; ?>
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
					$buttons = array("forward_bill"=>"Forward Bill");
					
					if($can_approve){
						$buttons['check_singed_and_forwarded'] = "Sign check and forward";
						$buttons['check_singed_and_approved'] = "Sign check and approve";
						$buttons['reject_bill'] = "Reject bill";	
					}

					if($final_stage){
						$buttons['bill_paid'] = "Mark bill paid";	
					}

					if(!$check_issued && $check_issuer){
						$buttons = array(
							"forward_bill"=>"Forward Bill",
							"issue_check"=>"Issue check",
							"reject_bill"=>"Reject bill"
						);	
					}

					foreach ($buttons as $value => $name) {
						?>
							<button type="submit" name="process_action" value="<?php echo $value; ?>"><?php echo $name; ?></button>
						<?php 

					}


				?>
				
			</td>
		</tr>
		
		<?php
		} ?>
		
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
