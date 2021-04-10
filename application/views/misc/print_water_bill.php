<div class="box box-solid">
	<div class="box-body">
		<?php
		foreach ($tenants_with_water_bill as $tenant) :
		$before_previous_month = date('F', strtotime('-1 month', strtotime($tenant->previous_month . '-' . $tenant->previous_year)));
		$before_previous_year = date('Y', strtotime('-1 month', strtotime($tenant->previous_month . '-' . $tenant->previous_year)));
		?>
		<div class="col-xs-6">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td class="col-xs-6">
								<div><h4><?php echo $tenant->name;?></h4></div><br><br>
								<div class="pull-left">DATE: </div><div class="pull-right"><?php echo strtoupper(date('M', strtotime($before_previous_month))) . ' 1, ' . $before_previous_year . ' - ' . strtoupper(date('M', strtotime($tenant->previous_month))) . ' 1, ' . $tenant->previous_year; ?></div><br>
								<div class="pull-left">WATER CONSUMPTION: </div><div class="pull-right"><?php echo $tenant->difference_water_reading; ?></div><br>
								<div class="pull-left">TOTAL: </div><div class="pull-right"><strong><?php echo number_format($tenant->water_payment, 2); ?></strong></div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>