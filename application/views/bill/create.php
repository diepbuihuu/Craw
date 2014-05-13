        <link href="/css/bill.css" rel="stylesheet">
        <div class="alert alert-error">
            <div id="error-message"></div>
            <div id="success-message"></div>
        </div>
        <div class="header">
            <a class="link_to_order" href="/index.php/order">Giỏ Hàng</a>
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
                                        <a href="<?php echo trim($order->mylink); ?>" target="_blank"><?php echo trim($order->mylink); ?></a>
                                    </div>             
                                </td>

                                <td class="user_data_cell">
                                    <?php echo trim($order->user_data); ?>
                                </td>

                                <td class="amount_cell">
                                    <button class="minus">-</button>
                                    <input class="amount_value" value="<?php echo $order->number ?>">
                                    <button class="plus">+</button>
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

                                <td class="fee_cell">
                                    <?php echo floatval($order->price) * intval($order->number); ?>
                                </td>
                                <td>
                                    <button class="remove_button"> Xoa </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                            <tr abbr="total">
                                <td></td>
                                <td>Tong</td>
                                <td></td>
                                <td class="amount_total">0</td>
                                <td></td>
                                <td>?</td>
                                <td class="fee_total">0</td>
                                <td class=""></td>
                                <td></td>
                            </tr>
                </tbody>
            </table>
            <div style="float: right;"><div class="dropdown">
                      <button class="btn dropdown-toggle sr-only" type="button" id="add_product_button" data-toggle="dropdown" style="background-color: #BEC3C4; background-image: none;border:none;">
                      Thêm sản phẩm
                      <span class="caret"></span>
                    </button>   
                    <ul class="dropdown-menu" role="menu" aria-labelledby="add_product_button">
                      <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="/index.php/taobao">Taobao</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="/index.php/tmall">Tmall</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="/index.php/alibaba">1688</a></li>

                    </ul>
                  </div></div>
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
                
                <div id="service_fee_table">
                    <div style="float: right" id="fee_table_hide">
                        <a href="javascript:void(0)">&nbsp;Tắt&nbsp;</a>
                    </div>
                    <div style="clear: both"></div>
                    <table>
                        <thead>
                            <tr>
                                <th>Giá đơn hàng</th>
                                <th>Phí dịch vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dưới 2 triệu</td>
                                <td>Tính giá lẻ</td>
                            </tr>
                            <tr>
                                <td>2 - 9 triệu</td>
                                <td>7% đơn hàng</td>
                            </tr>
                            <tr>
                                <td>10 - 49 triệu</td>
                                <td>5% đơn hàng</td>
                            </tr>
                            <tr>
                                <td>50 - 100 triệu</td>
                                <td>4% đơn hàng</td>
                            </tr>
                            <tr>
                                <td>Trên 100 triệu</td>
                                <td>3 triệu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="font-size:14px;">Tỷ giá hiện tại <span>3365</span></div>
                <table><col><col>
                    <tbody>
                        <tr>
                            <td>Tổng đơn (VND)</td>
                            <td id="total_price">150,000</td>
                        </tr>
                        <tr>
                            <td>Ship TQ</td>
                            <td>?</td>
                        </tr>
                        <tr>
                            <td>
                                Phí đặt hàng (VND)
                                <input type="hidden" id="order_fee_value" value="?">
                            </td>
                            <td id="order_fee">?</td>
                            <td style="font-size: 18px;" id="fee_table_show">
                                <a href="javascript:void(0)" >Bảng phí dịch vụ</a>
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
        <div style="margin: 70px;">
            <div style="float: right; margin-bottom: 70px;">
                Gửi đơn để chúng tôi có thể kiểm tra phí ship nội địa cho bạn >> <button id="create_bill"> Gửi đơn </button>
            </div>
        </div>

        <script type="text/javascript" src="/js/bill.js"></script>

