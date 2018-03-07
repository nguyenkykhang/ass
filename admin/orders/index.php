<?php
require_once('../../util/main.php');
require_once('util/secure_conn.php');
require_once('util/valid_admin.php');
require_once('model/order_db.php');
require_once('model/product_db.php');

if ( isset($_POST['action']) ) {
    $action = $_POST['action'];
} elseif ( isset($_GET['action']) ) {
    $action = $_GET['action'];
} else {
    $action = 'view_orders';
}

switch($action) {
    case 'view_orders':
        $new_orders = get_orders();
        include 'orders.php';
        break;
    case 'view_order':
        $order_id = $_GET['order_id'];

        // Get order data
        $order = get_order($order_id);
        $order_date = date('M j, Y', strtotime($order['orderDate']));
        $order_items = get_order_items($order_id);
        $customer_name = $order['customerName'];
        $customer_address = $order['customerAddress'];
        $customer_phone = $order['customerPhone'];

        include 'order.php';
        break;
    case 'delete':
        $order_id = $_POST['order_id'];
        delete_order($order_id);
        redirect('.');
        break;
    default:
        display_error("Unknown order action: " . $action);
        break;
}
?>