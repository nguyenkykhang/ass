<?php include '../view/header.php'; ?>
<div id="content">
    <h1>“Your cart has been process!"</h1>
    <p>Return to: <a href="../">Home</a></p>

    <!-- display most recent category -->
    <?php if (isset($_SESSION['last_category_id'])) :
            $category_url = '../catalog' .
                '?category_id=' . $_SESSION['last_category_id'];
        ?>
        <p>Return to: <a href="<?php echo $category_url; ?>">
            <?php echo $_SESSION['last_category_name']; ?></a></p>
    <?php endif; ?>
</div>
<?php include '../view/footer.php'; ?>
