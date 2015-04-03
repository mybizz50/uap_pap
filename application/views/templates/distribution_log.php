<div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
		 <div class="title"><h2>Distribution Log</h2></div></td>
  </tr>
</table>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr  >
    <td align="center" valign="top" id="table_stock_1"><strong>Serial No</strong></td>
    <td id="table_stock_1" align="center"><strong>Stock name</strong></td>
    <td id="table_stock_1" align="center"><strong>Distributed to</strong></td>
    <td id="table_stock_1" align="center"><strong>Distributed amount</strong></td>
    <td id="table_stock_1" align="center"><strong>Distribution date</strong></td>
   
  </tr>
  <?php if($list){
            $count = 0;
            foreach ($list as $a) {
            ?>
  <tr>
    <td  id="table_stock_2" align="center"><?php echo ++$count; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['stock_name']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['distributed_to']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['distributed_quantity']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['date_distributed']; ?></td>
   
  </tr> <?php
            }
        }else{
            ?>
               <tr>
                   <td align="center" colspan="8">No distribution log</td>
               </tr> 
            
            <?php
            
        } ?>
   
</table>


</div>
</div>