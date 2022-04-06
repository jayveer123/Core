<?php $admin=$this->getAdmin(); ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Info</li>
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
                <h3 class="card-title">Config Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group">

                    <input type="text" name="admin[id]" hidden value="<?php echo $admin->id; ?>" placeholder="Enter First name">

                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" name="admin[firstName]" value="<?php echo $admin->firstName; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" name="admin[lastName]" value="<?php echo $admin->lastName; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Code">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" name="admin[email]" value="<?php echo $admin->email; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Value">
                  </div>
                  
                  <?php if(!$admin->id){ ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="admin[password]" value="<?php echo $admin->password; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Code">
                  </div>
                  <?php } ?>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Stetus</label>
                    <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="radio" id="radioPrimary1" name="admin[stetus]" <?php echo ($admin->getStatus($admin->stetus)=='Active')? 'checked' : ''; ?> value="1">
                        <label for="radioPrimary1">
                          Active
                        </label>
                      </div>
                      &nbsp;
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="admin[stetus]" <?php echo ($admin->getStatus($admin->stetus)=='Inactive')? 'checked' : ''; ?> value="2">
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
                  <input type="button" id="adminSubmit" name="submit" value="Save" class="btn btn-primary">
                </div>
              
            </div>
          

          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <script>
    $("#adminSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','admin'); ?>");
        admin.load();
    });
</script>