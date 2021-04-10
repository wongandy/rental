<div class="box box-solid">
	<div class="box-body">
		<div class="col-xs-12 text-center"><?php echo $tenants[0]->month . ' ' . $tenants[0]->year; ?></div>
		<?php 
		$total_basic_rent = 0;
		$total_basic_cusa = 0;
		$grand_total = 0;
		
		foreach ($tenants as $tenant) : 
			$total_basic_rent += $tenant->basic_rental;
			
			if ($tenant->cusa_receipt_type == 'or') {
				$total_basic_cusa += $tenant->basic_cusa;
			}
		?>
		<div class="col-xs-6">
			<div class="table-responsive small">
				<table class="table table-bordered small">
					<thead class="small">
						<tr>
							<th colspan="2" class="text-center"><?php echo strtoupper($tenant->name); ?></th>
						</tr>
					</thead>
					
					<tbody class="small">
						<tr>
							<td class="col-xs-3">
								<div>DATE:</div>
								<div>OR NO:</div>
								<div>BASIC RENT: <?php echo number_format($tenant->basic_rental, 2); ?></div>
								<div><?php echo $tenant->rental_vat; ?>% VAT: <?php echo number_format(($tenant->rental_vat / 100) * $tenant->basic_rental, 2); ?></div>
								<div><?php echo $tenant->rental_wht; ?>% WHT: <?php echo number_format(($tenant->rental_wht / 100) * $tenant->basic_rental, 2); ?></div>
								<div>TOTAL: <?php echo number_format($tenant->net_rental, 2); ?></div>
							</td>
							<?php if ($tenant->cusa_receipt_type == 'or') : ?>
							<td class="col-xs-3">
								<div>DATE:</div>
								<div>OR NO:</div>
								<div>BASIC CUSA: <?php echo number_format($tenant->basic_cusa, 2); ?></div>
								<div><?php echo $tenant->cusa_vat; ?>% VAT: <?php echo number_format(($tenant->cusa_vat / 100) * $tenant->basic_cusa, 2); ?></div>
								<div><?php echo $tenant->cusa_wht; ?>% WHT: <?php echo number_format(($tenant->cusa_wht / 100) * $tenant->basic_cusa, 2); ?></div>
								<div>TOTAL: <?php echo number_format($tenant->net_cusa, 2); ?></div>
							</td>
							<?php endif; ?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php endforeach; ?>

		<?php $grand_total += ($total_basic_rent + $total_basic_cusa); ?>
		<div class="col-xs-12">
			<div class="table-responsive small">
				<table class="table table-bordered small">
					<tr>
						<td>TOTAL BASIC RENT: <strong><?php echo number_format($total_basic_rent, 2); ?></strong></td>
						<td>TOTAL BASIC CUSA: <strong><?php echo number_format($total_basic_cusa, 2); ?></strong></td>
						<td>GRAND TOTAL: <strong><?php echo number_format($grand_total, 2); ?></strong></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>