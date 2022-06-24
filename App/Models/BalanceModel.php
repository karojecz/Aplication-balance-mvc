<?php

namespace App\Models;

use PDO;

use \Core\View;
use \App\Mail;

/**
 * User model
 *
 * PHP version 7.0
 */
class BalanceModel extends \Core\Model
{
	public $errors = [];
	//public $start_date;
	//public $end_date;
	
	 
	 
	public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
	

	public static function findIncome( $start_date, $end_date)
	{		
	
				
	
				$db = static::getDB();
				$stmt = $db->prepare('SELECT incomes.amount AS amount, incomes.date_of_income AS date, incomes.income_comment AS comment, incomes_category_assigned_to_users.name AS category  FROM incomes,incomes_category_assigned_to_users  WHERE incomes.user_id=:user_id  AND incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id AND  incomes.date_of_income  BETWEEN :start_date AND :end_date ORDER BY incomes_category_assigned_to_users.name DESC ');
				
				
				$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
				$stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
				$stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
				
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				//$stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());
				
				
				$stmt->execute();

				$result = $stmt->fetchAll();
				
						
		return $result;
	}

	public static function findExpense($start_date, $end_date)
	{		
	
				$db = static::getDB();
				$stmt = $db->prepare('SELECT expenses.amount AS amount, expenses.date_of_expense AS date, expenses.expense_comment AS comment, expenses_category_assigned_to_users.name AS category  FROM expenses,expenses_category_assigned_to_users  WHERE   expenses.user_id=:user_id  AND expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id AND  expenses.date_of_expense  BETWEEN :start_date AND :end_date ORDER BY expenses_category_assigned_to_users.name DESC ');
				
				
				$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
				$stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
				$stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
				
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				//$stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());
				
				
				$stmt->execute();

				$result = $stmt->fetchAll();
				
						
		return $result;
	}


	public static function findIncomeSums($start_date, $end_date)
	{
				$db = static::getDB();
				
			
				$stmt = $db->prepare('SELECT incomes_category_assigned_to_users.name AS name, SUM(incomes.amount) AS sum FROM incomes_category_assigned_to_users,incomes WHERE   incomes.user_id=:user_id AND incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id AND incomes.date_of_income  BETWEEN :start_date AND :end_date GROUP BY incomes_category_assigned_to_users.name ORDER BY sum DESC ');
				
				
				$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
				$stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
				$stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
				
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				//$stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());
				
				
				$stmt->execute();

				$result = $stmt->fetchAll();
				
						
		return $result;
		
	}
	public static function findExpensesSums($start_date, $end_date)
	{
				$db = static::getDB();
				
			
				$stmt = $db->prepare('SELECT expenses_category_assigned_to_users.name AS name, SUM(expenses.amount) AS sum FROM expenses_category_assigned_to_users,expenses WHERE expenses.user_id=:user_id AND expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id AND expenses.date_of_expense  BETWEEN :start_date AND :end_date GROUP BY expenses_category_assigned_to_users.name ORDER BY sum DESC ');
				
				
				$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
				$stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
				$stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
				
				
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				//$stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());
				
				
				$stmt->execute();

				$result = $stmt->fetchAll();
				
						
		return $result;
	}
	public static function findOverallExpenseSum($start_date, $end_date)
	{
		$array=BalanceModel::findExpensesSums($start_date, $end_date);
						$sum=BalanceModel::sumsAllItems($array);
						return $sum;
	}
	public static function findOverallIncomeSum($start_date, $end_date)
	{
		$array=BalanceModel::findIncomeSums($start_date, $end_date);
						$sum=BalanceModel::sumsAllItems($array);
						return $sum;
	}
	public static function checkBalance($expenseSum, $incomeSum)
	{
		$balance=$incomeSum-$expenseSum;
		return $balance;
	}
	public static function sumsAllItems($array)
	{
		$sum=0;

		foreach($array as $item){
			foreach($item as $key=>$value){
										
										  
				$sum+= floatval($value);
										
				}
		}
		
		return $sum;
	}
	
	
	public static function getCategorys($table_name)
	{
			$sql = 'SELECT id, name FROM '.$table_name.' WHERE user_id=:user_id AND active=1';
			
			$db = static::getDB();
			
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
			//$stmt->bindValue(':table_name', $table_name, PDO::PARAM_STR);

			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$stmt->execute();
			
			
			$result=$stmt->fetchAll();
			return $result;
			
	}
	public static function check_if_category_exist($table_name, $category_name)
	{
		
		
		$categorys=BalanceModel::getCategorys($table_name);
		
		foreach($categorys as $item )
		{
			 foreach( $item  as $key => $value)
			 {
			  if($value==$category_name)
			  {
				  return false;
			  }
				 
			 }
    
		}
		return true;
		
		
	}
	public static function delete_category($table_name, $data)
	{
	 $sql = 'UPDATE '.$table_name.' SET active=0 WHERE user_id=:user_id AND name=:name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':name',$data, PDO::PARAM_STR);

        return $stmt->execute();
		
	}

	public static function setNewName($table_name, $oldName,$newName)
	{
	 $sql = 'UPDATE '.$table_name.' SET name=:newName WHERE user_id=:user_id AND name=:oldName';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':oldName',$oldName, PDO::PARAM_STR);
        $stmt->bindValue(':newName',$newName, PDO::PARAM_STR);

        return $stmt->execute();
		
	}


	public static function  get_user_category_id($table_name, $category_name)
	{
		
		
		$sql='SELECT id FROM '.$table_name.' WHERE name=:name AND user_id=:user_id ';
		
		$db = static::getDB();
         $stmt = $db->prepare($sql);
		 
		$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
		$stmt->bindValue(':name', $category_name, PDO::PARAM_STR);
		//$stmt->bindValue(':table_name', $table_name, PDO::PARAM_STR);
		 
		 		$stmt->execute();

				$result = $stmt->fetch();
				return $result[0];	
	}
	public function validate()
	{
		$date_Y_m_d=explode("-",$this->date);
		$year=$date_Y_m_d[0];
		$month=$date_Y_m_d[1];
		$day=$date_Y_m_d[2];
		
		if($this->amount==""){
		$this->errors[] = 'Amount is required';
        }
		
		if (is_numeric($this->amount=="")) {
		$this->errors[] = 'This field must be number';	
		}
		
		if($this->date>time()){
		$this->errors[] = 'This date is in future';
		}
		
		if($this->date==""){
		$this->errors[] = 'Date is required';
		}
		
		if(!checkdate($month, $day, $year)){
		$this->errors[] = 'Wrong date';	 
		}
		

	}
	
		/*test do PHP MAILER
	*/
	public static function testMailer()
	{
		Mail::sendtest();
	}
	
	
	
	
}