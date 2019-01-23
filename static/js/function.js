// function ajax_get(url, position,  type = 'all', id = '') {
// 	$.ajax({
// 		url: url,
// 		type: 'post',
// 		data: {'method': type, 'id': id},
// 		success: function(respone) {
// 			if(type == 'all')
// 				__create_table(respone, position);
// 			else 
// 				__map_form(respone, position);
// 		}	
// 	})
// }

function find_all(url, position) {
	var data = {
		'method': 'all'
	};
	$.ajax({
		url: url,
		type: 'post',
		data: data,
		success: function(respone) {
			var object = JSON.parse(respone);
			__create_table(object, position);
		}	
	})
}

function option(url, position, position_two = 'none') {
	var data = {
		method: 'option'
	}
	$.ajax({
		url: url,
		type: 'post',
		data: data,
		success: function(respone) {
			var object = JSON.parse(respone);
			__create_option(object, position, position_two);
		}	
	})
}

function paginate(url, position, page = 1, limit = 15) {
	var data = {
		'method': 'pagin',
		'limit': limit,
		'page': page
	};
	$.ajax({
		url: url,
		type: 'post',
		data: data,
		success: function(respone) {
			var object = JSON.parse(respone);
			__create_table(object['data'], position);
			__create_pagination(object['meta']);
		}	
	})
}

function find_one(url, position, id) {
	var data = {
		'method': 'find',
		'id': id
	};

	$.ajax({
		url: url,
		type: 'post',
		data: data,
		success: function(respone) {
			var object = JSON.parse(respone);
			__map_form(object, position);
		}	
	})
}

function action(form, type, callback) {
	var url = form.attr('action'),
		data = {
			'method': type
		};

	form.find('[name]').each(function() {
		data[$(this).attr('name')] = $(this).val();
	});

	$.when($.ajax({
		url: url,
		type: 'post',
		data: data,

		success: function(respone) {
			closefunction()
		}
	})).done(function() {
		callback();
	})
}

function deletes(url, data, callback) {
	$.when($.ajax({
		url: url,
		type: 'post',
		data: {method: 'delete', ids: data},	
		success: function(respone) {
			closefunction();
		}
	})).done(function() {
		callback();
	})

}

function form_submit(form, callback) {
	var id = form.find('[name="id"]').val();
	if(id == '') 
		action(form, 'post', callback);
	else 
		action(form, 'put', callback);
}

function login(url, username, password) {
	var data = {
		'method': 'login',
		'username': username,
		'password': password
	};

	$.ajax({
		url: url,
		type: 'post',
		data: data,
		success: function(respone) {
			if(respone == "false") {
		        M.toast({
		            html: '<i class="material-icons left">error</i><span>The username or password you entered is incorrect.</span>',
		            classes: 'red',
		            displayLength: 1000
		        })
			} else {
				var user = JSON.parse(respone);
				if(user.role_id == 1) 
					window.location.href = 'dashboard.php';
				else
					window.location.href = 'sale.php';
			}
		}	
	});
}

function __map_form(json, form) {
	form.find('[name]').each(function(index, value) {
		$(this).val(json[$(this).attr('name')]);
	});
	$('select').formSelect();
}

function __create_option(json, position, position_two) {
	var options = '';
	if(json.length <= 0) {
		options = '<option>No employee to create users</option>';
	} else {
		json.forEach(function(item) {
			options += '<option value="'+ item.id +'">'+ item.name +'</option>';
		})
	}
	position.html(options);
	if(position_two != 'none')
		position_two.html(options)
	$('select').formSelect();
}

function __create_pagination(pagin) {
	if(pagin['total_pages'] == 0)
		return;
	var toolbar_footer = $('<section class="toolbar-footer">');
	var div = $('<div>');
	var div_info = $('<div>');
	var ul = $('<ul class="pagination">');

	// ul.append('<li><a href="#!">First</a></li>');
	if(pagin['prep'] == null) {
		ul.append('<li class="disabled"><a class="disabled not-active"><i class="material-icons white-text">chevron_left</i></a></li>');
	} else {
		ul.append('<li><a href="#" data-page="'+ parseInt(pagin['current_page'] - 1) +'"><i class="material-icons">chevron_left</i></a></li>');
	}
	if(pagin['total_pages'] <= 7) {
		for(var i = 1; i <= pagin['total_pages']; i++) {
			ul.append('<li class="waves-effect"><a data-page="'+i+'">'+ i +'</a></li>');
		}
	} else {
		if(pagin['current_page'] <= 5) {
			for(var i = 1; i <= 5; i++) {
				ul.append('<li class="waves-effect"><a data-page="'+i+'">'+ i +'</a></li>');
			}
			ul.append('<li class="waves-effect"><a class="not-active">...</a></li>');
			ul.append('<li class="waves-effect"><a data-page="'+pagin['total_pages']+'">'+ pagin['total_pages'] +'</a></li>');
		} else if(pagin['current_page'] >= pagin['total_pages'] - 4) {
			ul.append('<li class="waves-effect"><a data-page="1">1</a></li>');
			ul.append('<li class="waves-effect"><a class="not-active">...</a></li>');
			for(var i = pagin['total_pages'] - 4; i<= pagin['total_pages']; i++) {
				ul.append('<li class="waves-effect"><a data-page="'+i+'">'+ i +'</a></li>');
			}
		} else {
			ul.append('<li class="waves-effect"><a data-page="1">1</a></li>');
			ul.append('<li class="waves-effect"><a class="not-active">...</a></li>');
			for(var i = pagin['current_page'] - 1; i <= parseInt(pagin['current_page']) + 1; i++) {
				ul.append('<li class="waves-effect"><a data-page="'+i+'">'+ i +'</a></li>');
			}
			ul.append('<li class="waves-effect"><a class="not-active">...</a></li>');
			ul.append('<li class="waves-effect"><a data-page="'+pagin['total_pages']+'">'+ pagin['total_pages'] +'</a></li>');

		}
	}

	if(pagin['next'] == null) {
		ul.append('<li class="disabled"><a class="disabled not-active" href="#"><i class="material-icons white-text">chevron_right</i></a></li>');
	} else {
		ul.append('<li><a href="#" data-page="'+ (parseInt(pagin['current_page']) + 1) +'"><i class="material-icons">chevron_right</i></a></li>');
	}
	// ul.append('<li><a>Last</a></li>');
	div.append(ul);

	toolbar_footer.append(div);
	div_info.append('<strong style="font-size: 14px; color: #fff">Page '+pagin['current_page'] 
						+ ' of '+ pagin['total_pages'] + ' // ' + pagin['total_records'] + ' rocord(s)' +'<strong>');
	toolbar_footer.append(div_info);

	$('.fixed-footer').html(toolbar_footer);


	// <section class="toolbar-footer">
 //       <!--  <div>
 //            <ul class="pagination">
 //                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
 //                <li class="active"><a href="#!">1</a></li>
 //                <li class="waves-effect"><a>2</a></li>
 //                <li class="waves-effect"><a>3</a></li>
 //                <li class="waves-effect"><a>4</a></li>
 //                <li class="waves-effect"><a>5</a></li>
 //                <li class="waves-effect"><a><i class="material-icons">chevron_right</i></a></li>
 //            </ul>
 //        </div>
 //        <div>
 //            <strong style="font-size: 14px">page 1 of 10 /// 200 record(s)</strong>
 //        </div> -->
 //    </section>
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatDate(date) {
  var monthNames = [
    "Jan", "Feb", "Mar",
    "Apr", "May", "Jun", "Jul",
    "Aug", "Sep", "Oct",
    "Nov", "Dec"
  ];

  var day = ('0' + date.getDate()).slice(-2);
  var monthIndex = date.getMonth();
  var year = date.getFullYear();
  var hour = date.getHours();

  return day + '-' + monthNames[monthIndex] + '-' + year;
}

function formatDateTime(date) {
	if(isNaN(date.getDate())) {
		date = new Date();
	}
  var dateFormat = formatDate(date);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return dateFormat + ' ' + strTime;
}

function __create_table(records, position) {
    var table = $('<table id="myTable" class="table">');
    var thead = $('<thead>');
    var tbody = $('<tbody>');
    var tr_head = $('<tr>');

    if(records.length == 0) {
    	position.html(`<div style="display: flex; flex-direction: column; justify-content: center ;margin-top: 150px; align-items: center">
    						<div style="width: 100%; max-width: 500px;">
    							<img class="responsive-img" src="static/images/icons/documents-empty.png" />
    						</div>
    						<div>
    							<button class="btn" style="width: 150px; margin-top: 20px">GO BACK</button>
    						</div>
    					</div>`)
    	return;
    }
    // Table header
    var sample = records[0];

    Object.keys(sample).forEach((key) => {
    	var th = $('<th>');
    	if(key == 'id'){
    		th.append(`<p class="mp">
                        <label>
                            <input type="checkbox" class="filled-in filled-in-weith" id="check-action"/>
                            <span>&nbsp;</span>
                        </label>
                    </p>
                    `);
    		th.attr('width', '100')
    	} else if(key == 'no') {
    		th.append(`<span style="padding-left: 20px;">No</span>`);
    	}
    	else
    		th.append(key.replace('_', ' ').toUpperCase());

    	tr_head.append(th);
    });
    thead.append(tr_head);
    table.append(thead);
    var no = 1;
    for(var row in records) {
    	var tr_body = $('<tr>');
    	Object.keys(sample).forEach((key) => {
    		var td = $('<td>');
    		if(key === 'id')
    			td.append(`<p class="mp">
                        <label>
                            <input type="checkbox" class="filled-in check-action" value="${records[row][key]}"/>
                            <span>&nbsp;</span>
                        </label>
                    </p>`);
    		else if(key == 'birth_date' || key == 'hired_date') {
    			td.append(formatDate(new Date(records[row][key])));
    		} else if(key == 'last_update' || key == 'created_at') {
    			td.append(formatDateTime(new Date(records[row][key])));
    		} else if(key == 'no') {
    			td.append(`<span style="padding-left: 20px">${no++}</span>`)
    		}else if(key == 'amount'){
    			td.append(numberWithCommas(records[row][key]));
    		}
    		 else {
    			td.append(records[row][key]);
    		}
 
    		tr_body.append(td);	
    	});
    	tbody.append(tr_body);
    }

    table.append(tbody);

   	position.html(table);
    
}

