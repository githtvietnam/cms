var count = 0;
if(attribute_cat != ''){
	attribute_cat = JSON.parse(attribute_cat)
}

// Run on web load

$(document).ready(function(){
    $('.tagsinput').tagsinput({
        tagClass: 'label label-primary',
        confirmKeys: [13, 188],
        cancelConfirmKeysOnEmpty: false,
    });

    selectMultipe($('.selectAttribute'));


    if($('.selectAttribute').length){
    	$('.selectAttribute').each(function(){
    		let _this = $(this);
    		let index = _this.parents('tr').find('td:first').attr('data-index');
    		let data = eval('get_data' + index);
    		getDataMultiple(_this, data);
    	})
    }
});

$(document).ready(function(){
	WinMove();
});

// ===================================================== JQuery Gia ban buon chuyen du lich ==============================================================


$(document).on('click','.btn_wholesale',function(){
	let _this = $(this);
	let wholesale = [];
	let accept = false;
	let dem = $('.wholesale_desc').length;

	if(dem == 0){
		$('.wholesale_more').append(render_wholesale(dem + 1, 1));
	}else{
		$('.number_start, .number_end').each(function () {
			if($(this).val() == ''){
				accept = false;
			}else{
				accept = true;
			}
		})
		if(accept == false){
			toastr.options.closeButton = true;
		    toastr.options.preventDuplicates = true;
		    toastr.options.progressBar = true;
		    toastr.warning('Bạn vui lòng nhập vào 2 trường số lượng để tiếp tục!','Xảy ra lỗi!');
			return false;
		}else{
			let before_end = parseInt($('#numberend_'+(dem)+'').val());
			$('.wholesale_more').append(render_wholesale(dem + 1));
			$('#numberstart_'+(dem+1)).val(before_end + 1);
		}
	}
	return false;
})

$(document).on('click','.wholesale_del',function(){
	let _this = $(this);
	_this.parents('.wholesale_desc').remove();
	return false;
})

$(document).on('change','.number_end',function(){
	let _this = $(this);
	let start = _this.parents('.wholesale_desc').find('.number_start').val();
	let id = _this.attr('id')
	id = id.split("_")
	id[1] = parseInt(id[1])
	let end = parseInt(_this.val())
	if(end <= start){
		_this.val('');
	}
	if($('#numberstart_'+(id[1]+1)+'').length != 0){
		$('#numberstart_'+(id[1]+1)+'').val(end + 1);
	}
	return false;
})

$(document).on('click','.add-attr',function(){
	let _this = $(this);
	count++;
	render_attr();
})


$(document).on('click','.del_img_modal',function(){
    let _this = $(this);
    let id = _this.attr('data-id');
    console.log(id)
	let data = [];
    $(id).find('img').each(function(){
    	data.push($(this).attr('src'));
    })
    let text = '';
    for (var i = 0; i < data.length; i++) {
    	if(i == 0){
    		text = '["'+data[i]+'"'+((i+1 == data.length) ? ']' : ',');
    	}
    	if(i >= 1){
    		text = text + '"'+ data[i] + '"'+((i+1 == data.length) ? ']' : ',');
    	}
    }
    $(id).find('.input_img_version').val(text)
    if(text == ''){
    	$(id).find('.click-to-upload').show()
    }
})


// ===================================================== JQuery phien ban chuyen du lich =================================================================

$('#render_input_version').on("submit", function(event) {
    event.preventDefault();
    let _this = $(this)
    let id = _this.attr('data-id');
   
    let form_URL = 'ajax/tour/render_input_version';
	$.post(form_URL, {
		id : id
	},
	function(data){
		let json = JSON.parse(data);
		console.log(json)
		$(id).find('.barcode_version').val(json.barcode)
		$(id).find('.model_version').val(json.model)
		$('#openModalDetail').modal('hide');
	});	
});

$(document).on('click','.tour_edit', function(){
	$('#openModalDetail .upload-list ul li').remove()
	let _this = $(this);
	let id = _this.attr('data-id');
	let barcode = _this.parents('tr').find('.barcode_version').val();
	let model = _this.parents('tr').find('.model_version').val();
	let img = _this.parents('tr').find('.input_img_version').val();
	let form_URL = 'ajax/tour/render_data_detail';
	$.post(form_URL, {
		id : id, barcode: barcode, model: model, img: img
	},
	function(data){
		let json = JSON.parse(data);
		$('.modal_barcode_version').val(json.barcode);
		$('.modal_model_version').val(json.model);
		$('.modal_version .submit_version').attr('data-id', json.id)
		$('.modal_version .upload-picture').attr('data-id', json.id)
		if(json.img != [] && json.img != undefined){
			let render_img = JSON.parse(json.img)
			
			for(var i = 0 ; i < render_img.length; i++){
            fileUrl =  render_img[i];
            let li = '';
            li = li + '<li class="ui-state-default">';
                li = li + '<div class="thumb">';
                    li = li + '<span class="image img-scaledown">';
                        li = li + '<img src="'+fileUrl+'" alt="">'; 
                        li = li + '<input type="hidden" value="'+fileUrl+'" name="album[]">';
                    li = li + '</span>';
                    li = li + '<div class="overlay"></div><div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>';
                li = li + '</div>';
            li = li + '</li>';

			$('#openModalDetail .click-to-upload').hide();
        	$('#openModalDetail .upload-list ul').append(li);
            $('#openModalDetail .upload-list').show();
	        }
		}else{
			$('#openModalDetail .click-to-upload').show();
            $('#openModalDetail .upload-list').hide();
		}
	})
});	


$(document).on('click','.block-attribute input[name="checkbox[]"]', function(){
	let val = $(this).parents('td').find('input[name="checkbox_val[]"]').val();
	if(val==1){
	    $(this).parents('td').find('input[name="checkbox_val[]"]').val(0);
	}else{
	    $(this).parents('td').find('input[name="checkbox_val[]"]').val(1);
	}
});

$(document).on('change','.input_img_version', function(){
	console.log(1)
});

$(document).on('change','.block-attribute input[name="checkbox[]"]', function(){
    let check = $('input[name="checkbox[]"]:checked').length;
    let data = [];
	if(check > 3){
		toastr.warning('Chọn nhiều nhất 3 thuộc tính của phiên bản!','');
		$(this).prop('checked', false);
		$(this).parents('td').html('<input type="checkbox" name="checkbox[]" value="" class="checkbox-item"><div for="" class="label-checkboxitem"></div>');
	}else{
		$('.select_attribute tr input[name="checkbox[]"]:checked').each(function(){
			data.push($(this).parents('tr').find('.trigger-select2').val())
		})
		JSON.stringify(data)
		$('.checked_value').val(data)
	}
	get_vesion()
});

$(document).on('keyup','.bootstrap-tagsinput input', function(){
	get_vesion()
});

$(document).on('click','[data-role=remove]', function(){
	console.log(1)
	get_vesion()
});


$(document).on('change','.selectAttribute', function(){
	get_vesion()
});

$(document).on('click','.version_setting', function(){

	let _this = $(this);
	_this.parents('.block-version').find('.ibox-content').show();
	_this.parents('.block-version').find('.show_attribute').append(render_attribute(attribute_cat));
	check_attribute();
	$('.trigger-select2').each(function(key, index){
		$('.trigger-select2').select2();
	});
	$countAttr = $('.block-attribute table tbody').find('tr').length;
	$countCat = attribute_cat.length;
	if(parseInt($countAttr) >= 1){
		$('.version_setting').hide()
	}else{
		$('.version_setting').show()
	}
	return false;
});

$(document).on('click','.add_version', function(){
	let _this = $(this);
	_this.parents('.block-version').find('.ibox-content').show();
	_this.parents('.block-version').find('.show_attribute').append(render_attribute(attribute_cat));
	check_attribute();
	$('.trigger-select2').each(function(key, index){
		$('.trigger-select2').select2();
	});
	$countAttr = $('.block-attribute table tbody').find('tr').length;
	$countCat = attribute_cat.length;
	if(parseInt($countAttr) >= $countCat){
		$('.add_version').hide()
	}else{
		$('.add_version').show()
	}
	return false;
});

$(document).on('change','select[name="attribute_catalogue[]"]', function(){
	let _this = $(this);
	check_attribute(_this);
	let catalogueid = _this.val();
	let index = _this.parents('tr').find('td:first').attr('data-index');
	if(catalogueid == 'root'){
		_this.parents('tr').find('td:eq(2)').html('<input type="text" disabled class="input_disable">');
	}else if(catalogueid == 'color'){
		_this.parents('tr').find('td:eq(2)').html(render_color(index));
	}else{
		_this.parents('tr').find('td:eq(2)').html(render_select2(catalogueid, ' AND catalogueid = '+catalogueid, index));
	}

	$('.selectAttribute').each(function(key, index){
		selectMultipe($(this));
	});

	$('.tagsinput').tagsinput({
        tagClass: 'label label-primary',
        confirmKeys: [13, 188],
        cancelConfirmKeysOnEmpty: false,
    });
});



$(document).on('click','.block-attribute .delete-attribute', function(){
	let _this = $(this);
    let data = [];
	_this.parents('tr').remove();
	let val= _this.parents('tr').find('select[name="attribute_catalogue[]"] option:checked').val();
	$('.block-attribute select[name="attribute_catalogue[]"]').find("option[value="+val+ "]").prop('disabled',false);
	$('.block-attribute select[name="attribute_catalogue[]"]').select2("destroy").select2();
	get_vesion();
	check_attribute();
	let pos = attribute_catalogue.indexOf(val);
	attribute_catalogue.splice(pos, 1);
	$countAttr = $('.block-attribute table tbody').find('tr').length;
	console.log($countAttr)
	$countCat = attribute_cat.length;
	if(parseInt($countAttr) >= $countCat){
		$('.add_version').hide()
	}else if(parseInt($countAttr) == 0){
		$('.version_setting').show()
		$('.block-version .ibox-content').hide();
	}else{
		$('.add_version').show()
	}

	$('.select_attribute tr input[name="checkbox[]"]:checked').each(function(){
		data.push($(this).parents('tr').find('.trigger-select2').val())
	})
	JSON.stringify(data)
	$('.checked_value').val(data)
	
});


// ===================================================== JQuery Thao tac chuyen du lich ==============================================================


$(document).on('click','.delete-all', function(){
	let id = [];
	let _this = $(this);
	$('.checkbox-item:checked').each(function(){
		let _this = $(this);
	 	id.push(_this.val());
	});

	if(id.length > 0){
		swal({
			title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
			text: 'Xóa các Chuyến du lịch được chọn',
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Thực hiện!",
			cancelButtonText: "Hủy bỏ!",
			closeOnConfirm: false,
			closeOnCancel: false },
		function (isConfirm) {
			if (isConfirm) {
				var formURL = 'ajax/tour/delete_all';
				$.post(formURL, {
					id: id, module: _this.attr('data-module')},
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


$(document).on('click','.delete-attr',function(){
	let _this = $(this);
	_this.parents('.desc-more').remove();
	
});

$(document).on('change','#toogle_readonly',function(){
	let _this = $(this);
	let attr = $('.tourid').attr('name');
	if(_this.is(':checked') && typeof attr !== typeof undefined && attr !== false){
		$('.tourid').removeAttr('readonly');
	}else{
		$('.tourid').attr('readonly', true);
	}
});

$(document).on('change','#id_auto',function(){
	let _this = $(this);
	let title = $('#title').val();
	let result = title.split(' ');	
	let count = result.length;
	let text = '';
	let i = 0;
	for(i = 0; i < count; i++){
		let char = result[i].charAt(0);
		text = text + char;
	}
	text = text+'-001';
	if($('#id_auto').is(':checked')){
		$('.tourid').val(text)
	}else{
		$('.tourid').val(tourid)
	}
});

$(document).on('keyup','#title',function(){
	let _this = $(this);
	let val = _this.val();
	let result = val.split(' ');	
	let count = result.length;
	let text = '';
	let i = 0;
	for(i = 0; i < count; i++){
		let char = result[i].charAt(0);
		text = text + char;
	}
	text = text+'-001';

	if($('#id_auto').is(':checked')){
		$('.tourid').val(text)
	}else{
		$('.tourid').val(tourid)
	}
});

$(document).on('keyup','#brand_title',function(){
	let _this = $(this);
	let val = _this.val();
	val = slug(val)
	$('#brand_canonical').val(val);
});

$('#insert_form').on("submit", function(event) {
    event.preventDefault();
    let title = $('#brand_title').val();
    let canonical = $('#brand_canonical').val();
    let keyword = $('#keyword').val();
    let img = $('#brand_img').val();
    if (title == "") {
        alert("Vui lòng nhập vào trường Tiêu đề Thương hiệu!");
    } else if (keyword == '') {
        alert("Vui lòng nhập vào trường Giá trị Nhãn hiệu!");
    } else {
        let form_URL = 'ajax/tour/add_brand';
    	$.post(form_URL, {
			title : title, canonical: canonical, keyword: keyword, img: img
		},
		function(data){
			let json = JSON.parse(data);
			$('#insert_form')[0].reset();
            $('#tour_add_brand .brand-avatar img').attr('src', 'public/not-found.png');
            $('#tour_add_brand').modal('hide');
            $('.brand_select').append('<option value=' + json.value + '>' + json.title + '</option>')
		});	
    }
});

$('#attribute_form').on("submit", function(event) {
    event.preventDefault();
    let title = $('#modal_attribute_title').val();
    let val = $('.catalogueid_modal').val();
    if (title == "") {
        alert("Vui lòng nhập vào trường Tiêu đề Thuộc tính!");
    } else if (val == 'root') {
        alert("Vui lòng chọn nhóm thuộc tính!");
    } else {
        let form_URL = 'ajax/tour/add_attribute';
    	$.post(form_URL, {
			title : title, val: val
		},
		function(data){
			let json = JSON.parse(data);
			if(json == 1){
				toastr.options.closeButton = true;
			    toastr.options.preventDuplicates = true;
			    toastr.options.progressBar = true;
			    toastr.warning('Thuộc tính bạn tạo đã tồn tại!','Xin vui lòng thử lại!');
			}
            $('.catalogueid_modal').val('root').trigger('change');
			$('#attribute_form')[0].reset();
            $('#tour_add_attribute').modal('hide');
		});	
    }
});


$(document).on('click' ,'.update_price' ,function(){
	let _this = $(this);
	$('.index_update_price').hide();
	$('.view_price').show();


	_this.find('.view_price').hide();
	_this.find('input').show();
})

$(document).on('change' ,'.index_update_price' ,function(){
	let _this = $(this);
	let val = _this.val();
	let id = _this.attr('data-id')
	let field = _this.attr('data-field')
	let form_URL = 'ajax/tour/update_price';
	$.post(form_URL, {
		val : val, id: id, field: field
	},
	function(data){
		let json = JSON.parse(data);
		_this.hide();
		_this.siblings('.view_price').show();
		_this.siblings('.view_price').html(json.val);
	});	
})

function check_attribute(_this=''){
	attribute_catalogue = new Array();
	$('.block-attribute select[name="attribute_catalogue[]"]').each(function() {
		let val = $(this).find('option:selected').val();
		if(val != 0){
			attribute_catalogue.push(val);
		}
	});
	$('.block-attribute select[name="attribute_catalogue[]"]').find("option").removeAttr("disabled");
	for(let i = 0; i < attribute_catalogue.length; i++) {
		$('.block-attribute select[name="attribute_catalogue[]"]').find("option[value="+ attribute_catalogue[i] + "]").prop('disabled', !$('#one').prop('disabled'));
    	$('.block-attribute select[name="attribute_catalogue[]"]').select2();
    }
	$('.block-attribute select[name="attribute_catalogue[]"]').find("option:selected").removeAttr("disabled");
	
}

function render_attr(){
	let html ='';
	var id = 'title_' + count;

	html = html + '<div class="ibox desc-more" style="opacity: 1;">';
        html = html + '<div class="ibox-title ui-sortable-handle">';
        	html = html + '<div class="uk-flex uk-flex-middle">';
                html = html + '<div class="col-lg-8">';
					html = html + '<input type="text" name="sub_content[title][]" class="form-control" value="" placeholder="Tiêu đề">';
				html = html + '</div>';
				html = html + '<div class="col-lg-4">';
					html = html + '<div class="uk-flex uk-flex-middle uk-flex-space-between">';
						html = html + '<a href="" title="" data-target="'+id+'" class="uploadMultiImage">Upload hình ảnh</a>';
		                html = html + '<div class="ibox-tools">';
		                    html = html + '<a class="collapse-link ui-sortable">';
		                        html = html + '<i class="fa fa-chevron-up"></i>';
		                    html = html + '</a>';
		                    html = html + '<a class="close-link">';
		                        html = html + '<i class="fa fa-times"></i>';
		                    html = html + '</a>';
		                html = html + '</div>';
					html = html + '</div>';
				html = html + '</div>';
        		
        	html = html + '</div>';
        html = html + '</div>';
        html = html + '<div class="ibox-content" style="">';
        	html = html + '<div class="row">';
                html = html + '<div class="col-lg-12" >';
                	html = html + '<textarea name="sub_content[description][]" class="form-control ck-editor" id="'+id+'" placeholder="Mô tả"></textarea>';
				html = html + '</div>';
			html = html + '</div>	';
        html = html + '</div>';
    html = html + '</div>';

	$('.attr-more').prepend(html);
	ckeditor5(id);
}

function render_wholesale(dem = '', $number = ''){
	let html ='';
	html = html + '<div class="wholesale_desc mb15">';
		html = html + '<div class="uk-flex uk-flex-middle uk-flex-space-between">';
			html = html + '<div class="va-flex-row">';
				html = html + '<div class="form-row">';
					html = html + '<label class="control-label text-left">';
						html = html + '<span>Số lượng từ</span>';
					html = html + '</label>';
					html = html + '<input type="number" name="wholesale[number_start][]" value="'+$number+'" class="form-control number_start" placeholder="" id="numberstart_'+dem+'" autocomplete="off">';
				html = html + '</div>';
			html = html + '</div>';
			html = html + '<div class="va-flex-row">';
				html = html + '<label class="control-label ">';
					html = html + '<span>Đến</span>';
				html = html + '</label>';
				html = html + '<input type="number" name="wholesale[number_end][]" value="" class="form-control number_end" placeholder="" id="numberend_'+dem+'" autocomplete="off">';
			html = html + '</div>';
			html = html + '<div class="va-flex-row">';
				html = html + '<label class="control-label ">';
					html = html + '<span>Giá mới</span>';
				html = html + '</label>';
				html = html + '<input type="text" name="wholesale[wholesale_price][]" value="" class="form-control wholesale_price int price" placeholder="" id="wholesaleprice_'+dem+'" autocomplete="off">';
			html = html + '</div>';
			html = html + '<div class="va-flex-row">';
				html = html + '<a type="button" class="btn btn-default wholesale_del" ><i class="fa fa-trash"></i></a>';
			html = html + '</div>';
		html = html + '</div>';
	html = html + '</div>';
	return html;
}

function render_attribute(data = []){
	let index = $('.block-attribute tbody tr').length;
	let html ='';
	html = html + '<tr >';
		html = html + '<td data-index="'+index+'">';
			html = html + '<input type="checkbox" name="checkbox[]" class="checkbox-item">';
			html = html + '<input type="text" name="checkbox_val[]"  class="hidden">';
			html = html + '<div for="" class="label-checkboxitem"></div>';
		html = html + '</td>';
		html = html + '<td>';
			html = html + '<select name="attribute_catalogue[]" class="form-control select2 trigger-select2" style="width:100%" >';
				html = html + '<option value="root">-- Chọn thuộc tính --</option>';
				for (let i = 0; i < data.length; i++) {
					html = html + '<option value="'+data[i].value+'">'+data[i].title+'</option>';
				}
			html = html + '</select>';
		html = html + '</td>';
		html = html + '<td>';
			html = html + '<div class="form-row">';
				html = html + '<input type="text" disabled class="input_disable">';
			html = html + '</div>';
		html = html + '<td>';
			html = html + '<a type="button" class="btn btn-default delete-attribute" data-id=""><i class="fa fa-trash"></i></a>';
		html = html + '</td>';
	html = html + '</tr>';
	return html;
}

function render_color(index = ''){
	let html ='';
		html = html + '<input name="attribute['+index+'][]" class="tagsinput form-control" type="text" value=""/>'
	return html;
}

function render_version(title='', price ='',code='', attribute1='', attribute2='', attribute3=''){
	let html = '<tr id="'+code+'">';
		html = html + '<td>';
			html = html+'<input type="text" name="attribute1[]" value="'+attribute1+'" class="hidden">';
			html = html+'<input type="text" name="attribute2[]" value="'+attribute2+'" class="hidden">';
			html = html+'<input type="text" name="attribute3[]" value="'+attribute3+'" class="hidden">';
			html = html+'<input type="text" name="barcode_version[]"  value="" class="hidden barcode_version">';
			html = html+'<input type="text" name="model_version[]" value="" class="hidden model_version">';
			html = html + '<div class="img_version img-scaledown" style="cursor: pointer;">';
				html = html + '<img src="public/select-img.png" class="img_version_select" alt="" data-target="#'+code+'">';
			html = html + '</div>';
			html = html + '<input type="text" name="img_version[]" value="" class="form-control hide_img_version input_img_version" placeholder="Đường dẫn của ảnh" autocomplete="off" style="display:none;">';
		html = html + '</td>';
		html = html + '<td>';
			html = html + '<input type="text" name="title_version[]" readonly="" value="'+title+'" class="form-control" autocomplete="off">';
		html = html + '</td>';
		html = html + '<td>';
			html = html + '<input type="text" name="price_version[]" value="'+addCommas(price)+'" class="form-control int" autocomplete="off">';
		html = html + '</td>';
		html = html + '<td>';
			html = html + '<input type="text" name="code_version[]" value="'+code+'" class="form-control" autocomplete="off">';
		html = html + '</td>';
		html = html+'<td><button type="button" class=" tour_edit" data-toggle="modal" data-id="#'+code+'" data-target="#openModalDetail" >Chỉnh sửa</button></td>';
	html = html + '</tr>';
	return html;
}

function render_select2(catalogueid = '', condition = '' , index = ''){
	html = '<select name="attribute['+index+'][]" class="form-control selectAttribute" data-condition="'+condition+'" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm..." style="width: 100%;" data-join="attribute_translate" data-catalogueid="'+catalogueid+'" data-module="attribute" data-select="title"></select>';
	return html;
}

function get_vesion(){
	let price = $('input[name="price"]').val();
	let code_main = $('input[name="tourid"]').val();
	let attribute = new Array();
	let attributeid = new Array();
	let color = new Array();
	let colorid = new Array();
	$('.block-attribute table tbody tr').each(function (key, value){
		if($(this).find('select[name="attribute_catalogue[]"]').length){
			if($(this).find('input[name="checkbox[]"]:checked').length){
				let index = $(this).find('td:first').attr('data-index');
				if($(this).find('select[name="attribute['+index+'][]"] option:selected').length){
					attribute[key] = new Array();
					attributeid[key] = new Array();
				}
				if($(this).find('.bootstrap-tagsinput span.tag.label').length){
					color[key] = new Array();
					colorid[key] = new Array();
				}
				$(this).find('.bootstrap-tagsinput span.tag.label').each(function (){
					color[key].push($(this).text());
					colorid[key].push($(this).text());
				});
				$(this).find('select[name="attribute['+index+'][]"] option:selected').each(function (){
					attribute[key].push($(this).text());
					attributeid[key].push($(this).val());
				});
				
			}
		}
	});
	// $('.modal_version').remove();
	$('.block-version .ibox-content>table tbody').html('');
	$('.block-attribute').siblings('table').hide();


	if(color.length != 0){
		if(attribute.length == 0){
			attribute[0] = color[0];
			attributeid[0] = colorid[0];
		}else{
			let count = attribute.length;
			attribute[count + 1] = color[0];
			attributeid[count + 1] = colorid[0];
		}
	}

	let attribute1 = [];
	let attributeid1 = [];

	attribute.forEach(function(item, index, array) {
	  	if(typeof item != "undefined" ){
	  		attribute1.push(item);
	  		attributeid1.push(attributeid[index]);
		}
	});
	
	let index=1;
	for (var i in attribute1[0]){
		if(typeof attribute1[1] != "undefined"){
			for(var j in attribute1[1]){
				if(typeof attribute1[2] != "undefined"){
			    	for(var k in attribute1[2]){
			    		let title = attribute1[0][i]+'/'+attribute1[1][j]+'/'+attribute1[2][k];
			    		code= code_main+'-'+index;
			    		index = index +1;
			    		$('.block-version .ibox-content>table tbody').append(render_version(title, price, code,attributeid1[0][i], attributeid1[1][j], attributeid1[2][k] ));
						$('.block-version .ibox-content table').show();
			    	}
				}else{
					let title= attribute1[0][i]+'/'+attribute1[1][j];
			    	code= code_main+'-'+index;
			    	index = index +1;
			    	$('.block-version .ibox-content>table tbody').append(render_version(title, price, code,attributeid1[0][i], attributeid1[1][j] ));
					$('.block-version .ibox-content table').show();
				}
		    }
		}else{
			let title= attribute1[0][i];
		    code= code_main+'-'+index;
		    index = index +1;
	    	$('.block-version .ibox-content>table tbody').append(render_version(title, price,code,attributeid1[0][i],'' ));
			$('.block-version .ibox-content table').show();
		}
	}
}

// Dragable panels
function WinMove() {
    var element = ".attr-more";
    var handle = ".ibox-title";
    var connect = ".attr-more";
    $(element).sortable({
        handle: handle,
        connectWith: connect,
        tolerance: 'pointer',
        forcePlaceholderSize: true,
        opacity: 0.8
    })
    .disableSelection();
}

