$(document).ready(function(){
	function sweet_error_alert(title, message){
		swal({
			title: title,
			text: message,
			type: 'error',
		});
	}
	if($('.select2').length){
		$('.select2').select2();
	}

	$('.countdown').each(function(){
      	let _this = $(this);
      	let time = _this.attr('data-time');
      	_this.countdown(time, function(event) {
	        let day = event.strftime('%D');
	        let hour = event.strftime('%H');
	        let mins = event.strftime('%M');
	        let second = event.strftime('%S');
	        _this.find('.days').html('').html(day);
	        _this.find('.hours').html('').html(hour);
	        _this.find('.mins').html('').html(mins);
	        _this.find('.second').html('').html(second);

      	});
    });

	$(document).on('change','.va-choose-tour input[type="radio"]', function(){
		let _this = $(this)
		let val = _this.val()
		let form_URL = 'ajax/frontend/dashboard/get_select2';
		$.post(form_URL, {
			id : val
		},
		function(data){
			let json = JSON.parse(data);
			$('.check_end').html(json.html);
		});	
	})

	$(document).on('click','.language_widget', function(){
		let _this = $(this)
		let keyword = _this.attr('data-keyword')
		let form_URL = 'ajax/frontend/dashboard/language';
		$.post(form_URL, {
			keyword : keyword
		},
		function(data){
			location.reload();
		});	
	})
	$(document).on('submit','.form-contact', function(){
		let _this = $(this)
		let data = $(".form-contact").serializeArray();
		let form_URL = 'ajax/frontend/dashboard/contact';
		$.post(form_URL, {
			data : data
		},
		function(data){
			console.log(data);
			if(data == 0){
				sweet_error_alert('Có vấn đề xảy ra','Vui lòng thử lại!')
			}else{
				$('.form-contact')[0].reset();
				swal("Thành công!", "Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất, cám ơn bạn đã sử dụng dịch vụ này!", "success");
			}
		});	
		return false;
	})

	$(document).on('change','.check-aside input', function(){
		let _this = $(this)
		$('.tour_list_panel').hide();
		$('.tour_search_panel').html("");
		filter();
	})
	$(document).on('click','#pagination_ajax li a', function(){
		let _this = $(this)
		$('.tour_list_panel').hide();
		$('.tour_search_panel').html("");
		let page = _this.attr('data-ci-pagination-page');
		filter(page);
		return false;
	})

	function filter(page = 1){
		let idArea = [];
		let price = [];
		let vehicle = [];
		let time = [];
		let module = $('.va-articleCat-panel').attr('data-module');
		let canonical = $('.va-articleCat-panel').attr('data-canonical');
		$('.check-area input[name="area[]"]:checked').each(function(){
    		let valthis = $(this);
    		let valChild = valthis.val();
    		idArea.push(valChild)
    	})
    	$('.check-price input[name="price[]"]:checked').each(function(){
    		let valthis = $(this);
    		let valChild = valthis.val();
    		price.push(valChild)
    	})
    	$('.check-vehicle input[name="vehicle[]"]:checked').each(function(){
    		let valthis = $(this);
    		let valChild = valthis.val();
    		vehicle.push(valChild)
    	})
    	$('.check-time input[name="time[]"]:checked').each(function(){
    		let valthis = $(this);
    		let valChild = valthis.val();
    		time.push(valChild)
    	})
    	if(idArea.length == 0 && price.length == 0 && vehicle.length == 0 && time.length == 0 ){
			$('.tour_list_panel').show();
    	}else{
    		let form_URL = 'ajax/frontend/filter/render_tour';
			$.post(form_URL, {
				cat : idArea, price: price, vehicle: vehicle, time: time,module:module, url: canonical,page : page
			},
			function(data){
				let json = JSON.parse(data);
				let decode = b64DecodeUnicode(json.html);
				$('.tour_search_panel').html(decode);
				$('#pagination_ajax').html(json.pagination);
			});	
    	}
	}

	function b64DecodeUnicode(str) {
    // Going backwards: from bytestream, to percent-encoding, to original string.
	    return decodeURIComponent(atob(str).split('').map(function(c) {
	        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	    }).join(''));
	}
});
	(function($) {
	    "use strict";
	    var HT = {};

	    /* MAIN VARIABLE */

	    var $window = $(window),
	        $document = $(document),
	        $slide_item = $('.slide-item'),
			$btn_modal = $('.btn-modal-general'),
	        $num = $('.num'),
	        owl = $('.owl-carousel'),
	        $btn_tab = $('.btn-tab'),
	        $active_menu = $('.hd-menu-item'),
	        $num = $('.num'),
	        $document = $(document),
	        $js_dropdown = $('.js-dropdown');

	    // Check if element exists
	    $.fn.elExists = function() {
	        return this.length > 0;
	    };


	    HT.carousel = function() {
	        $('.owl-slide .owl-carousel').each(function() {
	            let _this = $(this);
	            let data_owl = _this.attr('data-owl');
	            data_owl = window.atob(data_owl);
	            data_owl = JSON.parse(data_owl);
	            _this.owlCarousel(data_owl);
	        });
	    }

	    

	    HT.modal_review = function() {
			if ($btn_modal.elExists) {
				let data_modal = '';
				$btn_modal.click(function() {
					let _this = $(this);
					data_modal = _this.attr('href');
					console.log(data_modal)
					$(data_modal).addClass('enable');
				})
				$('.modal').add($('.modal-close')).add($('.btn-cancel')).click(function() {
					$(data_modal).removeClass('enable');
				})

				$('.modal-content-review').click(function(e) {
					e.stopPropagation();
				})
			}

		}
	    HT.sum = function(start, dataCount, display) {
	        display.text(start);
	        start += 1;
	        if (start <= dataCount) {
	            setTimeout(function() {
	                HT.sum(start, dataCount, display)
	            }, 50)
	        }
	    }

	    HT.countUp = function() {
	        if ($num.elExists) {
	            $num.each(function(e) {
	                let _this = $(this)
	                let dataCount = _this.attr('data-count');
	                let display = _this.text(dataCount);
	                let start = 1;
	                HT.sum(start, dataCount, display)
	            })


	        }
	    }

	    HT.tabs = function() {
            $('ul.tabs li').click(function() {
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#" + tab_id).addClass('current');
            })
            $('ul.tabs-detail li').click(function() {
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs-detail li').removeClass('current');
                $('.tab-content-detail').removeClass('current');

                $(this).addClass('current');
                $("#" + tab_id).addClass('current');
            })
        }
        // rating

    HT.vote = function() {
        $(document).ready(function() {

            //Action on hover

            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10);


                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });

            // Action on click

            $('#stars li').on('click', function() {
                var onStar = parseInt($(this).data('value'), 10);
                var stars = $(this).parent().children('li.star');
                var i;
                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }
            });
        });
    }

    // Nice select

    HT.niceSelect = function() {
        $('select').niceSelect();
    }

	    // Document ready functions
	    $document.on('ready', function() {
	    	HT.tabs(),
            HT.vote(), 
            HT.niceSelect(),
	        HT.countUp(),
	        HT.carousel(),
	        HT.modal_review();
	    });

	})(jQuery);