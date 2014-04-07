/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $('#login_form').on('keyup', function(e) {
        if (e.which == 13 || e.keyCode == 13) {
            checkLogin();
        }
    });
    $('#login_button').click(function(){
        checkLogin();
    });
    
    function checkLogin() {
        var username = $('#username').val();
        var password = $('#password').val();
            $.post("/index.php/authenticate/checkUser",
            {username: username, password: password}
            , function(json) {
                var response = JSON.parse(json);
                if (response.status === 1) {
                    window.location.href = "/taobao"
                } else {
                    alert(response.message);
                }
            })
    }
})