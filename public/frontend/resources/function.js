$(document).ready(function(){
	if($('.select2').length){
		$('.select2').select2();
	}

	$(document).on('change','.va-choose-tour input[type="radio"]', function(){
		let _this = $(this)
		let val = _this.val()
		let form_URL = 'frontend/ajax/dashboard/get_select2';
		$.post(form_URL, {
			id : val
		},
		function(data){
			let json = JSON.parse(data);
			$('.check_end').html(json.html);
		});	
	})
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