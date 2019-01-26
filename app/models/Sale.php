<?php 
require_once 'Database.php';
require_once 'Paginator.php';

	class Sale extends Database {

		public static function all() {
			session_start();
			$query = 'SELECT ex.id as no, cur_one.name as from_currency, ex.from_amount, cur_two.name as to_currency, ex.to_amount FROM ex_exchange as ex
						INNER JOIN ex_currencies as cur_one
						ON ex.from_cur = cur_one.id
						INNER JOIN ex_currencies as cur_two
						ON ex.to_cur = cur_two.id where ex.user_id = :user_id and DATE(ex.created_at) = :today';
			return parent::findAll($query, array('user_id' => $_SESSION['user']->id, 'today' => date('Y-m-d')));
				// return date('Y-m-d');
		}

		public static function rate() {
			$query = 'SELECT rate.from_cur, cur_one.symbol as symbol_one, rate.to_cur, cur_two.symbol as symbol_two, rate.rate FROM ex_currency_rate as rate 
					INNER JOIN ex_currencies as cur_one
					ON rate.from_cur = cur_one.id
					INNER JOIN ex_currencies as cur_two
					ON rate.to_cur = cur_two.id WHERE rate.is_delete = 0 and cur_one.is_delete = 0 and cur_two.is_delete = 0';
				return parent::findAll($query);
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_exchange(user_id, from_cur, from_amount, to_cur, to_amount, ex_rate) VALUES(:user_id, :from_cur, :from_amount, :to_cur, :to_amount, :ex_rate)';
			parent::insert($query, $params);
			return $params;
		}

		

	}

 ?>