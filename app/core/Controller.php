<?php 
	class Controller {
		
		public function crud($method, $model, $data = array()) {
			// Find all records in database
			if($method == 'all') {
				return $model->all();
			} 

			else if($method == 'pagin'){
				return $model->paginate($data);
			}

			// Find one record with id
			else if($method == 'find') {
				return $model->find($data);
			}

			// Insert data to database
			else if($method == 'post') {
				unset($data['id']);

				$model->save($data);

			}

			// Update records from database
			else if($method == 'put') {
				$model->update($data);
			}

			// Delete records from database
			else if($method =='delete') {
				$ids = $data['ids'];
				$ids = explode(' ', $ids);

				$model->delete($ids);
			}
			
		}
	}
 ?>