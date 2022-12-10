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
			
			if(limitForCategory>amount){
					document.getElementById("limit_alert").innerHTML = "limit!!!!" ;
					$('#limit_alert').show();
					

				
			}
		}
		
		//console.log(catID);
		//console.log(limitForCategory.category_limit);
		//console.log(amount.sum);
		
	}

	
	function getAmountFromCategory(){
		
		let catID=getCategoryId();
		let date=getCategoryDate();
		//let limitForCategory=checkLimit();
		
		/*
		var date = getCategoryDate(), y = date.getFullYear(), m = date.getMonth();
		var firstDay = new Date(y, m, 1);
		var lastDay = new Date(y, m + 1, 0);

		console.log(firstDay.toLocaleDateString());
		*/
		

		
	return	fetch(`/balance/getAmount/${catID}?date2=${date}`)
		.then((data) => data.json())
		.then((data) => data.sum);
		
		
		

		//.then((data)=>checkIfLimitExceeded(limitForCategory,data))
		//.then(data => { obj = data;})

		//.then(checkIfLimitExceeded(limitForCategory,obj))
		
		
		
		
		
	}
	
	
	
	
	
	
	
	