

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 ">Change your password for</h1>
                    <h5 class="mb-4"><?= $this->session->userdata('reset_email');?></h5>
                  </div>
                  <?= $this->session->flashdata('message'); ?>
                  <form class="user" method="post" action="<?= base_url('auth/changepassword');?>">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password1"  name="password1" placeholder="Enter New Password...">
                        <?= form_error ('password1','<small class="text-danger pl-3">','</small>') ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password2"  name="password2" placeholder="Repeat Password...">
                        <?= form_error ('password2','<small class="text-danger pl-3">','</small>') ?>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <!-- <label class="custom-control-label" for="customCheck">Remember Me</label> -->
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Change Password
                    </button>
                    <!-- <hr> -->
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
