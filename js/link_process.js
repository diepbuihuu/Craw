/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $.cookie("original_url","")
    $("#J_SiteNav").remove();
    $('a').live('click',function() {
        if (!$(this).parent().hasClass('tb-btn-add') && !$(this).hasClass('J_LinkAdd')) {
            var href = $(this).attr('href'); 
            if (href !== "#") {
                $.cookie("original_url", $(this).attr('href'), {path: '/'});
                window.location.reload();
            } 
        } else {
            // order process
            if ($('.tb-selected').length < 2) {
                alert("Please choose color and size");
                return false;
            }
            var currency = $('#J_StrPrice .tb-rmb').text();
            var price = $('#J_StrPrice .tb-rmb-num').text();
            var number = $('#J_IptAmount').val();
            var product_name = $("#detail .tb-summary h3.tb-item-title").text();
            var product_url = $.cookie("product_url");
            var color = $.trim($('.tb-selected:first a').text());
            var size = $.trim($('.tb-selected:last a').text());
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
                $.post("/taobao/addToCard", data, function(json) {
                    alert(json);
                })
            }
        }
        
        return false;
    })
})