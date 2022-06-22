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
	
	public function ExpenseCategoryAction()
	{
		View::renderTemplate('Profile/ExpenseCategory.html',[
		'user'=>$this->user
		]);
	}
	public function AddExpenseCategoryAction()
	{
		
		
		$new_category=$_POST['category'];
		
		if(BalanceModel::check_if_category_exist('expenses_category_assigned_to_users',$new_category)){
		
		if($this->user->AddExpenseCategory($_POST)){
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/show');
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
	public function IncomeCategoryAction()
	{
		
		//BalanceModel::check_if_category_exist('incomes_category_assigned_to_users',$);
		
		View::renderTemplate('Profile/IncomeCategory.html',[
		'user'=>$this->user
		]);
		
	}
	public function AddIncomeCategoryAction()
	{
		
		$new_category=$_POST['category'];
		
		if(BalanceModel::check_if_category_exist('incomes_category_assigned_to_users',$new_category)){
		
		if($this->user->AddIncomeCategory($_POST)){
			
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/show');
		
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
	public function deleteIncomeCategorysAction()
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
	public function DeleteIncomeAction()
	{
		View::renderTemplate('Profile/DeleteIncome.html',[
		'user'=>$this->user,
		'categorys'=>BalanceModel::getCategorys('incomes_category_assigned_to_users')
		]);
	}
	public function PaymentCategoryAction()
	{
		View::renderTemplate('Profile/PaymentCategory.html',[
		'user'=>$this->user
		]);
	}
	public function AddPaymentCategoryAction()
	{
		
		$new_category=$_POST['category'];
		
		if(BalanceModel::check_if_category_exist('payment_methods_assigned_to_users',$new_category)){
		if($this->user->AddPaymentCategory($_POST)){
			Flash::addMessage('Changes saved');
			$this->redirect('/profile/show');
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
	public function deletePaymentCategorysAction()
	{
		$items=BalanceModel::getCategorys('payment_methods_assigned_to_users');
		if(count($items)>1)
		{
		$data=$_POST['category'];
		
		
		
		
		BalanceModel::delete_category('payment_methods_assigned_to_users',$data);
		
		Flash::addMessage('Category deleted');
		$this->redirect('/profile/show');
		}else{
			Flash::addMessage('Cant delete last item ',Flash::WARNING);
			$this->redirect('/profile/DeletePayment');
		}
		
	}
	public function DeletePaymentAction()
	{
		View::renderTemplate('Profile/DeletePayment.html',[
		'user'=>$this->user,
		'payment_methods'=>BalanceModel::getCategorys('payment_methods_assigned_to_users')
		]);
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