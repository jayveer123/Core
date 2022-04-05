<?php
$billingAddress = $this->getBillingAddress();
$shippingAddress = $this->getShippingAddress();

?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer Address Info</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Customer Address Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group">
                  	
                    <label for="exampleInputEmail1">Address</label>
                    <textarea class="form-control" id="address" name="billingaddress[address]" rows="5" cols="20">
                        <?php echo $billingAddress->address; ?>
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Postal Code :-</label>
                    <input type="text" id="postal" class="form-control" name="billingaddress[postal_code]" value="<?php echo $billingAddress->postal_code; ?>" placeholder="Enter Postal Code">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">City</label>

                    <input type="text" id="city" class="form-control" name="billingaddress[city]" value="<?php echo $billingAddress->city; ?>" placeholder="Enter City">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">State</label>

                    <input type="text" id="state" class="form-control" name="billingaddress[state]" value="<?php echo $billingAddress->state; ?>" placeholder="Enter State">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Country</label>

                    <input type="text" class="form-control" name="billingaddress[country]" id="country" value="<?php echo $billingAddress->country; ?>" placeholder="Enter country">

                  </div>
                  <input type="hidden" name="billingaddress[billing]" value="1">
                  <input type="hidden" name="billingaddress[shipping]" value="2">

                  <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" name="same" onclick="myFunction()" id="checkboxPrimary2">
                        <label for="checkboxPrimary2">
                          Same As Billing Address
                        </label>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <textarea class="form-control" id="saddress" name="shippingaddress[address]" rows="5" cols="20">
                        <?php echo $shippingAddress->address; ?>
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Postal Code :-</label>
                    <input type="text" id="spostal" class="form-control" name="shippingaddress[postal_code]" value="<?php echo $shippingAddress->postal_code; ?>" placeholder="Enter Postal Code">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">City</label>

                    <input type="text" id="scity" class="form-control" name="shippingaddress[city]" value="<?php echo $shippingAddress->city; ?>" placeholder="Enter City">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">State</label>

                    <input type="text" id="sstate" class="form-control" name="shippingaddress[state]" value="<?php echo $shippingAddress->state; ?>" placeholder="Enter State">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Country</label>

                    <input type="text" id="scountry" class="form-control" name="shippingaddress[country]" value="<?php echo $shippingAddress->country; ?>" placeholder="Enter country">

                  </div>

                  
                </div>
                <input type="hidden" name="shippingaddress[shipping]" value="1">
                <input type="hidden" name="shippingaddress[billing]" value="2">
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="button" id="addressSubmit" name="submit" value="Save" class="btn btn-primary">
                </div>
              
            </div>
          

          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   <script>
  function myFunction() {
    var checkBox = document.getElementById("checkboxPrimary2");
      if(checkBox.checked == true){
          document.getElementById("saddress").value = 
            document.getElementById("address").value; 
    
      document.getElementById("spostal").value = 
        document.getElementById("postal").value; 
      
      document.getElementById("scity").value = 
        document.getElementById("city").value; 
        
      document.getElementById("sstate").value = 
        document.getElementById("state").value; 
        
      document.getElementById("scountry").value = 
        document.getElementById("country").value; 
      }
        else{
            document.getElementById("saddress").value = null; 
            document.getElementById("spostal").value = null; 
            document.getElementById("scity").value = null; 
            document.getElementById("sstate").value = null; 
            document.getElementById("scountry").value = null; 
        }
  }
  </script>
  <script>
    $("#addressSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>