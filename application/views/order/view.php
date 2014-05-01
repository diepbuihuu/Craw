    <link href="/css/order.css" rel="stylesheet">
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
                    <td rowspan="<?php echo count($shopOrders); ?>" class="shop_name_cell">
                        <?php echo $order->shop_name?>
                    </td>
                    <?php endif; ?>
                    <td class="pro_link_cell">
                        <div class="wid200">
                            <a href="<?php echo trim($order->mylink); ?>" target="_blank"><?php echo trim($order->mylink); ?></a>
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
    
    
