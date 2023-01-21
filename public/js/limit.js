
	
	var InputAmount;
	
	function show_limit_alert(alertText,alertType){
		

	document.getElementById("limit_alert").className = alertType;
	document.getElementById("limit_alert").innerHTML = alertText ;
	$('#limit_alert').show();
	


		
		
	}
	
	function getInputValue(){
		checkIfLimitExceeded();

		
	}
	
var radios = document.querySelectorAll('input[type=radio][name="category"]');
    radios.forEach(radio => radio.addEventListener('change', () => checkIfLimitExceeded()));
	


	

	

	
	
	
	function getCategoryId(){
		
		const radioButtons = document.querySelectorAll('input[name="category"]');
		
		let catID;
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    catID = radioButton.id;
                    break;
                }
            }
		
		
		/*
		let selectedCategory = document.getElementById("categoryslimit2");
		 let catID=selectedCategory.options[selectedCategory.selectedIndex].id;
		*/
		
		 return catID;
		
	}

	function checkLimit(){
		
		let catID=getCategoryId();
		
		
		
		return fetch(`/balance/checkLimit/${catID}`)
		.then((response)=>response.json())
		.then((response) => response.category_limit);
		
		
	}
	

	function getCategoryMonth(){
		
		
		const date = new Date(document.getElementById('DATEofEXPENSE').value);
		
		
		
		return date.getMonth();
		
	}

	function getCategoryDate()
	{
		
		 let date = document.getElementById('DATEofEXPENSE').value;
		return date;
		
	}
	function checkNewDate(){
		checkIfLimitExceeded();
	}
	
	
	async function checkIfLimitExceeded()
	{
		
		let InputValue = document.getElementById('expenseAmount').value;
		InputAmount = InputValue;
		
	
		
		
		let catID= await getCategoryId();
		let date= await getCategoryDate();
		let amount = await  getAmountFromCategory();
		let actualAmount=Number(amount);
		let limitForCategory = await checkLimit();

		
		let difference = limitForCategory - amount;
		let eneteredAmount = Number(InputValue)+Number(amount);
	
		let alertText = `
		Limit=${limitForCategory}, issued so far=${actualAmount}, difference=${difference}, expenses + entered amount=${eneteredAmount}`;
		let alertType='alert alert-success collapse';
		
		
		
		if(difference<0){
			alertType='alert alert-danger collapse';
		}
		
			if(InputAmount>0 && limitForCategory>0){

			
			
			if(eneteredAmount>limitForCategory){
				alertType='alert alert-danger collapse';
				show_limit_alert(alertText,alertType);
			}
			else if(eneteredAmount<limitForCategory){
				alertType='alert alert-success collapse'
				show_limit_alert(alertText,alertType);
			}
				
				
			}else{
				
				$( "#limit_alert" ).hide('fade');
			}
			
			
		
		

		

	}
	

	
	function getAmountFromCategory(){
		
		let catID=getCategoryId();
		let date=getCategoryDate();

		

		
	return	fetch(`/balance/getAmount/${catID}?date2=${date}`)
		.then((data) => data.json())
		.then((data) => data.sum);
		

				
	}
	
	
	
	
	
	
	
	