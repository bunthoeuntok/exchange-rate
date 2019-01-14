<?php 
	require_once 'Database.php';

	class Paginator extends Database {
		private $table_name;
		private $total_records;
		private $current_page;
		private $total_page;
		private $prep;
		private $next;
		private $bridge;

		public function __construct($table, $bridge = false) {
			$this->table_name = $table;
			$this->total_records = $this->get_total_record();
			if($bridge) {
				$this->bridge = '';
			} else {
				$this->bridge = ' WHERE is_delete = 0';
			}
		}

		public function get_total_record() {
			$total = parent::findAll('SELECT id  FROM '. $this->table_name .$this->bridge);
			return count($total);

		}

		public function pagination($query, $params = array()) {
			$limit = $params['limit'];
			$offset = ($params['page'] - 1) * $limit;
			$variables = array('limits' => $limit, 'offsets' => $offset);

			$this->total_records = $this->get_total_record();
			$this->current_page = $params['page'];
			$this->total_page = ceil($this->total_records / $limit);

			if($this->current_page <= 1)
				$this->prep = null;
			else
				$this->prep = $this->current_page - 1;

			if($this->current_page >= $this->total_page)
				$this->next = null;
			else
				$this->next = $this->current_page + 1;

			$data = parent::findPaginate($query, $variables);
			$pagin_info = array('total_pages' => $this->total_page,
								'total_records' => $this->total_records,
								'current_page' => $this->current_page,
								'next' => $this->next,
								'prep' => $this->prep);

			return array('data' => $data, 'meta' => $pagin_info);
		}
	}


	
 ?>