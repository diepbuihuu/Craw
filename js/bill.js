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
            for ($i = 0; $i < 100; $i ++) {
                $tmp = $tmp.prev();
                if ($tmp.find('.ship_fee_cell').length > 0) {
                    break;
                }
            }
            var $fee_cell = $tmp.find('.ship_fee_cell');
            var rowspan = parseInt($fee_cell.attr('rowspan'));
            $fee_cell.attr('rowspan', rowspan - 1);
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
        if (typeof page !== 'undefined' && page === 'bill_confirm'){
            ship_fee = parseFloat($.trim($tr.find('.ship_fee_cell2').text()));
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
    
    function calculateTotal() {
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
        if (typeof page !== 'undefined' && page === 'bill_confirm'){
            calculateTotalShipFee();
        }
    }
    
    function calculateTotalShipFee() {
        var total_ship_fee = 0;
        $('#order_table tbody tr').each(function(){
            if ($(this).attr('abbr') !== 'total') {
                var ship_fee = parseFloat($.trim($(this).find('.ship_fee_cell2').text()))

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
                update_order: getBillData()
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
})
