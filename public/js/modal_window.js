
document.getElementById('myBtn').onclick = function() {
    var radios = document.getElementsByName('old_category');
	const lastItem = radios[radios.length - 1]
    for (var radio of radios)
    {
		
        if (radio.checked) {
            //alert(radio.value);
			var myModal = new bootstrap.Modal(document.getElementById('editmodal'))
			
			myModal.show();
			document.getElementById("inputNameModal").value = radio.value;
			break;
        }
		if(lastItem==radio){
			
			$('#edit_radio_alert').show();
			
			
			  $("#edit_radio_alert").delay(2000).fadeOut("normal");
			  
			   
		}
    }
}


