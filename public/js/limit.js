
	var residueLimit;
	var InputAmount;
	
	 function show_limit_alert(){
		

	let amountInputValue = document.getElementById('expenseAmount').value;
	
	document.getElementById("limit_alert").innerHTML = 'the limit will be exceeded' ;
	$('#limit_alert').show();
	

				
					 setTimeout(function () {
				$( "#limit_alert" ).hide('fade');
				},5000);

		
		
	}
	function getInputValue(){
		
		let InputValue = document.getElementById('expenseAmount').value;
		InputAmount = InputValue;
		
		console.log(InputValue);
		
			if(InputAmount!=null){
				if(InputAmount>residueLimit){
					console.log('limit');
					show_limit_alert();
				}
				
			}
		
		
	}
	function testPOST(){
		
					const data = { username: 'example' };
					console.log(data);

					fetch(`/balance/testPOST`, {
					  method: 'POST', // or 'PUT'
					  headers: {
						'Content-Type': 'application/json',
					  },
					  body: JSON.stringify({"lubi ": 5} ),
					})
					 .then((response) => response.json())
					  .then((data) => {
						console.log('Success:', data);
					  })
					  .catch((error) => {
						console.error('Error:', error);
					  });
					 
					 
		
		
	}
	

	

	
	
	
	function getCategoryId(){
		let selectedCategory = document.getElementById("categoryslimit2");
		 let catID=selectedCategory.options[selectedCategory.selectedIndex].id;
		 
		 return catID;
		
	}

	function checkLimit(){
		
		let catID=getCategoryId();
		
		
		
		return fetch(`/balance/checkLimit/${catID}`)
		.then((response)=>response.json())
		.then((response) => response.category_limit);
		
		
	}
	

	function getCategoryMonth(){
		//return document.getElementById();
		
		const date = new Date(document.getElementById('DATEofEXPENSE').value);
		
		//console.log(date.getMonth());
		
		return date.getMonth();
		
	}
	function getCategoryDate()
	{
		//const date = new Date(document.getElementById('DATEofEXPENSE').value);
		const date = document.getElementById('DATEofEXPENSE').value;
		return date;
		
	}
	async function checkIfLimitExceeded()
	{
		
		let catID= await getCategoryId();
		let date= await getCategoryDate();
		let amount = await  getAmountFromCategory();
		let limitForCategory = await checkLimit();
		
		
		
		console.log(amount);
		
		console.log(limitForCategory);
		if(amount !=null){
		
			let result = limitForCategory - amount;
			console.log(result);
			residueLimit = result;
			
			
			if(InputAmount!=null){
				if(InputAmount>residueLimit){
					console.log('limit');
					show_limit_alert();
				}
				
			}
			

		}
		

		
	}
	

	
	function getAmountFromCategory(){
		
		let catID=getCategoryId();
		let date=getCategoryDate();

		

		
	return	fetch(`/balance/getAmount/${catID}?date2=${date}`)
		.then((data) => data.json())
		.then((data) => data.sum);
		

				
	}
	
	
	
	
	
	
	
	