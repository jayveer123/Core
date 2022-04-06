<?php 

$order = $this->getOrder();
$billingAddress = $order->getBillingAddress();
$shippingAddress = $order->getShippingAddress();

$items = $order->getItems();
$comment = $order->getComment(); ?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Order</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4 align="center">
                    <i class="fas fa-globe"></i> Order.
                    <br>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Billing Address
                  <address>
                    <strong><?php echo $billingAddress->firstName." ".$billingAddress->lastName; ?></strong><br>

                    <?php echo $billingAddress->address; ?>, <?php echo $billingAddress->city; ?><br>
                    <?php echo $billingAddress->state; ?>, <?php echo $billingAddress->postal_code; ?><br>
                    <?php echo $billingAddress->country; ?><br>
                    Phone: <?php echo $billingAddress->mobile; ?><br>
                    Email: <?php echo $billingAddress->email; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Shipping Address
                  <address>
                    <strong><?php echo $shippingAddress->firstName." ".$shippingAddress->lastName; ?></strong><br>
                    <?php echo $shippingAddress->address; ?>, <?php echo $shippingAddress->city; ?><br>
                    <?php echo $shippingAddress->state; ?>, <?php echo $shippingAddress->postal_code; ?><br>
                    <?php echo $shippingAddress->country; ?><br>
                    Phone: <?php echo $shippingAddress->mobile; ?><br>
                    Email: <?php echo $shippingAddress->email; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b></b><br>
                  <br>
                  <b>Order ID:</b> <?php echo $order->order_id; ?><br>
                  <b>Ganrated Date:</b> <?php echo $order->createdDate; ?><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item Id</th>
                        <th>Order Id</th>
                        <th>Product Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Tax Amount</th>
                        <th>Discount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!$items): ?>
                    <tr>
                        <td colspan="6">no item found</td>
                    </tr>
                    <?php else: ?>
                    <?php $i = 0; ?>
                    <?php foreach($items as $item): ?>
                    <tr>
                        <td><?php echo $item->item_id ?></td>
                        <td><?php echo $item->order_id ?></td>
                        <td><?php echo $item->product_id ?></td>
                        <td><img src="Media/Product/<?php echo $item->getProduct()->getBase()->imageName; ?>" alt="image not found" width="50" hight="50"></td>
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->quntity; ?></td>
                        <td><?php echo $item->price; ?></td>
                        <td><?php echo $item->tax; ?></td>
                        <td><?php echo $item->taxAmount; ?></td>
                        <td><?php echo $item->discount; ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <?php endif;?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Shipping Charge:</th>
                        <td><?php echo $order->shippingCharge; ?></td>
                      </tr>
                      <tr>
                        <th>Grand Total</th>
                        <td><?php echo $order->grandTotal; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Order Track</h3>
    </div>
    <div class="card-body" id="orderStatus">
        <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Note</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="order[note]" value="<?php echo $comment->note ?>" class="form-control" id="note" placeholder="Note">
            </div>
        </div>
        <div class="form-group row">
            <label for="order[status]" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="order[status]">
                    <option value="1" <?php echo ($order->getStatus($order->status) == 'Pending')?'selected':'' ?>>Pending</option>
                    <option value="2" <?php echo ($order->getStatus($order->status) == 'Processing')?'selected':'' ?>>Processing</option>
                    <option value="3" <?php echo ($order->getStatus($order->status) == 'Completed')?'selected':'' ?>>Completed</option>
                    <option value="4" <?php echo ($order->getStatus($order->status) == 'Cancelled')?'selected':'' ?>>Cancelled</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="order[state]" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <select class="form-control" name="order[state]">
                    <option value="1" <?php echo ($order->getState($order->state) == 'Pending')?'selected':'' ?>>Pending</option>
                    <option value="2" <?php echo ($order->getState($order->state) == 'Packaging')?'selected':'' ?>>Packaging</option>
                    <option value="3" <?php echo ($order->getState($order->state) == 'Shipped')?'selected':'' ?>>Shipped</option>
                    <option value="4" <?php echo ($order->getState($order->state) == 'Delivery')?'selected':'' ?>>Delivery</option>
                    <option value="5" <?php echo ($order->getState($order->state) == 'Dispatched')?'selected':'' ?>>Dispatched</option>
                    <option value="6" <?php echo ($order->getState($order->state) == 'Completed')?'selected':'' ?>>Completed</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="order[customerNotified]" class="col-sm-2 col-form-label">Send Customer Notification?</label>
            <div class="col-sm-10">
                <select class="form-control" name="order[customerNotified]">
                    <option value="1" <?php echo ($comment->customerNotified == 1)?'selected':'' ?>>Yes</option>
                    <option value="2" <?php echo ($comment->customerNotified == 2)?'selected':'' ?>>No</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="orderStatusUpdateBtn">Save</button>
            <button type="button" class="btn btn-primary" id="orderCancelBtn">Cancel</button>
        </div>
    </div>


<script type="text/javascript">
    $("#orderStatusUpdateBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('statusUpdate','order'); ?>");
        admin.setType('POST');
        admin.load();
    });

    $("#orderCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','cart',['id' => null]); ?>");
        admin.load();
    })
</script>