<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="height" align="left" valign="top"><script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script><?php
        echo form_open('admin/save_role', array('class' => 'formoid-metro-cyan','autocomplete'=>"off", 'style' => "background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"));
		?>
		<?php if(!empty($ferror)){
		?>
		<div class="alert alert-error">
			<strong>Ops ! </strong><?php echo $ferror; ?>
		</div><?php } ?>
		<div class="title">
			<h2>Add Role</h2>
		</div>
		<div class="element-input" >
			<label class="title">Role Name</label>
			<input name="name"  type="text" required value="<?php echo set_value('name'); ?>" />
			<?php echo form_error('name','<p class="text-error">','</p>') ?>
		</div>
		<div class="element-input" >
			<label class="title">Role for</label>
				<select id="section_option" name="role_for">
					<option value="department">Department</option>
					<option value="section">Section</option>
					<option value="rec_com">Recommendation commitee</option>
				</select>
		</div>
		<script type="text/javascript">
			$(function(){
				$(".section-list option").hide();
				$("#section_option").change(function(){
					$(".section-list option").hide();
					var val = "."+$("#section_option option:selected").val();
					$(".section-list").find(val).show();
					$(".section-list").find("option:visible").eq(0).prop("selected","selected");
				});
			});
		</script>
		<div class="element-input section-list">
			<label class="title">Select section : </label>
			<select name="section_id">
				<?php 
					foreach ($sections as $a) {
						?>
							<option class="<?php echo $a['ds_type']; ?>" value="<?php echo $a['id']; ?>"><?php echo $a['ds_name']; ?></option>
						<?php
					}
				?>
			</select>
			
		</div>
		<div class="element-input" >
			<label class="title">Rank : </label>
			<input type="text" name="rank">
		</div>
		
		
		</div>
		<div id="formW">
			<table width="340" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left">
					<div class="element-textarea" >
						<label class="title">Description</label>						
						<textarea required class="small" name="description" cols="10" rows="3" ><?php echo set_value('description'); ?></textarea>
						<?php echo form_error('description','<p class="text-error">','</p>') ?>
					</div></td>
				</tr>
			</table>
		</div>
		<div id="formW">
            <table width="340" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left">
                    <div class="element-textarea" >
                        <h3>Define role access</h3>
                        <input type="checkbox" name="user_mod_access" />
                        <span class="title" for="user_mod_access">User module access</span><br/>                        
                        
                        <input type="checkbox" name="purchase_mod_access" />
                        <span class="title" for="purchase_mod_access">Purchase module access</span><br/>                        
                        
                        <input type="checkbox" name="stock_mod_access" />
                        <span class="title" for="stock_mod_access">Stock module access</span><br/>                        
                        
                        
                        <input type="checkbox" name="admin_mod_access" />
                        <span class="title" for="admin_mod_access">Admin module access</span><br/>                        
                        
                        <!--
                        <input type="checkbox" name="read_only" />
                        <span class="title" for="read_only">Read only</span><br/> -->                       
                        
                    </div></td>
                </tr>
            </table>
        </div>
        <div class="submit">
			<input type="submit" name="add_role" value="Create"/>
		</div></form><script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script></td>
	</tr>
</table>