<?php

$product=$this->getProduct(); 

?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Info</li>
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
                <h3 class="card-title">Product Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
                <div class="card-body">
                  <div class="form-group">
                  	<input type="text" name="product[id]" value="<?php echo $product->id; ?>" hidden />

                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" name="product[p_name]" id="pname" value="<?php echo $product->p_name; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="float" name="product[p_price]" value="<?php echo $product->p_price; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter LastName">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Tax</label>
                    <input type="float" name="product[tax]" value="<?php echo $product->tax; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Email">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Msp</label>
                    <input type="float" name="product[msp]" value="<?php echo $product->msp; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Cost Price</label>
                    <input type="float" name="product[cost_price]" value="<?php echo $product->cost_price; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">SKU</label>
                    <input type="text" name="product[sku]" value="<?php echo $product->sku; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Discount</label>
                    <input type="text" name="product[discount]" value="<?php echo $product->discount ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile">

                    In Percentage:<input type="radio" name="discountMethod" value="1">&nbsp;&nbsp;&nbsp;
                    In Money:<input type="radio" name="discountMethod" value="2" checked>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Qyntity</label>
                    <input type="number" name="product[p_qun]" value="<?php echo $product->p_qun; ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Mobile">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Stetus</label>
                    <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                      	<input type="radio" id="radioPrimary1" name="product[stetus]" <?php echo ($product->getStatus($product->stetus)=='Active')? 'checked' : ''; ?> value="1">
                        <label for="radioPrimary1">
                        	Active
                        </label>
                      </div>
                      &nbsp;
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="radioPrimary2" name="product[stetus]" <?php echo ($product->getStatus($product->stetus)=='Inactive')? 'checked' : ''; ?> value="2">
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
                  <input type="button" id="productSubmit" class="btn btn-primary" name="submit" value="save">
                  <button type="button" id="productCancel" class="btn btn-danger" >Cancel</button>
                </div>
              
            </div>
          

          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   <script type="text/javascript">

jQuery("#productCancel").click(function(){
  admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
  admin.load();
});

jQuery("#productSubmit").click(function(){
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
  admin.load();
});
</script>