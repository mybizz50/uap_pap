<?php
echo form_open_multipart('purchase/initiate_purchase', array('id'=>'form_1', 'autocomplete'=>'off'));
 ?>
	<table width="100%" cellspacing="0">
		<tr>
			<td colspan="3" style="text-align:center">

				<p><?php echo $purchase_cat['name']; ?></p>
				<h1>UNIVERSITY OF ASIA PACIFIC</h1>
				<h4><?php echo $purchase_cat['description']; ?></h4>
				<input type="hidden" name="purchase_category" value="1">
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td width="20%" class="lable">Deparment/ Section</td>
			<td width="80%">
				<select name="ds_id">
					<?php foreach ($deptList as $dept): ?>
						<option value="<?php echo $dept['id']; ?>"><?php echo $dept['ds_name']; ?></option>
					<?php endforeach ?>
				</select> 
			</td>

		</tr>
		<tr>
			<td>2</td>
			<td class="lable">Request for Advance</td>
			<td>
				<table width="100%" class="table_2">
					<tr>
						<td width="10%" class="lable">Taka</td>
						<td width="40%" class="lable"><input class="large" type="text" name="advance_amount" /></td>
						<td width="10%" class="lable">In favor of : </td>
						<td width="40%" class="lable"><input class="large" type="text" name="advance_in_favour_of" /></td>	
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>3</td>
			<td width="20%" class="lable">Justifications (Write in detail, why, for whom & what purpose needed)</td>
			<td width="80%">
				<textarea class="small" name="justification" cols="10" rows="3" ></textarea> 
			</td>

		</tr>
		<tr>
			<td>4</td>
			<td class="lable">Budget head</td>
			<td>
				<table class="table_2">
					<tr>
						<td width="50%" class="lable"><input type="text" name="budget_head" /></td>
						<td width="10%" class="lable">Provision amount  </td>
						<td width="40%" class="lable"><input type="text" name="provision_amount" /></td>	
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>5</td>
			<td width="20%" class="lable">If fund is short, from which head could be adjusted</td>
			<td width="80%">
				<input type="text" name="adjusted_budget_if_not" /> 
			</td>

		</tr>
		<tr>
			<td>6</td>
			<td width="20%" class="lable">Date by which advance is required</td>
			<td width="80%">
					<input class="input-date" placeholder="dd-mm-yyyy" type="text" name="required_advance_date" /> 
			</td>

		</tr>
		<tr>
			<td>7</td>
			<td width="20%" class="lable">Estimated date by which advance will be settled</td>
			<td width="80%">
				<input class="input-date" placeholder="dd-mm-yyyy" type="text" name="advance_settle_date" />
				 
			</td>

		</tr>
		<tr>
			<td>8</td>
			<td width="20%" class="lable">Specification in details</td>
			<td width="80%">
				<textarea class="small" name="specification" cols="10" rows="3" ></textarea> 
			</td>

		</tr>
		<tr>
			<td>9</td>
			<td colspan="2" width="100%">

				<table width="100%" class="table_2">
					<tr>
						<td>#</td>
						<td>Type</td>
						<td>Item category</td>
						<td>Item code</td>
						<td width="80px">Total unit</td>
						<td width="80px">Unit name</td>
						<td>Unit price</td>
						<td>Total price</td>
						<td>Payment method</td>
					</tr>
					<tr class="purchaseItemList">
						<td colspan="4" align="center">&nbsp;</td>
						<td colspan="3">Sub total</td>
						<td><input type="text" class="sub_total_pice"></td>
						
					</tr>
					<script type="text/javascript" src="/assets/js/jquery.datetimepicker.js"></script>
					<script type="text/javascript">
						function randId(){
							var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
							return randLetter + Date.now();
						}
					
						var replacementItem = 0;
						var newItem = 0;
						var types = ["New","Replace"];
						var category =  {};
							<?php 
							foreach($item_cats as $item){
								echo 'category['.$item['id'].']'.'="'.$item['name'].'";';
							}
							
							?>
						

						function calculatePrice(){
							var total_price = 0;
							$(".itemRow").each(function(){

								var row_price = parseFloat($(this).find('.unit').val())*parseFloat($(this).find('.unit_price').val());
								$(this).find('.total_price').val(row_price);
								total_price+=row_price;
							});

							$(".sub_total_pice").val(total_price);	

						}	
					
						function rowTypeChange(){
							var type = $(this).find('option:selected').text();
							var id = $(this).closest('tr').attr('data-id');
							var purpose = $('<tr class="purpose_row" data-for="'+id+'"><td width="80%"><input type="text" name="item['+id+'][purpose]"></td></tr>');
							var det = $('<tr class="replacement_info_row" data-for="'+id+'"><td><input class="input-date" type="text" name="item['+id+'][date-purchase]"></td><td><input type="text" name="item['+id+'][certified_by]"></td>purpose_purcase_replaced<td><input type="text" name="item['+id+'][prev_item_storing_place]"></td></tr>');
							
							det.find(".input-date").datetimepicker({
								timepicker:false,
	 							format:'d-m-Y'
							});

							$(this).closest('tr').attr('data-type',type);
							if(type=="New"){
								 if($('.purpose_purcase_new .purpose_row[data-for='+id+']').length==0){
								 	$('.purpose_purcase_new').append(purpose);
								 }

								 $('.purpose_purcase_replaced .purpose_row[data-for='+id+']').remove();
								 $('.replacement_info_row[data-for='+id+']').remove();	

							}else{

								$('.purpose_purcase_new .purpose_row[data-for='+id+']').remove();

								if($('.purpose_purcase_replaced .purpose_row[data-for='+id+']').length==0){
								 	$('.purpose_purcase_replaced').append(purpose);
								 	$('.replacement_info').before(det);
								 }


							}
							//console.log($(this).find('option:selected').text());
						}	

						function delete_row(){
							var id = $(this).attr('data-id');
							var type = $('.itemRow[data-id='+id+']').attr('data-type');
							if(type=="New"){
								$('.purpose_purcase_new .purpose_row[data-for='+id+']').remove();
							}else{
								$('.purpose_purcase_replaced .purpose_row[data-for='+id+']').remove();
								$('.replacement_info_row[data-for='+id+']').remove();
							}

							$('.existing_quantity_row[data-for='+id+']').remove();
							$('.last_purchase_row[data-for='+id+']').remove();
							$('.itemRow[data-id='+id+']').remove();
							calculatePrice();
						}

						function addNewRow(){
							var tr = $('<tr>')
								  .addClass('itemRow')
								  .attr('data-type','New')
								  .attr('data-id',++replacementItem);

						var td_1 = $('<td>')
									.addClass('sl_no')
									.attr('data-sl',replacementItem)
									.text(replacementItem);
						var sl_2 = $('<select>').attr('name','item['+replacementItem+'][item_type]').change(rowTypeChange);
							
							for(i=0; i<types.length;i++){
								op = $('<option>')
									.attr('value',i+1)
									.text(types[i]);
								sl_2.append(op);	
							}

						var sl_3 = $('<select>').attr('name','item['+replacementItem+'][item_cat]');
								
							for(var a in category){
								if(category.hasOwnProperty(a)){
									//console.log(category[a]);	
								op = $('<option>')
									.attr('value',a)
									.text(category[a]);
								sl_3.append(op);

								}	
							}

						var ip_1 = $('<input>')
									.attr('name','item['+replacementItem+'][item_code]')
									.attr('type','text')
									.val(randId());

						var ip_2 = $('<input>')
									.attr('name','item['+replacementItem+'][unit]')
									.attr('type','text')
									.addClass('unit')
									.val(0)
									.change(calculatePrice);

						var ip_3 = $('<input>')
									.attr('name','item['+replacementItem+'][unit_name]')
									.attr('type','text');

						var ip_4 = $('<input>')
									.attr('name','item['+replacementItem+'][unit_price]')
									.attr('type','text')
									.addClass('unit_price')
									.val(0)
									.change(calculatePrice);

						var ip_5 = $('<input>')
									.attr('type','text')
									.addClass('total_price');

						var dlt = '<input type="radio" name="item['+replacementItem+'][payment_method]" value="cheque" checked="checked"> Cheque<br/><input type="radio" name="item['+replacementItem+'][payment_method]" value="cash"> Cash';
						console.log(dlt);
																								

						tr.append(td_1)
						  .append($('<td>').append(sl_2))
						  .append($('<td>').append(sl_3))
						  .append($('<td>').append(ip_1))
						  .append($('<td>').append(ip_2))
						  .append($('<td>').append(ip_3))
						  .append($('<td>').append(ip_4))
						  .append($('<td>').append(ip_5))
						  .append($('<td>').append(dlt));
						  
						var purpose = $('<tr class="purpose_row" data-for="'+replacementItem+'"><td width="80%"><input type="text" name="item['+replacementItem+'][purpose]"></td></tr>');  
						
						var existing = $('<tr class="existing_quantity_row" data-for="'+replacementItem+'"><td><input type="text" name="item['+replacementItem+'][total_existing_functional_quantity]"></td><td><input type="text" name="item['+replacementItem+'][total_existing_nonFunctional_quantity]"></td><td><input type="text" class="input-date"  name="item['+replacementItem+'][date-purchase-non-functional]"></td></tr>');
						var last_purchase = $('<tr class="last_purchase_row" data-for="'+replacementItem+'"><td><input type="text" class="input-date" name="item['+replacementItem+'][date-last-purchase]"></td><td><input type="text" name="item['+replacementItem+'][quantity-last-purchase]"></td><td><input type="text" name="item['+replacementItem+'][price-last-purchase]"></td></tr>');
						existing.find(".input-date").datetimepicker({
							timepicker:false,
 							format:'d-m-Y'
						});

						last_purchase.find(".input-date").datetimepicker({
							timepicker:false,
 							format:'d-m-Y'
						});	
						$('.purchaseItemList').before(tr);
						$('.purpose_purcase_new').append(purpose);
						$(".existing_quantity_row_1").after(existing);
						$(".last_purchase_row_1").after(last_purchase);
					}
						
					$(function(){
						addNewRow();
						$(".input-date").datetimepicker({
							timepicker:false,
 							format:'d-m-Y'
						});
						
					});
					</script>
					
					
				</table>
			</td>
		</tr>
		<tr>
			<td>10</td>
			<td width="20%" class="lable">Attach quotation</td>
			<td width="80%">
				<input type="file" name="attachment-quotation[]" multiple> 
			</td>
		</tr>
		<tr>
			<td>11</td>
			<td width="20%" class="lable">Attach comparative statement</td>
			<td width="80%">
				<input type="file" name="attachment-comparative-statement[]" multiple> 
			</td>
		</tr>
		<tr>
			<td>12</td>
			<td width="20%" class="lable">Purpose of purchase</td>
			<td width="80%" >
				<table width="100%">
					<tr>
						<td width="20%" style="border-right:#000 solid 1px;border-bottom:#000 solid 1px; padding:5px;">For new item : </td>
						<td width="80%" style="border-bottom:#000 solid 1px;">
							<table width="100%" cellpadding="2" border="0" cellspacing="0" class="table_2 purpose_purcase_new">
								
							</table>	
						
						</td>
					</tr>
					<tr>
						<td width="20%">For replaced items : </td>
						<td width="80%">
							<table width="100%" class="table_2 purpose_purcase_replaced">
								
							</table>	
						
						</td>
					</tr> 
				</table>
			</td>
		</tr>

		<tr>
			<td>13</td>
			<td width="20%" class="lable">If replacement</td>
			<td width="80%">
				<table width="100%" cellpadding="2" border="0" cellspacing="0">
					<tr>
						<td>Date of purchase</td>
						<td>Certified by</td>
						<td>Storing place of <br/>previous item</td>
					</tr>
					
					
					<tr class="replacement_info"></tr> 
				</table>
			</td>
		</tr>
		<tr>
			<td>14</td>
			<td width="20%" class="lable">Totial existing quantity</td>
			<td width="80%">
				<table width="100%">
					<tr class="existing_quantity_row_1">
						<td>Existing quantity</td>
						<td>Non-existing quantity</td>
						<td>Date of purchase</td>
						
					</tr>

				</table>
			</td>
		</tr>
		<tr>
			<td>15</td>
			<td width="20%" class="lable">Last purchase</td>
			<td width="80%">
				<table width="100%">
					<tr class="last_purchase_row_1">
						<td>Date</td>
						<td>Quantity</td>
						<td>Rate</td>
						
					</tr>

				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" value="Submit"/>
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
