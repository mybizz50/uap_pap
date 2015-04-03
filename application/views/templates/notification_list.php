
 <div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">  
     <div class="title"><h2>You have following notifications</h2></div></td>
  </tr>
</table>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<?php
        foreach($listItems as $item){
		?>
  <tr>
    <td width="3%" align="left" class="EditRow"  id="table_stock_2"><li><a href="/index.php/purchase/notification/<?php echo $item['id'] ?>"><?php echo $item['message']; ?>
			<br/>
			<i><?php echo $item['date'] ?></i></a></li></td>
    
   
  </tr>
  <?php
        }
		?>

   
</table>


</div>
</div>