<table width="263" height="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>
        <td height="100%" align="left" valign="top" bgcolor="#1b1e23">
        <link href="<?php echo base_url(); ?>/assets/new_assets/css/SideBarMenu2.css" rel="stylesheet" type="text/css" />
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
                <?php if(!empty($access['purchase_mod_access'])){?> 
                <li class="has-sub" id="side_1">
                    <a href="#"><span>Purchase</span></a>
                    <ul id="side_nav">
                        <!-- <li id="side_sub_1">
                            <a href='<?php echo base_url(); ?>index.php/purchase/category/1'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> General Purpose</span></a>
                        </li> -->
                        <li id="side_sub_12">
                            <a href='#'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchase initiate</span></a>
                            <ul class="triangle-isosceles left">
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/purchase/form/1"> Form B</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/purchase/form/2"> Form B1</a>
                                </li>
                                <!-- <li >
                                    <a href="<?php echo base_url(); ?>index.php/purchase/form/3"> Form C</a>
                                </li> -->
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/purchase/form/4"> Form D</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li id="side_sub_13">
                            <a href='<?php echo base_url(); ?>index.php/purchase'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchase Through Administrative Approval</span></a>
                            <ul class="triangle-isosceles left">
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/purchase/category/3"> Above TK. 50,000 - up to TK. 1,00,000</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/purchase/category/4"> Above TK. 1,00,000 - up to TK. 2,00,000</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/purchase/category/5"> Above TK. 2,00,000 - up to TK. 10,00,000</a>
                                </li>
                            </ul>
                        </li> -->
                        <li id="side_sub_2">
                            <a href='<?php echo base_url(); ?>index.php/purchase/purchase_list'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchases</span></a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub" id="side_101">
                    <a href="#"><span>Bill process</span></a>
                    <ul id="side_sub_101">
                        <li>
                            <a href='<?php echo base_url(); ?>index.php/bill_process/submit_new_bill'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Submit new bill</span></a>
                        </li>
                        <li>
                            <a href='<?php echo base_url(); ?>index.php/bill_process/bill_process_list'><span><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Billing status</span></a>
                        </li>
                        
                    </ul>
                </li>
                <?php } ?>

                <?php if(!empty($access['admin_mod_access'])){?> 
                    
                <li class="has-sub" id="side_2">
                    <a href='#'><span>Admin</span></a>
                    <ul id="side_nav">

                        <li id="side_sub_22">
                            <a href="#"><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Role</a>
                            <ul class="triangle-isosceles left">
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/show_role/all/"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/Add_role/"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
                                </li>
                            </ul>
                        </li>
                        <li id="side_sub_3">
                            <a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> User</a>
                            <ul class="triangle-isosceles left">
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/user_show/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/user_add"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
                                </li>
                            </ul>
                        </li>
                        <li id="side_sub_4">
                            <a href="#"><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Department</a>
                            <ul class="triangle-isosceles left">
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/show_department/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
                                </li>
                                <li i>
                                    <a href="<?php echo base_url(); ?>index.php/admin/add_department"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
                                </li>
                            </ul>
                        </li>
                        <li id="side_sub_5">
                            <a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock Edit</a>
                            <ul class="triangle-isosceles left">
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/show_stock_category/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/add_stock_category"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
                                </li>
                            </ul>
                        </li>
                        <li id="side_sub_6">
                            <a href='#'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Supplier</a>
                            <ul class="triangle-isosceles left">
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/show_supplier/all"><img src="/assets/new_assets/images/list.png" width="12" height="12" /> List</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url(); ?>index.php/admin/add_supplier"><img src="/assets/new_assets/images/add.png" width="12" height="12" /> Add</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <?php } ?>

                <?php if(!empty($access['stock_mod_access'])){?> 
                    
                <!-- <li class="has-sub" id="side_3">
                    <a href='#'><span>Stock</span></a>
                    <ul>
                        <li id="side_sub_7">
                            <a href='<?php echo base_url(); ?>index.php/stock/entry/'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock entry</a>
                        </li>
                        <li id="side_sub_8">
                            <a href='<?php echo base_url(); ?>index.php/stock/stock_list'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock List</a>
                        </li>
                    </ul>
                </li> -->
                <?php } ?>
                <?php if(!empty($access['admin_mod_access'])){?> 

                <!-- 
                <li class="has-sub" id="side_5">
					<a href='#'><span>Distribution</span></a>
					<ul>
						<li id="side_sub_20">
							<a href='<?php echo base_url(); ?>index.php/distribution/entry/'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Distribution entry</a>
						</li>
						<li id="side_sub_21">
							<a href='<?php echo base_url(); ?>index.php/distribution/distribution_log'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Distribution Log</a>
						</li>
					</ul>
				</li>
 -->                <?php } ?>
                
                <!-- <li class="has-sub" id="side_77">
                    <a href='<?php echo base_url(); ?>index.php/stock_management/current_stock_list/'><span>Wastage management</span></a>
                    
                </li>
 -->
                <?php if(!empty($access['admin_mod_access'])){?> 

                <li class="has-sub" id="side_4">
                    <a href='#'><span>Report</span></a>
                    <ul>
                        <li id="side_sub_9">
                            <a href='<?php echo base_url(); ?>index.php/reports'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Purchase Report</a>
                        </li>
                        <li id="side_sub_10">
                            <a href='<?php echo base_url(); ?>index.php/stock/stock_report'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> Stock Report</a>
                        </li>
                        <li id="side_sub_11">
                            <a href='<?php echo base_url(); ?>index.php/admin/show_activity_log/'><img src="/assets/new_assets/images/1.png" width="14" height="12" /> User-Activity</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>

            </ul>
        </div></td>
    </tr>
</table>
