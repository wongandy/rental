<div class="box" id="accordion">
	<?php echo $this->session->flashdata('response'); ?>
	<div class="box-group">
		<?php foreach ($collection as $key => $val) : ?>
			<?php foreach ($val as $tenant => $val) : ?>
				<div class="panel box">
					<h2 class="box-header">
						<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $key; ?>">
					<?php echo $tenant; ?></a>
					</h2>
				</div>
				
				<div id="<?php echo $key; ?>" class="panel-collapse collapse">
					<div class="box-body">
						<!--<form type="POST" name="<?php echo $key; ?>" id="<?php echo $key; ?>">-->
						<?php echo form_open('checklist/submit', array('class' => 'collection_submit')); ?>
							<?php foreach ($val as $type => $val) :?>
								<?php
								$header = '';
								
								if ($type == 'rental_receipt') {
									$header = 'Rental receipt';
								}
								else if ($type == 'cusa_receipt') {
									$header = 'CUSA receipt';
								}
								else if ($type == 'water_payment' && count($val)) {
									$header = 'Water payment';
								}
								else if ($type == 'rental_form_2307') {
									$header = 'Rental form 2307';
								}
								else if ($type == 'cusa_form_2307') {
									$header = 'CUSA form 2307';
								}
								?>
								
								<?php if (count($val)) : ?>
								<h4><?php echo $header; ?></h4>
								<?php endif; ?>
								
								<?php foreach ($val as $description) :?>
									<?php
									$text = '';
									
									if ($type == 'rental_receipt') {
										if ($description['rental_receipt_type'] == 'or') {
											$text = 'Give rental official receipt (&#8369;' . number_format($description['net_rental'], 2) . ') for ' . $description['month'] . ' ' . $description['year'];
										}
										else if ($description['rental_receipt_type'] == 'ar') {
											$text = 'Give rental acknowledgement receipt (&#8369;' . number_format($description['net_rental'], 2) . ') for ' . $description['month'] . ' ' . $description['year'];
										}
										
										$name = 'rental_receipt_given';
									}
									else if ($type == 'cusa_receipt') {
										if ($description['cusa_receipt_type'] == 'or') {
											$text = 'Give CUSA official receipt (&#8369;' . number_format($description['net_cusa'], 2) . ') for ' . $description['month'] . ' ' . $description['year'];
										}
										else if ($description['cusa_receipt_type'] == 'ar') {
											$text = 'Give CUSA acknowledgement receipt (&#8369;' . number_format($description['net_cusa'], 2) . ') for ' . $description['month'] . ' ' . $description['year'];
										}
										
										$name = 'cusa_receipt_given';
									}
									else if ($type == 'water_payment' && count($val)) {
										$text = 'Collect water payment (&#8369;' . number_format($description['water_payment'], 2) . ') for ' . $description['month'] . ' ' . $description['year'];
										$name = 'water_payment_received';
									}
									else if ($type == 'rental_form_2307') {
										$text = 'Collect rental form 2307 (&#8369;' . number_format(($description['rental_wht'] / 100) * $description['basic_rental'], 2) . ') for ' . $description['month'] . ' ' . $description['year'];
										$name = 'rental_form_2307_received';
									}
									else if ($type == 'cusa_form_2307') {
										$text = 'Collect CUSA form 2307 (&#8369;' . number_format(($description['cusa_wht'] / 100) * $description['basic_cusa'], 2) . ') for ' . $description['month'] . ' ' . $description['year'];
										$name = 'cusa_form_2307_received';
									}
									?>
									<div class="checkbox">
										<label><input type="checkbox" name="<?php echo $name; ?>[]" value="<?php echo $description['id']; ?>"><?php echo $text; ?></label>
									</div>
									
								<?php endforeach; ?>
								
								<?php if (count($val)) : ?>
								<br>
								<?php endif; ?>
								
							<?php endforeach; ?>
							
							<?php if (!empty($collection[$key][$tenant]['rental_receipt']) || !empty($collection[$key][$tenant]['cusa_receipt']) || !empty($collection[$key][$tenant]['water_payment']) || !empty($collection[$key][$tenant]['rental_form_2307']) || !empty($collection[$key][$tenant]['cusa_form_2307']) ) : ?>
							<button type="submit" class="btn btn-default">Submit</button>
							<button type="button" class="btn btn-default check_all">Check All</button>
							<?php endif; ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
</div>