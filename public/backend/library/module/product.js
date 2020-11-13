var count = 0;

$(document).on('click','.add-attr',function(){
	let _this = $(this);
	count++;
	render_attr();
})

$(document).on('click','.delete-attr',function(){
	let _this = $(this);
	_this.parents('.desc-more').remove();
	
});

$(document).on('change','#toogle_readonly',function(){
	let _this = $(this);
	let attr = $('.productid').attr('name');
	if(_this.is(':checked') && typeof attr !== typeof undefined && attr !== false){
		$('.productid').removeAttr('readonly');
	}else{
		$('.productid').attr('readonly', true);
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
		$('.productid').val(text)
	}else{
		$('.productid').val(productid)
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
		$('.productid').val(text)
	}else{
		$('.productid').val(productid)
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
        let form_URL = 'ajax/product/add_brand';
    	$.post(form_URL, {
			title : title, canonical: canonical, keyword: keyword, img: img
		},
		function(data){
			let json = JSON.parse(data);
			$('#insert_form')[0].reset();
            $('#product_add_brand').modal('hide');
            $('.brand_select').append('<option value=' + json.value + '>' + json.title + '</option>')
		});	
    }
});

function render_attr(){
	let html ='';
	var id = 'title_' + count;
	html = html + '<div class="col-lg-12 m-b desc-more">'
	html = html + '<div class="row m-b">'
	html = html + '<div class="col-lg-8">'
	html = html + '<input type="text" name="sub_content[title][]" class="form-control" placeholder="Tiêu đề">'
	html = html + '</div>'
	html = html + '<div class="col-lg-4">'
	html = html + '<div class="uk-flex uk-flex-middle uk-flex-space-between">'
	html = html + '<a href="" title="" data-target="'+id+'" class="uploadMultiImage">Upload hình ảnh</a>'
	html = html + '<button class="btn btn-danger delete-attr" type="button"><i class="fa fa-trash"></i></button>'
	html = html + '</div>'
	html = html + '</div>'
	html = html + '</div>'
	html = html + '<div class="row">'
	html = html + '<div class="col-lg-12" >'
	html = html + '<textarea name="sub_content[description][]" class="form-control ck-editor" id="'+id+'" placeholder="Mô tả"></textarea>'
	html = html + '</div>'
	html = html + '</div>'
	html = html + '</div>';
	$('.attr-more').prepend(html);
	ckeditor5(id);
}