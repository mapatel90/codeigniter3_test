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
          <h5 class="card-header">Active User with Attach Product</h5>
          <div class="card-body">
            <h5 class="card-title"><?php echo isset($active_users_with_attached_product)?$active_users_with_attached_product:0; ?></h5>
          </div>
        </div>
  </div>
  <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
      <div class="card">
          <h5 class="card-header">Active Product</h5>
          <div class="card-body">
            <h5 class="card-title"><?php echo isset($active_products)?$active_products:0; ?></h5>
          </div>
        </div>
  </div>
  <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
      <div class="card">
          <h5 class="card-header">Active Product without User Attached</h5>
          <div class="card-body">
            <h5 class="card-title"><?php echo isset($active_products_without_users)?$active_products_without_users:0; ?></h5>
          </div>
        </div>
  </div>

  <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
      <div class="card">
          <h5 class="card-header">Amount of all active attached products</h5>
          <div class="card-body">
            <h5 class="card-title"><?php echo isset($amount_of_active_product)?$amount_of_active_product:0; ?></h5>
          </div>
        </div>
  </div>

  <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
      <div class="card">
          <h5 class="card-header">Summarized price of all active attached products</h5>
          <div class="card-body">
            <h5 class="card-title"><?php echo isset($total_price_of_active_product)?'$'.$total_price_of_active_product:0; ?></h5>
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
        test.product.load_user_product_list();
    });
</script>

