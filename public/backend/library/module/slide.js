$(document).ready(function(){
	

	$( function() {
		$( ".tv.ui-sortable" ).sortable( "disable" );
		$( ".tv.ui-sortable" ).denableSelection();
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
				text: 'Xóa các Thành viên được chọn',
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Thực hiện!",
				cancelButtonText: "Hủy bỏ!",
				closeOnConfirm: false,
				closeOnCancel: false },
			function (isConfirm) {
				if (isConfirm) {
					var formURL = 'ajax/slight/delete';
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

	
});