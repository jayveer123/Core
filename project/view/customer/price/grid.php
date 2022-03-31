<?php

$products = $this->getProducts();

?>
    <input type="button" id="priceSave" value="save">
    <button type="button" id="cancel">Cancel</button>
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>Name</th>
            <th>MRP</th>
            <th>SalesMen Price</th>
            <th>Discount</th>
        </tr>
        <?php if($products){ ?>
            <?php $i = 0; ?>
            <?php foreach($products as $product){ ?>
                <tr>
                    <input type="hidden" name="product[<?php echo $i ?>][product_id]" value="<?php echo $product->id; ?>">

                    <input type="hidden" name="product[<?php echo $i ?>][salesmenPrice]" value="<?php echo $this->getSalesmanPrice($product->id); ?>">

                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->p_name; ?></td>
                    <td><?php echo $product->p_price; ?></td>
                    <td><?php echo $this->getSalesmanPrice($product->id); ?></td>
                    <td><input type="text" name="product[<?php echo $i ?>][discount]" value="<?php echo $this->getDiscount($product->id) ?>"></td>
                </tr>
            <?php $i++; ?>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspacing = "6">No Product Found</td>
            </tr>
        <?php } ?>
       
    </table>

<script>
    $("#priceSave").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('save','customer_price'); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>