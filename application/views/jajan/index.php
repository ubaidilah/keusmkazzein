<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Uang Jajan Santri</h1>
  <?php if (validation_errors()) :?>
    <div class="alert alert-danger" role="alert">
      <?= validation_errors();?>
    </div>
  <?php endif; ?>
  <!-- <p class="mb-4"> <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Uang Jajan Santri SMK Az-zainiyyah</h6>
    </div>
    <div class="card-body">
    <?= $this->session->flashdata('message'); ?>
      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">Tambah Uang Jajan</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Saldo Akhir</th>
              <th>Nama Admin</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;  ?>
            <?php foreach ($jajan as $jjn ) : ?>
              <?php $i++; ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $jjn['nama_santri']; ?></td>
              <td><?= 'Rp. '.number_format($jjn['debit'],false,false,'.'); ?></td>
              <td><?= $jjn['nama_user']; ?></td>
              <td>
                  <a href="<?= site_url('jajan/edit/'.$jjn['id'])?>" class="badge badge-success">Edit</a>
                  <a href="" class="badge badge-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $jjn['id'];?>">Delete</a>
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
<!-- <script> $.fn.modal.Constructor.prototype.enforceFocus = function() {}; </script> -->
<div class="modal fade" id="myModal" role="dialog"
  aria-labelledby="jajan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jajan">Tambah Data Uang Jajan Santri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="" method="post">

      <div class="modal-body">
        <div class="form-group">
          <select name="santri" class="form-control select2" style="width:100" id="santri">
            <option value="">Search Nama Santri</option>
            <?php foreach ($santri as $s) : ?>
              <option value="<?= $s['id'];?>"><?= $s['nama_santri'];?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="debit" name="debit" placeholder="Total Uang Jajan">
          <input type="hidden" class="form-control" id="user" name="user" placeholder="Total Uang Jajan" value="<?=$user['id']?>">
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


<?php
        foreach($jajan as $j):
            $id= $j['id'];
            $sant = $j['nama_santri'];
        ?>
     <!-- ============ MODAL HAPUS BARANG =============== -->
        <div class="modal fade" id="modal_hapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>
            <form class="form-horizontal" method="post" action="<?= site_url('jajan/delete')?>">
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
