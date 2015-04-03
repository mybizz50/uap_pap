<script> 
$(document).ready(function(){
	$("xxx").ready(function(){
		$("#attchmnt_hide_show_1").hide();
		$("#attchmnt_hide_show_2").hide();
		$("#attchmnt_hide_show_3").hide();
	});
  $("#attchmnt").click(function(){
    $("#attchmnt_hide_show_1").slideToggle("slow");
    $("#attchmnt_hide_show_2").slideToggle("slow");	
    $("#attchmnt_hide_show_3").slideToggle("slow");		
  });
  
});
</script>
