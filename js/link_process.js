/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $.cookie("original_url","")
    $("#J_SiteNav").remove();
    $('a').live('click',function() {
        if (!$(this).parent().hasClass('tb-btn-add')) {
            var href = $(this).attr('href');
            if (href !== "#") {
                if (href.indexOf("tmall") !== -1) {
                    console.log(href)
                } else {
                    $.cookie("original_url", $(this).attr('href'));
                    window.location.reload();
                }  
            } 
        } else {
            alert("add to card");
        }
        
        return false;
    })
})