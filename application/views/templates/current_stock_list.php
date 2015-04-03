<div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
     <div class="title">
      <h2>Current stock list (<?php echo $dept; ?>)</h2>
     </div></td>
  </tr>
</table>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr  >
    <td align="center" valign="top" id="table_stock_1"><strong>Serial No</strong></td>
    <td id="table_stock_1" align="center"><strong>Stock name</strong></td>
    <td id="table_stock_1" align="center"><strong>Distributed amount</strong></td>
    <td id="table_stock_1" align="center"><strong>Distribution date</strong></td>
    <td id="table_stock_1" align="center"><strong>Auctionable item</strong></td>
    <td id="table_stock_1" align="center"><strong>Wasted item</strong></td>
    <td id="table_stock_1" align="center"><strong>Available item</strong></td>
   <td id="table_stock_1" align="center"><strong>Action</strong></td>
    

  </tr>
  <?php if($list){
            $count = 0;
            foreach ($list as $a) {
            ?>
  <tr>
    <td  id="table_stock_2" align="center"><?php echo ++$count; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['title']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['distributed_quantity']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['date_distributed']; ?></td>
   <td id="table_stock_2" align="center"><?php echo $a['auctionable_items']; ?></td>
    <td id="table_stock_2" align="center"><?php echo $a['wasted_items']; ?></td>
   <td id="table_stock_2" align="center">

    <?php 
      $available_quantity = (int)$a['distributed_quantity']-((int)$a['auctionable_items']+(int)$a['wasted_items']);
      echo $available_quantity;

    ?>

   </td>
    <td id="table_stock_2" align="center">
      
      <?php
        if($available_quantity>0){
        ?>  <a href="/index.php/stock_management/manage_item/<?php echo $a['id'] ?>" style="width: auto; height:auto;   background: #2DA5DA; color: #fff; " class="btn btn-primary btn-small">Wastage management</a>
   
        <?php    
        }  
       ?>
    </td>
   
  </tr> <?php
            }
        }else{
            ?>
               <tr>
                   <td align="center" colspan="8">No stock available</td>
               </tr> 
            
            <?php
            
        } ?>
   
</table>


</div>
</div>