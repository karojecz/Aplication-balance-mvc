//edit
document.getElementById('myBtnEdit').onclick = function() {
    var radios = document.getElementsByName('old_category');
	const lastItem = radios[radios.length - 1]
    for (var radio of radios)
    {
		
        if (radio.checked) {
            //alert(radio.value);
			var myModal = new bootstrap.Modal(document.getElementById('editmodal'))
			
			myModal.show();
			document.getElementById("inputNameModalHiden").value = radio.value;
			document.getElementById("inputNameModal").value = radio.value;
			
			break;
        }
		if(lastItem==radio){
			
			$('#edit_radio_alert').show();
			
			
			  $("#edit_radio_alert").delay(2000).fadeOut("normal");
			  
			   
		}
    }
}

//delete

document.getElementById('myBtnDelete').onclick = function() {
    var radios = document.getElementsByName('old_category');
	const lastItem = radios[radios.length - 1]
    for (var radio of radios)
    {
		
        if (radio.checked) {
            //alert(radio.value);
			var myModal = new bootstrap.Modal(document.getElementById('delete_modal'))
			
			myModal.show();
			var value=radio.value;
			document.getElementById("inputNameModalHiden_delete").value = radio.value;
			document.getElementById("delete_query_text").innerHTML = "Are You sure to delete " +value+ " category?" ;
			//document.getElementById("inputNameModal").value = radio.value;
			
			break;
        }

    }
}

$('#closemodal').click(function() {
    $('#delete_modal').modal('hide');
});


$('#Cancel-edit-button').click(function() {
    $('#editmodal').modal('hide');
});


