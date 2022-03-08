<div class="container">
<div class="row my-4">   
    <div class="col-2">
        <a href="<?php echo base_url('logout'); ?>" class="btn btn-info" />Logout</a>
    </div>   
</div>   
<div class="row my-4">
  <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <div class="card border border-primary">
          <h5 class="card-header">Active Users</h5>
          <div class="card-body">
            <h5 class="card-title"><?php echo isset($active_users)?$active_users:0; ?></h5>
          </div>
        </div>
  </div>
  <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
      <div class="card border">
          <h5 class="card-header">Revenue</h5>
          <div class="card-body">
            <h5 class="card-title">$2.4k</h5>
            <p class="card-text">Feb 1 - Apr 1, United States</p>
            <p class="card-text text-success">4.6% increase since last month</p>
          </div>
        </div>
  </div>
  <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
      <div class="card">
          <h5 class="card-header">Purchases</h5>
          <div class="card-body">
            <h5 class="card-title">43</h5>
            <p class="card-text">Feb 1 - Apr 1, United States</p>
            <p class="card-text text-danger">2.6% decrease since last month</p>
          </div>
        </div>>
  </div>
  <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
      <div class="card">
          <h5 class="card-header">Traffic</h5>
          <div class="card-body">
            <h5 class="card-title">64k</h5>
            <p class="card-text">Feb 1 - Apr 1, United States</p>
            <p class="card-text text-success">2.5% increase since last month</p>
          </div>
        </div>
  </div>
</div>

  
<div class="row">
  <div class="col-12 col-xl-12 mb-lg-0">
      <div class="card">
        <h1 class="card-header">Product List</h1>
          <div class="card-body">
              <div class="table-responsive" >
                  <table class="table w-100" id="product_list">
                      <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
              </div>
                
          </div>
      </div>
  </div>
  <div class="col-12 col-xl-4">
      <!-- Another widget will go here -->
  </div>
</div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        test.product.initialize();
    });
</script>

