<?php
echo form_open_multipart('purchase/next_proecss', array('id'=>'form_1', 'autocomplete'=>'off'));
 ?>
	<table width="100%" cellspacing="0">
		<tr>
			<td width="20%" class="lable">Deparment/ Section</td>
			<td width="80%">
				<?php echo $purchase_info['ds_id']; ?>
				<input type="hidden" name="purchase_id" value="<?php echo $purchase_info['id']; ?>"> 
			</td>

		</tr>
		<tr>
			<td class="lable">Request for Advance</td>
			<td>
				<table width="100%" class="table_2">
					<tr>
						<td width="10%" class="lable">Taka</td>
						<td width="40%" class="lable"><?php echo $purchase_info['advance_amount'] ?></td>
						<td width="10%" class="lable">In favor of : </td>
						<td width="40%" class="lable"><?php echo $purchase_info['advance_in_favour_of']; ?></td>	
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Justifications (Write in detail, why, for whom & what purpose needed)</td>
			<td width="80%">
				<?php echo $purchase_info['justification'] ? $purchase_info['justification'] : "&nbsp; &nbsp;"; ?> 
			</td>

		</tr>
		<tr>
			<td class="lable">Budget head</td>
			<td>
				<table class="table_2">
					<tr>
						<td width="50%" class="lable"><?php echo $purchase_info['budget_head']; ?> </td>
						<td width="10%" class="lable">Provision amount  </td>
						<td width="40%" class="lable"><?php echo $purchase_info['provision_amount']; ?></td>	
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">If fund is short, from which head could be adjusted</td>
			<td width="80%">
				<?php echo $purchase_info['adjusted_budget_if_not'] ? $purchase_info['adjusted_budget_if_not'] : "&nbsp;&nbsp;"; ?> 
			</td>

		</tr>
		<tr>
			<td width="20%" class="lable">Date by which advance is required</td>
			<td width="80%">
					<?php echo $purchase_info['required_advance_date']; ?>
			</td>

		</tr>
		<tr>
			<td width="20%" class="lable">Estimated date by which advance will be settled</td>
			<td width="80%">
				<?php echo $purchase_info['advance_settle_date']; ?>
				 
			</td>

		</tr>
		<tr>
			<td width="20%" class="lable">Specification in details</td>
			<td width="80%">
				<?php echo $purchase_info['specification'] ? $purchase_info['specification'] : "&nbsp;&nbsp;" ?>
			</td>

		</tr>
		<tr>
			<td colspan="2" width="100%">
				<table width="100%" class="table_2">
					<tr>
						<td>#</td>
						<td>Type</td>
						<td>Item category</td>
						<td>Item name</td>
						<td width="80px">Total unit</td>
						<td width="80px">Unit name</td>
						<td>Unit price</td>
						<td>Total price</td>
					</tr>

					<?php 

					$sub_total = 0;
					$i = 1;
					foreach ($items as $item) {
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $item['item_type']; ?></td>
							<td><?php echo $item['item_cat']; ?></td>
							<td><?php echo $item['item_name']; ?></td>
							<td>
								<?php echo $item['unit']; 
								if($step==2){
									?>


								
								<input type="text" name="item[<?php echo $item['id']; ?>][approved-unit]" placeholder="Update unit">
							<?php
								}
								?>
							</td>
							<td><?php echo $item['unit_name']; ?></td>
							<td><?php echo $item['unit_price']; 
							if($step==2){
									?>

								<input type="text" name="item[<?php echo $item['id']; ?>][approved-unit-price]" placeholder="Update unit price">	
							<?php
								}
								?>

							</td>
							<td>
								<?php echo $item['unit']*$item['unit_price']; 

															if($step==2){
									?>


								<input type="text" placeholder="Updated total">
							<?php
								}
								?>

							</td>
							
						</tr>
						<?php
						$sub_total += $item['unit']*$item['unit_price'];
					}
					?>
					<tr class="purchaseItemList">
						<td colspan="4" align="center">&nbsp;</td>
						<td colspan="3">Sub total</td>
						<td><?php echo $sub_total; ?></td>	
					</tr>
					
					
				</table>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Payment method</td>
			<td width="80%">
				<?php echo $purchase_info['payment_mode'];?>   
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Attach quotation</td>
			<td width="80%">
				<?php 
				$i = 0;
				foreach ($attachments as $item) {
					
					if($item['type']=='quotation'){
						$i++;
						$url = "/uploads/".$item['file_name'];
						$name = array_pop(explode("/", $url));
						echo $i.". <a href='$url' target='_blank' >$name</a><br/>";
					}
				} ?>
				&nbsp; 
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Attach comparative statement</td>
			<td width="80%">
				<?php 
				$i = 0;
				foreach ($attachments as $item) {
					
					if($item['type']=='cs'){
						$i++;
						$url = "/uploads/".$item['file_name'];
						$name = array_pop(explode("/", $url));
						echo $i.". <a href='$url' target='_blank' >$name</a><br/>";
					}
				} ?>
				&nbsp; 
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Purpose of purchase</td>
			<td width="80%" >
				<table width="100%">
					<tr>
						<td width="20%" style="border-right:#000 solid 1px;border-bottom:#000 solid 1px; padding:5px;">For new item : </td>
						<td width="80%" style="border-bottom:#000 solid 1px;">
							<table width="100%" cellpadding="2" border="0" cellspacing="0" class="table_2 purpose_purcase_new">
								<?php 

									$sub_total = 0;
									$i = 0;
									foreach ($items as $item) {
										$i++;
										if($item['item_type']=="Replacement"){
											continue;
										}
										?>
										<tr data-for="1" class="purpose_row">
											<td width="20%">Item <?php echo $i ?>. </td>
											<td width="80%"><?php echo $item['purpose']; ?></td>
										</tr>
										<?php
				
									}
									?>
					
							</table>	
						
						</td>
					</tr>
					<tr>
						<td width="20%">For replaced items : </td>
						<td width="80%">
							<table width="100%" class="table_2 purpose_purcase_replaced">
								<?php 

									$sub_total = 0;
									$i = 0;
									foreach ($items as $item) {
										$i++;
										if($item['item_type']=="New"){
											continue;
										}
										?>
										<tr data-for="1" class="purpose_row">
											<td width="20%">Item <?php echo $i ?>. </td>
											<td width="80%"><?php echo $item['purpose']; ?></td>
										</tr>
										<?php
				
									}
									?>
					
							</table>	
						
						</td>
					</tr> 
				</table>
			</td>
		</tr>

		<tr>
			<td width="20%" class="lable">If replacement</td>
			<td width="80%">
				<table width="100%" cellpadding="2" border="0" cellspacing="0">
					<tr>
						<td>For item</td>
						<td>Date of purchase</td>
						<td>Certified by</td>
						<td>Storing place of <br/>previous item</td>
					</tr>
					<?php 

					$sub_total = 0;
					$i = 0;
					foreach ($items as $item) {
						$i++;
						if($item['item_type']=="New"){
							continue;
						}
						?>
						<tr class="replacement_info_row">
							<td><?php echo $i; ?>&nbsp;</td>
							<td><?php echo $item['date-purchase']; ?>&nbsp;</td>
							<td><?php echo $item['certified_by']; ?>&nbsp;</td>
							<td><?php echo $item['prev_item_storing_place']; ?>&nbsp;</td>
						</tr>
						<?php

					}
					?>
					
					<tr class="replacement_info"></tr> 
				</table>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Totial existing quantity</td>
			<td width="80%">
				<table width="100%">
					<tr class="existing_quantity_row_1">
						<td>For Item</td>
						<td>Existing quantity</td>
						<td>Non-existing quantity</td>
						<td>Date of purchase</td>
						
					</tr>
					<?php 

					$sub_total = 0;
					$i = 0;
					foreach ($items as $item) {
						$i++;
						?>
						<tr data-for="1" class="existing_quantity_row">
							<td><?php echo $i; ?>&nbsp;</td>
							<td><?php echo $item['total_existing_functional_quantity']; ?>&nbsp;</td>
							<td><?php echo $item['total_existing_nonFunctional_quantity']; ?>&nbsp;</td>
							<td><?php echo $item['date-purchase-non-functional']; ?>&nbsp;</td>
						</tr>
						<?php

					}
					?>
					
				</table>
			</td>
		</tr>
		<tr>
			<td width="20%" class="lable">Last purchase</td>
			<td width="80%">
				<table width="100%">
					<tr class="last_purchase_row_1">
						<td>For Item</td>
						<td>Date</td>
						<td>Quantity</td>
						<td>Rate</td>
						
					</tr>
					<?php 

					$sub_total = 0;
					$i = 0;
					foreach ($items as $item) {
						$i++;
						?>
						<tr data-for="1" class="last_purchase_row">
							<td><?php echo $i; ?>&nbsp;</td>
							<td><?php echo $item['date-last-purchase']; ?>&nbsp;</td>
							<td><?php echo $item['quantity-last-purchase']; ?>&nbsp;</td>
							<td><?php echo $item['price-last-purchase']; ?>&nbsp;</td>
						</tr>
						<?php

					}
					?>


				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<h2>Actions</h2> 
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
						foreach ($actions as $id => $flow) {
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
		
		<?php if($mode=='process' && !$is_readonly){
			?>

		
		
		<tr>
			<td colspan="2" align="center">
				Your action
			</td>
		</tr>
		<?php 
			if($can_approve && !($purchase_info['purchase_status']==3 && $purchase_info['is_final_step'])){
				?>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="process_action" value="approve"/>
						<input type="submit" name="process_action" value="reject"/>
					</td>
				</tr
				<tr>
					<td colspan="2" align="center">
						OR
					</td>
				</tr>	
				
				<?php
			}

		?>

		<?php 
			if(!($purchase_info['purchase_status']==3 && $purchase_info['is_final_step'])){
				if($current_action != 8){
				?>

				

		<tr>
			<td width="20%" class="lable">Forward</td>
			<td width="80%">
				<select name="forward_id">
					<?php 
						foreach ($flow_list as $a) {
							
							?>

							<option value="<?php echo $a['user_id'] ?>"><?php echo $a['name']; if(!empty($a['ds_name'])){echo "(".$a['ds_name'].")";}?></option>

							<?php
						}
					?>
				</select>
			</td>
		</tr>
		<?php
				}
			}
		?>
		<!-- <tr>
			<td width="20%" class="lable">Subject</td>
			<td width="80%">
				<input type="text" name="subject" />
				<input type="hidden" name="current_flow" value="<?php echo $current_flow; ?>" />
			</td>
		</tr> -->
		<tr>
			<td width="20%" class="lable">Comment</td>
			<td width="80%">
				<textarea rows="5" name="comments"></textarea>
				<input type="hidden" name="current_flow" value="<?php echo $current_flow; ?>" />
				<?php 
					if($current_action==8){
						?>
						<input type="hidden" name="forward_id" value="<?php echo $forward_id; ?>" />
						<?php
					}
				?>
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
		<?php 
		if($current_action == 8){
			?>
			<tr>
				<td colspan="2" align="center">
					<button type="submit" name="process_action" value="work_order_issued">Work order issued</button>
				</td>
			</tr>

			<?php	
		}else if(!($purchase_info['purchase_status']==3 && $purchase_info['is_final_step'])){
				?>

		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="process_action" value="Forward"/>
			</td>
		</tr>
		<?php
		}else{
			?>
			<tr>
				<td colspan="2" align="center">
					<button type="submit" name="process_action" value="issue_work_order">Issue work order</button>
				</td>
			</tr>	
			<?php
		}
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
