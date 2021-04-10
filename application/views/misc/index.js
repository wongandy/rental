$(document).ready(function() {
	var ftx_pwa_pca_total = 0;
	var formula_a = 0;
	var formula_b = 0;
	var number_of_water_bill_tenants = parseInt($('#no_of_tenants_with_water_bill').val())+1;
	var additional_percentage = 1.20;
	
	$('#water_fee, #consumption').on('input', function() {
		var water_fee = parseFloat($('#water_fee').val());
		var consumption = parseFloat($('#consumption').val());
		formula_a = Math.round(water_fee / consumption);
	});
	
	$('#franchise_tax, #pwa, #pca').on('input', function() {
		var franchise_tax = parseFloat($('#franchise_tax').val());
		var pca = parseFloat($('#pca').val());
		var pwa = parseFloat($('#pwa').val());
		ftx_pwa_pca_total = parseFloat((franchise_tax + pca + pwa).toFixed(2));
		formula_b = Math.round(ftx_pwa_pca_total / number_of_water_bill_tenants);
	});
	
	$('.current_reading').on('input', function() {
		var id = $(this).attr('id');
		var current_reading = $(this).val();
		var previous_reading = $('#previous_reading_' + id).text();
		var water_consumption = current_reading - previous_reading;
		var water_payment = 0;
		$('#water_consumption_' + id).text(water_consumption);
		
		// if current water consumption is not the same as previous consumption
		if (water_consumption != 0) {
			water_payment = Math.round(parseFloat(((water_consumption * formula_a) + formula_b) * additional_percentage).toFixed(2));
		}
		else {
			water_payment = 0;
		}
		
		$('#water_payment_' + id).text(water_payment);
		$('input[id="' + id + '[water_reading]"]').val(current_reading);
		$('input[id="' + id + '[difference_water_reading]"]').val(water_consumption);
		$('input[id="' + id + '[water_payment]"]').val(water_payment);
	});
	
	$('#generate_expenses').on('click', function(e) {
		e.preventDefault();
		var expenses_amount = $('#expenses_amount').val();
		
		$.ajax({
			url: "<?php echo base_url(); ?>misc/calculate_expenses_amount/" + expenses_amount,
			type: "GET",
			dataType: 'html',
			success: function(response) {
				$('#expenses_table').html(response);
			}
		});
	});
	
	$('#generate_expenses').prop('disabled', true);
	
	$('#expenses_amount').on('keyup', function() {
		$('#generate_expenses').prop('disabled', $(this).val() == '' ? true : false);
	});
});