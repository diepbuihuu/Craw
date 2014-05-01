<?php

class Order_model extends CI_Model {

    public $message;

    function __construct()
    {
        $this->message = "";
        // Call the Model constructor
        parent::__construct();
    }

    function insert($data)
    {
        $this->db->insert('orders', $data);
    }
    
    function getByUser($userId, $orderId = '') {
        $this->db->where('user_id', $userId);
        if ($orderId !== '') {
            $this->db->where("id in ($orderId)");
        } else {
            $this->db->where('status', 1);
        }
        
        $this->db->order_by('created', 'DESC');
        $query = $this->db->get('orders', 50);
        $queryData = $query->result();
        $queryData = $this->formatOrder($queryData);
        $result = array();
        foreach($queryData as $row) {
            $shopName = $row->shop_name;
            if (!isset($result[$shopName])) {
                $result[$shopName] = array($row);
            } else {
                $result[$shopName][] = $row;
            }
        }
        return $result;
    }
    
    function addOrderToBill($updateOrder) {
        $ids = $updateOrder['ids'];
        $updateData = $updateOrder['update_data'];
        if (empty($ids)) {
            $this->message = "Cannot create empty bill";
            return false;
        }
        
        $sql = "UPDATE orders SET ";
        if (!empty($updateData)) {
            $sql .= 'number=CASE id ';
            foreach ($updateData as $data) {
                $sql .= "WHEN {$data['id']} THEN '{$data['amount']}' ";
            }
            $sql .= 'ELSE number END ';
            $sql .= ',';
        }
        $sql .= 'status=2 ';
        $sql .= 'WHERE id in (' . implode(',', $ids) . ')';
        $this->db->query($sql);
        return true;
    }
    
    function adminUpdateBillOrder($updateOrder) {
        $ids = $updateOrder['ids'];
        $updateData = $updateOrder['update_data'];
        if (empty($ids)) {
            $this->message = "Cannot create empty bill";
            return false;
        }
        
        $sql = "UPDATE orders SET ";
        
        $sql .= 'number=CASE id ';
        foreach ($updateData as $data) {
            $sql .= "WHEN {$data['id']} THEN '{$data['number']}' ";
        }
        $sql .= 'ELSE number END ';
        $sql .= ',';
        
        $sql .= 'user_data=CASE id ';
        foreach ($updateData as $data) {
            $sql .= "WHEN {$data['id']} THEN '{$data['category']}' ";
        }
        $sql .= 'ELSE user_data END ';
        $sql .= ',';
        
        $sql .= 'price=CASE id ';
        foreach ($updateData as $data) {
            $sql .= "WHEN {$data['id']} THEN '{$data['price']}' ";
        }
        $sql .= 'ELSE price END ';
        $sql .= ',';
        
        $sql .= 'ship_fee=CASE id ';
        foreach ($updateData as $data) {
            $sql .= "WHEN {$data['id']} THEN '{$data['ship_fee']}' ";
        }
        $sql .= 'ELSE ship_fee END ';
        $sql .= ',';
        
        
        $sql .= 'transportation_code=CASE id ';
        foreach ($updateData as $data) {
            $sql .= "WHEN {$data['id']} THEN '{$data['transportation_code']}' ";
        }
        $sql .= 'ELSE transportation_code END ';
        $sql .= ',';
        
        
        $sql .= 'transportation_process=CASE id ';
        foreach ($updateData as $data) {
            $sql .= "WHEN {$data['id']} THEN '{$data['transportation_process']}' ";
        }
        $sql .= 'ELSE transportation_process END ';
        $sql .= ',';
        
        
        $sql .= 'status=2 ';
        $sql .= 'WHERE id in (' . implode(',', $ids) . ')';
        $this->db->query($sql);
        return true;
    }
    
    function delete($userId, $orderIds) {
        $this->db->where('user_id', $userId);
        $this->db->where_in('id', $orderIds);
        $this->db->delete('orders');
    }
    
    function formatOrder($orders) {
        $result = array();
        foreach ($orders as $index => $order) {
            $order->price = $this->formatNumber($order->price);
            $order->mylink = $this->formatLink($order->product_link);
            $result [] = $order;
        }
        return $result;
    }
    
    function formatLink($link) {
        $hostname = $_SERVER['HTTP_HOST'];
        if (strpos($link, 'taobao') !== FALSE) {
            $origin = 'taobao';
        } else if (strpos($link, 'tmall') !== FALSE) {
            $origin = 'tmall';
        } else if (strpos($link, '1688') !== FALSE) {
            $origin = 'alibaba';
        } else {
            return $link;
        }
        $newLink = 'http://' . $hostname . '/index.php/' . $origin . '?url=' . urlencode($link);
        return $newLink;
    }
    
    function formatNumber($str) {
        return preg_replace('/[^0-9.,]/', '', $str);
    }

}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
