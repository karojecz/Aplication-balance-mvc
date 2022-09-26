//add new category

document.getElementById('myBtnAdd').onclick = function() {

			var AddCategoryModal = new bootstrap.Modal(document.getElementById('addCategoryModal'))
			AddCategoryModal.show();
			
							//this is js validation of text input add category in edit profile/add categorys
				

document.getElementById("AddCategoryButton").addEventListener("click", function(event){


var comment=document.getElementById("inputNameModalAddCategory").value;


const regex=/^[A-Za-z0-9 ,.]*$/;

if(!regex.test(comment)){

	
	

	document.getElementById("input_alert").innerHTML = "You can only use letters and numbers. Special characters are not allowed." ;
	$('#input_alert').show();
	
	
	setTimeout(function () {
				$( "#input_alert" ).hide('fade');
				},3000);
	
  event.preventDefault();
  
  }
  
});
		

}



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
	if(lastItem==radio){
			
			$('#edit_radio_alert').show();
			
			
			  $("#edit_radio_alert").delay(2000).fadeOut("normal");
			  
			   
		}
}
}

$('#closemodal').click(function() {
    $('#delete_modal').modal('hide');
});


$('#Cancel-edit-button').click(function() {
    $('#editmodal').modal('hide');
});


