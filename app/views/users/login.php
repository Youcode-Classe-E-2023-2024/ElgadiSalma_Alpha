<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Login</h2>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-group">
                    <label>Email:<sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-lg">
                    <span class="invalid-feedback"><?php if(!empty($email_err)) { echo $email_err; } ?></span>
                </div>
                <div class="form-group">
                    <label>Password:<sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg">
                    <span class="invalid-feedback"><?php if(!empty($password_err)) { echo $password_err; } ?></span>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-block" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
