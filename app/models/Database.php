<?php 

	class Database {
		private static $hostname = '127.0.0.1';
		private static $dbname = 'money_exchange';
		private static $username = 'root';
		private static $password = '';

		// Connect to database
		private static function connect() {
			$conn = new PDO("mysql:host=".self::$hostname.";dbname=".self::$dbname.";charset=utf8", self::$username, self::$password);
    		// set the PDO error mode to exception
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
			return $conn;
			
		}

		protected static function findAll($query) {
		
				$statement = self::connect()->prepare($query);
				$statement->execute();
				$data = $statement->fetchAll();

				return $data;
			

		}
		protected static function findPaginate($query, $params = array()) {
		
				$statement = self::connect()->prepare($query);
				$statement->execute($params);
				$data = $statement->fetchAll();

				return $data;
			

		}



		protected static function findOne($query, $id = array()) {
			$statement = self::connect()->prepare($query);
			$statement->execute($id);
  
			$data = $statement->fetch();

			return $data;
		}

		protected static function insert($query, $params = array()) {
			try {
				$statement = self::connect()->prepare($query);
				$statement->execute($params);
			} catch (PDOException $exception) {
				return $exception->getMessage();
			}
		}

		protected static function edit($query, $params = array()) {
			try {
				$statement = self::connect()->prepare($query);
				$statement->execute($params);
			} catch (PDOException $exception) {
				return $exception->getMessage();
			}
		}

		protected static function destroy($query, $params = array()) {
			try {
				$statement = self::connect()->prepare($query);
				foreach ($params as $id) {
					$statement->execute(array('id' => $id));
				}

			} catch (PDOException $exception) {
				return $exception->getMessage();
			}
		}

	}

 ?>