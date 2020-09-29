
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



          <div class="row">
            <div class="col-lg-6">

                <?= $this->session->flashdata('message'); ?>

                <h5>Role : <?= $role['role'] ?> </h5>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Menu</th>
                  <th scope="col">Access</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0;  ?>
                <?php foreach ($menu as $m ) : ?>
                  <?php $i++; ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <td><?= $m['menu']; ?></td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']);?>
                      data-role="<?= $role['id'];?>" data-menu="<?= $m['id']; ?>">
                    </div>
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
      <form class="" action="<?= base_url('admin/role') ?>" method="post">

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
