let e;
let x;

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
	
	let selectedCategory = document.getElementById("categoryslimit");
	let catID=selectedCategory.options[selectedCategory.selectedIndex].id;
	console.log(catID);
	/*
    var radios = document.getElementsByName('old_category');
	const lastItem = radios[radios.length - 1]
    for (var radio of radios)
    {
		
        if (radio.checked) {
            
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
	*/
}
//set limit

function testLIMIT(){
	 e = document.getElementById("categoryslimitExpense");
		 x=e.options[e.selectedIndex].id;
	//console.log(x);
	//console.log(f);
	
	fetch(`/balance/fetchCategory/:${id}`)
	 .then((response) => response.json())
	.then((data) => console.log(data));
	

	
}







document.getElementById('myBtnLimit').onclick = function() {
	var myModal = new bootstrap.Modal(document.getElementById('limit_modal'))
	
	let selectedCategory = document.getElementById("categoryslimit");
		 let catID=selectedCategory.options[selectedCategory.selectedIndex].id;
	
	document.getElementById("inputNameModalHidenLimit").value = catID;
	myModal.show();
	/*
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
*/
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


