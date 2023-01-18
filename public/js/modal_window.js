
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

/*
document.getElementById('myBtnEdit').onclick = function() {
	
	let selectedCategory = document.getElementById("categoryslimit");
	//let catID=selectedCategory.options[selectedCategory.selectedIndex].id;
	let catName = selectedCategory.options[selectedCategory.selectedIndex].value;
	
	let catID = selectedCategory.options[selectedCategory.selectedIndex].id;
	
	let options = selectedCategory.options;
	
	var myModal = new bootstrap.Modal(document.getElementById('editCategoryModal'))
	myModal.show();
	
	document.getElementById("inputNameModalHiden").value = catName;
	
	document.getElementById("catId").value = catID;
	
	document.getElementById("inputNameModal").value = catName;
	

	


}
*/
//edit list version
document.querySelectorAll("button[name=SwitchEditCategoryButton]").forEach(occurence => {
  let catID = occurence.getAttribute('id');
  let catName = occurence.getAttribute('value');
  occurence.addEventListener('click', function() {
    
   
   	document.getElementById("inputNameModalHiden").value = catName;
	
	document.getElementById("catId").value = catID;
	
	document.getElementById("inputNameModal").value = catName;
   
   
   
  } );
});



//set limit

document.getElementById('limitCheckbox').onchange = function() {
    document.getElementById('limitInput').disabled = !this.checked;
};

/*
function enableInput(){
	
	
	if(limitCheckbox.checked){
		document.getElementByID("limitInput").disabled = false;
		
	}else{
		document.getElementByID("limitInput").disabled = true;
		
	}
		
}
*/





//delete list version

document.querySelectorAll("button[name=SwitchDeleteCategoryButton]").forEach(occurence => {
  let catID = occurence.getAttribute('data-catID');
  let catName = occurence.getAttribute('value');
  occurence.addEventListener('click', function() {
    
   
	document.getElementById("inputNameModalHiden_delete").value = catName;
	
	document.getElementById("delete_query_text").innerHTML = "Are You sure to delete " +catName+ " category?"
   
   
   
  } );
});



$('#closemodal').click(function() {
    $('#delete_modal').modal('hide');
});


$('#Cancel-edit-button').click(function() {
    $('#editmodal').modal('hide');
});


