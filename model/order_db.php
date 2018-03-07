<?php
function add_order($customer_name, $customer_address, $customer_phone,$extra_information) {
    global $db;
    $order_date = date("Y-m-d H:i:s");
    

    $query = 'INSERT INTO orders (orderDate, customerName, customerAddress,
        customerPhone,extraInformation)
            VALUES (:order_date, :customer_name, :customer_address,
            :customer_phone, :extra_information)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_date', $order_date);
    $statement->bindValue(':customer_name', $customer_name);
    $statement->bindValue(':customer_address', $customer_address);
    $statement->bindValue(':customer_phone', $customer_phone);
    $statement->bindValue(':extra_information', $extra_information);
    $statement->execute();
    $order_id = $db->lastInsertId();
    $statement->closeCursor();
    return $order_id;
}

function add_order_item($order_id, $product_id,
                        $item_price, $discount, $quantity) {
    global $db;
    $query = '
        INSERT INTO OrderItems (orderID, productID, itemPrice,
                                discountAmount, quantity)
        VALUES (:order_id, :product_id, :item_price, :discount, :quantity)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':item_price', $item_price);
    $statement->bindValue(':discount', $discount);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
}

function get_order($order_id) {
    global $db;
    $query = 'SELECT * FROM orders WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order = $statement->fetch();
    $statement->closeCursor();
    return $order;
}

function get_orders() {
    global $db;
    $query = 'SELECT * FROM orders';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

function get_order_items($order_id) {
    global $db;
    $query = 'SELECT * FROM OrderItems WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order_items = $statement->fetchAll();
    $statement->closeCursor();
    return $order_items;
}

function delete_order($order_id) {
    global $db;
    $query = 'DELETE FROM orders WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}
?>