<div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
		 <div><h2>Search results</h2></div></td>
  </tr>
</table>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr  >
    <td align="center" valign="top" id="table_stock_1"><strong>No.</strong></td>
    <td id="table_stock_1" align="center"><strong>Purchase type</strong></td>
    <td id="table_stock_1" align="center"><strong>Department</strong></td>
    <td id="table_stock_1" align="center"><strong>Purchase category</strong></td>
    <td id="table_stock_1" align="center"><strong>Item category</strong></td>
    <td id="table_stock_1" align="center"><strong>Item name</strong></td>
    <td id="table_stock_1" align="center"><strong>Total unit</strong></td>
    <td id="table_stock_1" align="center"><strong>Unit price</strong></td>
    <td id="table_stock_1" align="center"><strong>Total cost</strong></td>
    <td id="table_stock_1" align="center"><strong>Initiated date</strong></td>
    <td id="table_stock_1" align="center"><strong>Initiated by</strong></td>
  </tr>
   <?php if($result){
		        $i = 0;
                foreach($result as $item){
                    ?>
  <tr>
    <td  id="table_stock_2" align="center"><?php echo ++$i; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['purchase_type']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['ds_id']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['purchase_category']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['item_category']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['item_name']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['total_quantity']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['unit_price']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['estimated_cost']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['created_date']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $item['created_by']; ?></td>
  </tr>
   <?php
                }
		    }else{
		        ?>
		          <tr>
                    <td><p>No elements found</p></td>
                  </tr>    
		        <?php
		    }?>
   
</table>


</div>
   
      





