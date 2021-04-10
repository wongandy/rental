<!-- Main row -->
      <div class="box box-solid">
		<h1 class="box-header"><?php echo (isset($tenant_id) && $tenant_id != '') ? 'Make New Contract' : 'Add Tenant'; ?></h1>
		<?php echo $this->session->flashdata('response'); ?>
		<div class="box-body">
			<?php echo form_open(); ?>
			
			  <div class="form-group">
				<label for="name">Business name:</label>
				<?php if (isset($tenant_id) && $tenant_id != '') : ?>
				<p><?php echo $tenant_name; ?></p>
				<?php else : ?>
				<?php echo form_error('name'); ?>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
				<?php endif; ?>
			  </div>
			  <div class="form-group">
				<label for="unit">Select unit:</label>
				<?php echo form_error('unit[]'); ?>
				<?php foreach ($units as $unit) : ?>
					<div class="checkbox">
					  <label><input type="checkbox" name="unit[]" value="<?php echo $unit->id; ?>" <?php echo set_checkbox('unit[]', $unit->id); ?>><?php echo $unit->name; ?></label>
					</div>
				<?php endforeach; ?>
				</div>
			<?php if (isset($tenant_id) && $tenant_id != '') : ?>
			<?php else: ?>
			  <div class="form-group">
				<label for="tin">TIN:</label>
				<input type="text" class="form-control" id="tin" name="tin" value="<?php echo set_value('tin'); ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_name">Primary contact name:</label>
				<?php echo form_error('primary_name'); ?>
				<input type="text" class="form-control" id="primary_name" name="primary_name" value="<?php echo set_value('primary_name'); ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_number">Primary contact number:</label>
				<?php echo form_error('primary_number'); ?>
				<input type="text" class="form-control" id="primary_number" name="primary_number" value="<?php echo set_value('primary_number'); ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_number">Primary contact email:</label>
				<input type="text" class="form-control" id="primary_number" name="primary_email" value="<?php echo set_value('primary_email'); ?>">
			  </div>
			  <div class="form-group">
				<label for="secondary_name">Secondary contact name:</label>
				<input type="text" class="form-control" id="secondary_name" name="secondary_name" value="<?php echo set_value('secondary_name'); ?>">
			  </div>
			  <div class="form-group">
				<label for="secondary_number">Secondary contact number:</label>
				<input type="text" class="form-control" id="secondary_number" name="secondary_number" value="<?php echo set_value('secondary_number'); ?>">
			  </div>
			  <div class="form-group">
				<label for="secondary_number">Secondary contact email:</label>
				<input type="text" class="form-control" id="secondary_number" name="secondary_email" value="<?php echo set_value('secondary_email'); ?>">
			  </div>
			  <div class="form-group">
				<label for="tertiary_name">Tertiary contact name:</label>
				<input type="text" class="form-control" id="tertiary_name" name="tertiary_name" value="<?php echo set_value('tertiary_name'); ?>">
			  </div>
			  <div class="form-group">
				<label for="tertiary_number">Tertiary contact number:</label>
				<input type="text" class="form-control" id="tertiary_number" name="tertiary_number" value="<?php echo set_value('tertiary_number'); ?>">
			  </div>
			  <div class="form-group">
				<label for="tertiary_number">Tertiary contact email:</label>
				<input type="text" class="form-control" id="tertiary_number" name="tertiary_email" value="<?php echo set_value('tertiary_email'); ?>">
			  </div>
			  <div class="form-group">
				<label for="notes">Notes about tenant:</label>
				<textarea class="form-control" rows="5" id="tenant_notes" name="tenant_notes"><?php echo set_value('tenant_notes'); ?></textarea>
				</div>
				<?php endif; ?>
				<div class="form-group">
				<label for="primary_name">Basic rental:</label>
				<?php echo form_error('basic_rental'); ?>
				<input type="number" step="any" min="0" class="form-control" id="basic_rental" name="basic_rental" value="<?php echo set_value('basic_rental'); ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_name">Hide rental amount:</label>
				<input type="number" step="any" min="0" class="form-control" id="hide_rental" name="hide_rental" value="<?php echo set_value('hide_rental'); ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_number">Rental VAT (%):</label>
				<input type="number" step="any" min="0" class="form-control" id="rental_vat" name="rental_vat" value="<?php echo (set_value('rental_vat')) ? set_value('rental_vat') : $bir->rental_vat; ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_name">Rental WHT (%):</label>
				<input type="number" step="any" min="0" class="form-control" id="rental_wht" name="rental_wht" value="<?php echo (set_value('rental_wht')) ? set_value('rental_wht') : $bir->rental_wht; ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_name">Net rental:</label>
				<p class="form-control-static" id="display_net_rental"><?php echo (set_value('net_rental')) ? set_value('net_rental') : 0;?></p>
			  </div>
			  <div class="form-group">
				<label for="primary_name">Basic CUSA:</label>
				<input type="number" step="any" min="0" class="form-control" id="basic_cusa" name="basic_cusa" value="<?php echo set_value('basic_cusa'); ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_number">CUSA VAT (%):</label>
				<input type="number" step="any" min="0" class="form-control" id="cusa_vat" name="cusa_vat" value="<?php echo (set_value('cusa_vat')) ? set_value('cusa_vat') : $bir->cusa_vat; ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_name">CUSA WHT (%):</label>
				<input type="number" step="any" min="0" class="form-control" id="cusa_wht" name="cusa_wht" value="<?php echo (set_value('cusa_wht')) ? set_value('cusa_wht') : $bir->cusa_wht; ?>">
			  </div>
			  <div class="form-group">
				<label for="primary_name">Net CUSA:</label>
				<p class="form-control-static" id="display_net_cusa"><?php echo (set_value('net_cusa')) ? set_value('net_cusa') : 0;?></p>
			  </div>
			  
			  <div class="form-group">
                <label>Rent period start:</label>
				<?php echo form_error('rent_start'); ?>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="rent_start" name="rent_start" value="<?php echo set_value('rent_start'); ?>">
                </div>
                <!-- /.input group -->
              </div>
			  
			  <div class="form-group">
				<label for="primary_name">Duration: (years)</label>
				<?php echo form_error('duration'); ?>
				<input type="number" class="form-control" id="duration" name="duration" value="<?php echo (set_value('duration')) ? set_value('duration') : 1; ?>">
			  </div>
			  
			  <div class="form-group">
                <label>Rent period end:</label>
			   <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="display_rent_end" name="rent_end" <?php echo (set_value('rent_end')) ? "value='" . set_value('rent_end') . "' disabled" : 'disabled'; ?>>
                </div>
				</div>
				
				<div class="form-group">
					<label for="primary_name">Escalation (%):</label>
					<input type="number" class="form-control" id="escalation" name="escalation" value="<?php echo set_value('escalation'); ?>">
				</div>
				
				<div class="form-group">
					<label for="primary_number">Escalation start on year:</label>
					<input type="number" class="form-control" id="escalation" name="escalation_start_year" value="<?php echo set_value('escalation_start_year'); ?>">
				</div>
				
				<div class="form-group">
					<label for="rental_receipt_type">Create receipt for rental as:</p>
					 <div class="radio">
					  <label><input type="radio" name="rental_receipt_type" id="rental_receipt_type" value="or" checked>Official Receipt</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="rental_receipt_type" id="rental_receipt_type" value="ar">Acknowledgement Receipt</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="rental_receipt_type" id="rental_receipt_type" value="">None</label>
					</div>
				</div>
				
				<div class="form-group">
					<label for="cusa_receipt_type">Create receipt for CUSA as:</p>
					 <div class="radio">
					  <label><input type="radio" name="cusa_receipt_type" id="cusa_receipt_type" value="or" checked>Official Receipt</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="cusa_receipt_type" id="cusa_receipt_type" value="ar">Acknowledgement Receipt</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="cusa_receipt_type" id="cusa_receipt_type" value="">None</label>
					</div>
				</div>
				
				<div class="form-group">
					<label for="monthly_report">Included in monthly report:</p>
					 <div class="radio">
					  <label><input type="radio" name="monthly_report" id="monthly_report" value="1" checked>Yes</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="monthly_report" id="monthly_report" value="0">No</label>
					</div>
				</div>
				
				<div class="form-group">
					<label for="water_bill">Included in water bill:</p>
					 <div class="radio">
					  <label><input type="radio" name="water_bill" id="water_bill" value="1" checked>Yes</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="water_bill" id="water_bill" value="0">No</label>
					</div>
				</div>
				
				<div class="form-group">
					<label for="water_bill">Include form 2307 for rental:</p>
					 <div class="radio">
					  <label><input type="radio" name="rental_form_2307" id="rental_form_2307" value="1" checked>Yes</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="rental_form_2307" id="rental_form_2307" value="0">No</label>
					</div>
				</div>
				
				<div class="form-group">
					<label for="water_bill">Include form 2307 for CUSA:</p>
					 <div class="radio">
					  <label><input type="radio" name="cusa_form_2307" id="cusa_form_2307" value="1" checked>Yes</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="cusa_form_2307" id="cusa_form_2307" value="0">No</label>
					</div>
				</div>
				
			   <div class="form-group">
				<label for="notes">Notes about contract:</label>
				<textarea class="form-control" rows="5" id="notes" name="contract_notes"><?php echo set_value('contract_notes'); ?></textarea>
				</div>
				<input type="hidden" name="net_rental" id="net_rental" value="<?php echo set_value('net_rental'); ?>">
				<input type="hidden" name="net_cusa" id="net_cusa" value="<?php echo set_value('net_cusa'); ?>">
				<input type="hidden" name="rent_end" id="rent_end" value="<?php echo set_value('rent_end'); ?>">
				<input type="hidden" name="location_id" id="location_id" value="<?php echo $location_id; ?>">
			  <button type="submit" class="btn btn-default">Submit</button>
			<?php echo form_close(); ?>
		</div>
      </div>
      <!-- /.row (main row) -->