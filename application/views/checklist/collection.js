$(document).ready(function() {
	$('.check_all').on('click', function() {
		var form = $(this.form);
		var checkBoxes = $('input[type="checkbox"]', form);
		checkBoxes.prop("checked", !checkBoxes.prop("checked"));
		
		$(this).text(function(i, text){
          return (text === "Check All") ? "Uncheck All" : "Check All";
		});
	});
	
	/*
	$('.collection_submit').on('submit', function(e) {
		e.preventDefault();
		// alert($(this).serialize());
		$.ajax({
			type: 'POST',
			url: "test2",
			data: $(this).serialize(),
			success: function(result) {
				alert(result);
			},
			error: function(result) {
				console.log('no');
			}
		});
	});
	*/
	$('.test_form').on('submit', function(e) {
		var data = $(this).serialize();
		console.log(data);
		e.preventDefault();
		
		$.ajax({
			type: 'POST',
			url: "tester2",
			success: function(result) {
				alert(result);
			},
			error: function() {
				alert('no');
			}
		}); 
	});
});