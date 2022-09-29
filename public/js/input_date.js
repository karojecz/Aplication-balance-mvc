  $( function() {
    $( ".inp_date" ).datepicker({
		
		dateFormat: "yy-mm-dd",
		 minDate : "2020-01-01",
		
	});
  } );
  
    $( function() {
    $( "#date" ).datepicker({
	
	dateFormat: "yy-mm-dd",
	 minDate : "2020-01-01",
	});
  } );
  

  


 function date_validation(){
	
	
			
			var first_date=document.getElementById('start_date').value;
			var end_date=document.getElementById('end_date').value;
			
			var date_regex=/^(20[1-2][1-9])-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[0-1])$/;
			
			
			if (!date_regex.test(first_date) || !date_regex.test(end_date))
			{
				$('#date_alert_format').show('fade');
				setTimeout(function () {
				$('#date_alert_format').hide('fade');
				}, 2000);
				
			}
			else if(first_date==false || end_date==false)
			{
				$('#date_alert_empty').show('fade');
				
				setTimeout(function () {
				$('#date_alert_empty').hide('fade');
				}, 2000);
					
			}
			else if(first_date>end_date)
			{
				$('#date_alert').show('fade');
				
				setTimeout(function () {
				$('#date_alert').hide('fade');
				}, 2000);

				
			}
			
			else{
				
				document.getElementById("date_form").submit();
			}
			
			
		}
function ExpenseAndIcomeDatreValidation()
{
				var date=document.getElementById('item_date').value;
			
			
			var date_regex=/^(20[1-2][1-9])-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[0-1])$/;
			
			
			if (!date_regex.test(item_date) )
			{
				$('#date_alert_format').show('fade');
				setTimeout(function () {
				$('#date_alert_format').hide('fade');
				}, 2000);
				
			}
			else if(item_date==false )
			{
				$('#date_alert_empty').show('fade');
				
				setTimeout(function () {
				$('#date_alert_empty').hide('fade');
				}, 2000);
					
			}

			
			else{
				
				document.getElementById("form_item").submit();
			}
}
