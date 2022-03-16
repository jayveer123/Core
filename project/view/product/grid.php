<?php
error_reporting(0);

$products=$this->getProducts();

?>

<h3 align="center">* Product Grid *</h3>

<table align="center" border="1" width="100%">
	<button><a href="<?php echo $this->getUrl('product','add') ?>">Add New</a></button>
	<tr>
		<th>Product Id</th>
		<th>Product Name</th>
		<th>Product Price</th>
		<th>Product MSP</th>
		<th>Product Cost Price</th>
		<th>Product SKU</th>
		<th>Product Quntity</th>
		<th>Product Stetus</th>
		<th>Base</th>
		<th>Thumb</th>
		<th>Small</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Media</th>
	</tr>
	<?php 
	if($products){

		$id=1;

		foreach($products as $product) { ?>
		<tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $product->p_name; ?></td>
			<td><?php echo $product->p_price; ?></td>
			<td><?php echo $product->msp; ?></td>
			<td><?php echo $product->cost_price; ?></td>
			<td><?php echo $product->sku; ?></td>
			<td><?php echo $product->p_qun; ?></td>
			<td><?php echo $product->getStatus($product->p_stetus) ?></td>

			<td>
				<img src="<?php echo "Media/Product/".$this->getMedia($product->base)['imageName']  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td>
				<img src="<?php echo "Media/Product/".$this->getMedia($product->thumb)['imageName']  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td>
				<img src="<?php echo "Media/Product/".$this->getMedia($product->small)['imageName']  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td><?php echo $product->createdDate; ?></td>
			<td><?php echo $product->updatedDate; ?></td>
			<td><a href="<?php echo $this->getUrl('product','edit',['id'=>$product->id],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('product','delete',['id'=>$product->id],true) ?>">Delete</a></td>
			<td><a href="<?php echo $this->getUrl('product_media','grid',['id'=>$product->id],true) ?>">Media</a></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='16'>No Record Found</td></tr>";
	} 
	?>
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
