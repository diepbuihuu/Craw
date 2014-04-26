<!DOCTYPE html>
<html>
    <head>
        <title>Login form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"> 
        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/css/bill.css" rel="stylesheet">
    </head>
    <body>
        <div class="alert alert-error">
            <div id="error-message"></div>
            <div id="success-message"></div>
        </div>
        <div class="header">
            <a class="link_to_order" href="/index.php/order">Giỏ Hàng</a>
        </div>
        <div>
            <div style="width: 60%; float: left; margin-top: 20px;">
                <div class="box_title">Thong tin khach hang</div>
                <div class="box_content">
                    <div style="padding:4%; width: 43%; float:left;">
                        <div class="input_title">
                            Ten
                        </div>
                        <div class="input_content">
                            <input type="text" id="username" name="username" value="<?php echo $user->username; ?>">
                        </div>

                        <div class="input_title">
                            Tai khoan
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
                            Thanh pho
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
                            Quan/huyen
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
                            Phuong/xa
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
                            Dia chi
                        </div>
                        <div class="input_content">
                            <input type="text" id="address" name="address" value="<?php echo $user->address; ?>">
                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <div style="margin-left: 4%; margin-bottom: 20px">
                        <button id="update_user" class="btn btn-primary" type="button">SUA THONG TIN NHAN HANG</button>
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
                <th class="action_header">
                    Thaotac
                </th>
                </thead>
                <?php $i = 1; ?>
                <tbody>
                    <?php foreach ($orders as $shopName => $shopOrders): ?>
                        <?php foreach ($shopOrders as $index => $order): ?>
                            <tr abbr="<?php echo $order->id; ?>">

                                <td class="pro_link_cell">
                                    <?php echo $i++; ?>            
                                </td>

                                <td class="pro_link_cell">
                                    <div class="wid200">
                                        <?php echo trim($order->product_link); ?>
                                    </div>             
                                </td>

                                <td class="user_data_cell">
                                    <?php echo trim($order->user_data); ?>
                                </td>

                                <td>
                                    <?php echo $order->number ?>
                                </td>

                                <td class="price_cell">
                                    <?php echo $order->price ?>
                                </td>

                                <?php if ($index === 0): ?>
                                    <td rowspan="<?php echo count($shopOrders); ?>" class ="ship_fee_cell">
                                        <div>
                                            <?php echo $order->shop_name ?>
                                        </div>

                                    </td>
                                <?php endif; ?>

                                <td>
                                    <?php echo $order->price ?>
                                </td>
                                <td>
                                    <button class="remove_button"> Xoa </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <div style="width: 40%; padding: 2%;float: left;">
                Tổng đơn hàng chưa bao gồm phí vận chuyển TQ - HN (sẽ tính theo khối lượng sau khi hàng về)
                <br/>
                Giá vận tải TQ - HN (Giá về tận nhà HN)
                <table>
                    <thead>
                        <tr>
                            <th>Tổng khối lượng đơn hàng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1 - 4 Kg</td>
                            <td>30,000 VND/Kg</td>
                        </tr>
                        <tr>
                            <td>5 - 19 Kg</td>
                            <td>24,000 VND/Kg</td>
                        </tr>
                        <tr>
                            <td>22 - 50 Kg</td>
                            <td>30,000 VND/Kg</td>
                        </tr>
                        <tr>
                            <td>Trên 50 Kg (hàng nặng)</td>
                            <td>13,500 VND/Kg</td>
                        </tr>
                        <tr>
                            <td>Hàng khối</td>
                            <td>1,800,000 VND/Khối</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="bill_summary">
                <table><col><col>
                    <tbody>
                        <tr>
                            <td>Tổng đơn (VND)</td>
                            <td>150,000</td>
                        </tr>
                        <tr>
                            <td>Ship TQ</td>
                            <td>?</td>
                        </tr>
                        <tr>
                            <td>Phí đặt hàng (VND)</td>
                            <td>7,500 </td>
                        </tr>
                        <tr style="border-top: 1px solid #C9BEBE; vertical-align: bottom;">
                            <td>Tổng đơn hàng (VND)</td>
                            <td>?</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="clear: both"></div>
        </div>
        <div style="margin: 70px;">
            <div style="float: right; margin-bottom: 70px;">
                Gửi đơn để chúng tôi có thể kiểm tra phí ship nội địa cho bạn >> <button> Gửi đơn </button>
            </div>
        </div>

        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/js/bill.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>

