<div class="login-box mx-auto">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">

		<form action="<?php echo $this->getUrl('loginPost','admin_login') ?>" method="post">
	        <div class="input-group mb-3">
	          <input type="email" name="admin[email]" class="form-control" placeholder="Email">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-envelope"></span>
	            </div>
	          </div>
	        </div>
	        <div class="input-group mb-3">
	          <input type="password" name="admin[password]" class="form-control" placeholder="Password">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-lock"></span>
	            </div>
	          </div>
	        </div>
	        <div class="row">
	          
	          <!-- /.col -->
	          <div class="col-4">
	            <input type="submit" class="btn btn-primary btn-block" value="Sign In">
	          </div>
	          <!-- /.col -->
	        </div>
      </form>

		
	      

	</div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>