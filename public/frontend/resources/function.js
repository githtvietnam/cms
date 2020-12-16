	(function($) {
	    "use strict";
	    var HT = {};

	    /* MAIN VARIABLE */

	    var $window = $(window),
	        $document = $(document),
	        $btn_modal = $('.btn-modal'),
	        $slide_item = $('.slide-item'),
			$btn_modal = $('.btn-modal-general'),
	        $num = $('.num'),
	        owl = $('.owl-carousel'),
	        $btn_tab = $('.btn-tab'),
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


	    // Document ready functions
	    $document.on('ready', function() {
	        // HT.lazyLoadding(); 
	        HT.countUp();
	        HT.carousel();
	        HT.modal_review();
	        // HT.tagClick();
	        // HT.textMove();
	        // HT.dropdown();
	        // HT.jRange();
	        // HT.input_jRange();
	        // HT.twoSlider();
	        // HT.dispayView();
	        // HT.flexSlide();
	        // HT.filter();
	    });

	})(jQuery);