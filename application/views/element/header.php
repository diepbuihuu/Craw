<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/home.css" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
      <div class="row nhabuon-nav">
          <input type="hidden" id="currency_rate" value="3365">
          <div class="span4 pading5">
              Tỷ giá ngân hàng: 3365VNĐ / 1CNY
          </div>
          <div class="span2">
               <button class="btn btn-danger" type="button">Save Link</button>
          </div>
          <div class="span2 rfloat pading5">
              <a href="/index.php/order">Giỏ hàng của tôi</a>
          </div>
          <?php if(isset($username)):?>
          <div class="span2 rfloat">
              
                  <div class="dropdown">
                      <button class="btn dropdown-toggle sr-only" type="button" id="dropdownMenu1" data-toggle="dropdown" style="background-color: #BEC3C4; background-image: none;border:none;">
                      <?php echo $username; ?>
                      <span class="caret"></span>
                    </button>   
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/index.php/user/edit">Thông tin tài khoản</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/index.php/bill">Đơn hàng của tôi</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/index.php/bill/create">Tạo đơn hàng</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/index.php/order">Giỏ hàng của tôi</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/index.php/user/changePassword">Đổi mật khẩu</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/index.php/authenticate/logout">Logout</a></li>
                    </ul>
                  </div>

              
          </div>
          <?php else: ?>
          <div class="span2 rfloat pading5">
              <a href="/index.php/user/register">Đăng ký</a> / <a href="/index.php/authenticate">Đăng nhập</a>
          </div>    
        <?php endif; ?>

      </div>
      <div class="slogan">
          <img src="/img/slogan.png">
      </div>
        