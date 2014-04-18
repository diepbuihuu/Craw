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
              Tỷ giá ngân hàng: 3462 VNĐ/1 RMB
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
      <div class="slogan"></div>
      
      <div class="row menu">
            <div class="span">
                <div class="btn-group">
                    <a class="btn dropdown-toggle menu-item" href="/index.php/home">
                        Trang chủ
                    </a>
                </div>
                
            </div>
            <div class="span">
                <div class="btn-group">
                <a class="btn dropdown-toggle menu-item" data-toggle="dropdown" href="#">
                    Hướng dẫn đặt hàng
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">Tôi muốn tạo đơn hàng</a>
                    </li>
                    <li>
                        <a href="#">Tôi muốn lưu lại link sản phẩm</a>
                    </li>
                    <li>
                        <a href="#">Tôi muốn xem lại đơn hàng</a>
                    </li>
                </ul>
              </div>
            </div>
            <div class="span">
                <div class="btn-group">
                <a class="btn dropdown-toggle menu-item" data-toggle="dropdown" href="#">
                    Bảng giá
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">Giá vận tải Trung - Việt</a>
                    </li>
                    <li>
                        <a href="#">Giá vận tải liên tỉnh</a>
                    </li>
                    <li>
                        <a href="#">Giá vận tải nội thành</a>
                    </li>
                </ul>
              </div>
                
            </div>
            <div class="span">
                <div class="btn-group">
                <a class="btn dropdown-toggle menu-item" data-toggle="dropdown" href="#">
                    Thông tin liên hệ và thanh toán
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">Thanh toán online</a>
                    </li>
                    <li>
                        <a href="#">Chuyển khoản</a>
                    </li>
                    <li>
                        <a href="#">Thanh toán bằng tiền mặt</a>
                    </li>
                </ul>
              </div>
                
            </div>
            <div class="span">
                <div class="btn-group">
                <a class="btn dropdown-toggle menu-item" data-toggle="dropdown" href="#">
                    Thông báo
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">Thông báo tuyển dụng</a>
                    </li>
                    <li>
                        <a href="#">Thông báo dịch vụ mới</a>
                    </li>
                    <li>
                        <a href="#">Khuyến mại lớn</a>
                    </li>
                </ul>
                </div>
            </div>
            <div class="span">
                <div class="btn-group">
                <a class="btn dropdown-toggle menu-item" data-toggle="dropdown" href="#">
                    Góc nhà buôn
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">Mua hàng hiệu quả</a>
                    </li>
                    <li>
                        <a href="#">Thanh toán hiệu quả</a>
                    </li>
                </ul>
                </div>
                
            </div>     
      </div>