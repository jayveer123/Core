<?php $products = $this->getProducts(); ?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable</h3>
                
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                
                          <button type="button" id="customerPriceSubmitBtn" class="col-md-2 btn btn-block btn-success" <?php echo (!$products) ? 'disabled' : ''; ?>>Save</button>

                          <button type="button" class="col-md-2 btn btn-block btn-danger" id="customerPriceCancelBtn">Cancel</button>
                        
                <br>

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>MRP</th>
                        <th>SalesMen Price</th>
                        <th>Discount</th>
                    </tr>
                  </thead>
                  <tbody>
                         <?php if($products){ ?>
            <?php $i = 0; ?>
            <?php foreach($products as $product){ ?>
                <tr>
                    <input type="hidden" name="product[<?php echo $i ?>][product_id]" value="<?php echo $product->id; ?>">

                    <input type="hidden" name="product[<?php echo $i ?>][salesmenPrice]" value="<?php echo $this->getSalesmanPrice($product->id); ?>">

                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->p_name; ?></td>
                    <td><?php echo $product->p_price; ?></td>
                    <td><?php echo $this->getSalesmanPrice($product->id); ?></td>
                    <td><input type="text" name="product[<?php echo $i ?>][discount]" value="<?php echo $this->getDiscount($product->id) ?>"></td>
                </tr>
            <?php $i++; ?>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspacing = "6">No Product Found</td>
            </tr>
        <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>MRP</th>
                        <th>SalesMen Price</th>
                        <th>Discount</th>
                    </tr>
                  </tfoot>
                </table>

                </div>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <script>
    $("#customerPriceSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('save','customer_price'); ?>");
        admin.load();
    });

    $("#customerPriceCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>