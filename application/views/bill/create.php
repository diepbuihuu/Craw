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
      <div class="header">
          <a class="link_to_order" href="/index.php/order">Giỏ Hàng</a>
      </div>
      <div style="width: 60%; float: left; margin-top: 20px;">
          <div class="box_title">Thong tin khach hang</div>
          <div class="box_content">
              <div style="padding:4%; width: 43%; float:left;">
                  <div class="input_title">
                      Ten
                  </div>
                  <div class="input_content">
                      <input type="text" id="name" name="name" value="<?php echo $user->username; ?>">
                  </div>
                  
                  <div class="input_title">
                      Tai khoan
                  </div>
                  <div class="input_content" value="<?php echo $user->account; ?>">
                      <input type="text" id="account" name="account">
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
                          <?php foreach ($provinces as $province):?>
                            <?php if ($user->province_id === $province->province_id): ?>
                                <option value="<?php echo $province->province_id; ?>" selected="selected">
                                    <?php echo $province->province_name; ?>
                                </option>
                            <?php else: ?>
                                <option value="<?php echo $province->province_id; ?>">
                                    <?php echo $province->province_name; ?>
                                </option>
                            <?php endif; ?>
                          <?php endforeach;?>
                      </select>
                  </div>
                  
                  <div class="input_title">
                      Quan/huyen
                  </div>
                  <div class="input_content">
                      <select id="district">
                          <?php foreach ($districts as $district):?>
                            <?php if ($user->district_id === $district->district_id): ?>
                                <option value="<?php echo $district->district_id; ?>" selected="selected">
                                    <?php echo $district->district_name; ?>
                                </option>
                            <?php else: ?>
                                <option value="<?php echo $district->district_id; ?>">
                                    <?php echo $district->district_name; ?>
                                </option>
                            <?php endif; ?>
                          <?php endforeach;?>
                      </select>
                  </div>
                  
                  <div class="input_title">
                      Phuong/xa
                  </div>
                  <div class="input_content">
                      <select id="town">
                          <?php foreach ($towns as $town):?>
                            <?php if ($user->town_id === $town->town_id): ?>
                                <option value="<?php echo $town->town_id; ?>" selected="selected">
                                    <?php echo $town->town_name; ?>
                                </option>
                            <?php else: ?>
                                <option value="<?php echo $town->town_id; ?>">
                                    <?php echo $town->town_name; ?>
                                </option>
                            <?php endif; ?>
                          <?php endforeach;?>
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
          </div>
      </div>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/bill.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
    
