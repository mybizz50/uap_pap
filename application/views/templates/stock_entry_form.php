<script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>

<script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>
	
	<?php
echo form_open_multipart('stock/entry/insert', array('class'=>'formoid-metro-cyan', 'autocomplete'=>'off','style'=>"background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
 ?>
 <?php if(!empty($ferror)){ ?>
    <div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
    <?php } ?>
	
	<div class="title">
		<h2>Stock Entry</h2>
	</div>

	<div  class="element-select" >
		<label class="title">Purchase Id</label>
		<div class="small">
            <input type="hidden" name="stock_title" id="stock_title">
			<span>
				<select id="purchase_id" name="purchase_id" >
					<option value="0" selected="selected">--Select--</option>
					<?php 
                foreach($purchases as $purchase){
                    if($purchase['stock_entry_complete']){
                        continue;
                    }
                    ?>
                    <option value="<?php echo $purchase['id']; ?>"><?php  echo "#".$purchase['id']." (".$purchase['item_name'].") "."<br/>".$purchase['created_date'] ?></option>
                    <?php
                }
                ?>
				</select> <i></i></span>
		</div>
	</div>
	<h3 class="hide" id="loading_text">Loading...</h3>
	<div class="hide" id="form_part">

		<div class="element-input" >
			<label class="title">Product Name</label>
			<input type="text" readonly="readonly" id="item_name"/>
		</div>
		<div class="element-input" >
			<label class="title">Product Category</label>
			<input type="text" readonly="readonly" id="item_cat"/>
		</div>
		<div class="element-input" >
			<label class="title">Date initiated</label>
			<input type="text" readonly="readonly" id="date_initiated"/>
		</div>
		<div class="element-input" >
			<label class="title">Initiated by department</label>
			<input type="text" readonly="readonly" id="dept_name"/>
		</div>
		<div class="element-input" >
			<label class="title">Total quantity</label>
			<input type="text" name="available_quantity" id="available_quantity"/>
            <input type="hidden" name="total_quantity" id="total_quantity" readonly="readonly"/>
		</div>

		<div class="submit">
			<input type="submit" value="Submit"/>
		</div>

</form>
<script type="text/javascript">
        function set_data(data){
            
            $("#item_name").val(data.item_name);
            $("#item_cat").val(data.cat);
            $("#dept_name").val(data.dept);
            $("#date_initiated").val(data.date_initiated);
            $("#stock_title").val(data.stock_title);
            
            //$("#total_quantity, #available_quantity").val(data.quantity);
            $("#form_part").show();
        }
             $(function(){
                $("#purchase_id").change(function(){
                    var title = $(this).find("option:selected").text();
                    $("#stock_title").val(title);
                });    
                $("#available_quantity").change(function(){
                    var val = $(this).val();
                    $("#total_quantity").val(val);
                });
            var current_req;     
        $("#form_part, #loading_text").hide();
        $("#purchase_id").change(function() {
            if(current_req){
                 current_req.abort();
                   
                }
              $("#form_part").hide();
                
            if($("#purchase_id option:selected").val()>0){
                $("#loading_text").show();
                current_req = $.ajax({
                    url:"<?php echo base_url(); ?>index.php/stock/purchase_detail",
                    data:"purchase_id="+$("#purchase_id option:selected").val(),
                    type:"POST",
                    success:function(data){
                        $("#loading_text").hide();
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
<script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script>
