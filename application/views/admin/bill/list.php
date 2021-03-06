<link href="/css/bill.css" rel="stylesheet">
<div class="header">
    <a class="link_to_order" href="/index.php/admin/bill">Đơn hàng</a>
</div>
<div style="margin-top: 30px;">
    <ul id="bill_filter" class="horizontal">
        <li><a href="/index.php/admin/bill">Tat ca</a></li>
        <li><a href="/index.php/admin/bill?status=1">Da gui</a></li>
        <li><a href="/index.php/admin/bill?status=2">Admin da check</a></li>
        <li><a href="/index.php/admin/bill?status=3">Da chot</a></li>
    </ul>
</div>
<div style="clear: both"></div>

<link href="/css/order.css" rel="stylesheet">
<div id="bill_table_container">
    <table id="bill_table" class="table table-striped">
        <thead>
        <th class="stt_header">
            STT
        </th>
        <th class="bill_code_header">
            Ma don
        </th>

        <th class="date_header">
            Ngay tao
        </th>
        <th class="note_header">
            Ghi chu 
        </th>
        <th class="status_header">
            Trang thai 
        </th>
        </thead>
        <tbody>
            <?php foreach ($bills as $index => $bill):?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><a href="/index.php/admin/bill/edit/<?php echo $bill->user_id; ?>/<?php echo $bill->bill_id; ?>"><?php echo $bill->code; ?></a></td>
                <td><?php echo $bill->created_text; ?></td>
                <td><?php echo $bill->note; ?></td>
                <td><?php echo $bill->status_text; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
