
<table class="products-list">
    <tbody>
    <tr>
        <?php foreach ($goods as $item) { ?>
            <td>
                <header class="product-title"><?php print $item['title']; ?></header>
                <p class="price"><?php print $item['brand']; ?></p>
                <p class="price"><?php print $item['price']; ?></p>

                <?php print form_open('Cart/addToCart'); ?>
                    <?php echo form_input('count', '1', 'maxlength="2"'); ?>
                    <?php echo form_hidden('id', $item['id']); ?>
                    <?php echo form_submit('addToCart', 'Купить'); ?>
                <?php print form_close(); ?>
            </td>
        <?php } ?>
    </tr>
    </tbody>
</table>