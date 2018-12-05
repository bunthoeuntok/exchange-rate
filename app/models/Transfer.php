<?php 
require_once 'Database.php';
require_once 'Paginator.php';

	class Transfer extends Database {

		public static function all() {
			$query = 'SELECT tran.id, sender.name, receiver.name, cur.name, tran.amount, tran.created_at
						FROM ex_transfer AS tran
							INNER JOIN ex_currencies AS cur
								ON cur.id = tran.cur_id
							INNER JOIN ex_users AS user_sender
								ON user_sender.id = tran.sender
							INNER JOIN ex_users AS user_receiver
								ON tran.receiver = user_receiver.id 
							INNER JOIN ex_employees AS sender
								ON sender.id = user_sender.id
							INNER JOIN ex_employees as receiver
								ON receiver.id = user_receiver.id';
			return parent::findAll($query);
		}

		public static function paginate($params = array()) {
			$query = 'SELECT tran.id, sender.name AS sender, receiver.name AS receiver, cur.name AS currency_type, tran.amount, tran.created_at
						FROM ex_transfer AS tran
							INNER JOIN ex_currencies AS cur
								ON cur.id = tran.cur_id
							INNER JOIN ex_users AS user_sender
								ON user_sender.id = tran.sender
							INNER JOIN ex_users AS user_receiver
								ON tran.receiver = user_receiver.id 
							INNER JOIN ex_employees AS sender
								ON sender.id = user_sender.id
							INNER JOIN ex_employees as receiver
								ON receiver.id = user_receiver.id LIMIT :limits OFFSET :offsets';
			$users = new Paginator('ex_transfer', true);
			return $users->pagination($query, $params);


		}

		// public static function find($id = array()) {
		// 	$query = 'SELECT * FROM ex_transfer WHERE id = :id';
		// 	return parent::findOne($query, $id);
		// }

		// public static function save($params = array()) {
		// 	$query = 'INSERT INTO ex_transfer(name, description) VALUES(:name, :description )';
		// 	parent::insert($query, $params);
		// }

		// public static function delete($ids = array()) {
		// 	$query = 'UPDATE ex_transfer SET is_delete = 1 WHERE id = :id';
		// 	parent::destroy($query, $ids);
		// }

		// public static function update($params = array()) {
		// 	$query = 'UPDATE ex_transfer SET name = :name, description = :description WHERE id = :id';
		// 	parent::edit($query, $params);
		// }

	}

 ?>