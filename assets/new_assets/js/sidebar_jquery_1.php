<script> 
$(document).ready(function(){
	$("#side_1").ready(function(){
		$("#side_sub_7").hide();
		$("#side_sub_8").hide();
		$("#side_sub_9").hide();
		$("#side_sub_10").hide();
		$("#side_sub_11").hide();
		$("#side_sub_12").hide();
		$("#side_sub_13").hide();
		$("#side_sub_22").hide();
		$("#side_sub_20").hide();
		$("#side_sub_21").hide();
		$("#side_sub_101").hide();
		
	});
	
  $("#side_1").click(function(){
    $("#side_sub_1").slideToggle("slow");
	$("#side_sub_2").slideToggle("slow");
	$("#side_sub_12").slideToggle("slow");
	$("#side_sub_13").slideToggle("slow");	

  });

  $("#side_101").click(function(){
    $("#side_sub_101").slideToggle("slow");
  });

    $("#side_2").click(function(){
    $("#side_sub_3").slideToggle("slow");
	$("#side_sub_4").slideToggle("slow");
	$("#side_sub_5").slideToggle("slow");
	$("#side_sub_6").slideToggle("slow");
	$("#side_sub_22").slideToggle("slow");
  });
   $("#side_3").click(function(){
    $("#side_sub_7").slideToggle("slow");
	$("#side_sub_8").slideToggle("slow");
  });
   $("#side_4").click(function(){
    $("#side_sub_9").slideToggle("slow");
	$("#side_sub_10").slideToggle("slow");
	$("#side_sub_11").slideToggle("slow");
  });
   $("#side_5").click(function(){
    $("#side_sub_20").slideToggle("slow");
	$("#side_sub_21").slideToggle("slow");
  });
});
</script>
<script type="text/javascript">
	$(function(){
		$(".utcToLocal").each(function(){
			var date = $(this).html();
			var d = new Date(date);
			var n = d.toLocaleString();
			$(this).html(n);	
		});
	});
</script>
<style type="text/css"> 
#side_sub_1,#side_sub_101, #side_sub_2,#side_sub_3,#side_sub_4,#side_sub_5,#side_sub_6,side_sub_7,side_sub_8,side_sub_9,side_sub_10,side_sub_11,side_sub_12,side_sub_13,side_sub_14,side_sub_15,side_sub_16,side_sub_17,side_sub_18,side_sub_19,side_sub_20,side_sub_21,side_sub_22
{

display:none;
}
</style>
 