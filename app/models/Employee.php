<?php 
require_once 'Database.php';
require_once 'Paginator.php';

	class Employee extends Database {

		public static function all() {
			$query = 'SELECT id, name, gender, birth_date, phone, hired_date FROM ex_employees WHERE is_delete = 0';
			return parent::findAll($query);
		}

		public static function paginate($params = array()) {
			$query = 'SELECT id, name, gender, birth_date, phone, hired_date FROM ex_employees  WHERE is_delete = 0 LIMIT :limits OFFSET :offsets';
			$users = new Paginator('ex_employees');
			return $users->pagination($query, $params);


		}

		public static function find($id = array()) {
			$query = 'SELECT * FROM ex_employees WHERE id = :id';
			return parent::findOne($query, $id);
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_employees(name, gender, birth_date, phone, address, social_id, hired_date) VALUES(:name, :gender, :birth_date, :phone, :address, :social_id, :hired_date )';
			parent::insert($query, $params);
		}

		public static function delete($ids = array()) {
			$query = 'UPDATE ex_employees SET is_delete = 1 WHERE id = :id';
			parent::destroy($query, $ids);
		}

		public static function update($params = array()) {
			$query = 'UPDATE ex_employees SET name = :name, gender = :gender, birth_date = :birth_date, phone = :phone, address = :address, social_id = :social_id, hired_date = :hired_date WHERE id = :id';
			parent::edit($query, $params);
		}

	}

 ?>