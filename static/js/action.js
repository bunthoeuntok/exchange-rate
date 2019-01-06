$(document).ready(function() {
	$('body').on('click', '.toolbar-footer li a', function() {
		var page = $(this).attr('data-page');
		paginate('app/controllers/EmployeeController.php', $('#content'), page);
	})

})