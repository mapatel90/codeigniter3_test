<div class="container">
<div class="row my-4">   
    <div class="col-6">
        <a href="<?php echo base_url('logout'); ?>" class="btn btn-info" />Logout</a>
    </div>   
    <div class="col-6">
        <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-info" style="float:right;" />Back</a>
    </div>
</div>   
<div class="row my-4">
  
</div>

  
<div class="row">
  <div class="col-12 col-xl-12 mb-lg-0">
      <div class="card">
        <h1 class="card-header">Seller List <?php echo isset($product['title'])?' - '.$product['title']:''; ?></h1> 
          <div class="card-body">
              <div class="table-responsive" >
                  <table class="table w-100" id="product_seller_list">
                      <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Seller Name</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
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
        test.product.load_user_product_seller('<?php echo $id; ?>');
    });
</script>

