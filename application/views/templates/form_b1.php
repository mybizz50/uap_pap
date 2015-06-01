<?php
echo form_open_multipart('purchase/initiate_purchase', array('id'=>'form_1', 'autocomplete'=>'off'));
 ?>
	<table width="100%" cellspacing="0">
		<tr>
			<td colspan="3" style="text-align:center">

				<p><?php echo $purchase_cat['name']; ?></p>
				<h1>UNIVERSITY OF ASIA PACIFIC</h1>
				<h4><?php echo $purchase_cat['description']; ?></h4>
				<input type="hidden" name="purchase_category" value="2">
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
			<td width="20%" class="lable">Remarks</td>
			<td width="80%">
				<textarea class="small" name="remarks" cols="10" rows="3" ></textarea> 
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
<script type="text/javascript" src="/assets/js/jquery.datetimepicker.js"></script>
					
<script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script>
<script type="text/javascript">
	$(".input-date").datetimepicker({
		timepicker:false,
			format:'d-m-Y'
	});
</script>
