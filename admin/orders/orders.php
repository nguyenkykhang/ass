<?php include 'view/header.php'; ?>
<?php include 'view/sidebar_admin.php'; ?>
<div id="content">
    <h1>Orders</h1>
    <?php if (count($new_orders) > 0 ) : ?>
        <ul>
            <?php foreach($new_orders as $order) :
                $order_id = $order['orderID'];
                $order_date = strtotime($order['orderDate']);
                $order_date = date('M j, Y', $order_date);
                $url = $app_path . 'admin/orders' .
                       '?action=view_order&order_id=' . $order_id;
                ?>
                <li>
                    <a href="<?php echo $url; ?>">Order # 
                    <?php echo $order_id; ?></a> placed on
                    <?php echo $order_date; ?>
                    <?php echo '   '; ?>
                    <form method="post" action=".">
                        <input type="hidden" name="action" value="delete"/>
                        <input type="hidden" name="order_id" value="<?php echo $order_id?>"/>
                        <input type="submit" value="Delete"/>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<?php include 'view/footer.php'; ?>