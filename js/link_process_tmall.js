/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $.cookie("original_url","")
    $("#site-nav").remove();
    $('a').live('click',function() {
        if (!$(this).parent().hasClass('tb-btn-add')) {
            var href = $(this).attr('href');
            if (href !== "#") {
                $.cookie("original_url", $(this).attr('href'), {path: '/'});
                window.location.reload();
            } 
        } else {
            var currency = $('#J_StrPrice .tb-rmb').text();
            var price = $('#J_StrPrice .tb-rmb-num').text();
            var number = $('#J_IptAmount').val();
            var product_name = $("#detail .tb-summary h3.tb-item-title").text();
            var product_url = $.cookie("product_url");
            var data = {
                price: currency + price,
                number: number,
                product_name: product_name,
                product_url: product_url
            }
            $.post("/taobao/addToCard", data, function(json) {
                console.log(json);
            })
            console.log(product_url);
            console.log(number);
            console.log(product_name);
            console.log (currency);
            console.log (price);
        }
        
        return false;
    })
})