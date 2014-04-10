/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $.cookie("original_url","", {path: '/index.php'})
    $("#site-nav").remove();
    $('a').live('click',function() {
        if ($(this).attr('id') === 'J_LinkBasket') {
            // order process
            if ($('.J_TSaleProp .tb-selected').length < 2) {
                alert("Please choose color and size");
                return false;
            }
            var price = $.trim($('#J_StrPriceModBox').text());
            var number = $('#J_Amount input').val()
            var product_name = $('.tb-gallery .tm-brand').text()
            var product_url = $.cookie("product_url");
            var color = $.trim($('.J_TSaleProp .tb-selected:first a').text());
            var size = $.trim($('.J_TSaleProp .tb-selected:nth-child(2) a').text());
            var data = {
                price: price,
                number: number,
                product_name: product_name,
                product_url: product_url,
                color: color,
                size: size
            }
            
            var message = "Your are ordering " + number + 'product(s)s "' + product_name + '"\n'
                + 'price: ' + price + '/product\n'
                + 'color:' + color + '\n'
                + 'size :' + size;
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
            if (href !== "#") {
                if (typeof $(this).data('injected') === 'undefined') {
                    $(this).data('injected', true);
                    var baseURL = '/index.php/tmall';
                    var target = $(this).attr('href');
                    if (target.indexOf('taobao') !== -1) {
                        baseURL = '/index.php/taobao';
                    }
                    $(this).attr('href', baseURL + '?url=' + encodeURIComponent(target));
                } 
            } 
        }
        
        
    })
})