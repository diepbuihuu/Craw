/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $.cookie("original_url","")
    $("#site-nav").remove();
    $('a').live('click',function() {
        if ($(this).attr('id') === 'J_LinkBasket') {
            // order process
            if ($('.tb-selected').length < 2) {
                alert("Please choose color and size");
                return false;
            }
            var price = $.trim($('#J_StrPriceModBox').text());
            var number = $('#J_Amount input').val()
            var product_name = $('.tb-gallery .tm-brand').text()
            var product_url = $.cookie("product_url");
            var color = $.trim($('.tb-selected:first a').text());
            var size = $.trim($('.tb-selected:nth-child(2) a').text());
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
                $.post("/taobao/addToCard", data, function(json) {
                    alert(json);
                })
            }
            
        } else {
            var href = $(this).attr('href'); 
            if (href !== "#") {
                $.cookie("original_url", $(this).attr('href'), {path: '/'});
                window.location.reload();
            } 
        }
        
        return false;
    })
})