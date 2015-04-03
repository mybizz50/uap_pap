<?php echo $header; ?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $nav_logged; ?></td>
  </tr>
  <tr>
    <td valign="top" >
    <table width="100%" border="0" cellspacing="0"   cellpadding="0">
  <tr>
    <td width="263" id="height" bgcolor="#1b1e23" align="left" valign="top" ><?php echo $sidebar; ?></td>
    <td width="100%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top">
		
		<?php echo $content;  ?>
        
        </td>
      </tr>
    </table></td>
  </tr>
</table>
    
    </td>
  </tr>
</table>



<?php echo $footer; ?>
