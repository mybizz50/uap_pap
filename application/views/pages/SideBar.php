<table width="263" height="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>
		<td height="100%" align="left" valign="top" bgcolor="#1b1e23">
		<link href="/assets/new_assets/css/SideBarMenu2.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			$(document).ready(function() {

				$("#side_nav ul.child").removeClass("child");

				$("#side_nav li").has("ul").hover(function() {
					$(this).addClass("current").children("ul").fadeIn();
				}, function() {
					$(this).removeClass("current").children("ul").hide();
				});

			});
		</script>
		<div id="cssmenu">
			<ul>
				<li class='active'></li>
				<li class="has-sub" id="side_1">
					<a href="#"><span><img src="/assets/new_assets/images/glyphicons_202_shopping_cart.png" width="22" height="19" /> Purchase</span></a>
					<ul id="side_nav">
						<li id="side_sub_1">
							<a href='/purchase'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> General Purpose</span></a>
						</li>
						<li id="side_sub_12">
							<a href='#'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchase Through Advance</span></a>
							<ul class="triangle-isosceles left">
								<li >
									<a href="/purchase"> Advance</a>
								</li>
								<li >
									<a href="/purchase"> Requisition</a>
								</li>
							</ul>
						</li>
						<li id="side_sub_13">
							<a href='/purchase'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchase Through Administrative Approval</span></a>
						</li>
						<li id="side_sub_2">
							<a href='#'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Status</span></a>
						</li>
					</ul>
				</li>

				<li class="has-sub" id="side_2">
					<a href='#'><span><img src="/assets/new_assets/images/2.png" width="22" height="19" /> Admin</span></a>
					<ul id="side_nav">

						<li id="side_sub_22">
							<a href="#"><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Role</a>
							<ul class="triangle-isosceles left">
								<li >
									<a href="/admin/show_role/all/"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
								</li>
								<li >
									<a href="/admin/Add_role/"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
								</li>
							</ul>
						</li>
						<li id="side_sub_3">
							<a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> User</a>
							<ul class="triangle-isosceles left">
								<li >
									<a href="/admin/user_show/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
								</li>
								<li >
									<a href="/admin/user_add"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
								</li>
							</ul>
						</li>
						<li id="side_sub_4">
							<a href="#"><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Department</a>
							<ul class="triangle-isosceles left">
								<li >
									<a href="/admin/show_department/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
								</li>
								<li i>
									<a href="/admin/add_department"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
								</li>
							</ul>
						</li>
						<li id="side_sub_5">
							<a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock Edit</a>
							<ul class="triangle-isosceles left">
								<li >
									<a href="/admin/show_stock_category/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
								</li>
								<li >
									<a href="/admin/add_stock_category"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
								</li>
							</ul>
						</li>
						<li id="side_sub_6">
							<a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Supplier</a>
							<ul class="triangle-isosceles left">
								<li >
									<a href="/admin/show_supplier/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
								</li>
								<li >
									<a href="/admin/add_supplier"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<li class="has-sub" id="side_3">
					<a href='#'><span><img src="/assets/new_assets/images/3.png" width="23" height="20" /> Stock</span></a>
					<ul>
						<li id="side_sub_7">
							<a href='/stock/entry/'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock entry</a>
						</li>
						<li id="side_sub_8">
							<a href='/stock/stock_list'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock List</a>
						</li>
					</ul>
				</li>
				<li class="has-sub" id="side_5">
					<a href='#'><span><img src="/assets/new_assets/images/5.png" width="23" height="20" /> Distribution</span></a>
					<ul>
						<li id="side_sub_20">
							<a href='/distribution/entry/'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Distribution entry</a>
						</li>
						<li id="side_sub_21">
							<a href='/distribution/distribution_log'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Distribution Log</a>
						</li>
					</ul>
				</li>
				<li class="has-sub" id="side_4">
					<a href='#'><span><img src="/assets/new_assets/images/4.png" width="22" height="19" /> Report</span></a>
					<ul>
						<li id="side_sub_9">
							<a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchase Report</a>
						</li>
						<li id="side_sub_10">
							<a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock Report</a>
						</li>
						<li id="side_sub_11">
							<a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> User-Activity</a>
						</li>
					</ul>
				</li>
			</ul>
		</div></td>
	</tr>
</table>
