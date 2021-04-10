<?php echo $this->session->flashdata('response'); ?>
<div class="box" id="accordion">
	<div class="box-group">
		<div class="panel box">
			<h2 class="box-header">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_or">
			Official Receipt</a>
			</h2>
		</div>
		
		<div id="collapse_or" class="panel-collapse collapse">
			<div class="box-group">
				<?php $i = 0; ?>
				<?php foreach ($official_receipts as $key => $receipt) : ?>
				<div class="panel box">
					<div class="box-header">
						<h4 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_or_<?php echo $key; ?>">
						<?php echo $receipt->name; ?></a>
						</h4>
						<div id="collapse_or_<?php echo $key; ?>" class="panel-collapse collapse">
							<div class="box-body">
								<?php if ($receipt->rental_receipt_type == 'or') : ?>
								<div class="row">
									<div class="col-sm-12">
										<h4 class="text-center">Rental for <?php echo $receipt->month . ' ' . $receipt->year; ?></h4>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Customer Name</strong></div>
									<div class="col-sm-6"><?php echo $receipt->name; ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>TIN</strong></div>
									<div class="col-sm-6"><?php echo $receipt->tin; ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Amount</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_rental, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Total Sales (VAT Inclusive)</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_rental + (($receipt->rental_wht / 100) * $receipt->basic_rental), 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Less: VAT</strong></div>
									<div class="col-sm-6"><?php echo number_format(($receipt->rental_vat / 100) * $receipt->basic_rental, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Less: WHT</strong></div>
									<div class="col-sm-6"><?php echo number_format(($receipt->rental_wht / 100) * $receipt->basic_rental, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Total Amount Due</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_rental, 2); ?></div>
								</div>
								<?php endif; ?>
								
								<?php if ($receipt->cusa_receipt_type == 'or') : ?>
								<hr />
								
								<div class="row">
									<div class="col-sm-12">
										<h4 class="text-center">CUSA for <?php echo $receipt->month . ' ' . $receipt->year; ?></h4>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Customer Name</strong></div>
									<div class="col-sm-6"><?php echo $receipt->name; ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>TIN</strong></div>
									<div class="col-sm-6"><?php echo $receipt->tin; ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Amount</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_cusa, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Total Sales (VAT Inclusive)</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_cusa + (($receipt->cusa_wht / 100) * $receipt->basic_cusa), 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Less: VAT</strong></div>
									<div class="col-sm-6"><?php echo number_format(($receipt->cusa_vat / 100) * $receipt->basic_cusa, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Less: WHT</strong></div>
									<div class="col-sm-6"><?php echo number_format(($receipt->cusa_wht / 100) * $receipt->basic_cusa, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>Total Amount Due</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_cusa, 2); ?></div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		<div class="panel box">
			<h2 class="box-header">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_ar">
			Acknowledgement Receipt</a>
			</h2>
		</div>
		
		<div id="collapse_ar" class="panel-collapse collapse">
			<div class="box-group">
				<?php foreach ($acknowledgement_receipts as $key => $receipt) : ?>
				<div class="panel box">
					<div class="box-header">
						<h4 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse_ar_<?php echo $key; ?>">
						<?php echo $receipt->name; ?></a>
						</h4>
						<div id="collapse_ar_<?php echo $key; ?>" class="panel-collapse collapse">
							<div class="box-body">
								<!--<?php //if ($receipt->rental_receipt == 'ar') : ?>
								<div class="row">
									<div class="col-sm-6"><strong>Received from</strong></div>
									<div class="col-sm-6"><?php echo $receipt->name; ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>The sum of pesos</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_rental, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>As payment for</strong></div>
									<div class="col-sm-6">Rental for the month of <?php echo $receipt->month . ' ' . $receipt->year; ?></div>
								</div>-->
								<?php //endif; ?>
								
								<?php if ($receipt->cusa_receipt_type == 'ar') : ?>
								<div class="row">
									<div class="col-sm-6"><strong>Received from</strong></div>
									<div class="col-sm-6"><?php echo $receipt->name; ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>The sum of pesos</strong></div>
									<div class="col-sm-6"><?php echo number_format($receipt->net_cusa, 2); ?></div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-6"><strong>As payment for</strong></div>
									<div class="col-sm-6">CUSA for <?php echo $receipt->month . ' ' . $receipt->year; ?></div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		<div class="panel box">
			<h2 class="box-header">
				<a data-toggle="collapse" data-parent="#accordion" href="#water_bill">
			Water Bill</a>
			</h2>
		</div>
		
		<div id="water_bill" class="panel-collapse collapse">
			<div class="box-body">
				<?php if ( ! $tenants_with_water_bill[0]->water_reading) : ?>
				<?php echo form_open('misc/create_water_calculation'); ?>
				<div class="form-group">
					<label for="water_fee">Water Fee:</label>
					<input type="number" step="any" min="0" class="form-control" id="water_fee">
				</div>
				<div class="form-group">
					<label for="consumption">Consumption:</label>
					<input type="number" step="any" min="0" class="form-control" id="consumption">
				</div>
				<div class="form-group">
					<label for="franchise_tax">Franchise Tax:</label>
					<input type="number" step="any" min="0" class="form-control" id="franchise_tax">
				</div>
				<div class="form-group">
					<label for="pca">PCA:</label>
					<input type="number" step="any" min="0" class="form-control" id="pca">
				</div>
				<div class="form-group">
					<label for="pwa">PWA:</label>
					<input type="number" step="any" min="0" class="form-control" id="pwa">
				</div>
				<hr />
				<?php endif; ?>
				<?php if ($tenants_with_water_bill[0]->water_reading) : ?>
				<div class="form-group">
					<?php if ($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1): ?>
						<?php echo form_open('misc/delete_water_calculation'); ?>
						<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete and create new calculation</button>
					<?php endif; ?>
					<a href="<?php echo base_url() . 'misc/print_water_bill'; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print monthly water calculation</a>
					<?php if ($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1): ?>
						<?php echo form_close(); ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php
				foreach ($tenants_with_water_bill as $key => $tenant) :
					$count = count($tenants_with_water_bill) - 1;
					$before_previous_month = date('F', strtotime('-1 month', strtotime($tenant->previous_month . '-' . $tenant->previous_year)));
					$before_previous_year = date('Y', strtotime('-1 month', strtotime($tenant->previous_month . '-' . $tenant->previous_year)));
				?>
				<div class="form-group">
					<label>Date:</label>
					<p class="form-control-static"><?php echo $before_previous_month . ' ' . $before_previous_year.  ' to ' . $tenant->previous_month . ' ' . $tenant->previous_year; ?></p>
				</div>
				<div class="form-group">
					<label>Tenant:</label>
					<p class="form-control-static"><?php echo $tenant->name; ?></p>
				</div>
				<div class="form-group">
					<label>Previous reading:</label>
					<p class="form-control-static" id="previous_reading_<?php echo $key; ?>"><?php echo $tenant->previous_water_reading; ?></p>
				</div>
				<div class="form-group">
					<label>Current reading:</label>
					<?php if ( ! $tenants_with_water_bill[0]->water_reading) : ?>
					<input type="number" min="0" class="form-control current_reading" id="<?php echo $key; ?>">
					<?php else : ?>
					<p class="form-control-static"><?php echo $tenant->water_reading; ?></p>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Water consumption:</label>
					<?php if ( ! $tenants_with_water_bill[0]->water_reading) : ?>
					<p class="form-control-static" id="water_consumption_<?php echo $key; ?>"></p>
					<?php else : ?>
					<p class="form-control-static"><?php echo $tenant->difference_water_reading; ?></p>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label>Water payment:</label>
					<?php if ( ! $tenants_with_water_bill[0]->water_reading) : ?>
					<p class="form-control-static" id="water_payment_<?php echo $key; ?>"></p>
					<?php else : ?>
					<p class="form-control-static"><?php echo number_format($tenant->water_payment, 2); ?></p>
					<a href="<?php echo base_url() . 'misc/print_water_bill_soa/' . $tenant->tenant_id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print statement of account</a>
					<?php endif; ?>
				</div>
				<input type="hidden" name="<?php echo $key; ?>[id]" id="<?php echo $key; ?>[id]" value="<?php echo $tenant->id; ?>">
				<input type="hidden" name="<?php echo $key; ?>[water_reading]" id="<?php echo $key; ?>[water_reading]">
				<input type="hidden" name="<?php echo $key; ?>[difference_water_reading]" id="<?php echo $key; ?>[difference_water_reading]">
				<input type="hidden" name="<?php echo $key; ?>[water_payment]" id="<?php echo $key; ?>[water_payment]">
				<?php echo ($key != $count) ? "<hr />" : ''; ?>
				<?php endforeach; ?>
				<?php if ( ! $tenants_with_water_bill[0]->water_reading) : ?>
				<input type="hidden" id="no_of_tenants_with_water_bill" value="<?php echo count($tenants_with_water_bill);?>">
				<?php if ($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1): ?>
				<button type="submit" class="btn btn-default">Submit</button>
				<?php endif; ?>
				<?php echo form_close(); ?>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="panel box">
			<h2 class="box-header">
				<a data-toggle="collapse" data-parent="#accordion" href="#monthly_report">
			Monthly Rental Report</a>
			</h2>
		</div>
		
		<div id="monthly_report" class="panel-collapse collapse">
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
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th colspan="2" class="text-center"><?php echo strtoupper($tenant->name); ?></th>
								</tr>
							</thead>
							
							<tbody>
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
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td>TOTAL BASIC RENT: <strong><?php echo number_format($total_basic_rent, 2); ?></strong></td>
								<td>TOTAL BASIC CUSA: <strong><?php echo number_format($total_basic_cusa, 2); ?></strong></td>
								<td>GRAND TOTAL: <strong><?php echo number_format($grand_total, 2); ?></strong></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-xs-12">
					<a href="<?php echo base_url() . 'misc/print_monthly_rental_report'; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print monthly rental report</a>
				</div>
			</div>
		</div>
		
		<div class="panel box">
			<h2 class="box-header">
				<a data-toggle="collapse" data-parent="#accordion" href="#expenses">
			Expenses</a>
			</h2>
		</div>
		
		<div id="expenses" class="panel-collapse collapse">
			<div class="box-body">
				<?php echo form_open(); ?>
				<div class="form-group">
					<label for="amount">Amount:</label>
					<input type="number" class="form-control" id="expenses_amount" name="expenses_amount">
				</div>
				<button type="submit" id="generate_expenses" class="btn btn-default">Generate Expenses</button>
				<?php echo form_close(); ?>
				
				<div class="col-xs-12" id='expenses_table'>
			</div>
		</div>
	</div>
</div>