<div class="container">
      
<div class="row my-4">
  <div class="col-6">
    <input type="button" class="btn btn-info" id="btnAttachProduct" value="Attach Product" />
  </div>
  <div class="col-6">
    <a href="<?php echo base_url('logout'); ?>" class="btn btn-info" style="float:right;" >Logout</a>
  </div>
</div>

  
<div class="row">
  <div class="col-12 col-xl-12 mb-lg-0">
      <div class="card">
        <h1 class="card-header">Product List</h1>
          <div class="card-body">
              <div class="table-responsive" >
                  <table class="table w-100" id="user_product_list">
                      <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
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

<!-- Modal -->
<div class="modal" id="attachProductModal" tabindex="-1" role="dialog" aria-labelledby="attachProductModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <form action="" id="frmAttachProduct" name="frmAttachProduct" onsubmit="return false">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attachProductModalLabel">Attach Product</h5>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Product : </label>
            <select name="product_id" id="product_id" class="form-control" >
              <option value="">Select Product</option>
              <?php if(!empty($products)) { 
                foreach($products as $product) {?>
                <option value="<?php echo $product['id']; ?>"><?php echo $product['title']; ?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="qty" class="col-form-label">Quantity : </label>
            <input type="text" id="qty" name="qty" class="form-control" />
          </div>
          <div class="form-group">
            <label for="number" class="col-form-label">Price : </label>
            <input type="number" id="price" name="price" class="form-control" />
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btnAttachProduct">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/product.js'); ?>" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        test.product.initialize();
        test.product.load_user_product_list();

        $("#btnAttachProduct").on("click", function(){
          $("#attachProductModal").modal("show");
        })
    });
</script>

