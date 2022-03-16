<?php

$categories = $this->getCategories();



?>
<h3 align="center">Catgory Grid</h3>
<table align="center" border="1" width="100%">
	<button><a href="<?php echo $this->getUrl('category','add',[],true) ?>">Add New</a></button>
	<tr>
		<th>Category Id</th>
		<th>Category Name</th>
		<th>Category Path</th>
		<th>Category Stetus</th>
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
	if($categories){
		

		foreach($categories as $category) { ?>
		<tr>
			<td><?php echo $category->id; ?></td>
			<td><?php echo $category->c_name; ?></td>
			<td><?php echo $this->getPath($category->id,$category->path); ?></td>
			<td><?php echo $category->getStatus($category->c_stetus); ?></td>

			<td>

				<img src="<?php if($category->base){echo "Media/Category/".$category->getBase()->imageName;  }  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td>
				<img src="<?php if($category->thumb){ echo "Media/Category/".$category->getThumb()->imageName; }  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td>
				<img src="<?php if($category->small){ echo "Media/Category/".$category->getSmall()->imageName; }  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td><?php echo $category->createdDate; ?></td>
			<td><?php echo $category->updatedDate; ?></td>
			<td><a href="<?php echo $this->getUrl('category','edit',['id'=>$category->id],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('category','delete',['id'=>$category->id],true) ?>">Delete</a></td>
			<td><a href="<?php echo $this->getUrl('category_media','grid',['id'=>$category->id],true) ?>">Media</a></td>
		</tr>
		<?php 
		
		} 
	}
	else{
		echo "<tr><td align='center' colspan='9'>No Record Found</td></tr>";
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

