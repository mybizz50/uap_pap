<?php echo $header; ?>
<?php echo $nav_logged; ?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3">


			<?php echo $sidebar; ?>
		</div>
		<!--/span-->
		<div class="span9">
			<div class="row-fluid">
				<?php echo $message_list
				?>
				<?php echo $current_process_list
				?>
				<?php echo $old_process_list
				?>
			</div>
		</div>
		<!--/row-->
	</div>
	<!--/row-->
</div>
<?php echo $footer; ?>