<?php 
require_once 'Database.php';
require_once 'Paginator.php';

	class Role extends Database {

		public static function all() {
			$query = 'SELECT id, name, description FROM ex_roles WHERE is_delete = 0';
			return parent::findAll($query);
		}

		public static function paginate($params = array()) {
			$query = 'SELECT id, name, description FROM ex_roles  WHERE is_delete = 0 LIMIT :limits OFFSET :offsets';
			$users = new Paginator('ex_roles');
			return $users->pagination($query, $params);


		}

		public static function find($id = array()) {
			$query = 'SELECT * FROM ex_roles WHERE id = :id';
			return parent::findOne($query, $id);
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_roles(name, description) VALUES(:name, :description )';
			parent::insert($query, $params);
		}

		public static function delete($ids = array()) {
			$query = 'UPDATE ex_roles SET is_delete = 1 WHERE id = :id';
			parent::destroy($query, $ids);
		}

		public static function update($params = array()) {
			$query = 'UPDATE ex_roles SET name = :name, description = :description WHERE id = :id';
			parent::edit($query, $params);
		}

	}

 ?>