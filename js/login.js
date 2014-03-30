/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $('#login_button').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        if (username !== "" && password !== "") {
            $.post("/authenticate/checkUser",
            {username: username, password: password}
            , function(json) {
                var response = JSON.parse(json);
                if (response.status === 1) {
                    window.location.href = "/taobao"
                }
            })
        }
    })
})