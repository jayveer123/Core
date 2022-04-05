<?php $page=$this->getPage();  ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Page Info</li>
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
                <h3 class="card-title">Page Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group">
                  	<input type="text" name="page[id]" value="<?php echo $page->id ?>" hidden>

                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="page[name]" value="<?php echo $page->name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Code</label>
                    <input type="text" name="page[code]" value="<?php echo $page->code ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter LastName">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Value</label>
                    <textarea rows="10" name="page[content]" cols="20" class="form-control"><?php echo $page->content ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Stetus</label>
                    <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                      	<input type="radio" id="radioPrimary1" name="page[status]" <?php echo ($page->getStatus($page->status)=='Active')? 'checked' : ''; ?> value="1">
                        <label for="radioPrimary1">
                        	Active
                        </label>
                      </div>
                      &nbsp;
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="page[status]" <?php echo ($page->getStatus($page->status)=='Inactive')? 'checked' : ''; ?> value="2">
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
                  <input type="button" id="pageSubmit" name="submit" value="Save" class="btn btn-primary">
                </div>
              
            </div>
          

          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <script>
    $("#pageSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','page'); ?>");
        admin.load();
    });
</script>