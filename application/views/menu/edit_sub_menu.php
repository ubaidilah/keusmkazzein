        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->



          <div class="row">
            <div class="col-lg">
              <?php if (validation_errors()) :?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors();?>
                </div>
              <?php endif; ?>

                <?= $this->session->flashdata('message'); ?>

                <div class="container">
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="title">Submenu Title:</label>
                      <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="<?= $subMenu['title']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="pwd">Menu:</label>
                      <select name="menu_id" id="js-example-basic-single" class="form-control">
                        <option value="">Select Menu</option>
                        <?php
    											foreach ($menu as $m) {
    												echo '<option value="'.$m['id'].'" '.(($m['id'] == $subMenu['menu_id'])?'selected="selected"':"").'>'.$m['menu'].'</option>';
    											}
    										?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="url">Submenu Url:</label>
                      <input type="text" class="form-control" id="url" placeholder="Enter url" name="url" value="<?= $subMenu['url']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="icon">Submenu Icon:</label>
                      <input type="text" class="form-control" id="icon" placeholder="Enter icon" name="icon" value="<?= $subMenu['icon']; ?>">
                    </div>
                    <div class="form-group form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" <?= ($subMenu['is_active'] == 1) ? 'checked="checked"':""?> > Is Acvtive
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
              <div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
    </div>
  <!-- End of Main Content -->
  <!-- <script>
$('#js-example-basic-single').select2()
  </script> -->
