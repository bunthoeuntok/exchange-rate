<?php 
	require_once '../models/Sale.php';
	require_once '../core/Controller.php';

	$request = $_POST;

	$method = $request['method'];

	unset($request['method']);
	$data = $request;



	$user = new Controller();
	$status = $user->crud($method, new Sale(), $data);

	echo json_encode($status);
	// echo json_encode($data);


 ?>