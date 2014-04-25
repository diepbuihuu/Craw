<!DOCTYPE html>
<html>
  <head>
    <title>Register form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"> 
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/register.css" rel="stylesheet">
  </head>
  <body>
      <div class="alert alert-error">
          <div id="error-message"></div>
      </div>
      <div id="register_form">
        <div style="float: left; width: 50%">
            <div>
                <input id="username" placeholder="Username" type="text">
            </div>
            <div>
                <input id="password" placeholder="Password" type="password">
            </div>
            <div>
                <input id="password_confirm" placeholder="Confirm password" type="password">
            </div>
            <div>
                <input id="email" placeholder="Email" type="text">
            </div>
            <div>
                <input id="phone" placeholder="Phone" type="text">
            </div>
        </div>
          
        <div>
            <div>
                <div class="select_title">
                    Province: 
                </div>
                <select id="province">
                  <option value=""> Unselected </option>
                <?php foreach($provinces as $province): ?>
                  <option value="<?php echo $province->province_id; ?>"> <?php echo $province->province_name; ?> </option>
                <?php endforeach; ?>
                </select>
            </div>
            <div>
                <span class="select_title">
                    District: 
                </span>
                <select id="district">

                </select>
            </div>
            <div>
                <span class="select_title">
                    Town: 
                </span>
                <select id="town">

                </select>
            </div>
          <div>
              <input id="address" placeholder="Address" type="text">
          </div>
        </div>
        
          
        <div>
            <button id="register_button" class="btn btn-primary" type="button">REGISTER</button>
        </div>
    </div>
    
    
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/register.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
    
