/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $("#alibar").remove();
    $("#site-nav").remove();
    setTimeout(function(){
        $('.ali-search-v5 form').attr('action', '/index.php/alibaba/search');
        $('.search-wrapper form').attr('action', '/index.php/alibaba/search');
    }, 1000);
    
    $('button.btn-search').click(function(){
        var userInput = $('#q').val();
        var re = /\s+/;
        var keywords = userInput.split(re);
        var searchWord = keywords.join('+');
        var taobaoURL = 'http://s.taobao.com/search?q=' + searchWord;
        var myURL = '/index.php/taobao?url=' + encodeURIComponent(taobaoURL);
//        console.log(myURL); return false;
        window.location.href = myURL;
        return false;
    });
    $('.do-cart').addClass('do-cart-nb').removeClass('do-cart');
    $('.do-purchase').addClass('do-purchase-nb').removeClass('do-purchase');
    $('a').live('click',function() {
        if (!$(this).hasClass('do-purchase-nb') && !$(this).hasClass('do-cart-nb')) {
            var href = $(this).attr('href'); 
            if (href !== "#" && href !== 'javascript:;') {
                if (typeof $(this).data('injected') === 'undefined') {
                    $(this).data('injected', true);
                    var baseURL = '/index.php/alibaba';
                    var target = $(this).attr('href');
                    if (target.indexOf('tmall') !== -1) {
                        baseURL = '/index.php/tmall';
                    }
                    $(this).attr('href', baseURL + '?url=' + encodeURIComponent(target));
                } 
            } 
            var action = $(this).attr('action');
            if (action === 'http://s.1688.com/selloffer/offer_search.htm') {
                $(this).attr('action', '/index.php/alibaba/search');
            } else if (action === 'http://s.1688.com/company/company_search.htm') {
                $(this).attr('action', '/index.php/alibaba/company_search');
            } else if (action === 'http://s.1688.com/newbuyoffer/buyoffer_search.htm') {
                $(this).attr('action', '/index.php/alibaba/offer_search');
            } else if (action === 'http://s.1688.com/news/news_search.htm') {
                $(this).attr('action', '/index.php/alibaba/news_search');
            }
        } else {
            // order process
//            var numAttr = $('.J_TSaleProp').length;
            var user_data = $('.list .image').attr('title');
            
            var colorUrl = '';
            var imageSelector = $('.list .image .box-img img');
            if (imageSelector.length > 0) {
                colorUrl = imageSelector.attr('src');
            }
            var products = [];
            if ($('.list tbody tr').length > 0) {
                $('.list tbody tr').each(function(){
                    var product = {
                        name: $.trim($(this).find('.name').text()),
                        price: $.trim($(this).find('.price').text()),
                        amount: $(this).find('.amount-input').val()
                    }
                    products.push(product);
                });
            } else {
                try {
                    var range = $('.last-row').data('range');
                    var product = {
                        name : '',
                        price: range.price,
                        amount: $('.amount-input').val()
                    }
                    products.push(product);
                } catch (e) {
                    console.log(e);
                }
                
            }
            
            var shop_name = $('.supplierinfo-body .tplogo').attr('href');
            var product_name = $.trim($('#mod-detail-hd').text());
            var product_url = $('#product_url').val();
            
            var data = {
                products: JSON.stringify(products),
                product_name: product_name,
                product_url: product_url,
                shop_name: shop_name,
                user_data: user_data,
                color_url: colorUrl
            }
            
            var message = "Are you sure want to order";
            if (confirm(message)) {
                $.post("/index.php/order/addToCardAlibaba", data, function(json) {
                    message = json + '\n' + "Do you want to check your Cart now?"
                    if (confirm(message)) {
                        window.location.href = '/index.php/order'
                    }
                })
                
            }
            return false;
        }
        
    })
})