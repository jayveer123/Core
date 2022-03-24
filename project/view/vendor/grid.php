<?php

$vendors=$this->getVendors();

?>

	<h3 align="center">* Vendor Grid *</h3>
	
	<table border="1" width="100%" cellspacing="4">
		<button><a href="<?php echo $this->getUrl('vendor','add') ?>">Add New</a></button>
		<tr>
			<th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Address</th>
			<th>Postal</th>
			<th>City</th>
			<th>State</th>
			<th>Country</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if($vendors){ ?>
			<?php foreach ($vendors as $vendor) { ?>
			<tr>
				<td><?php echo $vendor->id; ?></td>
				<td><?php echo $vendor->firstName; ?></td>
				<td><?php echo $vendor->lastName; ?></td>
				<td><?php echo $vendor->email; ?></td>
				<td><?php echo $vendor->mobile; ?></td>
				<td><?php echo $vendor->getStatus($vendor->status) ?></td>
				<td><?php echo $vendor->createdDate; ?></td>
				<td><?php echo $vendor->updatedDate; ?></td>
				<?php $address = $vendor->getAddress(); ?>
					<td><?php echo $address->address; ?></td>
					<td><?php echo $address->postal_code; ?></td>
					<td><?php echo $address->city; ?></td>
					<td><?php echo $address->state; ?></td>
					<td><?php echo $address->country; ?></td>
				<td>
					<a href="<?php echo $this->getUrl('vendor','edit',['id'=>$vendor->id],true) ?>">Edit</a>
				</td>
				<td>
					<a href="<?php echo $this->getUrl('vendor','delete',['id'=>$vendor->id],true)?>">Delete</a>
				</td>
			<tr>
			<?php } ?>
		<?php }else{ ?>
			<tr><td colspan="15">No Record Found</td></tr>
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
