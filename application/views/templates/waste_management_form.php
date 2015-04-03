<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="height" align="left" valign="top"><script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>
		    <?php
echo form_open('stock_management/manage_item/'.$id.'/update', array('class'=>'formoid-metro-cyan','style'=>"background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
 ?>
<?php if(!empty($ferror)){ ?>
    <div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
    <?php } ?>
    
		<form class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;" action="http://uap.dream2development.com/index.php/admin/send_registration_request" method="post">
			<div class="title">
				<h2>Waste management</h2>
			</div> 
			<div class="element-input" >
				<label class="title">Title</label>
				<input class="small" type="text" value="<?php echo $title; ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
   			</div>

   			<div class="element-input" >
				<label class="title">Available item</label>
				<input class="small" type="text" value="<?php echo $available; ?>">
   			</div>

   			<div class="element-input" >
				<label class="title">Auctionable amount</label>
				<input class="small" type="text" name="auctionable_item" value="0">
   			</div>

   			<div class="element-input" >
				<label class="title">Wasted amount</label>
				<input class="small" type="text" name="wasted_item" value="0">
   			</div>


			
			<div class="submit">
				<input type="submit"  value="Done"/>
			</div>

		</form><script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script></td>
	</tr>
</table>