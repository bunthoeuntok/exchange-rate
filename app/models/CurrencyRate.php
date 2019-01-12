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
							INNER JOIN ex_employees AS emp
								ON cur_rate.updated_by = emp.id
						WHERE cur_one.is_delete = 0 and cur_two.is_delete = 0 LIMIT :limits OFFSET :offsets';
			$users = new Paginator('ex_currency_rate', true);
			return $users->pagination($query, $params);


		}

		public static function find($id = array()) {
			$query = 'SELECT * FROM ex_currency_rate WHERE id = :id';
			return parent::findOne($query, $id);
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_currency_rate(name, symbol, country, unit_price) VALUES(:name, :symbol, :country, :unit_price)';
			parent::insert($query, $params);
		}

		public static function delete($ids = array()) {
			$query = 'UPDATE ex_currency_rate SET is_delete = 1 WHERE id = :id';
			parent::destroy($query, $ids);
		}

		public static function update($params = array()) {
			$query = 'UPDATE ex_currency_rate SET name = :name, symbol = :symbol, country = :country, unit_price = :unit_price WHERE id = :id';
			parent::edit($query, $params);
		}

	}

 ?>