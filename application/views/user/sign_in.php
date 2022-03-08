<div class="container">
<h1>Sign In</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-12">
            <form action="" method="post" onsubmit="return false;" name="frmSignin" id="frmSignin">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input class="text email form-control" type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input class="text form-control" type="password" name="password" id="password" placeholder="Password" >
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-info" value="SIGN IN">
                    <a href="<?php echo base_url('sign_up'); ?>" class="btn btn-info" >Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</div>