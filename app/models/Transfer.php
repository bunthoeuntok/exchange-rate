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
					$query = 'SELECT tran.id as no, sender.name as sender, receiver.name as receiver, cur.name as currency, tran.amount, tran.created_at
							FROM ex_transfer as tran
						    INNER JOIN ex_currencies as cur
						    	ON tran.cur_id = cur.id
						    INNER JOIN ex_users as user_sender
						    	ON tran.sender = user_sender.id
						    INNER JOIN ex_employees as sender
						    	ON user_sender.emp_id = sender.id
						    INNER JOIN ex_users as user_rec
						    	ON tran.receiver = user_rec.id
						    INNER JOIN ex_employees as receiver
						    	ON user_rec.emp_id = receiver.id LIMIT :limits OFFSET :offsets';
			$transfer = new Paginator('ex_transfer', true);
			return $transfer->pagination($query, $params);
		}

		public static function option() {
			session_start();
			$query = 'SELECT user.id, emp.name FROM ex_users as user INNER JOIN ex_employees AS emp ON user.emp_id = emp.id WHERE user.id <>' .$_SESSION['user']->id;

			return parent::findAll($query);
		}

		// public static function find($id = array()) {
		// 	$query = 'SELECT * FROM ex_transfer WHERE id = :id';
		// 	return parent::findOne($query, $id);
		// }

		public static function save($params = array()) {
			$query = 'INSERT INTO ex_transfer(sender, receiver, cur_id, amount) VALUES(:sender, :receiver, :cur_id, :amount)';
			parent::insert($query, $params);
		}

		// 

		// public static function update($params = array()) {
		// 	$query = 'UPDATE ex_transfer SET name = :name, description = :description WHERE id = :id';
		// 	parent::edit($query, $params);
		// }

	}

 ?>