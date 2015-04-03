<?php echo $header; ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php include'navbar.php' ?></td>
  </tr>
  <tr>
    <td valign="top" >
    <table width="100%" border="0" cellspacing="0"   cellpadding="0">
  <tr>
    <td width="263" id="height" align="left" bgcolor="#1b1e23" valign="top" ><?php include 'SideBar.php' ?></td>
    <td width="100%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top">
		<!--/span-->
		<div class="span9">
			<div class="row-fluid">

				<?php echo $user_add_form; ?>
			</div>

		</div>

		<!--/row-->
	</div>
	<!--/row-->
</div>
  </td>
      </tr>
    </table></td>
  </tr>
</table>
    

<?php echo $footer; ?>


