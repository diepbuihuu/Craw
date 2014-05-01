        <link href="/css/bill.css" rel="stylesheet">
        <div class="alert alert-error">
            <div id="error-message"></div>
            <div id="success-message"></div>
        </div>
        <div>
            <div style="width: 60%; float: left; margin-top: 20px;">
                <div class="news_box_title">Thông tin tài khoản</div>
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
                        <button id="update_user" class="btn btn-primary" type="button">CẬP NHẬT</button>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <script type="text/javascript" src="/js/bill.js"></script>

