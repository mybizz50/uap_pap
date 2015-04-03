<script>
$(function () {
    $(".modal_open").click(function(){
        $(".modal_wrapper").stop().slideUp();
        $($(this).attr('data-target')).stop().slideToggle();
    });
    
});
</script>
<style type="text/css">
.modal_wrapper{
    display: none;
}
    [class^="icon-"], [class*=" icon-"] {
    background-image: url("/assets/img/glyphicons-halflings.png");
    background-position: 14px 14px;
    background-repeat: no-repeat;
    display: inline-block;
    height: 14px;
    line-height: 14px;
    margin-top: 1px;
    vertical-align: text-top;
    width: 14px;
    }
    
.icon-ban-circle {
    background-position: -216px -96px;
}

.icon-ok-circle {
    background-position: -192px -96px;
}

.icon-edit {
    background-position: -96px -72px;
}

.icon-user {
    background-position: -168px 0;
}

.icon-list-alt {
    background-position: -264px -24px;
}
    
</style>
 <div class="formoid-metro-cyan" style="background-color:#e5e9ec;font-size:13px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;"> 
   
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <div class="title"><h2>Activity log</h2></div></td>
  </tr>
</table>
<div>
<table width="100%" class="table table-striped">
    <thead>
        <tr>
            <th align="left">#</th>
            <th align="left">Log id</th>
            <th align="left">Log description</th>
            <th align="left">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;
         foreach($log as $a){?>
        <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $a['id'] ?></td>
            <td><?php echo $a['description'] ?></td>
            <td><?php echo $a['date'] ?></td>
            
        </tr>
        <?php } ?>
        <tr>
            <td colspan="4" align="center">
            <a style="width: auto; height:auto;   background: #2DA5DA; color: #fff; " class="btn btn-primary btn-small" href="/index.php/admin/show_activity_log/export" target="_blank">Export</a></td>
        </tr>
    </tbody>
</table>

</div>
</div>
