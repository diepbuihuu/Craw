<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $title; ?> | Nhà Buôn</title>
		<?php echo $meta; ?>
		<?php echo add_css(array('bootstrap.min.css', 'style.css')); ?>
		<?php echo $css; ?>
		<?php echo add_js(array('jquery-1.8.0.min.js', 'bootstrap.min.js')); ?>
		<?php echo $js; ?>
   </head>
   <body>
      <!--Top-->
      <div class="top">
         <div class="wrapper">
            <p>Tỉ giá ngân hàng: 3462 VNĐ/1 RMB</p>
            <input type="text" value="Duyệt link taobao, t-mall" name="inputduyet" class="inputduyet" onfocus="if ('Duyệt link taobao, t-mall' === this.value) {this.value = '';}" onblur="if ('' === this.value) {this.value = 'Duyệt link taobao, t-mall';}">
            <input type="submit" class="submit" value="Duyệt" />
			<?php if(isLogin()): ?>
				<span class="username-label">
					<div class="dropdown">
						<a data-toggle="dropdown" href="#" class="username-label-link">
							<img style="margin-top: 12px; margin-left:4; float: left;" src="<?php echo base_url(""); ?>images/icon_cart.png" id="icon_cart" width="20" height="17" />
							Giỏ hàng của tôi
						</a>
						<div class="cnt_Cart dropdown-menu dropdown-info-cart">
							<ul>
								<li>
									<img src="<?php echo base_url(""); ?>images/img_sp.jpg" style="width: 59px; height: 59px;" alt="" />
									<a href="#">http://detail.tmall.com/item.htm?spm=a...</a>
									<span class="inforsp">
										Size: 29 <br />
										Màu: đen <br />
										Loại: ABC <br />
									</span>
									<span class="number">SL:29</span>
								</li>
								<li>
									<img src="<?php echo base_url(""); ?>images/img_sp.jpg" style="width: 59px; height: 59px;" alt="" />
									<a href="#">http://detail.tmall.com/item.htm?spm=a...</a>
									<span class="inforsp">
										Size: 29 <br />
										Màu: đen <br />
										Loại: ABC <br />
									</span>
									<span class="number">SL:29</span>
								</li>
								<a class="submit-order" href="#">Chốt đơn</a>
							</ul>
						</div>
					</div>
				</span>
				<span class="username-label">
				   <div class="dropdown">
					  <a data-toggle="dropdown" href="#" class="username-label-link">
					  <?php echo getCurrentUsername(); ?>
					  <img style="margin-left: 5px;" src="<?php echo base_url(""); ?>images/icon_ddl.png" style="cursor:pointer;" id="icon_ddl" width="11" height="8" alt="" />
					  </a>
					  <ul class="dropdown-menu dropdown-menu-username" role="menu" aria-labelledby="dLabel">
						 <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Thông tin tài khoản</a></li>
						 <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sản phẩm đã lưu</a></li>
						 <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Đơn hàng của tôi</a></li>
						 <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Giỏ hàng (<span style="color:#be2e32;">99</span>)</a></li>
						 <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Đổi mật khẩu</a></li>
						 <li role="presentation" class="divider"></li>
						 <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('account/logout/'); ?>">Thoát</a></li>
					  </ul>
				   </div>
				</span>
			<?php else: ?>
				<span class="username-label">
					<?php echo anchor('account/login', 'Đăng nhập'); ?> / 
					<?php echo anchor('account/register', 'Đăng Ký'); ?>
				</span>
			<?php endif; ?>
         </div>
      </div>
      <!---End Top--->
      <!--Banner --->
      <div class="outerbanner">
         <div class="wrapper">
            <a href="<?php echo base_url(""); ?>" class="logo"></a>
            <ul class="banner" >
               <li>
                  <img src="<?php echo base_url(""); ?>images/icon1.jpg" width="44" height="50" />
                  <p>Dễ dàng tạo và quản lý đơn hàng<br />
                     Tìm nguồn hàng, tư vấn miễn phí
                  </p>
               </li>
               <li>
                  <img src="<?php echo base_url(""); ?>images/icon2.jpg" width="44" height="50" />
                  <p>Đảm bảo 100% hàng hoá<br />
                     Đền bù khi có sai sót, thất lạc
                  </p>
               </li>
               <li>
                  <img src="<?php echo base_url(""); ?>images/icon3.jpg" width="44" height="50" />
                  <p>Giao hàng nhanh chóng, tận nơi<br />
                     Dù đơn hàng chỉ 1 sản phẩm
                  </p>
               </li>
            </ul>
         </div>
      </div>
      <!--End Banner --->
      <!--Menu --->
      <div class="outmenu">
         <div class="wrapper">
            <ul class="menu">
               <li><a href="#">Trang chủ</a></li>
               <li><a href="#">Hướng dẫn đặt hàng</a></li>
               <li><a href="#">Bảng giá</a></li>
               <li><a href="#">Thông tin liên hệ và Thanh toán</a></li>
               <li><a href="#">Thông báo</a></li>
               <li><a href="#">Góc nhà buôn</a></li>
            </ul>
            <div class="find_input">
               <input type="text" value="" class="search" name="s"> 
               <input type="image" class="btnsearch" src="<?php echo base_url(""); ?>images/icon_search.png">                        
            </div>
         </div>
      </div>
      <!--End Menu--->
      <!---Content-->
      <div class="wrapper main-content">
         <?php echo $content ?>
      </div>
	  <!---End Content-->
      <div class="wrapper">
         <div class="footer">
            <span class="zpersly-copyright">
            © Zpersly Shipping 2014
            </span><span class="hotline">
            01234 567 890
            </span>
         </div>
      </div>
   </body>
</html>