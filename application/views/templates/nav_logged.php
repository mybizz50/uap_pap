
<script type='text/javascript' src='/assets/new_assets/js/jquery-1.4.2.min.js'></script>
<script type="text/javascript">
	$(document).ready(function() {

		//$("#nav").removeClass("triangle-isosceles top");

		$("#nav li").has("ul").hover(function() {
			$(this).addClass("current").children("ul").stop().fadeIn();
		}, function() {
			$(this).removeClass("current").children("ul").stop().fadeOut();
		});

    //$("#nav li").addClass("current").children("ul").stop().fadeIn();

	}); 
</script>
<link href="index.php/assets/new_assets/css/formoid-metro-cyan2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  #nav li{
    float: left;
    padding: 0px 10px;
    position: relative;
  }

  #nav li ul{
    width: 250px;
    right: 50%;
    margin-right: -125px;
  }

  #nav li ul li{
    border-bottom: #ccc solid 1px;
    width: auto;
    display: block;
    float: none;
  }

  #nav li ul li i{
    display: block;
    font-size: 12px;
    color: #ccc;
  }

  .triangle-isosceles.top:after{
   right: 50%;
    margin-right: -12px; 
  }
</style>

<table  width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#212121">
  <tr>
    <td width="50%" height="44"><link href="/index.php/assets/new_assets/css/navbar.css" rel="stylesheet" type="text/css" />

 <div class="formoid-metro-cyan2" style="font-size:10px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#eeeeee;" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="29">
         <table width="87%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="29%" height="47" align="center" valign="middle"><h2>
      <div ><a id="logoColor" href="/index.php/admin">University of Asia Pacific </a></div></h2></td>
    <td width="71%" align="left" valign="middle"><h2> <a href="/index.php/admin">Purchase & Inventory Management</a></h2></td>
  </tr>
</table>

     
    
          </td>
        </tr>
    </table></div></td>
     <td width="2%" align="left" valign="middle"><a href="/index.php/admin"><img src="/assets/new_assets/images/home.png" width="24" height="23" /></a></td>
    <td width="44%" align="left" valign="middle" id="font_1">
  
    <ul id="nav">
            <li id="profShow"><strong><i style="background: none repeat scroll 0% 0% orange; padding: 3px 5px; border-radius: 20px; display: inline-block; text-align: center; width: 14px; color: rgb(255, 255, 255); font-weight: bold;"><?php echo count($purchase_notification); ?></i>Purchase process</strong>
                    <ul class="triangle-isosceles top">
                      
                        <?php 
                        //print_r($purchae_notication);
                        foreach ($purchase_notification as $item) {
                          if(!count($purchase_notification)){
                            break;
                          }
                          ?>


                        <li class="borer" title="<?php echo $item['msg']; ?>">
                          <a href="<?php echo $item['url'] ?>"><?php echo $item['msg']; ?></a>
                          <i><?php echo $item['ago']; ?></i>
                        </li>
                        <?php
                        } ?>

                    </ul>
                </li>
                <li id="profShow"><strong><i style="background: none repeat scroll 0% 0% orange; padding: 3px 5px; border-radius: 20px; display: inline-block; text-align: center; width: 14px; color: rgb(255, 255, 255); font-weight: bold;"><?php echo count($bill_notification); ?></i>Billing process</strong>
                    <ul class="triangle-isosceles top">
                      
                        <?php 
                        //print_r($purchae_notication);
                        foreach ($bill_notification as $item) {
                          if(!count($bill_notification)){
                            break;
                          }
                          ?>


                        <li class="borer" title="<?php echo $item['msg']; ?>">
                          <a href="<?php echo $item['url'] ?>"><?php echo $item['msg']; ?></a>
                          <i><?php echo $item['ago']; ?></i>
                        </li>
                        <?php
                        } ?>

                    </ul>
                </li>
                <li id="profShow"><strong><i style="background: none repeat scroll 0% 0% orange; padding: 3px 5px; border-radius: 20px; display: inline-block; text-align: center; width: 14px; color: rgb(255, 255, 255); font-weight: bold;"><?php echo count($stock_notification); ?></i>Stock process</strong>
                    <ul class="triangle-isosceles top">
                      
                        <?php 
                        //print_r($purchae_notication);
                        foreach ($stock_notification as $item) {
                          if(!count($stock_notification)){
                            break;
                          }
                          ?>


                        <li class="borer" title="<?php echo $item['msg']; ?>">
                          <a href="<?php echo $item['url'] ?>"><?php echo $item['msg']; ?></a>
                          <i><?php echo $item['ago']; ?></i>
                        </li>
                        <?php
                        } ?>

                    </ul>
                </li>
                <li id="profShow"><strong><?php echo $name; ?></strong>
                    <ul class="triangle-isosceles top">
                        <li class="borer" title="Click here to log out"><a href="/index.php/user/logout">Log Out</a></li>
                        <li class="borer" title="Click here to log out"><a href="/index.php/user/update_password">Change password</a></li>
                    </ul>
                </li>
               
      </ul>
    
   
   
 
   </td>
  </tr>
</table>

