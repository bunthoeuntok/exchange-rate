<?php 
require_once 'Database.php';
require_once 'Paginator.php';

	class User extends Database {

		public static function all() {
			$query = 'SELECT users.id,
						emp.name as employee_name,
						role.name as role_name,
						users.status
							FROM ex_users as users
							 INNER JOIN ex_roles as role 
							 	ON users.role_id = role.id
							 INNER JOIN ex_employees as emp
							 	ON users.emp_id = emp.id
							WHERE users.is_delete = 0 AND role.is_delete = 0 AND emp.is_delete = 0';
			return parent::findAll($query);
		}

		public static function createOption() {
			$query = 'SELECT id, name FROM ex_employees';
			return parent::findAll($query);
		}

		public static function paginate($params = array()) {
			$query = 'SELECT users.id as no,
						emp.name as employee_name,
						role.name as role_name,
						users.status
							FROM ex_users as users
							 INNER JOIN ex_roles as role 
							 	ON users.role_id = role.id
							 INNER JOIN ex_employees as emp
							 	ON users.emp_id = emp.id
							WHERE users.is_delete = 0  AND role.is_delete = 0 AND emp.is_delete = 0 LIMIT :limits OFFSET :offsets';
			$users = new Paginator('ex_users', true);
			return $users->pagination($query, $params);
		}

		public static function find($params = array()) {
			$query = 'SELECT * FROM ex_users WHERE username = :username AND password = :password';
			$user = parent::findOne($query, $params);
			if($user != false) {
				session_start();
				$_SESSION['user'] = $user;
			}

			return $user;
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_users(emp_id, role_id, username,  password) VALUES(:emp_id, :role_id, :username, :password)';
			parent::insert($query, $params);
		}

		// public static function delete($ids = array()) {
		// 	$query = 'DELETE FROM users WHERE id = :id';
		// 	parent::destroy($query, $ids);
		// }

		// public static function update($params = array()) {
		// 	$query = 'UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id';
		// 	parent::edit($query, $params);
		// }

	}

 ?>