<?php 
require_once 'Database.php';
require_once 'Paginator.php';

	class CurrencyRate extends Database {

		public static function all() {
			$query = 'SELECT cur_rate.id,
							cur_one.name AS from_currency,
							cur_two.name as to_currency,
							cur_rate.rate AS currency_rate,
							cur_rate.updated_at as last_update 
						FROM ex_currency_rate AS cur_rate
							INNER JOIN ex_currencies AS cur_one
								ON cur_rate.from_cur = cur_one.id
							INNER JOIN ex_currencies AS cur_two
								ON cur_rate.to_cur = cur_two.id 
						WHERE cur_one.is_delete = 0 and cur_two.is_delete = 0';
			return parent::findAll($query); 
		}

		public static function paginate($params = array()) {
			$query = 'SELECT cur_rate.id,
							cur_one.name AS from_currency,
							cur_two.name as to_currency,
							cur_rate.rate AS currency_rate,
							emp.name AS updated_by,
							cur_rate.updated_at as last_update 
						FROM ex_currency_rate AS cur_rate
							INNER JOIN ex_currencies AS cur_one
								ON cur_rate.from_cur = cur_one.id
							INNER JOIN ex_currencies AS cur_two
								ON cur_rate.to_cur = cur_two.id
							INNER JOIN ex_users as user
								ON cur_rate.updated_by = user.id
							INNER JOIN ex_employees AS emp
								ON user.emp_id = emp.id
						WHERE cur_one.is_delete = 0 and cur_two.is_delete = 0 AND cur_rate.is_delete = 0 LIMIT :limits OFFSET :offsets';
			$rate = new Paginator('ex_currency_rate', true);
			return $rate->pagination($query, $params);
		}

		public static function option() {
			$query = 'SELECT id, name FROM ex_currencies WHERE is_delete = 0';
			return parent::findAll($query);
		}

		public static function find($id = array()) {
			$query = 'SELECT * FROM ex_currency_rate WHERE id = :id';
			return parent::findOne($query, $id);
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_currency_rate(from_cur, to_cur, rate, updated_by) VALUES(:from_cur, :to_cur, :rate, :updated_by)';
			parent::insert($query, $params);
		}

		public static function delete($ids = array()) {
			$query = 'UPDATE ex_currency_rate SET is_delete = 1 WHERE id = :id';
			parent::destroy($query, $ids);
		}

		public static function update($params = array()) {
			$query = 'UPDATE ex_currency_rate SET from_cur = :from_cur, to_cur = :to_cur, rate = :rate, updated_by = :updated_by WHERE id = :id';
			parent::edit($query, $params);
		}

	}

 ?>