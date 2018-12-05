<?php 
require_once 'Database.php';

	class Page extends Database {

		public static function all() {
			$query = 'SELECT id, name, url, icon, class_name FROM ex_pages ORDER BY order_by';
			return parent::findAll($query);
		}
	}
?>