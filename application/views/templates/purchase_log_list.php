<div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <div class="title"><h2>Purchase Report</h2></div></td>
  </tr>
</table>
<div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
		 <h3 style="text-align:center"><?php echo $title; ?></h3></td>
  </tr>
</table>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr  >
    <td align="center" valign="top" id="table_stock_1"><strong>Sl. no.</strong></td>
    <td id="table_stock_1" align="center"><strong>Date</strong></td>
    <td id="table_stock_1" align="center"><strong>From</strong></td>
    <td id="table_stock_1" align="center"><strong>Comments</strong></td>
    <td id="table_stock_1" align="center"><strong>Action</strong></td>
  </tr>
   <?php
            $counter = 0; 
            foreach($purchase_log_list as $log){
                ?>
  <tr>
    <td  id="table_stock_2" align="center"><?php echo ++$counter; ?></td>
    <td id="table_stock_2" align="center"><?php echo $log['time']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $log['assigned_by'];?></td>
    <td id="table_stock_2" align="center"><?php echo $log['comments'] ?></td>
    <td id="table_stock_2" align="center"><?php echo $log['action']?></td>
   
  </tr>  <?php
            }
        ?>
   
</table>
