/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $('#update_user').click(function(){
        updateInfo();
    });
    
    $('.remove_button').click(function() {
        var $tr = $(this).closest('tr');
        if ($tr.find('.ship_fee_cell').length > 0) {
            var $fee_cell = $tr.find('.ship_fee_cell');
            var rowspan = parseInt($fee_cell.attr('rowspan'));
            if (rowspan > 1) {
                var oldCellHtml = $fee_cell.html();
                var newHtml = '<td rowspan="' + (rowspan -1) +  '" class="ship_fee_cell">' + oldCellHtml + '</td>';
                $tr.next().find('.price_cell').after(newHtml);
            }
            
        } else {
            $tmp = $tr;
            for ($i = 0; $i < 10; $i ++) {
                $tmp = $tmp.prev();
                if ($tmp.find('.ship_fee_cell').length > 0) {
                    break;
                }
            }
            var $fee_cell = $tmp.find('.ship_fee_cell');
            var rowspan = parseInt($fee_cell.attr('rowspan'));
            $fee_cell.attr('rowspan', rowspan - 1);
        }
        $tr.remove();
    })
    
    function updateInfo() {
        var username = $('#username').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var account = $('#account').val();
        var address = $('#address').val();
        var province = $('#province').val();
        var district = $('#district').val();
        var town = $('#town').val();
        if (checkRegisterInfo(username, email, phone, address, province, district, town)){
            $.post("/index.php/user/update_action",
            {
                username: username, 
                email: email, 
                phone: phone, 
                account: account, 
                province: province, 
                district: district, 
                town: town, 
                address: address
            }
            ,function(json) {
                var response = JSON.parse(json);
                if (response.status === 1) {
                    showError(response.message);
                } else {
                    showError(response.message);
                }
            })
        }
            
    }
    
    function checkRegisterInfo(username, email, phone, address,province, district, town) {
        for(var i in arguments) {
            if (arguments[i] === '' || arguments[i] === null) {
                showError("Missing infomation");
                return false;
            }
        }
        return true;
    }
    
    function showError(message) {
        $('#error-message').html(message);
        $('.alert').show();
    }
})
