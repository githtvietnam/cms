(function($) {
    "use strict";
    var HT = {};


    /* MAIN VARIABLE */

    var $window = $(window),
        $active_menu = $('.hd-menu-item'),
        $btn_modal = $('.btn-modal-general'),
        $num = $('.num'),
        $btn_view_more = $('.view-more'),
        $active_accordion = $('.active-accordion'),
        $document = $(document);



    HT.viewMore = function() {
        $btn_view_more.click(function() {
            let _this = $(this);
            $('.wrap-view-more').addClass('show-up');
            _this.addClass('disable');
            $('.collapse').removeClass('disable');
            $('.collapse').click(function() {
                $('.wrap-view-more').removeClass('show-up');
                _this.removeClass('disable');
                $('.collapse').addClass('disable');
            })
        })
        $('.btn-load-more').click(function() {
            let _this = $(this);
            let data_load = _this.attr('data-load-more');
            console.log(data_load)
            $(data_load).addClass('show-up');
            _this.siblings('.btn-collapse').removeClass('disable');
            _this.addClass('disable')
        })
        $('.btn-collapse').click(function() {
            let _this = $(this);
            let data_load = _this.attr('data-load-more');
            console.log(data_load)
            $(data_load).removeClass('show-up');
            _this.siblings('.btn-load-more').removeClass('disable');
            _this.addClass('disable')
        })
    }










    // Check if element exists
    $.fn.elExists = function() {
        return this.length > 0;
    };

    HT.modal_review = function() {
        if ($btn_modal.elExists) {
            let data_modal = '';
            $(document).on('click', '.btn-modal-general', function() {
                console.log(1);
                let _this = $(this);
                data_modal = _this.attr('href');
                console.log(data_modal)
                $(data_modal).addClass('enable');
                return false;
            })
            $('.modal').add($('.modal-close')).add($('.btn-cancel')).click(function() {
                $('.modal').add($('.modal-full-width')).removeClass('enable');
                return false;
            })
            $(document).on('click', '.btn-hide', function() {
                $(data_modal).removeClass('enable');
            })
            $('.modal-content-review').click(function(e) {
                e.stopPropagation();
            })
        }

    }

    HT.carousel = function() {
        $('.owl-slide .owl-carousel').each(function() { // --> Lặp qua tất cả các cấu trúc DOM nào có dạng là .owl-slide .owl-carousel
            let _this = $(this); // --> Khai báo cái phần tử mà vòng lặp đang chạy tới.
            let data_owl = _this.attr('data-owl'); // Lấy ra dữ liệu được setup phía html (ở dạng base64)
            let data_disabled = _this.attr('data-disabled');
            data_owl = window.atob(data_owl); // Decode dữ liệu dạng base64
            data_owl = JSON.parse(data_owl); // Decode dữ liệu dạng JSON --> trở về dạng object
            if (data_disabled == 0) {
                _this.owlCarousel(data_owl); // --> Truyền cái đối tượng đã được decode vào hàm slide
            }
        });


    }








    HT.tabs = function() {
        $('ul.tabs li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })
        $('ul.tabs-2 li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs-2 li').removeClass('current');
            $('.tab-content-2').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })
    }

    // Nice select

    HT.niceSelect = function() {
        $('select').niceSelect();
    }



    HT.activeAcordion = function() {
        if ($active_accordion.elExists) {
            $('.uk-accordion-title').click(function() {
                let _this = $(this);
                console.log(_this.find($active_accordion).text());
                if (_this.find($active_accordion).text() == '+') {
                    _this.find($active_accordion).text('-')
                } else if (_this.find($active_accordion).text() == '-') {
                    _this.find($active_accordion).text('+')

                }
            })
        }
    }






    HT.twoSlider = function() {
        $(document).ready(function() {
            var slidesPerPage = 4; //globaly define number of elements per page
            var syncedSecondary = true;
            $('.project-item').each(function() {
                console.log(1);
                let _this = $(this);
                var sync1 = _this.find(".image-list .owl-carousel:nth-child(1)");
                var sync2 = _this.find(".image-list .owl-carousel:nth-child(2)");
                sync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: true,
                    autoplay: false,
                    dots: false,
                    loop: true,
                    responsiveRefreshRate: 200,
                    navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
                }).on('changed.owl.carousel', syncPosition);

                sync2
                    .on('initialized.owl.carousel', function() {
                        sync2.find(".owl-item").eq(0).addClass("current");
                    })
                    .owlCarousel({
                        items: slidesPerPage,
                        dots: false,
                        nav: false,
                        margin: 10,
                        smartSpeed: 200,
                        slideSpeed: 500,
                        slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                        responsiveRefreshRate: 100
                    }).on('changed.owl.carousel', syncPosition2);

                function syncPosition(el) {
                    //if you set loop to false, you have to restore this next line
                    //var current = el.item.index;

                    //if you disable loop you have to comment this block
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    //end block

                    sync2
                        .find(".owl-item")
                        .removeClass("current")
                        .eq(current)
                        .addClass("current");
                    var onscreen = sync2.find('.owl-item.active').length - 1;
                    var start = sync2.find('.owl-item.active').first().index();
                    var end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                }

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        sync1.data('owl.carousel').to(number, 100, true);
                    }
                }

                sync2.on("click", ".owl-item", function(e) {
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.data('owl.carousel').to(number, 300, true);
                });
            });
        });
    }

    HT.login = function() {
        $('.message a').click(function() {
            $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
            return false;
        });
    }

    HT.activeInput = function() {
        $('.input-group input').add($('.input-group textarea')).focus(function() {
            let _this = $(this);
            _this.parent().addClass('input-title-focus');
        })
        $('.input-group input').add($('.input-group textarea')).focusout(function() {
            let _this = $(this);
            _this.parent().removeClass('input-title-focus');
        })
    }


    HT.filter = () => {
        $(document).on('click', '.btn-tab', function() {
            let _this = $(this);
            let owl = _this.attr('data-owl');
            let object = {
                'dataType': _this.data('type'),
            }
            let ajaxUrl = 'common/data.php';
            $.post(ajaxUrl, {
                    post: object,
                },
                function(data) {
                    let json = JSON.parse(data);
                    let html = '<div class="data-menu-product uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 uk-clearfix">';
                    for (var i = 0; i < json.length; i++) {
                        html = html + property_render_html(json[i], owl);
                    }

                    html = html + '</div>';
                    $('#ajax-list').html(html);



                    let html2 = '<div class="data-menu-product uk-grid uk-grid-medium uk-grid-width-medium-1-1 uk-grid-width-large-1-2 uk-clearfix">';
                    for (var i = 0; i < json.length; i++) {
                        html2 = html2 + property_render_html(json[i], owl);
                    }

                    html2 = html2 + '</div>';
                    $('#ajax-list-2').html(html2);

                    HT.carousel();
                    HT.modal_review();
                    HT.loading();
                })
            return false;
        })
    }

    HT.loading = function() {

        $(document).ajaxStart(function() {
            $(".loading").show();
        });
        $(document).ajaxComplete(function() {
            $(".loading").hide();
        });
    }

    // Document ready functions
    $document.on('ready', function() {
        HT.carousel(),
            HT.tabs(),
            HT.loading(),
            HT.login(),
            HT.filter(),
            HT.activeInput(),
            HT.twoSlider(),
            HT.niceSelect(),
            HT.viewMore(),

            HT.activeAcordion(),
            HT.modal_review();
    });

})(jQuery);




function property_render_html(object, owl) {
    let html = '';

    html = html + '<li class="tab-content current">'
    html = html + '<div class="wrap-product">'
    html = html + '<div class="' + object.class + '">'
    html = html + '<div class="img-product">'
    html = html + '<div class="owl-slide">'
    html = html + '<div class="owl-carousel owl-theme" data-owl="' + owl + '" data-disabled="0">'
    html = html + '<a href="" class="img-cover">'
    html = html + '<img src="' + object.img1 + '" alt="">'
    html = html + '</a>'
    html = html + '<a href="" class="img-cover">'
    html = html + '<img src="' + object.img2 + '" alt="">'
    html = html + '</a>'
    html = html + '<a href="" class="img-cover">'
    html = html + '<img src="' + object.img3 + '" alt="">'
    html = html + '</a>'
    html = html + '</div>'
    html = html + '</div>'
    html = html + '<a href="#modal-signin" class="btn-heart btn-modal-general">'
    html = html + '<i class="fa fa-heart-o" aria-hidden="true"></i>	'
    html = html + '</a>'
    html = html + '<div class="for-rent">'
    html = html + ' For rent'
    html = html + '</div>'
    html = html + '</div>'
    html = html + '<div class="product-content">'
    html = html + '<div class="product-title mb10">'
    html = html + '<a href="" title="">'
    html = html + '<h2>' + object.title + '</h2>'
    html = html + '</a>'
    html = html + '</div>'
    html = html + '<div class="product-address mb10 italics">'
    html = html + '<i class="fa fa-street-view normal" aria-hidden="true"></i>'
    html = html + '' + object.address + ''
    html = html + '</div>'
    html = html + '<div class="price uk-flex uk-flex-wrap mb10">'
    html = html + '<div class="old-price mr20">'
    html = html + ' ' + object.priceold + ''
    html = html + '</div>'
    html = html + '<div class="new-price key-color">'
    html = html + '' + object.pricenew + ''
    html = html + '</div>'
    html = html + '</div>'
    html = html + '<div class="uk-flex uk-flex-middle uk-flex-wrap mb20">'
    html = html + '<div class="info-item mr20">'
    html = html + '<span>'
    html = html + 'Bedroom: '

    html = html + '</span>'
    html = html + '' + object.bed + ''
    html = html + '</div>'
    html = html + '<div class="info-item mr20">'
    html = html + '<span>'
    html = html + ' Bathroom:'

    html = html + '</span>'
    html = html + '' + object.bath + ''
    html = html + '</div>'
    html = html + '<div class="info-item mr20">'
    html = html + '<span>'
    html = html + 'Property size:'
    html = html + '</span>'
    html = html + '' + object.size + ''
    html = html + '</div>'
    html = html + '</div>'
    html = html + '<div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap uk-clearfix">'
    html = html + '<div class="product-time">'
    html = html + ' 3 years ago'
    html = html + '</div>'
    html = html + '<div class="product-compare">'
    html = html + '<a href="#compare" class="btn-modal-general">'
    html = html + '<i class="fa fa-files-o" aria-hidden="true"></i>'
    html = html + 'COMPARE '
    html = html + '</a>'
    html = html + '</div>'
    html = html + '<button class="btn-general btn-clear">detail <i class="fa fa-angle-right ml5" aria-hidden="true"></i></button>'
    html = html + '</div>'
    html = html + '</div>'
    html = html + '</div>'
    html = html + '</div>'
    html = html + '</li>'


    return html;
}