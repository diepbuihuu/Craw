/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $('#update_user').click(function(){
        updateInfo();
    });
    
    $('#enable_edit').click(function(){
        $(this).hide();
        $('#update_bill').show();
        $('.remove_button').removeAttr('disabled');
        $('.plus').removeAttr('disabled');
        $('.amount_value').removeAttr('disabled');
        $('.minus').removeAttr('disabled');
    })
    
    $('.remove_button').click(function() {
        var $tr = $(this).closest('tr');
        if ($tr.find('.ship_fee_cell').length > 0) {
            var $fee_cell = $tr.find('.ship_fee_cell');
            var rowspan = parseInt($fee_cell.attr('rowspan'));
            if (rowspan > 1) {
                var newHtml = '<td rowspan="' + (rowspan -1) +  '" class="ship_fee_cell">0</td>';
                newHtml += '<td rowspan="' + (rowspan -1) +  '" class="fee_cell">0</td>'
                newHtml += '<td rowspan="' + (rowspan -1) +  '" class="transportation_code"></td>'
                $tr.next().find('.price_cell').after(newHtml);
            }
            
        } else {
            var $tmp = $tr;
            for ($i = 0; $i < 100; $i ++) {
                $tmp = $tmp.prev();
                if ($tmp.find('.ship_fee_cell').length > 0) {
                    break;
                }
            }
            var $fee_cell = $tmp.find('.ship_fee_cell');
            var rowspan = parseInt($fee_cell.attr('rowspan'));
            $fee_cell.attr('rowspan', rowspan - 1);
            $tmp.find('.fee_cell').attr('rowspan', rowspan - 1);
            $tmp.find('.transportation_code').attr('rowspan', rowspan - 1);
        }
        
        // mark deleted order
        var all_delete_order = $('#delete_order').val();
        var delete_order = $tr.attr('abbr');
        if (all_delete_order === '') {
            all_delete_order = delete_order;
        } else {
            all_delete_order += ',' + delete_order;
        }
        $('#delete_order').val(all_delete_order);
        
        
        $tr.remove();
        calculateTotal();
        
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
    
    calculateTotal();
    
    $('.amount_value').change(function(){
        var $tr = $(this).closest('tr');
        $tr.addClass('changed');
        var amount = parseInt($.trim($(this).val()));
        var price = parseFloat($.trim($tr.find('.price_cell').text()));
        var ship_fee = 0;
        if (typeof page !== 'undefined'){
            if (page === 'bill_confirm') {
                ship_fee = parseFloat($.trim($tr.find('.ship_fee_cell2').text()));
            } else if (page === 'bill_check_admin') {
                ship_fee = parseFloat($.trim($tr.find('.ship_fee').val()));
            }
            
            if (isNaN(ship_fee)) {
                ship_fee = 0;
            }
        }
        
        if (isNaN(amount) || amount < 0) {
            $(this).val('0');
        } else {
            var fee = price * amount + ship_fee;
            $tr.find('.fee_cell').html(fee);
            calculateTotal();
        }
    })
    
    $('.amount_cell .plus').click(function(){
        var $amount_value = $(this).parent().find('.amount_value');
        var old_amount = parseInt($amount_value.val());
        $amount_value.val(old_amount + 1);
        $amount_value.trigger('change');
    })
    
    $('.amount_cell .minus').click(function(){
        var $amount_value = $(this).parent().find('.amount_value');
        var old_amount = parseInt($amount_value.val());
        $amount_value.val(old_amount - 1);
        $amount_value.trigger('change');
    })
    
    function calculateShopFee() {
        
        $('#order_table tbody').each(function(){
            var shop_fee = 0;
            $(this).find('tr').each(function(){
                if ($(this).attr('abbr') !== 'total') {
                    var amount = parseInt($.trim($(this).find('.amount_cell .amount_value').val()));
                    var price = parseFloat($.trim($(this).find('.price_cell').text()));
                    if (!isNaN(amount) && !isNaN(price)) {
                        shop_fee += amount * price;
                    }
                }
            }) 
            shop_fee += parseFloat($.trim($(this).find('.ship_fee_cell').text()));
            $(this).find('.fee_cell').html(shop_fee);
        })
    }
    
    function calculateTotal() {
        calculateShopFee();
        var total_amount = 0, total_fee = 0;
        $('#order_table tbody tr').each(function(){
            if ($(this).attr('abbr') !== 'total') {
                var amount = parseInt($.trim($(this).find('.amount_cell .amount_value').val()))
                var fee = parseFloat($.trim($(this).find('.fee_cell').text()))
                if (!isNaN(amount)) {
                    total_amount += amount;
                }
                if (!isNaN(fee)) {
                    total_fee += fee;
                }
                
            }
        })
        $('#order_table tbody tr[abbr=total]').find('.amount_total').text(total_amount);
        $('#order_table tbody tr[abbr=total]').find('.fee_total').text(total_fee);
        var currency_rate = parseInt($('#currency_rate').val());
        var total_price = total_fee * currency_rate;
        $('#total_price').html(formatNumber(total_price));
        var order_fee = calculateOrderFee(total_price);
        if (isNaN(order_fee)) {
            $('#order_fee').html('?');
            order_fee = 0;
        } else if (typeof page !== 'undefined' && page !== 'bill_check_admin'){
            $('#order_fee').html(formatNumber(order_fee));
            $('#order_fee_value').val(order_fee);
        }
        
        if (typeof page !== 'undefined' && page === 'bill_confirm') {
            $('#total_fee').html(formatNumber(total_price + order_fee));
        }
               
               
        if (typeof page !== 'undefined' && 
                (page === 'bill_create' || page === 'bill_confirm' || page === 'bill_check_admin')){
            calculateTotalShipFee();
        }
    }
    
    $('.ship_fee').change(function(){
        $(this).closest('tr').find('.amount_value').trigger('change');
    })
    
    function calculateTotalShipFee() {
        var total_ship_fee = 0;
        $('#order_table tbody tr').each(function(){
            if ($(this).attr('abbr') !== 'total') {
                if (page === 'bill_confirm' || page === 'bill_create') {
                    ship_fee = parseFloat($.trim($(this).find('.ship_fee_cell2').text()));
                } else if (page === 'bill_check_admin') {
                    ship_fee = parseFloat($.trim($(this).find('.ship_fee').val()));
                }

                if (!isNaN(ship_fee)) {
                    total_ship_fee += ship_fee;
                }
                
            }
        })
        $('#order_table tbody tr[abbr=total]').find('.ship_fee_total').text(total_ship_fee);

    }
    
    $('#create_bill').click(function(){
         $.post("/index.php/bill/create_action",
            {
                delete_order: $('#delete_order').val(),
                update_order: getBillData(),
                order_fee: $('#order_fee_value').val()
            }
            ,function(json) {
                try {
                    var response = JSON.parse(json);
                    if (response.status == '1') {
                        window.location.href = '/index.php/bill';
                    } else {
                        alert(response.message);
                    }
                } catch (e) {
                    console.log(json);
                }
                
            })
    })
    
    $('#update_bill').click(function(){
        $.post("/index.php/bill/edit_action",
            {
                delete_order: $('#delete_order').val(),
                update_order: getBillData(),
                bill_id: $('#bill_id').val(),
                update_type: 'resent'
            }
            ,function(json) {
                try {
                    var response = JSON.parse(json);
                    if (response.status == '1') {
                        window.location.href = '/index.php/bill';
                    } else {
                        alert(response.message);
                    }
                } catch (e) {
                    console.log(json);
                }
                
            })
    })
    
    $('#confirm_bill').click(function(){
        $.post("/index.php/bill/edit_action",
            {
                bill_id: $('#bill_id').val(),
                update_type: 'confirm'
            }
            ,function(json) {
                try {
                    var response = JSON.parse(json);
                    if (response.status == '1') {
                        window.location.href = '/index.php/bill';
                    } else {
                        alert(response.message);
                    }
                } catch (e) {
                    console.log(json);
                }
                
            })
    })
    
    $('#admin_return_bill').click(function(){
        $.post("/index.php/admin/bill/edit_action",
            {
                update_order: getBillDataForAdmin(),
                bill_id: $('#bill_id').val(),
                user_id: $('#user_id').val(),
                order_fee: $('#order_fee_value').val()
            }
            ,function(json) {
                try {
                    var response = JSON.parse(json);
                    if (response.status == '1') {

                        window.location.href = '/index.php/admin/bill';
                    } else {
                        alert(response.message);
                    }
                } catch (e) {
                    console.log(json);
                }
                
            })
    })
    
    function getBillData() {
        var updateData = [];
        var ids = [];
         $('#order_table tbody tr').each(function(){
            if ($(this).attr('abbr') !== 'total') {
                var id = $(this).attr('abbr');
                var amount = $.trim($(this).find('.amount_cell .amount_value').val());
                ids.push(id);
                if ($(this).hasClass('changed')) {
                    updateData.push({id:id, amount:amount});
                }
            }
        })
        return JSON.stringify({ids:ids, update_data: updateData});
    }
    
    function getBillDataForAdmin() {
        var updateData = [];
        var ids = [];
         $('#order_table tbody tr').each(function(){
            if ($(this).attr('abbr') !== 'total') {
                var id = $(this).attr('abbr');
                var ship_fee = $.trim($(this).find('.ship_fee').val());
                var transportation_code = $.trim($(this).find('.transportation_code').val());
                var transportation_process = $.trim($(this).find('.transportation_process').val());
                ids.push(id);
                updateData.push({id: id, ship_fee:ship_fee, transportation_code:transportation_code, transportation_process: transportation_process});
            }
        })
        return JSON.stringify({ids:ids, update_data: updateData});
    }
    
    function formatNumber(number) {
        var str = '' + parseInt(number);
        var result = '';
        while (str.length > 3) {
            var endPart = str.substr(-3);
            result = endPart + ',' + result;
            str = str.substr(0, str.length - 3);
        }
        result = str + ',' + result;
        result = result.substr(0,result.length - 1);
        return result;
    }
    
    function calculateOrderFee(price) {
        if (price < 2000000) {
            return parseInt($('#order_fee_value').val());
        } else if (price < 9000000) {
            return price * 0.07;
        } else if (price < 49000000) {
            return price * 0.05;
        } else if (price < 100000000) {
            return price * 0.04;
        } else {
            return 3000000;
        }
    }
})
