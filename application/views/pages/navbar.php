
<script type='text/javascript' src='/assets/new_assets/js/jquery-1.4.2.min.js'></script>
<script type="text/javascript">
$(document).ready(function(){ 
	
	//$("#nav").removeClass("triangle-isosceles top");
	
	$("#nav li").has("ul").hover(function(){
		$(this).addClass("current").children("ul").fadeIn();
	}, function() {
		$(this).removeClass("current").children("ul").fadeOut();
	});
		
});
</script>
<link href="/assets/new_assets/css/formoid-metro-cyan2.css" rel="stylesheet" type="text/css" />


<table  width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#212121">
  <tr>
    <td width="81%" height="44"><link href="/assets/new_assets/css/navbar.css" rel="stylesheet" type="text/css" />

 <div class="formoid-metro-cyan2" style="font-size:10px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#eeeeee;" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="29">
         <table width="87%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="29%" height="47" align="center" valign="middle"><h2>
      <div ><a id="logoColor" href="/admin">University of Asia Pacific </a></div></h2></td>
    <td width="71%" align="left" valign="middle"><h2> <a href="/admin">Purchase & Inventory Management</a></h2></td>
  </tr>
</table>

     
    
          </td>
        </tr>
    </table></div></td>
     <td width="2%" align="left" valign="middle"><a href="/admin"><img src="/assets/new_assets/images/home.png" width="24" height="23" /></a></td>
    <td width="3%" align="right" valign="middle"><img src="/assets/new_assets/images/alert.png" width="26" height="25" /></td>
    <td width="14%" align="left" valign="middle" id="font_1">
  
    <ul id="nav">
            
                <li id="profShow">Mahmud <strong>Rahman</strong>
					<ul class="triangle-isosceles top">
						<li class="borer" title="Go to your profile"><a href="Profile.php"><img src="/assets/new_assets/images/profIcon.png" width="12" height="13" /> My Profile</a></li>
						<li class="borer" title="Edit your profile"><a href="/user/edit_profile"><img src="/assets/new_assets/images/edit.png" width="12" height="12" /> Edit Profile</a></li>
                        <li class="borer" title="Change your password"><a href="/user/change_pass"><img src="/assets/new_assets/images/psc.png" width="12" height="12" /> Password</a></li>
						<li class="borer" title="Click here to log out"><a href="/user/logout"><img src="/assets/new_assets/images/logout.png" width="12" height="12" /> Log Out</a></li>
					</ul>
				</li>
               
   	  </ul>
    
   
   
 
   </td>
  </tr>
</table>

