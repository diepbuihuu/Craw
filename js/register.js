/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $('#register_form').on('keyup', function(e) {
        if (e.which == 13 || e.keyCode == 13) {
            checkLogin();
        }
    });
    $('#register_button').click(function(){
        checkLogin();
    });
    
    function showError(message) {
        $('#error-message').html(message);
        $('.alert').show();
    }
    
    $('#province').change(function(){
        var provinceId = $(this).val();
        if (provinceId === '') {
            $('#district').html('');
            $('#town').html('');
            return;
        }
        var url = '/index.php/user/getDistrict/' + provinceId;
        $.get(url, function(response){
            var html = '';
            var items = JSON.parse(response);
            for (var i in items) {
                var item = items[i];
                html += '<option value="' + item.district_id + '">' + item.district_name + '</option>';
            }
            $('#district').html(html);
            $('#district').trigger('change');
        })
    })
    
     $('#district').change(function(){
        var districtId = $(this).val();

        var url = '/index.php/user/getTown/' + districtId;
        $.get(url, function(response){
            var html = '';
            var items = JSON.parse(response);
            for (var i in items) {
                var item = items[i];
                html += '<option value="' + item.town_id + '">' + item.town_name + '</option>';
            }
            $('#town').html(html);
        })
    })
    
    function checkLogin() {
        var username = $('#username').val();
        var password = $('#password').val();
        var password_confirm = $('#password_confirm').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var province = $('#province').val();
        var district = $('#district').val();
        var town = $('#town').val();
        if (checkRegisterInfo(username, password, password_confirm, email, phone, address, province, district, town)){
            $.post("/index.php/user/register_action",
            {
                username: username, 
                password: password, 
                email: email, 
                phone: phone, 
                province: province, 
                district: district, 
                town: town, 
                address: address
            }
            ,function(json) {
                var response = JSON.parse(json);
                if (response.status === 1) {
                    window.location.href = "/index.php/home";
                } else {
                    showError(response.message);
                }
            })
        }
            
    }
    
    function checkRegisterInfo(username, password, password_confirm, email, phone, address) {
        for(var i in arguments) {
            if (arguments[i] === '' || arguments[i] === null) {
                showError("Missing infomation");
                return false;
            }
        }
        if (password !== password_confirm) {
            showError("Password and confirm password are not match");
            $('#password').val('');
            $('#password_confirm').val('');
            return false;
        }
        return true;
    }
})