<?php
$address = $this->getAddress();
?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vendor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vendor Address Info</li>
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
                <h3 class="card-title">Vendor Address Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group">
                  	<input type="text" name="address[id] " value="<?php echo $address->id ?>" hidden>

                    <label for="exampleInputEmail1">Address</label>
                    <textarea class="form-control" id="address" name="address[address]" rows="5" cols="20">
                        <?php echo $address->address; ?>
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Postal Code :-</label>
                    <input type="text" id="postal" class="form-control" name="address[postal_code]" value="<?php echo $address->postal_code; ?>" placeholder="Enter Postal Code">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">City</label>

                    <input type="text" id="city" class="form-control" name="address[city]" value="<?php echo $address->city; ?>" placeholder="Enter City">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">State</label>

                    <input type="text" id="state" class="form-control" name="address[state]" value="<?php echo $address->state; ?>" placeholder="Enter State">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Country</label>

                    <input type="text" class="form-control" name="address[country]" value="<?php echo $address->country; ?>" placeholder="Enter country">

                  </div>
                  

                  
                </div>
              
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
    $("#addressSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','vendor'); ?>");
        admin.load();
    });
</script>