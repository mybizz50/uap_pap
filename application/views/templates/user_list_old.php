<script>
$(function () {
    $(".modal_open").click(function(){
        $(".modal_wrapper").stop().slideUp();
        $($(this).attr('data-target')).stop().slideToggle();
    });
    
    $("button.close").click(function(){
        $(this).closest('.modal_wrapper').stop().slideUp();
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
    
</style>
 <div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
     <div class="title"><h2>All Users</h2></div></td>
  </tr>
</table>
<div>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=0; 
        //print_r($users);
        foreach($users as $user){
        ?>
        <tr class="<?php echo ($user['account_status']==0)?"locked":"" ?>">
            <td><?php echo ++$i; ?></td>
            <td><?php echo $user['first_name']." ".$user['last_name'] ?></td>
            <td><?php echo $user['email_address'] ?></td>
            <td><?php echo $user['department']['name'] ?></td>
            <td><?php echo $user['role']['name'] ?></td>
            <td>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Detail"> <span class="icon-user modal_open" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"></span> </a>
                <a title="" class="tooltip_class" data-toggle="tooltip" href="#" data-original-title="Edit"> <span class="icon-edit modal_open" data-toggle="modal" data-target="#myModal1<?php echo $i; ?>"></span> </a>
                <?php if($user['account_status']==0){
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
        <tr>
            <td colspan="6">
                <div id="myModal<?php echo $i; ?>" class="modal hide fade modal_wrapper modal_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                    <h3 id="myModalLabel"><?php echo $user['first_name'] ?>'s Details</h3>
                </div>
                <div class="modal-body">
                    <dl class="dl-horizontal">
                        <dt>
                            Name
                        </dt>
                        <dd>
                            <?php echo $user['first_name']." ".$user['last_name'] ?>
                        </dd>
                        <dt>
                            Email
                        </dt>
                        <dd>
                            <?php echo $user['email_address'] ?>
                        </dd>
                        <dt>
                            Role
                        </dt>
                        <dd>
                            <?php echo $user['role']['name'] ?>
                        </dd>
                        <dt>
                            Actual Role
                        </dt>
                        <dd>
                            <?php echo $user['actual_role']['name'] ?>
                        </dd>
                        
                        <dt>
                            Dept.
                        </dt>
                        <dd>
                            <?php echo $user['department']['name'] ?>
                        </dd>
                        <dt>
                            Designation
                        </dt>
                        <dd>
                            <?php echo $user['designation']?>
                        </dd>
                        <dt>
                            Contact Num.
                        </dt>
                        <dd>
                            <?php echo $user['contact_number']?>
                        </dd>
                        <dt>
                            Status
                        </dt>
                        <dd>
                            <?php echo $user['account_status']?"Unlocked":"Locked" ?>
                        </dd>
                    </dl>

                </div>
                <div class="modal-footer"></div>
            </div>
            <form autocomplete="off" method="post" id="myModal1<?php echo $i; ?>" action="<?php echo base_url()?>admin/edit_user/<?php echo $user['id'] ?>" class="modal hide fade modal_wrapper modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                    <h3 id="myModalLabel">Edit Info</h3>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Email</label>
                        <div class="controls">
                            <input type="text" id="inputEmail" placeholder="Email" name="email" value="<?php echo $user['email_address'] ?>">
                            <p class="text-error" style="display: none" id="emailError">This email is not valid</a>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputRole">Role</label>
                        <div class="controls">
                            <?php
                                echo form_dropdown('role', $role_options,$user['role']['id']);
                            ?>

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputRole">Actual role</label>
                        <div class="controls">
                            <?php
                                echo form_dropdown('actual_role', $role_options,$user['actual_role']['id']);
                            ?>

                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="changeInfo">
                        Save changes
                    </button>
                    <script>
                        $(function(){
                            $("#changeInfo").click(function(e){
                                var email = $("#inputEmail").val();
                                if(!email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/)){
                                       $("#emailError").show();
                                       e.preventDefault();
                                       return false;
                                }
                                $("#emailError").hide();
                                });
                        });
                    </script>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </form>
            <form method="post" id="myModal2<?php echo $i; ?>" action="<?php echo base_url()?>admin/change_user_status/<?php echo $user['id']; ?>/<?php echo ($user['account_status']==0)?1:0 ?>" class="modal hide fade modal_wrapper modal_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                    <h3 id="myModalLabel"><?php echo ($user['account_status']==0)?"Unlock":"Lock" ?> user</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure ?
                    </p>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">
                        Sure
                    </button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </form>
            </td>
        </tr>    
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>


</div>
</div>