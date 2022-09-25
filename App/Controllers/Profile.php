<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\BalanceModel;

class Profile extends Authenticated
{
	protected function before()
	{
		parent::before();
		$this->user=Auth::getUser();
	}
	
	public function showAction()
	{
		View::renderTemplate('Profile/show.html',[
		'user'=>$this->user
		]);
		
	}

	public function editAction()
	{
		View::renderTemplate('Profile/edit.html',[
		'user'=>$this->user
		]);
	}
	 
	public function editCategory($name, $tableName) 
	{
	if (isset($_POST['new'])) {
	
			//View::renderTemplate('Profile/Add'.$name.'Category.html');
			Profile::AddNewCategory($tableName, $name);
		
	
	
	} else if(isset($_POST['delete'])){
		
			
			Profile::deleteCategorys($tableName);
			Flash::addMessage('Item removed');
			$this->redirect('/profile/'.$name.'Category');
			

    
	}else if(isset($_POST['edit'])){
		Profile::saveEditCategorysAction($tableName);
		
		
	}
	}
	public function deleteCategorys($name)
	{
		$items=BalanceModel::getCategorys($name);
		if(count($items)>1)
		{
		$data=$_POST['hiden_input_category_DELETE'];
		
		BalanceModel::delete_category($name,$data);
		

		}else{
			Flash::addMessage('Cant delete last item ',Flash::WARNING);
			$this->redirect('/profile/'.$name.'Category');
		}
		
	}
	
	public function editExpenseCategoryAction()
	{
		Profile::editCategory('Expense', 'expenses_category_assigned_to_users');
	}

	public function ExpenseCategoryAction()
	{
		View::renderTemplate('Profile/EditCategory.html',[
		'user'=>$this->user,
		'categorys'=>BalanceModel::getCategorys('expenses_category_assigned_to_users'),
		'action_title'=>'editExpenseCategory',
		'title'=>'Expense'
		]);
	}
	public function AddNewCategory($tableName, $name)
	{
		$data=$_POST['category'];
		
		if(BalanceModel::check_if_category_exist($tableName,$data)){
		
		if($this->user->AddCategorys($tableName,$data)){
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/'.$name.'Category');
		}else{
			
			View::renderTemplate('Profile/edit.html',[
				'user'=>$this->user
			]);
			}
		}else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/'.$name.'Category');
		}
	}
	public function AddExpenseCategoryAction()
	{
		$data=$_POST['category'];
		
		if(BalanceModel::check_if_category_exist('expenses_category_assigned_to_users',$data)){
		
		if($this->user->AddExpenseCategorys($data)){
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/ExpenseCategory');
		}else{
			
			View::renderTemplate('Profile/edit.html',[
				'user'=>$this->user
			]);
			}
		}else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/ExpenseCategory');
		}
	}

	public function saveEditCategorysAction($table_name)
	{
			
		if(isset($_POST['category'])){
			$name_to_edit=$_POST['category'];
			$old=$_POST['hiden_input_category'];
			
		if(BalanceModel::check_if_category_exist($table_name,$_POST['category'])){
			
		BalanceModel::setNewName($table_name,$old,$name_to_edit);

		
		Flash::addMessage('Name changed');
		$this->redirect('/profile/ExpenseCategory');
		
		}	else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/ExpenseCategory');
		}
	}
	else{
			Flash::addMessage('Selecet category first', Flash::WARNING);
			$this->redirect('/profile/'.$name.'Category');
		}
		
		
	}


	public function saveEditExpenseCategorysAction()
	{

		if(isset($_POST['category'])){
			$name_to_edit=$_POST['category'];
			$old=$_POST['old_category'];
			
		if(BalanceModel::check_if_category_exist('expenses_category_assigned_to_users',$_POST['category'])){
			
		BalanceModel::setNewName('expenses_category_assigned_to_users',$old,$name_to_edit);

		
		Flash::addMessage('Name changed');
		$this->redirect('/profile/ExpenseCategory');
		
		}	else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/ExpenseCategory');
		}
	}
	else{
			Flash::addMessage('Selecet category first', Flash::WARNING);
			$this->redirect('/profile/'.$name.'Category');
		}
		
		
	}
	
	public function IncomeCategoryAction()
	{
		
		View::renderTemplate('Profile/EditCategory.html',[
		'user'=>$this->user,
		'categorys'=>BalanceModel::getCategorys('incomes_category_assigned_to_users'),
		'action_title'=>'editIncomesCategory',
		'title'=>'Income'
		]);
		
	}
	public function editIncomesCategoryAction()
	{
		Profile::editCategory('Income','incomes_category_assigned_to_users');
	}
	public function AddIncomeCategoryAction()
	{
		
		$new_category=$_POST['category'];
		
		if(BalanceModel::check_if_category_exist('incomes_category_assigned_to_users',$new_category)){
		
		if($this->user->AddIncomeCategory($_POST)){
			
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/IncomeCategory');
		
		}else{
			
			View::renderTemplate('Profile/edit.html',[
				'user'=>$this->user
			]);
			}
		}else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/IncomeCategory');
		}
			
	}
	public function deleteIncomeCategorys()
	{
		$items=BalanceModel::getCategorys('incomes_category_assigned_to_users');
		if(count($items)>1)
		{
		$data=$_POST['category'];
		
		BalanceModel::delete_category('incomes_category_assigned_to_users',$data);
		
		Flash::addMessage('Category deleted');
		$this->redirect('/profile/show');
		}else{
			Flash::addMessage('Cant delete last item ',Flash::WARNING);
			$this->redirect('/profile/DeleteIncome');
		}
		
	}
	public function saveEditIncomesCategorysAction ()
	{
		if(isset($_POST['category'])){
			$name_to_edit=$_POST['category'];
			$old_name=$_POST['hiden_input_category'];
			
		if(BalanceModel::check_if_category_exist('incomes_category_assigned_to_users',$_POST['category'])){
			
		BalanceModel::setNewName('incomes_category_assigned_to_users',$old_name,$name_to_edit);

		
		Flash::addMessage('Name changed');
		$this->redirect('/profile/IncomeCategory');
		
		}	else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/IncomeCategory');
		}
	}
	else{
			Flash::addMessage('Selecet category first', Flash::WARNING);
			$this->redirect('/profile/'.$name.'Category');
		}
		

	}
	public function editPaymentCategoryAction()
	{
		Profile::editCategory('Payment', 'payment_methods_assigned_to_users');
	}
	public function saveEditPaymentCategorysAction ()
	{
				if(isset($_POST['category'])){
			$name_to_edit=$_POST['category'];
			$old_name=$_POST['hiden_input_category'];
			
		if(BalanceModel::check_if_category_exist('payment_methods_assigned_to_users',$_POST['category'])){
			
		BalanceModel::setNewName('payment_methods_assigned_to_users',$old_name,$name_to_edit);

		
		Flash::addMessage('Name changed');
		$this->redirect('/profile/PaymentCategory');
		
		}	else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/PaymentCategory');
		}
	}
	else{
			Flash::addMessage('Selecet category first', Flash::WARNING);
			$this->redirect('/profile/'.$name.'Category');
		}
		
		/*
		if(BalanceModel::check_if_category_exist('payment_methods_assigned_to_users',$_POST['category'])){
		BalanceModel::setNewName('payment_methods_assigned_to_users',$_SESSION['name_to_edit'],$_POST['category']);
		$_SESSION['CATEGORY_TO_EDIT']="";
		Flash::addMessage('Name changed');
		$this->redirect('/profile/PaymentCategory');
		}	else{
			Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/PaymentCategory');
		}
		*/
	}
	public function PaymentCategoryAction()
	{
		View::renderTemplate('Profile/EditCategory.html',[
		'user'=>$this->user,
		'categorys'=>BalanceModel::getCategorys('payment_methods_assigned_to_users'),
		'action_title'=>'editPaymentCategory',
		'title'=>'Payment'
		]);
	}
	public function AddPaymentCategoryAction()
	{
		
		$new_category=$_POST['category'];
		
		if(BalanceModel::check_if_category_exist('payment_methods_assigned_to_users',$new_category)){
		if($this->user->AddPaymentCategory($_POST)){
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/PaymentCategory');
		}else{
			
			View::renderTemplate('Profile/edit.html',[
				'user'=>$this->user
			]);
			}
	}else{
		Flash::addMessage('this category alerady exist', Flash::WARNING);
			$this->redirect('/profile/PaymentCategory');
	}
	}
	public function deletePaymentCategorysAction()
	{
		$items=BalanceModel::getCategorys('payment_methods_assigned_to_users');
		if(count($items)>1)
		{
		$data=$_POST['category'];
		
		
		
		
		BalanceModel::delete_category('payment_methods_assigned_to_users',$data);
		
		Flash::addMessage('Category deleted');
		$this->redirect('/profile/PaymentCategory');
		}else{
			Flash::addMessage('Cant delete last item ',Flash::WARNING);
			$this->redirect('/profile/DeletePayment');
		}
		
	}

	
	
	public function updateAction()
	{
		
		
		if($this->user->updateProfile($_POST)){
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/show');
		}else{
			
			View::renderTemplate('Profile/edit.html',[
				'user'=>$this->user
			]);
			}
	}
	
	
	
	
	
}