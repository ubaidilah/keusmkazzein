<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Santri</h1>
  <!-- <p class="mb-4"> <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
  <?= $this->session->flashdata('message'); ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Santri SMK Az-zainiyyah</h6>
    </div>
    <div class="card-body">
      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Santri</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>JK</th>
              <th>Kelas</th>
              <th>Jurusan</th>
              <th>Program</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;  ?>
            <?php foreach ($santri as $sant ) : ?>
              <?php $i++; ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $sant['nama_santri']; ?></td>
              <td><?= $sant['jk']; ?></td>
              <td><?= $sant['nama_kelas']; ?></td>
              <td><?= $sant['nama_jurusan']; ?></td>
              <td><?= $sant['nama_program']; ?></td>
              <td>
                  <a href="<?= site_url('santri/edit/'.$sant['id'])?>" class="badge badge-success">Edit</a>
                  <a href="" class="badge badge-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $sant['id'];?>">Delete</a>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog"
  aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Santri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="santri">Nama Santri<span style="color:red;">*</span></label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Santri">
        </div>

        <div class="form-group">
          <label for="jk">Jenis Kelamin<span style="color:red;">*</span></label>
          <select id="jk" name="jk" class="select2">
              <option value="">Pilih Jenis Kelamin</option>
              <option value="L">Laki - Laki</option>
              <option value="P">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="nis">NIS Santri</label>
          <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS">
        </div>

        <div class="form-group">
          <label for="kelas">Kelas<span style="color:red;">*</span></label>
          <select name="kelas" id="kelas" class="form-control select2">
            <option value="">Pilih Kelas</option>
            <?php foreach ($kelas as $k) : ?>
              <option value="<?= $k['id_kelas'];?>"><?= $k['nama_kelas']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="jurusan">Jurusan<span style="color:red;">*</span></label>
          <select name="jurusan" id="jurusan" class="form-control select2">
            <option value="">Pilih Jurusan</option>
            <?php foreach ($jurusan as $j) : ?>
              <option value="<?= $j['id_jurusan'];?>"><?= $j['nama_jurusan'].' || '.$j['singkatan']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="program">Program<span style="color:red;">*</span></label>
          <select name="program" id="program" class="form-control select2">
            <option value="">Pilih Program</option>
            <?php foreach ($program as $p) : ?>
              <option value="<?= $p['id'];?>"><?= $p['nama_program']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
    </form>
    </div>
  </div>
</div>


<?php
        foreach($santri as $s):
            $id= $s['id'];
            $sant = $s['nama_santri'];
        ?>
     <!-- ============ MODAL HAPUS BARANG =============== -->
        <div class="modal fade" id="modal_hapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>
            <form class="form-horizontal" method="post" action="<?= site_url('santri/delete')?>">
                <div class="modal-body">
                    <p>Anda yakin mau menghapus Santri <b><?php echo $sant;?></b></p>
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
