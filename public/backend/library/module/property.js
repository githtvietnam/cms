$(document).ready(function(){
		$(document).on('click','.deleteProperty', function(){


		let _this = $(this);
		let id = _this.attr('id');
			swal({
				title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
				text: 'Xóa Bài viết này. Dữ liệu sẽ không thể khôi phục!',
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Thực hiện!",
				cancelButtonText: "Hủy bỏ!",
				closeOnConfirm: false,
				closeOnCancel: false },
			function (isConfirm) {
				if (isConfirm) {
					var formURL = 'ajax/property/deleteProperty';
					$.post(formURL, {
						id: id,},
						function(data){
							if(data == 0){
									sweet_error_alert('Có vấn đề xảy ra','Vui lòng thử lại')
								}else{
									swal("Xóa thành công!", "Bản ghi đã được xóa khỏi danh sách.", "success");
									window.location.href = BASE_URL+'backend/property/property/index';
								}
						});
				} else {
					swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
				}
			});
		
		
		return false;
	});
});