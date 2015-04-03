
<script type="text/javascript" src="/assets/new_assets/js/jquery-1.4.2.min.js"></script>

<form class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;" action="<?php echo base_url()?>index.php/reports/purchase_report" method="get">
    <div class="title"><h2>Search Filter</h2></div>
	
	


    <div  class="element-select" ><label class="title">Department</label><div class="small"><span><select id="type" name="ds_id">
		<option value="">All</option>
          <?php 
                foreach($depts as $item){
                    ?>
                    <option value="<?php echo $item['id']; ?>"><?php echo $item['ds_name'] ?></option> 
                    <?php
                }
                ?>
</select>
    <i></i></span></div></div>
     <div  class="element-select" ><label class="title">Purchase category</label><div class="small"><span><select id="type" name="purchase_category" >
		<option value="">All</option>
                                        <option value="1">General purpose</option>
			<option value="2">Purchase through Advance</option>
			<option value="3">Above TK. 50,000 - up to TK. 1,00,000</option>
			<option value="4">Above TK. 1,00,000 - up to TK. 2,00,000</option>
			<option value="5">Above TK. 2,00,000 - up to TK. 10,00,000</option>

</select>
    <i></i></span></div></div>
     <div  class="element-select" ><label class="title">Item category</label><div class="small"><span><select id="type" name="item_category" >
		
                                       <option value="">All</option>
			                     <?php 
                foreach($item_cats as $item){
                    ?>
                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name'] ?></option>
                    <?php
                }
                ?>

</select>
    <i></i></span></div></div>
     <div  class="element-select" ><label class="title">Purchase type</label><div class="small"><span><select id="type" name="purchase_type" >
	<option value="">All</option>
			                    <?php 
                foreach($p_types as $type){
                    ?>
                    <option value="<?php echo $type['id'] ?>"><?php echo $type['name'] ?></option>
                    <?php
                }
                ?>
</select>
    <i></i></span></div></div>
     <div  class="element-select" ><label class="title">Payment method</label><div class="small"><span><select id="type" name="payment_mode" >
		 <option value="">All</option>
			<option value="0">Cash</option>
			<option value="1">Cheque</option>

</select>
    <i></i></span></div></div>
     <div  class="element-select" ><label class="title">Purchase status</label><div class="small"><span><select id="type" name="purchase_status" >
		<option value="">All</option>
			<option value="0">In progress</option>
			<option value="1">Work order issued</option>

</select>
    <i></i></span></div></div>
     <div  class="element-select" ><label class="title">Distribution status</label><div class="small"><span><select id="type" name="distribution_status" >
		  <option value="">All</option>
			<option value="0">Available</option>
			<option value="1">Distributed</option>

</select>
    <i></i></span></div></div>
	<div id="formW"><label class="title">Amount range</label>
	<table width="350" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="140" align="left">
      <div class="element-select" ><div><span><input name="estimated_cost_lower" placeholder="From"  type="text" />
          <i></i></span></div></div>
    </td>
    <td width="160"><div class="element-input" ><input name="estimated_cost_upper" placeholder="Upto" type="text" />
	 </div></td>
  </tr>
</table></div>

 	<div id="formW"><label class="title">Date range</label>
	<table width="350" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="140" align="left">
      <div class="element-select" ><div><span><label>From</label><input name="date_from"  type="date" />
          <i></i></span></div></div>
    </td>
    <td width="160"><div class="element-input" ><label>Upto</label><input name="date_to" type="date" />
	 </div></td>
  </tr>
</table></div>


	 <div class="submit"><input type="submit" name="search" value="Search"/></div>
     
</form>
<script type="text/javascript" src="/assets/new_assets/js/formoid-metro-cyan.js"></script>









