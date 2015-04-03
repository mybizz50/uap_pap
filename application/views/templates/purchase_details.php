<style type="text/css">
	label {
		color: #000;
		font-weight: bold;
	}
</style>
<h3>Purchase Details</h3>
<div class="form-horizontal">
    <fieldset>
        <legend>
            Purchase info
        </legend>
            <label>Purchase id</label>
            <?php echo $id; ?>
        
            
            <label>Department</label>
            <p><?php echo $ds_id; ?></p>
            
            <label>Initialized by</label>
            <p><?php echo $created_by; ?></p>
        
            
            <label>Purchase category</label>
            <p><?php echo $purchase_category['name']; ?></p>
        
            <label>Purchase type</label>
            <p><?php echo $purchase_type; ?></p>
        
            <label>Item category</label>
            <p><?php echo $item_category; ?></p>
            
            <label>Item category</label>
            <p><?php echo $item_category; ?></p>
            <label>Item name</label>
            <p><?php echo $item_name; ?></p>
            
        <div >
            <label>Specification</label>
            <p><?php echo $specification; ?></p>
            
        </div>
        <div >
            <label>Justification</label>
            <p><?php echo $justification; ?></p>
            
        </div>
        <div >
            <label>Purpose of purchase</label>
            <p><?php echo $specification; ?></p>
            
        </div>
        <div >
            <label>Quantity</label>
            <p><?php echo $total_quantity; ?></p>
            
        </div>
        <div >
            <label>Unit price</label>
            <p><?php echo $unit_price; ?></p>
            
        </div>
        <div>
            <label>Total amount</label>
            <p><?php echo $estimated_cost; ?></p>
            
        </div>
        <div>
            <label>Payment method</label>
            <p><?php echo ($payment_mode==1)?"Cheque":"Cash"; ?></p>
            
        </div>

    </fieldset>
    <?php if(!empty($quotation_details_id)){
        ?>
    <fieldset >
        <legend>
            Attachments
        </legend>
        <label>File</label>
        <a href="index.php/uploads/<?php echo $file_name ?>" target="_blank"><?php echo $file_name ?></a>
        <label>No. of Quotations</label>
        <p><?php echo $no_of_quotation; ?></p>
        <label>Comparative statement</label>
        <p><?php echo $comperetive_statement; ?></p>
        <label>Justification</label>
        <p><?php echo $quotation_justification; ?></p>
        <label>Recommended Supplier</label>
        <p><?php echo $recommended_supplier; ?></p>
    </fieldset>
    <?php
    }else{
        ?>
        
        <fieldset >
            <h3>No attachments</h3>
        </fieldset>    
        
        <?php
        }
 ?>
    
    <?php if(!empty($inspection_report_id)){
        ?>
    
    <fieldset class="form_part_maintainance ">
        <legend>
            Inspection report
        </legend>
        <div>
            <label>Present status</label>
            <p><?php echo $present_status; ?></p>
            <label>Recommendation</label>
            <p><?php echo $recommendation; ?></p>
            <label>Inspector name</label>
            <p><?php echo $inspector_name; ?></p>
            <label>Designation</label>
            <p><?php echo $inspector_designation; ?></p>
            <label>Inspection date</label>
            <p><?php echo $inspection_date; ?></p>
            
        </div>
    </fieldset>
        <?php
        }
 ?>
    
    <fieldset>

        <legend>
            Existing Quantity
        </legend>
        <div>
            <label>Functioning</label>
            <p><?php echo $total_existing_functional_quantity; ?></p>
            
        </div>
        <div>
            <label>Non-functioning</label>
            <p><?php echo $total_existing_nonFunctional_quantity; ?></p>
            
        </div>
        
    </fieldset>
    <fieldset >
        <legend>
            Replace item info
        </legend>
        <label>Certified by</label>
        <p><?php echo $certified_by; ?></p>
        <label>Storing place of previous item</label>
        <p><?php echo $prev_item_storing_place; ?></p>
        
    </fieldset>
    <fieldset >
        <legend>
            Purchase history
        </legend>
        <label>Date of last purchase</label>
        <p><?php echo $last_purchase_date; ?></p>
        <label>Quantity of last purchase</label>
        <p><?php echo $last_purchase_quantity; ?></p>
        <label>Price/rate of last purchase</label>
        <p><?php echo $last_purchase_unit_rate; ?></p>
        <label>Total amount of last purchase</label>
        <p><?php echo $last_purchase_total_amount; ?></p>
        
    </fieldset>

    <fieldset>

        <legend>
            Advance payment
        </legend>
        <label>Advance amount</label>
        <p><?php echo $advance_amount; ?></p>
        <label>In favor of:</label>
        <p><?php echo $advance_in_favour_of; ?></p>
        <label>Date by which advance is required</label>
        <p><?php echo $required_advance_date; ?></p>
        <label>Estimated date by which advance will be settled</label>
        <p><?php echo $advance_settle_date; ?></p>
        
    </fieldset>
    <fieldset>
        <legend>
            Others
        </legend>
        <label>Budget Head</label>
        <p><?php echo $budget_head; ?></p>
        <label>Provision amount</label>
        <p><?php echo $provision_amount; ?></p>
        <label>If fund is short, from which head could be adjusted</label>
        <p><?php echo $adjusted_budget_if_not; ?></p>
        
    </fieldset>
</div>
