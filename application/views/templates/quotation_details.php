<style type="text/css">
    label {
        color: #000;
        font-weight: bold;
    }
</style>
<h3>Quotation Details</h3>
<div class="form-horizontal">

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
</div>
