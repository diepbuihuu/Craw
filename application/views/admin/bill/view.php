<!DOCTYPE html>
<html>
    <head>
        <title>Don hang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"> 
        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/css/bill.css" rel="stylesheet">
        <link href="/css/home.css" rel="stylesheet">
        <input type="hidden" id="currency_rate" value="3365">
    </head>
    <body>
        <div class="alert alert-error">
            <div id="error-message"></div>
            <div id="success-message"></div>
        </div>
        <div class="header">
            <a class="link_to_order" href="/index.php/admin/bill">Đơn hàng</a> >> 
            <a class="link_to_order" href="#"><?php echo $bill->code; ?></a>
            (<?php echo $bill->status_text; ?>)
        </div>
        <div>
             <div style="width: 60%; float: left; margin-top: 20px;">
                <div class="news_box_title">Thông tin khách hàng</div>
                <div class="box_content">
                    <div style="padding:4%; width: 43%; float:left;">
                        <div class="input_title">
                            Tên
                        </div>
                        <div class="input_content">
                            <input type="text" id="username" name="username" value="<?php echo $user->username; ?>">
                        </div>

                        <div class="input_title">
                            Tài khoản
                        </div>
                        <div class="input_content">
                            <input type="text" id="account" name="account" value="<?php echo $user->account; ?>">
                        </div>
                        <div class="input_title">
                            Sdt
                        </div>
                        <div class="input_content">
                            <input type="text" id="phone" name="phone" value="<?php echo $user->phone; ?>">
                        </div>
                        <div class="input_title">
                            Email
                        </div>
                        <div class="input_content">
                            <input type="text" id="email" name="email" value="<?php echo $user->email; ?>">
                        </div>
                    </div>
                    <div style="padding:4%; width: 40%; float:left;">
                        <div class="input_title">
                            Thành phố
                        </div>
                        <div class="input_content">
                            <select id="province">
                                <?php foreach ($provinces as $province): ?>
                                    <?php if ($user->province_id === $province->province_id): ?>
                                        <option value="<?php echo $province->province_id; ?>" selected="selected">
                                            <?php echo $province->province_name; ?>
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo $province->province_id; ?>">
                                            <?php echo $province->province_name; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input_title">
                            Quận/Huyện
                        </div>
                        <div class="input_content">
                            <select id="district">
                                <?php foreach ($districts as $district): ?>
                                    <?php if ($user->district_id === $district->district_id): ?>
                                        <option value="<?php echo $district->district_id; ?>" selected="selected">
                                            <?php echo $district->district_name; ?>
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo $district->district_id; ?>">
                                            <?php echo $district->district_name; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input_title">
                            Phường/Xã
                        </div>
                        <div class="input_content">
                            <select id="town">
                                <?php foreach ($towns as $town): ?>
                                    <?php if ($user->town_id === $town->town_id): ?>
                                        <option value="<?php echo $town->town_id; ?>" selected="selected">
                                            <?php echo $town->town_name; ?>
                                        </option>
                                    <?php else: ?>
                                        <option value="<?php echo $town->town_id; ?>">
                                            <?php echo $town->town_name; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input_title">
                            Địa chỉ
                        </div>
                        <div class="input_content">
                            <input type="text" id="address" name="address" value="<?php echo $user->address; ?>">
                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <div style="margin-left: 4%; margin-bottom: 20px">
                        <button id="update_user" class="btn btn-primary" type="button">SỬA THÔNG TIN NHẬN HÀNG</button>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <link href="/css/order.css" rel="stylesheet">
        <div id="order_table_container">
            <table id="order_table" class="table table-striped">
                <thead>
                <th class="stt_header">
                    STT
                </th>
                <th class="pro_link_header">
                    Product Link
                </th>

                <th class="user_data_header">
                    Category
                </th>
                <th class="number_header">
                    Number
                </th>
                <th class="price_header">
                    Price
                </th>
                <th class="ship_fee_header">
                    Phi ship TQ
                </th>
                <th class="total_fee_header">
                    Tong(Te)
                </th>
                <th class="transportation_code_header">
                    Mã vận đơn
                </th>
                <th class="tranport_header">
                    Qua trinh van chuyen
                </th>
                </thead>
                <?php $i = 1; ?>
                <?php foreach ($orders as $shopName => $shopOrders): ?>
                    <tbody>
                        <?php foreach ($shopOrders as $index => $order): ?>
                            <tr abbr="<?php echo $order->id; ?>">

                                <td class="pro_link_cell">
                                    <?php echo $i++; ?>            
                                </td>

                                <td class="pro_link_cell">
                                    <div class="wid200">
                                        <a href="<?php echo trim($order->mylink); ?>" target="_blank"><?php echo trim($order->mylink); ?></a>
                                    </div>             
                                </td>

                                <td class="user_data_cell">
                                    <?php echo trim($order->user_data); ?>
                                </td>

                                <td class="amount_cell">
                                    <input class="amount_value" value="<?php echo $order->number ?>">
                                </td>

                                <td class="price_cell">
                                    <input value="<?php echo $order->price ?>" style="width: 40px;">
                                </td>
                                <?php if($index === 0): ?>
                                <td class="ship_fee_cell" rowspan="<?php echo count($shopOrders); ?>">
                                    <input value="<?php echo $order->ship_fee; ?>" class="ship_fee">
                                </td>
                                
                                <td class="fee_cell" rowspan="<?php echo count($shopOrders); ?>">
                                    0
                                </td>
                                <td class="transportation_code_td" rowspan="<?php echo count($shopOrders); ?>">
                                    <input value="<?php echo $order->transportation_code ?>" class="transportation_code">
                                </td>
                                <td rowspan="<?php echo count($shopOrders); ?>">
                                    <textarea class="transportation_process"><?php echo $order->transportation_process ?></textarea>
                                </td>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php endforeach; ?>
                <tbody>
                        <tr abbr="total">
                            <td></td>
                            <td>Tong</td>
                            <td></td>
                            <td class="amount_total">0</td>
                            <td></td>
                            <td class="ship_fee_total"><?php echo $bill->fee; ?></td>
                            <td class="fee_total">0</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                </tbody>
                
            </table>
        </div>
        <div>

            <div id="bill_summary">
                <table><col><col>
                    <tbody>
                        <tr>
                            <td>Tổng đơn (VND)</td>
                            <td id="total_price">150,000</td>
                        </tr>
                        <tr>
                            <td>
                                Phí đặt hàng (VND)
                                
                            </td>
                            <td id="order_fee">
                                <input type="text" id="order_fee_value" value="<?php echo $bill->fee ?>">
                            </td>
                        </tr>
                        <tr style="border-top: 1px solid #C9BEBE; vertical-align: bottom;">
                            <td>Tổng đơn hàng (VND)</td>
                            <td id="total_fee">?</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="clear: both"></div>
        </div>
        <input id="delete_order" type="hidden">
        <input id="bill_id" value="<?php echo $bill->bill_id; ?>" type="hidden">
        <input id="user_id" value="<?php echo $bill->user_id; ?>" type="hidden">
        <div style="margin: 70px;">
            <div style="margin-bottom: 70px;">
                <button id="admin_return_bill" class="btn btn-large btn-primary"> Gửi lại </button>
                
            </div>
        </div>
        <script type="text/javascript">
            var page = 'bill_check_admin';
        </script>

        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/js/bill_admin.js"></script>
        <script type="text/javascript" src="/js/register.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>

