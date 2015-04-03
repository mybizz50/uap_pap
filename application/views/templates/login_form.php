    <script>
function validateForm()
{
var x=document.forms["login_form"]["username"].value;
var y=document.forms["login_form"]["password"].value;
     if ((y==null || y=="") && (x==null || x=="") )
  {
  alert("Username & Password must be filled out");
  return false;
  }
else if (x==null || x=="")
  {
  alert("Username must be filled out");
  return false;
  }
  else if (y==null || y=="")
  {
  alert("Password must be filled out");
  return false;
  }

}
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_assets/css/formoid-metro-cyan.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_assets/js/jquery-1.4.2.min"></script>
<?php echo form_open('user/login',array('class'=>'formoid-metro-cyan','onsubmit'=>'return validateForm()','style'=>"background-color:#e5e9ec;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:300px;min-width:150px",'name'=>'login_form')) ?>

	<div id="logo_pos"><h2> <img src="<?php echo base_url(); ?>/assets/new_assets/images/logo_2.png" width="112" height="120"></h2>
	</div>
    <div id="pos">Inventory & Purchase Management</div>
  <div class="title"><h2>Log in</h2></div>
  <?php if(!empty($ferror)){ ?>
	<div class="alert alert-error">
        <strong>Ops ! </strong> <?php echo $ferror; ?>
    </div>
	<?php } ?>    
	
	<div class="element-input" ><label class="title">Username</label><input placeholder="Username" class="large" type="text" name="username" /></div>
	<div class="element-password" ><label class="title">Password</label><input placeholder="Password" class="large" type="password" name="password" value="" /></div>

<div class="submit"><input type="submit" value="Log in"/></div></form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_assets/js/formoid-metro-cyan.js"></script>
