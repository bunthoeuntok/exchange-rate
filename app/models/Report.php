<?php 
	require_once 'Database.php';

	class Report extends Database {

		public static function all() {
			$query = 'SELECT ex.id as no, emp.name as employee, cur_one.name as from_currency, ex.from_amount as from_amount, cur_two.name as to_currecy, ex.to_amount as to_amount, ex.ex_rate as rate, ex.created_at
						FROM ex_exchange AS ex
						INNER JOIN ex_users as user 
						ON ex.user_id = user.id
						INNER JOIN ex_employees as emp
						ON user.emp_id = emp.id
						INNER JOIN ex_currencies as cur_one
						ON ex.from_cur = cur_one.id
						INNER JOIN ex_currencies as cur_two
						ON ex.to_cur = cur_two.id';

			return parent::findAll($query);
		}

		public static function byEmployee($params = array()) {
			$query = 'SELECT ex.id as no, emp.name as employee, cur_one.name as from_currency, ex.from_amount as from_amount, cur_two.name as to_currecy, ex.to_amount as to_amount, ex.ex_rate as rate, ex.created_at
						FROM ex_exchange AS ex
						INNER JOIN ex_users as user 
						ON ex.user_id = user.id
						INNER JOIN ex_employees as emp
						ON user.emp_id = emp.id
						INNER JOIN ex_currencies as cur_one
						ON ex.from_cur = cur_one.id
						INNER JOIN ex_currencies as cur_two
						ON ex.to_cur = cur_two.id WHERE user_id = :user_id AND (created_at = :start_date OR created_at = :end_date)';
		}

		public static function startDate() {

		}
	}
 ?>