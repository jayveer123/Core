<?php 

$configs = $this->getConfigs();

?>


<h3 align="center">* Config Grid *</h3>
	
	<table border="1" width="100%" cellspacing="4">

		<button><a href="<?php echo $this->getUrl('config','add') ?>">Add New</a></button>
		
		<tr>
			<th>Config Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Value</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$configs):  ?>
			<tr><td colspan="8">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($configs as $config): ?>
			<tr>
				<td><?php echo $config->id ?></td>
				<td><?php echo $config->name ?></td>
				<td><?php echo $config->code ?></td>
				<td><?php echo $config->value ?></td>
				<td><?php echo $config->getStatus($config->status)?></td>
				<td><?php echo $config->createdDate ?></td>
				<td><?php echo $config->updatedDate ?></td>
				<td><a href="<?php echo $this->getUrl('config','edit',['id'=>$config->id],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('config','delete',['id'=>$config->id],true) ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
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
