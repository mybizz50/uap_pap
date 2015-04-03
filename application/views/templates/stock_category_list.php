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
    <div class="title"><h2>All Stock Category</h2></div></td>
  </tr>
</table>
<div>
<table width="100%" class="table table-striped">
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
         foreach($stock_categories as $stock_category){?>
        <tr class="<?php echo ($stock_category['stock_category_status']==0)?"locked":"" ?>">
            <td><?php echo ++$i; ?></td>
            <td><?php echo $stock_category['name'] ?></td>
            <td><?php echo $stock_category['description'] ?></td>
            <td>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Detail"> <span class="icon-list-alt modal_open" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"></span> </a>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Edit"> <span class="icon-edit modal_open" data-toggle="modal" data-target="#myModal1<?php echo $i; ?>"></span> </a>
                <?php if($stock_category['stock_category_status']==0){
                    ?>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Unlock"> <span class="icon-ok-circle modal_open" data-toggle="modal" data-target="#myModal2<?php echo $i; ?>"></span> </a>    
                    <?php
                }else{
                ?>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Lock"> <span class="icon-ban-circle modal_open" data-toggle="modal" data-target="#myModal2<?php echo $i; ?>"></span> </a>
                <?php    
                }
                
                ?>
                
            </td>
        </tr>
        <tr>
            <td bgcolor="#dfe3e6" colspan="4">
                <div id="myModal<?php echo $i; ?>" class="modal hide fade modal_wrapper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                   
                    <h3 id="myModalLabel">Department Details</h3>
                </div>
                <div class="modal-body">
                    <dl class="dl-horizontal">
                        <dt>
                            <b>  Name:</b> <?php echo $stock_category['name'] ?>
                        </dt>
                      
                        <dt>
                            <b>  Description:</b><?php echo $stock_category['description'] ?>
                        </dt>
                       
                        <dt>
                          <b>    Status:</b><?php echo $stock_category['stock_category_status']?"Unlocked":"Locked" ?>
                        </dt>
                       
                    </dl>

                </div>
                <div class="modal-footer"></div>
            </div>
            <form autocomplete="off" method="post" action="<?php echo base_url()?>index.php/admin/edit_stock_category/" id="myModal1<?php echo $i; ?>" class="modal hide fade modal_wrapper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                   
                    <h3 id="myModalLabel">Edit Info</h3>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label" for="stock_categoryName<?php echo $i; ?>">Name</label>
                        <div class="controls">
                            <input type="hidden" name="id" value="<?php echo $stock_category['id']; ?>"> 
                            <input class="small"  type="text" id="stock_categoryName<?php echo $i; ?>" placeholder="Category Name" name="name" value="<?php echo $stock_category['name'] ?>">
                            <p class="text-error" style="display: none">Category name should not be empty</a>  
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="stock_categoryDes<?php echo $i; ?>">Description</label>
                        <div class="controls">
                        	<table width="260" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left">
                            <textarea class="small"  id="stock_categoryDes<?php echo $i; ?>" name="description"><?php echo $stock_category['description'] ?></textarea>
                            <p class="text-error" style="display: none">Category description should not be empty</a>
                            	</td></tr></table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <script>
                        $(function(){
                            $("#myModal1<?php echo $i; ?>").submit(function(e){
                                var error = false;
                                var input = $("#stock_categoryName<?php echo $i; ?>, #stock_categoryDes<?php echo $i; ?>");
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
                    <button class="submit" type="submit" id="save_stock_category<?php echo $i; ?>">
                        Save changes
                    </button>
                    <button class="submit" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </form>
            <form method="post" action="<?php echo base_url()?>index.php/admin/change_stock_category_status" id="myModal2<?php echo $i; ?>" class="modal hide fade modal_wrapper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                  
                    <h3 id="myModalLabel"><?php echo ($stock_category['stock_category_status']==0)?"Unlock":"Lock" ?> category</h3>
                </div>
                <div class="modal-body">
                    <p>
                        <input type="hidden" name="id" value="<?php echo  $stock_category['id']; ?>">
                        <input type="hidden" name="status" value="<?php echo  ($stock_category['stock_category_status']==0)?1:0;?>">
                    
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
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>


</div>
</div>
