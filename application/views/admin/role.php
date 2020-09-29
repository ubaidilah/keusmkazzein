
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



          <div class="row">
            <div class="col-lg-6">
              <?= form_error('menu', '<div class="alert alert-danger" role="alert">','</div>' ); ?>

                <?= $this->session->flashdata('message'); ?>
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newroleModal">Add New role</a>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Role</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0;  ?>
                <?php foreach ($role as $r ) : ?>
                  <?php $i++; ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <td><?= $r['role']; ?></td>
                  <td>
                      <a href="<?= base_url('admin/roleaccess/').$r['id']; ?>" class="badge badge-warning">access</a>
                      <a href="" class="badge badge-success">Edit</a>
                      <a href="" class="badge badge-danger">Delete</a>
                  </td>
                </tr>
              <?php  endforeach; ?>
              </tbody>
              </table>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- Modal -->


<!-- Modal -->
<div class="modal fade" id="newroleModal" tabindex="-1" role="dialog"
  aria-labelledby="newroleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newroleModalLabel">Add New Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="" method="post">

      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>
