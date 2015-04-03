 <div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
		 <div class="title"><h2>Stock list</h2></div></td>
  </tr>
</table>
<div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
    <thead>
        <tr>
            <td align="center" valign="top" id="table_stock_1"><strong>Serial No</strong></td>
            <th align="center" valign="top" id="table_stock_1">Product name</th>
            <th align="center" valign="top" id="table_stock_1">Category</th>
            <th align="center" valign="top" id="table_stock_1">Entry date</th>
            <th align="center" valign="top" id="table_stock_1">Total quantity</th>
            <th align="center" valign="top" id="table_stock_1">Available quantity</th>
            <th align="center" valign="top" id="table_stock_1">action</th>
        </tr>
    </thead>
    <tbody>
        <?php if($list){
            $count = 0;
            foreach ($list as $a) {
            ?>
           <tr>
               <td id="table_stock_2" align="center"><?php echo ++$count; ?></td>
               <td id="table_stock_2" align="center"><?php echo $a['product_name']; ?></td>
               <td id="table_stock_2" align="center"><?php echo $a['category_name']; ?></td>
               <td id="table_stock_2" align="center"><?php echo $a['entry_date']; ?></td>
               <td id="table_stock_2" align="center"><?php echo $a['quantity']; ?></td>
               <td id="table_stock_2" align="center"><?php echo $a['available_quantity']; ?></td>
               <td id="table_stock_2" align="center">
                   <?php
                    if((int)$a['available_quantity']){
                    ?>
                        <a href="/index.php/distribution/entry/" style="width: auto; height:30px;   background: #2DA5DA; color: #fff; " class="btn btn-primary btn-small">Distribute</a> 
                    <?php    
                    }  
                   ?>
                   <?php 
                        if((int)$a['available_quantity'] != (int)$a['quantity']){
                            ?>
                            <a style="width: auto; background: #2DA5DA; color: #fff; height:30px;" href="/index.php/distribution/distribution_log/<?php echo $a['id'] ?>" class="btn btn-primary btn-small">Distribution log</a>
                            <?php
                        }
                   ?>
               </td>
           </tr> 
            <?php
            }
        }else{
            ?>
               <tr>
                   <td align="center" colspan="8">No stock entry</td>
               </tr> 
            
            <?php
            
        } ?>
    </tbody>
    
</table>

</div>
</div>