<div class="box box-solid">
	<h1 class="box-header">Tenants 
		<?php if ($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1) : ?>
		<a href="<?php echo base_url(); ?>tenant/create" class="btn btn-primary" role="button" aria-pressed="true">Add New Tenant</a>
		<?php endif; ?>
	</h1>
	<?php echo $this->session->flashdata('response'); ?>
	<div class="box-body">
		<?php foreach ($tenants as $tenant) : ?>
		<h4><?php echo $tenant->name; ?>
			<?php if ($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1) : ?>
			<a href="<?php echo base_url(); ?>tenant/create/<?php echo $tenant->id; ?>" class="btn btn-primary" role="button" aria-pressed="true">Make New Contract</a>
			<?php endif; ?>
		</h4>
		<?php if ($tenant->tin) : ?>
		<h5>TIN # <?php echo $tenant->tin; ?></h5>
		<?php endif; ?>
		<div class="table-responsive"> 
		  <table class="table table-bordered">
			<thead>
			  <tr>
				<th>BASIC RENTAL</th>
				<th>RENT PERIOD</th>
				<th>ESCALATION</th>
				<th>VAT <?php echo $tenant->contract_details[0]->rental_vat; ?>%</th>
				<th>WHT <?php echo $tenant->contract_details[0]->rental_wht; ?>%</th>
				<th>NET RENTAL</th>
				<?php if ($tenant->contract_details[0]->hide_rental) : ?>
				<th>HIDDEN AMOUNT</th>
				<th>NET RENTAL + HIDDEN AMOUNT</th>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->basic_cusa) : ?>
				<th>BASIC CUSA</th>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->cusa_vat) : ?>
				<th>VAT <?php echo $tenant->contract_details[0]->cusa_vat; ?>%</th>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->cusa_wht) : ?>
				<th>WHT <?php echo $tenant->contract_details[0]->cusa_wht; ?>%</th>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->net_cusa) : ?>
				<th>NET CUSA</th>
				<?php endif; ?>
				<th>GRAND TOTAL</th>
			  </tr>
			</thead>
			<tbody>
				<?php foreach ($tenant->contract_details as $contract) : ?>
				<?php
					$rent_start = strtotime(date('Y-m-d', strtotime(date($contract->rent_start))));
					$rent_end = strtotime(date('Y-m-d', strtotime(date($contract->rent_end))));
				?>
			  <tr <?php echo ($date_today >= $rent_start && $date_today <= $rent_end) ? 'class = "success"' : ''; ?>>
				<td><?php echo number_format($contract->basic_rental, 2); ?></td>
				<td><?php echo $contract->rent_start ;?> to <?php echo $contract->rent_end; ?></td>
				<td><?php echo ($contract->escalation == 0) ? '' : $contract->escalation . '%'; ?></td>
				<td><?php echo number_format(($contract->rental_vat / 100) * $contract->basic_rental, 2); ?></td>
				<td><?php echo number_format(($contract->rental_wht / 100) * $contract->basic_rental, 2); ?></td>
				<td><?php echo number_format($contract->net_rental, 2); ?></td>
				<?php if ($tenant->contract_details[0]->hide_rental) : ?>
				<td><?php echo number_format($contract->hide_rental, 2); ?></td>
				<td><?php echo number_format(($contract->net_rental + $contract->hide_rental), 2); ?></td>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->basic_cusa) : ?>
				<td><?php echo number_format($contract->basic_cusa, 2); ?></td>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->cusa_vat) : ?>
				<td><?php echo number_format(($contract->cusa_vat / 100) * $contract->basic_cusa, 2); ?></td>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->cusa_wht) : ?>
				<td><?php echo number_format(($contract->cusa_wht / 100) * $contract->basic_cusa, 2); ?></td>
				<?php endif; ?>
				<?php if ($tenant->contract_details[0]->net_cusa) : ?>
				<td><?php echo number_format($contract->net_cusa, 2); ?></td>
				<?php endif; ?>
				<td><?php echo number_format($contract->net_rental + $contract->net_cusa, 2); ?></td>
			  </tr>
				<?php endforeach; ?>
			</tbody>
		  </table>
		</div>
		<?php endforeach; ?>
	</div>
</div>