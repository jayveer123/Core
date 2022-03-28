<?php $availabeCustomers = $this->getAvailableCustomers(); ?>
<?php $salesmenCustomers = $this->getCustomers(); ?>

<table border="1" align="center" width="100%">
	<tr>
		<th colspan="5"><h3>All Customer Assign You</h3></th>
	</tr>
	<tr>
		<th>Customer Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Mobile</th>
	</tr>
	<?php 
	if($salesmenCustomers){

		$id=1;

		foreach($salesmenCustomers as $customer) { ?>
		<tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $customer->firstName; ?></td>
			<td><?php echo $customer->lastName; ?></td>
			<td><?php echo $customer->email; ?></td>
			<td><?php echo $customer->mobile; ?></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='5'>No Record Found</td></tr>";
	} 
	?>
</table>

<br><br><br><br>
<form action="<?php echo $this->getUrl('save','salesmen_salesmenCustomer',['id'=> $this->getSalesmenId()],true) ?>" method="post">

<table border="1" align="center" width="100%">
	<tr>
		<th><input type="submit" value="save"></th>
		<th colspan="5"><h3>All Available Customer</h3></th>
	</tr>
	<tr>
		<th>Action</th>
		<th>Customer Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Mobile</th>
	</tr>
	<?php 
	if($availabeCustomers){

		$id=1;

		foreach($availabeCustomers as $customer) { ?>
		<tr>
			<td><input type="checkbox" name="customer[]" value='<?php echo $customer->id; ?>'></td>
			<td><?php echo $id; ?></td>
			<td><?php echo $customer->firstName; ?></td>
			<td><?php echo $customer->lastName; ?></td>
			<td><?php echo $customer->email; ?></td>
			<td><?php echo $customer->mobile; ?></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='6'>No Record Found</td></tr>";
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
</form>