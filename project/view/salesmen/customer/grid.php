<?php 
$customers = $this->getCustomers();
?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Price Information</h3>
    </div>
    <div class="card-body">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Select</th>
                <th>Customer Id</th>
                <th>First Name</th>
                <th>Last Name</th>    
            </tr>
            
        </thead>
        <tbody>
        <?php if(!$customers): ?>
                <tr>
                    <td colspan="4">No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <div class="row">
                    <div class="col-sm-2">
                        <td><input type="checkbox" name="customer[]" value='<?php echo $customer->id; ?>' <?php echo $this->selected($customer->id); ?> ></td>
                    </div>
                
                    <div class="col-sm-2">
                        <td><?php echo $customer->id; ?></td>
                    </div>
                
                    <div class="col-sm-2">
                        <td><?php echo $customer->firstName; ?></td>
                    </div>
                
                    <div class="col-sm-2">
                        <td><?php echo $customer->lastName; ?></td>
                    </div>
                </div>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    </table>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-info" id="customerManageSubmit" <?php echo (!$customers) ? 'disabled' : ''; ?>>Save</button>
        <button type="button" class="btn btn-default" id="customerManageCancel">Cancel</button>
    </div>
</div>
<script>
    $("#customerManageSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('save','Salesmen_SalesmenCustomer'); ?>");
        admin.load();
    });

    $("#customerManageCancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','salesmen'); ?>");
        admin.load();
    });
</script>