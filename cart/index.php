<?php
require_once '../util/main.php';
require_once '../util/validation.php';

require_once '../model/cart.php';
require_once '../model/product_db.php';
require_once('../model/order_db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'view';
}
$cart = cart_get_items();
switch ($action) {
    case 'view':
        $cart = cart_get_items();
        include './cart_view.php';
        break;
    case 'add':
        $product_id = $_GET['product_id'];
        $quantity = $_GET['quantity'];

        // validate the quantity entry
        if (empty($quantity)) {
            display_error('You must enter a quantity.');
        } elseif (!is_valid_number($quantity, 1)) {
            display_error('Quantity must be 1 or more.');
        }

        cart_add_item($product_id, $quantity);
        $cart = cart_get_items();
        include './cart_view.php';
        break;
    case 'update':
        $items = $_POST['items'];
        foreach ( $items as $product_id => $quantity ) {
            if ($quantity == 0) {
                cart_remove_item($product_id);
            } else {
                cart_update_item($product_id, $quantity);
            }
        }
        $cart = cart_get_items();
        include './cart_view.php';
        break;
    case 'confirm':
        if (isset($_POST['customer_name'])) {$customer_name = $_POST['customer_name'];}
        if (isset($_POST['customer_address'])) {$customer_address = $_POST['customer_address'];}
        if (isset($_POST['customer_phone'])) {$customer_phone = $_POST['customer_phone'];}
        if (isset($_POST['extra_information'])) {$extra_information = $_POST['extra_information'];}
        $order_id = add_order($customer_name, $customer_address, $customer_phone, $extra_information);
        foreach($cart as $product_id => $item) {
            $item_price = $item['list_price'];
            $discount = $item['discount_amount'];
            $quantity = $item['quantity'];
            add_order_item($order_id, $product_id,
                           $item_price, $discount, $quantity);
        }
        clear_cart();
        include './checkout_thankyou.php';
        break;
    case 'checkout':
        include './checkout_confirm.php';
        break;
}

?>