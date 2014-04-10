<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/dashboard.css" rel="stylesheet" media="screen">
  </head>
  <body>
      <div class="site_intro"></div>
      <div class="btn-group">
          <a class="btn dropdown-toggle menu-item" data-toggle="dropdown" href="#">
              Browse
              <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <li>
                  <a href="/index.php/taobao" target="_blank">Taobao</a>
              </li>
              <li>
                  <a href="/index.php/tmall" target="_blank">Tmall</a>
              </li>
          </ul>
      </div>
      
      <div class="btn-group">
          <a class="btn dropdown-toggle menu-item" href="/index.php/order" target="_blank">
              Orders
          </a>
      </div>
      
      <div class="btn-group">
          <a class="btn dropdown-toggle menu-item" data-toggle="dropdown" href="#">
              User
              <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              <li>
                  <a href="#">Edit Info</a>
              </li>
              <li>
                  <a href="#">Change Password</a>
              </li>
              <li>
                  <a href="#">Logout</a>
              </li>
          </ul>
      </div>
     
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
    
