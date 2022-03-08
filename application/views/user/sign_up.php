<div class="container">
<h1>SignUp</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-12">
            <form action="" method="post" onsubmit="return false;" name="frmSignup" id="frmSignup">
                <div class="form-group text-left">
                    
                        <label for="username" class="form-label">User Name</label>
                        <input class="text form-control" type="text" name="username" id="username" placeholder="Username">
                    
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input class="text email form-control" type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input class="text form-control" type="password" name="password" id="password" placeholder="Password" >
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">User Type</label>
                    <select class="form-control" name="role" id="role">
                        <option value="<?php echo ROLE_USER; ?>">User</option>
                        <option value="<?php echo ROLE_ADMIN; ?>">Admin</option>
                    </select>
                </div>

                <div class="form-group mt-1">
                        <input type="checkbox" class="checkbox" id="term_condition" name="term_condition" /> I Agree To The Terms & Conditions
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-info" value="Sign Up">
                    <a href="<?php echo base_url('sign_in'); ?>" class="btn btn-info ml-1" >Sign In</a>
                </div>
            </form>
        </div>
    </div>
</div>