$(document).ready(function() {
	$('#rent_start').datepicker({
	   autoclose: true,
	   format: 'yyyy-mm-dd'
    });
	
	for (i=0; i<5; i++) {
		console.log(i);
	}
	
	$('#rent_start').datepicker().on('changeDate', function (e) {
		var duration = parseInt($('#duration').val());
		var rent_start = $(this).val();
		var d = new Date(rent_start);
		var year = d.getFullYear();
		var month = d.getMonth();
		var day = d.getDate();
		var c = new Date(year + duration, month, day - 1)
		var date = new Date(c);
		var rent_end = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 ))
							.toISOString()
							.split("T")[0];
							
		$('#display_rent_end').val(rent_end);
		$('#rent_end').val(rent_end);
		
		// if (duration > 1) {
			// var i;
			// var escalation_year = duration;
			// $('#escalation').attr('disabled', false);
			// $('#escalation_start_year').attr('disabled', false);
			// $('#escalation_start_year').children('option:not(:first)').remove();
			// for (i = 1; i <= duration; i++) {
				// escalation_year  = (escalation_year - (duration - (i - 1)))+2;
				// $("#escalation_start_year").append('<option value="option6">' + escalation_year + '</option>');
				// escalation_year = duration;
			// }
		// }
		// $('.escalation').remove();	
		// var i;
		// var display_escalation = '';
		// var escalation_year = duration;
		
		// for (i = 1; i <= duration; i++) {
			// escalation_year  = (escalation_year - (duration - (i - 1)))+1;
			// display_escalation += "<div class='escalation form-group'>"
			// + "<label for='primary_name'>Escalation on year " + escalation_year + " (%):</label>"
			// + "<input type='text' class='form-control' id='escalation1' name='escalation[]'>"
			// + "</div>";
			// escalation_year = duration;
		// }
		
		// $('#rent_end_div').after(display_escalation);
	});
			  
	$('#duration').on('keyup', function() {
		var rent_start = $('#rent_start').val();
		
		if (rent_start != null && rent_start != '') {
			var duration = parseInt($(this).val());
			var d = new Date(rent_start);
			var year = d.getFullYear();
			var month = d.getMonth();
			var day = d.getDate();
			var c = new Date(year + duration, month, day - 1)
			var date = new Date(c);
			var rent_end = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 ))
								.toISOString()
								.split("T")[0];
								
			$('#display_rent_end').val(rent_end);
			$('#rent_end').val(rent_end);
			
			// $('.escalation').remove();
			// var i;
			// var display_escalation = '';
			// var escalation_year = duration;
			
			// for (i = 1; i <= duration; i++) {
				// escalation_year  = (escalation_year - (duration - (i - 1)))+1;
				// display_escalation += "<div class='escalation form-group'>"
				// + "<label for='primary_name'>Escalation on year " + escalation_year + " (%):</label>"
				// + "<input type='text' class='form-control' id='escalation1' name='escalation[]'>"
				// + "</div>";
				// escalation_year = duration;
			// }
			
			// $('#rent_end_div').after(display_escalation);
		}
	});
	
	$('#basic_rental').on('keyup', function() {
		$('#display_net_rental').text(function() {
			var net_rental = ((parseFloat($('#basic_rental').val()) + parseFloat($('#basic_rental').val() * $('#rental_vat').val() / 100)) - parseFloat($('#basic_rental').val() * $('#rental_wht').val() / 100)).toFixed(2);
			$('#net_rental').val(net_rental);
			return net_rental;
		});
	});
	
	$('#rental_vat').on('keyup', function() {
		$('#display_net_rental').text(function() {
			var net_rental = ((parseFloat($('#basic_rental').val()) + parseFloat($('#basic_rental').val() * $('#rental_vat').val() / 100)) - parseFloat($('#basic_rental').val() * $('#rental_wht').val() / 100)).toFixed(2);
			$('#net_rental').val(net_rental);
			return net_rental;
		});
	});
	
	$('#rental_wht').on('keyup', function() {
		$('#display_net_rental').text(function() {
			var net_rental = ((parseFloat($('#basic_rental').val()) + parseFloat($('#basic_rental').val() * $('#rental_vat').val() / 100)) - parseFloat($('#basic_rental').val() * $('#rental_wht').val() / 100)).toFixed(2);
			$('#net_rental').val(net_rental);
			return net_rental;
		});
	});
	
	$('#basic_cusa').on('keyup', function() {
		$('#display_net_cusa').text(function() {
			var net_cusa = ((parseFloat($('#basic_cusa').val()) + parseFloat($('#basic_cusa').val() * $('#cusa_vat').val() / 100)) - parseFloat($('#basic_cusa').val() * $('#cusa_wht').val() / 100)).toFixed(2);
			$('#net_cusa').val(net_cusa);
			return net_cusa;
		});
	});
	
	$('#cusa_vat').on('keyup', function() {
		$('#display_net_cusa').text(function() {
			var net_cusa = ((parseFloat($('#basic_cusa').val()) + parseFloat($('#basic_cusa').val() * $('#cusa_vat').val() / 100)) - parseFloat($('#basic_cusa').val() * $('#cusa_wht').val() / 100)).toFixed(2);
			$('#net_cusa').val(net_cusa);
			return net_cusa;
		});
	});
	
	$('#cusa_wht').on('keyup', function() {
		$('#display_net_cusa').text(function() {
			var net_cusa = ((parseFloat($('#basic_cusa').val()) + parseFloat($('#basic_cusa').val() * $('#cusa_vat').val() / 100)) - parseFloat($('#basic_cusa').val() * $('#cusa_wht').val() / 100)).toFixed(2);
			$('#net_cusa').val(net_cusa);
			return net_cusa;
		});
	});
});