<script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>

<?php
echo form_open_multipart('distribution/entry/insert', array('class' => 'formoid-metro-cyan', 'style' => "background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;", 'autocomplete' => 'off'));
?>
<?php if(!empty($ferror)){ ?>
<div class="alert alert-error">
	<strong>Ops ! </strong> <?php echo $ferror; ?>
</div>
<?php } ?>

<div class="title">
	<h2>Distribute</h2>
</div>

<div  class="element-select" >
	<label class="title">Stock Id</label>
	<div class="small">
		<span>
			<select id="stock_id" name="stock_id" >
				<option value="0" selected="selected">--Select--</option>
				<?php 
                foreach($stocks as $stock){
                    ?>
                    <option value="<?php echo $stock['id']; ?>"><?php  echo $stock['stock_title']; ?></option>
                    <?php
                }
                ?>
			</select> <i></i></span>
	</div>
</div>
<h3 class="hide" id="loading_text">Loading...</h3>
<div class="hide" id="form_part">
	<div class="element-input" >
		<label class="title">Stock entered</label>
		<input id="entry_date" disabled="disabled" name="entry_date" class="small"  type="text"/>
	</div>
	<div class="element-input" >
		<label class="title">Total quantity</label>
		<input id="total_quantity" disabled name="total_quantity" class="small" placeholder="Item 3" type="text"/>
	</div>
	<div class="element-input" >
		<label class="title">Available quantity</label>
		<input id="available_quantity" disabled class="small" placeholder="10" type="number"/>
	</div>
	<div  class="element-select" >
		<label class="title">Distribute to</label>
		<div class="small">
			<span>
				<select id="type" id="distributed_to" name="distributed_to" >
					<option value="0">--Select--</option>
					<?php 
                foreach($depts as $dept){
                    ?>
                    <option value="<?php echo $dept['id']; ?>"><?php  echo $dept['ds_name']; ?></option>
                    <?php
                }
                ?>
				</select> <i></i></span>
		</div>
	</div>

	<div class="element-input" >
		<label class="title">Quantity</label>
		<input  name="distributed_quantity" class="small" placeholder="" type="number"/>
	</div>

</div>

<div class="submit">
	<input type="submit" value="Submit"/>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">

	function set_data(data){
$("#purchase_id").val(data.purchase_id);
$("#entry_date").val(data.entry_date);
$("#total_quantity").val(data.total_quantity);
$("#available_quantity").val(data.available_quantity);
$("#form_part").show();
}
$(function(){
var current_req;
$("#form_part, #loading_text").hide();
$('.datepicker').datepicker({format:"yyyy-mm-dd"})
$("#stock_id").change(function() {
if(current_req){
current_req.abort();

}
var current_req;
$("#form_part").hide();

if($("#stock_id option:selected").val()>0){
$("#loading_text").show();
current_req = $.ajax({
url:"<?php echo base_url(); ?>index.php/distribution/stock_details",
	data:"stock_id="+$("#stock_id option:selected").val(),
	type:"POST",
	success:function(data){
	$("#loading_text").hide();
	//data = $.parseJSON(data);
	if(data["status"]==1){
	set_data(data["data"]);
	}else{

	}

	}
	});
	}else{
	$("#loading_text").hide();
	}
	});

	});

</script>

</form>
<script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script>