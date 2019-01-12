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

		public static function option() {
			$query = 'SELECT id, name FROM ex_employees WHERE id NOT IN(SELECT emp_id FROM ex_users)';
			return parent::findAll($query);
		}

		public static function find($params = array()) {
			$query = 'SELECT  user.id, emp.name, user.role_id, role.name AS role_name, user.username, user.password
						FROM ex_users AS user
							INNER JOIN ex_employees AS emp
								ON user.emp_id = emp.id
							INNER JOIN ex_roles AS role
								ON user.role_id = role.id
						WHERE user.username = :username AND user.password = :password AND user.status = 0 AND user.is_delete = 0';
			$params['password'] = md5($params['password']);
			$user = parent::findOne($query, $params);
			if($user != false) {
				session_start();
				$_SESSION['user'] = $user;
			}

			return $user;
		}

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_users(emp_id, role_id, username,  password) VALUES(:emp_id, :role_id, :username, :password)';
			$params['password'] = md5($params['password']);
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