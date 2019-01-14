<?php 
require_once 'Database.php';
require_once 'Paginator.php';

	class Currency extends Database {

		public static function all() {
			$query = 'SELECT id, name, symbol, country, unit_price FROM ex_currencies WHERE is_delete = 0';
			return parent::findAll($query);
		}

		public static function paginate($params = array()) {
			$query = 'SELECT id, name, symbol, country, unit_price FROM ex_currencies  WHERE is_delete = 0 LIMIT :limits OFFSET :offsets';
			$currency = new Paginator('ex_currencies');
			return $currency->pagination($query, $params);


		}

		public static function option() {
			$query = 'SELECT id, name FROM ex_currencies WHERE is_delete = 0';
			return parent::findAll($query);
		}

		public static function find($id = array()) {
			$query = 'SELECT * FROM ex_currencies WHERE id = :id';
			return parent::findOne($query, $id);
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_currencies(name, symbol, country, unit_price) VALUES(:name, :symbol, :country, :unit_price)';
			parent::insert($query, $params);
		}

		public static function delete($ids = array()) {
			$query = 'UPDATE ex_currencies SET is_delete = 1 WHERE id = :id';
			parent::destroy($query, $ids);
		}

		public static function update($params = array()) {
			$query = 'UPDATE ex_currencies SET name = :name, symbol = :symbol, country = :country, unit_price = :unit_price WHERE id = :id';
			parent::edit($query, $params);
		}

	}

 ?>