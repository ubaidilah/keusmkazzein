<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Uang infaq Santri</h1>
  <?php if (validation_errors()) :?>
    <div class="alert alert-danger" role="alert">
      <?= validation_errors();?>
    </div>
  <?php endif; ?>
  <!-- <p class="mb-4"> <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Infaq Milad Santri SMK Az-zainiyyah</h6>
    </div>
    <div class="card-body">
    <?= $this->session->flashdata('message'); ?>
      <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">Tambah Uang Jajan</a> -->
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jumlah</th>
              <th>status</th>
              <th>Nama Admin</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;  ?>
            <?php foreach ($infaq as $inf ) : ?>
              <?php $i++; ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $inf['nama_santri']; ?></td>
              <td><?= 'Rp. '.number_format($inf['total'],false,false,'.'); ?></td>
              <td><?php  if ($inf['is_status'] == 1) { echo "<a href='' class='adge badge-success'>Lunas</a>"; } else { echo "<a href='' class='adge badge-warning'>Belum Lunas</a>"; }  ?></td>
              <td><?= $inf['nama_user']; ?></td>
              <td>
                  <a href="#" class="badge badge-success">Edit</a>
                  <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $inf['id'];?>">Delete</a>
              </td>
            </tr>
          <?php  endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<?php
        foreach($infaq as $in):
            $id= $in['id'];
            $sant = $in['nama_santri'];
        ?>
     <!-- ============ MODAL HAPUS BARANG =============== -->
        <div class="modal fade" id="modal_hapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>
            <form class="form-horizontal" method="post" action="<?= site_url('infaq/delete')?>">
                <div class="modal-body">
                    <p>Anda yakin mau menghapus <b><?php echo $sant;?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </form>
            </div>
            </div>
        </div>
    <?php endforeach;?>
    <!--END MODAL HAPUS BARANG-->
