/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $.cookie("original_url","", {path: '/index.php'})
    $("#site-nav").remove();
    $('form.mallSearch-form').attr('action', '/index.php/tmall/search');
    $('#J_ShopSearchUrl').attr('value', '/index.php/tmall/search');
    $('#J_CurrShopBtn').attr('id', 'J_CurrShopBtn2');
    $('#J_CurrShopBtn2').click(function() {
        $('form.mallSearch-form').submit();
        return false;
    });
    
//    var searchTmall = function() {
//        var userInput = $('#mq').val();
//        var re = /\s+/;
//        var keywords = userInput.split(re);
//        var searchWord = keywords.join('+');
//        var tmallURL = 'http://list.tmall.com/search_product.htm?q=' + searchWord;
//        console.log(tmallURL); return false;
//        var myURL = '/index.php/tmall?url=' + encodeURIComponent(tmallURL);
//        console.log(myURL); return false;
//        window.location.href = myURL;
//        return false;
//    }
//    $('#J_SearchBtn').click(function(){
////        searchTmall();
//        console.log('123');
//        return false;
//    });
    $('a').live('click',function() {
        if ($(this).attr('id') === 'J_LinkBasket') {
            // order process
            var numAttr = $('.J_TSaleProp').length;
            if ($('.J_TSaleProp .tb-selected').length < numAttr) {
                alert("Please choose color and size");
                return false;
            }
            var promoPrice = $('#J_PromoPrice .tm-promo-price .tm-price').text();
            if (promoPrice !== '' && promoPrice !== undefined) {
                var price = promoPrice;
            } else {
                var price = $.trim($('#J_StrPriceModBox').text());
            }  
            var number = $('#J_Amount input').val()
            var product_name = $('.tb-gallery .tm-brand').text()
            var product_url = $('#product_url').val();
            var shop_name = $('#shopExtra .slogo-shopname').attr('href');
            var user_data = '';
            $('.J_TSaleProp').each(function(){
                user_data += $(this).data('property') + ':' + $.trim($(this).find('.tb-selected a').text()) + ', ';
            })

//            var color = $.trim($('.J_TSaleProp .tb-selected:first a').text());
//            var size = $.trim($('.J_TSaleProp .tb-selected:nth-child(2) a').text());
            var data = {
                price: price,
                number: number,
                product_name: product_name,
                product_url: product_url,
                shop_name: shop_name,
                user_data: user_data
            }
            
            var message = "Your are ordering " + number + 'product(s)s "' + product_name + '"\n'
                + 'price: ' + price + '/product\n'
                + 'category:' + user_data + '\n'
            if (confirm(message)) {
                $.post("/index.php/order/addToCard", data, function(json) {
                    message = json + '\n' + "Do you want to check your Cart now?"
                    if (confirm(message)) {
                        window.location.href = '/index.php/order'
                    }
                })
            }
            return false;
            
        } else {
            var href = $(this).attr('href'); 
            if (href !== "#" && href.indexOf('?') !== 0) {
                if (typeof $(this).data('injected') === 'undefined') {
                    $(this).data('injected', true);
                    var baseURL = '/index.php/tmall';
                    var target = $(this).attr('href');
                    
                    if (target.indexOf('tmall') === -1 && target.indexOf('taobao') !== -1) {
                        baseURL = '/index.php/taobao';
                    }
                    
                    if (target.indexOf('/search_product.htm') === 0) {
                        $(this).attr('href', baseURL + target.replace('_product.htm',''));
                    } else {
                        $(this).attr('href', baseURL + '?url=' + encodeURIComponent(target));
                    }
                    
                } 
            } 
        }
        
        
    })
})