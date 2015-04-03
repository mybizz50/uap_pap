<link href="index.php/assets/new_assets/css/SideBarMenu2.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

$(document).ready(function(){ 
	
	$("#side_nav ul.child").removeClass("child");
	
	$("#side_nav li").has("ul").hover(function(){
		$(this).addClass("current").children("ul").fadeIn();
	}, function() {
		$(this).removeClass("current").children("ul").hide();
	});
		
});
</script>
<div id="cssmenu">
<ul>
<li class='active'></li>
<li class="has-sub" id="side_1"><a href="#"><span><img src="/assets/new_assets/images/glyphicons_202_shopping_cart.png" width="22" height="19" /> Purchase</span></a>
<ul>
<li id="side_sub_1"><a href='index.php/purchase'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> New Entry</span></a></li>
<li id="side_sub_2"><a href='#'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Status</span></a></li>
</ul></li>

<li class="has-sub" id="side_2"><a href='#'><span><img src="/assets/new_assets/images/2.png" width="22" height="19" /> Admin</span></a>
<ul id="side_nav">

<li id="side_sub_22"><a href="#"><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Role</a>
<ul class="triangle-isosceles left">
<li ><a href="index.php/admin/show_role/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a></li>
<li ><a href="index.php/admin/add_role"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a></li>
</ul>
</li>
<li id="side_sub_3"><a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> User</a>
<ul class="triangle-isosceles left"><li ><a href="index.php/UserList.php"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a></li>
<li ><a href="index.php/Add_user.php"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a></li>
</ul>
</li>
<li id="side_sub_4"><a href="#"><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Department</a>
<ul class="triangle-isosceles left"><li ><a href="index.php/DepartmentList.php"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a></li>
<li i><a href="index.php/Add_dept.php"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a></li>
</ul>
</li>
<li id="side_sub_5"><a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock Edit</a>
<ul class="triangle-isosceles left"><li ><a href="index.php/StockCatList.php"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a></li>
<li ><a href="index.php/Add_stock_cat.php"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a></li>
</ul>
</li>
<li id="side_sub_6"><a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Supplier</a>
<ul class="triangle-isosceles left"><li ><a href="index.php/SupplierList.php"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a></li>
<li ><a href="index.php/Add_supplier.php"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a></li>
</ul>
</li>
</ul>
</li>

<li class="has-sub" id="side_3"><a href='#'><span><img src="/assets/new_assets/images/3.png" width="23" height="20" /> Stock</span></a>
<ul>
<li id="side_sub_7"><a href='index.php/stockEntry.php'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock entry</a></li>
<li id="side_sub_8"><a href='index.php/stockList.php'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock List</a></li>
</ul></li>
<li class="has-sub" id="side_4"><a href='#'><span><img src="/assets/new_assets/images/4.png" width="22" height="19" /> Report</span></a>
<ul>
<li id="side_sub_9"><a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchase Report</a></li>
<li id="side_sub_10"><a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock Report</a></li>
<li id="side_sub_11"><a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> User-Activity</a></li>
</ul></li>
</ul>
</div>
