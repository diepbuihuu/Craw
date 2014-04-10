/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $.cookie("original_url","", {path: '/index.php'})
    $("#J_SiteNav").remove();
    $('a').live('click',function() {
        if (!$(this).parent().hasClass('tb-btn-add') && !$(this).hasClass('J_LinkAdd')) {
            var href = $(this).attr('href'); 
            if (href !== "#") {
                if (typeof $(this).data('injected') === 'undefined') {
                    $(this).data('injected', true);
                    var baseURL = '/index.php/taobao';
                    var target = $(this).attr('href');
                    if (target.indexOf('tmall') !== -1) {
                        baseURL = '/index.php/tmall';
                    }
                    $(this).attr('href', baseURL + '?url=' + encodeURIComponent(target));
                } 
            } 
        } else {
            // order process
            if ($('.J_TSaleProp .tb-selected').length < 2) {
                alert("Please choose color and size");
                return false;
            }
            var currency = $('#J_StrPrice .tb-rmb').text();
            var price = $('#J_StrPrice .tb-rmb-num').text();
            var number = $('#J_IptAmount').val();
            var product_name = $("#detail .tb-summary h3.tb-item-title").text();
            var product_url = $.cookie("product_url");
            var color = $.trim($('.J_TSaleProp .tb-selected:first a').text());
            var size = $.trim($('.J_TSaleProp .tb-selected:last a').text());
            var data = {
                price: currency + price,
                number: number,
                product_name: product_name,
                product_url: product_url,
                color: color,
                size: size
            }
            
            var message = "Your are ordering " + number + 'product(s)s "' + product_name + '"\n'
                + 'price: ' +  currency + price + '/product\n'
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
        }
        
    })
})