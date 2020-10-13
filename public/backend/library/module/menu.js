$(document).ready(function(){

	var mytime;
	

    $('.menu_newest').checkboxall('newest');
    $('.menu_all').checkboxall('select_all');
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

	$('ul.tabs-2 li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs-2 li').removeClass('current');
		$('.tab-content-2').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

	$(document).on('keyup', '.search_article', function(){
		let _this = $(this);
		let val = _this.val();
		if(val.length > 2){
			let formUrl = 'ajax/menu/search_article';
			_this.siblings('.va-list-article').html(loading());
			clearTimeout(mytime);
			 mytime = setTimeout(function(){
				$.post(formUrl, {
					value : val
				},
				function(data){
					let json = JSON.parse(data);
					if(json != null){
						let title = json.title;
						let id = json.objectid;
						let name = json.canonical;

						_this.siblings('.va-list-article').html(render_search( title, name));
					}else{
						_this.siblings('.va-list-article').html('');
					}
				});	
			}, 500);
		}else{
			_this.siblings('.va-list-article').html('');
		}
	})

	$(document).on('click', '.va_select_checkbox', function(){
		event.preventDefault();
		let _this = $(this);
		if(_this.siblings().hasClass('va_select_all')){
			let _checkbox = [];	
			let _title = [];	
			_this.siblings('.va_select_all').find('input').each(function(i,e){
				if($(this).val() != 0  && $(this).prop('checked') == true){
					_checkbox.push($(this).val());
					_title.push($(this).attr('data-title'))
				}
			});
			console.log(_title);
			for (var i = 0; i <= _checkbox.length - 1; i++) {
				let navigation = navigation_render(_title[i], _checkbox[i]);
				$('.menu-list').append(navigation);
			}

			$('input[type="checkbox"]').prop('checked', false)

		} else if(_this.siblings().hasClass('va-list-article')){
			let _checkbox = [];	
			let _title = [];	
			_this.siblings('.va-list-article').find('input').each(function(i,e){
				if($(this).val() != 0  && $(this).prop('checked') == true){
					_checkbox.push($(this).val());
					_title.push($(this).attr('data-title'))
				}
			});
			console.log(_checkbox);
			for (var i = 0; i <= _checkbox.length - 1; i++) {
				let navigation = navigation_render(_title[i], _checkbox[i]);
				$('.menu-list').append(navigation);
			}

			$('input[type="checkbox"]').prop('checked', false)
		}
	})



	$(document).on('keyup', '.search_article_catalogue', function(){
		let _this = $(this);
		let val = _this.val();
		if(val.length > 2){
			let formUrl = 'ajax/menu/search_article_catalogue';
			_this.siblings('.va-list-article').html(loading());
			clearTimeout(mytime);
			mytime = setTimeout(function(){
				$.post(formUrl, {
					value : val
				},
				function(data){
					let json = JSON.parse(data);

					if(json != null){
						let title =[];
						let id =[];
						let name =[];
						if(json.length >= 2){
							_this.siblings('.va-list-article').html('');
							for (var i = 0; i <= 1; i++) {
								let title = json[i].title;	
								let id = json[i].objectid;	
								let name = json[i].canonical;

								_this.siblings('.va-list-article').append(render_search( title, name));
							}
						}else if(json.length == 1){
							_this.siblings('.va-list-article').html('');
							let title = json[0].title;	
							let id = json[0].objectid;	
							let name = json[0].canonical;

							_this.siblings('.va-list-article').append(render_search( title, name));
						}else{
							_this.siblings('.va-list-article').html('Không có dữ liệu trả về');
						}
					}else{
						_this.siblings('.va-list-article').html('');
					}
				});	
			}, 500);
		}else{
			_this.siblings('.va-list-article').html('');
		}
	})


	$(document).on('click' , '.va-collapse', function(){
		let _this = $(this);
		if(_this.hasClass('collapsed')){
			$('.va-collapse').siblings($('.fa')).addClass('va-arrow');
			_this.siblings($('.fa')).addClass('va-arrow');
		}else{
			$('.va-collapse').siblings($('.fa')).addClass('va-arrow');
			_this.siblings($('.fa')).removeClass('va-arrow')
		}
	})

	$(document).ready(function(){
        $('.input-group input').add($('.input-group textarea')).focus(function() {
            let _this = $(this);
            _this.parent().addClass('input-title-focus');
        })
        $('.input-group input').add($('.input-group textarea')).focusout(function() {
            let _this = $(this);
            _this.parent().removeClass('input-title-focus');
        })
    })

    $(document).ready(function(){
		var updateOutput = function (e) {
		var list = e.length 	? e : $(e.target),
			output = list.data('output');
			if (window.JSON) {
				let _this = $(this);
				let json = window.JSON.stringify(list.nestable('serialize'));
				let formUrl = 'ajax/menu/drag';
				let catalogueid = _this.attr('data-catalogueid');
				console.log(catalogueid);
				console.log(json);
				$.post(formUrl, {
					post: json,catalogueid:catalogueid},
					function(data){
						console.log(data);
					});
			} else {
				output.val('JSON browser support required for this demo.');
			}
		};
		
		 // activate Nestable for list 
		 $('.nestable2').nestable({
			 group: 1
		 }).on('change', updateOutput);
	});

	$(document).on('click', '.add-menu', function(){
		let navigation = navigation_render();
		$('.menu-list').append(navigation);
		$('.menu-list').find('.menu-notification').remove();
		
		return false;
	});
	
	$(document).on('click', '.delete-menu', function(){
		let _this = $(this);
		let node = _this.attr('data-node');
		if(typeof(node) != 'undefined' && node == 0){
			_this.parent().parent().parent().remove();
		}else{
			let formUrl = 'navigation/ajax/navigation/delete';
			let id = _this.attr('data-id');
			$.post(formUrl, {
				id: id},
				function(data){
					console.log(data);
				});
		}
		if($('.delete-menu').length <= 0){
			$('.menu-list').html('<div class="menu-notification" style="text-align:center;"><h4 style="font-weight:500;font-size:16px;color:#000">Danh sách liên kết này chưa có bất kì đường dẫn nào.</h4><p style="color:#555;margin-top:10px;">Hãy nhấn vào <span style="color:blue;">"Thêm đường dẫn"</span> để băt đầu thêm.</p></div>');
		}else{
			$('.menu-list').find('.menu-notification').remove();
		}
	});

	$('#add').click(function() {
        $('#insert').val("Insert");
        $('#insert_form')[0].reset();
    });


    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        let title_menu = $('#title_menu').val();
        let value_menu = $('#value_menu').val();
        if (title_menu == "") {
            alert("Vui lòng nhập vào trường Tiêu đề Menu!");
        } else if (value_menu == '') {
            alert("Vui lòng nhập vào trường Giá trị Menu!");
        } else {
            let form_URL = 'ajax/menu/add_menu';
        	$.post(form_URL, {
				title_menu : title_menu, value_menu: value_menu
			},
			function(data){
				$('#insert_form')[0].reset();
                $('#add_data_Modal').modal('hide');
                $('#add_data_Modal').find('.va-wrapper').remove();
                location.reload();
			});	
        }
    });

    $(document).on('click','.delete-all', function(){
		let id = [];
		$('.checkbox-item:checked').each(function(){
			let _this = $(this);
		 	id.push(_this.val());
		});

		if(id.length > 0){
			swal({
				title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
				text: 'Xóa các Danh mục Menu được chọn',
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Thực hiện!",
				cancelButtonText: "Hủy bỏ!",
				closeOnConfirm: false,
				closeOnCancel: false },
			function (isConfirm) {
				if (isConfirm) {
					var formURL = 'ajax/menu/delete_all';
					$.post(formURL, {
						id: id,},
						function(data){
							if(data == 0){
									sweet_error_alert('Có vấn đề xảy ra','Vui lòng thử lại')
								}else{
									for(let i = 0; i < id.length; i++){
										$('#post-'+id[i]).hide().remove()				
									}
									swal("Xóa thành công!", "Các bản ghi đã được xóa khỏi danh sách.", "success");
								}
						});
				} else {
					swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
				}
			});
		}
		else{
			sweet_error_alert('Thông báo từ hệ thống!', 'Bạn phải chọn 1 bản ghi để thực hiện chức năng này');
			return false;
		}
		return false;
	});

	$(document).on('click','.menu-delete', function(){
		let _this = $(this);
		let id = _this.attr('data-id');

		if(id.length > 0){
			swal({
				title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
				text: 'Xóa các Danh mục Menu được chọn',
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Thực hiện!",
				cancelButtonText: "Hủy bỏ!",
				closeOnConfirm: false,
				closeOnCancel: false },
			function (isConfirm) {
				if (isConfirm) {
					var formURL = 'ajax/menu/delete';
					$.post(formURL, {
						id: id,},
						function(data){
							if(data == 0){
									sweet_error_alert('Có vấn đề xảy ra','Vui lòng thử lại')
								}else{
									for(let i = 0; i < id.length; i++){
										$('#post-'+id[i]).hide().remove()				
									}
									swal("Xóa thành công!", "Các bản ghi đã được xóa khỏi danh sách.", "success");
								}
						});
				} else {
					swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
				}
			});
		}
		else{
			sweet_error_alert('Thông báo từ hệ thống!', 'Bạn phải chọn 1 bản ghi để thực hiện chức năng này');
			return false;
		}
		return false;
	});
})


 function navigation_render(name= '', canonical = '', order = 0){
	let html = '';
	html = html + '<div class="row mb15">';
		html = html + '<div class="col-lg-4">';
			html = html + '<div class="form-row">';	
				html = html + '<input type="text" placeholder="" value="'+name+'" name="menu[title][]" class="form-control" >';
			html = html + '</div>';
		html = html + '</div>';
		html = html + '<div class="col-lg-4">';
			html = html + '<div class="form-row">';
				html = html + '<input type="text" placeholder="" value="'+canonical+'" name="menu[link][]" class="form-control" >';
				
			html = html + '</div>';
		html = html + '</div>';
		html = html + '<div class="col-lg-2">';
			html = html + '<div class="form-row">';
				html = html + '<input type="text" value="'+order+'" style="text-align:right;" name="menu[order][]" class="form-control" >';
			html = html + '</div>';
		html = html + '</div>';
		html = html + '<div class="col-lg-2">';
			html = html + '<div class="form-row" style="text-align:right;margin-top:10px;">';
				html = html + '<a class="delete-menu image img-scaledown" data-node="0" style="height:12px;"><img src="/public/backend/img/close.png" /></a>';
			html = html + '</div>';
		html = html + '</div>';
	html = html + '</div>';
	return html;
} 


function render_search(title = '', canonical = ''){
	let html = '';
	html = html + '<div class="va-render-search mb10">';
		html = html + '<div class="uk-flex">';
		    html = html + '<input type="checkbox" name="check['+canonical+']" id="_'+canonical+'" value="'+canonical+'" data-title="'+title+'" > ';
		    html = html + '<label for="_'+canonical+'" class="ml15 va-checkbox">'+title+'</label>';
		html = html + '</div>';
	html = html + '</div>';
	return html;
} 