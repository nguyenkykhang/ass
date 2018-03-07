<?php include '../view/header.php'; ?>
<div id="content">
    <h1>Confirm Order</h1>
    <table id="cart">
        <tr id="cart_header">
            <th class="left" >Item</th>
            <th class="right">Price</th>
            <th class="right">Quantity</th>
            <th class="right">Total</th>
        </tr>
        <?php foreach ($cart as $product_id => $item) : ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item['unit_price']); ?>
                </td>
                <td class="right">
                    <?php echo $item['quantity']; ?>
                </td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item['line_price']); ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
    <form action="." method="post">
        <input type="hidden" name="action" value="confirm"/>
        <label>Your name: </label><input type="text" name="customer_name"/>
        <br/>
        <label>Your address: </label><input type="text" name="customer_address"/>
        <br/>
        <label>Your phone: </label><input type="text" name="customer_phone"/>
        <br/>
        <label>extra information: </label><input type="text" name="extra_information"/>
        <br/>
        <input type="submit" value="Confirm"/>
    </form>
</div>
<?php include '../view/footer.php'; ?>