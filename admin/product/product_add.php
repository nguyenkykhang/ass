<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>
<div id="content">
    <h1>Product Manager - Add Product</h1>
    <form action="index.php" method="post" id="add_product_form">
            <input type="hidden" name="action" value="add_product" />

        <label>Category:</label>
        <select name="category_id">
        <?php foreach ($categories as $category) : ?>
            <option value="<?php echo $category['categoryID']; ?>">
                <?php echo $category['categoryName']; ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br />

        <label>Code:</label>
        <input type="input" name="code"
               value="" />
        <br />

        <label>Name:</label>
        <input type="input" name="name" 
               value="" size="50" />
        <br />

        <label>List Price:</label>
        <input type="input" name="price" 
               value="" />
        <br />

        <label>Discount Percent:</label>
        <input type="input" name="discount_percent" 
               value="" />
        <br />

        <label>Description:</label>
        <textarea name="description" rows="10"
                  cols="50"></textarea>
        <br />

        <label>&nbsp;</label>
        <input type="submit" value="Submit" />
        
    </form>
</div>
<?php include '../../view/footer.php'; ?>
