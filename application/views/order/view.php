<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Order List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/order.css" rel="stylesheet">
  </head>
  <body>
    <table class="table table-striped">
        <thead>
            <th class="username_header">
                Shop
            </th>
            <th class="pro_link_header">
                Product Link
            </th>
            <th class="pro_name_header">
                Product Name
            </th>
            <th class="user_data_header">
                Category
            </th>
            <th class="price_header">
                Price
            </th>
            <th class="number_header">
                Number
            </th>
            <th class="status_header">
                Status
            </th>
            <th class="time_header">
                Order time
            </th>
        </thead>
        <tbody>
        <?php foreach ($orders as $shopName => $shopOrders):?>
            <?php foreach($shopOrders as $index => $order): ?>
                <tr>
                    <?php if($index === 0): ?>
                    <td rowspan="<?php echo count($shopOrders); ?>">
                        <?php echo $order->shop_name?>
                    </td>
                    <?php endif; ?>
                    <td class="pro_link_cell">
                        <div class="wid200">
                            <?php echo trim($order->product_link); ?>
                        </div>             
                    </td>
                    <td class="pro_name_cell">
                        <?php echo trim($order->product_name); ?>
                    </td>
                    <td class="user_data_cell">
                        <?php echo trim($order->user_data); ?>
                    </td>
                    <td>
                        <?php echo $order->price?>
                    </td>
                    <td>
                        <?php echo $order->number?>
                    </td>
                    <td>
                        <?php 
                            switch($order->status) {
                                case '1' :
                                    echo "Not Ready";
                                    break;
                                case '2' :
                                    echo "Ready";
                                    break;
                                case '3' :
                                    echo "Deliverying";
                                    break;
                                case '4' :
                                    echo "Complete";
                                    break;
                            }

                        ?>
                    </td>
                    <td>
                        <?php echo date("Y-m-d H:i:s",$order->created); ?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endforeach;?>
        </tbody>
    </table>
    
    <script type="text/javascript" src="/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
    
