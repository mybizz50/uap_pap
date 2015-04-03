<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="height" align="left" valign="top"><script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>
		<?php
echo form_open('admin/save_stock_category', array('class'=>'formoid-metro-cyan','style'=>"background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
 ?>
 <?php if(!empty($ferror)){ ?>
    <div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
    <?php } ?>    

			<div class="title">
				<h2>Add New Stock Category</h2>
			</div>
			<div class="element-input" >
				<label class="title">Name</label>
				<input placeholder="Stock category Name" class="small" name="name" type="text" required value="<?php echo set_value('name'); ?>"/>
				<?php echo form_error('name','<p class="text-error">','</p>') ?>
			</div></div>
			<div id="formW">
				<table width="340" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left">
						<div class="element-textarea" >
							<label class="title">Description</label>							
							<textarea required class="small" name="description" cols="10" rows="3" ><?php echo set_value('description'); ?></textarea>
							<?php echo form_error('description','<p class="text-error">','</p>') ?></label>
</div>						</td>
					</tr>
				</table>
			</div>

			<div class="submit">
				<input type="submit" name="add_stock_category"  value="Create"/>
			</div>

		</form><script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script></td>
	</tr>
</table>