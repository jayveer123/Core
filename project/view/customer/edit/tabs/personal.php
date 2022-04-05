<?php $customer = $this->getCustomer(); ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer Personal Info</li>
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
                <h3 class="card-title">Customer Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group">
                  	<input type="text" name="customer[id]" value="<?php echo $customer->id; ?>" hidden>

                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" name="customer[firstName]" value="<?php echo $customer->firstName; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" name="customer[lastName]" value="<?php echo $customer->lastName; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter LastName">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" name="customer[email]" value="<?php echo $customer->email; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Email">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input type="number" name="customer[mobile]" value="<?php echo $customer->mobile; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Stetus</label>
                    <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                      	<input type="radio" id="radioPrimary1" name="customer[stetus]" <?php echo ($customer->getStatus($customer->stetus)=='Active')? 'checked' : ''; ?> value="1">
                        <label for="radioPrimary1">
                        	Active
                        </label>
                      </div>
                      &nbsp;
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="customer[stetus]" <?php echo ($customer->getStatus($customer->stetus)=='Inactive')? 'checked' : ''; ?> value="2">
                        <label for="radioPrimary2">
                        	Inactive
                        </label>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="button" id="custSubmit" name="submit" value="Save" class="btn btn-primary">
                </div>
              
            </div>
          

          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <script>
    $("#custSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>