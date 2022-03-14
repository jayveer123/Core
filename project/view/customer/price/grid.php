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
        <tr>
            
            <td colspan="10" align="right">
                <script type="text/javascript">
                    function pprFunction()
                    {
                        const pprValue = document.getElementById('ppr').selectedOptions[0].value;
                        let url = window.location.href;
                        
                        if(!url.includes('ppr'))
                        {
                            url+='&ppr=20';
                        }
                        const urlArray = url.split("&");

                        for (i = 0; i < urlArray.length; i++)
                        {
                            if(urlArray[i].includes('p='))
                            {
                                urlArray[i] = 'p=1';
                            }
                            if(urlArray[i].includes('ppr='))
                            {
                                urlArray[i] = 'ppr=' + pprValue;
                            }
                        }
                        const finalUrl = urlArray.join("&");  
                        location.replace(finalUrl);
                    }
                </script>
        
                <select id="ppr" onchange="pprFunction()">
                    <option selected>select</option>
                        <?php foreach ($this->pager->perPageCountOption as $pageCount):?>
                    <option value="<?php echo $pageCount?>"><?php echo $pageCount?></option>
                        <?php endforeach; ?>
                </select>


                <button>
                    <a href="<?php echo ($this->pager->getStart()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>">
                        Start
                    </a>
                </button>

                <button>
                    <a href="<?php echo ($this->pager->getPrev()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>">
                        Prev
                    </a>
                </button>

                <button>
                    <a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getCurrent()]) ?>">Current</a>
                </button>

                <button>
                    <a href="<?php echo ($this->pager->getNext()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>">
                        Next
                    </a>
                </button>
                <button>
                    <a href="<?php echo ($this->pager->getEnd()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>">
                        End
                    </a>
                </button>

            </td>
        </tr>
    </table>
</form>