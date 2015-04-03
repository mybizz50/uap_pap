<style type="text/css">
    label {
        color: #000;
        font-weight: bold;
    }
</style>
<div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 

    
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
		 <div class="title"><h2>Purchase Info</h2></div></td>
  </tr>
</table><div>
            <label>Purchase id</label>
            <?php echo $id; ?>
        
            
            <label>Department</label>
            <p><?php echo $ds_id; ?></p>
            
            <label>Initialized by</label>
            <p><?php echo $created_by; ?></p>
            
            <label>Initialization date</label>
            <p><?php echo $created_date; ?></p>
            
            <label>Item category</label>
            <p><?php echo $item_category; ?></p>
            <label>Item name</label>
            <p><?php echo $item_name; ?></p>
            
            <h3><a style="width: auto; height:auto;   background: #2DA5DA; color: #fff; " class="btn btn-primary btn-small" href="/index.php/purchase/get_purchase/<?php echo $id ?>" target="_blank">More</a></h3>        
       
   </div>







<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
		 <div class="title"><h2>Purchase log</h2></div></td>
  </tr>
</table>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr  >
    <td align="center" valign="top" id="table_stock_1"><strong>Sl. no.</strong></td>
    <td id="table_stock_1" align="center"><strong>Date</strong></td>
    <td id="table_stock_1" align="center"><strong>From</strong></td>
    <td id="table_stock_1" align="center"><strong>Comments</strong></td>
    <td id="table_stock_1" align="center"><strong>Action</strong></td>
    <td id="table_stock_1" align="center"><strong>New quotation</strong></td>
   
  </tr>
   <?php
            $counter = 0; 
            foreach($purchase_log_list as $log){
                ?>
  <tr>
    <td  id="table_stock_2" align="center"><?php echo ++$counter; ?></td>
    <td id="table_stock_2" align="center"><?php echo $log['time']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $log['assigned_by'];?></td>
    <td id="table_stock_2" align="center"><?php echo $log['comments'] ?></td>
    <td id="table_stock_2" align="center"><?php echo $log['action']?></td>
     <td id="table_stock_2" align="center"><?php echo empty($log['quotation_details_id'])?"--":"<a target=\"_blank\" href='index.php/purchase/quotation_details/".$log['quotation_details_id']."'>Show</a>"?></td>
   
  </tr>  <?php
            }
        ?>
   
</table>


</div>


<?php
echo form_open_multipart('purchase/process_notification/', array('class' => 'form-horizontal', 'autocomplete' => 'off'));
 ?>
 <?php if(!empty($ferror)){ ?>
    <div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
    <?php } ?>
        
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
		 <div class="title"><h2>Your Comments</h2></div></td>
  </tr>
</table> 
<div>
	<table width="340" border="0" cellspacing="0" cellpadding="10">
			<tr>
				<td align="left">
                <input type="hidden" name="id" value="<?php echo $notification_id; ?>">
            <textarea name="comments"></textarea>
            </td>
			</tr>
		</table>
		 </div>
            <label class="checkbox hide_in_a">
                <input type="checkbox" name="file_attched" />
                Propose better quotation</label>
     
    <fieldset class="form_part_attachment hide">
        <legend>
            Attachments
        </legend>
        <label>File</label>
        <input type="file" name="file_name">
        <label>No. of Quotations</label>
        <input type="text" name="no_of_quotation"/>
        <label>Comparative statement</label>
        <table width="340" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left">
        <textarea name="comperetive_statement"></textarea>
        </td>
			</tr>
		</table>
        <label>Justification</label>
        <table width="340" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left">
        <textarea name="quotation_justification"></textarea>
        </td>
			</tr>
		</table>
        <label>Recommended Supplier</label>
        <input type="text" name="recommended_supplier" />
        <input type="hidden" name="purchase_id" value="<?php echo $id; ?>" />
    </fieldset>
   
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
		 <div class="title"><h2>Actions</h2></div></td>
  </tr>
</table>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr  >
    <td>
        <?php 
            if(!empty($forward_list)){
                ?>
                
                
        <label>Forward to </label>
        <div class="small">
        <select name="forward_id">
            <?php 
                foreach($forward_list as $a){
                    print_r($a);
                    ?>
                    <option value="<?php echo $a['forward_id'] ?>"><?php echo $a['forward_name'] ?></option>
                    <?php
                }
            ?>
        </select></div>
        <button name="status" value="5">Forward</button>
        <?php
            }else{
                ?>
                <button name="status" value="3">Complete</button>
        
                <?php
            }
        ?>
        
        <?php 
            if(!empty($return_list)){
                ?>
                
        <label>Return back to </label>
       
		<div class="small">			
        <select name="return_id">
            <?php 
                foreach($return_list as $id => $a){
                    ?>
                    <option value="<?php echo $id ?>"><?php echo $a ?></option>
                    <?php
                }
            ?>
        </select>
        </div>
        
        <button name="status" value="6">Return</button>
        <?php
            }
        ?>
        
   </div></td></tr></table>
    
    <h1>&nbsp;</h1>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        
        $(function(){
        	$(".form_part_attachment").ready(function(){
		$(".form_part_attachment").hide();
		
	});
        
        $("input:visible[name='file_attched']").change(function(){
        if($(this).is(":checked")){
        $(".form_part_attachment").stop().slideDown();
        }else{
        $(".form_part_attachment").stop().slideUp();
        }
        });
        
        });
    </script>
</div>
</form>
<script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script>
