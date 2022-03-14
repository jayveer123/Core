<?php $admins=$this->getAdmins(); ?>

<h3 align="center">* Admin Grid *</h3>
	<table border="1" width="100%" cellspacing="4">
		<button><a href="<?php echo $this->getUrl('admin','add') ?>">Add New</a></button>
		<tr>
			<th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php 
		if($admins){

			$id=1;

			foreach($admins as $admin) { ?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $admin->firstName; ?></td>
				<td><?php echo $admin->lastName; ?></td>
				<td><?php echo $admin->email; ?></td>
				<td><?php echo $admin->password; ?></td>
				<td><?php echo $admin->getStatus($admin->stetus) ?></td>
				<td><?php echo $admin->createdDate; ?></td>
				<td><?php echo $admin->updatedDate; ?></td>
				<td><a href="<?php echo $this->getUrl('admin','edit',['id'=>$admin->id],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('admin','delete',['id'=>$admin->id],true) ?>">Delete</a></td>
			</tr>
			<?php 
			$id++;
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
	
