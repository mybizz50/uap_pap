<script>
$(function () {
    $(".modal_open").click(function(){
        $(".modal_wrapper").stop().slideUp();
        $($(this).attr('data-target')).stop().slideToggle();
    });
    
});
</script>
<style type="text/css">
.modal_wrapper{
    display: none;
}
    [class^="icon-"], [class*=" icon-"] {
    background-image: url("/assets/img/glyphicons-halflings.png");
    background-position: 14px 14px;
    background-repeat: no-repeat;
    display: inline-block;
    height: 14px;
    line-height: 14px;
    margin-top: 1px;
    vertical-align: text-top;
    width: 14px;
    }
    
.icon-ban-circle {
    background-position: -216px -96px;
}

.icon-ok-circle {
    background-position: -192px -96px;
}

.icon-edit {
    background-position: -96px -72px;
}

.icon-user {
    background-position: -168px 0;
}

.icon-list-alt {
    background-position: -264px -24px;
}
    
</style>
 <div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <div class="title"><h2>All Roles</h2></div></td>
  </tr>
</table>
<div>
<table  width="100%" cellspacing="0" cellpadding="3"  width="100%">
    <thead>
        <tr>
            <th align="left">#</th>
            <th align="left">Name</th>
            <th align="left">Description</th>
            <th align="left">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;
         foreach($roles as $role){?>
        <tr class="<?php echo ($role['role_status']==0)?"locked":"" ?>">
            <td><?php echo ++$i; ?></td>
            <td><?php echo $role['name'] ?></td>
            <td><?php echo $role['description'] ?></td>
            <td>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Detail"> <span class="icon-list-alt modal_open" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"></span> </a>
                <?php if(!$role['read_only']){
                    ?>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Edit"> <span class="icon-edit modal_open" data-toggle="modal" data-target="#myModal_1<?php echo $i; ?>"></span> </a>
                <?php if($role['role_status']==0){
                    ?>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Unlock"> <span class="icon-ok-circle modal_open" data-toggle="modal" data-target="#myModal-2<?php echo $i; ?>"></span> </a>    
                    <?php
                }else{
                ?>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Lock"> <span class="icon-ban-circle modal_open" data-toggle="modal" data-target="#myModal-2<?php echo $i; ?>"></span> </a>
                <?php    
                }
                }
                
                ?>
                
            </td>
            <tr>
                <td bgcolor="#dfe3e6" colspan="4">
                    <div id="myModal<?php echo $i; ?>" class="modal hide fade modal_wrapper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                   
                    <h3 id="myModalLabel">Role Details</h3>
                </div>
                <div class="modal-body">
                    <dl class="dl-horizontal">
                        <dt>
                           <b> Name:</b>
                        </dt>
                        <dd>
                            <?php echo $role['name'] ?>
                        </dd>
                        <dt>
                           <b> Role for:</b>
                        </dt>
                        <dd>
                            <?php echo $role['role_for'] ?>
                        </dd>
                        <?php if($role['role_for']=='section'){?>
                        <dt>
                           <b> Section:</b>
                        </dt>
                        <dd>
                            <?php
                            foreach ($sections as $a) {
                                 if($a['id'] == $role['section_id']){
                                    echo $a['ds_name'];
                                    break;
                                 }
                             }

                           // echo $role['section_id'] ?>
                        </dd>
                        <?php } ?>
                        <dt>
                           <b> Rank:</b>
                        </dt>
                        <dd>
                            <?php echo $role['rank'] ?>
                        </dd>
                        
                        <dt>
                           <b>    Description:</b>
                        </dt>
                        <dd>
                            <?php echo $role['description'] ?>
                        </dd>
                        <dt>
                            <b>   Status:</b>
                        </dt>
                        <dd>
                            <?php echo $role['role_status']?"Unlocked":"Locked" ?>
                        </dd>
                        <dt>
                            <b>   Accesses:</b>
                        </dt>
                        <dd>
                            <?php 
                                if($role['user_mod_access']){
                                    echo "User <br/>";
                                }
                                
                                if($role['purchase_mod_access']){
                                    echo "Purchase <br/>";
                                }
                                
                                if($role['stock_mod_access']){
                                    echo "Stock <br/>";
                                }
                                
                                if($role['admin_mod_access']){
                                    echo "Admin <br/>";
                                }
                                
                            ?>
                        </dd>
                        <dt>
                             <b>  Read only:</b>
                        </dt>
                        <dd>
                            <?php 
                                if($role['read_only']){
                                    echo "Yes";
                                }else{
                                    echo "No";
                                }
                                
                            ?>
                        </dd>
                    </dl>

                </div>
                <div class="modal-footer"></div>
            </div>
            <?php if(!$role['read_only']) {?>
                
            <form autocomplete="off" method="post" action="<?php echo base_url()?>index.php/admin/edit_role/" id="myModal_1<?php echo $i; ?>" class="modal hide fade modal_wrapper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    
                    <h3 id="myModalLabel">Edit Info</h3>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label" for="roleName<?php echo $i; ?>">Role Name</label>
                        <div class="controls">
                            <input type="hidden" name="id" value="<?php echo $role['id']; ?>">
                            <input type="text" class="small" id="roleName<?php echo $i; ?>" placeholder="Role Name" name="name" value="<?php echo $role['name'] ?>">
                            <p class="text-error" style="display: none">Role name should not be empty</a>  
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <div class="controls">
                            <input id="section_option<?php echo $i; ?>" type="checkbox" name="role_for" value="section" <?php echo $role['role_for']=='section'? 'checked="checked"':''; ?>> For section  
                        </div>
                    </div>
                    
                    <div class="control-group section-list<?php echo $i; ?>" <?php if($role['role_for']=='department') {?>style="display:none" <?php } ?>>
                        <label class="control-label" for="roleName<?php echo $i; ?>">Section</label>
                        <div class="controls">
                            <select name="section_id">
                                <?php 
                                    foreach ($sections as $a) {
                                        ?>
                                            <option value="<?php echo $a['id']; ?>" <?php if($a['id']==$role['section_id']){ ?> selected <?php } ?>><?php echo $a['ds_name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>  
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function(){
                            $("#section_option<?php echo $i; ?>").change(function(){
                                $(".section-list<?php echo $i; ?>").stop().slideToggle();    
                            });
                        });
                    </script>
        
                    <div class="control-group">
                        <label class="control-label" for="roleName<?php echo $i; ?>">Rank</label>
                        <div class="controls">
                            <input type="text" class="small" name="rank" value="<?php echo $role['rank'] ?>">
                              
                        </div>
                    </div>
                    

                    <div class="control-group">
                        <label class="control-label" for="roleDes<?php echo $i; ?>">Description</label>
                        <div class="controls">
                        	<table width="260" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left">
                            <textarea  class="small"  id="roleDes<?php echo $i; ?>" name="description"><?php echo $role['description'] ?></textarea>
                            <p class="text-error" style="display: none">Role description should not be empty</a>
                            </td></tr></table>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="roleDes<?php echo $i; ?>">Edit Access</label>
                        <div class="controls">
                            
                        <input type="checkbox" name="user_mod_access" <?php echo empty($role['user_mod_access'])?"":"checked='checked'"; ?> />
                        <span class="title" for="user_mod_access">User module access</span><br/>                        
                        
                        <input type="checkbox" name="purchase_mod_access"  <?php echo empty($role['purchase_mod_access'])?"":"checked='checked'"; ?>/>
                        <span class="title" for="purchase_mod_access">Purchase module access</span><br/>                        
                        
                        <input type="checkbox" name="stock_mod_access"  <?php echo empty($role['stock_mod_access'])?"":"checked='checked'"; ?>/>
                        <span class="title" for="stock_mod_access">Stock module access</span><br/>                        
                        
                        
                        <input type="checkbox" name="admin_mod_access" <?php echo empty($role['admin_mod_access'])?"":"checked='checked'"; ?> />
                        <span class="title" for="admin_mod_access">Admin module access</span><br/>                        
                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <script>
                        $(function(){
                            $("#myModal1<?php echo $i; ?>").submit(function(e){
                                var error = false;
                                var input = $("#roleName<?php echo $i; ?>, #roleDes<?php echo $i; ?>");
                                input.each(function(){
                                    if($.trim($(this).val())==''){
                                        $(this).next(".text-error").show();
                                        error = true;
                                    }else{
                                        $(this).next(".text-error").hide();
                                    }
                                    
                                });
                                if(error){
                                    e.preventDefault();
                                    return false;
                                }
                                });
                        });
                    </script>
                    <button class="submit" type="submit" id="save_role<?php echo $i; ?>">
                        Save changes
                    </button>
                    <button class="submit" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </form>
            <form method="post" action="<?php echo base_url()?>index.php/admin/change_role_status" id="myModal-2<?php echo $i; ?>" class="modal hide fade modal_wrapper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    
                    <h3 id="myModalLabel"><?php echo ($role['role_status']==0)?"Unlock":"Lock" ?> role</h3>
                </div>
                <div class="modal-body">
                    <p>
                        <input type="hidden" name="id" value="<?php echo  $role['id']; ?>">
                        <input type="hidden" name="status" value="<?php echo  ($role['role_status']==0)?1:0;?>">
                    
                        Are you sure ?
                    </p>
                    

                </div>
                <div class="modal-footer">
                    <button class="submit" type="submit">
                        Sure
                    </button>
                    <button class="submit" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </form>
            <?php
                }?>
                </td>
            </tr>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</div>