<?php

$products = $this->getProducts();

?>

<form action="<?php echo $this->getUrl('customer_price','save') ?>" method="post">
    <input type="submit" value="save">
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>Name</th>
            <th>MRP</th>
            <th>MSP</th>
            <th>Cost</th>
            <th>Discount</th>
        </tr>
        <?php if($products){ ?>
            <?php $i = 0; ?>
            <?php foreach($products as $product){ ?>
                <tr>
                    <input type="hidden" name="product[<?php echo $i ?>][product_id]" value="<?php echo $product->id; ?>">
                    <input type="hidden" name="product[<?php echo $i ?>][msp]" value="<?php echo $product->msp; ?>">
                    <input type="hidden" name="product[<?php echo $i ?>][mrp]" value="<?php echo $product->p_price; ?>">

                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->p_name; ?></td>
                    <td><?php echo $product->p_price; ?></td>
                    <td><?php echo $product->msp ?></td>
                    <td><?php echo $product->cost_price ?></td>
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
</form>