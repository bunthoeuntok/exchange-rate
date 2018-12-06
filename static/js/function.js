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
			__create_table(respone, position);
		}	
	})
}

function paginate(url, position, limit = 20, page = 1) {
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
			$('.modal').css('display','none')
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

function __map_form(json, form) {
	form.find('[name]').each(function(index, value) {
		$(this).val(json[$(this).attr('name')]);
	});
}

function __create_pagination(pagin) {
	var toolbar_footer = $('<section class="toolbar-footer">');
	var div = $('<div>');
	var div_info = $('<div>');
	var ul = $('<ul class="pagination">');

	ul.append('<li><a href="#!">First</a></li>');
	ul.append('<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>');
	ul.append('<li class="active"><a href="#!">'+ pagin['current_page'] +'</a></li>');
	ul.append('<li class="waves-effect"><a><i class="material-icons">chevron_right</i></a></li>');
	ul.append('<li><a href="#!">Last</a></li>');
	div.append(ul);

	toolbar_footer.append(div);
	div_info.append('<strong style="font-size: 14px">Page '+pagin['current_page'] 
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

function __create_table(records, position) {
    var table = $('<table class="table">');
    var thead = $('<thead>');
    var tbody = $('<tbody>');
    var tr_head = $('<tr>');

    if(records.length == 0) {
    	position.html('No record found.')
    	return;
    }
    // Table header
    var sample = records[0];

    Object.keys(sample).forEach((key) => {
    	var th = $('<th>');
    	if(key == 'id'){
    		th.append(`<p class="mp">
                        <label>
                            <input type="checkbox" class="filled-in" id="check-action"/>
                            <span>&nbsp;</span>
                        </label>
                    </p>`);
    		th.attr('width', '100')
    	}
    	else
    		th.append(key.toUpperCase());

    	tr_head.append(th);
    });

    thead.append(tr_head);
    table.append(thead);

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
    		else
    			td.append(records[row][key]);
 
    		tr_body.append(td);	
    	});
    	tbody.append(tr_body);
    }

    table.append(tbody);

   	position.html(table);
    
}