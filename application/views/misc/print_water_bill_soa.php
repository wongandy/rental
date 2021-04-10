<?php
$before_previous_month = date('F', strtotime('-1 month', strtotime($tenant->previous_month . '-' . $tenant->previous_year)));
$before_previous_year = date('Y', strtotime('-1 month', strtotime($tenant->previous_month . '-' . $tenant->previous_year)));
?>
<div class="box box-solid">
	<div class="box-body">
		<div class="row">
			<div class="col-xs-12">
				<div>
					<?php echo strtoupper($tenant->owner_name); ?><br>
					<?php echo $tenant->address; ?><br>
					<?php echo $tenant->location; ?>
				</div>
				<br>
				<br>
				<br>
				<h4 class="text-center">STATEMENT OF ACCOUNT</h4>
				<hr>
				<div>
					<p>Tenant: <?php echo strtoupper($tenant->name); ?></p>
					<p>Billing Date: <?php echo $tenant->month . ' 1-' . date('t', strtotime($tenant->month . ' ' . $tenant->year)) . ', ' . $tenant->year; ?></p>
					<p>Due Date: <?php echo $tenant->month . ' 15, ' . $tenant->year; ?></p>
				</div>
				<br>
				<br>
				<br>
			</div>
			<div>
				<div class="col-xs-6 text-left">
					<p><u>PARTICULARS</u></p>
					<p>WATER CONSUMPTION = <?php echo $tenant->difference_water_reading; ?></p>
					<p><?php echo $before_previous_month . ' 1, ' . $before_previous_year . ' to ' . $tenant->previous_month . ' 1, ' . $tenant->previous_year; ?></p>
					<p>TOTAL CURRENT CHARGES</p>
				</div>
				<div class="col-xs-6 text-right">
					<p><u>AMOUNT</u></p>
					<p><?php echo number_format($tenant->water_payment, 2); ?></p>
					<p>&nbsp;</p>
					<p><?php echo number_format($tenant->water_payment, 2); ?></p>
				</div>
			</div>
			<div class="clearfix"></div>
			<br>
			<br>
			<br>
			<div class="col-xs-12">
				PREPARED BY
				<br>
				<br>
				<br>
				ANDY WONG<br>
				CHAIRMAN
			</div>
		</div>
	</div>
</div>