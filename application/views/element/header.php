<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/home.css" rel="stylesheet">
  </head>
  <body>
      <div class="row nhabuon-nav">
          <div class="span4 pading5">
              Tỷ giá ngân hàng: 3462VNĐ / 1CNY
          </div>
          <div class="span2">
               <button class="btn btn-danger" type="button">Save Link</button>
          </div>
          <div class="span2 rfloat pading5">
              <a href="/index.php/order">Giỏ hàng của tôi</a>
          </div>
          <div class="span2 rfloat pading5">
              <?php if(isset($username)):?>
              <a href="/index.php/user/edit"><?php echo $username; ?></a> / <a href="/index.php/authenticate/logout">Logout</a>
              <?php else: ?>
              <a href="/index.php/user/register">Đăng ký</a> / <a href="/index.php/authenticate">Đăng nhập</a>
              <?php endif; ?>
          </div>

      </div>
      <div class="slogan">
          <img src="/img/slogan.png">
      </div>
        